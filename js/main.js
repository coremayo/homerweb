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
	
	$("#forgotPassword_form").validate();
	
	$('#public_courses').dataTable( {
				"aaSorting": [[ 2, "desc" ]]
	});
});
	
function changeClass(id){
document.getElementById(id).setAttribute("class", "activetab");
}