@extends('layouts.app')

@section('content')

<form method="POST"  action="{{action('AtomsController@store')}}"/>
      <div class="form-group">
        <label for="name">Название расходника:</label>
        <input type="text" name="name" placeholder="Введите название">
      </div> 
     <div class="form-group">
        <label for="name">Единица измерения:</label>
        <select name="measure">
            <option value="Штука">Штука</option>
            <option value="Грамм">Грамм</option>
            <option value="Миллилитр">Миллилитр</option>
        </select>
     </div>
      <div class="form-group">
        <label for="name">Стоимость за одну единицу(например, грамм) измерения в руб. </label>
        <input type="text" name="cost" placeholder="Введите стоимость">
      </div> 
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="submit" class="btn btn-default" value="Сохранить">
</form>
@endsection