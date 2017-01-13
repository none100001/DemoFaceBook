$(document).ready(function() {
	var interval = setInterval(function() {
		$.ajax({
			url: 'GChat.php',
			success: function(data) {
				$('#friendlist').html(data);
			}
		});
	}, 1000);
});