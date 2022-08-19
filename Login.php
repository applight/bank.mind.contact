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

        $userdata = $this->db->select('users', 
            'password,first_name,last_name,phone', 
            array('email'=>$email)
        );

        if ( $userdata != null && $userdata != false ) {
            $userdata_arr = $userdata->fetch_row();
            if (password_verify($password, $userdata_arr[0]) ) {
                $_SESSION['loggedIn']   = true;
                $_SESSION['email']      = $email;
                $_SESSION['firstname']  = $userdata_arr[1];
                $_SESSION['lastname']   = $userdata_arr[2];
                $_SESSION['phone']      = $userdata_arr[3];
                return $userdata_arr;
            } else {
                return $userdata_arr;
            }
        } else {
            return false;
        }
    }
}
?>