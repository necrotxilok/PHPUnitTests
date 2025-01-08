
function runTest() {
	var $results = $('#testResults');
	var execPath = $results.data('path');
	$.get(execPath).done(function(result) {
		$results.html(result);
	});
}
