<?php

require "connections.php";
$classCrud = new CRUD();
$classCrud->accessToOtherPage(1);

if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

$classCrud->update();
?>