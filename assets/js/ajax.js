
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
				for (var i = 0; i < json_object.length; i++) {
					var obj = eval(json_object[i]);
					alert(obj.manufacturer_name + " " + obj.model_name);
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
		$.ajax({
			url: "ajax_c/findGuitars",
			type: "get",
			data: "manufacturers=" + ms + "&pickups=" + ps + "&bridges=" + bs,
			success: function(response) {
				var json_object = eval(response);
				for (var i = 0; i < json_object.length; i++) {
					var obj = eval(json_object[i]);
					alert(obj.manufacturer_name + " " + obj.model_name);
				};
				// var string = "";
				// for (var i = 0; i < response.length; i++) {
					// string += response[i];
				// }
				// alert(string);
				// alert(json_object.join);
				// alert(response[0] + response[1]);
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
