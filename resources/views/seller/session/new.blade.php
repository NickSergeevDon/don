@extends('layouts.app')

@section('content')

<form method="POST"  action="{{action('SessionController@startSession')}}"/>
     <div class="form-group">
        <label for="name">Выберите торговую точку:</label>
        <select name="outlet_id">
          @foreach($outlets as $outlet)
              <option value="{{$outlet->id}}">{{$outlet->name}}</option>
          @endforeach
        </select>      
     </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="submit" class="btn btn-default" value="Начать работу">
</form>
@endsection