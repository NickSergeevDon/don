<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DonSession;
use App\Http\Requests;
use App\Order;
use Carbon\Carbon;
use Auth;

class ResultsController extends Controller
{
   public function index() {
       $this->authorize('only_manager');
       
       $sessions = DonSession::whereDate('start','=',Carbon::today()->toDateString())->get();

       /*
       $orders = Order::whereDate('updated_at', '=', Carbon::today()->toDateString())->where('state','=','saved')->get();
      
       $results = array();
       
       foreach ($orders as $order) {
           
          $name = $order->user->name; 
          
          if (!isset($results[$name])) {
              $results[$name] = 0;
          }
          
          $order_sum = 0;
          foreach ($order->orderItems as $item) {
              $order_sum = $order_sum + $item->variety->cost * ( 100 - $item->discont) / 100;
          }
            
          $results[$name] = $results[$name] + $order_sum; 
       }
        */
       return view('admin.results.results',['sessions'=>$sessions]);
    }
    
}
