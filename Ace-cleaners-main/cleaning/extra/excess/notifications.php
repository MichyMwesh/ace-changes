<?php
include('db.php'); // Include your database connection file
include('ddcon.php'); // Include your database connection file
// Process user registration form
if(isset($_POST['SignUp'])) {
    
    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($connee, $_POST['username']);
    // Assuming you're also storing email and password in the database
    $email = mysqli_real_escape_string($connee, $_POST['email']);
    $password = mysqli_real_escape_string($connee, $_POST['password']);

    // Insert user registration data into 'users' table
    $insert_user_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($connee, $insert_user_query);

    // Generate notification
    $message = "New user registered: ".$_POST['username'];
    $insert_notification_query = "INSERT INTO notifications (message, status) VALUES ('$message', 0)";
    mysqli_query($connection, $insert_notification_query);

    // Redirect or display success message
}
?>

  
  
<?php
//include('db.php'); // Include your database connection file

// Fetch new notifications from the database
$query = "SELECT * FROM notifications WHERE status = 0 ORDER BY id DESC LIMIT 5";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div>'.$row['message'].'</div>';
    }
} else {
    echo '<div>No new notifications</div>';
}
?>

<div id="notificationArea">
    <!-- Notifications will be displayed here -->
</div>
<script>
function fetchNotifications() {
    $.ajax({
        url: "fetch.php",
        type: "GET",
        success: function(response) {
            $("#notificationArea").html(response);
        }
    });
}

// Call the function initially to fetch notifications when the page loads
$(document).ready(function() {
    fetchNotifications();
});

// Set interval to periodically fetch new notifications (every 5 seconds in this example)
setInterval(fetchNotifications, 5000);
</script>

<script>
$(document).ready(function(){
 function load_unseen_notification(view = '') {
    $.ajax({
      url: "fetch.php",
      method: "POST",
      data: {view: view},
      dataType: "json",
      success: function(data) {
        $('#notificationMenu').html(data.notification);
        if(data.unseen_notification > 0) {
          $('.count').html(data.unseen_notification);
        }
      }
    });
 }

 load_unseen_notification();

 $(document).on('click', '#notificationDropdown', function(){
    $('.count').html('');
    load_unseen_notification('yes');
 });

 setInterval(function(){
    load_unseen_notification();
 }, 5000);
});





</script>
