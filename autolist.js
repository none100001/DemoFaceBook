$(document).ready(function() {

	var interval = setInterval(function() {
		$.ajax({
			url: 'memberlist.php',
			success: function(data) {
				$('#chatlist').html(data);
			}
		});
	}, 1000);

});