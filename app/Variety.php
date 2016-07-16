<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Variety extends Model
{
    protected $table="varieties";
    protected $fillable=['name','cost','product_id'];

    public function product() {
        return $this->belongsTo('App\Product');
    }    
    public function orderItems() {
        return $this->hasMany('App\OrderItem','variety_id');
    }    
}
