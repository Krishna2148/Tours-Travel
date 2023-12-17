<?php

if(!isset($_SESSION['login'])){
header("Location:./index.php");
}   
    require_once('../Config/config.php');
    include_once('./include.html');


?>

<div class="main">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Packages</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-success" data-toggle = "modal" data-target = "#addPackageModal"><i class="material-icons">&#xE147;</i> <span>Add New Package</span></button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="packageTable">
                    <thead>
                        <tr>
                            <th>
                                S.N
                            </th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Route</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            global $pdo;
                            $sql = "SELECT * FROM packages";
                            $statement = $pdo->query($sql);
                            $packages = $statement->fetchAll(PDO::FETCH_ASSOC);
                            $i=0;
                            foreach($packages as $package) {
                                $i = $i+1;    
                            ?>

                            <tr>
                            <td>
                                <?=$i;?>
                            </td>
                            <td><?=$package['name'];?></td>
                            <td><?=$package['location'];?></td>
                            <td><?=$package['route'];?></td>
                            <td><?=$package['duration'];?></td>
                            <td class="d-flex">
                                <button type="button" class="viewPackageBtn btn-sm btn-success mr-1" value="<?=$package['id'];?>" data-toggle="modal">view</button>
                                <button type="button" class="editPackageBtn btn-sm btn-warning mr-2" value="<?=$package['id'];?>" data-toggle="modal">edit</button>
                                <button type="button" name="deletePackageBtn" class="deletePackageBtn btn-sm btn-danger" value="<?=$package['id'];?>" data-toggle="modal">delete</button>
                            </td>
                        </tr>
                        
                        <?php 
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
                
            </div>
        </div>        
    </div>
    <!-- Add Modal HTML -->
    <div id="addPackageModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method = "POST" id="addPackage" autocomplete = "off" enctype = "multipart/form-data">
                    <div class="modal-header">						
                        <h4 class="modal-title">Add tour Package</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    				
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none">
                        
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name = "name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="type" name = "location" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Route</label>
                            <input type="text" name = "route" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Duration(in days)</label>
                            <input type="number" min="1" max="30" name = "duration" class="form-control">
                        </div>	
                        <div class="form-group">
                            <label>Estimated cost per adult(in Rs.)</label>
                            <input type="number" min="1000" name = "estd_cost" class="form-control">
                        </div>		
                        <div class="form-group">
                            <label>Addon cost per child(in Rs.)</label>
                            <input type="number" min="500" name = "child_cost" class="form-control">
                        </div>				
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name = "description"></textarea>
                        </div>		
                        <div class="form-group">
                            <label>What's included?</label>
                            <textarea class="form-control" name = "included"></textarea>
                        </div>	
                        <div class="form-group">
                            <label>What's not included?</label>
                            <textarea class="form-control" name = "notincluded"></textarea>
                        </div>	
                        <div class="form-group">
                            <label>tour Itinerary</label>
                            <textarea class="form-control" name = "itinerary"></textarea>
                        </div>	
                        <div class="form-group">
                            <label>Add Image</label>
                            <input type = "file" class="form-control" name="image" accept=".jpg , .jpeg, .png">
                        </div>		
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" name="add" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editPackageModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method = "POST" id="editPackage" autocomplete = "off" enctype = "multipart/form-data">
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit Tour Package</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    				
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none">
                        </div>
                        <div class="form-group">
                        <input type="hidden" name = "package_id" id="package_id">

                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name = "name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="type" name = "location" id="location" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Route</label>
                            <input type="text" name = "route" id="route" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Duration(in days)</label>
                            <input type="number" min="1" max="30" name = "duration" id="duration" class="form-control">
                        </div>			
                        <div class="form-group">
                            <label>Estimated cost per adult(in Rs.)</label>
                            <input type="number" min="1000"  name = "estd_cost" id="estd_cost" class="form-control">
                        </div>		
                        <div class="form-group">
                            <label>Addon cost per child(in Rs.)</label>
                            <input type="number" min="500" name = "child_cost" id="child_cost" class="form-control">
                        </div>			
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name = "description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>What's included?</label>
                            <textarea class="form-control" name = "included" id="included"></textarea>
                        </div>	
                        <div class="form-group">
                            <label>What's not included?</label>
                            <textarea class="form-control" name = "notincluded" id="notincluded"></textarea>
                        </div>	
                        <div class="form-group">
                            <label>tour Itinerary</label>
                            <textarea class="form-control" name = "itinerary" id="itinerary"></textarea>
                        </div>	
                        <div id="imageContainer" class="form-group">
                            <img id="image-1" src = "" alt= "uploaded image" class="img-fluid"/> 

                        </div>		
                        <div class="form-group">
                            <label>Change Image</label>
                            <input type = "file" class="form-control" name="image" id="image" accept=".jpg , .jpeg, .png">
                        </div>		
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewPackageModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                    <div class="modal-header">						
                        <h4 class="modal-title">View Tour Package</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    				
                    <div class="modal-body">
                        
                    
                        <div class="form-group">
                            <label>Name</label>
                            <p id="view_name" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <p id="view_location" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Route</label>
                            <p id="view_route" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <p id="view_duration" class="form-control"></p>
                        </div>	
                        <div class="form-group">
                            <label>Estimated Cost</label>
                            <p id="view_estimatedcost" class="form-control"></p>
                        </div>	
                        <div class="form-group">
                            <label>Addons per child</label>
                            <p id="view_addons" class="form-control"></p>
                        </div>				
                        <div class="form-group">
                            <label>Description</label>
                            <textarea readonly id="view_description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Package Include</label>
                            <textarea readonly id="view_included" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Package doesn't Include</label>
                            <textarea readonly id="view_notincluded" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Itinerary</label>
                            <textarea readonly id="view_itinerary" class="form-control"></textarea>
                        </div>
                        <div id="imageContainer" class="form-group">
                            <img id="view_image-1" src = "" alt= "uploaded image" class="img-fluid"/> 

                        </div>		
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deletePackageModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deletePackage">
                    <input type="hidden" name="delete_package" value="1">
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete Tour Package</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">		
                    <div id="errorMessageDelete" class="alert alert-warning d-none"></div>
                        <input type="text" name="deletepackage_id" id="deletepackage_id">			
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit"  class="btn btn-danger" id="btnDeletePackage" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    //CRUD Package
// add package
$(document).on('submit' , '#addPackage', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("save_package" , true);
    $.ajax({
        async: true,
        type : "POST",
        url : "./managepackage.php",
        data : formData,
        processData : false,
        contentType : false,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 420 || res.status == 421 || res.status == 422 || res.status == 423){
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
            }
            else if(res.status == 200){
                $('#errorMessage').removeClass('d-none');
                $('#addPackageModal').modal('hide');
                $('#addPackage')[0].reset();

                $('#packageTable').load(location.href + " #packageTable");
                $('#values').load(location.href + " #values");
            }
        } 
    });
});
//edit package
$(document).on('click', '.editPackageBtn', function(e) {
    e.preventDefault();
    var package_id = $(this).val();
    
    $.ajax({
        async: true,
        type : "GET",
        url : "./managepackage.php?package_id= " + package_id,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 404){
                alert(res.message);
            }
            else if(res.status == 200){
                $('#package_id').val(res.data.id);
                $('#name').val(res.data.name);
                $('#location').val(res.data.location);
                $('#route').val(res.data.route);
                $('#duration').val(res.data.duration);
                $('#estd_cost').val(res.data.estimatedcost);
                $('#child_cost').val(res.data.childaddons);
                $('#description').text(res.data.overview);
                $('#included').text(res.data.included);
                $('#notincluded').text(res.data.notincluded);
                $('#itinerary').text(res.data.itinerary);
                $('#image-1').attr('src','../Images/LocationImages/'+res.data.image);
                $('#editPackageModal').modal('show');
            }
        }
    });
});
//update package
$(document).on('submit' , '#editPackage', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("update_package" , true);
    $.ajax({
        async: true,
        type : "POST",
        url : "./managepackage.php",
        data : formData,
        processData : false,
        contentType : false,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 420 || res.status == 421 || res.status == 422 || res.status == 423){
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);
            }
            else if(res.status == 200){
                $('#errorMessageUpdate').removeClass('d-none');
                $('#editPackageModal').modal('hide');
                $('#editPackage')[0].reset();

                $('#packageTable').load(location.href + " #packageTable");
            }
        } 
    });
});

//view package

$(document).on('click', '.viewPackageBtn', function(e) {
    e.preventDefault();
    var package_id = $(this).val();
    
    $.ajax({
        async: true,
        type : "GET",
        url : "./managepackage.php?package_id= " + package_id,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 404){
                alert(res.message);
            }
            else if(res.status == 200){
                $('#view_name').text(res.data.name);
                $('#view_location').text(res.data.location);
                $('#view_route').text(res.data.route);
                $('#view_duration').text(res.data.duration);
                $('#view_estimatedcost').text(res.data.estimatedcost);
                $('#view_addons').text(res.data.childaddons);
                $('#view_description').text(res.data.overview);
                $('#view_included').text(res.data.included);
                $('#view_notincluded').text(res.data.notincluded);
                $('#view_itinerary').text(res.data.itinerary);
                $('#view_image-1').attr('src','../Images/LocationImages/'+res.data.image);
                $('#viewPackageModal').modal('show');
            }
        }
    });
});
//show deletePackageform
$(document).on('click','.deletePackageBtn',function(e){
    e.preventDefault();
    var package_id = $(this).val();
    $('#deletepackage_id').val(package_id);
    $('#deletePackageModal').modal('show');

});

//delete tour package
$(document).on('submit','#deletePackage',function(e){
    // formData = $('#deletePackage').serialize();

    e.preventDefault();
    var formData = new FormData(this);
    formData.append("delete_package" , true);

    $.ajax({
        async : true,
        type : 'POST',
        url : "./managepackage.php",
        data : formData,
        processData: false,
        contentType: false,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 422 || res.status == 423){
                $('#errorMessageDelete').removeClass('d-none');
                $('#errorMessageDelete').text(res.message);
            }
            else if(res.status == 200){
                $('#errorMessageDelete').removeClass('d-none');
                $('#deletePackageModal').modal('hide');
                $('#deletePackage')[0].reset();
                $('#packageTable').load(location.href + " #packageTable");
            }
        }

    });

});        

</script>