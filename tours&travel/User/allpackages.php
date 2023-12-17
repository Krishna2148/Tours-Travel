<?php
session_start();
require_once('../Config/config.php');

global $pdo;
$sql = "SELECT * FROM view_packages";
$statement = $pdo->query($sql);
$packages = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>

    <?php
    include_once './includes.html';
    ?>

</head>

<body>
    <header id="#topheader">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark shadow p-md-3">
            <div class="container-fluid">
            <a class="navbar-brand h1 fw-bold" href="#toppage"><img src="../Images/logo.svg" alt="logo" class="img-fluid" height="70px" width="70px" />Tours & Travel </a>
                <button class="navbar-toggler" style="color: #348485;" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                    <ul class="navbar-nav h5">
                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#toppage">home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#tourpackages">Destination</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#contactus">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#aboutus">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#privacypolicy">Privacy Policy</a>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav flex-row ml-1">
                        <?php
                        if (isset($_SESSION['login'])) {
                        ?>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="btn text-decoration-none h5" style="color:#348485;">
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
                                <a href="./login.php" class="clickableBtn btn text-white border">login/register</a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </nav>

    </header>

    <div class="container" style="margin-top:150px;">
        <h2 class="text-center mt-5 fw-bolder" style="color:#348485">All Destinations</h2>
        <div class="row justify-content-center align-items-center">
            <?php
            foreach ($packages as $package) {


            ?>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 my-3" >
                    <a href="./productdetails.php?package_id=<?= $package['id']; ?>" class="text-decoration-none text-dark">
                        <div class="card shadow-lg" style="background-color:#CBE6EE;">
                            <div class="p-3">
                                <img src="../Images/LocationImages/<?= $package['image']; ?>" class="card-img-top img-fluid rounded" alt="" style="object-fit:cover;">
                            </div>
                            <div class="card-body d-flex">
                                <div class="col-8">
                                    <h5 class="card-title"><?= $package['name']; ?></h5>
                                    <span><i class="fa-solid fa-location-dot mr-1 text-info"></i><?= $package['location']; ?></span>
                                </div>
                                <div class="col-4 pt-4">
                                    <span class="bg-light bg-gradient rounded p-1"><?= number_format((float)$package['rating'], 1, '.', ''); ?><i class="fas fa-star mr-1 text-warning"></i>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>

    </div>
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