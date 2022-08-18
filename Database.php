<?php
require_once 'Singleton.php';

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
        echo "123456 " . getenv("MYSQL_USERNAME") .":".getenv("MYSQL_PASSWORD").":".getenv("MYSQL_DATABASE");
    }

    public function connect() {
        $this->db = new mysqli("localhost",$this->username,$this->password,$this->database);
    }

    public function close() {
        $this->db->close();
    }
    
    public function keyValEq($map) {
        $expr = "";
        foreach ($map as $key => $value) {
            if ($expr != "") $expr = $expr . ",";
            $expr = $expr . "'" . $key . "'='" . $value ."'";
        }
        return "(".$expr.")";
    }

    public function select($table, $values, $where="") {
        $this->connect();

        $vals = "";
        for( $i=0; $i < sizeof($values); $i++ ) {
            if ( $vals != "" ) $vals = $vals . ",";
            $vals = $vals . "'".$values[$i]."'";
        }

        $result = null;
        if ( $where != "" ) {
            $expr = $this->keyValEq($where);
            $result = $this->db->query("SELECT {$vals} FROM '{$table}' WHERE {$expr}");
        } else {
            $result = $this->db->query("SELECT {$vals} FROM '{$table}'");
        }

        $this->close();
        return $result;
    }

    public function update($table, $map) {
        $this->connect();
        $expr = $this->keyValEq($map);
        $result = $this->db->query("UPDATE '{$table}' SET {$expr};");
        $this->close();
    }
    
    public function insert($table, $map) {
        $this->connect();
        $keys = "";
        $vals = "";
        foreach ($map as $key => $value) {
            if ($keys != "") $keys = $keys . ",";
            if ($vals != "") $vals = $vals . ",";
            $keys = $keys . "'".$key."'";
            $vals = $vals . "'".$value."'";
        }
        $result = $this->db->query("INSERT INTO {$table} ({$keys}) VALUES ({$vals});");
        $this->close();
    }
}
?>