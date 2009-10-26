var admin_table;
var user_table;

$(document).ready(function() 
{
	$('li.headlink').hover(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'none'); });
	
	user_table = $('#user_table').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
	});
	
	admin_table = $('#admin_table').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
	});
	
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
	
	
	
	
	$('.pass_field_new').hide();
	
	$("input[name='pass_option_edit']").change(
		function()
		{
			var type = $("input[name='pass_option_edit']:checked").val();
			$('.pass_field_new').toggle();
			$('.pass_field_keep').toggle();
			$("input[name='pass_type_edit']").val(type);
		}
	);
	
	$("#start_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
	$("#end_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
	
	
	
	$("#course_add_admins").dialog({
			bgiframe: true,
			height: 500,
			width: 1015,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: {
				'Cancel': function() {
					$(this).dialog('close');
				},
				'Add Admins': function() {
				
					var data = $('input', admin_table.fnGetNodes()).serialize();
					
					if (data == '')
					{
						$("input[name='selected_admins']").val('none');
					}
					else
					{
						$("input[name='selected_admins']").val(data);
					}
				
					$(this).dialog('close');
				}}
	});
		
	$('#add_admins').click(function(data)
	{
		$("#course_add_admins").dialog("open");
	});
	
	
	$("#course_add_users").dialog({
			bgiframe: true,
			height: 500,
			width: 1015,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: {
				'Cancel': function() {
					$(this).dialog('close');
				},
				'Add Users': function() {

					var data = $('input', user_table.fnGetNodes()).serialize();

					if (data == '')
					{
						$("input[name='selected_users']").val('none');
					}
					else
					{
						$("input[name='selected_users']").val(data);
					}

					$(this).dialog('close');
				}}
	});
	
	$('#add_users').click(function(data)
	{
		$("#course_add_users").dialog("open");
	});


	$("#user_table input[name='select_user_all']").change
	(
		function()
		{
			$('td input', user_table.fnGetNodes()).attr({checked: 'checked'});
		}
	);
	
	$("#admin_table input[name='select_user_all']").change
	(
		function()
		{
			$('td input', admin_table.fnGetNodes()).attr({checked: 'checked'});
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