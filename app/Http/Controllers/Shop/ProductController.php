<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\GeneralController;
use App\Shop\Repositories\ProductRepository;
use App\Models\{AttributeOption, Product, Category, ProductAttribute, Section};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Shop\Facades\Cart;
use App\Shop\Facades\Favorite;
use DB;


class ProductController extends GeneralController
{

	protected $productRepository;
	
	function __construct(ProductRepository $productRepository)
	{		
		$this->productRepository = new ProductRepository;
		 parent::__construct();
	}

  public function list(Request $request, $slug_cat = null, $slug_subcat = null){
      set_content('3');      
      $cat_ids = null;
      
      $category = Category::where('slug', $slug_cat)->with('children')->first();
      $subcategory = Category::where('slug', $slug_subcat)->with('children')->first();
    
      $params = request()->input(); 
      $noattr = ['page', 'precio-min','precio-max'];
      if ($category) {
        set_seo($category);
        $cat_id = $category->id;
        $cat_ids[$cat_id] = $cat_id;
      }

      if ($subcategory) {
        set_seo($subcategory);
        $cat_id = $subcategory->id;
        $cat_ids[$cat_id] = $cat_id;
      }
      $query = Product::queryInitial();
      if($cat_ids) {
        $query->whereIn('product_categories.category_id', $cat_ids);
      }
      
      $attributes = $this->getFilters($query);
      $rangePrices = $this->getPriceMinAndPriceMax($query);
      if(isset($params['precio-min']) && isset($params['precio-max'])){
        $query->filterPrice($params['precio-min'], $params['precio-max']); 
      }
      if ($params){ 
        $attrs = null;  
        foreach ($params as $key => $param) {   
          if (!in_array($key, $noattr)) { 
            $attrs[] = $param;          
          }
        }

        if ($attrs) {
          $query->filterAttributes($attrs);         
        }
      } 
      $query->groupBy('products.id');  
                  
      $products = $query->paginate(config('settings.paginate_products'));

      $valueMinPrice= isset($params['precio-min']) ? $params['precio-min'] : $rangePrices['price_min'];
      $valueMaxPrice= isset($params['precio-max']) ? $params['precio-max'] : $rangePrices['price_max'];
     //dd($attributes);

      return view('shop.products', compact('products', 'category', 'subcategory', 'params', 'rangePrices', 'valueMinPrice', 'valueMaxPrice', 'attributes'));
  }
	
	public function view($slug_cat= null, $slug_subcat= null, $slug = null){
    set_content('3');
		$product = Product::where('slug', $slug)->with(['variations','gallery', 'relateds'])->firstOrFail();
    $productRelateds= $product->relateds_published();
    $category = Category::where('slug', $slug_cat)->with('children')->first();
    $subcategory = Category::where('slug', $slug_subcat)->with('children')->first();  
    //dd($product->variations);
    return view('shop.product.view', compact('category', 'subcategory', 'product', 'productRelateds'));
	}

  public function favorites(){
    $section= Section::with('contents')->find(3);
    $section->contents[0]->image_1= $section->contents[2]->image_1;
    $section->contents[0]->text_1= $section->contents[2]->text_1;
    $section->contents[0]->alt_1= $section->contents[2]->alt_1;
    $section->contents[0]->tit_1= $section->contents[2]->tit_1;
    $arrayFavorites= Favorite::getArrayFavorites();
    $products = Product::published()->whereIn('id', $arrayFavorites)->get();

    return view('shop.favorites', compact('products', 'section'));
  }

  private function getPriceMinAndPriceMax($query){
    $dataPrice['price_min']= intval($query->min('price_min'));
    $dataPrice['price_max']= intval($query->max('price_min'));

    return $dataPrice;
  }

  private function getFilters($query) {
    $idsProducts= $query->pluck('products.id', 'products.id')->toArray();
    $query= ProductAttribute::with('attribute')->whereIn('product_id', $idsProducts);
    $attributes= $query->groupBy('attribute_id')->get();
    $query = AttributeOption::with('attribute')->selectRaw('attribute_options.id , attribute_options.attribute_id , attribute_options.name')
      ->orderBy('attribute_options.order')
      ->join('product_attributes', 'product_attributes.attribute_option_id', '=', 'attribute_options.id')
      ->groupBy('attribute_options.id', 'attribute_options.attribute_id', 'attribute_options.name');
    
    $options = $query->get()->toArray();
    // dd($options);
    $filters = collect();
    foreach ($attributes as $key => $value) {
        $opts = [];
        foreach ($options as $opt) {
          if(ProductAttribute::whereIn('product_id', $idsProducts)->where('attribute_option_id', $opt['id'])->first()){
            if ($opt['attribute_id'] == $value->attribute->id) {
              $opts[] = $opt;
            }
          }            
        }
        $attributes[$key]['options'] = $opts;
        $filters->push($attributes[$key]);
    }

    return $filters;
} 
 
}
