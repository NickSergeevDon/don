@extends('layouts.app')
@section('content')
    <form method="POST"  action="{{action('ProductGroupsController@store')}}"/>
      <div class="form-group">
        <label for="name">Название категории:</label>
        <input type="text" name="name" placeholder="Введите название">
      </div>
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
      <input type="submit" class="btn btn-default" value="Сохранить">
    </form>

    @if(Session::has('message'))
        {{Session::get('message')}}
    @endif
@endsection