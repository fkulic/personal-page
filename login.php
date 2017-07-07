<?php
include './includes/config.php';
$loginError = false;

if (isset($_POST["submit"])) {
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);

	if ($user->login($username, $password)) {
		unsetAlert();
		header("Location: blog.php");
		exit();
	} else {
		setAlert("danger", "Wrong username or password.");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Filip Kulić | Login </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/blog_styles.css">
</head>
<body>
	<?php showAlert(); ?>
	<section id="loginForm" class="card">
		<form action="" method="post">
			<h2>Log in</h2>
			<input type="text" id="inputEmail" class="form-control" name="username" placeholder="Username" required autofocus>
			<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Log in</button>
		</form>
	</section>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>
