$('#form_input').submit(function() {
	var message = $('#message').val();
	var accepter = $('#accepter').val();
	
	$.ajax({
		url: 'Send.php',
		data: { accepter: accepter, message: message }, 
		success: function(data) {
			$('#feedback').html(data);
			
				$('#feedback').fadeIn('slow', function() {
					$('#feedback').fadeOut(6000);
				});
				
			$('#message').val('');
			
		}
	});
	
	return false;
});