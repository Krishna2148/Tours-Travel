<?php
require_once('../Config/config.php');

global $pdo;
$sql = "
    SELECT vp.*, AVG(ur.rating) AS average_rating
    FROM view_packages AS vp
    JOIN usersreview AS ur ON vp.id = ur.packageid
    GROUP BY vp.id
    ORDER BY average_rating DESC
    LIMIT 6";
$statement = $pdo->query($sql);
$packages = $statement->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Destinations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .heart-btn {
            color: black; /* Initial color (unfilled) */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-3 fw-bolder" style="color:#348485">New Destinations</h2>
        <div class="row justify-content-center align-items-center">
            <?php foreach ($packages as $package) { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 my-3">
                    <a href="./productdetails.php?package_id=<?=$package['id'];?>" class="text-decoration-none text-dark">
                        <div class="card shadow-lg" style="background-color:#CBE6EE;">
                            <div class="p-3">
                                <img src="../Images/LocationImages/<?=$package['image'];?>" class="card-img-top img-fluid rounded" alt="" style="object-fit:cover;">
                            </div>
                            <div class="card-body d-flex">
                                <div class="col-8">
                                    <h5 class="card-title"><?=$package['name'];?></h5>
                                    <span><i class="fa-solid fa-location-dot mr-1 text-info"></i><?=$package['location'];?></span>
                                </div>
                                <div class="col-4 pt-4">
                                    <span class="bg-light bg-gradient rounded p-1"><?=  number_format((float)$package['rating'], 1, '.', '');?><i class="fas fa-star mr-1 text-warning"></i></span>
                                    <button class="btn btn-link heart-btn" data-package-id="<?=$package['id'];?>" onclick="toggleHeart(this)"><i class="fas fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }?>
            <a href="./allpackages.php" class="clickableBtn btn text-center"> View All</a>
        </div>
    </div>
    <script>
        function toggleHeart(button) {
            button.classList.toggle('clicked');
            if (button.classList.contains('clicked')) {
                button.style.color = 'red';
            } else {
                button.style.color = 'black';
            }
        }
    </script>
</body>
</html>
