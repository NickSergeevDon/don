<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductGroup extends Model
{
    protected $table="productgroups"; //нзвание таблицы в базе
    protected $fillable=['name'];
    
    public function products() {
        return $this->hasMany('App\Product','group_id');
    }
}
