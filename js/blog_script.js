$(function(){
	$('.grid').masonry({
		columnWidth: '.item',
		itemSelector: '.item'
	});

	if($(".wholePost").length) {
		$("#backButton").css("display", "block");
	}

	$(".adminControls a").has("span.glyphicon-trash").click(function(e) {
		$(".modal").modal("show");
		var clickedPostId = $(this).parent().parent().find(".readMore a").attr("href").split("=")[1];
		$("#deletePostButton").attr("href", "admin/delete_post.php?id=" + clickedPostId);
	});
});
