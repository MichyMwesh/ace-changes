<?php
session_start();
include 'register.php';
include 'db.php';

//$connection=mysqli_connect("localhost","root","","admin_panel");
if(isset($POST['registerbtn']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];

    if ($password === $confirmpassword)
    
    $query ="INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
$query_run=mysqli_query($connection,$query);

if($query_run)
{
    //echo "Saved";
    echo"SAVED";
    $SESSION['success'] ="Admin Profile Added";
    header('Location:register.php');

}

else{
    
    $SESSION['status'] ="Admin Profile Not Added";
    header('Location:register.php'); 
    echo"not saved";
}

//else
{
    $SESSION['status'] ="Password and confirm Password does not match";
    header('Location:register.php'); 

}

}

if (isset($_POST['updatebtn']))
{
    $id=$_POST['edit_id'];
    $username =$_POST['edit_username'];
    $email =$_POST['edit_email'];
    $password =$_POST['edit_password'];

    $query= "UPDATE register SET username='$username',email='$email',password='$password' WHERE id='$id';";
    $query_run=mysqli_query($connection,$query);

if($query_run)
{
    $SESSION ['success']="Your Data Is Updated";
    header('Location:register.php');
}
else
{
    $SESSION ['status']="Your Data Is NOT Updated";
    header('Location:register.php');
}



}



if(isset($_POST['delete_btn']))
{

    $id =$_POST['delete_id'];

    $query="DELETE * FROM register WHERE id= '$id';";
    $query_run =mysqli_query($connection,$query);

if($query_run)
{
$_SESSION['success']="Your data is DELETED";
header('Location:register.php');
}
else{

    $_SESSION ['status']="Your Data Is NOT DELETED";
    header('Location:register.php');

}


}











?>