@extends('layouts.app')

@section('content')

<form method="POST" action="{{action('UsersController@update',['userID'=>$user->id])}}">

<input type="hidden" name="_method" value="put">

Имя:<br>
<input type="text" name="name" value="{{$user->name}}"><br>

Email:<br>
<input type="text" name="email" value="{{$user->email}}"><br>

Роль:<br>

<select name="role">

<option value="barista-1">Бариста - I</option>

<option value="barista-2">Бариста - II</option>

<option value="manager">Менеджер</option>

</select><br>

<input type="hidden" name="_token" value="{{csrf_token()}}">

<input type="submit" value="Сохранить">

</form>

@if (count($errors) > 0)
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
@endif

@if(Session::has('message'))
    {{Session::get('message')}}
@endif

@endsection