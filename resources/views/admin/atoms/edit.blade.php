@extends('layouts.app')

@section('content')

<form method="POST"  action="{{action('AtomsController@update',['atom_id'=>$atom->id])}}"/>
    <input type="hidden" name="_method" value="put">
    <div class="form-group">
        <label for="name">Название расходника:</label>
        <input type="text" name="name" value="{{$atom->name}}" placeholder="Введите название">
      </div> 
     <div class="form-group">
        <label for="name">Единица измерения:</label>
        <select name="measure">
            
            @if($atom->measure=="Штука")
                <option value="0" selected>Штука</option>
            @else   
                <option value="0">Штука</option>
            @endif
            
            @if($atom->measure=="Грамм")
                <option value="1" selected>Грамм</option>
            @else   
                <option value="1">Грамм</option>
            @endif
            
            @if($atom->measure=="Миллилитр")
                <option value="2" selected>Миллилитр</option>
            @else   
                <option value="2">Миллилитр</option>
            @endif
            
        </select>
     </div>
      <div class="form-group">
        <label for="name">Стоимость за одну единицу(например, грамм) измерения в руб. </label>
        <input type="text" name="cost" value="{{$atom->cost}}" placeholder="Введите стоимость">
      </div> 
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="submit" class="btn btn-default" value="Сохранить">
</form>
@endsection