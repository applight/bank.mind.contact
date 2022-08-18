<?php
require_once 'Database.php';

if (    !isset($_POST['firstname']) || !isset($_POST['lastname']) 
    ||  !isset($_POST['email']) || !isset($_POST['phone']) 
    ||  !isset($_POST['password']) || !isset($_POST['password1']) ) {
    header("Location: https://bank.mind.contact/signup.php?error=missinginput");
} elseif ( !ctype_alpha($_POST['firstname']) 
    || !ctype_alpha($_POST['lastname']) 
    || !ctype_alnum($_POST['phone'])
    || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: https://bank.mind.contact/signup.php?error=badinput");
} elseif ( $_POST['password'] != $_POST['password1'] ) {
    header("Location: https://bank.mind.contact/signup.php?error=passwordmismatch");
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

    header("Location: https://bank.mind.contact/logon.php");
} 
die();
?>