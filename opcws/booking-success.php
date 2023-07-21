<?PHP
include("database.php");

$id_booking= (isset($_GET['id_booking'])) ? trim($_GET['id_booking']) : '';

$success = "";

$SQL_view 	= " SELECT * FROM `booking`, `service`, `provider` WHERE booking.id_service = service.id_service AND service.id_provider = provider.id_provider AND id_booking =  $id_booking ";

$result 	= mysqli_query($con, $SQL_view) or die("Error in query: ".$SQL_view."<br />".mysqli_error($con));
$data		= mysqli_fetch_array($result);
$photo		= $data["photo"];
if(!$photo) $photo = "noimage.jpg";
?>
<!DOCTYPE html>
<html>
<title>Booking Details | Customer</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  min-height: 100%;
  background-attachment:fixed;
  background-image: url(images/carwashbg.png);
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu-customer.php"); ?>


<div class="bgimg-1" >

	<div class="w3-padding-48"></div>
	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>BOOKING DETAILS</b></div>

<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:400px">
		<div class="w3-padding w3-center">

			<div class="w3-row">

				<div class="w3-col">
					<div class="w3-padding">
					
						<div class="w3-padding w3-center">
						<b class="w3-large">Completed</b>
						</div>
						<hr>

						  
						  Your Booking Id :
						  <h2 class="w3-text-blue"><b><?PHP echo $data["booking_id"]; ?></b></h2>
						  
						  <hr class="w3-clear">
						  
						  
						  <div class="w3-padding"><h3><?PHP echo $data["title"];?></h3></div>
					
							<hr>
							
							<div class="w3-section " >
								<label>Booking Date</label><br>
								<label><?PHP echo $data["booking_date"];?></label>
							</div>

							<div class="w3-section " >
								<label>Booking Time</label><br>
								<label><?PHP echo $data["booking_time"];?></label>
							</div>

							<div class="w3-section " >
								<label>Location</label><br>
								<label><?PHP echo $data["location"];?></label>
							</div>					  

						</div>  

					
					</div>
				</div>
			</div>
			
			
		
		</div>

    </div>
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
