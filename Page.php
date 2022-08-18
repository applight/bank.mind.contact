<?php
require_once 'Singleton.php';
require_once 'Login.php';
require_once 'Database.php';

class Page {
    use Singleton;

    protected $login;
    protected $db;
    
    protected function __construct() {
        $this->login = Login::getInstance();
        $this->db    = AtomicDatabase::getInstance();
    }

    protected $title = "Mind Contact";
    
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