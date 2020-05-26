$(function() {
    $("#businessdirectory-userid").change(function() {
     
		var userId = $('option:selected', this).val();
		
			$.ajax({

			type: "GET",
			
			url: "userdetails",

			data:{userId:userId},
			
			//dataType: 'json',
			
			success: function(res){
				var address = res.address;
				
				$('#businessdirectory-address1').html(res.address);
				//console.log(result);
				//$('#businessdirectory-address1').text('name : ' + res["address"]);
				console.log(res);
			$("#limite").html(res);

			},
			error: function() {
            alert('try again');
			}
			});
    });
});

