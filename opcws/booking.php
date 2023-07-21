<?PHP
session_start();

include("database.php");
if( !verifyCustomer($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<!DOCTYPE html>
<html>
<title>Booking History | Customer</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

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
</style>

<body>

<?PHP include("menu-customer.php"); ?>

<!-- Page content -->
<div class="bgimg-1">

	<div class="w3-padding-32"></div>
	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>MY BOOKING</b></div>

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
				<th>Service</th>
				<th>Location</th>
				<th>Booking Date</th>
				<th>Booking Time</th>
				<th>Status</th>
			</tr>
			</thead>
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `booking`,`service`,`provider` WHERE booking.id_service = service.id_service AND service.id_provider = provider.id_provider  AND `id_customer` = " . $_SESSION["id_customer"];
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$id_booking	= $data["id_booking"];
			?>			
			<tr>
				<td><?PHP echo $bil ;?></td>
				<td><?PHP echo $data["booking_id"];?></td>
				<td><?PHP echo $data["title"];?></td>
				<td><?PHP echo $data["location"];?></td>
				<td><?PHP echo $data["booking_date"];?></td>
				<td><?PHP echo $data["booking_time"];?></td>
				<td><?PHP echo $data["status"];?></td>
			</tr>	
	
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
