<?php

trait Singleton {
    private static $instance = null;
    public static function getInstance() {
        if ( self::$instance == null ) self::$instance = new static();
        return self::$instance;
    }
}

interface Database {
    public function connect();
    public function close();
    public function select($table, $values);
    public function update($table, $map);
    public function insert($table, $map);
}

class AtomicDatabase implements Database {
    use Singleton;
    
    private $username;
    private $password;
    private $database;

    private $db;

    protected function __contruct() {
        $this->username = getenv("MYSQL_USERNAME");
        $this->password = getenv("MYSQL_PASSWORD");
        $this->database = getenv("MYSQL_DATABASE");
    }

    public function connect() {
        $this->db = new mysqli("localhost",$this->username,$this->password,$this->database);
    }

    public function close() {
        $this->db->close();
    }
    
    public function select($table, $values) {
        $this->connect();
        $vals = "";
        for( $i=0; $i < sizeof($values); $i++ ) {
            $vals = $vals . $values[$i];
            if ( $i != sizeof($values) - 1 ) $vals = $vals . ",";
        }
        $result = $this->db->query("SELECT {$vals} FROM {$table}");
        $this->close();
        return $result;
    }
    
    public function update($table, $map) {
        $this->connect();
        $expr = "";
        foreach ($map as $key => $value) {
            if ($expr != "") $expr = $expr . ",";
            $expr = $expr . $key . "=" . $value;
        }
        $result = $this->db->query("UPDATE {$table} SET ({$expr});");
        $this->close();
    }
    
    public function insert($table, $map) {
        $this->connect();
        $keys = "";
        $vals = "";
        foreach ($map as $key => $value) {
            if ($keys != "") $keys = $keys . ",";
            if ($vals != "") $vals = $vals . ",";
            $keys = $keys . $key;
            $vals = $vals . $value;
        }
        $result = $this->db->query("INSERT INTO {$table} ({$keys}) VALUES ({$vals});");
        $this->close();
    }
}

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

class Page {
    use Singleton;
    protected function __construct() {}

    protected $title = "Title";

    public function setTitle( $title ) {
        $this->title = $title;
    }

    public function html() {
        return "<!DOCTYPE HTML><html>" . $this->head() . $this->body() . "</html>";
    }

    public function head() {
        return "<head><title>" . $this->title(). "</title><meta charset=\"utf-8\" />"
        . "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=no\" />"
        . "<link rel=\"stylesheet\" href=\"assets/css/main.css\" /></head>" ;
    }

    public function title() {
        return $this->title;
    }

    public function body() {
        return "<body class=\"landing is-preload\"><div id=\"page-wrapper\">" 
        . $this->nav()
        . $this->main()
        . "</div></body>";
    }

    public function nav() {
        return '<header id="header" class="alt"><h1>Dollar up!<a href="https://mind.contact">&nbsp;Mind Contact</a></h1>'
        . '<nav id="nav"><ul>'
        . '<li><a href="index.php">Home</a></li>'
        . '<li><a href="#" class="icon solid fa-angle-down">Accounts</a>'
        . '<ul>'
        . '<li><a href="generic.html">Main 1234</a></li>'
        . '<li><a href="contact.html">Savings</a></li>'
        . '<li><a href="elements.html">Joint</a></li>'
        . '<li>'
        . '<a href="#">Cards</a>'
        . '<ul><li><a href="#">Debit</a></li>'
        . '<li><a href="#">Credit</a></li>'
        . '</ul></li></ul></li>'
        . '<li><a href="signup" class="button">Sign Up</a></li></ul></nav></header>';
    }

    public function main() {
        return "";
    }
    
}

?>