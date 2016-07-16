<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class DonSession extends Model
{
    protected $table="don_sessions"; //нзвание таблицы в базе
    protected $fillable=['start_time','finish_time','user_id','outlet_id'];
 
    public $timestamps = false;
 
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
 
    public function outlet()
    {
        return $this->belongsTo('App\Outlet');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
