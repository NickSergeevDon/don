@extends('layouts.app')
@section('content')

<div class="container">
   
    @foreach ($sessions as $session)
        <div class="row">
            <div class="col-md-6">
              <table class="table table-bordered ">
                    <thead>
                        <tr class="info">
                            <th>Название</th>
                            <th>Результат</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>Имя бариста: </td>
                                <td> {{ $session->user->name }} </td>
                            </tr>
                            <tr>
                                <td>Имя торговой точки: </td>
                                <td> {{ $session->outlet->name }} </td>
                            </tr>
                            <tr>
                                <td>Время открытия смены: </td>
                                <td> {{ $session->start }} </td>
                            </tr>
                            <tr>
                                <td>Время закрытия смены: </td>
                                @if ( $session->state == "active" ) 
                                <td>  активна </td>
                                @else 
                                <td> {{ $session->finish }} </td> 
                                @endif
                            </tr>
                    </tbody>
                </table>
            <div>
         </div>
    
            @foreach ($session->orders()->get() as $order)
               
                @if ($order->state == 'saved') 
                    <div class="row">
                             <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> {{ $order->created_at }} - Имя клиента: {{ $order->user->name or 'Неизвестен' }} </th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr class="success">
                                            <th> Название </th>
                                            <th> Цена с учётом скидки </th>
                                            <th> Скидка </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>   
                                                <td> {{$item->variety->name}} {{$item->product->name}} </td>
                                                <td>  {{$item->variety->cost * ( 100 - $item->discont) / 100 }} </td>
                                                <td> {{$item->discont}} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                    </div>    
                @endif    
                    
            @endforeach 
        @endforeach
 </div>    

@endsection