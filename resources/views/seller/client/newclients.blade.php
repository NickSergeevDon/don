@extends('layouts.app')
@section('content')

 <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Телефон</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>    
                <td>{{$client->id}}</td>
                <td><a href="{{action('ClientController@edit',['client_id'=>$client->id])}}">{{$client->phone}}</a></td>
                <td> 
                    <form method="POST" action="{{action('ClientController@destroy',['clientID'=>$client->id])}}">
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