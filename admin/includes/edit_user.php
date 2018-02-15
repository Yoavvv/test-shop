<?php require_once "./functions.php";?>

<?php 
// Check for getting user 
if(isset($_GET['edit_user'])) {
    
    $userToEdit = $_GET['edit_user'];    
}
// Query to get a specific user    
$query = "SELECT * FROM users WHERE user_id = $userToEdit ";
$select_users_query = mysqli_query($connection, $query);

$user_courses_value_id = $_GET['edit_user'];
$user_courses_value_id = "";

// Check for checked checkbox submit button request
if(isset($_POST['user_courses_array'])) {

    if (!empty($_POST['user_courses_array'])) {
        // For each checked course -> insert to a list with seperating comma & line break
        foreach($_POST['user_courses_array'] as $course) {
            
            echo "<input type='checkbox' disabled name='user_courses_array[]' value='<?php echo $course; ?>' >";
            
            echo "$course";  
        }
    }
}

    while($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_phone = $row['user_phone'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];  
        $user_course_name = $row['user_course_name'];  
    }
// Check for update user submit button request    
if(isset($_POST['update_user'])) {
    
    $user_courses_value_id = $_POST['update_user'];
    $user_courses_value_id = "";
    
    // Check for checked checkbox submit button request
    if(isset($_POST['user_courses_array'])) {
    
        if (!empty($_POST['user_courses_array'])) {
            // For each checked course -> insert to a list with seperating comma & line break
            foreach($_POST['user_courses_array'] as $user_courses_value_id) {

                $user_courses_value_id = implode(" , <br />",$_POST['user_courses_array']);


            }
        }
    }
    
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_phone = escape($_POST['user_phone']);
    $user_password = escape($_POST['user_password']);

    move_uploaded_file($user_image_temp, "../images/$user_image");
    
    // If password is NOT empty -> get the last image
    if(!empty($user_password)) {
        
        //Query to get the user password
        $query_password ="SELECT user_password FROM users WHERE user_id = $userToEdit ";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQuery($get_user_query);
        
        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];
        
        // Check if the password is the same password in DB , if not...
        if($db_user_password != $user_password) {
            // ... if not -> make the password hashing
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }
        // If image is empty -> get the last image
        if(empty($user_image)) {
        
            $query = "SELECT * FROM users WHERE user_id = $userToEdit ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)) {

                $user_image = $row['user_image'];   
            }  
        }
        // Query for edit user 
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_phone = '{$user_phone}', ";
        $query .= "user_course_name = '{$user_courses_value_id}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_id = {$userToEdit} ";

        $editUserQuery = mysqli_query($connection, $query);

        confirmQuery($editUserQuery);

        if($user_role == 'manager') {

            redirect("users.php"); 
    
        } else {

            redirect("../user.php?u_id=$userToEdit"); 
        }
    }
}
    
?>
<!-- Form to handle edit user request  -->  
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
        <select name="user_role" id="">
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
    <hr>
    <div class="form-group">

        <?php 
            // Depends on user role -> show different form
            if($user_role == 'student') { ?>
        
            <h4 for="user_courses_array">Student Courses :</h4>
            <h4>Please <strong>UNCHECK</strong> courses you are not intrested</h4>
        
        <?php 

            $query = "SELECT * FROM courses";
            $select_courses = mysqli_query($connection, $query);

            confirmQuery($select_courses);

            while($row = mysqli_fetch_assoc($select_courses)) {
                $course_id = $row['course_id'];
                $course_name = $row['course_name'];
                $course_description = $row['course_description'];
                $image_fileName = $row['image_fileName'];
                $course_tags = $row['course_tags'];
                $course_category_id = $row['course_category_id'];
                $course_comment_count = $row['course_comment_count'];

            echo "<br />";
        ?>
            <input type='checkbox' checked class='checkBoxes' name='user_courses_array[]' value='<?php echo $course_name; ?>' <?php if($row['course_name']=='true'){echo 'checked="checked"';} ?> >
            
        <?php
                
            echo "<label>$course_name</label>";

            }

            } else { ?>

            <h4>Courses Available :</h4>
    <?php 

            $query = "SELECT * FROM courses";
            $select_courses = mysqli_query($connection, $query);

            confirmQuery($select_courses);

            while($row = mysqli_fetch_assoc($select_courses)) {
                $course_id = $row['course_id'];
                $course_name = $row['course_name'];
                $course_description = $row['course_description'];
                $image_fileName = $row['image_fileName'];
                $course_tags = $row['course_tags'];
                $course_category_id = $row['course_category_id'];
                $course_comment_count = $row['course_comment_count'];

            echo "<br />";
    ?>

    <?php
            echo "<label>$course_name</label>";

            }
        }
          
    ?>
           
    </div>
    <hr>
    
    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" maxlength="30" required name="user_email" disabled>
    </div>

    <div class="form-group">
        <label for="user_phone">User Phone</label>
        <input type="number" value="<?php echo $user_phone; ?>" class="form-control" name="user_phone" required maxlength="15">
    </div>

    <div class="form-group">
        <label for="user_password">User Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password" minlength="6" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label><br />
        <img width="200" src="../images/<?php echo $user_image ;?>" alt=""><input  type="file" name="image">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>

</form>