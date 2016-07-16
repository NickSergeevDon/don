@extends('layouts.app')

@section('content')
<h2>Результаты</h2>
<ul>
<li><a href="/admin/results">Результаты сегодня</a></li>
</ul>
<h2>Менеджер меню</h2>
<ul>
<li><a href="/admin/groups">Все категории продуктов</a></li>
<li><a href="/admin/groups/create">Добавить новую категорию</a></li>
<li><a href="/admin/products">Все продукты</a></li>
<li><a href="/admin/products/create">Добавить новый продукт</a></li>
<li><a href="/admin/atoms">Все расходники</a></li>
<li><a href="/admin/atoms/create">Добавить новый расходник</a></li>
</ul>
<h2>Менеджер персонала</h2>
<ul>
<li><a href="/admin/users">Весь персонал</a></li>
</ul>
<h2>Менеджер точек</h2>
<ul>
<li><a href="/admin/outlets">Все торговые точки</a></li>
<li><a href="/admin/outlets/create">Добавить новую точку</a></li>
</ul>
@endsection
