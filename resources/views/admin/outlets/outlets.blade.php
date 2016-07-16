@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Действие</th>
            <th>Действие</th>   
        </tr>
    </thead>
    <tbody>
        @foreach ($outlets as $outlet)
            <tr>
                <td>{{$outlet->id}}</td>
                <td>{{$outlet->name}}</td>
                <td> <a href="{{action('OutletsController@edit',['outlet_id'=>$outlet->id])}}">Изменить</a></td>
                <td> 
                    <form method="POST" action="{{action('OutletsController@destroy',['outlet_id'=>$outlet->id])}}">
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