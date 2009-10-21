$(document).ready(function() 
{
	$('li.headlink').hover(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'none'); });
	
	$('#table').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
	});

});