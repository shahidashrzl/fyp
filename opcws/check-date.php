<?php
include("database.php");

if (isset($_POST['booking_date'])) {
    // Retrieving form data
    $id_service = $_POST['id_service'];
    $id_provider = $_POST['id_provider'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    if (!empty($booking_date) && !empty($booking_time)) {
        // Checking if the specified booking date and time are available
        $checkdata = "SELECT COUNT(*) AS count FROM `booking` WHERE `booking_date` = '$booking_date' AND `booking_time` = '$booking_time' ";
        $query = mysqli_query($con, $checkdata);
        $row = mysqli_fetch_assoc($query);
        $booking_count = $row['count'];

        // 2 booking limit per slot
        if ($booking_count < 2) {
            // Displaying a success message and the booking confirmation form with a JavaScript confirmation
            echo "<div class='w3-panel w3-green'><p><i class='fa fa-fw fa-check' ></i> Available </p></div>
                <hr>
                <div class='w3-section'>
                    <input name='id_service' type='hidden' value='".$id_service."'>
                    <input name='id_provider' type='hidden' value='".$id_provider."'>
                    <input name='act' type='hidden' value='add'>
                    <button type='button' class='w3-button w3-blue w3-text-white w3-round' onclick='showConfirmation()'>CONFIRM BOOKING</button>
                </div>";

            // JavaScript function to show the confirmation dialog
            echo "<script>
                function showConfirmation() {
                    if (confirm('Booking made cannot be canceled. Do you want to proceed?')) {
                        // If user clicks 'Yes', submit the form
                        document.querySelector('form').submit();
                    } else {
                        // If user clicks 'No', do nothing
                    }
                }
            </script>";
        } else {
            // Displaying a warning message when the booking limit is reached
            echo "<div class='w3-panel w3-red'><p><i class='fa fa-fw fa-exclamation-triangle' ></i> Sorry! Not Available</div>";
        }
    }

    exit();
}
?>
