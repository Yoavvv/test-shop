<!-- Start session -->
<?php ob_start(); ?>

<?php 
// Declare connection to the cms database
$connection = mysqli_connect('localhost', 'root', '', 'cms');

// Check connection
if(mysqli_connect_errno($connection)) {
    
    die("Failed to connect to the database. Error: " . mysqli_connect_error());
}

// Set unicode to "utf-8" so hebrew can be inserted properly
mysqli_set_charset($connection, "utf8");


?>