var oTable;
var giRedraw = false;

$(document).ready(function() 
{
	oTable = $('#user_sub').dataTable( {
				"aoColumns": [ 
			/* Sub ID */   { "bSearchable": false,
			                 "bVisible":    false },
			/* Course */  null,
			/* Start Date */ null,
			/* End Date */  null,
			/* Days Left */    null],
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
				
				
				
	});
	
	$('#user_ann').dataTable( {
				"aaSorting": [[ 2, "desc" ]],
				"bLengthChange": false
	});
	
	$('#user_courses').dataTable( {
				"aaSorting": [[ 2, "desc" ]]
	});
	
	$('#user_lectures').dataTable( {
				"aaSorting": [[ 2, "desc" ]]
	});
	
	$('#user_lecture_resources').dataTable( {
				"aaSorting": [[ 2, "desc" ]]
	});
	
	$("#settings_form").validate( {
		rules: {
			pass: {
              minlength:5,
              maxlength:20
             },
            repass: {
               equalTo: "#pass"
             }

		}});
	
});

function changeClass(id){
document.getElementById(id).setAttribute("class", "activetab");
}
