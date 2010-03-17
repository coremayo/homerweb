$(document).ready(function() 
{
	$('li.headlink').hover(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'none'); });
	
	if ($('.success').length)
	{
		$(this).delay(3000, function()
		{
			$('.success').fadeOut(2500);
		});
	}
});