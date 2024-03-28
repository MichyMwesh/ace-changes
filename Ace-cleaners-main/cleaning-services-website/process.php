<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected schedule from the form
    $selectedSchedule = $_POST['schedule'];
    $selectedCleaning=$POST['cleaning'];

    // In a real-world application, you might store the schedule in a database or perform further actions
    echo "Selected schedule: " . $selectedSchedule;
    echo "Selected cleaning: " . $selectedCleaning;
} else {
    // Handle the case where the form is not submitted using POST method
    echo "Form not submitted.";
}
?>
