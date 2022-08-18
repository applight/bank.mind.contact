<?php
trait Singleton {
    private static $instance = null;
    public static function getInstance() {
        if ( self::$instance == null ) self::$instance = new static();
        return self::$instance;
    }
}
?>