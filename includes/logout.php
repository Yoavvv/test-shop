<?php ob_start(); ?>
<?php session_start(); ?>

<?php 
    // Set session details to null
    $_SESSION['email'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['user_role'] = null;

    header("Location: ../registration.php");

?>

    






