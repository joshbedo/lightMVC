jQuery(document).ready(function(){

	

	$('#export').submit(function(){

	

		var action = $(this).attr('action');

		

		$("#message").slideUp(750,function() {

		$('#message').hide();

		

 		$('#submit')

			.attr('disabled','disabled');

		

		$.post(action, { 

			filename: $('#filename').val(),
			depart: $('#department').val(),
		},

			function(data){

				
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');

				$('#export #submit').attr('disabled',''); 
				//alert(data);
				//if(data == '') window.location.href = './customers/';
				if(data.match('success') != null) window.location.href = '../exportdata/';


				

			}

		);

		

		});

		

		return false; 

	

	});

	

});