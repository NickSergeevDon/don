@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Иконка</th>
            <th>Название</th>
            <th>Действие</th>
            <th>Действие</th>   
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
               <td>{{$product->id}}</td>
                <td><img width=20 height=20 src="{{$product->preview}}"></td>
                <td> <a href="{{action('VarietiesController@show',['product_id'=>$product->id])}}">{{$product->name}}</a></td>
                <td> <a href="{{action('ProductsController@edit',['product_id'=>$product->id])}}">Изменить</a></td>
                <td> 
                    <form method="POST" action="{{action('ProductsController@destroy',['products'=>$product->id])}}">
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