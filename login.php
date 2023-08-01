<?php 



session_start();
require 'functions.php';


if(isset ($_COOKIE['id']) && isset ($_COOKIE['key']))  {

     $id = $_COOKIE['id'] ;
     $key = $_COOKIE['key'] ;


     $result = mysqli_query($conn,"SELECT username FROM user WHERE id = $id");
    
     $row = mysqli_fetch_assoc($result) ;


     if($key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
     }

}



if(isset($_SESSION["login"])) {

    header("location: index.php");
    exit;
}




if(isset($_POST["login"])) {


    $username = $_POST["username"] ;
    $password = $_POST["password"] ;

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ") ;
    
    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result) ;
         
      if( password_verify($password,$row["password"]) ) {
         
        $_SESSION["login"] = true;

        if(isset ($_POST['remember'])) {

            setcookie('id' , $row['id'], time() + 60) ;

            setcookie('key' , hash('sha256', $row['username']), time() + 60 ) ;

        }
        
        header("location: index.php");
        exit;
      }
    }
       

    $error = true;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman login</title>
</head>
<body>
    <h1>halaman login</h1>

    <?php  if(isset($error)) : ?>
         <p style="color: red; font-style : italic;">username atau password salah</p>

    <?php endif ; ?>
    
    
<form action="" method="post">

<label for="username">username :</label> <br>
<input type="text" name="username" id="username">
<br>
<br>
<label for="password">password :</label> <br>
<input type="password" name="password" id="password">
<br>
<br>
<input type="checkbox" name="remember" id="remember">
<label for="remember" >remember me</label> 
<br>
<br>
<button type="submit" name="login">login</button>
</form>


</body>
</html> 