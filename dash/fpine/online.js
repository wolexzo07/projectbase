function load(page) {
	$.ajax({
		type	: 'GET',
		url		: page,
		success	: function(data) {
			try {
				$('#calculate').html(data);
			} catch (err) {
				alert(err);
			}
		}
	});
}