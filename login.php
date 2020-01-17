<?php
require "connections.php"; //set variable for connection $link
session_start();

$classCrud = new CRUD();

if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $classCrud->login($username, $password, $link);
} else {
    echo "All fields required!";
    header("Location: home.php");
}
