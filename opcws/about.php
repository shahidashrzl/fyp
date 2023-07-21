<!DOCTYPE html>
<html>
<title>CAR WASH SERVICES</title>
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

<?PHP include("menu.php"); ?>


<div class="bgimg-1" >

	<div class="w3-padding-32"></div>
	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>ABOUT OUR PLATFORM</b></div>

<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:1000px">
		<div class="w3-padding">

			<h3>What do we do ?</h3>
			<p>
			<img src="images/aboutcwsp.png" class="w3-left w3-padding">
			We understand the importance of keeping your vehicle in clean condition without the hassle of traditional car wash experiences. With JomCuci, we provide convenient and efficient car wash services, right at your fingertips. 
			</p><p>
			Wide range of services tailored to meet your specific needs. Our user-friendly platform connects you with a network of car wash enterprises  who are dedicated in providing top-notch service.  We value quality, convenience, and customer satisfaction. With just a few clicks, you can schedule a car wash appointment that could fits your busy schedule.  
			</p><p>
			Besides, you can search for nearest location of car wash service with our platform. No more driving around searching for car wash service centre or wasting time waiting in long queues. JomCuci ensures that the nearest car wash service is just a few taps away.</p>


		</div>
		<div class="w3-padding-24"></div>
    </div>
</div>


<div class="w3-padding-32"></div>
	
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
