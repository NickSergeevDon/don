<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;

class UsersController extends Controller
{
    public function index() {
        $this->authorize('only_manager');        
         
        return view('admin.users.users',['users'=>User::all()]);
    }
   
    
    public function update(Request $request, $id) {
        $this->authorize('only_manager');        
         
        $user = User::find($id);
        
         $this->validate($request, [
         'name' => 'required|max:40|notAdmin',
         'email' => 'required|email',
         ]);
        
        $all=$request->all();
        
        if ( $user->roles()->first() !== null ) {
            $role = $user->roles()->first();
            $role->role = $all['role'];
            $role->save();
        } else {
            $role = new Role;
            $role->role = $all['role'];
            $role->user_id = $id;
            $user->roles()->save($role);    
        }
        
        $user->email = $all['email'];
        $user->name = $all['name'];
        $user->save();
        
        return back()->with('message','Вариант Обновлён');
    }
          
    public function edit($id) {
         $this->authorize('only_manager');        
         
        $user=  User::find($id); //выбираем статью для редактирования
        return view('admin.users.edit',['user'=>$user]);
    }
    
    public function destroy($id) {
        $this->authorize('only_manager');        
            
        $user=User::find($id);
        $user->delete();
        return back()->with('message','Пользователь удален');
    }
  
}
