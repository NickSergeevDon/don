@extends('layouts.app')


@section('content')

@if(Session::has('message'))
{{Session::get('message')}}
@endif

<form method="POST" action="{{action('VarietiesController@store')}}" enctype="multipart/form-data">

Вариант продукта(например: большой):<br>
<input type="text" name="name"><br>

Цена :<br>
<input type="text" name="cost"><br>

{{ Form::hidden('product_id', $product->id) }}

<input type="hidden" name="_token" value="{{csrf_token()}}">

<input type="submit" value="Сохранить">

</form>

@endsection