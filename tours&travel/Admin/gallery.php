<?php

    if(!isset($_SESSION['login'])){
        header("Location:./index.php");
}   
require_once '../Config/config.php';
include_once('./include.html');

$sql = 'SELECT id, name FROM `packages`';
$statement = $pdo->query($sql);
$packages = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="main">
    <div class="container-xl">
        <div class="table-responsive">
            <form method = "POST" action = "./imageuploader.php"  enctype="multipart/form-data">
                <h4>Upload Images</h4>
                <div class="row ml-5 mt-3">
                    <div class="col-sm-3">
                        <label class="form-label">Package Name:</label>
                    </div>
                    <div class="col-sm-6">
                    <select name="package-name" id="package-name" class="form-control">
                        <?php
                            foreach($packages as $package){
                                ?>
                                <option value="<?= $package['id'];?>"><?= $package['name'];?></option>
                                <?php
                            }
                        ?>
                        
                    </select>
                    </div>
                </div>
                <div class="row mt-3 ml-5">
                    <div class="col-sm-3">
                        <label class="form-label">Images</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                </div>

                <div class="col-md-2 text-center">
                    <input type="submit" name="upload" class="form-control btn btn-primary btn-lg mb-2" value="Upload">
                </div>
            </form>
        </div>
    </div>
</div>