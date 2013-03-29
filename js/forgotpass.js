jQuery(document).ready(function(){
	
	$('#forgotpass').submit(function(){

	

		var action = $(this).attr('action');

		

		$("#message").slideUp(750,function() {

		$('#message').hide();

		

 		$('#submit')

			.attr('disabled','disabled');

		

		$.post(action, { 

			email: $('#email').val(),
			password: $('#password').val(),
		},

			function(data){

				
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');

				$('#forgotpass #submit').attr('disabled',''); 
				
				//if(data == '') window.location.href = './customers/';
				if(data.match('success') != null)  $('#forgotpass').slideUp('slow');


				

			}

		);

		

		});

		

		return false; 

	

	});
});