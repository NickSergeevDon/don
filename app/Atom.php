<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atom extends Model
{
    protected $table="atoms"; //нзвание таблицы в базе
    protected $fillable=['name','measure','cost'];
    
    public $timestamps = false;
}
