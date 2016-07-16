<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table="roles"; //нзвание таблицы в базе
    protected $fillable=['role','user_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
