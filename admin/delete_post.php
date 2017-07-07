<?php
require_once '../includes/config.php';
if ($user->isLoggedIn()) {
	if (isset($_GET["id"])) {
		if(DbBlogHelper::deletePost($_GET["id"])) {
			setAlert("info", "Post succesfully deleted.");
		} else {
			setAlert("warning", "Something went wrong.");
		}

	}
}
redirectTo("../blog.php");
?>
