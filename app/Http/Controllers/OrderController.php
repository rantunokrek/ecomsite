<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Shipping;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function storeOrder(Request $request){

        $request->validate([
            'shipping_f_name' => 'required',
            'shipping_l_name' => 'required',
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'invoice_no' => mt_rand(10000000,99999999),
            'payment_type' => $request->payment_type,
            'total' => $request->total,
            'subtotal' => $request->subtotal,
            'coupon_discount' => $request->coupon_discount,
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::where('user_ip',request()->ip())->latest()->get();
            foreach ($carts as $cart ) {
          
                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->product_id,
                   
                    'product_qty' => $cart->qty,
                    'created_at' => Carbon::now(),
                ]);

            }


            Shipping::insert([
                'order_id' => $order_id,
                'shipping_f_name' => $request->shipping_f_name,
                'shipping_l_name' => $request->shipping_l_name,
                'shipping_u_maile' => $request->shipping_u_maile,
                'shipping_u_phone' => $request->shipping_u_phone,
                'shipping_u_address' => $request->shipping_u_address,
                'shipping_u_state' => $request->shipping_u_state,
                'shipping_u_code' => $request->shipping_u_code,
                'created_at' => Carbon::now(),
            ]);

            if (Session::has('coupon')) {
                session()->forget('coupon');
             }

         Cart::where('user_ip',request()->ip())->delete();


            return Redirect()->to('order/success')->with('orderComplete','Your Order Succeffully Done');



    }

    public function ordeSuccess(){
        return view('pages.order-complete');
    }
}
