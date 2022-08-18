<?php
require_once 'Singleton.php';

class Login {
    use Singleton;
    protected function __construct() {
        session_start();
    }

    public function loggedIn() {
        if ( isset($_SESSION) && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) return true;
        else return false;
    }

    public function logOut() {
        unset($_SESSION['loggedIn']);
    }

    public function logIn($username, $password) {
        $this->hash($password);
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        return true;
    }
}
?>