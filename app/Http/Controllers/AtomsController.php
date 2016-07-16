<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Atom;

class AtomsController extends Controller
{

    public function create() {
        $this->authorize('only_manager');
        return view('admin.atoms.create');
    }  
    
    public function index() {
        $this->authorize('only_manager');
        return view('admin.atoms.atoms')->with('atoms',  Atom::all());
    }
    
    public function destroy($id) {
        $this->authorize('only_manager');
        $atom=Atom::find($id);
        $atom->delete();
        return back()->with('message','Рассходник удален');
    }
    
    public function edit($id) {
        $this->authorize('only_manager');
        $atom=Atom::find($id); //выбираем статью для редактирования
        return view('admin.atoms.edit',['atom'=>$atom]);
    }
    
    public function update(Request $request,$id)
    {
        $this->authorize('only_manager');
        $atom=Atom::find($id);
        $atom->update($request->all());
           
        return back()->with('message', 'Рассходник изменен');
    }
    
    public function store(Request $request)
    {
        $this->authorize('only_manager');
      
        Atom::create($request->all()); // если картинка не передана, то сохраняем запрос, как есть.
       
        return back()->with('message','Расходник добавлен');
    }
}
