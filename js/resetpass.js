jQuery(document).ready(function(){
	
	
	$('#resetpassword').submit(function(){

	

		var action = $(this).attr('action');

		var password1 = $('#password').val();
		var password2 = $('#passwordsecond').val();
		
		if(password1 != password2){
			$('#passwordsecond').css("border", "1px solid #f3c8c8");
		}else{
			$('#passwordsecond').css("border", "1px solid #DDDDDD");
		}

		$("#message").slideUp(750,function() {

		$('#message').hide();

		

 		$('#submit')

			.attr('disabled','disabled');

		

		$.post(action, { 

			password: $('#password').val(),
			passwordsecond: $('#passwordsecond').val(),
		},
		


			function(data){

				
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');

				$('#resetpassword #submit').attr('disabled',''); 
				
				//if(data == '') window.location.href = './customers/';
				if(data.match('success') != null){  
					$('#password').css("border", "1px solid #C2F8BD");
					$('#passwordsecond').css("border", "1px solid #C2F8BD");

					$('#forgotpass').slideUp('slow'); 
				}
					

				

			}

		);

		

		});

		

		return false; 

	

	});
});