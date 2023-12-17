<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>

    <?php
        include_once './includes.html';
    ?>

</head>

<body id="toppage">
    <!-- navbar -->
    <header id="#topheader">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark shadow">
            <div class="container-fluid">
                <a class="navbar-brand h1 fw-bold" href="#toppage"><img src="../Images/logo.svg" alt="logo" class="img-fluid" height="70px" width="70px" />Tours & Travel</a>
                <button 
                    class="navbar-toggler" 
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#navbarNav" 
                    aria-controls="navbarNav" 
                    aria-expanded="false" 
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="mx-auto"></div>
                    <ul class="navbar-nav h5">

                                         <!-- Search Bar -->
<!-- <div class="search-bar">
    <form id="search-form" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" id="search-input" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div> -->

<form method="GET" action="search.php">
    <input type="text" name="destination" placeholder="Enter destination">
    <input type="submit" value="Search">
</form>





                        <li class="nav-item">
                            <a class="nav-link h5" href="#toppage">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="#tourpackages">Destinations</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link h5" href="#contactus">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="#aboutus">About us</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link h5" href="#privacypolicy">Privacy Policy</a>
                        </li> -->

       

                    </ul>
                    <ul class="nav navbar-nav flex-row ml-1">
                        <?php

                        if (isset($_SESSION['login']) && $_SESSION['login']) {


                        // if ($_SESSION['login']) {
                        ?>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="text-decoration-none h5">
                                    <img src="../Images/User Images/<?= $_SESSION['image']; ?>" style="width:45px; height:45px; border-radius:50%;" />
                                   
                                </a>
                                <ul class="dropdown-menu small-menu">

                                    <li>
                                        <a class="text-primary" href="./mybookings.php"><span class="material-icons h6">settings</span>My Bookings</a>
                                    </li>
                                    <li>
                                        <a class="text-primary" href="./logout.php"><span class="material-icons h6">logout</span>Logout</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else {
                        ?>
                            <li>
                                <a href="./login.php" class="clickableBtn btn text-white h5 border">login/register</a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </nav>

    </header>
    
    <section id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="../Images/image3.jpg" alt="First slide" height="600px" style="object-fit:cover;">
                <div class="carousel-caption d-none d-md-block">
                <span class="carousel-caption">Find new adventures with Tours & Travel </span>
                    <div class="slider-btn">
                        <a href="#tourpackages" class="clickableBtn btn banner-caption">Start Now</a>
                    </div>
                </div>

            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="../Images/image9.jpg" alt="First slide" height="600px" style="object-fit:cover;">
                <div class="carousel-caption d-none d-md-block">
                <span class="carousel-caption">Find new adventures with Tours & Travel  </span>
                    <div class="slider-btn">
                        <a href="#tourpackages" class="clickableBtn btn banner-caption">Start Now</a>
                    </div>
                </div>
            </div>

            

            <div class="carousel-item">
            <img class="d-block w-100" src="../Images/image7.jpg" alt="First slide" height="600px" style="object-fit:cover;">
                <div class="carousel-caption d-none d-md-block">
                    <span class="carousel-caption">Find new adventures with Tours & Travel  </span>
                    <div class="slider-btn">
                        <a href="#tourpackages" class="clickableBtn btn banner-caption">Start Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </section>

    <section id="tourpackages">
        <?php
        include_once "./package.php";
        ?>
    </section>
    <section id="contactus">
        <?php
        include_once "./contactform.php";
        ?>
    </section>
    <section id="aboutus">
        <?php
            include_once "./aboutus.php";
        ?>
    </section>
   
    <section id="privacypolicy">
           <?php
            include_once "./privacypolicy.php";
           ?>
    </section>
    <!-- Start Footer -->
    <footer id="footer" class="text-white py-5" style="background:#123335;">
        <div class="container">
            <div class="row text-white">
                <div class="col-lg-6 col-12">
                    <h4 class="text-white">Tours & Travel </h4>
                    <p class="text-white">We are professional Nepal Tour Company, Tour in Nepal with Nepal Travel Agency. Nepal Tour Company Committed Best service reasonable rate guaranteed!</p>
                </div>
                
                <div class="col-lg-3 col-12">
                    <h4 class="text-white">Quick Links</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="./index.php" class=" text-white pb-1">Home</a>
                        <a href="#aboutus" class=" text-white pb-1">About Us</a>
                        <a href="#tourpackages" class=" text-white pb-1">Tour Packages</a>
                        <a href="#privacypolicy" class=" text-white pb-1">Privacy Policy</a>
                        <a href="#contactus" class=" text-white pb-1">Contact Us</a>

                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <h4 class="text-white">Account</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="#" class=" text-white pb-1">My Account</a>
                        <a href="#" class=" text-white pb-1">Booking History</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <div class="copyright text-center bg-dark text-white py-2">
        <p class="text-white">&copy;Copyrights @2022. All rights reserved by <a href="#toppage" class="color-secondary">Tours & Travel </a> </p>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>