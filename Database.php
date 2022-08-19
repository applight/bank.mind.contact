<?php
require_once 'Singleton.php';

interface Transactions {
    public function select($table, $values="*", $where="");
    public function update($table, $map);
    public function insert($table, $map);
}

class Database implements Transactions {
    
    protected $db;
    public function connect() {
        $this->db = new mysqli("127.0.0.1",getenv("DB_USERNAME"),getenv("DB_PASSWORD"),getenv("DB_DATABASE"), 3306);
    }

    public function close() {
        $this->db->commit();
        $this->db->close();
    }

    public function keyValEq($map) {
        $expr = "";
        foreach ($map as $key => $value) {
            if ($expr != "") $expr = $expr . ",";
            $expr = $expr . $key . "='" . $value ."'";
        }
        return "(".$expr.")";
    }

    public function select($table, $values="*", $where="") {
        if ( is_array($values) ) {
            $values = "(" . implode(",", $values) . ")";
        }

        if ( !is_array($where) ) {
            $expr = $this->keyValEq($where);
            return $this->db->query("SELECT {$values} FROM {$table} WHERE {$expr}");
        } else {
            return $this->db->query("SELECT {$values} FROM {$table}");
        }
    }

    public function update($table, $map) {
        $expr = $this->keyValEq($map);
        return $this->db->query("UPDATE {$table} SET {$expr};");
    }
    
    public function insert($table, $map) {
        $keys = "";
        $vals = "";
        foreach ($map as $key => $value) {
            if ($keys != "") $keys = $keys . ",";
            if ($vals != "") $vals = $vals . ",";
            $keys = $keys . $key;
            $vals = $vals . "'".$value."'";
        }
        $keys = "(".$keys.")";
        $vals = "(".$vals.")";
        return $this->db->query("INSERT INTO {$table} {$keys} VALUES {$vals} ;");
    }
}

class AtomicDatabase extends Database implements Transactions {
    use Singleton;
    protected function __contruct() {
    }

    public function select($table, $values="*", $where="") {
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