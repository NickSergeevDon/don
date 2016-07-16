<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Client;

class ClientController extends Controller
{
    
    public function index() {
        $this->authorize('only_barista');
     
        $matchThese = ['user_id' => Auth::user()->id, 'name' => 'Новый'];
        $clients = Client::where($matchThese)->get();
        
        return view('seller.client.newclients',['clients'=>$clients]);
    }
    
     public function show($id) {
        $this->authorize('only_barista');
     
        $client = Client::find($id);
        return view('seller.client.edit',['client'=>$client]);
    }
    
    public function edit($id) {
        $this->authorize('only_barista');
        
        $client = Client::find($id);
        return view('seller.client.edit',['client'=>$client]);
    }
    
    public function export() {
        $this->authorize('only_manager');
        
        $clients = Client::all();
        
        foreach ($clients as $client) {
            $part1 = substr( $client->phone, 0, 3);
            $part2 = substr( $client->phone, 3, 3);
            $part3 = substr( $client->phone, 6, 4);
            $phone = "+7 (".$part1.") ".$part2."-".$part3;
            $client->phone = $phone;
            $client->save();
        }
        
        return "Экспорт состоялся";
    }
    
    public function update(Request $request, $id) {
        $this->authorize('only_barista');
     
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'phone' => 'required|size:17',
            'email' => 'email|max:255|unique:users',
            'birthday' => 'size:10|date|date_format:d-m-Y', 
        ]);
            
       
        $client = Client::find($id);
        $client->update($request->all());
        if ($request->has('birthday')) {
            $dt = \DateTime::createFromFormat('d-m-Y', $request->input('birthday'));
            $client->birthday = $dt;
            $client->save();
        }
        
        return redirect('/desk/clients');
   }
    
    public function destroy($id) {
        $this->authorize('only_barista');
     
        $client=Client::find($id);
        $client->delete();
        return back()->with('message','Клиент удален');
    }  
}
