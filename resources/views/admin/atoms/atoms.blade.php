@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Единица измерения</th>
            <th>Стоимость</th>   
            <th>Действие</th>   
            <th>Действие</th>   
        </tr>
    </thead>
    <tbody>
        @foreach ($atoms as $atom)
            <tr>
                <td>{{$atom->id}}</td>
                <td>{{$atom->name}}</td>
                <td>{{$atom->measure}}</td>
                <td>{{$atom->cost}}</td>
                <td> <a href="{{action('AtomsController@edit',['atom_id'=>$atom->id])}}">Изменить</a></td>
                <td> 
                    <form method="POST" action="{{action('AtomsController@destroy',['atom_id'=>$atom->id])}}">
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