@extends('layouts.app')
@section('content')
<h2>{{ $product->name }}</h2>
    <a href="{{action('VarietiesController@create')}}/{{$product->id}}"> Добавить новый вариант </a>
    </br>

<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Стоимость</th>
            <th>Действие</th>
            <th>Действие</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($varieties as $variety)
            <tr>
                <td>{{$variety->id}}</td>
                <td>{{$variety->name}}</td>
                <td>{{$variety->cost}}</td>
                <td> <a href="{{action('VarietiesController@contains',['variety_id'=>$variety->id])}}">Содержимое</a></td>
                <td> <a href="{{action('VarietiesController@edit',['VarietyID'=>$variety->id])}}">Изменить</a></td>
                <td> 
                    <form method="POST" action="{{action('VarietiesController@destroy',['VarietyID'=>$variety->id])}}">
                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Удалить"/>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if(Session::has('message'))
    {{Session::get('message')}}
@endif
@endsection