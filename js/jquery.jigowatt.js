jQuery(document).ready(function(){
	
	$('#createuser').submit(function(){
	
		var action = $(this).attr('action');
		
		$("#message").slideUp(750,function() {
		$('#message').hide();
		
 		$('#submit')
			.after('<img src="assets/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');
		
		$.post(action, { 
			company: $('#company').val(),
			primarycontact: $('#primarycontact').val(),
			primaryemail: $('#primaryemail').val(),
			preferphone: $('#preferphone').val(),
			secondarycontact: $('#secondarycontact').val(),
			secondaryemail: $('#secondaryemail').val(),
			optionalphone: $('#optionalphone').val(),
			department: $('#department').val(),
			website: $('#website').val(),
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#createuser img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#createuser #submit').attr('disabled',''); 
				if(data.match('success') != null) $('#createuser').slideUp('slow');
				
			}
		);
		
		});
		
		return false; 
	
	});

	
});