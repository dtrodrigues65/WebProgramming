<?php
ini_set("session.save_path", "/home/unn_w21032322/sessionData");
session_start();

$_SESSION = array();
session_destroy(); 

header("Location: homepage.php");
?>




