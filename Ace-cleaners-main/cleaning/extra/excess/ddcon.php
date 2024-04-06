<?php
$connee=mysqli_connect('localhost','root','','geeks');
if(!$connee){
    die("Failed to connect". mysql_error($connee));
}
else{
   // echo("connected");
}
?>