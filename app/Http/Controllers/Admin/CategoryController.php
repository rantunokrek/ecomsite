<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{

   

    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }
        // ============ store category ========= 
        public function StoreCat(Request $request){
            $request->validate([
                'category_name' => 'required|unique:categories,category_name'
            ]);
            
           
            Category::insert([
                'category_name' => $request->category_name,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with('success','Category added');
        }
// ========================= edit ===================
public function edit($cat_id)
{

   $category = Category::find($cat_id);
   return view('admin.category.edit',compact('category'));
}
        // ============ upade category ========= 
        public function update(Request $request){
          $cat_id =  $request->id;
          
           
            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->route('admin.category')->with('updated','Category updated');
        }  
    // ============ upade category ========= 
        public function delete($cat_id){
           Category::find($cat_id)->delete();
    
            return Redirect()->back()->with('delete','Category Deleted');
        }  
   // ============ upade inactive ========= 
        public function inactive($cat_id){
           Category::find($cat_id)->update(['status'=> 0]);
    
            return Redirect()->back()->with('updated','Category Inactived');
        }  
   // ============ upade inactive ========= 
        public function active($cat_id){
           Category::find($cat_id)->update(['status'=> 1]);
    
            return Redirect()->back()->with('updated','Category Actived');
        }  
  




}
