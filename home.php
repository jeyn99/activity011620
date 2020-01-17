<?php 
    require "connections.php";
    $classCrud = new CRUD();
    
    $classCrud->accessToOtherPage(0);
    
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<center>
<i><?php 
    if(isset($_REQUEST['status'])) {
        echo $_REQUEST['status'] ;
    } else {
      echo "" ; 
    }
?></i>
</center>
<form action="login.php" method="POST">
    Username: <input class="form-control" name="username" type="text" value="">
    <br>
    Password: <input class="form-control" name="password" type="password" value="">
    <br>
    <button class="btn btn-info" type="submit" name="submit" value="login">LOGIN</button>
    <a href="signup.php">SIGN UP</a>
</form>

