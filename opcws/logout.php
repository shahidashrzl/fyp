<?php
    session_start();
    
    session_destroy();
    
    // Set success message
    $_SESSION['success_message'] = 'Successfully Logout';
    
    echo '<script>alert("Successfully Logout");</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit();
?>
