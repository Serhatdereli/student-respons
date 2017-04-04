<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />

	<title>Student Response Club</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="https://daneden.github.io/animate.css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="/assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top navigation-clean-button">
		<div class="container">
			<div class="navbar-header"><a class="navbar-brand navbar-link" href="/">Student Response</a>
				<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
			</div>
			<div class="collapse navbar-collapse" id="navcol-1">
				<ul class="nav navbar-nav">
					<li class="active" role="presentation"><a href="#">Home </a></li>
					<li role="presentation"><a href="#">Active Sessions</a></li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li role="presentation"><a href="#">First Item</a></li>
							<li role="presentation"><a href="#">Second Item</a></li>
							<li role="presentation"><a href="#">Third Item</a></li>
						</ul>
					</li>
				</ul>
				<p class="navbar-text navbar-right actions">
					<a class="btn btn-primary" role="button" href="/login">Login</a>
					<a class="btn btn-primary" role="button" href="/signup">Sign Up</a>
					<a class="btn btn-primary" role="button" href="/logout">Log Out</a>
				</p>
			</div>
		</div>
	</nav>
	<script src="/assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/assets/js/bs-animation.js" type="text/javascript"></script>
	<script src="/assets/js/scripts.js" type="text/javascript"></script>
	{block name=js}{/block}
	{block name=body}{/block}
</body>
</html>