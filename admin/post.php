<?php
include '../includes/blog_header.php';
if (!($user->isLoggedIn())) {
	redirectTo("../blog.php");
}

if (isset($_GET["action"])) {
	$action = $_GET["action"];
	if ($action == "edit" && isset($_GET["id"])) {
		if (!($article = DbBlogHelper::getPostById($_GET["id"]))) {
			redirectTo("../blog.php");
		}
	} elseif ($action == "new") {
		$article["title"] = "";
		$article["description"] = "";
		$article["content"] = "";
	} else {
		redirectTo("../blog.php");
	}
} else {
	redirectTo("../blog.php");
}

if (isset($_POST["submit"])) {
	if ($action == "edit") {
		$result = DbBlogHelper::editPost($_GET["id"], $_POST["postTitle"], $_POST["postDescription"], $_POST["postContent"]);
		$result ? setAlert("info","Post \"{$_POST["postTitle"]}\" successfully edited.") : setAlert("danger", "Something went wrong.");
	} elseif ($action == "new") {
		DbBlogHelper::newPost($_POST["postTitle"], $_POST["postDescription"], $_POST["postContent"]);
		setAlert("success","Post \"{$_POST["postTitle"]}\" successfully created.");
	}
	redirectTo("../blog.php");
}

?>

	<div class="wholePost">
		<div class="card">
			<form id="postAddEdit" action='' method='post'>
				<label for="postTitle">Title</label>
				<input type="text" class="form-control" name="postTitle" value="<?php echo $article["title"];?>" required autofocus>
				<label for="postDescription">Description</label>
				<textarea type="text" class="form-control" name="postDescription" required><?php echo $article["description"];?></textarea>
				<label for="postContent">Content</label>
				<textarea rows="10" type="text" class="form-control" name="postContent" required><?php echo $article["content"];?></textarea>
				<div class="control">
					<a id="cancelButton" href="../blog.php" class="btn btn-lg btn-primary" type="cancel" name="cancel"><span class="glyphicon glyphicon-remove"></span></a>
					<button class="btn btn-lg btn-primary" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span></button>
				</div>
			</form>
		</div>
	</div>
<?php include '../includes/blog_footer.php'; ?>
