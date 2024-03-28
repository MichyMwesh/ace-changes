<?php
session_start();
include 'beet.php';

if(isset($_POST["LOGIN"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $phone_number=$POST["phone_number"];
    $email= $POST["email"];
} 
{

    function validate($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return data;
    }
}

$username=validate($_POST['username']);
$password=validate($_POST['password']);
$phone_number=validate($_POST['phone_number']);
$email=validate($_POST['email']);

if(empty($username)){
    header();
    exit();
}
elseif(empty($password)){
    header();
    exit();
}
elseif(empty($phone_number)){
    header();
    exit();
}
    elseif(empty($email)){
        header();
        exit();
    }
$sql="SELECT * FROM clientsignup_tb WHERE username='$username' password='$password' phone_number='$phone_number' email='$email'";
$result=mysqli_query($cost,$sql);

if(mysqli_num_rows($result)===1){
    $row=mysqli_fetch_assoc($result);
    if($row['username']===$username 
    $row['password']===$password
    $row['phone_number']===$phone_number
    $row['email']===$email)
    {
        echo "Logged In!";
        $_SESSION['username']=$row['username'];
        $_SESSION['name']=$row['name'];
        $_SESSION['id']=$row['id'];
        header("");
        exit(); 
    }
}
else{
    header("location: homepage.php?success");
    exit();
}
else{
    header("location: homepage.php?success");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="client's2.css">
</head>
<body>
 
    <form class="let" action="" method="post">
    <p><b>ACE CLEANERS</b></p>
        <h1>Login</h1>
        USERNAME<br><br>
        <input class="wrist" type="text" name="username" placeholder="USERNAME" required><br><br>
        PASSWORD<br><br>
        <input class="west" type="password" name="password" placeholder="PASSWORD" maxlength="20" minlength="15" required><br><br>
        EMAIL<br><br>
        <input class="tet" type="email" name="email" placeholder="EMAIL" required><br><br>
        PHONE NUMBER<br><br>
        <input class="tit" type="tel" name="phone_number" placeholder="PHONE NUMBER" maxlength="10" required><br><br>

        <button class="btn" name="LOGIN" type="LOGIN">LOGIN</button><br>
    <p>Do you have an account?</p>
    <a href="client's 1.php">Register</a>
    </form> 
    <img src="" alt="">   
</body>
</html>