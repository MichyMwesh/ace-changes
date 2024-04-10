<?php
include('ddcon.php'); // Include your database connection file

// Process user registration form
if(isset($_POST['submit'])) {
    // Your code to handle user registration...

    // Insert user registration data into 'users' table

    // Generate notification
    $message = "New user registered: ".$_POST['username'];
    $insert_notification_query = "INSERT INTO notifications (message, status) VALUES ('$message', 0)";
    mysqli_query($connee, $insert_notification_query);

    // Redirect or display success message
}
?>

  
  
<?php
include('db.php'); // Include your database connection file

// Fetch new notifications from the database
$query = "SELECT * FROM notifications WHERE status = 0 ORDER BY id DESC LIMIT 5";
$result = mysqli_query($connee, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div>'.$row['message'].'</div>';
    }
} else {
    echo '<div>No new notifications</div>';
}
?>




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
