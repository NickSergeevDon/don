<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table="outlets"; //нзвание таблицы в базе
    protected $fillable=['name'];
    
    public $timestamps = false;
    
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
