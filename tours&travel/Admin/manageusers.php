<?php

session_start();
    if(!isset($_SESSION['login'])){
        header("Location:./index.php");
}   
    include_once('./include.html');
    include_once('./menu.html');
    include_once('./nav.php');

    include_once('./manageuserstemplate.php');
    include_once('./footer.html');
?>
</section>