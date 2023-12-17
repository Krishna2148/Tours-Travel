<?php
session_start();

require_once '../Config/config.php';

$package_id = trim($_GET['package_id']);

$sql = "SELECT * FROM `packages` WHERE `id` = :id";
$handle = $pdo->prepare($sql);
$params = [
    ':id' => $package_id
];
$result = $handle->execute($params);
if ($result) {
    $package = $handle->fetch(PDO::FETCH_ASSOC);
}
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                    <ul class="navbar-nav h5">
                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#toppage">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="./index.php#tourpackages">Destinations</a>
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
                                <a href="#" data-toggle="dropdown" class="text-decoration-none h5" style="color:#348485;">
                                    <img src="../Images/User Images/<?= $_SESSION['image']; ?>" style="width:45px; height:45px; border-radius:50%;" />
                                   
                                </a>
                                <ul class="dropdown-menu small-menu">
                                    <li>
                                        <a class="text-primary" href="./mybookings.php"><span class="material-icons h6">settings</span>My Bookings</a>
                                    </li>
                                    <li>
                                        <a class="text-primary" href="./logout.php"><span class="material-icons h6">logout</span>logout</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else {
                        ?>
                            <li>
                                <a href="./login.php" class=" clickableBtn btn text-white border">login/register</a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </nav>

    </header>

    <div class="container-fluid mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="product-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center pt-3 mt-5 mb-3"> <img id="main-image" src="../Images/LocationImages/<?= $package['image']; ?>" class="img-fluid rounded" /> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="room-heading row d-flex mt-5 pt-3 mb-3">
                                    <div class="col-lg-8">
                                        <h2 class="text-uppercase mb-0"><?= $package['name']; ?></< /h2>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <ul class="mb-5 list-unstyled">
                                        <li class="mx-3">
                                            <p>Duration: <span><?= $package['duration']; ?></span></p>
                                        </li>
                                        <li class="mx-3">
                                            <p>Location: <span><?= $package['location']; ?></span></p>
                                        </li>
                                        <li class="mx-3">
                                            <p>Route: <span><?= $package['route']; ?></span></p>
                                        </li>
                                        <li class="mx-3">
                                            <p>Estimated cost(per adult): <span>Rs.<?= $package['estimatedcost']; ?></span></p>
                                        </li>
                                        <li class="mx-3">
                                            <p>Addon cost(per child): <span>Rs.<?= $package['childaddons']; ?></span></p>
                                        </li>

                                    </ul>
                                </div>
                                <div class="cart mt-4 align-items-center">
                                    <?php if(isset($_SESSION['login'])){?>
                                    <button class="clickableBtn bookPackageBtn btn text-uppercase mr-2 ml-5 px-4" value="<?= $package['id']; ?>" data-toggle="modal">Request Booking</button>
                                    <?php 
                                    }else{
                                    ?>
                                    <a href="./login.php" class="text-uppercase mr-2 ml-5 px-4">login or register</a><span> to book this package</span>

                                    <?php }?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-11 p-4 shadow">
                            <h4>Overview</h4>
                            <p><?= nl2br($package['overview']); ?></p>
                        </div>
                    </div>
                    <div class="row justify-content-center">

                        <div class="col-md-5 p-4 shadow m-3">

                            <h4>Included</h4>
                            <p><?= nl2br($package['included']); ?></p>
                        </div>
                        <div class="col-md-5 p-4 shadow m-3">

                            <h4>Not Included</h4>
                            <p><?= nl2br($package['notincluded']); ?></p>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-11 p-4 shadow">
                            <h4>Detailed day wise itinerary:</h4>
                            <p><?= nl2br($package['itinerary']); ?></p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-11 p-4 shadow">
                            <h4>Tour Gallery<h4>
                                    <!-- Gallery -->
                                    <div class="row">
                                        <?php
                                        $selectquery = 'SELECT * FROM `gallery` WHERE packageid=:pid';
                                        $sqlhandle = $pdo->prepare($selectquery);
                                        $paras = [
                                            ':pid' => $package_id
                                        ];
                                        $resultimages = $sqlhandle->execute($paras);
                                        if ($resultimages) {
                                            $images = $sqlhandle->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($images as $image) {
                                        ?>
                                                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                                    <img src="../Images/Gallery/<?= $image['image']; ?>" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
                                                </div>

                                            <?php
                                            }
                                        } else { ?>
                                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                                <p>No image gallery uploaded for this tour package</p>
                                            </div>

                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <!-- Gallery -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="user-review" class="container shadow p-4 mb-5">
        <?php
        $average_rating = 0;
        $total_reviews = 0;
        $five_star_reviews = 0;
        $four_star_reviews = 0;
        $three_star_reviews = 0;
        $two_star_reviews = 0;
        $one_star_reviews = 0;
        $total_user_rating = 0;

        $query = 'SELECT * FROM `usersreview` WHERE packageid=:pid ORDER BY id DESC ';
        $queryhandle = $pdo->prepare($query);
        $parameters = [
            ':pid' => $package_id
        ];
        $resultset = $queryhandle->execute($parameters);
        if ($resultset) {
            $packages = $queryhandle->fetchAll(PDO::FETCH_ASSOC);
        }
        foreach ($packages as $row) {
            $rating = (int)$row['rating'];
            if ($rating == 5) {
                $five_star_reviews++;
            }
            if ($rating == 4) {
                $four_star_reviews++;
            }
            if ($rating == 3) {
                $three_star_reviews++;
            }
            if ($rating == 2) {
                $two_star_reviews++;
            }
            if ($rating == 1) {
                $one_star_reviews++;
            }
            $total_reviews++;
            $total_user_rating = $total_user_rating + $row['rating'];
        }
        if ($total_reviews > 0) {
            $average_rating = $total_user_rating / $total_reviews;
        }
        ?>
        <div class="review-card">
            <div class="card-header">
                <h3 class="mt-2 mb-2">Tourist Reviews</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating"><?= number_format((float)$average_rating, 1, '.', ''); ?></span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $average_rating) { ?>
                                    <i class="fas fa-star mr-1 text-warning"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                            <?php
                                }
                            }
                            ?>

                        </div>
                        <h4><span id="total_review">Total: <?= $total_reviews; ?></span> reviews</h4>
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><?php
                                                            for ($i = 1; $i <= 5; $i++) {
                                                            ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php
                                                            }
                            ?>
                        </div>

                        <div class="progress-label-right">(<span id="total_five_star_review"><?= $five_star_reviews; ?> reviews</span>)</div>

                        </p>
                        <p>
                        <div class="progress-label-left"><?php
                                                            for ($i = 1; $i <= 4; $i++) {
                                                            ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php
                                                            }
                            ?>
                        </div>

                        <div class="progress-label-right">(<span id="total_four_star_review"><?= $four_star_reviews; ?> reviews</span>)</div>

                        </p>
                        <p>
                        <div class="progress-label-left"><?php
                                                            for ($i = 1; $i <= 3; $i++) {
                                                            ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php
                                                            }
                            ?>
                        </div>

                        <div class="progress-label-right">(<span id="total_three_star_review"><?= $three_star_reviews; ?> reviews</span>)</div>

                        </p>
                        <p>
                        <div class="progress-label-left"><?php
                                                            for ($i = 1; $i <= 2; $i++) {
                                                            ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php
                                                            }
                            ?>
                        </div>
                        <div class="progress-label-right">(<span id="total_two_star_review"><?= $two_star_reviews; ?> reviews</span>)</div>

                        </p>
                        <p>
                        <div class="progress-label-left"><?php
                                                            for ($i = 1; $i <= 1; $i++) {
                                                            ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php
                                                            }
                            ?>
                        </div>

                        <div class="progress-label-right">(<span id="total_one_star_review"><?= $one_star_reviews; ?> reviews</span>)</div>

                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn clickableBtn" value="<?= $package['id'] ?>">Review</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $query = 'SELECT * FROM `usersreview` WHERE packageid=:pid ORDER BY id DESC ';
            $queryhandle = $pdo->prepare($query);
            $parameters = [
                ':pid' => $package_id
            ];
            $resultset = $queryhandle->execute($parameters);
            if ($resultset) {
                $reviews = $queryhandle->fetchAll(PDO::FETCH_ASSOC);
            }
            foreach ($reviews as $review) {
            ?>
                <div class="col-md-11 p-4 border my-2">
                    <div class="d-flex">
                        <div class="col-lg-7">
                            <h5 class="fw-bold"><?= $review['username']; ?></h5>
                        </div>
                        <div class="col-lg-5">
                            <?php for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $review['rating']) {
                            ?>
                                    <i class="fas fa-star mr-1 text-warning"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <p><?= $review['review']; ?></p>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>


    <div id="review_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#CBE6EE;">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>
                    <div class="form-group">
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                    </div>
                    <div class="form-group">
                        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn clickableBtn" id="save_review" value=<?= $package['id']; ?>>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="bookPackageModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#CBE6EE;">
                <form method="POST" id="bookPackage" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="packageid" id="packageid" value="<?php echo $package_id; ?>" >
                    <div class="modal-header">
                        <h4 class="modal-title">Request Booking</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                    <h6>All fields are required</h6>

                        <div id="errorBookingMessage" class="alert alert-warning d-none">
                            
                        </div>
                        <div class="form-group">
                            <label>Expected arrival date ?</label>
                            <input type="date" name="arrival_date" id="arrival_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>How many adutls in your group ?</label>
                            <input type="number" min="1" max="20" default="1" name="adults" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>How many children in your group ?</label>
                            <input type="number" min="0" max="20" default="0" name="children" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>What is the best way to contact you ?</label><br />
                            <input type="radio" name="contactmethod" value="Email">
                            <label for="contactmethod">Email</label><br />
                            <input type="radio" name="contactmethod" value="phone call">
                            <label for="contactmethod">Phone</label>


                        </div>

                        <div class="form-group">
                            <label>Anything else we should know ?</label>
                            <textarea class="form-control" name="message"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" name="book" class="clickableBtn btn">Request Booking</button>
                    </div>
                </form>
            </div>
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
<?php


?>
<script>
    var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
   dd = '0' + dd;
}

if (mm < 10) {
   mm = '0' + mm;
} 
    
today = yyyy + '-' + mm + '-' + dd;
document.getElementById("arrival_date").setAttribute("min", today);

</script>