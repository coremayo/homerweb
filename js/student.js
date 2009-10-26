$(document).ready(function() 
{
	$('#user_sub').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
	});
	
	$('#user_ann').dataTable( {
				"aaSorting": [[ 2, "desc" ]]

	});
	
	$('#user_courses').dataTable( {
				"aaSorting": [[ 2, "desc" ]]
	});
	
});