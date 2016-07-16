<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Order extends Model
{
    
    protected $table="orders"; //нзвание таблицы в базе
    protected $fillable=['discont','user_id','client_id'];
  
    public function session() 
    {
        return $this->belongsTo('App\Session');
    }
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
 
}