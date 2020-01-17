<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PNTraining');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); // create connection in

// print_r(mysqli_num_rows($user)); //length
// $list =  mysqli_fetch_array($user); //list of user
// echo $list['username']; //getting the username
// print_r($list);

class CRUD
{
    public $usernotfound = "";
    public $passnot = "";

    public function insert($username, $password, $confirm_password)
    {
        $query = " INSERT INTO Users ( username , password) VALUES ('$username','$password') ";
        if ($username != "" && $password != "" ) {
            if ($password === $confirm_password) {
                global $link;
                if (mysqli_query($link, $query)) {
                    $_SESSION["logged_in"] =true;
                    $_SESSION["name"] = $username;
                    setcookie("user", $username, time() + (86400 * 30), "/");
                    header("Location: dashboard.php");
                } else {
                    header("Location: signup.php?status=Try again! Change username");
                }
            } else {
                header("Location: signup.php?status=Check Password");
            }

        } else {
            header("Location: signup.php?status=All fields required");
        }
        mysqli_close($link);
    }

    public function login($username, $password, $link)
    {
        $query = "SELECT * FROM Users WHERE username='$username'";
        if ($username != "" && $password != "") {
            $user = mysqli_query($link, $query);
            if (mysqli_num_rows($user) > 0) {
                $list = mysqli_fetch_array($user);
                if ($password === $list['password']) {
                    $_SESSION["logged_in"] =true;
                    $_SESSION["id"] = $list['user_id'];
                    $_SESSION["name"] = $list['username'];
                    setcookie("user", $list['username'], time() + (86400 * 30), "/");
                    header("Location: dashboard.php");
                } else {
                    header("Location: home.php?status=password not match");
                }
            } else { // username not found
                // $this->home();
                header("Location: home.php?status=use not found");
            }
        } else {
            $this->home();
        }
        mysqli_close($link);
    }

    private function home()
    {
        header("Location: home.php");

    }

    function post($username, $post, $link) {
        $query = " INSERT INTO posts (user, post ) 
        VALUES ('$username','$post')";
        if (mysqli_query($link, $query)) {
            echo "SAVED POST!";
        } else {
            echo "Check";
        }
        mysqli_close($link);
        
    }

    function retrievePost($user) {
        $query = "SELECT * FROM posts WHERE user='$user'";
        global $link;
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($result)){
            $id=$row['id'];
            echo "<div class='postss'> <p>". $row['post']. "</p>
            <br>
            <a href='delete.php?id=$id'>Delete</a></td>
            <a href='update.php?id=$id'>Update</a></td>
            </div><hr>" ;
            // echo $row['post'] . "<br>";
        }
        mysqli_close($link);
    }

    function update($id) {
        $query = "SELECT * FROM posts WHERE id='$id'";
        global $link;
        $result = mysqli_query($link, $query);
        $data = mysqli_fetch_array($result);
        echo "<center><textarea  cols='30' rows='10'>" . $data['post']. "</textarea><br>
        <a href='update.php'>UPDATE</a><br></center>";  
        mysqli_close($link);
    }

    function deletePost($id) {
        $query = "DELETE FROM posts WHERE id='$id'";
        global $link;
        echo mysqli_query($link, $query);
        header("Location: posts.php");
        mysqli_close($link);
    }

    function logOut($bool) {
        if($bool) {  
            session_destroy();
            setcookie("user", "", time() - (86400 * 30), "/");
            header("Location: home.php");
            // print_r($_SESSION);
        } else {
            echo "What?";
        }
        mysqli_close($link);
    }

    function accessToOtherPage($page) {   
        session_start();
        if($page) {
            if (isset($_SESSION["logged_in"])) {
                if (!$_SESSION["logged_in"]) {
                    header("Location: home.php");
                }
            }else{
                header("Location: home.php");
            }
        } else {
            if (isset($_SESSION["logged_in"])) {
                if ($_SESSION["logged_in"]) {
                    header("Location: dashboard.php");
                }
            }
        }
        
    }

}
