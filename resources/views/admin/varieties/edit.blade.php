@extends('layouts.app')

@section('content')

<form method="POST" action="{{action('VarietyController@update',['varietyID'=>$variety->id])}}">
    
<input type="hidden" name="_method" value="put">
Вариант продукта(например: большой):<br>
<input type="text" name="name" value="{{$variety->name}}"><br>

Цена :<br>
<input type="text" name="cost" value="{{$variety->cost}}"><br>

Продукт :<br>
<input type="text" name="product_id" value="{{$product->name}}" disabled><br>

<input type="hidden" name="_token" value="{{csrf_token()}}">

<input type="submit" value="Сохранить">

</form>

@endsection