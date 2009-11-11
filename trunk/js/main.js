$(document).ready(function() 
{
	$("#login_form").validate({
		submitHandler: function(e) {
		    $.post("main/login", { email: $("#email").val(), password: $("#password").val() }, function(data) {
				if (data == 'invalid_login')
				{
					$("#login_button").after('<br>Invaild Email Address/Password');
				}
				else
				{
					document.location = data;
				}
			});
		}
	});
	
	
//	$("#registration_form").validate({
//		submitHandler: function(e) {
//			$.post("register/adduser", { email: $("#email").val(), password: $("#password").val() }, function(data) {
//				if (data == 'invalid_login')
//				{
//					$("#login_button").after('<br>Invaild Email Address/Password');
//				}
//				else
//				{
//					$("#container").load(data);
//            $("#login_button").after(data);
//				}
//			});
//		}
//	});
	
	$("#test_button").live('click', function(e) {
		e.preventDefault();
		alert("test clicked");
	});
	
});

function changeClass(id){
document.getElementById(id).setAttribute("class", "activetab");
}

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