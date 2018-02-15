<?php ob_start(); ?>
<?php require_once "../includes/db.php" ?>
<?php require_once "functions.php" ?>
<?php session_start(); ?>
<?php 
// Check if there is logged in user role and if not - redirect him to registration page
if (!isset($_SESSION['user_role'])) {
    
    redirect("../registration.php");
    
    die;
    
} else {
    // Check if the logged in user is manager and if not - redirect him to student homepage
    if ($_SESSION['user_role'] == 'student') {
        
        redirect("../index.php");
        
        die;
    }
}

?>
<!-- Header -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Course Manager - ADMIN</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0cko40p3lzq5oqyurq3lrd93k1fh49ktoc7j5kwioc6ky4y5"></script>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
</head>

<body>