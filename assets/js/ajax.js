
	function findGuitars(sort_type) {
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
			data: "manufacturers=" + ms + "&pickups=" + ps + "&bridges=" + bs + "&priceranges=" + pr + "&strings=" + ns + "&frets=" + nf + "&madeins=" + mi + "&sort_type=" + sort_type,
			success: function(response) {
				var json_object = eval(response);
//				for (var i = 0; i < json_object.length; i++) {
//					var obj = eval(json_object[i]);
//					alert(obj.manufacturer_name + " " + obj.model_name + " " + obj.price);
//				};
				if (json_object === null) {
					$("#guitarsDiv").show();
					$("#realtime").html("This Jumbotron will show you a query that use to find a guitar in out guitar shop !");
				}
				else if ($.isEmptyObject(json_object)) {
					var guitarBox = document.getElementById("guitarBox");
					guitarBox.innerHTML = "<h1>Your search did not match any products</h1><h1>Please try again.</h1>";
				}
				else {
					$("#guitarsDiv").hide();
                document.getElementById("guitarBox").innerHTML = "";
				var t1 = document.getElementById("guitarBox");
                for (var j = 1; j <= json_object.length/3 + 1; j++) {
                    var row_div = document.createElement("div");
                    row_div.className = "row";
                    for (var i = (3*j)-3; i < 3*j && i < json_object.length; i++) {
                        var obj = eval(json_object[i]);
                        var d =  document.createElement("div");
                        d.className = "col-6 col-sm-6 col-lg-4";
						d.style.cssText = "text-align: center";
						d.innerHTML = "<h2>"+obj.manufacturer_name+"</h2>"
                        +"<h5>"+obj.model_name+"</h5>"
                        +"<img src=\"http://localhost/guitarshop/assets/images/"+obj.model_name+".jpg\""+" "+"alt="+"\"PICTURE\""+" style=\"text-align:center\">"
                        +"<h5>Price ฿ " + obj.price + "</h5>"
                        +"<p><a class="+"\"btn btn-default\" "+"href="+" \" # \" "+"role="+" \"button \" onclick=\"showGuitar(" + obj.guitar_id + ")\" >"+"View Detail >>"+"</a></p>";
                        row_div.appendChild(d);
                    };
                    t1.appendChild(row_div);
                };
            }
				// alert(response);
			},
			error: function(xhr, error) {
                alert(xhr.responseText + error.Message);
			}
		});
		
		$.ajax({
			url: "ajax_c/getQuery",
			type: "get",
			data: "manufacturers=" + ms + "&pickups=" + ps + "&bridges=" + bs + "&priceranges=" + pr + "&strings=" + ns + "&frets=" + nf + "&madeins=" + mi + "&sort_type=" + sort_type,
			success: function(response) {
				if (response != "")
					$("#realtime").html(response);
				// alert(response);
			},
			error: function(xhr, error) {
                alert(xhr.responseText + error.Message);
			}
		});
	}

	function showGuitar(id) {
		$.ajax({
			url: "ajax_c/findGuitar",
			type: "get",
			data: "id=" + id,
			success: function(response) {
				var json_object = eval(response);
//				for (var i = 0; i < json_object.length; i++) {
//					var obj = eval(json_object[i]);
//					alert(obj.manufacturer_name + " " + obj.model_name + " " + obj.price);
//				};
				$("#guitarsDiv").hide();
                document.getElementById("guitarBox").innerHTML = "";
				var guitarBox = document.getElementById("guitarBox");
				var row_div = document.createElement("div");
				row_div.className = "row";
				var obj = eval(json_object[0]);
				var d =  document.createElement("div");
				d.className = "col-sm-12";
				d.innerHTML = "<h1 style=\"font-size: 60px; margin-left: 30px;\">"+obj.manufacturer_name+"</h1>"
				+"<h3 style=\"margin-left: 30px;\">"+obj.model_name+"<h3>"
				+"<div class=\"row\" style=\"padding-top: 30px; padding-bottom: 40px;\">"
					+"<div class=\"col-md-offset-2 col-sm-4\" style=\"\">"
					+"<img src=\"http://localhost/guitarshop/assets/images/" + obj.model_name + ".jpg\" style=\"height: 400px;\">"
					+"</div>"
					+"<div id=\"guitar_information\" class=\"col-sm-6\" style=\"margin-top: 10px;\">"
					+"<p>Body Shape : " + obj.body_shape + "</p>"
					+"<p>Body Material : " + obj.body_wood_name + "</p>"
					+"<p>Bridge Type : " + obj.bridge_type + "</p>"
					+"<p>Fret Material : " + obj.fretboard_wood_name + "</p>"
					+"<p>Number of Fret : " + obj.number_of_fret + "</p>"
					+"<p>Number of String : " + obj.number_of_string + "</p>"
					+"<p>Neck Shape : " + obj.neck_shape + "</p>"
					+"<p>Neck Material : " + obj.neck_wood_name + "</p>"
					+"<p>Pickup Configuration : " + obj.pickup_configuration + "</p>"
					+"<p>Price : ฿ " + obj.price + "</p>"
					+"<br>"
					+"<button class=\"btn btn-lg btn-danger\"type=\"button\" onclick=\"findGuitars(1)\" style=\"margin-left: 0px; width: 100px;\">Back</button>"
					+"<button class=\"btn btn-lg btn-primary\"type=\"button\" onclick=\"\" style=\"margin-left: 10px; width: 100px;\">Order</button>"
					+"</div>"
				+"</div>";
				// <img src=\"http://localhost/guitarshop/assets/images/" + obj.model_name + ".jpg\">
				// +"<img src=\"http://localhost/guitarshop/assets/images/"+obj.model_name+".jpg\""+" "+"alt="+"\"PICTURE\""+" style=\"width: 237px; height: 180px;\">"
				// +"<p><a class="+"\"btn btn-default\" "+"href="+" \" # \" "+"role="+" \"button \" >"+"View Detail >>"+"</a></p>";
				row_div.appendChild(d);
				guitarBox.appendChild(row_div);
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
