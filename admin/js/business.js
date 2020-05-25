$(function() {
    $("#businessdirectory-userid").change(function() {
     
		var username = $('option:selected', this).text();
			$.ajax({

			type: "GET",
			
			url: "userdetails",

			data:{username:username},

			success: function(data){
				//alert(data); // apple
			$("#limite").html(data);

			},
			});
    });
});

