
<?php require_once "./functions.php";?>
<?php

$user_email = '';
// Check for create user submit button request
if(isset($_POST['create_user'])) {
    
    $user_courses_value_id = $_POST['create_user'];
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
    $user_email = escape($_POST['user_email']);
    $user_phone = escape($_POST['user_phone']);
    $user_password = escape($_POST['user_password']);
    
    // Get the image from temp location to actual folder location
    move_uploaded_file($user_image_temp, "../images/$user_image");
    
    // Password hashing
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    
    // Query to get the courses for specific user
    $query = "SELECT * FROM users WHERE user_email LIKE '%$user_email%' ";
    $userEmailQuery = mysqli_query($connection, $query);

    if(!$userEmailQuery) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    
    // Handle errors before submit
    $error = [ 'user_email'=> '' ];

    $count = mysqli_num_rows($userEmailQuery);

    if($count > 0) {

        $error['user_email'] = 'Email already exist';
        
        redirect("");

    } else {
    
    // Query to add user to DB after error handling
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_image, user_email, user_phone, user_password, user_course_name) "; 
    
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_image}', '{$user_email}', '{$user_phone}', '{$user_password}', '{$user_courses_value_id}') "; 
     
    $create_user_query = mysqli_query($connection, $query);
    
    confirmQuery($create_user_query);
    
    $userToAdd = mysqli_insert_id($connection);
    
    if($user_role == 'manager') {
        
        redirect("index.php");
        
    } else {

        redirect("../user.php?u_id=$userToAdd");
    }
}
    
}

?>
<!-- Form to handle add user request -->
<form action="" method="post" enctype="multipart/form-data">
<h4 class='bg-danger'><strong><?php echo isset($error['user_email']) ? $error['user_email'] : '' ?><?php echo ' ' . '-->' . ' ' . $user_email ?></strong></h4>

<div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" maxlength="15" class="form-control" name="user_firstname" required>
</div>

<div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" maxlength="15" class="form-control" name="user_lastname" required>
</div>

<div class="form-group">
    <label for="user_רםךק">Role :</label>
    <select name="user_role" id="">
        <option value="student">Select Option:</option> 
        <option value="manager">Manager</option>    
        <option value="student">Student</option>    
    </select>
</div>
<hr>
<div class="form-group">
<label>Choose courses :</label>
<?php 
    // Handle checked courses from checkboxes
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
        <input type='checkbox' class='checkBoxes' name='user_courses_array[]' value='<?php echo $course_name; ?>'>


        <?php echo "<label>$course_name</label>"; } ?> 
</div>
<hr>
<div class="form-group">
    <label for="user_email">User Email</label>
    <input type="email" maxlength="30" class="form-control" name="user_email" required>
</div>

<div class="form-group">
    <label for="user_phone">User Phone</label>
    <input type="number" class="form-control" name="user_phone" required maxlength="15">
</div>

<div class="form-group">
    <label for="user_password">User Password</label>
    <input type="password" minlength="6" maxlength="25" class="form-control" name="user_password" required>
</div>

<div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" class="form-control" name="image">
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
</div>

</form>