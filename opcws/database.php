<?PHP
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
		/*webhosting
		$dbHost = "localhost";	// Database host
		$dbName = "berhadco_jomwashup";		// Database name
		$dbUser = "berhadco_jomwashup";		// Database user
		$dbPass = "JomWashUp@2023";			// Database password*/
		
		//localhost
		$dbHost = "localhost";	// Database host
		$dbName = "jomwashup";		// Database name
		$dbUser = "root";		// Database user
		$dbPass = "";			// Database password


	
	$con = mysqli_connect($dbHost,$dbUser ,$dbPass,$dbName);
	
	
	function verifyProvider($con)
	{
		if ($_SESSION['username'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `username`, `password` FROM `provider` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}
	
	function verifyCustomer($con)
	{
		if ($_SESSION['email'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `email`, `password` FROM `customer` WHERE `email`='$_SESSION[email]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}

	function numRows($con, $query) {
        $result  = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
	
	function Notify($status, $alert, $redirect)
	{
		//Determine color class based on the status
		$color = ($status == "success") ? "w3-green" : "w3-red";

		//Output the notification HTML 
		echo '<div class="'.$color.' w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">'.$alert.'</div>
				</div>
			</div>';

		header( "refresh:3;url=$redirect" );
		//print "<script>self.location='$redirect';</script>";
	}
	
	
	// This function takes a text string, maximum character length, and an optional ending string as parameters.
function substrwords($text, $maxchar, $end='...') {
	
	// Check if the length of the text exceeds the maximum character limit or if the text is empty.
	if (strlen($text) > $maxchar || $text == '') {
		
		// Split the text into individual words using whitespace as the delimiter.
		$words = preg_split('/\s/', $text);
		
		// Initialize an empty string to store the output.
		$output = '';
		
		// Initialize a counter variable.
		$i = 0;
		
		// Loop through the words array.
		while (1) {
			// Calculate the length of the output string plus the length of the current word.
			$length = strlen($output)+strlen($words[$i]);
			
			// Check if the length exceeds the maximum character limit.
			if ($length > $maxchar) {
				// If it does, exit the loop.
				break;
			} 
			else {
				// If it doesn't, append the current word to the output string and increment the counter.
				$output .= " " . $words[$i];
				++$i;
			}
		}
		
		// Append the ending string to the output.
		$output .= $end;
	} 
	else {
		// If the length of the text is within the maximum character limit and not empty, set the output as the original text.
		$output = $text;
	}
	
	// Return the final output.
	return $output;
}

	
?>