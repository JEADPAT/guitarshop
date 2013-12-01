
	function test() {

		var manufacturer = $(".sublist_1 input:checked");
		var ms = manufacturer[0].value;

		var ps = convertToString($(".sublist_2 input:checked"));

		for (var i = 1; i < manufacturer.length ; i++) {
			ms += "|" + manufacturer[i].value;
		};

		$.ajax({
			url: "ajax_c/findByManufacturers",
			type: "get",
			data: "manufacturers=" + ms + "&pickups=" + ps,
			success: function(response){
				var json_object = eval(response);
                
                document.getElementById("guitarBox").innerHTML = "";
                
                 var t1 = document.getElementById("guitarBox");
                
                for (var j = 1; j <= json_object.length/3 + 1; j++) {
                    
//                alert(j);
                    
                    var row_div = document.createElement("div");
                    row_div.className = "row";
                
                    for (var i = (3*j)-3; i < 3*j && i < json_object.length; i++) {
                        var obj = eval(json_object[i]);
    //					alert(obj.manufacturer_name + " " + obj.model_name);
                        
                       
                        var d =  document.createElement("div");
                        d.className = "col-6 col-sm-6 col-lg-4";
                        
                          
                               
                         d.innerHTML = "<h2>"+obj.manufacturer_name+"</h2>"+"<h5>"+obj.model_name+"<h5>"+"<img data-src=\""+"holder.js/100%x180\""+" "+"alt="+"\"PICTURE\""+">"+"<br>"+"<p><a class="+"\"btn btn-default\" "+"href="+" \" # \" "+"role="+" \"button \" >"+"View Detail >>"+"</a></p>";
                                
                        
    //                    d.innerHTML = obj.manufacturer_name + " " + obj.model_name;
                        
                        row_div.appendChild(d);
                        
                        
                    };
                    t1.appendChild(row_div);
                };
				// alert(json_object);
				// alert(response);
            },
            error:function(xhr,error){
                alert(xhr.responseText + error.Message);
            }
		});

	}

	function findGuitars() {
		var ms = convertToString($(".sublist_1 input:checked"));
		var ps = convertToString($(".sublist_2 input:checked"));
		var bs = convertToString($(".sublist_3 input:checked"));
		var pr = convertToString($(".sublist_4 input:checked"));
		var ns = convertToString($(".sublist_5 input:checked"));
		var nf = convertToString($(".sublist_6 input:checked"));
		var mi = convertToString($(".sublist_7 input:checked"));
		$.ajax({
			url: "ajax_c/findGuitars",
			type: "get",
			data: "manufacturers=" + ms + "&pickups=" + ps + "&bridges=" + bs + "&priceranges=" + pr + "&strings=" + ns + "&frets=" + nf + "&madeins=" + mi,
			success: function(response) {
				var json_object = eval(response);
//				for (var i = 0; i < json_object.length; i++) {
//					var obj = eval(json_object[i]);
//					alert(obj.manufacturer_name + " " + obj.model_name + " " + obj.price);
//				};
                document.getElementById("guitarBox").innerHTML = "";
				var t1 = document.getElementById("guitarBox");
                for (var j = 1; j <= json_object.length/3 + 1; j++) {
                    var row_div = document.createElement("div");
                    row_div.className = "row";
                    for (var i = (3*j)-3; i < 3*j && i < json_object.length; i++) {
                        var obj = eval(json_object[i]);
                        var d =  document.createElement("div");
                        d.className = "col-6 col-sm-6 col-lg-4";
						d.innerHTML = "<h2>"+obj.manufacturer_name+"</h2>"+"<h5>"+obj.model_name+"<h5>"+"<img data-src=\""+"holder.js/100%x180\""+" "+"alt="+"\"PICTURE\""+">"+"<br>"+"<p><a class="+"\"btn btn-default\" "+"href="+" \" # \" "+"role="+" \"button \" >"+"View Detail >>"+"</a></p>";
                        row_div.appendChild(d);
                    };
                    t1.appendChild(row_div);
                };
				// alert(response);
			},
			error: function(xhr, error) {
                alert(xhr.responseText + error.Message);
			}
		});
	}

	function convertToString(input) {
		var output = "";
		if (input.length > 0) {
			output = input[0].value;
			for (var i = 1; i < input.length; i++) {
				output += "|" + input[i].value;
			};
		}
		return output;
	}
