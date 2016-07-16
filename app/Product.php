<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductGroup;
use App\Variety;

class Product extends Model
{
    protected $table="products";
    protected $fillable=['name','group_id','preview','public'];
    
    public function varieties() {
        return $this->hasMany('App\Variety','product_id');
    }
    public function orderItems() {
        return $this->hasMany('App\OrderItem','product_id');
    }
    public function group() {
        return $this->belongsTo('App\ProductGroup');
    }
}
