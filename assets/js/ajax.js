
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
				for (var i = 0; i < json_object.length; i++) {
					var obj = eval(json_object[i]);
					alert(obj.model_name);
				};
				// alert(json_object);
				// alert(response);
            },
            error:function(xhr,error){
                alert(xhr.responseText + error.Message);
            }
		});

	}