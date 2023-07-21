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

$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$id_booking = (isset($_REQUEST['id_booking'])) ? trim($_REQUEST['id_booking']) : '';

$date 		= (isset($_POST['date'])) ? trim($_POST['date']) : '';
$time		= (isset($_POST['time'])) ? trim($_POST['time']) : '';
$attend 	= (isset($_POST['attend'])) ? trim($_POST['attend']) : '';
$status 	= (isset($_POST['status'])) ? trim($_POST['status']) : '';


$success = "";


if($act == "edit")
{	
	$SQL_insert = " 
	UPDATE
		`booking`
	SET
		`status` = '$status'
	WHERE
		id_booking = $id_booking
	";
										
	$result = mysqli_query($con, $SQL_insert);
	
	$success = "Successfully Updated";
	
	//print "<script>self.location='p-main.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `booking` WHERE `id_booking` =  '$id_booking' ";
	$result = mysqli_query($con, $SQL_delete);
	
	print "<script>self.location='p-booking.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CAR WASH SERVICES</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<style>
a {text-decoration: none;}
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
  
  <a href="p-main.php" class="w3-bar-item w3-button w3-text-indigo">
  <i class="fa fa-fw fa-tachometer w3-margin-right"></i> DASHBOARD</a>
  
  <a href="p-booking.php" class="w3-bar-item w3-button w3-biru w3-text-indigo">
  <i class="fa fa-fw fa-calendar w3-margin-right"></i> BOOKING</a>
  
  <a href="p-service.php" class="w3-bar-item w3-button w3-text-indigo">
  <i class="fa fa-fw fa-car w3-margin-right"></i> SERVICE</a>
  
  <a href="p-customer.php" class="w3-bar-item w3-button  w3-text-indigo">
  <i class="fa fa-fw fa-users w3-margin-right"></i> CUSTOMER</a>

</nav>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "p-booking.php"); }
?>	



<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main" style="margin-left:250px;">


<div class="w3-white w3-bar w3-card ">


	<i class="fa fa-bars w3-buttonx w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>

	
	<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
	<button class="w3-button"><i class="fa fa-fw fa-user-circle-o"></i> Hello, <?PHP echo $username?><i class="fa fa-fw fa-chevron-down w3-small"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="p-profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-circle "></i> Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out "></i> Signout</a>
      </div>
    </div>

</div>



<div class="w3-padding-16"></div>

<div class="w3-container w3-content w3-xxlarge w3-text-indigo" style="max-width:1200px;"> All Booking</div>

	
<div class="w3-container">

	<!-- Page Container -->
	<div class="w3-container w3-content w3-white w3-card w3-padding-16 w3-round" style="max-width:1200px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-white w3-padding">
	  
	  <!--
	  <a onclick="document.getElementById('add01').style.display='block'; " class=" w3-right w3-button w3-blue w3-margin-bottom w3-round "><i class="fa fa-fw fa-lg fa-plus"></i> ADD CUSTOMER</a>
	  -->
	  
		<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
			<tr>
				<th>#</th>
				<th>Booking ID</th>
				<th>Customer Name</th>
				<th>Service</th>
				<th>Type</th>
				<th>Booking Date</th>
				<th>Booking Time</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			</thead>
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `booking`,`service`,`customer` WHERE booking.id_customer = customer.id_customer AND booking.id_service = service.id_service AND booking.id_provider = " .$id_provider;
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
				<td>
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class="w3-button w3-blue w3-text-white w3-round">Update</a>
				
				</td>
				
			</tr>	
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding w3-margin">
		
		<form action="" method="post"  >
			<div class="w3-padding"></div>
			<b class="w3-large">Update Status</b>
			<hr>

			  <div class="w3-section " >
				<label>Status *</label>
				<select class="w3-select w3-border w3-round w3-padding" name="status" required>
					<option value="Waiting" <?PHP if($data["status"] == "Waiting") echo "selected";?>>Waiting</option>
					<option value="Settled" <?PHP if($data["status"] == "Settled") echo "selected";?>>Settled</option>
				</select>
			  </div>
  
			<hr class="w3-clear">
			<input type="hidden" name="id_booking" value="<?PHP echo $data["id_booking"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

		</form>
		</div>
	</div>
</div>

<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Delete Confirmation</b>
			  
			<hr class="w3-clear">
			
			Are you sure to delete this record?
			
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_booking" value="<?PHP echo $data["id_booking"];?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'"  class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">NO</button>
			
			<button type="submit" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">YES, DELETE</button>

		</form>
		</div>
	</div>
</div>	
			<?PHP } ?>
		</table>
		</div>

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	
	

</div>
<!-- container end -->
	



<div class="w3-padding-24"></div>

     
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<!--<script src="assets/demo/datatables-demo.js"></script>-->

<script>
$(document).ready(function() {

  
	$('#dataTable').DataTable( {
		paging: true,
		
		searching: true
	} );
		
	
});
</script>


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
