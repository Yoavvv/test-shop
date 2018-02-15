<?php require_once "includes/db.php";?>
<?php require_once "includes/header.php";?>
<?php require_once "./admin/functions.php";?>

    <!-- Navigation -->
    <?php require_once "includes/navigation.php";?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                
            <?php 

            // Check for getting request for specific user id     
            if(isset($_GET['u_id'])) {

                $userToDisplay = $_GET['u_id'];
                // Query for getting specific user & display his properties
                $query = "SELECT * FROM users WHERE user_id = $userToDisplay ";
                $allUsersQuery = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($allUsersQuery)) {
                    $user_id = $row['user_id'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_phone = $row['user_phone'];
                    $user_password = $row['user_password'];
                    $user_role = $row['user_role'];
                    $user_image = $row['user_image'];
                    $user_course_name = $row['user_course_name'];

            ?>
                    <h3>Name :
                    <?php echo $user_firstname . " " . $user_lastname . "<br /><br />" . "Role : " . $user_role . "<br /><br />";?>
                    <img width="550" class="img-responsive thumbnail" src="images/<?php echo $user_image; ?>" alt="">
                    <?php
                    
                        echo "<br />";
                        echo " Phone : " . "<small>$user_phone</small>" . "<br /><br />";
                        echo " Email : " . "<small>$user_email</small>";

                    ?>
                       <hr>
                        <!-- Display which courses the user registered -->
                        <h3>Courses Enrolled : </h3>
                        <h3><small><?php echo $user_course_name ?></small></h3>      
                    </h3>                        
                    <hr>
                    
                   <?php }
                    
                    } else {
                        
                        redirect("index.php");
                    }
                    
                   ?>
            </div>

            <!-- User Sidebar -->
            <?php require_once "includes/sidebar.php";?>

        </div>
        <hr>
        
<?php require_once "includes/footer.php";?>
