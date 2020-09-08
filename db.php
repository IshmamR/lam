<?php
	session_start();
	// $_SESSION['admin'] = 0;

	$db = mysqli_connect("localhost", "root", "", "crud");

	$id = 0;
	$name = "";
	$email = "";
	$message = "";
	$_SESSION['color1'] = 'dark';
	$_SESSION['color2'] = 'dark';
	$_SESSION['color3'] = 'dark';

	// Submitting
	if (isset($_POST['submit'])) {
		if (empty($_POST['name'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			$_SESSION['color1'] = 'danger';
			echo "<script> alert('What is your name?') </script>";
			// header('Location: index.php');
			// die();
		} else if (empty($_POST['email'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			$_SESSION['color2'] = 'danger';
			echo "<script> alert('Please fill up your email '); </script>";
			// header('Location: index.php');
		} else if (empty($_POST['message'])) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			$_SESSION['color3'] = 'danger';
			echo "<script> alert('Do not leave a blank message ._. '); </script>";
			// header('Location: index.php');
		} else {
			unset($_POST['submit']);
			print_r($_POST);

			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$message = htmlspecialchars($_POST['message']);

			$name = mysqli_real_escape_string($db, $name);
			$email = mysqli_real_escape_string($db, $email);
			$message = mysqli_real_escape_string($db, $message);

			$sql = "INSERT into messages (name, email, message) VALUES ('$name', '$email', '$message')";

			mysqli_query($db, $sql) or die(mysqli_error());

			header("Location: index.php");
		}
	}

	function selectAll()
	{
		GLOBAL $db;
		$sql = "SELECT * FROM messages ORDER BY id DESC";

		$result = mysqli_query($db, $sql) or die(mysqli_error());
		return $result;
	}

	// FOR ADMIN LOGIN 
	$username = 'admin';
	$password = 'admin';
	
	if (isset($_POST['admin-sub'])) {
		if ($_POST['username'] === $username && $_POST['password'] === $password) {
			$_SESSION['admin'] = 1;
		}
		else {
			$_SESSION['admin'] = 0;
			echo "<script>";
			echo "alert('You are not authorized.')";
			echo "</script>";
		}
	}

	if (isset($_GET['out'])) {
		$_SESSION['admin'] = 0;
	}

	// EDIT
	if (isset($_GET['ed_id'])) {
		$edit_id = $_GET['ed_id'];
		$sql = "SELECT * FROM messages WHERE id='$edit_id'";
		
		$result = mysqli_query($db, $sql);
		$data = mysqli_fetch_assoc($result);
		
		$id = $data['id'];
		$name = $data['name'];
		$email = $data['email'];
		$message = $data['message'];
	}

	if (isset($_POST['update'])) {
		unset($_POST['update']);
		
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		// UPDATE `messages` SET `message` = 'Test 3 updated test' WHERE `messages`.`id` = 3;
		$sql = "UPDATE messages SET name='$name', email='$email', message='$message' WHERE id='$id'";
		mysqli_query($db, $sql);

		header("Location: index.php");
	}

	// DELETE 
	if (isset($_GET['del_id'])) {
		$delete_id = $_GET['del_id'];

		$sql = "DELETE FROM messages WHERE id='$delete_id'";
		mysqli_query($db, $sql);

		header("Location: index.php");
	}
?>