<?php
session_start();
include 'register.php';
include 'db.php';

if(isset($_POST['registerbtn']))
{
    // Code for registering new clients

}


if (isset($_POST['updatebtn'])) {
    // Code for updating client profiles
}

if(isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id']; 
    $query = "DELETE FROM register  WHERE id=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
       echo $_SESSION['success'] = "Admin data is DELETED";
        header('Location: register.php');
    } else {
       echo $_SESSION['status'] = "Admin data is NOT DELETED";
        header('Location: register.php');
    }
}
?>

<form action="code.php" method="POST">
    <!-- Form fields for registering new clients or updating existing ones -->
</form>
