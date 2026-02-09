<?php
include 'config.php';

// sql query select all
$result = mysqli_query($db, "SELECT * FROM yisoo");

// Login Button
if(isset ($_POST['Login'])){
    extract($_POST);

    $sql = mysqli_query($db, "SELECT * FROM yisoo where Username='$username' and Password='$password'");
    $row = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_COOKIE['username'] = $row['Username'];
        setcookie("Username", $username, time() + (86400 * 30));
        header("Location: index.php"); 
    }

    else
    {   
        echo "Invalid Username and Password";
    }
}



// Register Button
if(isset ($_POST['Register'])){
    header("Location: register.php");
}

//Cancel Registration
if(isset ($_POST['Cancel'])){
    header("Location: login.php");
}
// Submit Button
if(isset ($_POST['Submit'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    if(empty($username) || empty($password) )
    {
        echo 'Please input Username and Password';
    }

    else
    {
        $sql = "INSERT INTO yisoo (Username, Name, Password) VALUES ('$username', '$name', '$password')";
        mysqli_query($db, $sql);
        header("Location: index.php");
    }   
}

// Logout Button
if(isset ($_POST['Logout'])){
    $username = $_COOKIE ["Username"];
    setcookie("Username",$username,time()-1); 
         header("Location: index.php");
        }

?>