<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\OrderItem;
use App\Order;
use App\Client;

use Input;
use App\Outlet;
use App\Variety;
use App\ProductGroup;
use App\DonSession;
use App\DonValidator;
use Auth;

class OrderController extends Controller
{
    public function index() {
        $this->authorize('only_barista');
             
        $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
        $session = DonSession::where($matchThese)->first();
        
        if ($session) {
            $order = $session->orders()->where('state','=','not-saved')->first();

            if(!$order){
                $order =  new Order();
                $order->discont = 0;
                $order->don_session_id = $session->id;
                $order->save();
            }

            $items = $order->orderItems;
            $total=0;
            foreach($items as $item){
                $total+=$item->variety->cost * (100 - $item->discont) / 100 ;
            } 
            $groups = ProductGroup::all();
            return view('seller.index',['groups'=>$groups,'client'=>$order->client, 'total'=>$total, 'items'=>$items, 'discont'=>$order->discont]);
        } else {
              $outlets = Outlet::all();
              return view('seller.session.new',['outlets'=> $outlets,'message'=>'Пожалуйста откройте смену']);
        }
            
    }
    
    public function select(Request $request,$id) {
        $this->authorize('only_barista');
      
        $product = Product::find($id);
       
        $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
        $session = DonSession::where($matchThese)->first();
        
        if ($session) {
            $order = $session->orders()->where('state','=','not-saved')->first();

            if(!$order){
                $order =  new Order();
                $order->discont = 0;
                $order->don_session_id = $session->id;
                $order->save();
            }


            $items = $order->orderItems;
            $total=0;
            foreach($items as $item){
                $total+=$item->variety->cost * (100 - $item->discont) / 100 ;
            } 

            $varieties = $product->varieties()->get();
            $groups = ProductGroup::all();
            return view('seller.index',['groups'=>$groups, 'varieties'=>$varieties,  'discont'=>$order->discont, 'total'=>$total, 'items'=>$items]);
        } else {
              $outlets = Outlet::all();
              return view('seller.session.new',['outlets'=> $outlets,'message'=>'Пожалуйста откройте смену']);
        }    
    }
  
    public function remove(Request $request, $id) {
        $this->authorize('only_barista');
        
        OrderItem::destroy($id);
        return redirect('/desk');
    }
    
    public function setDiscont(Request $request) {
        $this->authorize('only_barista');
        
         $this->validate($request, [
             'discont' => 'required|max:100|min:0|numeric',
         ]);
        
        $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
        $session = DonSession::where($matchThese)->first();
        
        if ($session) {
            $order = $session->orders()->where('state','=','not-saved')->first();

            if(!$order){
                $order =  new Order();
                $order->discont = 0;
                $order->don_session_id = $session->id;
                $order->save();
            }
 
            if ($request->has('discont')) {
                 $order->discont = $request->input('discont');
            } else {
                $order->discont = 0;
            }

            $order->save();
            return redirect('/desk');
        } else {
              $outlets = Outlet::all();
              return view('seller.session.new',['outlets'=> $outlets,'message'=>'Пожалуйста откройте смену']);
        }
    }
    
    public function setClient(Request $request) {
        $this->authorize('only_barista');
        
        $this->validate($request, [
             'phone' => 'required|size:17',
        ]);
        
        $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
        $session = DonSession::where($matchThese)->first();
        
        if ($session) {
            $order = $session->orders()->where('state','=','not-saved')->first();

            if(!$order){
                $order =  new Order();
                $order->discont = 0;
                $order->don_session_id = $session->id;
                $order->save();
            }
    
            if ($request->has('phone')) {
                $client = Client::where('phone', $request->input('phone'))->first();
                if (!$client ) {
                    $client =  new Client();
                    $client->name = "Новый";
                    $client->user_id = Auth::user()->id;
                    $client->phone = $request->input('phone');
                    $client->save();
                }
            } 

            $order->client_id = $client->id;
            $order->save();
            return redirect('/desk');
        } else {
              $outlets = Outlet::all();
              return view('seller.session.new',['outlets'=> $outlets,'message'=>'Пожалуйста откройте смену']);
        }
    }
    
      public function add(Request $request,$id) {
        $this->authorize('only_barista');
        
        $variety = Variety::find($id);
        $product = $variety->product()->first();
        
        $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
        $session = DonSession::where($matchThese)->first();
        
        if ($session) {
            $order = $session->orders()->where('state','=','not-saved')->first();

            if(!$order){
                $order =  new Order();
                $order->discont = 0;
                $order->don_session_id = $session->id;
                $order->save();
            }

            $orderItem  = new OrderItem();
            $orderItem->discont  = $order->discont;
            $orderItem->product_id=$product->id;
            $orderItem->variety_id = $id;
            $orderItem->order_id= $order->id;
            $orderItem->save();        

            return redirect('/desk');
        } else {
              $outlets = Outlet::all();
              return view('seller.session.new',['outlets'=> $outlets,'message'=>'Пожалуйста откройте смену']);
        }
        
    }
    
    public function submitOrder() {
        $this->authorize('only_barista');
        
        /* проверка - что не пустой order */
        $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
        $session = DonSession::where($matchThese)->first();
        
        if ($session) {
            $order = $session->orders()->where('state','=','not-saved')->first();
            $order->state = 'saved';
            $order->save();
        
            return redirect('/desk')->with('message','заказ успешно добавлен');
        } else {
              $outlets = Outlet::all();
              return view('seller.session.new',['outlets'=> $outlets,'message'=>'Пожалуйста откройте смену']);
        }
    }
    
}
