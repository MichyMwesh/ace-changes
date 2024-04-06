<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Start the session
session_start();
// Check if the form is submitted
    // Include your database connection file
    include "dconn.php";
    // Retrieve form data
    $number = $_POST["number"];
    $region = $_POST["region"];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $mondayTime = !empty($_POST["mondayTime"]) ? $_POST["mondayTime"] : "00:00";
    $tuesdayTime = !empty($_POST["tuesdayTime"]) ? $_POST["tuesdayTime"] : "00:00";
    $wednesdayTime = !empty($_POST["wednesdayTime"]) ? $_POST["wednesdayTime"] : "00:00";
    $thursdayTime = !empty($_POST["thursdayTime"]) ? $_POST["thursdayTime"] : "00:00";
    $fridayTime = !empty($_POST["fridayTime"]) ? $_POST["fridayTime"] : "00:00";
    $saturdayTime = !empty($_POST["saturdayTime"]) ? $_POST["saturdayTime"] : "00:00";
    $sundayTime = !empty($_POST["sundayTime"]) ? $_POST["sundayTime"] : "00:00";
    $services = implode(", ", $_POST["service"]); // Convert array to string
    $roomTypes =""; // Convert array to string
    $bedroomCount = 0;
    $livingroomCount =0;
    $bathroomCount = 0;
    $kitchenCount = 0;
    $email=$_SESSION['email'];
    $amount=count($_POST["service"])*500;
    $_SESSION['amount']=$amount;
    // Prepare the SQL query (consider using prepared statements for security)
    $sql = "INSERT INTO cart (uemail,number, region, lat,longVal, monday_time, tuesday_time, wednesday_time, thursday_time, friday_time, saturday_time, sunday_time, services, room_types, bedroom_count, livingroom_count, bathroom_count, kitchen_count, status, user_id) 
    VALUES ('$email','$number', '$region', '$lat','$long', '$mondayTime', '$tuesdayTime', '$wednesdayTime', '$thursdayTime', '$fridayTime', '$saturdayTime', '$sundayTime', '$services', '$roomTypes', '$bedroomCount', '$livingroomCount', '$bathroomCount', '$kitchenCount', 'pending', 1)";
    

    $result = $conne->query($sql);

    if ($result) {
        // Set success message in session variable
        $_SESSION['success_message'] = "Data has been submitted successfully!".mysqli_error($conne);
        echo "<script>alert('".$_SESSION['success_message']."');</script>";
        //echo mysqli_error($conne);
    } else {
        // Set error message in session variable
        $_SESSION['error_message'] = "Failed to submit data!";
        echo "<script>alert('".$_SESSION['error_message']."');</script>";
    }
    
    // Redirect to index.php
    //header("Location: index.php");
    echo "<script>location.replace('index.php');</script>";
    exit(); // Ensure script stops here
?>
