<?php
session_start();
include 'client.php';
include 'ddcon.php';

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password === $confirmpassword) {
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Client Profile Added";
            header('Location: client.php');
        } else {
            $_SESSION['status'] = "Client Profile Not Added";
            header('Location: client.php');
        }
    } else {
        $_SESSION['status'] = "Password and confirm Password does not match";
        header('Location: client.php');
    }
}

if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE users SET username=?, email=?, password=? WHERE id=?";
    $stmt = $connee->prepare($query);
    $stmt->bind_param("sssi", $username, $email, $password, $id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Your Data Is Updated";
        header('Location: client.php');
    } else {
        $_SESSION['status'] = "Your Data Is NOT Updated";
        header('Location: client.php');
    }
}

if(isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];
    $query = "DELETE FROM users WHERE id=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Your data is DELETED";
        header('Location: client.php');
    } else {
        $_SESSION['status'] = "Your Data Is NOT DELETED";
        header('Location: client.php');
    }
}
?>

