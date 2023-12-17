<?php
    if(!isset($_SESSION['login'])){
        header("Location:./index.php");
    }

	require_once('../Config/config.php');
	
    global $pdo;
    $sql = "SELECT booking.id as id, packages.name as packagename, users.name as username, booking.bookingdate as bookedon , booking.arrivaldate as arrivingdate, booking.status as bookingstatus FROM booking JOIN users ON booking.userid = users.id JOIN packages ON booking.packageid = packages.id";
    $statement = $pdo->query($sql);
    $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);
   
?>



<div class="main">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Bookings</b></h2>
                        </div>
                       
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                S.N
                            </th>
                            <th>Package Name</th>
                            <th>Booked By</th>
                            <th>Booked on</th>
                            <th>Arrival Date</th>
                            <th>Status</th>
                            <th>Change Status</th> 
                            <th>Action</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach($bookings as $booking) {
                            $i = $i+1;
                        ?>
                        <tr>
                            <td>
                                <?= $i;?>
                            </td>
                            <td><?= $booking['packagename'];?></td>
                            <td><?= $booking['username'];?></td>
                            <td><?= $booking['bookedon'];?></</td>
                            <td><?= $booking['arrivingdate'];?></</td>
                            <td><?= $booking['bookingstatus'];?></</td>
                            <td>
                                <select onchange = "status_update(this.options[this.selectedIndex].value, '<?= $booking['id'];?>')">
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirm</option>
                                    <option value="Cancelled">Cancel</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="viewBookingBtn btn-sm btn-success mr-1" value="<?=$booking['id'];?>" data-toggle="modal">view</button>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
               
            </div>
        </div>        
    </div>
    <!-- View Modal HTML -->
    <div id="viewBookingModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">						
                        <h4 class="modal-title">Booking Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <div class="form-group">
                            <label>User Name</label>
                            <p class="form-control" id="viewusername"></p>
                        </div>
                        <div class="form-group">
                            <label>User Email</label>
                            <p class="form-control" id="viewuseremail"></p>
                        </div>
                        <div class="form-group">
                            <label>User Address</label>
                            <p class="form-control" id="viewuseraddress"></p>
                        </div>
                        <div class="form-group">
                            <label>User Contact</label>
                            <p class="form-control" id="viewusercontact"></p>
                        </div>		
                        <div class="form-group">
                            <label>Package Booked</label>
                            <p class="form-control" id="viewpackagebooked"></p>
                        </div>	
                        <div class="form-group">
                            <label>Contact Method</label>
                            <p class="form-control" id="viewcontactmethod"></p>
                        </div>	
                        <div class="form-group">
                            <label>Booked Date</label>
                            <p class="form-control" id="viewbookeddate"></p>
                        </div>	
                        <div class="form-group">
                            <label>Arrival Date</label>
                            <p class="form-control" id="viewarrivaldate"></p>
                        </div>	
                        <div class="form-group">
                            <label>Number of adults:</label>
                            <p class="form-control" id="viewnoofadults"></p>
                        </div>		
                        <div class="form-group">
                            <label>Number of Children:</label>
                            <p class="form-control" id="viewnoofchildren"></p>
                        </div>		
                        <div class="form-group">
                            <label>Booking Status:</label>
                            <p class="form-control" id="viewbookingstatus"></p>
                        </div>		
                        <div class="form-group">
                            <label>Booking Message:</label>
                            <p class="form-control" id="viewbookingmessage"></p>
                        </div>				
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
   
    
   <script>


//update booking status
function status_update(value,id){
    let url = "./managepackage.php"
    window.location.href = url + "?id="+id+"&status=" + value;

}

//view package bookings
$(document).on('click', '.viewBookingBtn', function(e) {
    e.preventDefault();
    var booking_id = $(this).val();
    $.ajax({
        async: true,
        type : "GET",
        url : "./managepackage.php?booking_id= "+booking_id,
        success : function(response){
            var res = jQuery.parseJSON(response);
            if(res.status == 404){
                alert(res.message);
            }
            else if(res.status == 200){
                $('#viewusername').text(res.data.username);
                $('#viewuseremail').text(res.data.useremail);
                $('#viewuseraddress').text(res.data.useraddress);
                $('#viewusercontact').text(res.data.usercontact);
                $('#viewpackagebooked').text(res.data.packagename);
                $('#viewcontactmethod').text(res.data.contactmethod);
                $('#viewbookeddate').text(res.data.bookeddate);
                $('#viewarrivaldate').text(res.data.arrivingdate);
                $('#viewnoofadults').text(res.data.noofadults);
                $('#viewnoofchildren').text(res.data.noofchildren);
                $('#viewbookingstatus').text(res.data.bookingstatus);
                $('#viewbookingmessage').text(res.data.bookingmessage);
                $('#viewBookingModal').modal('show');
            }
        }
    });
});
   </script>