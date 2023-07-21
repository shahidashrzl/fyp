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
$search 	= (isset($_POST['search'])) ? trim($_POST['search']) : '';

$sql_filter ="";

if($search)  $sql_filter = "AND `city` LIKE '%$search%' ";
?>
<!DOCTYPE html>
<html>
<title>Service Page | Customer</title>
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


<div class="bgimg-1 w3-light-gray" >

	<div class="w3-padding-32"></div>
	
	<div class="w3-padding w3-xxlarge w3-center w3-text-white"><b>AVAILABLE SERVICES</b></div>
	
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
	
	<div class="w3-container w3-padding" id="contact">
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
						
						<h4><b><?PHP echo $data["title"]; ?></b></h4><?PHP echo $data["description"]; ?><br>
						<span class="w3-text-orange">( <strong><?PHP echo $data["service_type"]; ?></strong> )<br>
						<span class="w3-text-indigo">RM <?PHP echo $data["price"]; ?></span>
						<div class="w3-padding"></div>
						<a href="booking_add2.php?id_service=<?PHP echo $id_service;?>" class="w3-button w3-block w3-indigo w3-round-large"> BOOK NOW <i class="fa fa-fw fa-cart-plus"></i></a>
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
