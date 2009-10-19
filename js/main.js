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
	
	$("#registration_form").validate({
		submitHandler: function(e) {
			$.post("main/register", { email: $("#email").val(), password: $("#password").val() }, function(data) {
				if (data == 'invalid_login')
				{
					$("#login_button").after('<br>Invaild Email Address/Password');
				}
				else
				{
					$("#container").load(data);
				}
			});
		}
	});
	
	$("#test_button").live('click', function(e) {
		e.preventDefault();
		alert("test clicked");
	});
});