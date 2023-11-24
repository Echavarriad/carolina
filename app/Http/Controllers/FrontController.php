<?php

namespace App\Http\Controllers;

use App\Mail\{ContactMail, SendNewsletter};
use App\Models\{FaqCategory, FormNewsletter, FormContact};
use App\Models\{Article, Category, Product};
use App\Models\User;
use App\Library\Recaptcha;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class FrontController extends GeneralController {
    
    public function intro(){
        return view('pages.intro');
    }

    public function validation(Request $request){
        $documento = User::where('document' ,'=', $request->document)->first();
      if($documento == null){
            return redirect()->route('intro');
        }elseif($request->document != $documento->document){
          return redirect()->route('intro');
        }
        else{
            return redirect()->route('account.register');
        }

    }
    public function home(Request $request){
      // session()->forget('favorites');
      // dd(session()->get('favorites'));
      $categorySelected= $request->categoria;
      set_content(1);
      $productsFeatured= Product::featured()->get();
      $query= Product::queryInitial();
      $querySubcategories= Category::orderBy('_lft')
                                ->where('parent_id', '!=', NULL)
                                ->where('featured', true);
      if($categorySelected && $categorySelected != 'todas'){
          $category= Category::where('slug', $categorySelected)->first();
          $query->where('categories.id', $category->id);
      }else{
        $ids= [];
        foreach($querySubcategories->get() as $item){
          $ids[$item->id]= $item->id;
        }
        $query->whereIn('categories.id', $ids);
      }
      
      $subCategories = $querySubcategories->get();
      $query->inRandomOrder()->limit(4);
      $query->groupBy('products.id');
      $products= $query->get();
      $articles= Article::featured()->get();

      return view('pages.home', compact('productsFeatured', 'products', 'subCategories', 'articles', 'categorySelected'));
    }    

    public function about_us() { 
      set_content(2); 
      
      return view('pages.about_us');
    }

    public function articles(){
      set_content(5);
      $articles = Article::published()->limit(3)->get();
      $idsArticles= [];
      foreach($articles as $article){
        $idsArticles[$article->id] = $article->id;
      }
      $otherArticles = Article::published()->whereNotIn('id',$idsArticles)->limit(3)->get();
      
      return view('pages.articles', compact('articles', 'otherArticles'));
    }

    public function article($slug){
      set_content(5);
      $article= Article::where('slug', $slug)->with('gallery')->firstOrFail();
      $otherArticles = Article::published()->where('id', '!=', $article->id)->limit(2)->get();
      set_seo($article);

      return view('pages.article', compact('article', 'otherArticles'));
    }

    public function contact(ContactRequest $request) { 
      set_content(4); 
      $send_form = 0;
      if ($request->isMethod('POST')){
            $data = $request->all();            
            if(!Recaptcha::validate($data['_recaptcha'])){
                $send_form = -1;
            }else{
                foreach ($data as $key => $value) {
                    if ($key != '_token') {
                        $data[$key] = htmlspecialchars($value);
                    }
                }
                $send = Mail::send(new ContactMail($data));
                if ($send) {
                      FormContact::create($data);                         
                      $send_form = 1;
                }
            }
      }    

      return view('pages.contact', compact('send_form'));

    }

    public function faqs() {
      set_content(8); 
      $faqsFeatured = FaqCategory::where('featured', true)->order()->get();
      $otherFaqs = FaqCategory::where('featured', false)->order()->get();

      return view('pages.faqs', compact('faqsFeatured', 'otherFaqs'));
    }

    public function send_newsletter(Request $request){
        if (request()->ajax()) {
            $data = request()->all();
            $email = $data['email'];
            $sw = 0;
            $record = FormNewsletter::whereEmail($email)->get();
            if (count($record) > 0) {
                $sw = -1;
            }else{
                if(!Recaptcha::validate($data['_recaptcha'])){
                    $sw = -2;
                }else{
                    if (preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $data['email'])) { 
                        $data['email'] =  preg_replace('([^A-Za-z0-9 @._-])', '', $data['email']);
                        $data['email'] = htmlspecialchars($data['email']);
                        $send = Mail::send(new SendNewsletter($data));
                        if($send){
                            $sw = 1;
                            FormNewsletter::create($data);
                        }                          
                    }else{
                        $sw = -3;
                    }                  
              }               
            }            
            return response()->json(['status' => $sw]);
        }
    
    }
}
