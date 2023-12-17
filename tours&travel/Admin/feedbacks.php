<?php

    if(!isset($_SESSION['login'])){
        header("Location:./index.php");
    }      

	require_once('../Config/config.php');
	
    global $pdo;
    $sql = "SELECT * FROM usersreview";
    $statement = $pdo->query($sql);
    $feedbacks = $statement->fetchAll(PDO::FETCH_ASSOC);
    


?>

<div class="main">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>User <b>Feedbacks</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="queriesTable">
                    <thead>
                        <tr>
                            <th>
                                <span>
                                    S.N
                                </span>
                                
                            </th>
                            <th>Username</th>
                            <th>Rating</th>
                            <th>Review </th>
                            <th>Reviewed Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $j = 0;
                            foreach($feedbacks as $feedback){
                                $j = $j + 1;    
                            ?>
                            <tr>
                            <td>
                                <span>
                                    <?= $j;?>
                                </span>
                            </td>
                            <td><?=$feedback['username'];?></td>
                            <td>
                            <?php for($i =1;$i<=5;$i++){
                                    if($i<=$feedback['rating']) {?>
                                        <i style="font-size:15px;" class="fas fa-star mr-1 text-warning fs-"></i>
                                    <?php
                                    }
                                    else{
                                        ?>
                                       <i style="font-size:15px;" class="fas fa-star star-light mr-1 main_star"></i>
                                        <?php
                                    }
                                }?>
                            </td>
                            <td><?=$feedback['review'];?></td>
                            <td><?=$feedback['date'];?></td>

                        
                            <td class="d-flex">
                                <button type="button" class="viewFeedbackaBtn btn-sm btn-success mr-1" value="<?=$feedback['id'];?>" data-toggle="modal">view</button>                                
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
    <div id="viewFeedbackModal" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                    <div class="modal-header">						
                        <h4 class="modal-title">View User Feedback</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    				
                    <div class="modal-body">
                        
                    
                        <div class="form-group">
                            <label>Username</label>
                            <p id="view_name" class="form-control"></p>
                        </div>
                        
                        <div class="form-group">
                            <label>Package Name</label>
                            <p id="view_packagename" class="form-control"></p>
                        </div>
                        <div class="form-group">
                            <label>Reviewed On</label>
                            <p id="view_date" class="form-control"></p>
                        </div><div class="form-group">
                            <label>Rating</label>
                            <p id="view_rating" class="form-control"></p>
                        </div>
                        
                        <div class="form-group">
                            <label>Message</label>
                            <p id="view_reviewmessage" class="form-control"></p>
                        </div>    			    
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
            </div>
        </div>
    </div>
   
  <!-- view feedback js -->
  <script>
    $(document).on('click', '.viewFeedbackaBtn', function(e) {
    e.preventDefault();
    var feedback_id = $(this).val();
    
    $.ajax({
        async: true,
        type : "GET",
        url : "./fetchfeedback.php?feedback_id= " + feedback_id,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 404){
                alert(res.message);
            }
            else if(res.status == 200){
                $('#view_name').text(res.data.username);
                $('#view_packagename').text(res.data.packagename);
                $('#view_date').text(res.data.reviewdate);
                $('#view_rating').text(res.data.packagerating);
                $('#view_reviewmessage').text(res.data.reviewmessage);
                $('#viewFeedbackModal').modal('show');
            }
        }
    });
});
  </script>
    
    