$(function() {
    $("#businessdirectory-userid").change(function() {
     
		var userId = $('option:selected', this).val();
		
			$.ajax({

			type: "GET",
			
			url: "userdetails",

			data:{userId:userId},
			
			dataType: 'json',
			
			success: function(response){
				var myObj = $.parseJSON(response);
				console.log(myObj.data);
				var address = myObj.data;
				var city = myObj.city;
				var len = response.length;
				//alert(len);
			  /*if(len > 0){ //alert(len);
			   var address = response[0]['address'];
			   //console.log(address);
			   var city = response[0]['city'];
			   var countryId = response[0]['countryId'];
			   var stateId = response[0]['stateId'];
			   //var salary = response[0]['salary'];
*/
			   // Set value to textboxes
			   document.getElementById('businessdirectory-address1').value = address;
			   document.getElementById('businessdirectory-city').value = city;
			  // document.getElementById('age_'+businessdirectory-city).value = age;
			   //document.getElementById('email_'+index).value = email;
			   //document.getElementById('salary_'+index).value = salary;
			  //}
			$("#limite").html(response);

			},
			error: function() {
            alert('try again');
			}
			});
    });
});

