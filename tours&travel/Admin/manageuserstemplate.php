<?php

    if(!isset($_SESSION['login'])){ 
        header("Location:./index.php");
}   

	require_once('../Config/config.php');
	
        global $pdo;
        $sql = "SELECT * FROM users";
        $statement = $pdo->query($sql);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        

	
	

?>



<div class="main">
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					
				</div>
			</div>
			<table class="table table-striped table-hover" id="usersTable">
				<thead>
					<tr>
						<th>
							<span>
								S.N
							</span>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0 ;
						foreach ($users as $user) {
							$i = $i+1;
					?>
					<tr>
                        <td>
                            <?=$i;?>
                        </td>
                        <td><?=$user['name']?></td>
                        <td><?=$user['email'];?></td>
                        <td><?=$user['address'];?></td>
                        <td><?=$user['contact'];?></td>
                        <td class="d-flex">
							<button type="button" class="viewUserBtn btn-sm btn-success mr-1" value="<?=$user['id'];?>" data-toggle="modal">view</button>
							<button type="button" class="deleteUserBtn btn-sm btn-danger mr-1" value="<?=$user['id'];?>" data-toggle="modal">delete</button>
                        </td>
                    </tr>
					<?php }?>
				</tbody>
			</table>
			
		</div>
	</div>        
</div>

<!-- View Modal HTML -->
<div id="viewUserModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                    <div class="modal-header">						
                        <h4 class="modal-title">View User Details</h4>
                        
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
                            <label>Address</label>
                            <p id="view_address" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <p id="view_contact" class="form-control"></p>
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
<div id="deleteUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="deleteUser">
				<div class="modal-header">						
					<h4 class="modal-title">Delete User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				<div id="errorMessageUserDelete" class="alert alert-warning d-none"></div>
				<input type="hidden" name="deleteuser_id" id="deleteuser_id">			
					
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

//CRUD users
//view users
$(document).on('click', '.viewUserBtn', function(e) {
    e.preventDefault();
    var user_id = $(this).val();
    
    $.ajax({
        async: true,
        type : "GET",
        url : "./fetchuser.php?user_id= " + user_id,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 404){
                alert(res.message);
            }
            else if(res.status == 200){
                $('#view_name').text(res.data.name);
                $('#view_email').text(res.data.email);
                $('#view_address').text(res.data.address);
                $('#view_contact').text(res.data.contact);
                $('#view_image-1').attr('src','../Images/User Images/'+res.data.image);
                $('#viewUserModal').modal('show');
            }
        }
    });
});
//show delete user form
$(document).on('click','.deleteUserBtn',function(e){
    e.preventDefault();
    var user_id = $(this).val();
    $('#deleteuser_id').val(user_id);
    $('#deleteUserModal').modal('show');

});

//delete user 
$(document).on('submit','#deleteUser',function(e){
    var formData = new FormData(this);
    formData.append("delete_user" , true);
    $.ajax({
        async : false,
        type : 'POST',
        url : "./fetchuser.php",
        data : formData,
        processData: false,
        contentType: false,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 422 || res.status == 423){
                $('#errorMessageUserDelete').removeClass('d-none');
                $('#errorMessageUserDelete').text(res.message);
            }
            else if(res.status == 200){
                $('#errorMessageUserDelete').removeClass('d-none');
                $('#deleteUserModal').modal('hide');
                $('#deleteUser')[0].reset();
                $('#usersTable').load(location.href + " #usersTable");
            }
        }

    });

});  

</script>

