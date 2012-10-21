<html>
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	</head>
	<body>
			<?php include "header.html" ?>
	
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
		<?php include "footer.html" ?>
		
	</body>  
</html>  