@extends('layouts.app')

@section('content')

<form method="POST" action="{{action('ProductsController@update',['productID'=>$product->id])}}">

<input type="hidden" name="_method" value="put">
Превью:<br>
    @if(!empty($product->preview))
<img src="{{$product->preview}}">
@endif
<input type="file" name="preview" ><br>


Название продукта:<br>

<input type="text" name="name" value="{{$product->name}}"><br>

Категория:<br>

<select name="group_id">
@foreach($groups as $group)
@if($product->group_id==$group->id)
<option value="{{$group->id}}" selected>{{$group->name}}</option>
@else
<option value="{{$group->id}}">{{$group->name}}</option>
@endif
@endforeach
</select></br>

Продукт будет доступен во всех точках?<br>

<select name="public">

<option value="1">Да</option>

<option value="0">Нет</option>

</select><br>

<input type="hidden" name="_token" value="{{csrf_token()}}">

<input type="submit" value="Сохранить">

</form>

@if(Session::has('message'))
    {{Session::get('message')}}
@endif

@endsection