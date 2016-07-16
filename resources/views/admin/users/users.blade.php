@extends('layouts.app')
@section('content')
@if(Session::has('message'))
{{Session::get('message')}}
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Почта</th>
            <th>Роли</th>
            <th>Действие</th>
            <th>Действие</th>   
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td> {{ $user->roles()->first()->role or 'не установлено' }}  </td> 
                <td> <a href="{{action('UsersController@edit',['user_id'=>$user->id])}}">Изменить</a></td>
                <td> 
                    <form method="POST" action="{{action('UsersController@destroy',['user_id'=>$user->id])}}">
                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Удалить"/>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection