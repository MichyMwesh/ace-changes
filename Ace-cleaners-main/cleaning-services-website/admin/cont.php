<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ACE CLEANERS</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Cleaning Company Website Template" name="keywords">
        <meta content="Cleaning Company Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400&display=swap" rel="stylesheet">
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <!-- Header Start -->
            <div class="header bg-primary">
                <div class="container-fluid">
                    <div class="header-top row align-items-center">
                        <div class="col-lg-3">
                            <div class="brand">
                                <a href="index.html">
                                    ACE
                                    <!-- <img src="img/logo.png" alt="Logo"> -->
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="topbar">
                                <div class="topbar-col">
                                    <a href="tel:+012 345 67890"><i class="fa fa-phone-alt"></i>+254713927050</a>
                                </div>
                                <div class="topbar-col">
                                    <a href="mailto:info@example.com"><i class="fa fa-envelope"></i>acecleaners@gmail.com</a>
                                </div>
                                <div class="topbar-col">
                                    <div class="topbar-social">
                                       
                                        <a href=""><i class="fab fa-instagram"></i></a>
                                        <a href=""><i class="fab fa-facebook-f"></i></a>
                                        <a href=""><i class="fab fa-youtube"></i></a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="navbar navbar-expand-lg  navbar-light">
                                <a href="#" class="navbar-brand">MENU</a>
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                                    <div class="navbar-nav ml-auto">
                                        <a href="index.php" class="nav-item nav-link active">Home</a>
                                        <a href="about.html" class="nav-item nav-link">About</a>
                                        <a href="service.html" class="nav-item nav-link">Service</a>
                                        <a href="portfolio.html" class="nav-item nav-link">Project</a>
                                       

                                        <a href="cont.php" class="nav-item nav-link">Contact</a>
                                       
                                        </div>
                                        <a href="logout.php"><button type="button" class="btn btn-info">LOGOUT</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
            
            
            <?php

     include("dconn.php");
if(isset($_POST['SEND'])) {
    echo '<script>alert("executing...");</script>';
    
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // SQL query to insert data into the 'cdb' table
    $query = "INSERT INTO cdb (name, email, subject, message) VALUES (?, ?, ?, ?)";
    
    // Initialize and prepare a statement
    $stmt = mysqli_stmt_init($conne);
    mysqli_stmt_prepare($stmt, $query);

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Debugging: Display form data and any potential MySQL error

    // Display success message using JavaScript
    echo "<script>alert('Data has been successfully submitted!');</script>";
}
?>
           

            <!-- Contact Start -->
            <div class="contact">
                <div class="container">
                    <div class="section-header">
                     
                        <h2 class="text-warning">FAQ / Send Message</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="faqs">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                                <span>1</span> Do you offer different cleaning packages and costs?
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                            Yes, we have a variety of package options. Whether you want a one-time clean or a recurring professional cleaning service, we have the right package for you! 
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                                                <span>2</span> Can my pet stay home during the clean?
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                            Yes - find a good spot for your pets so they’re safe and secure while we clean. Please pick up any animal feces prior to your cleaning.
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseThree">
                                                <span>3</span> What if I need to reschedule?
                                            </a>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                            Life Happens. We get it. Please let us know two business days prior to your scheduled appointment and we will do our best to work you into another day/time. Last minute cancellations may incur a fee according to your local Two Maids location policies.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseFour">
                                                <span>4</span> What if someone gets hurt in my home?
                                            </a>
                                        </div>
                                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                            Ace Cleaners  allows  you to experience peace of mind. Any on the job injuries will be covered by the staff.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseFive">
                                                <span bg->5</span> Do I have to be home when you come clean?
                                            </a>
                                        </div>
                                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                            Nope! It is not necessary for you to be present while your team of professional house cleaners provides your cleaning service. In fact, the majority of our customers are not at home while we clean.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseSix">
                                                <span>6</span> What if something is broken during my cleaning?
                                            </a>
                                        </div>
                                        <div id="collapseSix" class="collapse" data-parent="#accordion">
                                            <div class="card-body">

                                            At Ace Cleaners, your home will be treated with the utmost care. In the event of an accident occurring, we will do our best to repair or replace and the damage we cause. All our PHC’s are fully licensed, bonded, and insured to protect you against any worse case scenarios.
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-form">
                                <form method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="name" placeholder="NAME" required="required" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control" name="email" placeholder="EMAIL" required="required" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="SUBJECT" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="6"  name="message" placeholder="MESSAGE" required="required" ></textarea>
                                    </div>
                                    <div><button class="btn btn-primary" type="submit" name="SEND">SEND</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact End -->


            <!-- Footer Start -->
            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-contact">
                                <h2>Get In Touch</h2>
                                <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                                <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                                <p><i class="fa fa-envelope"></i>info@example.com</p>
                                <div class="footer-social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Useful Link</h2>
                                <a href="">About Us</a>
                                <a href="">Our Story</a>
                                <a href="">Our Services</a>
                                <a href="">Our Projects</a>
                                <a href="">Contact Us</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Useful Link</h2>
                                <a href="">Our Clients</a>
                                <a href="">Clients Review</a>
                                <a href="">Ongoing Project</a>
                                <a href="">Customer Support</a>
                                <a href="">FAQs</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-form">
                                <h2>Stay Updated</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, adipiscing elit. Etiam accumsan lacus eget velit
                                </p>
                                <input class="form-control" placeholder="Email here">
                                <button class="btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container footer-menu">
                    <div class="f-menu">
                        <a href="">Terms of use</a>
                        <a href="">Privacy policy</a>
                        <a href="">Cookies</a>
                        <a href="">Help & FQAs</a>
                        <a href="">Contact us</a>
                    </div>
                </div>
                <div class="container copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; <a href="https://htmlcodex.com">HTML Codex</a>, All Right Reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
            
            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
