<?php
	include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin log-in</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style type="text/css">
		.main {
			min-height: 87vh;
		}
		.submit {
			width: 10%;
			align-self: flex-end;
		}
		.form-field {
			background-color: rgba(200,200,200,0.2);
			color: #EEE;
		}
		.footer {
			background: #222;
			padding: 5px;
		}
	</style>
</head>
<body class="bg-dark text-light">
	<header class="header bg-light">
		<div class="container d-flex justify-content-between align-items-center">
			<a href="index.php"><h3 class="text-secondary"><u>LaM</u></h3></a>
			<a href="index.php" class="text-decoration-none"><b>Home</b></a>
		</div>
	</header>
	<div class="container main mt-3">
		<div class="container">
			<form class="d-flex flex-column justify-content-around px-5" action="index.php" method="post">
				Username:
				<input class="form-field" type="text" name="username" /><br>
				Password:
				<input class="form-field" type="password" name="password" /><br>
				<button class="btn btn-primary mt-3 submit" type="submit" name="admin-sub">Enter</button>
			</form>
		</div>
	</div>
	<div class="bg-danger text-center">
		!Only for admin login!
	</div>
	<footer class="footer text-center">
		Developed by Ishmam 
	</footer>
</body>
</html>