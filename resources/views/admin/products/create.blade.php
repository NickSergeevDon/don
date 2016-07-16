@extends('layouts.app')

@section('content')

<form method="POST"  action="{{action('ProductsController@store')}}"/>
      <div class="form-group">
        <label for="name">Изображение:</label>
        <input type="file" name="preview" placeholder="Выберите файл">
      </div>
      <div class="form-group">
        <label for="name">Название продукта:</label>
        <input type="text" name="name" placeholder="Введите название">
      </div> 
     <div class="form-group">
        <label for="name">Категория:</label>
        <select name="group_id">
          @foreach($groups as $group)
              <option value="{{$group->id}}">{{$group->name}}</option>
          @endforeach
        </select>      
     </div>
    <div class="form-group">
        <label>Продукт будет доступен во всех точках?</label>
        <select name="public">
            <option value="1">Да</option>
            <option value="0">Нет</option>
        </select>
    </div>    
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="submit" class="btn btn-default" value="Сохранить">
</form>
@endsection