$(document).ready(function()
{
	// Create new session button
	var SESSION_AJAX_PENDING = false;
	var createSessionBtn = $('button#create-session');
	createSessionBtn.on('click', function()
	{
		var expireHours = parseInt(prompt('How many hours should the session last?'), 10);
		var description = prompt('Write a short description for your session:');

		console.log(expireHours, description);

		if (expireHours > 0)
		{

			if (!SESSION_AJAX_PENDING)
			{
				SESSION_AJAX_PENDING = true;

				var d = new Date(Date.now());
				d.setUTCHours(d.getUTCHours() + expireHours);
				var expires = Math.floor(d.getTime() / 1000);

				description = encodeURIComponent(description);

				var ajaxUrl = ' /api/session.php?method=create&expires=' + expires + '&desc=' + description;
				$.getJSON(ajaxUrl, function(data)
				{
					console.warn(data);
					if (data.success === true)
					{
						window.location = window.location;
					}
					else
					{
						alert('An error occured: ' + data.error_message);
					}

					SESSION_AJAX_PENDING = false;
				});
			}
		}
	});
});