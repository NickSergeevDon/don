@extends('layouts.app')
@section('content')

    <form method="POST"  action="{{action('ProductGroupsController@update',['groupID'=>$group->id])}}"/>
        <div class="form-group">
            <label for="name">Название категории:</label>
            <input type="text" name="name" value="{{$group->name}}" placeholder="Введите название">
        </div>
        <input type="hidden" name="_method" value="put"/>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="submit" value="Сохранить">
    </form>

    @if(Session::has('message'))
        {{Session::get('message')}}
    @endif
    
@endsection