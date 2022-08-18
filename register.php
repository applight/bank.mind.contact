<?php
require_once 'Database.php';

if (    !isset($_POST['firstname']) || !isset($_POST['lastname']) 
    ||  !isset($_POST['email']) || !isset($_POST['phone']) 
    ||  !isset($_POST['password']) || !isset($_POST['password1']) ) {
        // missing input value(s)
} elseif ( !ctype_alpha($_POST['firstname']) 
    || !ctype_alpha($_POST['lastname']) 
    || !ctype_alnum($_POST['phone'])
    || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        // invalid input value(s)
} elseif ( $_POST['password'] != $_POST['password1'] ) {
    // password mismatch
} else {
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first      = $_POST['firstname'];
    $last       = $_POST['lastname'];
    $phone      = $_POST['phone'];

    $db = AtomicDatabase::getInstance();

    $db->insert("users", 
        ['email' => $email, 'password' => $password, 
        'first_name' => $first, 'last_name' => $last,
        'phone' => $phone] 
    );

    header("Location: https://bank.mind.contact/index.php");
    die();
} 


?>