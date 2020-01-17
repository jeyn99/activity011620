<?php 
require "connections.php";
$classCrud = new CRUD();

$classCrud->accessToOtherPage(1);

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<h1> Welcome <?=" " . $_SESSION["name"];?> and write your experience!</h1>
<a href="logOut.php?logout=true">
<button class="btn btn-danger">LOGOUT</button>
</a>
<div class='notif'>

<?php

if ($link->connect_error) { //try to connect
    die("Connection failed: " . $link->connect_error);
}

if (isset($_POST['submit'])) {
    $post = $_POST['post'];
    // echo $post;
    $classCrud->post($_SESSION['name'], $post, $link);
} else {
    echo "Please write something!";
}
?>

<form class="postform" method="POST">
    <textarea name="post" cols="30" rows="10"></textarea>
    <button class="btn btn-success postBtn" type="submit" name="submit" value="posting">POST</button><br>
    <a href="posts.php">VIEW POSTS</a><br>
</form>
</div>

