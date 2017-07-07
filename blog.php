<?php
include './includes/blog_header.php';
?>
	<div class="container">
		<div class="row grid">
			<?php
			// Display posts
			$articles = DbBlogHelper::getPosts();
			if ($articles) {
				foreach ($articles as $article) {
					$linkToPost = "./view_post.php?id=" . $article["id"];
					$blogPost = "<div class=\"col-lg-4 col-md-6 col-xs-12 item\">\r\n\t\t\t\t";
					$blogPost .= "<article class=\"blogPost card\">\r\n\t\t\t\t\t";
					$blogPost .= "<h3><a href=\"" . $linkToPost . "\">" . $article["title"] ."</a></h3>\r\n\t\t\t\t\t";
					$blogPost .= "<p class=\"postDate\">" . $article["date"] . "</p>\r\n\t\t\t\t\t";
					$blogPost .= "<p class=\"postDescription\">" . $article["description"] ."</p>\r\n\t\t\t\t\t";
					$blogPost .= "<p class=\"readMore\"><a href=\"" . $linkToPost . "\">Read more...</a></p>\r\n\t\t\t\t";
					if ($user->isLoggedIn()) {
						$blogPost .= "\t<div class=\"adminControls\">\r\n\t\t\t\t\t";
						$blogPost .= "\t<a href=\"admin/post.php?action=edit&amp;id=" . $article["id"] ."\">";
						$blogPost .= "\t<span class=\"glyphicon glyphicon-pencil\"></span>";
						$blogPost .= "\t</a>\r\n\t\t\t\t\t";
						$blogPost .= "\t<a>";;
						$blogPost .= "\t<span class=\"glyphicon glyphicon-trash\"></span>";
						$blogPost .= "\t</a>\r\n\t\t\t\t";;
						$blogPost .= "\t</div>\r\n\t\t\t\t";
					}
					$blogPost .= "</article>\r\n\t\t\t";
					$blogPost .= "</div>\r\n\t\t\t";
					echo $blogPost;
				}
			} else {
				// do Something
			}
			echo "\n";
			?>
		</div>
	</div>
<?php
if ($user->isLoggedIn()) {
	include './includes/modal_dialog.php';
	?>
	<a href="admin/post.php?action=new" class="floating-button"><span class="glyphicon glyphicon-plus"></span></a>
	<?php
}
include './includes/blog_footer.php';
?>
