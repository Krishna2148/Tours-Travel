<?php
    require_once '../Config/config.php';

    $sql = "SELECT * FROM `pages`";
    $result = $pdo->query($sql);
    if($result){
        $privacy = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($privacy as $pr){
            ?><div class="container">
                <h2 class="text-center" style="color:#348485">Privacy Policy</h2>

                <?php
                            echo $pr['privacypolicy'];
                            ?>
            </div>
            <?php
        }
    }
    
?>