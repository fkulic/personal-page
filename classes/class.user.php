<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function isLoggedIn(){
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            return true;
        }
    }

    public function logIn($username, $password) {
        $hash = $this->getHash($username);
        if(password_verify($password, $hash)) {
            $_SESSION["loggedin"] = true;
            return true;
        }
    }

    public function logOut(){
        session_destroy();
    }

    private function getHash($username) {
        try {
            $stmt = $this->db->prepare("SELECT password FROM users WHERE username = :username");
            $stmt->execute(array("username" => $username));

            $row = $stmt->fetch();
            return $row["password"];

        } catch(PDOException $e) {
            // echo $e->getMessage();
        }
    }
}
?>
