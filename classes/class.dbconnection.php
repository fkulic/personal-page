<?php
class DbConnection {
	private static $instance;
	private $connection;

	public function __construct() {
		$iniFile = str_replace("\\", "/", __DIR__ . "/../database/db_config.ini");
		$config = parse_ini_file($iniFile);
		$this->connection = new PDO("mysql:host={$config["host"]};dbname={$config["dbname"]};charset=utf8mb4",
		$config["username"], $config["password"]);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::query("SET NAMES utf8");
	}

	public function getInstance() {
		if(self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getConnection() {
		return $this->connection;
	}

	public function query($sql){
		return $this->connection->query($sql);
	}

    private function __clone(){}
}
?>
