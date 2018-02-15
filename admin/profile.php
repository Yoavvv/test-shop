<?php require_once "functions.php";?>
<?php require_once "includes/admin_header.php" ?>
    
<?php
// If there is a session email on...    
if(isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    
    // Query to get the specific user and his properties
    $query = "SELECT * FROM users WHERE user_email = '{$email}' ";
    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)) {

        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_phone = $row['user_phone'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
} 

?>
   
<?php
// If there is a request to get user details
if(isset($_GET['edit_user'])) {

    $userToEdit = $_GET['edit_user'];
    // Query to get the specific user and his properties
    $query = "SELECT * FROM users WHERE user_id = $userToEdit ";
    $select_users_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_phone = $row['user_phone'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];     
    }   
}
// If there is a request to edit user details
if(isset($_POST['edit_user'])) {
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_phone = $_POST['user_phone'];
    
    // Query to edit user details
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_phone = '{$user_phone}' ";
    $query .= "WHERE user_email = '{$email}' ";
    
    $editUserQuery = mysqli_query($connection, $query);
    confirmQuery($editUserQuery); 
    redirect("users.php");
}

?>

<div id="wrapper">
    <!-- Navigation -->
    <?php require_once "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="page-header">Your Profile Details 
                        <small><?php echo $_SESSION['firstname']; ?></small>
                    </h1>
                    <!-- Form to handle user profile -->
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_firstname">First Name</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" maxlength="15" required>
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Last Name</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" maxlength="15" required>
                        </div>

                        <div class="form-group">
                            <select name="user_role" id="" required>
                               <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option> 
                               <?php 
                                    if($user_role == 'manager') {

                                        echo "<option value='student'>student</option>"; 

                                    } else {

                                        echo "<option value='manager'>manager</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_email">User Email</label>
                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" maxlength="30" disabled>
                        </div>

                        <div class="form-group">
                            <label for="user_phone">User Phone</label>
                            <input type="number" value="<?php echo $user_phone; ?>" class="form-control" name="user_phone" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require_once "includes/admin_footer.php" ?>