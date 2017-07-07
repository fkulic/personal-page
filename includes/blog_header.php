<?php
require_once __dir__ . '/config.php';
$filePrefix = "";
if (file_exists("../css/blog_styles.css")) {
	$filePrefix = "../";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Filip Kulić | Blog</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $filePrefix; ?>css/blog_styles.css">
</head>
<body>
	<?php showAlert(); ?>
	<header class="center-vertical">
		<a id="backButton" href="<?php echo $filePrefix; ?>blog.php"><span class="glyphicon glyphicon-arrow-left"></span></a>
		<h1>Filip Kulić<small>my stories...</small></h1>
		<?php
		if ($user->isLoggedIn()) {
			?>
			<a id="logOut" href="<?php if($filePrefix == "") echo "admin/"; ?>logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a>
			<?php
		}
		?>
	</header>
