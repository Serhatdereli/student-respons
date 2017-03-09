{extends file="include/master.tpl"}

{block name=body}
<form action="/api/feedback.php" method="post">
	<input type="hidden" value="{$session_id}" name="session-id" />
	<textarea name="feedback-message"></textarea>
	<button type="submit">Submit</button>
</form>
{/block}