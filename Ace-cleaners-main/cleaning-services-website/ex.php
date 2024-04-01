<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ACE-CLEANERS </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Header Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 bg-warning d-none d-lg-block">
                <a href="" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-3 text-bg-warning">ACE</h1>
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row bg-success p-0 d-none d-lg-flex">
                    <div class="col-lg-7 text-left text-white">
                        <div class="h-100 d-inline-flex align-items-center border-right border-primary py-2 px-3">
                            <i class="fa fa-envelope text-primary mr-2"></i>
                            <small>acecleaners@gmail.com</small>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center py-2 px-2">
                            <i class="fa fa-phone-alt text-primary mr-2"></i>
                            <small>+254713927050</small>
                        </div>
                    </div>
                    <div class="col-lg-5 text-right">
                        <div class="d-inline-flex align-items-center pr-2">
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-instagram"></i>
                            </a></i>
                            </a>
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-facebook-f fa-sm"></i>
                            </a>
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
                    <a href="" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary">Klean</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="about.html" class="nav-item nav-link">About</a>
                            <a href="service.html" class="nav-item nav-link">Services</a>
                            <a href="project.html" class="nav-item nav-link"></a>

                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <a href="login.php"><button type="button" name="signup" class="btn btn-outline-info">LOGIN</button></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <?php
$showAlert = false;
$showError = false;
$exists = false;

if (isset($_POST['signup'])) {
    include 'dbconnect.php';
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    echo $email;
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);

    // Validate inputs (you can add more validation as needed)
    if (empty($username) || empty($password) || empty($cpassword)) {
        $showError = "All fields are required";
    } elseif ($password != $cpassword) {
        $showError = "Passwords do not match";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 0) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO `users` (`email`,`username`, `password`, `cpassword`,`date`) VALUES ('$email','$username', '$hash','$cpassword',current_timestamp())";
            $insertResult = mysqli_query($conn, $insertSql);

            if ($insertResult) {
                $showAlert = true;
            } else {
                $showError = "Error inserting user into database".mysqli_error($conn);
            }
        } else {
            $exists = "Username not available";
        }
    }

    mysqli_close($conn);
}
?>
	
<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 
	
<body> 
	
<?php 
	
	if($showAlert) { 
	
		echo ' <div class="alert alert-success 
			alert-dismissible fade show" role="alert"> 
	
			<strong>Success!</strong> Your account has been  successfully  
			created and you can now login.
            
            <script>
                location.replace("login.php?success");
                </script> 
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close"> 
				<span aria-hidden="true">×</span> 
			</button> 
		</div> '; 
	} 
	
	if($showError) { 
	
		echo ' <div class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close"> 
			<span aria-hidden="true">×</span> 
	</button> 
	</div> '; 
} 
		
	if($exists) { 
		echo ' <div class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close"> 
			<span aria-hidden="true">×</span> 
		</button> 
	</div> '; 
	} 


?> 
	
<div class="container my-4 "> 
	
	<h1 class="text-center text-secondary">Signup Here</h1> 
    <p class="text-center text-primary"><b>Create  An  Account</b></p>
	<form action="ex.php" method="post"> 
	
		<div class="form-group"> 
			<label for="username">Username</label> 
		<input type="text" class="form-control" placeholder="Username" id="username"
			name="username" aria-describedby="emailHelp" required>	 
		</div> 


        <div class="form-group"> 
			<label for="email">Email</label> 
		<input type="email" class="form-control" placeholder="Email" id="email"
			name="email" aria-describedby="emailHelp" required>	 
		</div> 
	
		<div class="form-group"> 
			<label for="password">Password</label> 
			<input type="password" class="form-control"
			id="password" placeholder="Password" name="password" required> 
		
        <div class="password_strength_box">
            <div class="password_strength">
                <p class="text">Weak</p>
                <div class="line_box">
                    <div class="line">

                    </div>
                </div>
<div class="tool_tip_box">
    <span>?</span>
    <div class="tool_tip">
<p><b></b>Password must be:</b></p>
<p>Less than or equal to 16 characters</p>
<p>At least 8 character long </p>
<p>At least 1 uppercase letter </p>
<p>At least 1 lowercase letter</p>
<p>At least 1 special character</p>
<p></p>
    </div>
</div>
        </div>
        
        </div> 
	
		<div class="form-group"> 
			<label for="cpassword">Confirm Password</label> 
			<input type="password" class="form-control"
				id="cpassword" placeholder="Confirm Password" name="cpassword" required> 
	
			
			
			</small> 
		</div>	 
       
		<button type="submit" name="signup" class="btn btn-outline-info"></a>
		SignUp 
		</button> 
	</form> 
</div> 
	
	  
    <!-- Footer Start -->
    <div class="container-fluid bg-info text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 mt-n3 display-4 text-secondary">ACE</h1>
                </a>
            
                <h5 class="font-weight-semi-bold text-white mb-2">Opening Hours:</h5>
                <p class="mb-1">Mon – Sat, 8AM – 5PM</p>
                <p class="mb-0">Sunday: Closed</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-success mb-4">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt text-primary mr-2"></i>Moi Avenue Street, Nairobi, KENYA</p>
                <p><i class="fa fa-phone-alt text-primary mr-2"></i>+254713927050</p>
                <p><i class="fa fa-envelope text-primary mr-2"></i>acecleaners@gmail.com</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-success mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                    <a class="text-white mb-2" href="services.html"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                    <a class="text-white" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-success mb-4">Newsletter</h4>
                <p>Thank you for being the backbone of our success, for turning challenges into opportunities, and for going above and beyond to ensure that every space we touch is not just clean but transformed into a haven of freshness and hygiene.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-0" style="padding: 25px;" placeholder=" Email">
                        <div class="input-group-append">
                            <button class="btn btn-secondary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-info text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">ACE CLEANERS</a>. All Rights Reserved.
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->

	 
 <!-- Back to Top -->
 <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

 <script>

var pass =document.getElementById("password");
var pass =document.getElementById("confirmpassword");
var pass =document.getElementById("strength");

pass.addEventListener('input', () =>{
if(pass.value.length > 0){
msg.style.display ="block"
}
else{
msg.style.display ="none";
}
if(pass.value.length < 4)
{
str.innerHTML ="weak";
pass.style.borderColor ="#"
}
else if(pass.value.length >=4 && pass.value.length <8){
    str.innerHTML ="medium";
}
elseif(pass.value.length >=8)
{
    str.innerHTML ="strong";
}
})
</script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>


</body> 
</html> 
