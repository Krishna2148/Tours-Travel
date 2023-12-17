<?php


    if(!isset($_SESSION['login'])){
        header("Location:./index.php");
    }      
	require_once('../Config/config.php');
	
    global $pdo;
    $sql = "SELECT * FROM contact";
    $statement = $pdo->query($sql);
    $queries = $statement->fetchAll(PDO::FETCH_ASSOC);
    



?>

<div class="main">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Queries</b></h2>
                        </div>
                        
                    </div>
                </div>
                <table class="table table-striped table-hover" id="queriesTable">
                    <thead>
                        <tr>
                            <th>
                                <span >
                                    S.N
                                </span>
                                
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                            foreach($queries as $query){
                                $i = $i + 1;    
                            ?>
                            <tr>
                            <td>
                                <span>
                                    <?=$i;?>
                                </span>
                            </td>
                            <td><?=$query['name'];?></td>
                            <td><?=$query['email'];?></td>
                            <td><?=$query['message'];?></td>
                            
                            <td class="d-flex">
                                <button type="button" class="viewQueryBtn btn-sm btn-success mr-1" value="<?=$query['id'];?>" data-toggle="modal">view</button>
                                <button type="button" name="deleteQueryBtn" class="deleteQueryBtn btn-sm btn-danger" value="<?=$query['id'];?>" data-toggle="modal">delete</button>
                                
                            </td>
                        </tr>
                            
                        <?php }
                        ?>
                        
                        
                    </tbody>
                </table>
               
            </div>
        </div>        
    </div>
    
    <!-- View Modal -->
    <div id="viewQueryModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                    <div class="modal-header">						
                        <h4 class="modal-title">View User Query</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    				
                    <div class="modal-body">
                        
                    
                        <div class="form-group">
                            <label>Name</label>
                            <p id="view_name" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <p id="view_email" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <p id="view_message" class="form-control"></p>
                        </div>
                        			
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
            </div>
        </div>
    </div>
   
    <!-- Delete Modal HTML -->
    <div id="deleteQueryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteQuery">
                    <div class="modal-header">						
                        <h4 class="modal-title">Delete User Query</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div id="deleteQueryMessage" class="alert alert-warning d-none"></div>
                        <input type="hidden" name="deletequery_id" id="deletequery_id">		
                        					
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script>
    //CRUD queries
//view user queries
$(document).on('click', '.viewQueryBtn', function(e) {
    e.preventDefault();
    var query_id = $(this).val();
    
    $.ajax({
        async: false,
        type : "GET",
        url : "./fetchquery.php?query_id= " + query_id,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 404){
                alert(res.message);
            }
            else if(res.status == 200){
                $('#view_name').text(res.data.name);
                $('#view_email').text(res.data.email);
                $('#view_message').text(res.data.message);
                $('#viewQueryModal').modal('show');
            }
        }
    });
});
//show delete query form
$(document).on('click','.deleteQueryBtn',function(e){
    e.preventDefault();
    var user_id = $(this).val();
    $('#deletequery_id').val(user_id);
    $('#deleteQueryModal').modal('show');

});

//delete user query
$(document).on('submit','#deleteQuery',function(e){
    var formData = new FormData(this);
    formData.append("delete_query" , true);
    $.ajax({
        async : true,
        type : 'POST',
        url : "./fetchquery.php",
        data : formData,
        processData: false,
        contentType: false,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 422 || res.status == 423){
                $('#deleteQueryMessage').removeClass('d-none');
                $('#deleteQueryMessage').text(res.message);
            }
            else if(res.status == 200){
                $('#deleteQueryMessage').removeClass('d-none');
                $('#deleteQueryModal').modal('hide');
                $('#deleteQuery')[0].reset();
                $('#queriesTable').load(location.href + " #queriesTable");
            }
        }

    });

});  

</script>