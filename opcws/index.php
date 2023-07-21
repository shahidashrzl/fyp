<?PHP
session_start();
include("database.php");

$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$id_customer = (isset($_REQUEST['id_customer'])) ? trim($_REQUEST['id_customer']) : '';

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$name	=	mysqli_real_escape_string($con, $name);

$success = "";

//Database for customer registration
if ($act == "add") {
    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM `customer` WHERE `email` = '$email'";
    $emailResult = mysqli_query($con, $checkEmailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        $error = "Email already exists";
        print "<script>alert('Email already Exists'); self.location='index.php';</script>";
    } else {
        /*Check if phone number already exists
        $checkPhoneQuery = "SELECT * FROM `customer` WHERE `phone` = '$phone'";
        $phoneResult = mysqli_query($con, $checkPhoneQuery);

        if (mysqli_num_rows($phoneResult) > 0) {
            $error = "Phone number already exists";
            print "<script>alert('Phone Number already Exists'); self.location='index.php';</script>";
        } else {*/
            // Insert the customer into the database
            $SQL_insert = "INSERT INTO `customer`(`name`, `email`, `password`, `phone`) VALUES ('$name', '$email', '$password', '$phone')";
            $result = mysqli_query($con, $SQL_insert);
            $success = "Successfully Registered";
            print "<script>alert('Successfully Registered !'); self.location='index.php';</script>";
        }
    }


if($act == "login") 
{
	$SQL_login = " SELECT * FROM `customer` WHERE `email` = '$email' AND `password` = '$password'  ";

	$result = mysqli_query($con, $SQL_login);
	$data	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if($valid > 0)
	{
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password;
		$_SESSION["id_customer"] = $data["id_customer"];
		
		header("Location:main.php");
	}else{
		$error = "Invalid";
		//header( "refresh:1;url=index.php" );
		print "<script>alert('Invalid Login!'); self.location='index.php';</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<title>Online Platform for Car Wash Service</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="images/carwash.png">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,
h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: "Poppins", sans-serif
}

body,
html {
    height: 100%;
    line-height: 1.8;
}

a:link {
    text-decoration: none;
}

/* Full height bg */
.bgimg-1 {
    background-position: top;
    background-size: cover;
    background-attachment: fixed;
    background-image: url(images/carwashbg.png);
    min-height: 100%;
    /*background-color: rgba(255, 255, 255, 0.9);
  background-blend-mode: overlay;*/
}

.w3-bar .w3-button {
    padding: 16px;
}
</style>

<body>

    <?PHP include("menu.php"); ?>

    <div id="idSuccess" class="w3-modal" style="z-index:10;">
        <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
            <header class="w3-container ">
                <span onclick="document.getElementById('idSuccess').style.display='none'"
                    class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
            </header>

            <div class="w3-container w3-padding">

                <form action="" method="post">
                    <div class="w3-padding"></div>
                    <b class="w3-large">Congratulation</b>

                    <hr class="w3-clear">

                    Your account successfully registered ! Please login.

                    <div class="w3-padding-16"></div>

                    <a onclick="document.getElementById('idSuccess').style.display='none'; document.getElementById('id01').style.display='block'"
                        class="w3-button w3-block w3-padding-large w3-blue w3-wide w3-margin-bottom w3-round"><i
                            class="fa fa-fw fa-lg fa-lock"></i> LOGIN</a>


                </form>
            </div>
        </div>
    </div>

    <div class="bgimg-1 w3-blue">

        <div class="w3-padding-32"></div>

        <div class="w3-container w3-padding" id="contact">

            <div class="w3-content w3-containerx w3-white w3-round- w3-card" style="max-width:1200px">

                <div class="w3-paddingx">
                    <?PHP include("slide.php"); ?>
                </div>

            </div>
        </div>

        <div class="w3-container w3-padding" id="contact">
            <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:1200px">

                <div class="w3-row">
                    <div class="w3-col m6">
                        <img src="images/cover.png" class="w3-image">
                    </div>

                    <div class="w3-col m6">
                        <div class="w3-margin w3-padding w3-padding-32 ">
                            <center>
                                <h1>Welcome to Online Platform for Car Wash Service</h1>
                            </center>
                            <p>
                                where convenience meets quality ! Discover a seamless and efficient way to keep your
                                car looking its best. Join us today and let us take care of your car while you sit back,
                                relax, and enjoy the ride.
                            </p>
                            <div class="w3-padding"></div>
                            <a href="about.php" class="w3-text-white w3-button  w3-blue  w3-round "><b>Read
                                    more...</b></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <div class="w3-container w3-padding-24" id="contact">
            <div class="w3-content w3-container " style="max-width:1200px">
                <div class="w3-padding w3-xlarge w3-center "><b> WE PROVIDE </b></div>

                <br>
                <div class="w3-row-padding">
                    <div class="w3-third w3-container w3-margin-bottom">
                        <img src="images/online-booking.png" alt="Norway" style="width:50%">
                        <div class="w3-container w3-white">
                            <p><b>Online Booking</b></p>
                            <p>Search for available car wash services centre near you</p>
                        </div>
                    </div>
                    <div class="w3-third w3-container w3-margin-bottom">
                        <img src="images/map.png" alt="Norway" style="width:50%">
                        <div class="w3-container w3-white">
                            <p><b>Search Nearest Location</b></p>
                            <p>Save your car washing time by making an online appointment</p>
                        </div>
                    </div>
                    <div class="w3-third w3-container">
                        <img src="images/washing.png" alt="Norway" style="width:50%">
                        <div class="w3-container w3-white">
                            <p><b>Preferred Services</b></p>
                            <p>We provide variety of car wash services from different service provider</p>
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