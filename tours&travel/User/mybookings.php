<?php
session_start();
require_once('../Config/config.php');

global $pdo;

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login']) {
    $userId = $_SESSION['uid']; // Get the user's ID

    // Fetch booking history for the user
    $sql = "SELECT packages.name as packagename, booking.id as bookingid, booking.adults as adults, booking.children as children, booking.message as message, booking.bookingdate as bookedon , booking.arrivaldate as arrivingdate, booking.status as bookingstatus FROM booking JOIN users ON booking.userid = users.id JOIN packages ON booking.packageid = packages.id WHERE booking.userid = ?";

    $statement = $pdo->prepare($sql);
    $statement->execute([$userId]);
    $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML content for displaying booking history
    $bookingHistoryHTML = '';
    $serialNumber = 1; // Initialize the serial number

    foreach ($bookings as $booking) {
        $bookingId = $booking['bookingid'];
        $packageName = $booking['packagename'];
        $bookedOn = $booking['bookedon'];
        $arrivalDate = $booking['arrivingdate'];
        $status = $booking['bookingstatus'];
        $adults = $booking['adults'];
        $children = $booking['children'];
        $message = $booking['message'];

        // Build the HTML for each booking history row
        $bookingHistoryHTML .= "
            <tr>
                <td>{$serialNumber}.</td>
                <td>{$packageName}</td>
                <td>{$bookedOn}</td>
                <td>{$arrivalDate}</td>
                <td>{$status}</td>

                <td>
                    <button type='button' class='btn btn-primary view-modal-btn' 
                            data-toggle='modal' data-target='#viewModal'
                            data-package='{$packageName}' data-booked='{$bookedOn}' data-arrival='{$arrivalDate}' data-status='{$status}'>
                        <i class='far fa-eye'></i>
                    </button>
                    <button type='button' class='btn btn-success edit-modal-btn' 
                            data-toggle='modal' data-target='#editModal'
                            data-booking-id = '{$bookingId}' data-package='{$packageName}' data-booked='{$bookedOn}' data-arrival='{$arrivalDate}' data-adults='{$adults}'
                            data-children='{$children}' data-message='{$message}'>
                        <i class='fas fa-edit'></i>
                    </button>
                    <button type='button' class='btn btn-danger delete-modal-btn'
                        data-toggle='modal' data-target='#deleteModal'
                        data-booking-id='{$bookingId}'>
                        <i class='far fa-trash-alt'></i>
                    </button>
       
                </td>
            </tr>";
            $serialNumber++;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once './includes.html'; ?>
</head>

<body>
<header id="#topheader">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark shadow">
            <div class="container-fluid">
                <a class="navbar-brand h1 fw-bold" href="/Ghumgham/User/"><img src="../Images/logo.svg" alt="logo" class="img-fluid" height="70px" width="70px" />Tours & Travel</a>
                <button 
                    class="navbar-toggler" 
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#navbarNav" 
                    aria-controls="navbarNav" 
                    aria-expanded="false" 
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="mx-auto"></div>
                    <ul class="navbar-nav h5">

                                         <!-- Search Bar -->
<!-- <div class="search-bar">
    <form id="search-form" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" id="search-input" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div> -->

<form method="GET" action="search.php">
    <input type="text" name="destination" placeholder="Enter destination">
    <input type="submit" value="Search">
</form>





                        <li class="nav-item">
                            <a class="nav-link h5" href="/Ghumgham/User/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="/Ghumgham/User/#tourpackages">Destinations</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link h5" href="/Ghumgham/User/#contactus">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="/Ghumgham/User/#aboutus">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5" href="/Ghumgham/User/#privacypolicy">Privacy Policy</a>
                        </li>

       

                    </ul>
                    <ul class="nav navbar-nav flex-row ml-1">
                        <?php

                        if (isset($_SESSION['login']) && $_SESSION['login']) {


                        // if ($_SESSION['login']) {
                        ?>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="text-decoration-none h5">
                                    <img src="../Images/User Images/<?= $_SESSION['image']; ?>" style="width:45px; height:45px; border-radius:50%;" />
                                   
                                </a>
                                <ul class="dropdown-menu small-menu">

                                    <li>
                                        <a class="text-primary" href="./mybookings.php"><span class="material-icons h6">settings</span>My Bookings</a>
                                    </li>
                                    <li>
                                        <a class="text-primary" href="./logout.php"><span class="material-icons h6">logout</span>Logout</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else {
                        ?>
                            <li>
                                <a href="./login.php" class="clickableBtn btn text-white h5 border">login/register</a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </nav>

    </header>
    <!-- Search Bar -->
    <div class="search-bar">
        <form id="search-form" class="form-inline" action="search.php" method="get">
            <!-- Your search form here -->
        </form>
    </div>

<div class="container" style="margin-top: 100px;">
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">S.N</th>
            <th scope="col">Package Name</th>
            <th scope="col">Booked On</th>
            <th scope="col">Arrival Date</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php echo $bookingHistoryHTML; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Start Footer -->
<footer id="footer" class="text-white py-5" style="background:#123335;">
        <div class="container">
            <div class="row text-white">
                <div class="col-lg-6 col-12">
                    <h4 class="text-white">Tours & Travel </h4>
                    <p class="text-white">We are professional Nepal Tour Company, Tour in Nepal with Nepal Travel Agency. Nepal Tour Company Committed Best service reasonable rate guaranteed!</p>
                </div>
                
                <div class="col-lg-3 col-12">
                    <h4 class="text-white">Quick Links</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="./index.php" class=" text-white pb-1">Home</a>
                        <a href="#aboutus" class=" text-white pb-1">About Us</a>
                        <a href="#tourpackages" class=" text-white pb-1">Tour Packages</a>
                        <a href="#privacypolicy" class=" text-white pb-1">Privacy Policy</a>
                        <a href="#contactus" class=" text-white pb-1">Contact Us</a>

                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <h4 class="text-white">Account</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="#" class=" text-white pb-1">My Account</a>
                        <a href="#" class=" text-white pb-1">Booking History</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <div class="copyright text-center bg-dark text-white py-2">
        <p class="text-white">&copy;Copyrights @2022. All rights reserved by <a href="#toppage" class="color-secondary">Tours & Travel </a> </p>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>


    <!-- Additional scripts if needed -->
    <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Booking Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Populate this section with booking details -->
                <p>Package Name: <span id="viewPackageName"></span></p>
                <p>Booked On: <span id="viewBookedOn"></span></p>
                <p>Arrival Date: <span id="viewArrivalDate"></span></p>
                <p>Status: <span id="viewStatus"></span></p>
                <!-- Add more fields as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="editPackageName">Package Name</label>
                        <input type="text" class="form-control" id="editPackageName" name="editPackageName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editBookedOn">Booked On</label>
                        <input type="text" class="form-control" id="editBookedOn" name="editBookedOn" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editArrivalDate">Arrival Date</label>
                        <input type="date" class="form-control" id="editArrivalDate" name="editArrivalDate" required>
                    </div>
                    <div class="form-group">
                        <label for="editArrivalDate">Number of Adults</label>
                        <input type="number" class="form-control" id="editAdults" name="editAdults" required>
                    </div>
                    <div class="form-group">
                        <label for="editArrivalDate">Number of Children</label>
                        <input type="number" class="form-control" id="editChildren" name="editChildren" >
                    </div>
                    <div class="form-group">
                        <label for="editArrivalDate">Message</label>
                        <textarea type="text" class="form-control" id="editMessage" name="editMessage" required></textarea>
                    </div>
                    
                    <!-- Add more editable fields as needed -->
                    <input type="hidden" name="editBookingId" id="editBookingId">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this booking?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
            <!-- Add a hidden input field to store the booking ID -->
            <input type="hidden" name="bookingId" id="deleteBookingId">
        </div>
    </div>
</div>


<script>
$(document).ready(function () {

    $('.view-modal-btn').click(function () {
        var packageName = $(this).data('package');
        var bookedOn = $(this).data('booked');
        var arrivalDate = $(this).data('arrival');
        var status = $(this).data('status');
        

        // Populate view modal content with booking details
        $('#viewPackageName').text(packageName);
        $('#viewBookedOn').text(bookedOn);
        $('#viewArrivalDate').text(arrivalDate);
        $('#viewStatus').text(status);
        // Add more lines to populate other fields as needed
    });

    
$('.delete-modal-btn').click(function () {
var bookingId = $(this).data('booking-id');
console.log(bookingId); // Make sure this correctly logs the bookingId
$('#deleteBookingId').val(bookingId); // Set the value of the hidden input field
});

$('#confirmDeleteBtn').click(function () {
var bookingId = $('#deleteBookingId').val();

// Use AJAX to call the delete script
$.ajax({
url: './delete_booking.php', // Correct path to your PHP delete script
method: 'POST',
data: { bookingId: bookingId },
success: function (response) {
if (response === 'success') {
// Remove the booking row from the table
$('button[data-booking-id="' + bookingId + '"]').closest('tr').remove();

// Close the delete modal
$('#deleteModal').modal('hide');
} else {
console.log('Delete failed');
}
},
error: function (xhr, status, error) {
console.log(error); // Handle error
}
});
});



$('.edit-modal-btn').click(function () {
    var packageName = $(this).data('package');
    var bookedOn = $(this).data('booked');
    var arrivalDate = $(this).data('arrival');
    var adults = $(this).data('adults');
    var children = $(this).data('children');
    var message = $(this).data('message');
    var bookingId = $(this).data('booking-id');

    console.log(packageName, bookedOn, arrivalDate, adults, children, message, bookingId);
    // Populate the form fields in the edit modal
    $('#editBookingId').val(bookingId);

    $('#editPackageName').val(packageName);
    $('#editBookedOn').val(bookedOn);
    $('#editArrivalDate').val(arrivalDate);
    $('#editAdults').val(adults);
    $('#editChildren').val(children);
    $('#editMessage').val(message);
});

$('#saveEditBtn').click(function () {
    var editBookingId = $('#editBookingId').val(); // You might need this for identifying the booking
    
    // Collect edited data from form fields
    var editedArrivalDate = $('#editArrivalDate').val();
    var editedAdults = $('#editAdults').val();
    var editedChildren = $('#editChildren').val();
    var editedMessage = $('#editMessage').val();
    console.log( editedArrivalDate, editedAdults, editedChildren, editedMessage, editBookingId);

    // Use AJAX to send edited data to the server for updating
    $.ajax({
        url: './edit_booking.php', // Correct path to your PHP edit script
        method: 'POST',
        data: {
            bookingId: editBookingId,
            arrivalDate: editedArrivalDate,
            adults:editedAdults,
            children:editedChildren,
            message:editedMessage

            // Add other edited fields as needed
        },
        success: function (response) {
            if (response === 'success') {
                // Update the booking details in the booking history table
                
                $('#editModal').modal('hide');
                location.reload(); // Reload the page to refresh the table
                alert('Booking updated successfully');

            } else {
                console.log('Edit failed');
            }
        },
        error: function (xhr, status, error) {
            console.log(error); // Handle error
        }
    });
});

    

    



});
</script>

</body>

</html>
