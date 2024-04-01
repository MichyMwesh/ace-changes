<?php
// Start the session
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ACE CLEANERS</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Cleaning Company Website " name="keywords">
        <meta content="Cleaning Company Website " name="description">

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
    <style>
        .dropdown-item:hover{
            background-color:grey;
        }
        .cartDrawer{
            position: fixed;
            background: lightblue;
            width: 360px;
            height: 100vh;
            top: 0%;
            right: 0%;
            z-index: 1000;
            overflow: scroll;
            transition: 1s;
            transform: translateX(100%);

        }

        .closeCart{
            transform: translateX(0%);
        }
    </style>
    
    <body>
    <?php
    // Assuming you have already included your database connection file
    include "dconn.php";

    // Fetch data from the cart table
    $sql = "SELECT * FROM cart WHERE status = 'pending'";
    $result = $conne->query($sql);

    echo "<div class='cartDrawer'>";
    echo "<div class='bg-success sticky-top text-light px-3 py-4'>";
    echo "Scheduled Services";
    echo "</div>";
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Retrieve values from the row
            $serviceList = $row["services"];
            $areaOfService = $row["region"];
            $scheduleDate = null;
            $daysOfWeek = ['monday_time', 'tuesday_time', 'wednesday_time', 'thursday_time', 'friday_time', 'saturday_time', 'sunday_time'];
            foreach ($daysOfWeek as $day) {
                if ($row[$day] !== '00:00:00') {
                    $dayOfWeek = date('l', strtotime($day)); // Get the day of the week
                    $scheduleDate = date('H:i', strtotime($row[$day])) . " $dayOfWeek"; // Format time with day of the week
                    break;
                }
            }
            $roomTypeAndNumber = $row["room_types"] . " (" . $row["bedroom_count"] . " bedrooms, " . $row["livingroom_count"] . " living rooms, " . $row["bathroom_count"] . " bathrooms, " . $row["kitchen_count"] . " kitchens)";
            $orderId = $row["id"]; // Retrieve the orderId

            echo "<div class='py-4 px-4 text-dark'>";
            echo "<p><b>Service List:</b> $serviceList</p>";
            echo "<p><b>Area of Service:</b> $areaOfService</p>";
            $serviceLists = explode(", ", $serviceList); 
            $numberOfServices = count($serviceLists) * 500;
            $_SESSION['amount'] = $numberOfServices; // Corrected syntax

            echo "<p><b>Schedule Date:</b> $scheduleDate</p>";
            echo "<p><b>RoomType and Number:</b> <br/> $roomTypeAndNumber</p>";
            echo "<h3> Total Amount " . $numberOfServices ."</h3>"; 
            echo "<div class='d-flex justify-content-between'>";
            echo "<button class='bg-success text-light btn px-4' onclick='confirmOrder($orderId)'>Confirm</button>";
            echo "<button class='bg-danger text-light btn px-4' onclick='cancelOrder($orderId)'>Cancel</button>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";
        }
    } else {
        echo "<div>";
        echo "No pending orders in the cart.";
        echo "</div>";
    }

    echo "</div>";
?>

<script>
    function toggleCartDrawer() {
        $(".cartDrawer").toggleClass('closeCart');
    }
    function confirmOrder(orderId) {
        $.ajax({
            type: "POST",
            url: "../../index.php",
            data: { orderId: orderId, status: "confirmed" },
            success: function(response) {
                // Handle success response
                alert("Order confirmed successfully!");
                window.location.reload();
                location.replace('../../');
                // Reload the cart drawer or update its content
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    }

    function cancelOrder(orderId) {
        $.ajax({
            type: "POST",
            url: "update_status.php",
            data: { orderId: orderId, status: "cancelled" },
            success: function(response) {
                // Handle success response
                alert("Order cancelled successfully!");
                window.location.reload();

                // Reload the cart drawer or update its content
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    }
</script>

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
                                    <!-- Cart icon with link to shopping cart page -->
                                    <a href="#" onClick='toggleCartDrawer()'><i class="fa fa-shopping-cart"></i> Cart</a>
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

                    <?php
                        // Check if success message is set in session
                        if (isset($_SESSION['success_message'])) {
                            // Display notification card
                            echo "<div id='notification' class='notification-card'>";
                            echo $_SESSION['success_message'];
                            echo "<span class='close-button' onclick='closeNotification()'>&times;</span>";
                            echo "</div>";

                            // Unset success message to prevent it from showing again on page refresh
                            unset($_SESSION['success_message']);
                        }
                        ?>

                    <script>
                        // Function to close the notification card
                        function closeNotification() {
                            var notification = document.getElementById('notification');
                            notification.style.top = '-100px'; // Slide the card back off-screen
                        }

                        // Automatically close the notification after 5 seconds
                        setTimeout(closeNotification, 5000); // Adjust the time as needed
                    </script>


                  

                    
                    <div class="hero row align-items-center">
                        <div class="col-md-7"> 

                        <h2 class="text-warning">BEST & AFFORDABLE</h2>
                            <h2 class="text-dark">
                                <span class="text-warning">CLEANING SERVICES</span> 
                            </h2>
                            
                      
                        </div>
                        <div class="col-md-5">
                            <div class="form">
                                <h3>Choose A Category</h3>
                                    <form action="./addCart.php" method="POST">

                                        <script>
                                            function lettersOnly(input){
                                                var regex = /[^a-z]/gi;
                                                input.value= input.value.replace(regex, "");
                                            }
                                        </script>


                                    <!-- <input class="form-control form-text" type="text"  maxlength="15"  name="name" placeholder="Name" onkeyup="lettersOnly (this)" required>
                                        <input class="form-control" type="email" name="email" placeholder="Email" required>
                                
                                        -->
                                        <input class="form-control text-light" type="text" name="slots" id="mobileNumslotsber" value="Available Slots: 10" disabled>    
                                        <input class="form-control" type="tel" min="1" max="10" maxlength="10" name="number" id="mobileNumber" placeholder="07/01..." required>    
                                        <div id="mobileNumberError" class="text-danger"></div>       
                                        <input class="form-control text-light" type="date" name="calendar" id="calender"  min="2024-03-27" required> 
                                        <script>
                                            var today = new Date().toISOString().split('T')[0];
                                            document.getElementById('calendar').setAttribute("min", today);
                                            alert(document.getElementById('calendar').getAttribute('min'));
                                        </script>
                                        <div class="control-group" >
                                            <div class="dropdown">
                                                <button class="btn btn-secondary mb-3 dropdown-toggle w-100" style="background-color: #FFFFFF33; text-align: left; color: white" type="button" id="serviceDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Choose Service
                                                </button>

                                                <div class="dropdown-menu w-100 bg-primary text-light" aria-labelledby="serviceDropdown"  style="box-shadow: 0px 0px 5px 5px gray">
                                                    <div class="dropdown-item d-flex align-items-center gap-5">
                                                        <input type="checkbox" name="service[]" value="House Mopping"> <span for="" class="mb-3 mx-5">House Mopping @sh500</span>
                                                    </div>
                                                    <div class="dropdown-item d-flex align-items-center gap-5">
                                                        <input type="checkbox" name="service[]" value="Dishes Cleaning"> <span for="" class="mb-3 mx-5">Dishes Cleaning @sh500</span>
                                                    </div>
                                                    <div class="dropdown-item d-flex align-items-center gap-5">
                                                        <input type="checkbox" name="service[]" value="Clothes Cleaning"> <span for="" class="mb-3 mx-5">Clothes Cleaning @sh500</span>
                                                    </div>
                                                    <div class="dropdown-item d-flex align-items-center gap-5">
                                                        <input type="checkbox" name="service[]" value="Carpet Cleaning"> <span for="" class="mb-3 mx-5">Carpet Cleaning@sh500</span>
                                                    </div>
                                                    <div class="dropdown-item d-flex align-items-center gap-5">
                                                        <input type="checkbox" name="service[]" value="Beddings"> <span for="" class="mb-3 mx-5">Beddings Cleaning @sh500</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" id="lat" name="lat">
                                        <input type="text" id="long" name="long">
                                        <div class="control-group">
                                            <select class="custom-select" name="region">
                                                                                                
                                                    <option required>Choose A Region</option>
                                                    <option value="36.8770,-1.2946">Buruburu</option>
                                                    <option value="36.8913,-1.3007">Donholm</option>
                                                    <option value="36.8862,-1.2796">Eastlands</option>
                                                    <option value="36.8511,-1.2717">Eastleigh</option>
                                                    <option value="36.8978,-1.3354">Imara Daima</option>
                                                    <option value="37.0154,-1.1023">Juja</option>
                                                    <option value="36.7351,-1.2424">Kabete</option>
                                                    <option value="36.9409,-1.1840">Kahawa</option>
                                                    <option value="36.8396,-1.2790">Kamukunji</option>
                                                    <option value="36.7571,-1.2666">Kangemi</option>
                                                    <option value="36.7105,-1.3297">Karen</option>
                                                    <option value="36.8932,-1.2208">Kasarani</option>
                                                    <option value="36.7409,-1.2914">Kawangware</option>
                                                    <option value="36.6864,-1.2544">Kikuyu</option>
                                                    <option value="36.7658,-1.2881">Kileleshwa</option>
                                                    <option value="36.7845,-1.2920">Kilimani</option>
                                                    <option value="36.9631,-1.4846">Kitengela</option>
                                                    <option value="36.7563,-1.3926">Rongai</option>
                                                    <option value="36.9145,-1.2710">Komarock</option>
                                                    <option value="36.6593,-1.3580">Ngong</option>
                                                    <option value="36.7446,-1.3689">Langata</option>
                                                    <option value="36.8073,-1.2635">Westlands</option>
                                                </select>

                                        </div>

                                        <!-- HTML -->
                                        <div class="control-group">
                                            <div class="dropdown ">
                                                <button class="btn btn-secondary dropdown-toggle w-100 mb-3" style="background-color: #FFFFFF33; text-align: left; color: white"  type="button" id="scheduleDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Choose A Schedule
                                                </button>
                                                <div class="dropdown-menu w-100 bg-primary text-light" aria-labelledby="scheduleDropdown" style="box-shadow: 10px 10px 10px 10px gray">
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Monday</label>
                                                        <input type="time" name="mondayTime" class="form-control">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Tuesday</label>
                                                        <input type="time" name="tuesdayTime" class="form-control">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Wednesday</label>
                                                        <input type="time" name="wednesdayTime" class="form-control">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Thursday</label>
                                                        <input type="time" name="thursdayTime" class="form-control">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Friday</label>
                                                        <input type="time" name="fridayTime" class="form-control">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Saturday</label>
                                                        <input type="time" name="saturdayTime" class="form-control">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label class="mb-0">Sunday</label>
                                                        <input type="time" name="sundayTime" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- HTML -->
                                                              <div>
                    
                                            <button class="control-group btn btn-warning" type="submit" name="submit">SUBMIT</button>
                                        </div>

                                        <div class="my-5">
                                            <div class="bg-success text-light py-3 px-5" style="cursor: pointer" onclick="openLocationModal()">Click to enable location</div>

                                            <!-- Modal -->
                                            <div class="modal" id="locationModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Location Options</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p style="color:black">Choose how to proceed with location:
                                                            Note: Location should be opened at the location of the cleaning scene.
                                                        </p>
                                                        <button type="button" class="btn btn-primary" onclick="enableLocation()">Open Location</button>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->

            
            <script>
                $('dropdown-menu').on('click', function(event){
                    event.stopPropagation();
                });




                document.getElementById('mobileNumber').addEventListener('input', function() {
                    validateMobileNumber(this.value);
                });

                function openLocationModal() {
                    $('#locationModal').modal('show');
                }

                function viewLocationOnMap() {
                    window.location.href="./map.php";
                }



                function validateMobileNumber(number) {
                    var regex = /^(07|01)[0-9]{8}$/;
                    var isValid = regex.test(number);
                    var errorElement = document.getElementById('mobileNumberError');
                    if (!isValid) {
                        errorElement.textContent = 'Invalid phone number';
                    } else {
                        errorElement.textContent = '';
                    }
                }

                function enableLocation() {
                    // Check if Geolocation is supported
                    if (navigator.geolocation) {
                        // Request user permission
                        navigator.geolocation.getCurrentPosition(showPosition, showError);
                    } else {
                        alert("Geolocation is not supported by this browser.");
                    }
                }

                function showPosition(position) {
                    // Position object contains latitude and longitude
                    document.getElementById("lat").value=position.coords.latitude;
                    document.getElementById("long").value=position.coords.longitude;
                    alert("Latitude: " + position.coords.latitude + "\nLongitude: " + position.coords.longitude);
                }

                function showError(error) {
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            alert("User denied the request for Geolocation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Location information is unavailable.");
                            break;
                        case error.TIMEOUT:
                            alert("The request to get user location timed out.");
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("An unknown error occurred.");
                            break;
                    }
                }
            </script>


            <!-- Pricing Plan Start -->
            <div class="price">
                <div class="container">
                    <div class="section-header">
                        <p class="text-primary">PRICING PLAN</p>
                        <h2 class="text-dark">SPECIAL CHARGES</h2>
                    </div>
                    <div class="row ">
                        <div class="col-md-4 ">
                            <div class="price-item">
                                <div class="price-header bg-success">
                                    <div class="price-icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="price-title">
                                        <h2>Standard</h2>
                                    </div>
                                    <div class="price-pricing">
                                        <h2><small></small>1500</h2>
                                    </div>
                                </div>
                                <div class="price-body">
                                    <div class="price-des">
                                        <ul>
                                            <li>5 Bedrooms cleaning</li>
                                            <li>5 Bathrooms cleaning</li>
                                            <li>5 Living room Cleaning</li>
                                            
                                     
                                        </ul>
                                    </div>
                                </div>
                                <div class="price-footer">
                                    <div class="price-action">
                                        <a href="./Ace-cleaners-main(1)/Ace-cleaners-main/index.php"><i class="fa fa-shopping-cart"></i>BOOK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="price-item featured-item ">
                                <div class="price-header bg-success">
                                    <div class="price-icon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price-title">
                                        <h2>Premium</h2>
                                    </div>
                                    <div class="price-pricing">
                                        <h2><small></small>2500</h2>
                                    </div>
                                </div>
                                <div class="price-body">
                                    <div class="price-des">
                                        <ul>
                                            <li>5 Bedrooms cleaning</li>
                                            <li>3 Bathrooms cleaning</li>
                                            <li>2 Living room Cleaning</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="price-footer">
                                    <div class="price-action">
                                        <a href=""><i class="fa fa-shopping-cart"></i>BOOK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="price-item">
                                <div class="price-header bg-success">
                                    <div class="price-icon">
                                        <i class="fa fa-gift"></i>
                                    </div>
                                    <div class="price-title">
                                        <h2>Enterprise</h2>
                                    </div>
                                    <div class="price-pricing">
                                        <h2><small></small>3000</h2>
                                    </div>
                                </div>
                                <div class="price-body">
                                    <div class="price-des">
                                        <ul>
                                            <li>8 Bedrooms cleaning</li>
                                            <li>5 Bathrooms cleaning</li>
                                            <li>3 Living room Cleaning</li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="price-footer">
                                    <div class="price-action">
                                        <button type="submit"><i class="fa fa-shopping-cart"></i>BOOK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <!-- Pricing Plan End -->
<

            <!-- Footer Start -->
            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-contact">
                                <h2>Get In Touch</h2>
                                <p><i class="fa fa-map-marker-alt"></i>Moi Avenue Street, Nairobi, KENYA</p>
                                <p><i class="fa fa-phone-alt"></i>+254713927050</p>
                                <p> <a class="text-white" href="mailto:info@example.com"><i class="fa fa-envelope text-white"></i>acecleaners@gmail.com</p></a>
                                <div class="footer-social">
                                    
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Useful Links</h2>
                                <a href="about.html">About Us</a>
                                <a href="service.html">Our Services</a>
                                <a href="portfolio.html">Our Projects</a>

                                <a href="cont.php" class="nav-item nav-link">Contact</a>
                            
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Useful Link</h2>
                                <a href="portfolio.html">Ongoing Project</a>
                                <a href="contact.html">FAQs</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-form">
                                <h2>Stay Updated</h2>
                                <p>
                                    Incase of any inquiry, feel free to send an email to us.
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
                        <a href="">Help & FQAs</a>
                        <a href="">Contact us</a>
                    </div>
                </div>
                <div class="container copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy;  All Right Reserved.</p>
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
