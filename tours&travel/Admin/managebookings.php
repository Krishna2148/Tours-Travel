<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location:./index.php");
}
    include './include.html';
    include './menu.html';
    include './nav.php';
    include './bookings.php';
    include './footer.html';
?>
</section>