<?php
$connection=mysqli_connect('localhost','root','','admin_panel');
if(!$connection){
    die("Failed to connect". mysql_error($connection));
}
else{
   // echo("connected");
}
?>