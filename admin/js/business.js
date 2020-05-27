$(function() {
    $("#businessdirectory-userid").change(function() {
     
		var userId = $('option:selected', this).val();
		
			$.ajax({

			type: "GET",
			
			url: "userdetails",
			
			data:{userId:userId},
			
			success: function(response)
			{
				console.log(response.data);
				var address = response.data['address'];
				var city = response.data['city'];
				var countryId = response.data['countryId'];
				var stateId = response.data['stateId'];
				
			   // Set value to textboxes
			   document.getElementById('businessdirectory-address1').value = address;
			   document.getElementById('businessdirectory-city').value = city;
			   $("#businessdirectory-countryid").val(countryId)
			   $("#businessdirectory-stateid").val(stateId)		
			},
			error: function() {
				alert('Oops! No data');
			}
			});
    });
});

