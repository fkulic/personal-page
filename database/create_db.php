<?php
$config = parse_ini_file("./db_config.ini");
$pdo = new PDO("mysql:host={$config["host"]};charset=utf8mb4", $config["username"], $config["password"]);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("CREATE DATABASE IF NOT EXISTS {$config["dbname"]}");

include "../includes/config.php";
$db = DbConnection::getInstance();

$sql = "CREATE TABLE IF NOT EXISTS `blog_posts` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(100) NOT NULL,
	`description` text,
	`content` text NOT NULL,
	`date` datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$db->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`username` varchar(32) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$db->query($sql);

$username = "fkulic";
$pw = "123123";
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
if (count($db->query($sql)->fetchAll()) === 0) {
	$password = password_hash($pw, PASSWORD_DEFAULT);
	$connection = $db->getConnection();
	$stmt = $connection->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
	$stmt->execute(array(
		":username" => $username,
		":password" => $password,
		":email" => "fkulic@mail.com"
	));
};
?>
