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
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$query = "SELECT username FROM provider WHERE id_provider = ?"; // Assuming you have a column named "id_provider" for identification
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id_provider); // Assuming you have the provider's ID stored in a variable named $id_provider
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email 		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$username	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$location 	= (isset($_POST['location'])) ? trim($_POST['location']) : '';
$city 		= (isset($_POST['city'])) ? trim($_POST['city']) : '';
$postcode 	= (isset($_POST['postcode'])) ? trim($_POST['postcode']) : '';

$name		=	mysqli_real_escape_string($con, $name);
$location	=	mysqli_real_escape_string($con, $location);

$success = "";

if($act == "edit")
{	
	$SQL_update = " 
	UPDATE
		`provider`
	SET
		`name` = '$name',
		`email` = '$email',
		`phone` = '$phone',
		`username` = '$username',
		`password` = '$password',
		`location` = '$location',
		`city` = '$city',
		`postcode` = '$postcode'
	WHERE
		`username`='$_SESSION[username]' 
		";
	
	$result = mysqli_query($con, $SQL_update);

	
	$success = "Profile successfully Updated";
	//print "<script>self.location='p-profile.php';</script>";
}


$SQL_list = "SELECT * FROM `provider` WHERE `username`='$_SESSION[username]' ";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile Page | Provider</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
a {
  text-decoration: none;
}
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {padding: 16px}.w3-biru {background-color:#f6f9ff;}
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

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "p-profile.php"); }
?>	

<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main" style="margin-left:250px;">


<div class="w3-white w3-bar w3-card ">


	<i class="fa fa-bars w3-buttonx w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>

	<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
	<button class="w3-button"><i class="fa fa-fw fa-user-circle-o"></i> Hello<i class="fa fa-fw fa-chevron-down w3-small"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="p-profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-circle "></i> Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out "></i> Signout</a>
      </div>
    </div>

</div>

<div class="w3-padding-16"></div>

<div class="w3-container w3-content w3-xxlarge w3-text-indigo" style="max-width:1200px;"> Your Profile</div>

	
<div class="w3-padding-16"></div>
	
<div class="w3-container">

	<!-- Page Container -->
	<div class="w3-container w3-white w3-content w3-card w3-padding-16" style="max-width:600px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-padding">
	  
		<form action="" method="post" >
			<div class="w3-padding">
			<b class="w3-large">Profile</b>
			<hr>
		
			  <div class="w3-section" >
				<label>Full Name *</label>
				<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $data["name"];?>" required>
			  </div>
			  
			  <div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $data["email"];?>" required>
			  </div>
			  
			  <div class="w3-section" >
				<label>Phone *</label>
				<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo $data["phone"];?>" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Username *</label>
				<input class="w3-input w3-border w3-round" type="text" name="username" value="<?PHP echo $data["username"];?>" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="password" value="<?PHP echo $data["password"];?>" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Location / Business Address *</label>
				<textarea class="w3-input w3-border w3-round" name="location" required><?PHP echo $data["location"];?></textarea>
			  </div>
			  
			  <div class="w3-section">
				<label>City *</label>
				<input class="w3-input w3-border w3-round" type="text" name="city" placeholder="eg. Petaling Jaya" value="<?PHP echo $data["city"];?>" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Postcode *</label>
				<input class="w3-input w3-border w3-round" type="number" name="postcode" value="<?PHP echo $data["postcode"];?>" required>
			  </div>
			    
			<hr class="w3-clear">
			<input type="hidden" name="id_provider" value="<?PHP echo $data["id_provider"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">UPDATE</button>
			
			</div>  
		</form>
	  
		

		
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
