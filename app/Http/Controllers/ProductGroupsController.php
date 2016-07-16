<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductGroup;

class ProductGroupsController extends Controller
{
    
    public function index() {
        $this->authorize('only_manager');
        return view('admin.groups.groups')->with('groups',  ProductGroup::all());
    }
    
    public function create()    {
       $this->authorize('only_manager');
       return view('admin.groups.create');
    }
    
    
    public function show() {
       $this->authorize('only_manager');
       return view('admin.groups.groups')->with('groups',  ProductGroup::all());
    }
    
    public function store(Request $request) {
        $this->authorize('only_manager');
        ProductGroup::create($request->all());
        return back()->with('message','Категория добавлена');
    }
    
    public function destroy($group_id) {
        $this->authorize('only_manager');
        $group=ProductGroup::find($group_id); 
        $group->delete();
        return back()->with('message',"Категория ".$group->title." удалена");
    }
    
    public function edit($group_id){
        $this->authorize('only_manager');
        $group=ProductGroup::find($group_id);
        return view('admin.groups.edit',['group'=>$group]);
    }
    
    public function update(Request $request,$id) {
        $this->authorize('only_manager');
        $group=ProductGroup::find($id);
        $group->update($request->all());
        $group->save();
        return back()->with('message','Категория обновлена');
    }
}
