<html>
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	</head>
	<body>
		<div class="navbar navbar-fixed-top">  
			<div class="navbar-inner">  
				<div class="container">  
					<span class="brand">filmbuddies.co.za</span>  				
					<div class="nav-collapse">  
						<ul class="nav">  
							<li class="active"><a href="#">Home</a></li>  
							<li><a href="#about">About</a></li>  
							<li><a href="#contact">Contact</a></li>  
						</ul>  
						<form class="navbar-search pull-left">  
							<input type="text" class="search-query" placeholder="Search">  
						</form>					
					</div>
				</div> 
			</div>  
		</div>  
		<div class="container">  
			<div style="height:50;"><!-- spacer --></div>

			<div class="well">
				<h3>You are not logged in.</h3>
				You may search for movies, but you may not contribute unless you log in.
				Please select an option below.
			</div>
			
			<div class="row">
				<div class="span4">  
					<h2>Log in</h2>
					<form name="login_form">
						<label>E-mail</label>
						<input type="text"/>
						<label>Password</label>
						<input type="password"/>
						<p><a class="btn btn-success" href="login.php">Log In</a></p>						
					</form>
				</div>  
				<div class="span4">  
					<h2>New User?</h2>  
					<p><a class="btn btn-danger btn-large" href="register.php">Register Now</a></p>  
				</div>
				<div class="span4">
					Ad block
				</div>
			</div>  
			<hr>  
			<footer>  
				<p>© filmbuddies.co.za 2012</p>  
			</footer>  
		</div>
	</body>  
</html>  