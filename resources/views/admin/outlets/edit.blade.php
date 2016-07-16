@extends('layouts.app')
@section('content')

    <form method="POST"  action="{{action('OutletsController@update',['outlet_id'=>$outlet->id])}}"/>
        <div class="form-group">
            <label for="name">Название торговой точки:</label>
            <input type="text" name="name" value="{{$outlet->name}}" placeholder="Введите название">
        </div>
        <input type="hidden" name="_method" value="put"/>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="submit" value="Сохранить">
    </form>

    @if(Session::has('message'))
        {{Session::get('message')}}
    @endif
    
@endsection