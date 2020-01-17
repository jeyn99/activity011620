<?php 
include ("connections.php"); //set variable for connection $link
session_start();

$classCrud =  new CRUD();

if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

// print_r($_REQUEST['logout']);
$classCrud->logOut($_REQUEST['logout']);
