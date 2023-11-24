<?php

namespace App\Http\Controllers;

use App\Models\{Content, Category};
use View;

class GeneralController extends Controller {
    
    public function __construct(){
		View::share('menuCategories', Category::defaultOrder()->get()->toTree());
    	View::share('content_generals', Content::where('section_id', 14)->select(['text_1', 'text_2', 'text_3', 'image_1', 'url_1', 'target_1'])->get()); 
		
	}

}