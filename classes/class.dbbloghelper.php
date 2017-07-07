<?php
class DbBlogHelper extends DbConnection {
	public function __construct() {
		parent::__construct();
	}

	public function getPosts() {
		$db = parent::getInstance();
		try {
			$stmt = $db->query("SELECT id, title, description, date FROM blog_posts ORDER BY id DESC") ;
			$posts = array();
			while ($row = $stmt->fetch()) {
				$row["date"] = mysqlDateToString($row["date"]);
				array_push($posts, $row);
			}
			return $posts;

		} catch (PDOException $e) {
			// echo $e->getMessage();
		}
		return false;
	}

	public function newPost($title, $description, $content) {
		$connection = parent::getInstance()->getConnection();
		try {
			$stmt = $connection->prepare("INSERT INTO blog_posts (title, description, content, date) VALUES (:title, :description, :content, :date)") ;
			return $stmt->execute(array(
				":title" => $title,
				":description" => $description,
				":content" => $content,
				":date" => date("Y-m-d H:i:s")
			));
		} catch (PDOException $e) {
			// echo $e->getMessage();
		}
		return false;
	}

	public function editPost($id, $title, $description, $content) {
		$connection = parent::getInstance()->getConnection();
		try {
			$stmt = $connection->prepare("UPDATE blog_posts SET title = :title, description = :description, content = :content WHERE id = :id") ;
			return $stmt->execute(array(
				":title" => $title,
				":description" => $description,
				":content" => $content,
				":id" => $id
			));
		} catch (PDOException $e) {
			// echo $e->getMessage();
		}
		return false;
	}

	public function getPostById($id) {
		$connection = parent::getInstance()->getConnection();
		try {
			$stmt = $connection->prepare("SELECT id, title, description, content, date FROM blog_posts WHERE id = :id") ;
			$stmt->execute(array(":id" => $id));
			$article = $stmt->fetch();
			if (isset($article["title"])) {
				$article["date"] = mysqlDateToString($article["date"]);
				return $article;
			}
			return false;
		} catch (PDOException $e) {
			// echo $e->getMessage();
		}
	}

	public function deletePost($id) {
		$connection = parent::getInstance()->getConnection();
		try {
			$stmt = $connection->prepare("DELETE FROM blog_posts WHERE id = :id") ;
			return $stmt->execute(array(":id" => $id));

		} catch (PDOException $e) {
			// echo $e->getMessage();
		}
	}
}
?>
