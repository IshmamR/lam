<?php
	include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LaM</title>

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
			border-style: solid;
		}
		.form-field:focus {
			outline: none;
			background-color: rgba(250,250,250,0.5)
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
			<?php if ($_SESSION['admin'] != 0): ?>
				<a href="index.php?out" class="text-decoration-none"><b>Logout</b></a>
			<?php else: ?>
				<a href="login.php" class="text-decoration-none"><b>Login</b></a>
			<?php endif; ?>
		</div>
	</header>
	
	<div class="main">
	<div class="container my-3">
		<h2>Leave a message</h2>
		<form class="d-flex flex-column justify-content-around px-5" action="index.php" method="post">
			<input type="text" name="id" value="<?php echo($id); ?>" hidden>
			Name:
			<input class="form-field border-<?php echo($_SESSION['color1']);?>" type="text" name="name" value="<?php echo($name); ?>" /><br>
			E-mail:
			<input class="form-field border-<?php echo($_SESSION['color2']);?>" type="email" name="email" value="<?php echo($email); ?>" /><br>
			Message:
			<textarea class="form-field border-<?php echo($_SESSION['color3']);?>" rows="4" maxlength="255" name="message" title="255 chars max."><?php echo($message); ?></textarea>
				<?php if (isset($_GET['ed_id'])): ?>
					<button class="btn btn-primary mt-3 submit" type="submit" name="update">
						Update
					</button>
				<?php else: ?>
					<button class="btn btn-primary mt-3 submit" type="submit" name="submit">
						Submit
					</button>
				<?php endif; ?>
		</form>
	</div>

	<div class="container mt-3">
		<h1>All messages</h1>
		<table class="table table-responsive table-dark table-striped table-hover text-light">
			<tr>
				<th>Name</th>
				<th>Message</th>
				<th>E-mail</th>
				<th>Date</th>
				
				<?php if ($_SESSION['admin'] == 1): ?>
					<th colspan="2">Actions</th>
				<?php endif ?>
			</tr>
			<tr>
				<td>Ishmam</td>
				<td>Hello! Welcome to LaM. Leave any message you want to. ^^</td>
				<td>ishmam785@gmail.com</td>
				<td>2020-08-17 02:45:35</td>				
			</tr>
			
			<?php
				$result = selectAll();
				$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

				for($i = 0; $i < mysqli_num_rows($result); $i++) { 
			?>
			<tr>
				<td><?php echo($row[$i]['name']); ?></td>
				<td style="width: 100%;"><?php echo($row[$i]['message']); ?></td>
				<td><?php echo($row[$i]['email']); ?></td>
				<td><?php echo($row[$i]['created_at']); ?></td>
				
				<?php if ($_SESSION['admin'] == 1): ?>
					<td>
						<a href="index.php?ed_id=<?php echo($row[$i]['id']);?>" class="btn btn-success">Edit</a>
					</td>
					<td>
						<a href="index.php?del_id=<?php echo($row[$i]['id']);?>" class="btn btn-danger">Delete</a>
					</td>
				<?php endif; ?>
			</tr>
			<?php } ?>
		</table>
	</div>
	</div>
	<footer class="footer text-center">
		Developed by Ishmam 
	</footer>

	<!-- <script type="text/javascript">
		console.log("");
	</script> -->
</body>
</html>