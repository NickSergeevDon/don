<?php
namespace App;
use Illuminate\Validation\Validator; //Здесь должно быть именно так, а не просто фасад Validator

class DonValidator extends Validator {

    public function validateNotAdmin($attribute, $value, $parameters) {
         //$atribute - это название поля, в нашем случае site
         //$value - значение поля
         //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
         return ($value != "admin");
    }
    
}