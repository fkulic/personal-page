<?php
include './includes/blog_header.php';
?>

	<div class="wholePost">
		<?php
		$post = DbBlogHelper::getPostById($_GET["id"]);
		if ($post) {
			$article = "<article class=\"card\">\n\t\t\t";
			$article .= "<h2>" . $post["title"] . "</h2>\n\t\t\t";
			$article .= "<p class=\"postDate\">" . $post["date"] . "</p>\n\t\t\t";
			$article .= "<p class=\"postDescription\">" . $post["description"] . "</p>\n\t\t\t";
			$article .= "<p class=\"postContent\">" . $post["content"] . "</p>\n\t\t";
			if ($user->isLoggedIn()) {
				$article .= "\t<div class=\"adminControls\">\r\n\t\t\t";
				$article .= "\t<a href=\"admin/post.php?action=edit&amp;id=" . $post["id"] ."\">";
				$article .= "<span class=\"glyphicon glyphicon-pencil\"></span>";
				$article .= "</a>\r\n\t\t\t\t\t";
				$article .= "\t<a>";;
				$article .= "<span class=\"glyphicon glyphicon-trash\"></span>";
				$article .= "</a>\r\n\t\t";;
				$article .= "\t</div>\r\n\t\t";
			}
			$article .= "</article>\n";
			echo $article;
		} else {
			setAlert("warning", "Couldn't find post.");
			header("Location: blog.php");
			die();
		}
		?>
	</div>

<?php include './includes/blog_footer.php';?>
