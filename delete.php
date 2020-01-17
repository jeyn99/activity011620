<?php

require "connections.php";
$classCrud = new CRUD();
if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

$classCrud->deletePost($_REQUEST['id']);
