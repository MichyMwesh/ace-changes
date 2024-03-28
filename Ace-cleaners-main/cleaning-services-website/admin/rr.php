<?php 
// Include the database configuration file 
require_once 'cn.php'; 
 
// Fetch the marker info from the database 
$result = $db->query("SELECT * FROM locations"); 
 
// Fetch the info-window data from the database 
$result2 = $db->query("SELECT * FROM locations"); 
?>