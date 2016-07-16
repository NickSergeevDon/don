<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table="clients"; //нзвание таблицы в базе
    protected $fillable=['name','surname','phone','birthday','remain','user_id'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }    
}
