<?php
require_once 'Database.php';

if (    !isset($_POST['firstname']) || !isset($_POST['lastname']) 
    ||  !isset($_POST['email']) || !isset($_POST['phone']) 
    ||  !isset($_POST['password']) || !isset($_POST['password1']) ) {
        echo "Missing input value(s)<br/>";
} elseif ( !ctype_alpha($_POST['firstname']) 
    || !ctype_alpha($_POST['lastname']) 
    || !ctype_alnum($_POST['phone'])
    || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Bad input value(s)<br/>";
} elseif ( $_POST['password'] != $_POST['password1'] ) {
    echo "Password mismatch<br/>";
} else {
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first      = $_POST['firstname'];
    $last       = $_POST['lastname'];
    $phone      = $_POST['phone'];

    $db = AtomicDatabase::getInstance();

    $result = $db->insert("users", 
        array("email" => $email, "password" => $password, 
        "first_name" => $first, "last_name" => $last,
        "phone" => $phone) 
    );

    echo "POST: <br/>";
    foreach ( $_POST as $key => $value ) {
        echo "{$key} : {$value} <br/>";
    }

    $arr = $result->fetch_array();
    echo "result: {$arr} <br/>";
    foreach ( $arr as $key => $value ) {
        echo "{$key} : {$value} <br/>";
        foreach ( $value as $k => $v ) {
            echo " --{$key}-- {$k} : {$v} <br/>";
        }
    }
    
    echo '<a href="https://bank.mind.contact/index.php">index</a>';

    //header("Location: https://bank.mind.contact/index.php");
    //die();
} 


?>