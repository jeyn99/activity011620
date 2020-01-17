<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<?php
require "connections.php";
$classCrud = new CRUD();

$classCrud->accessToOtherPage(1);

if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

$classCrud->retrievePost($_SESSION['name'])
?>


<a href="logOut.php?logout=true">
<button class="btn btn-danger">LOGOUT</button>
</a>
<a href="dashboard.php">
<button class="btn btn-primary">DASHBOARD</button>
</a>