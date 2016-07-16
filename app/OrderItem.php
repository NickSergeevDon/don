<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table="order_items"; //нзвание таблицы в базе
    protected $fillable=['discont','order_id','product_id','variety_id'];
  
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
 
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
    public function variety()
    {
        return $this->belongsTo('App\Variety');
    }
    
}
