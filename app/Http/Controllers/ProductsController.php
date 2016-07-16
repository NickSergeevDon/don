<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductGroup;
use App\Variety;
use App\Product;

class ProductsController extends Controller
{

    public function create() {
        $this->authorize('only_manager');
        return view('admin.products.create')->with('groups',  ProductGroup::all());
    }  
    
    public function index() {
        $this->authorize('only_manager');
        return view('admin.products.products')->with('products',  Product::all());
    }
    
    public function destroy($id) {
        $this->authorize('only_manager');
        $product=Product::find($id);
        $product->delete();
        $root=$_SERVER['DOCUMENT_ROOT'];
        if(!empty($product->preview))
        {
             unlink($root.$product->preview); //удаляем превьюшку
        }
        return back()->with('message','Продукт удален');
    }
    
    public function edit($id) {
        $this->authorize('only_manager');
        $product=Product::find($id); //выбираем статью для редактирования
        $groups=ProductGroup::all(); // выбираем все категории
        return view('admin.products.edit',['product'=>$product,'groups'=>$groups]);
    }
    
    public function update(Request $request,$id)
    {
        $this->authorize('only_manager');
        $product=Product::find($id);
          if($request->hasFile('preview')) { //Проверяем была ли передана картинка, ведь статья может быть и без картинки.
               $date=date('d.m.Y'); //опеределяем текущую дату, она же будет именем каталога для картинок
               $root=$_SERVER['DOCUMENT_ROOT']."/images/"; // это корневая папка для загрузки картинок
               if(!file_exists($root.$date))    { // если папка с датой не существует, то создаем ее
                   mkdir($root.$date);   
               } 
               $f_name=$request->file('preview')->getClientOriginalName();//определяем имя файла
               $request->file('preview')->move($root.$date,$f_name); //перемещаем файл в папку с оригинальным именем
               $all=$request->all(); //в переменой $all будет массив, который содержит все введенные данные в форме
               $all['preview']="/images/".$date."/".$f_name;// меняем значение preview на нашу ссылку, иначе в базу попадет что-то вроде /tmp/sdfWEsf.tmp
               $product->update($all);
           }   else   {
               $product->update($request->all());
           }
        return back()->with('message', 'Продукт изменен');
    }
    
    public function store(Request $request)
    {
        $this->authorize('only_manager');
        if($request->hasFile('preview')) {//Проверяем была ли передана картинка, ведь статья может быть и без картинки.
                $date=date('d.m.Y'); //опеределяем текущую дату, она же будет именем каталога для картинок
                $root=$_SERVER['DOCUMENT_ROOT']."/images/"; // это корневая папка для загрузки картинок
                if(!file_exists($root.$date))  {// если папка с датой не существует, то создаем ее
                    mkdir($root.$date); 
                }
                $f_name=$request->file('preview')->getClientOriginalName();//определяем имя файла
                $request->file('preview')->move($root.$date,$f_name); //перемещаем файл в папку с оригинальным именем
                $all=$request->all(); //в переменой $all будет массив, который содержит все введенные данные в форме
                $all['preview']="/images/".$date."/".$f_name;// меняем значение preview на нашу ссылку, иначе в базу попадет что-то вроде /tmp/sdfWEsf.tmp
                Product::create($all); //сохраняем массив в базу
        } else {
                Product::create($request->all()); // если картинка не передана, то сохраняем запрос, как есть.
        }
       return back()->with('message','Продукт добавлен');
    }
}
