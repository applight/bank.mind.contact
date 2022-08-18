<?php
require_once 'Singleton.php';

interface Transactions {
    public function select($table, $values);
    public function update($table, $map);
    public function insert($table, $map);
}

class Database implements Transactions {
    
    protected $db;
    public function connect() {
        $this->db = new mysqli("127.0.0.1",getenv("DB_USERNAME"),getenv("DB_PASSWORD"),getenv("DB_DATABASE"));
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
        $vals = "";
        for( $i=0; $i < sizeof($values); $i++ ) {
            if ( $vals != "" ) $vals = $vals . ",";
            $vals = $vals . "'".$values[$i]."'";
        }

        if ( $where != "" ) {
            $expr = $this->keyValEq($where);
            return $this->db->query("SELECT {$vals} FROM '{$table}' WHERE {$expr}");
        } else {
            return $this->db->query("SELECT {$vals} FROM '{$table}'");
        }
    }

    public function update($table, $map) {
        $expr = $this->keyValEq($map);
        return $this->db->query("UPDATE '{$table}' SET {$expr};");
    }
    
    public function insert($table, $map) {
        $keys = "";
        $vals = "";
        foreach ($map as $key => $value) {
            if ($keys != "") $keys = $keys . ",";
            if ($vals != "") $vals = $vals . ",";
            $keys = $keys . "'".$key."'";
            $vals = $vals . "'".$value."'";
        }
        return $this->db->query("INSERT INTO {$table} ({$keys}) VALUES ({$vals});");
    }
}

class AtomicDatabase extends Database implements Transactions {
    use Singleton;
    protected function __contruct() {
    }

    public function select($table, $values, $where="") {
        $this->connect();
        $result = parent::select($table, $values, $where);
        $this->close();
        return $result;
    }

    public function update($table, $map) {
        $this->connect();
        $result = parent::update($table, $map);
        $this->close();
        return $result;
    }
    
    public function insert($table, $map) {
        $this->connect();
        $result = parent::insert($table, $map);
        $this->close();
        return $result;
    }
}
?>