<?php
ob_start();
session_start();
date_default_timezone_set("Europe/Zagreb");

// autoloader for classses
function __autoload($class) {
	$classPath = "./classes/class." . strtolower($class) . ".php";
	if (file_exists($classPath)) {
		require_once $classPath;
	}

	$classPath = "." . $classPath;
	if (file_exists($classPath)) {
		require_once $classPath;
	}
}
$user = new User(DbConnection::getInstance()->getConnection());

// helper functions
function mysqlDateToString($mysqlDate) {
	$mysqlDate = strtotime($mysqlDate);
	return date("j M Y H:i", $mysqlDate);
}

function redirectTo($location) {
	header("Location: " . $location);
	exit();
}

function showAlert() {
	if (isset($_SESSION["alert_type"]) && isset($_SESSION["alert_msg"])) {
		$alert = "<div class=\"alert alert-{$_SESSION["alert_type"]} alert-dismissable\">\r\n\t";
		$alert .= "<a class=\"close\" data-dismiss=\"alert\">&times;</a>\r\n\t";
		$alert .= $_SESSION["alert_msg"] . "\r\n\t";
		$alert .= "</div>\r\n";
		unsetAlert();
		echo $alert;
	}
}

function setAlert($type, $msg) {
	$_SESSION["alert_type"] = $type;
	$_SESSION["alert_msg"] = $msg;
}

function unsetAlert() {
	unset($_SESSION["alert_type"]);
	unset($_SESSION["alert_msg"]);
}
?>
