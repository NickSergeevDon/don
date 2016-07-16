@extends('layouts.app')
@section('content')

<link href="{{ asset('css/kassa_style.css') }}" rel="stylesheet">

@foreach ($groups as $group)
  <div id="toolbar" class="toolbar">
            @foreach ($group->products as $product)
            <span className="toolbar-button" id="{{$product->name}}" href="{{action('deskController@add',['product_id'=>$product_id])}}" > 
                {{ $product->name }} 
            </span>
            @endforeach
  </div>  
@endforeach

@endsection

@section('script')

    <script>

	var summa = 0;
	var amount = new Array();
	var last_submit = 0;
	var baristaName = "Megamoll";
	var totalProducts = 0;

	function render() {
		 for (group_index in items)
			for (item_index in items[group_index] ) {
				var code = group_index * 100 + parseInt(item_index);
				var cur_item = document.getElementById("button" + code);
				
				if (amount[group_index][item_index][0]) {
					cur_item.style.borderTop = "3px solid orange";
				} else {
					cur_item.style.borderTop = "none";
				}
				
				if (amount[group_index][item_index][1]) {
					cur_item.style.borderRight = "3px solid orange";
				} else {
					cur_item.style.borderRight = "none";
				}
				
				if (amount[group_index][item_index][2]) {
					cur_item.style.borderBottom = "3px solid orange";
				} else {
					cur_item.style.borderBottom = "none";
				}
				
				if (amount[group_index][item_index][3]) {
					cur_item.style.borderLeft = "3px solid orange";
				} else {
					cur_item.style.borderLeft = "none";
				}
			}				
		
		var discont = document.getElementById("discont").value;
		var element = document.getElementById("total_sum");
		element.innerHTML = Math.trunc( (100 - parseInt(discont)) * summa / 100 );
	}
	
	function submit_data() { 
	
		var cur_date = new Date();
		
		if (cur_date - last_submit < 30000) {
			return;
		}	
		
		last_submit = cur_date;

		var discont = document.getElementById("discont").value;
		
		
		var query = "n="+totalProducts+"&name="+baristaName+"&discont="+discont;
		
		//alert(query);
		
		 for (group_index in items)
			for (item_index in items[group_index] ) 
				for (size in items[group_index][item_index].sizes) {
					query = query + "&arr[]=" + amount[group_index][item_index][size];
				}
			
		//alert(query);
		
		/* маги¤ из jquery */
		$.ajax({
			type: "GET",
			url: "add_to_db.php",
			data: query,
			// ¬ыводим то что вернул PHP
			success: function(html) {
				if (html) {
					reset_all();
					alert("Привет, бариста! Заказ успешно добавлен");
				} else {
				}
			}
		}); 
	
	}

	function price_mouseHandler(e) {
	var eType;
	var eSrc;
	
	if (window.event) {
		eType = event.type;
		eSrc = event.srcElement;
	} else {
		eType = e.type;
		eSrc = e.target;
	}
	
	if (eType == "mouseover") { 
		
		if (eSrc.id == "price_right")  {
			eSrc.className = "pricebar-right-hover";
		} else {
			eSrc.className = "pricebar-left-hover";
		}
		
	}
	
	if (eType == "mouseout") {
		
		if (eSrc.id == "price_right")  {
			eSrc.className = "pricebar-right";
		} else {
			eSrc.className = "pricebar-left";
		}
		
	}
	
	if (eType == "click") {
		
		var code = eSrc.getAttribute("href");
		
		var i = (code / 1000 | 0); 
		code = code % 1000;
		var j = (code / 10 | 0);
		var z = (code % 10);
		
		if (eSrc.id == "price_right")  {
		    
			if (amount[i][j][z] > 0) {
				amount[i][j][z] = amount[i][j][z] - 1;
				
				eSrc.innerHTML = amount[i][j][z];
				eSrc.className = "pricebar-right";
				summa = summa - parseInt(items[i][j].sizes[z].cost);
				
				render();
			}
			
		} else {
			amount[i][j][z] = amount[i][j][z] + 1;
			summa = summa + parseInt(items[i][j].sizes[z].cost);
			eSrc.className = "pricebar-left";
			
			render();
			
			var right = eSrc.parentNode.firstChild;
			var last = eSrc.parentNode.lastChild;
			while (right != last) {
				if (right.id == "price_right") {
					break;
				}
				right = right.nextSibling;
			}
			right.innerHTML = amount[i][j][z];
		}
		
	//	var element = document.getElementById("total_sum");
	//	element.innerHTML = summa;
	}
  }

  function createPriceBar(i, j) {
	
	var element = document.getElementById("all_prices");
	if (element) {
		element.parentNode.removeChild(element);
	}
	
	var prices = items[i][j].sizes;
	var pricebar = document.createElement("div");
	pricebar.id = "all_prices";
	pricebar.className = "pricebar";
	var productName = document.createElement("p");
	productName.innerHTML = items[i][j].name;
	productName.className = "pricebar-upper-text";
	pricebar.appendChild(productName);
	
	for (var z = 0; z < prices.length; z++) {
	
		var onepricebar = document.createElement("div");
		onepricebar.id = "onepricebar" + z;
		
		var button_left = document.createElement("span");
		button_left.setAttribute("href", i * 1000 + j * 10 + z );
		button_left.className = "pricebar-left";
		button_left.onclick = price_mouseHandler;
		button_left.onmouseover = price_mouseHandler;
		button_left.onmouseout = price_mouseHandler;
		button_left.innerHTML = prices[z].size + " " + prices[z].cost;
		onepricebar.appendChild(button_left); 
		
		var button_right = document.createElement("span");
		button_right.setAttribute("href",  i * 1000 + j * 10 + z );
		button_right.id = "price_right";
		button_right.className = "pricebar-right";
		button_right.onclick = price_mouseHandler;
		button_right.onmouseover = price_mouseHandler;
		button_right.onmouseout = price_mouseHandler;
		button_right.innerHTML = amount[i][j][z];
		onepricebar.appendChild(button_right); 
		
		pricebar.appendChild(onepricebar);
	}
	document.body.appendChild(pricebar);
  }


  function button_mouseHandler(e) {
	var eType;
	var eSrc;
	
	if (window.event) {
		eType = event.type;
		eSrc = event.srcElement;
	} else {
		eType = e.type;
		eSrc = e.target;
	}
	
	if (eSrc.tagName == "IMG") {
		eSrc = eSrc.parentNode;
	}
	if (eType == "mouseover") { 
		eSrc.className = "toolbar-button-hover";
	}
	if (eType == "mouseout") {
		eSrc.className = "toolbar-button";
	}
	if (eType == "click") {
		eSrc.className = "toolbar-button";
		var code = eSrc.getAttribute("href");
		var i = (code / 100 | 0); /* целочисленное деление */
		var j = code % 100;
		
		createPriceBar(i, j);
		/*for (var z = 0; z < items[i][j].sizes.length; z++) {
			alert(items[i][j].sizes[z].size); 
		}*/
	}
  }
  
    function intotal_mouseHandler(e) {
	var eType;
	var eSrc;
	
	if (window.event) {
		eType = event.type;
		eSrc = event.srcElement;
	} else {
		eType = e.type;
		eSrc = e.target;
	}
	
	if (eSrc.tagName == "IMG") {
		eSrc = eSrc.parentNode;
	}
	if (eType == "mouseover") { 
		eSrc.className = "intotalbar-button-hover";
	}
	if (eType == "mouseout") {
		eSrc.className = "intotalbar-button";
	}
	if (eType == "click") {
		eSrc.className = "intotalbar-button";
		submit_data();
	}
  }
  
  
  function createToolbar(sName, aButtons) {
	var toolbar = document.createElement("div");
	toolbar.id = sName;
	toolbar.className = "toolbar";
	for (var i = 0; i < aButtons.length; i++) {
		var thisButton = aButtons[i];
		var button = document.createElement("span");
		button.setAttribute("href", thisButton[1]);
		button.id="button" + thisButton[1];
		button.className = "toolbar-button";
		button.onclick = button_mouseHandler;
		button.onmouseover = button_mouseHandler;
		button.onmouseout = button_mouseHandler;
		button.innerHTML = thisButton[0];
		toolbar.appendChild(button);
	}
	document.body.appendChild(toolbar);
  }
  
  
  function reset_all() {
	var element = document.getElementById("all_prices");
		if (element) {
			element.parentNode.removeChild(element);
		}
		
		 for (group_index in items)
			for (item_index in items[group_index] ) 
				for (var z = 0; z < items[group_index][item_index].sizes.length; z++)
						amount[group_index][item_index][z] = 0;
						
		summa = 0;

		var element = document.getElementById("total_sum");
		element.innerHTML = summa;	
		
		render();
  }
  
  function createInTotalbar() {
	var bar = document.createElement("div");
	bar.id="inTotal";
	bar.className = "intotalbar";
	
	var input = document.createElement("input");
	input.id = "discont";
	input.type= "text";
	input.value = "0";
	input.className = "input_class"
	input.oninput = function() {
		document.getElementById('total_sum').innerHTML =  Math.trunc( (100 - input.value) * summa / 100 );
	}

	bar.appendChild(input);
	
	var br = document.createElement("br");
	bar.appendChild(br);
	
	var chosen = document.createElement("span");
	chosen.setAttribute("href", "");
	chosen.className = "intotalbar-button";
	chosen.onclick = intotal_mouseHandler;
	chosen.onmouseover = intotal_mouseHandler;
	chosen.onmouseout = intotal_mouseHandler;
	chosen.innerHTML = "Далее";	
	bar.appendChild(chosen);
	
	var total = document.createElement("span");
	total.className="intotalbar-price";
	total.id = "total_sum";
	total.innerHTML = "0";
	bar.appendChild(total);
	
	document.body.appendChild(bar);
  }
  
    function reset_handler(e) {
	var eType;
	var eSrc;
	
	if (window.event) {
		eType = event.type;
		eSrc = event.srcElement;
	} else {
		eType = e.type;
		eSrc = e.target;
	}

		
	if (eType == "mouseover") { 
		eSrc.className = "reset-button-hover";
	}
	if (eType == "mouseout") {
		eSrc.className = "reset-button";
	}
	
	
	if (eType == "click") {
	 	eSrc.className = "reset-button";
		
		reset_all();
	}
  }
  
  
  function generate() {
	  var ToolBars = new Array();
	  var index = 0;
	  
	  
	  var clean = document.createElement("span");
	  clean.setAttribute("href", "");
	  clean.className = "reset-button";
	  clean.onclick = reset_handler;
	  clean.onmouseover = reset_handler;
	  clean.onmouseout = reset_handler;
	  clean.innerHTML = "Очистить всё";	
	  document.body.appendChild(clean);		
	  
	  var br = document.createElement("br");
	  document.body.appendChild(br);		
	  
	 	
	  createInTotalbar();
	  
	  for (group_index in items) {
			
			ToolBars[index] = new Array();
			amount[group_index] = new Array();
			
			var j = 0; /* максимальное количество элементов в строке  */
			for (item_index in items[group_index] ) {
				var current_item = items[ group_index ][ item_index ];
				
				amount[group_index][item_index] = new Array();
				ToolBars[index][j] = new Array();
				ToolBars[index][j][0] = current_item.name;
				var code = group_index * 100 + parseInt(item_index);
				ToolBars[index][j][1] = code;
		
				for (var z = 0; z < current_item.sizes.length; z++) {
					totalProducts++;
					amount[group_index][item_index][z] = 0;
				}
		
				j++;
			
				if (j > 4) {
					createToolbar('newToolBar', ToolBars[index]);
					index++;
					ToolBars[index] = new Array();
					j = 0; 
				}
			}
			
			createToolbar('newToolBar', ToolBars[index]);
			index++;
			
		}
			
	  }

    </script>

@endsection
