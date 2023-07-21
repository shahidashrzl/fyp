<?PHP
include("database.php");
?>
<?PHP
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$search 	= (isset($_POST['search'])) ? trim($_POST['search']) : '';

$sql_filter ="";

if($search)  $sql_filter = "AND `city` LIKE '%$search%' ";
?>
<!DOCTYPE html>
<html>
<title>Service Page | Guest </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/carwash.png">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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

<?PHP include("menu.php"); ?>


<div class="bgimg-1 w3-light-gray" >

	<div class="w3-padding-32"></div>
	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>SERVICES FOR YOU</b></div>
	
	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:600px">
			<form action="" method="post" >
				<div class="w3-section " >
					<input class="w3-input w3-border w3-round w3-threequarter" type="text" name="search" value="<?PHP echo $search; ?>" placeholder="search location here" required>
				</div>
				
				<input type="hidden" name="act" value="edit" >
				<button type="submit" class="w3-button w3-indigo w3-text-white w3-margin-bottom w3-round">FILTER</button>
			</form>
		</div>
	</div>

	<div class="w3-container w3-padding-24" id="contact">
		<div class="w3-content w3-container " style="max-width:1200px">
			
			
			<div class="w3-row">
				
			<?PHP
				$SQL_list = "SELECT * FROM `service`,`provider` WHERE service.id_provider = provider.id_provider " . $sql_filter;
				$result = mysqli_query($con, $SQL_list) ;
				while ( $data	= mysqli_fetch_array($result) )
				{
				
					$id_service	= $data["id_service"];
				?>
				<div class="w3-display-container w3-col m4 w3-padding w3-padding-16 w3-center  w3-round-large ">
					<div class="w3-padding w3-padding-16 w3-card-4 w3-white w3-round-large w3-border w3-hover-border-red  ">
						
						<h4><?PHP echo $data["title"]; ?></h4><?PHP echo $data["description"]; ?><br>
						<span class="w3-text-orange">( <strong><?PHP echo $data["service_type"]; ?></strong> )<br>
						<span class="w3-text-indigo">RM <?PHP echo $data["price"]; ?></span>
						
						<div class="w3-padding"></div>
						<a href="#" onclick="checkLoginStatus();" class="w3-button w3-block w3-indigo w3-round-large"> Book Now <i class="fa fa-fw fa-cart-plus"></i></a>

						
						<br>
						<div class="w3-tag w3-display-bottommiddle"><?PHP echo $data["city"]; ?></div>	
					</div>
					
				</div>
				
				<?PHP 
				} 
				?>
				
				
			</div>
			
		  
		</div>
	</div>
	
</div>

<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
function checkLoginStatus() {
  // Check if the user is logged in
  var isLoggedIn = false; // Replace this with your actual logic to check if the user is logged in
  
  if (!isLoggedIn) {
    // Prompt the user to log in
    var message = "Please Login as Customer First";
    alert(message);
	window.location.href = "index.php"; // Redirect to index.php
    return false; // Prevent the default behavior of the link (i.e., following the href)
  }
  
  // Continue with the default behavior if the user is logged in
  return true;
}
</script>

</body>
</html>
