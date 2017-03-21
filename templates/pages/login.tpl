{extends file="include/master.tpl"}

{block name=body}
<div class="login-clean">
	<form method="post" action="/api/auth.php">
		<h2 class="sr-only">Login Form</h2>
		<div class="illustration">
			<i class="icon ion-ios-paper-outline" data-bs-hover-animate="bounce"></i>
		</div>
		<div class="form-group">
			<input class="form-control" type="email" name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<input class="form-control" type="password" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block" name="login-btn" type="submit">Log In</button>
		</div>
	</form>
</div>
{/block}