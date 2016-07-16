<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Variety;

class VarietiesController extends Controller
{
    public function contains() {
        $this->authorize('only_manager');
        
    }
    
    public function index($product_id) {
        $this->authorize('only_manager');
        $product = Product::find($product_id);
        $varieties = $product->varieties()->get();
        return view('admin.varieties.varieties',['product'=>$product, 'varieties'=>$varieties]);
    }
    
    public function show($product_id) {
        $this->authorize('only_manager');
        $product = Product::find($product_id);
        $varieties = $product->varieties()->get();
        return view('admin.varieties.varieties',['product'=>$product, 'varieties'=>$varieties]);
     }
    
    public function create($product_id) {
        $this->authorize('only_manager');
        return view('admin.varieties.create')->with('product',  Product::find($product_id));
    }  
    
    public function store(Request $request) {
        $this->authorize('only_manager');
        $all=$request->all();
        $variety = Variety::create($request->all());
        $product = Product::find($all['product_id']);
        $product->varieties()->save($variety);
        return back()->with('message','Вариант добавлен для '.$variety->product()->first()->name);
    }
    
    public function update(Request $request, $id) {
        $this->authorize('only_manager');
        $variety = Variety::find($id);
        $variety->update($request->all());
        return back()->with('message','Вариант Обновлён');
    }
          
    public function edit($id) {
        $this->authorize('only_manager');
        $variety=  Variety::find($id); //выбираем статью для редактирования
        return view('admin.varieties.edit',['variety'=>$variety, 'product'=>Product::find($variety->product_id)]);
    }
    
    public function destroy($id) {
        $this->authorize('only_manager');
     
        $variety=Variety::find($id);
        $variety->delete();
        return back()->with('message','Вариант удален');
    }
}
