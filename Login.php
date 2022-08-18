<?php
require_once 'Singleton.php';
require_once 'Database.php';

class Login {
    use Singleton;

    protected $db;
    protected function __construct() {
        session_start();
        $this->db = AtomicDatabase::getInstance();
    }

    public function loggedIn() {
        if ( isset($_SESSION) && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) return true;
        else return false;
    }

    public function logOut() {
        unset($_SESSION['loggedIn']);
    }

    public function logIn($email, $password) {
        if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $userdata = $this->db->select('users', 
            array('first_name','last_name', 'phone'), 
            array('email' => $email, 'password' => $hash)
        );
        
        if ( $userdata != null && $userdata != false ) {
            $userdata_arr = $userdata->fetch_row();
            $_SESSION['loggedIn']   = true;
            $_SESSION['email']      = $email;
            $_SESSION['firstname']  = $userdata_arr['first_name'];
            $_SESSION['lastname']   = $userdata_arr['last_name'];
            $_SESSION['phone']      = $userdata_arr['phone'];
            return true;
        } else {
            return false;
        }
    }
}
?>