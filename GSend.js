function online(){

	
	$.ajax({
		url: 'GSend.php',
		data: {line: 1}, 
		success: function(data) {

		}
	});
	

};





function offline(){
	
	$.ajax({
		url: 'GSend.php',
		data: {line: 5}, 
		success: function(data) {
					
		}
	});
	

};