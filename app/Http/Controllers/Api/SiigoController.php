<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Api\Facades\Siigo;
use App\Models\Product;

class SiigoController extends Controller{
    
    protected $productId;
    protected $qtyForSiigo;

    public function createProductoInSiigo(){
        $this->productId= request()->product_id;        
        $product= Product::with('variations')->find($this->productId);
        $dataSendCreateProduct = $this->getDataToSiigoProduct($product);
        $response= Siigo::createProductTInSiigo($dataSendCreateProduct);
        if($response->error){
            return response()->json(['status' => false, 'message' => __('content_vue.error_create_product_to_siigo')]);
        }
        $idSiigo= $response->content->id;  
        $product->update(['id_siigo' => $idSiigo, 'can_delete_in_siigo' => true]);
        

        return response()->json(['status' => true, 'message' => __('content_vue.product_create_in_siigo')]);
    }

    public function updateProductoInSiigo(){
        $this->productId= request()->product_id;        
        $product= Product::with('variations')->find($this->productId);
        $dataSendCreateProduct = $this->getDataToSiigoProduct($product);
        $response= Siigo::updateProductTInSiigo($dataSendCreateProduct, $product->id_siigo);
        if($response->error){
            return response()->json(['status' => false, 'message' => __('content_vue.error_product_to_siigo')]);
        }
        $idSiigo= $response->content->id;
        $product->update(['id_siigo' => $idSiigo]);        

        return response()->json(['status' => true, 'message' => __('content_vue.product_update_in_siigo')]);
    }
    

    public function deleteProductoInSiigo($id){
        $this->productId= $id;        
        $product= Product::with('variations')->find($this->productId);
        $response= Siigo::deleteProductTInSiigo($product->id_siigo);
        if($response->error){
            return response()->json(['status' => false, 'message' => __('content_vue.error_product_to_siigo')]);
        }
        $product->update(['id_siigo' => null]);        

        return response()->json(['status' => true, 'message' => __('content_vue.product_delete_in_siigo')]);
    }

    public function updateStockProductInSiigo(){
        $this->productId= request()->product_id;
        $this->qtyForSiigo= request()->stock;
        $product= Product::with('variations')->find($this->productId);
        if($this->qtyForSiigo == 0){
            $this->qtyForSiigo= $this->getQuantityFromProduct($product);
        }
        $response= Siigo::sendAccountantDocument($product->sku, $this->qtyForSiigo, 'Debit', 'Credit');
        if($response->error){
            return response()->json(['status' => false, 'message' => __('content_vue.error_send_stock_product_to_siigo')]);
        }

        $product->update(['can_delete_in_siigo' => false]);     

        return response()->json(['status' => true, 'message' => __('content_vue.stock_update_in_siigo')]);
    }

    private function getDataToSiigoProduct($product){
        return [
            "code" => $product->sku,
            "name" => $product->name,
            "account_group" => 1713,
            "type" => "Product",
            "stock_control" => true,
            "tax_classification" => "Excluded", //[Excluded, Exempt , Taxed]
            "tax_included" => true,
            "prices" => [
                    [
                    "currency_code" => "COP",
                    "price_list" => [
                        [
                            "position" => 1,
                            "value" => $product->price_min
                        ]
                    ]
                ]
            ],
            "unit"=> "94",
            "unit_label"=> "Unidad",
            "reference"=> $product->sku,
            "description"=> strip_tags($product->detail),
            "additional_fields"=> [
                "brand"=> "Creaciones Dulcy"
            ]
        ];
    }

    private function getQuantityFromProduct($product){
        if($product->type_product == 'simple'){
            return $product->stock;
        }

        return  $product->variations()->where('is_hidden', false)->sum('stock');
    }
}