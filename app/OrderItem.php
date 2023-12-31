<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
      * The attributes that aren't mass assignable.
      *	 
      * @var array
      */	   
	protected $guarded = [];	

  public function product(){
    return $this->belongsTo(Product::class,'product_id');
}
}
