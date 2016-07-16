<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DonSession;
use App\Outlet;
use Auth;
use Carbon\Carbon;

class SessionController extends Controller
{
      public function toStartOrFinish() {
            $this->authorize('only_barista');        
          
            $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
            $session = DonSession::where($matchThese)->first();
            
            if (!$session ) {
                $outlets = Outlet::all();
                return view('seller.session.new')->with('outlets', $outlets);
            } else {
                return view('seller.session.finish')->with('don_session', $session);
            }
      }
      
      public function startSession(Request $request) {
            $this->authorize('only_barista');        
          
            $outlet_id = $request->input('outlet_id');
            
            $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
            $session = DonSession::where($matchThese)->first();
            
            if ($session) {
                return view('seller.session.finish')->with('don_session', $session);
            }
   
            
            $session = new DonSession();
            $session->user_id = Auth::user()->id;
            $session->state = "active";
            $session->start = Carbon::now()->toDateTimeString();
            $session->outlet_id = $outlet_id;
            $session->save();

        return redirect('/desk');
      }
      
      public function finishSession() {
          $this->authorize('only_barista');        
          
          $matchThese = ['user_id' => Auth::user()->id, 'state' => 'active'];
          $session = DonSession::where($matchThese)->first();
   
          if (!$session) {
              $outlets = Outlet::all();
              return view('seller.session.new')->with('outlets', $outlets);
          }
          
         $session->state = "finished";
         $session->finish = Carbon::now()->toDateTimeString();
         $session->save();
         
        return redirect('/');
     }
}
