<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class FontendController extends Controller
{
   public function index()
   {
        $products = Product::where('status',1)->latest()->get();
        $lts_p = Product::where('status',1)->latest()->limit(3)->get();
        $categories = Category::where('status',1)->latest()->get();
        return view('pages.index',compact('products','categories','lts_p'));

   }


   public function product_details($product_id){
      $product = Product::findOrFail($product_id);
       $category_id =  $product->category_id;
       $related_p = Product::where('category_id', $category_id)->latest()->get();
          return view('pages.product-deatails',compact('product','related_p'));
       } 
       
       // ========= shop page ==========
       public function shopPage()
       {
         $products = Product::latest()->get();
         $productsp = Product::latest()->paginate(3);
         $categories = Category::where('status', 1)->latest()->get();
       return view('pages.shop',compact('products','productsp','categories'));
       }
       
       public function catWiseProduct($cat_wise_id)
       {
     
         $products = Product::where('category_id', $cat_wise_id)->latest()->paginate(6);
         $categories = Category::where('status', 1)->latest()->get();
         return view('pages.cat-product',compact('products','categories'));
       }
}
