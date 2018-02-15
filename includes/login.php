<!-- Start session -->
<?php session_start(); ?>
<?php require_once "db.php"; ?>
<?php require_once "../admin/functions.php"; ?>
<?php 
    // If the submit login button pressed
    if(isset($_POST['login'])) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Prevent MYSQL injection
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        
        // Query to get specific user by his unique email
        $query = "SELECT * FROM users WHERE user_email = '{$email}' ";
        $select_user_query = mysqli_query($connection, $query);
        
        if(!$select_user_query) {
            
            die("QUERY FAILED . " . mysqli_error($connection));
        }
        
        while($row = mysqli_fetch_array($select_user_query)) {
            
            $db_user_id = $row['user_id'];
            $db_user_email = $row['user_email'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            $db_user_image = $row['user_image'];
            $db_user_phone = $row['user_phone'];
        }
        // If the password is verified -> submit session for the user
        if(password_verify($password, $db_user_password)) {
            
            $_SESSION['email'] = $db_user_email;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_image'] = $db_user_image;
            $_SESSION['user_phone'] = $db_user_phone;
            
            redirect("/cms/admin"); 
            
        } else {
            
            redirect("/cms/registration.php");
        }  
    }
  
?>
