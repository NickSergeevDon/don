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
        @foreach ($groups as $group)
            <tr>
                <td>{{$group->id}}</td>
                <td>{{$group->name}}</td>
                <td> <a href="{{action('ProductGroupsController@edit',['groupID'=>$group->id])}}">Изменить</a></td>
                <td> 
                    <form method="POST" action="{{action('ProductGroupsController@destroy',['groupID'=>$group->id])}}">
                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <button  type="text" value="Удалить"/>Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection