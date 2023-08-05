<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addToWishList($product_id){

        if(Auth::check()){
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
      
             ]);
             return Redirect()->back()->with('cartSuccsess','Product added on Wish List');

        }else{
            return Redirect()->route('login')->with('loginError','At First need account');
        }
      
    }

    public function wishPage(){

        $wishlists =  Wishlist::where('user_id', Auth::id())->latest()->get();
      return view('pages.wishlist',compact('wishlists'));
    }

   public function wish_destroy($wishlist_id){
    Wishlist::where('id',$wishlist_id)->where('user_id', Auth::id())->delete();
    return  Redirect()->back()->with('cart_delete','deleted successfully');
    }
   


}
