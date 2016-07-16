<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Outlet;

class OutletsController extends Controller
{
    public function index() {
        $this->authorize('only_manager');
        
        return view('admin.outlets.outlets')->with('outlets',  Outlet::all());
    }
    
    public function create() {
        $this->authorize('only_manager');
       
        return view('admin.outlets.create');
    }  
    
    public function store(Request $request) {
        $this->authorize('only_manager');
       
        Outlet::create($request->all());
        return back()->with('message','Добавлена новая точка');
    }
    
    public function update(Request $request, $id) {
        $this->authorize('only_manager');
       
        $outlet = Outlet::find($id);
        $outlet->update($request->all());
        return back()->with('message','Данные точки обновлены');
    }
          
    public function edit($id) {
        $this->authorize('only_manager');
       
        $outlet=  Outlet::find($id); //выбираем статью для редактирования
        return view('admin.outlets.edit',['outlet'=>$outlet]);
    }
    
    public function destroy($id) {
        $this->authorize('only_manager');
       
        $outlet= Outlet::find($id);
        $outlet->delete();
        return back()->with('message','Точка удалена');
    }
    
}
