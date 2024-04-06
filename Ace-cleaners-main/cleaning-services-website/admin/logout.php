<?php
session_start();
if(session_destroy()){
    ?>
    <script>
    alert("Logged Out Successfully!");
   </script>
   <?php
    header("location:..\index.html");
}
?>
