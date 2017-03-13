{extends file="include/master.tpl"}

{block name=body}
<div class="container feedback-page">
	<form action="/api/feedback.php" method="post">
		<h4>Leave Feedback for the class:</h4>
		<input type="hidden" value="{$session_id}" name="session-id" />
		<div class="form-group">
			<label for="feedback-msg">Your message:</label>
			<textarea class="form-control" name="feedback-message" id="feedback-msg">{if $feedback_temp_message}{$feedback_temp_message}{/if}</textarea>
		</div>

		{if $error_message}
		<div class="alert alert-danger">{$error_message}</div>
		{/if}

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
{/block}