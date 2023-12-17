<?php


if(!isset($_SESSION['login'])){
header("Location:./index.php");
}   
require_once('../Config/config.php');





?>


<div id="content">

    <!--top--navbar----design--------->

    <div class="top-navbar">
        <div class="xp-topbar">

            <!-- Start XP Row -->
            <div class="row">
                <!-- Start XP Col -->
                <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                    <div class="xp-menubar">
                        <span class="material-icons text-white">signal_cellular_alt
                        </span>
                    </div>
                </div>
                <!-- End XP Col -->

                <!-- Start XP Col -->
                <div class="col-md-5 col-lg-3 order-3 order-md-2">
                    <!-- <div class="xp-searchbar">
                        <form>
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn" type="submit" id="button-addon2">GO</button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                    <div class="xp-breadcrumbbar text-center">
                        <h4 class="page-title">Dashboard</h4>
                </div>
                </div>
                <!-- End XP Col -->

                <!-- Start XP Col -->
                <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                    <div class="xp-profilebar text-right">
                        <nav class="navbar p-0">
                            <ul class="nav navbar-nav flex-row ml-auto">

                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" data-toggle="dropdown">
                                        <img src="../Images/admin.png" style="width:40px; border-radius:50%;" />
                                        <span class="xp-user-live"></span>
                                    </a>
                                    <ul class="dropdown-menu small-menu">
                                        <li>
                                            <a href="#">
                                                <span class="material-icons">person_outline</span>Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="material-icons">settings</span>Settings</a>
                                        </li>
                                        <li>
                                            <a href="./logout.php"><span class="material-icons">logout</span>Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>


                        </nav>

                    </div>
                </div>
                <!-- End XP Col -->

            </div>
            <!-- End XP Row -->

        </div>
        

    </div>
    <div class="values">
        <?php
        global $pdo;
        $number_of_users = $pdo->query('select count(*) from users')->fetchColumn();
        $total_packages = $pdo->query('select count(*) from packages')->fetchColumn();
        $total_bookings = $pdo->query('select count(*) from booking')->fetchColumn();
        $total_queries = $pdo->query('select count(*) from contact')->fetchColumn();
        ?>
        <div class="val-box">
            <i class="fas fa-users"></i>
            <div>
                <h3><?= $number_of_users; ?></h3>

                <span>Total users</span>
            </div>
        </div>

        <div class="val-box">

            <i class="fa fa-list-ul" aria-hidden="true"></i>
            <div>
                <h3><?= $total_packages; ?></h3>
                <span>Total Packages</span>
            </div>
        </div>
        <div class="val-box">

            <i class="fa fa-list-ul" aria-hidden="true"></i>
            <div>
                <h3><?= $total_bookings; ?><h3>
                        <span>Total Bookings</span>
            </div>
        </div>

        <div class="val-box">
            <i class="fa fa-question" aria-hidden="true"></i>
            <div>
                <h3><?= $total_queries; ?></h3>
                <span>Total Queries</span>
            </div>
        </div>
    </div>
