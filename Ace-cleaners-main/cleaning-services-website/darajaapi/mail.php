<?php
use AfricasTalking\SDK\AfricasTalking;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/Exception.php";
require_once "PHPMailer/src/SMTP.php";
require_once"vendor/autoload.php";
include("DB.php");
session_start();
$mail = new PHPMailer(true);
$email=$_SESSION['email'];
$notifications_name = "Bookings";
$message            =  "$email Booked successfully";

$insert_query = "INSERT INTO inf(notifications_name,message,active)VALUES('".$notifications_name."','".$message."','1')";
$result = mysqli_query($connection,$insert_query);
try {
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true,
		)
	  );
	$mail->SMTPDebug = 0;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'vincentbettoh@gmail.com';				
	$mail->Password = 'bmrv uhtx usfr gadd';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;
	$mail->setFrom("student@gmail.com", "cleaning Services");		
	$mail->addAddress($email);	
	$mail->isHTML(true);								
	$mail->Subject = 'Booking System';
	$mail->Body="Booking has been successfully executed.";
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
	?>
<script>
alert("Booking Successfull");
location.replace("../admin")
</script>
	<?php

} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
