<?PHP

include("database.php");
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';
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

$found = 0;
$error = "";
$success = false;

if ($act == "register") {
	// Check if username already exists
    $found = numRows($con, "SELECT * FROM `provider` WHERE `username` = '$username'");
    if ($found) {
        $error = "Username already registered";
    } else {
        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM `provider` WHERE `email` = '$email'";
        $emailResult = mysqli_query($con, $checkEmailQuery);

        if (mysqli_num_rows($emailResult) > 0) {
            $error = "Email already exists";
        } /*else {
            // Check if phone number already exists
            $checkPhoneQuery = "SELECT * FROM `provider` WHERE `phone` = '$phone'";
            $phoneResult = mysqli_query($con, $checkPhoneQuery);

            if (mysqli_num_rows($phoneResult) > 0) {
                $error = "Phone number already exists";
            } */else {
                $SQL_insert = "INSERT INTO `provider`(`id_provider`, `name`, `email`, `phone`, `username`, `password`, `city`, `location`, `postcode`) VALUES (NULL, '$name', '$email', '$phone', '$username', '$password', '$city', '$location', '$postcode')";
                $result = mysqli_query($con, $SQL_insert) or die("Error in query: ".$SQL_insert."<br />".mysqli_error($con));
                $success = true;
            }
        }
    }



?>
<!DOCTYPE html>
<html>
<title>Register Service Provider | Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  background-attachment:fixed;
  background-image: url(images/carwashbg.png);
  min-height:100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu.php"); ?>


<div class="bgimg-1" >

	<div class="w3-padding-24"></div>
		
	<div class=" w3-center w3-text-white w3-padding">
		<span class="w3-large"></span><br>
	</div>

<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">
		<div class="w3-padding">

<?PHP if($success) { ?>
<div class="w3-panel w3-green w3-display-container w3-animate-zoom">
  <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>
  <h3>Success!</h3>
  <p>Your registration was successful! You may now <a href="login-sp.php" class="w3-xlarge">Login.</a> </p>
</div>
<?PHP  } ?>

<?PHP if($error) { ?>
<div class="w3-panel w3-red w3-display-container w3-animate-zoom">
  <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>
  <h3>Error!</h3>
  <p><?PHP echo $error;?></p>
</div>
<?PHP  } ?>

<?PHP if(!$success) { ?>	
		
			<form action="" method="post">
			
			<h3><b>Service Provider Registration</b></h3>
			
			  <div class="w3-section" >
				<label>Full Name *</label>
				<input class="w3-input w3-border w3-round" type="text" name="name"  required>
			  </div>
			  
			  <div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email"  required>
			  </div>
			  
			  <div class="w3-section" >
				<label>Phone *</label>
				<input class="w3-input w3-border w3-round" type="text" name="phone"  required>
			  </div>
			  
			  <div class="w3-section">
				<label>Username *</label>
				<input class="w3-input w3-border w3-round" type="text" name="username" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="password" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Location / Business Address *</label>
				<textarea class="w3-input w3-border w3-round" name="location" required></textarea>
			  </div>
			  
			  <div class="w3-section">
				<label>City *</label>
				<input class="w3-input w3-border w3-round" type="text" name="city" placeholder="eg. Sintok" required>
			  </div>
			  
			  <div class="w3-section">
				<label>Postcode *</label>
				<input class="w3-input w3-border w3-round" type="number" name="postcode" required>
			  </div>
			  
			  <input type="hidden" name="act" value="register">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-blue w3-margin-bottom w3-round">SUBMIT</button>
			</form>
			
<?PHP } ?>
			<div class="w3-center">Already registered ? <a href="login-sp.php" class="w3-text-blue">LOGIN HERE</a></div>
		</div>
    </div>
</div>

<div class="w3-padding-16"></div>

	
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
