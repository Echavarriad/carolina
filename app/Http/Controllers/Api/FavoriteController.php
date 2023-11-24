<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Shop\Facades\Favorite;

class FavoriteController extends Controller{    

    public function addProductToFavorite(){
        $resp = Favorite::addProductToFavorite(request()->product_id);

        return response()->json(['status' => $resp, 'message' => __('content_vue.add_favorites')]);
    }

    public function removeProductOfFavorite(){
        $resp = Favorite::removeProductOfFavorite(request()->product_id);

        return response()->json(['status' => $resp, 'message' => __('content_vue.remove_favorites')]);
    }
}