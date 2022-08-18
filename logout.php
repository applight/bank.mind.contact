<?php
session_start();
session_destroy();
header('Location: https://bank.mind.contact');
die();
?>