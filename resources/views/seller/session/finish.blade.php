@extends('layouts.app')

@section('content')

<div class="container"> 
    <div class="row">
        <div class="col-md-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Результат</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>Время открытия сессии: </td>
                            <td> {{$don_session->start}} </td>
                        </tr>
                        <tr>
                            <td>Торговая точка: </td>
                            <td>{{ $don_session->outlet->name }}</td>
                        </tr>
                </tbody>
            </table>
        </div>   
    </div>

    <div class ="row">
        <form method="POST"  action="{{action('SessionController@finishSession')}}"/>
             <div class="form-group">
                <label>Денег в кассе</label>
                <input name="in_kassa">  
             </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="submit" class="btn btn-default" value="Завершить работу">
        </form>
    </div>    
</div>    
@endsection