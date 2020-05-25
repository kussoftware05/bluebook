$(function() {
    $("#businessdirectory-userid").change(function() {
     
		var username = $('option:selected', this).text();
			$.ajax({

			type: "GET",
			
			url: "userdetails",

			data:{username:username},

			success: function(data){

			$("#limite").html(data);

			},
			});
    });
});

