<?PHP
session_start();

include("database.php");
if( !verifyCustomer($con) ) 
{
	//header( "Location: index.php" );
	return false;
}
?>
<?PHP
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$id_customer= (isset($_REQUEST['id_customer'])) ? trim($_REQUEST['id_customer']) : '';	
$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$success = "";

// Check if the status has been settled
$statusSettled = isset($_SESSION['status_settled']) && $_SESSION['status_settled'];

if ($act == "edit") {
    if ($statusSettled) {
        echo "<script>
                if (confirm('You cannot update anymore once settled. Proceed?')) {
                    document.getElementById('status').setAttribute('disabled', 'disabled');
                } else {
                    window.location.href = 'main.php';
                }
            </script>";
    } else {
        // Perform the update operation
        $SQL_update = "UPDATE `customer` SET 
                            `name` = '$name',
                            `email` = '$email',
                            `password` = '$password',
                            `phone` = '$phone'
                        WHERE `email` = '" . $_SESSION["email"] . "'";

        $result = mysqli_query($con, $SQL_update);
        if ($result) {
            $success = "Successfully updated";
            echo "<script>if(confirm('Successfully updated')) { window.location.href = 'main.php'; }</script>";
        } else {
            die("Error in query: " . mysqli_error($con));
        }
    }
}

// Retrieve the status field from the database
$SQL_view = " SELECT * FROM `customer` WHERE `email` =  '" . $_SESSION["email"] . "'";
$result = mysqli_query($con, $SQL_view);
$data = mysqli_fetch_array($result);
$name = $data["name"];

// Check if the status field is "settled" and update the statusSettled flag
$status = $data["status"];
if ($status === "settled") {
    $_SESSION['status_settled'] = true;
} else {
    $_SESSION['status_settled'] = false;
}
?>


<!DOCTYPE html>
<html>
<title>Main Page | Customer</title>
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
  min-height: 100%;
  background-attachment:fixed;
  background-image: url(images/carwashbg.png);
}

a:link {
  text-decoration: none;
}

/* Full height bg */
.bgimg-1 {
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu-customer.php"); ?>

<!--- Toast Notification -->
<?PHP 

if($success) { Notify("success", $success, "main.php"); }
?>

<div class="bgimg-1">
<div class="w3-padding-32"></div>

<div class="w3-container w3-padding" id="contact">

	<div class="w3-content w3-containerx w3-white w3-round- w3-card" style="max-width:1200px">

		<div class="w3-paddingx">
			<?PHP include("slide.php"); ?>
		</div>

	</div>
</div>

	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>DASHBOARD</b></div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1000px;">    
	  <!-- The Grid -->
	  <div class="w3-row">
	  

		  <div class="w3-padding">
			<div class="w3-card w3-padding w3-round w3-white">
				<div class="w3-xlarge w3-padding-24 w3-padding" >
					<div class="w3-padding">Welcome, <?PHP echo $name;?> !</div>
				</div>
				
				<div class="w3-row w3-padding-24">
					
	
					<div class="w3-col m4 w3-container" >
						<a  href="booking_add.php" class="w3-card w3-border w3-border-white w3-padding-32 w3-block w3-button w3-blue w3-margin-bottom w3-round "><i class="fa fa-calendar-plus fa-4x"></i>
						<p></p>
						Make Booking</a>
					</div>
					
					
					<div class="w3-col m4 w3-container" >
						<a  href="booking.php" class="w3-card w3-border w3-border-white w3-padding-32 w3-block w3-button w3-blue w3-margin-bottom w3-round "><i class="fa fa-history fa-4x"></i>
						<p></p>
						Booking History</a>
					</div>
					
					
					<div class="w3-col m4 w3-container" >
						<a onclick="document.getElementById('idEdit').style.display='block'; " class="w3-card w3-border w3-border-white w3-padding-32 w3-block w3-button w3-blue w3-margin-bottom w3-round ">
						<i class="fas fa-user-edit fa-4x"></i>
						<p></p>
						Profile</a>
					</div>


			</div>
		  </div>
		</div>
			
		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	<div class="w3-padding-24"></div>
	
</div>


<div id="idEdit" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding">
			<b class="w3-large">Update Profile</b>
			<hr>

			  <div class="w3-section " >
				Full Name
				<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $data["name"];?>" placeholder="First Name" required>
			  </div>
			  
			   <div class="w3-section " >
				Email
				<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $data["email"];?>" placeholder="Email" required>
			  </div>
			  
			  <div class="w3-section " >
				Password
				<input class="w3-input w3-border w3-round" type="password" name="password" value="<?PHP echo $data["password"];?>" placeholder="Password" required>
			  </div>

			  <div class="w3-section " >
				Mobile Phone
				<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo $data["phone"];?>" placeholder="Contact No" required>
			  </div>
			  			    

			<hr class="w3-clear">

			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

		  </div>
		</form>
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
