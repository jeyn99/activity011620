<?php
include ("connections.php"); //set variable for connection $link
session_start();

$classCrud =  new CRUD();

if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['conpassword'];
    $classCrud->insert($username, $password, $confirm_password);
} else {
    echo "All Item to be filled!";
}

