<?PHP
session_start();

include("database.php");
if( !verifyProvider($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$id_provider = $_SESSION["id_provider"];

$query = "SELECT username FROM provider WHERE id_provider = ?"; // Assuming you have a column named "id_provider" for identification
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id_provider); // Assuming you have the provider's ID stored in a variable named $id_provider
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

$tot_customer 	= numRows($con, "SELECT * FROM `customer`,`booking` WHERE customer.id_customer = booking.id_customer AND booking.id_provider = $id_provider GROUP BY customer.id_customer");
$tot_booking 	= numRows($con, "SELECT * FROM `booking` WHERE id_provider = $id_provider");
$tot_waiting 	= numRows($con, "SELECT * FROM `booking` WHERE id_provider = $id_provider AND `status` = 'Waiting' ");
$tot_service 	= numRows($con, "SELECT * FROM `service` WHERE id_provider = $id_provider");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Main Page | Provider</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {padding: 16px}
.w3-biru {background-color:#f6f9ff;}
</style>
</head>
<body class="w3-biru">

<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-card" style="z-index:3;width:250px;" id="mySidebar">
  <a href="p-main.php" class="w3-bar-item w3-large"><img src="images/logoplatform.png" class="w3-padding" style="width:100%;"></a>
  <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
  class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>
  
  <a href="p-main.php" class="w3-bar-item w3-button w3-biru w3-text-indigo">
  <i class="fa fa-fw fa-tachometer w3-margin-right"></i> DASHBOARD</a>
  
  <a href="p-booking.php" class="w3-bar-item w3-button  w3-text-indigo">
  <i class="fa fa-fw fa-calendar w3-margin-right"></i> BOOKING</a>
  
  <a href="p-service.php" class="w3-bar-item w3-button  w3-text-indigo">
  <i class="fa fa-fw fa-list w3-margin-right"></i> SERVICE</a>
  
  <a href="p-customer.php" class="w3-bar-item w3-button  w3-text-indigo">
  <i class="fa fa-fw fa-users w3-margin-right"></i> CUSTOMER</a>

  <a href="p-vehicle.php" class="w3-bar-item w3-button  w3-text-indigo">
  <i class="fa fa-fw fa-car w3-margin-right"></i> VEHICLE TYPE</a>

</nav>



<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main" style="margin-left:250px;">


<div class="w3-white w3-bar w3-card ">
	
	<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
	<button class="w3-button"><i class="fa fa-fw fa-user-circle-o"></i> Hello, <?PHP echo $username?><i class="fa fa-fw fa-chevron-down w3-small"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="p-profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-circle "></i> Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out "></i> Logout</a>
      </div>
    </div>

</div>



<div class="w3-padding-16"></div>

<div class="w3-container w3-content w3-xxlarge w3-text-indigo" style="max-width:1200px;"> Dashboard</div>

	
<div class="w3-container">

	<!-- Page Container -->
	<div class="w3-container w3-content  w3-padding-16 " style="max-width:1200px;">    
		<!-- The Grid -->
		<div class="w3-row ">
	  
			<div class="w3-col m3 w3-container w3-padding">
				<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16">
				<i class="fa fa-fw fa-calendar-check-o fa-lg w3-left w3-text-indigo"></i> 
				<h1><b><?PHP echo $tot_booking;?></b></h1>
				Total Booking<br>
				</div>
			</div>
			
			<div class="w3-col m3 w3-container w3-padding">
				<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16">
				<i class="fa fa-fw fa-hourglass fa-lg w3-left w3-text-indigo"></i> 
				<h1><b><?PHP echo $tot_waiting;?></b></h1>
				Total Waiting<br>
				</div>
			</div>
			
			<div class="w3-col m3 w3-container w3-padding">
				<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16">
				<i class="fa fa-fw fa-users fa-lg w3-left w3-text-indigo"></i> 
				<h1><b><?PHP echo $tot_customer;?></b></h1>
				Total Customers<br>
				</div>
			</div>
			
			<div class="w3-col m3 w3-container w3-padding">
				<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16">
				<i class="fa fa-fw fa-car fa-lg w3-left w3-text-indigo"></i> 
				<h1><b><?PHP echo $tot_service;?></b></h1>
				Total Service<br>
				</div>
			</div>


		
		<!-- End Grid -->
		</div>  	  
	<!-- End Page Container -->
	</div>
	
	
	<!-- Page Container -->
	<div class="w3-container w3-content " style="max-width:1200px;">    
		<!-- The Grid -->
		<div class="w3-row w3-padding">
			<div class="w3-card w3-border w3-white w3-round-xlarge w3-margin w3-padding w3-padding-16">

				<div class="w3-xlarge w3-text-indigo">Today's Booking</div>
				
				<div class="w3-responsive w3-padding">
				<table class="w3-table w3-table-allx w3-striped w3-bordered" width="100%" cellspacing="0">
					<thead>
					<tr>
						<th>#</th>
						<th>Booking ID</th>
						<th>Customer Name</th>
						<th>Service Name</th>
						<th>Service Type</th>
						<th>Booking Date</th>
						<th>Booking Time</th>
						<th>Status</th>

					</tr>
					</thead>
					<?PHP
					$today = date("Y-m-d");
					$bil = 0;
					$SQL_list = "SELECT * FROM `booking`,`service`,`customer` WHERE booking.id_customer = customer.id_customer AND booking.id_service = service.id_service AND `booking_date` = '$today'  AND booking.id_provider = " .$id_provider;
					$result = mysqli_query($con, $SQL_list) ;
					while ( $data	= mysqli_fetch_array($result) )
					{
						$bil++;
						$id_booking	= $data["id_booking"];
					?>			
					<tr>
						<td><?PHP echo $bil ;?></td>
						<td><?PHP echo $data["booking_id"];?></td>
						<td><?PHP echo $data["name"] . " (" . $data["phone"] . ")"?></td>
						<td><?PHP echo $data["title"];?></td>
						<td><?PHP echo $data["service_type"];?></td>
						<td><?PHP echo $data["booking_date"];?></td>
						<td><?PHP echo $data["booking_time"];?></td>
						<td><?PHP echo $data["status"];?></td>

						
					</tr>	
					<?PHP } ?>
				</table>
				</div>

			
			</div>
		<!-- End Grid -->
		</div> 
	<!-- End Page Container -->
	</div>
	

</div>
<!-- container end -->
	

	

<div class="w3-padding-24"></div>

     
</div>


<script>
var openInbox = document.getElementById("myBtn");
openInbox.click();

function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

function myFunc(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show"; 
    x.previousElementSibling.className += " w3-pale-red";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-red", "");
  }
}

</script>

</body>
</html> 
