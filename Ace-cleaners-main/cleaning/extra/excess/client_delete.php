<?php
session_start();
include 'client.php';
include 'ddcon.php';

if(isset($_POST['registerbtn']))
{
    // Code for registering new clients

}


if (isset($_POST['updatebtn'])) {
    // Code for updating client profiles
}


if(isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id']; 
    $query = "DELETE FROM users WHERE id=?";
    $stmt = $connee->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
       echo $_SESSION['success'] = "Client data is DELETED";
        //header('Location: client.php');
    } else {
       echo $_SESSION['status'] = "Client data is NOT DELETED";
        //header('Location: client.php');
    }
}
?>

<form action="clode.php" method="POST">
    <!-- Form fields for registering new clients or updating existing ones -->
</form>
