
	function test() {

		var manufacturer = $(".sublist_1 input:checked");
		var ms = manufacturer[0].value;

		for (var i = 1; i < manufacturer.length ; i++) {
			ms += "|" + manufacturer[i].value;
		};

		$.ajax({
			url: "ajax_c/findByManufacturers",
			type: "get",
			data: "manufacturers=" + ms,
			success: function(response){
				var json_object = eval(response);
                
                document.getElementById("guitarBox").innerHTML = "";
                
				for (var i = 0; i < json_object.length; i++) {
					var obj = eval(json_object[i]);
//					alert(obj.manufacturer_name + " " + obj.model_name);
                    
                    var t1 = document.getElementById("guitarBox");
                    var d =  document.createElement("div");
                    d.className = "col-6 col-sm-6 col-lg-4";
                    
                    d.innerHTML = "<h2>"+obj.manufacturer_name+"</h2>"+"<h5>"+obj.model_name+"</h5>"+"<img data-src=\""+"holder.js/100%x180\""+" "+"alt="+"\"PICTURE\""+"<br>"+"<p><a class="+"\"btn btn-default\" "+"href="+" \" # \" "+"role="+" \"button \" >"+"View Detail >>"+"</a></p>";
                    
//                    d.innerHTML = obj.manufacturer_name + " " + obj.model_name;
                    
                    t1.appendChild(d);
                    
				};
				// alert(json_object);
				// alert(response);
            },
            error:function(xhr,error){
                alert(xhr.responseText + error.Message);
            }
		});

	}

	function findGuitar() {

	}

	function convertToString(input) {
		var output = input[0].value;
		for (var i = 0; i < input.length; i++) {
			output += "|" + input[i].value;
		};
		return output;
	}
