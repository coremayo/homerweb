$(document).ready(function() 
{
	$('li.headlink').hover(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'none'); });
	
	$('#table').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
	});
	
	if ($('.success').length)
	{
		$(this).delay(3000, function()
		{
			$('.success').fadeOut(2500);
		});
	}
	
	var randomPass = randomPassword(20);
	$('.pass_check').hide();
	$('.pass_field_manual').hide();
	$('.pass_field_random').html('<input type="hidden" name="password_random" value="' + randomPass + '" />' + randomPass);
	
	$("input[name='pass_option']").change(
		function()
		{
			var randomPass = randomPassword(20);
			var type = $("input[name='pass_option']:checked").val();
			$('.pass_check').toggle();
			$('.pass_field_manual').toggle();
			$('.pass_field_random').toggle();
			$('.pass_field_random').html('<input type="hidden" name="password_random" value="' + randomPass + '" />' + randomPass);
			$("input[name='pass_type']").val(type);
		}
	);
	
	$('.send_email').hide();
	$("input[name='email_subject']").val('Welcome to Chicago Board Review Online');
	$("textarea[name='email_message']").val('Chicago Board Review has sent you this email because an administrator has created an account registered to this email address. To use this account log into http://localhost/homerweb with the following credentials:\r\rEmail: {email}\rPassword: {password}');
	
	$("input[name='email_option']").change(
		function()
		{
			$('.send_email').toggle();
		}
	);
	
	function randomPassword(length)
	{
	   chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	   pass = "";
	
	   for(x = 0; x < length; x++)
	   {
		  i = Math.floor(Math.random() * 62);
		  pass += chars.charAt(i);
	   }
	
	   return pass;
	}
});