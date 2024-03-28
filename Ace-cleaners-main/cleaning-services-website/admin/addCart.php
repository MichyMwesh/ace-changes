        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // Start the session
        session_start();

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include your database connection file
            include "dconn.php";

            // Retrieve form data
            $number = $_POST["number"];
            $region = $_POST["region"];
            $mondayTime = !empty($_POST["mondayTime"]) ? $_POST["mondayTime"] : "00:00";
            $tuesdayTime = !empty($_POST["tuesdayTime"]) ? $_POST["tuesdayTime"] : "00:00";
            $wednesdayTime = !empty($_POST["wednesdayTime"]) ? $_POST["wednesdayTime"] : "00:00";
            $thursdayTime = !empty($_POST["thursdayTime"]) ? $_POST["thursdayTime"] : "00:00";
            $fridayTime = !empty($_POST["fridayTime"]) ? $_POST["fridayTime"] : "00:00";
            $saturdayTime = !empty($_POST["saturdayTime"]) ? $_POST["saturdayTime"] : "00:00";
            $sundayTime = !empty($_POST["sundayTime"]) ? $_POST["sundayTime"] : "00:00";
            $services = implode(", ", $_POST["service"]); // Convert array to string
            $roomTypes = implode(", ", $_POST["roomType"]); // Convert array to string
            $bedroomCount = $_POST["bedroomCount"];
            $livingroomCount = $_POST["livingroomCount"];
            $bathroomCount = $_POST["bathroomCount"];
            $kitchenCount = $_POST["kitchenCount"];

            // Prepare the SQL query
            $sql = "INSERT INTO cart (number, region, monday_time, tuesday_time, wednesday_time, thursday_time, friday_time, saturday_time, sunday_time, services, room_types, bedroom_count, livingroom_count, bathroom_count, kitchen_count, status, user_id) 
        VALUES ('$number', '$region', '$mondayTime', '$tuesdayTime', '$wednesdayTime', '$thursdayTime', '$fridayTime', '$saturdayTime', '$sundayTime', '$services', '$roomTypes', '$bedroomCount', '$livingroomCount', '$bathroomCount', '$kitchenCount', 'pending', 1)";

            $result = $conne->query($sql);

            // Set success message in session variable
            $_SESSION['success_message'] = "Data has been submitted successfully!";
            
            // Redirect to index.php
            header("Location: index.php");
            exit(); // Ensure script stops her
        }
        ?>
