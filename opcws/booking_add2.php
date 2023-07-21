<?php
// Start or resume the session
session_start();

// Include the 'database.php' file which contains the necessary functions and connection to the database
include("database.php");

// Check if the customer is verified (logged in)
// If not, redirect to 'index.php'
if (!verifyCustomer($con)) {
    //header("Location: index.php");
    return false;
}

// Initialize variables with values from request data (if available) or empty strings if not set
$act = (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';
$id_service = (isset($_REQUEST['id_service'])) ? trim($_REQUEST['id_service']) : '';
$id_provider = (isset($_POST['id_provider'])) ? trim($_POST['id_provider']) : '';
$booking_date = (isset($_POST['booking_date'])) ? trim($_POST['booking_date']) : '';
$booking_time = (isset($_POST['booking_time'])) ? trim($_POST['booking_time']) : '';

// Get the customer ID from the session variable
$id_customer = $_SESSION["id_customer"];

// Initialize a variable to store success messages
$success = "";

// Check if the action is 'add' (booking process)
if ($act == "add") {
    // Generate a random booking ID
    $booking_id = rand(10000, 90000);

    // Prepare and execute the SQL query to insert the booking details into the 'booking' table
    $SQL_insert = "
        INSERT INTO `booking`(`id_booking`, `id_provider`, `id_customer`, `id_service`, `booking_id`, `booking_date`, `booking_time`, `status`, `created_date`)
        VALUES (NULL, '$id_provider', '$id_customer', '$id_service', '$booking_id', '$booking_date', '$booking_time', 'Waiting', NOW())
    ";

    $result = mysqli_query($con, $SQL_insert);

    // Get the ID of the last inserted booking
    $id_booking = mysqli_insert_id($con);

    // Set a success message
    $success = "Successfully Booked";

    // Redirect to the 'booking-success.php' page with the booking ID as a parameter
    header("Location: booking-success.php?id_booking=" . $id_booking);
    exit();
}

// Retrieve service and provider details for the specified service ID
$rst = mysqli_query($con, "SELECT * FROM `service`, `provider` WHERE service.id_provider = provider.id_provider AND `id_service` = $id_service");
$dat = mysqli_fetch_array($rst);
$title = $dat["title"];
$location = $dat["location"];
$postcode = $dat["postcode"];
$city = $dat["city"];
$id_provider = $dat["id_provider"];
$name_provdr = $dat["name"];

// Retrieve customer details for the currently logged-in customer
$SQL_view = "SELECT * FROM `customer` WHERE `email` =  '" . $_SESSION["email"] . "'";
$result = mysqli_query($con, $SQL_view);
$data = mysqli_fetch_array($result);
$name = $data["name"];
$phone = $data["phone"];

// Initialize a variable to store the bill counter (current value: 0)
$bil = 0;
?>

<!DOCTYPE html>
<html>
<title>CAR WASH SERVICES</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.5;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  background-attachment: fixed;
  background-image: url(images/carwashbg.png);
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}

.w3-strike {
	text-decoration: line-through;	
}
</style>

<script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
function checkSetting() {
  // Retrieving values from the input fields
  var name = document.getElementById("booking_date").value;
  var name2 = document.getElementById("booking_time").value;
  var name3 = document.getElementById("id_service").value;
  var name4 = document.getElementById("id_provider").value;

  if (name) {
    // Sending an AJAX request to check the availability of the booking
    $.ajax({
      type: 'post',
      url: 'check-date.php',
      data: {
        booking_date: name,
        booking_time: name2,
        id_service: name3,
        id_provider: name4,
      },
      success: function (response) {
        $('#name_status2').html(response);
        if (response == "Valid") {
          return true;
        } else {
          return false;
        }
      }
    });
  } else {
    $('#name_status2').html("");
    return false;
  }
}
</script>

<body>

<?PHP include("menu-customer.php"); ?>



<div class="bgimg-1">

	<div class="w3-padding-32"></div>
	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>MAKE BOOKING</b></div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1200px;">    
	  
	  
	  <!-- The Grid -->
	  <div class="w3-row">
	  

		  <div class="w3-col s7 ">
		  <!-- Booking Form Start -->
		  

			<div class="w3-padding ">
			<div class="w3-card w3-padding w3-round w3-white">
				<div class="w3-margin ">
					
				<form action="" method="post" >
			
					  <div class="w3-section " >
						<div class="w3-border w3-padding w3-round w3-white">

							<div class="w3-padding ">
							
							<label class="w3-margin-left w3-large"><b><?PHP echo $dat["title"];?></b>
							RM <?PHP echo $dat["price"];?></label>
								
							</div>

						</div>
					  </div>

					  <div class="w3-section " >
						Booking Date
						<input class="w3-input w3-border w3-round w3-padding" type="date" name="booking_date" id="booking_date" onchange="checkSetting();" min="<?PHP echo date("Y-m-d");?>" value="" required> <!--set to the current date-->
					  </div>
					  
					  <div class="w3-section " >
						Time-slot
						<select class="w3-select w3-border w3-round w3-padding" name="booking_time" id="booking_time" onchange="checkSetting();" required>
							<option value="">Choose a Slot</option>
							<option value="12.00pm">Slot 1 : 12.00pm</option>
							<option value="1.00pm">Slot 2 : 1.00pm</option>
							<option value="2.00pm">Slot 3 : 2.00pm</option>
							<option value="3.00pm">Slot 4 : 3.00pm</option>
							<option value="4.00pm">Slot 5 : 4.00pm</option>
							<option value="5.00pm">Slot 6 : 5.00pm</option>
							<option value="6.00pm">Slot 7 : 6.00pm</option>
							<option value="7.00pm">Slot 8 : 7.00pm</option>
						</select>
					  </div>
					  <span class="" id="name_status2"></span>
					  
					  <input name="id_service" id="id_service" type="hidden" value="<?PHP echo $id_service; ?>">
					  <input name="id_provider" id="id_provider" type="hidden" value="<?PHP echo $id_provider; ?>">
					  <div class="w3-padding"></div>
				<!--
					  <hr>
					  
					  <div class="w3-section" >
						<input name="id_service" type="hidden" value="<?PHP echo $id_service; ?>">
						<input name="id_provider" type="hidden" value="<?PHP echo $id_provider; ?>">
						<input name="act" type="hidden" value="add">
						<button type="submit" class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">CONFIRM BOOKING</button>
					  </div>
				-->

				</form>
				
				</div>
			</div>
			</div>
			
		  <!-- Booking Form End -->
		  </div>
		  
		  <div class="w3-col s5 ">
				<!-- Address Start -->
				<div class="w3-padding">
					<div class="w3-card w3-padding w3-round w3-white">
						<div class="w3-margin">
						Service Provider Location
						<div class="w3-border w3-padding w3-round-large w3-large">
						
						<?PHP echo $name_provdr; ?><br>
						<?PHP echo $location;?>

						<br>
						<?PHP echo $postcode;?>	<?PHP echo $city;?>	
							
						</div>
						</div>
					</div>
				</div>
				<!-- Address End -->
		
		  </div>
		</div>
		  
		  
		  
		 
			  
		<div class="w3-padding-16"></div>
		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	
</div>


 
<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
