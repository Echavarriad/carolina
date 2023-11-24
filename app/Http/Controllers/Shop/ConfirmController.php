<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Event;
use App\Modules\Wompi;
use App\Models\{User, Order, Payment};
use App\Shop\{Module};

class ConfirmController extends GeneralController
{
	public function confirm(){
        if ($confirm = Wompi::confirmPay()){
            $order = Order::where('reference', $confirm['order'])->first(); 
            if ($order->status_id == 2) {
                return response('OK', 200);
            }
            if (!$order) {
                \Log::info('Pedido ' . $confirm['order'] . ' no existe: ' . request()->ip());
                return response()->json(['status' => 'error'], 422);
            }

            if (!isset($confirm['status'])) {
                \Log::info('Error procesando la información: ' . request()->ip());
                return response()->json(['status' => 'error'], 422);
            }

            //Pago aprobado   
            if ($confirm['status'] == 2) {
                $payment = Payment::where('order_id', $order->id)->first();
                if (!$payment) {
                    $confirm['order_id'] = $order->id;
                    Payment::create($confirm);
                } else {
                    $payment->params = $confirm['params'];
                    $payment->save();
                }                  
                
                $order = Order::where('reference', $confirm['order'])->with(['user', 'items', 'address', 'payment'])->first();  
                $order->status_id = 2;
                $order->save();
                Event::dispatch('order.paid' , compact('order'));
            }elseif ($confirm['status'] == 5) {
                $order->status_id = 5;
                $order->save(); 
                $payment = Payment::where('order_id', $order->id)->first();
                if (!$payment) {
                    $confirm['order_id'] = $order->id;
                    Payment::create($confirm);
                } else {
                    $payment->params = $confirm['params'];
                    $payment->save();
                }
                //Ejecutar eventos pago rechazado
                $order = Order::where('reference', $confirm['order'])->with(['user', 'items', 'address', 'payment'])->first();
                Event::dispatch('order.declined' , [$order]);
            }else{
                $order->save();
            }

            return response('OK', 200);
        }
        return response('OK', 200);
    }
}