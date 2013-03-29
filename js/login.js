jQuery(document).ready(function(){

	

	$('#login').submit(function(){

	

		var action = $(this).attr('action');

		

		$("#message").slideUp(750,function() {

		$('#message').hide();

		

 		$('#submit')

			.attr('disabled','disabled');

		

		$.post(action, { 

			username: $('#username').val(),
			password: $('#password').val(),
		},

			function(data){

				
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');

				$('#login #submit').attr('disabled',''); 
				
				//if(data == '') window.location.href = './customers/';
				if(data.match('success') != null) window.location.href = '../customers/';


				

			}

		);

		

		});

		

		return false; 

	

	});
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

				$('#login #submit').attr('disabled',''); 
				
				//if(data == '') window.location.href = './customers/';
				if(data.match('success') != null) window.location.href = '../customers/';


				

			}

		);

		

		});

		

		return false; 

	

	});

	

});