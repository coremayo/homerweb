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
	
	/* Add a click handler to the rows - this could be used as a callback */
	$("#user_sub tbody").click(function(event) {
		$(oTable.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('row_selected');
		});
		$(event.target.parentNode).addClass('row_selected');
	});
	
	/* Add a click handler for the extend row */
	$('#extend').click( function() {
		var anSelected = fnGetSelected( oTable );
		var iRow = oTable.fnGetPosition( anSelected[0] );
		var aData = oTable.fnGetData( iRow );
		window.location = "./subscriptions/extensions/" + aData[0];
	} );
	
});

/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();
	
	for ( var i=0 ; i<aTrs.length ; i++ )
	{
		if ( $(aTrs[i]).hasClass('row_selected') )
		{
			aReturn.push( aTrs[i] );
		}
	}
	return aReturn;
}
