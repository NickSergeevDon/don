@extends('layouts.app')
 
@section('Digital shop', 'Кассовый модуль')
 
@section('sidebar')
    @parent
@endsection

@section('script')
    <script type="text/javascript">
    jQuery(function($){
       $("#phone").mask("+7 (999) 999-9999");
    });
    </script>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="col-md-3">
                     <div class="container">
                        
                        @if(Session::has('message'))
                            {{Session::get('message')}}
                        @endif
                         
                        <div class="row">
                            <h2>{{ $client->name or "Неизвестен"}} ({{ $client->remain or ""}}) - {{ $total }} </h2>
                        </div>
                        
                         
                        <div class="row">
                           <div class="col-md-3 input-group">
                               <form method="POST" class="form-inline" action="{{action('OrderController@setDiscont')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="input-group {{ $errors->has('discont') ? ' has-error' : '' }}">
                                    <input type="text" placeholder="Скидка" name="discont" class="form-control" value="{{$discont or ""}}">
                                    @if ($errors->has('discont'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('discont') }}</strong>
                                        </span>
                                    @endif
                                    <span class="input-group-btn">
                                        <input type="submit" value="Установить" class="btn btn-default" > 
                                    </span>
                                </div>    
                              </form>
                             </div>
                        </div>    
                        
                        <div class="row">
                           <div class="col-md-3 input-group">
                               <form method="POST" class="form-inline" action="{{action('OrderController@setClient')}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="input-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <input type="text" placeholder="телефон" id="phone"  name="phone" class="form-control" value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                    <span class="input-group-btn">
                                        <input type="submit" value="Заапросить" class="btn btn-primary" > 
                                    </span>
                                </div>    
                              </form>
                             </div>
                        </div>     
                      
                         <div class="row">
                             <div class="col-md-offset-1 col-md-1 ">
                               <form method="GET" class="form-inline" action="{{action('OrderController@submitOrder')}}">
                                    <input class="btn btn-success" type="submit" value="Отправить">
                               </form>
                             </div>
                         </div>    
                         
                        @if( isset($varieties) )
                           @foreach ($varieties as $variety)
                           <div class="row">
                            <button type="button" class="col-md-3 btn-lg btn-default" onClick="window.location='{{action('OrderController@add',$variety->id)}}'">{{$variety->name}} - {{$variety->cost}}</button>
                           </div>
                           @endforeach
                       @endif
                      
                        @if( isset($items) )
                           @foreach ($items as $item)
                            <div class="row">
                               <button type="button" class="col-md-3 btn-lg btn-success" onClick="window.location='{{action('OrderController@remove',$item->id)}}'">
                                   <small> 
                                       {{$item->variety->name}} {{$item->product->name}} - {{$item->variety->cost * ( 100 - $item->discont) / 100 }}({{$item->discont}})
                                   </small>
                               </button>
                            </div>
                           @endforeach
                       @endif
                    </div>
            </div>
   
           <div class="col-md-9">
                @foreach ($groups as $group)
                    <div class="row">  
                           @foreach ($group->products as $product)
                               <button type="button" class="col-md-3 btn-lg btn-warning" onClick="window.location='{{action('OrderController@select',$product->id)}}'">{{$product->name}}</button>
                           @endforeach
                           
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
 
@endsection
 