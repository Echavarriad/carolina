<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Product, City};
use Illuminate\Support\Str;

class AjaxController extends Controller {

  public function cities($dep) {
    $cities = City::where('state_id', $dep)->orderBy('name')->get()->toArray();

    return response()->json($cities);
  }

    public function search_products($term){
      $records = Product::where(function ($q) use ($term) {
            $q->where('name', 'LIKE', "%$term%")
              ->orWhere('sku', 'LIKE', "%$term%");
      })->get();
      $dataSearch = [];
  
      foreach ($records as $key => $value) {
          $category= $value->category_main();
          $subcategory= $value->subcategory();
          $dataSearch[] = [              
              'name' => Str::ucfirst(Str::lower($value->name)),
              'category' => $category ? $category->name : '',
              'image' => asset('uploads/' . $value->image),
              'price' => $value->price(),
              'route' => $value->create_route()
          ];
      }
  
      return response()->json(['status' => true, 'records' => $dataSearch]);
    }
}
