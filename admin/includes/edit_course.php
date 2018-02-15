<?php 
// Check for getting specific course id request
if(isset($_GET['c_id'])) {

    $courseToEdit = $_GET['c_id'];  
}
// Query for getting specific course & his properties
$query = "SELECT * FROM courses WHERE course_id=$courseToEdit";
$select_courses_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_courses_by_id)) {
    $course_id = $row['course_id'];
    $course_name = $row['course_name'];
    $course_description = $row['course_description'];
    $image_fileName = $row['image_fileName'];
    $course_tags = $row['course_tags'];
    $course_category_id = $row['course_category_id'];
    $course_comment_count = $row['course_comment_count'];

}
// Check for update course submit button request
if(isset($_POST['update_course'])) {
    
    $course_name = escape($_POST['course_name']);
    $course_description = escape($_POST['course_description']);
    $image_fileName = $_FILES['image']['name'];
    $image_fileName_temp = $_FILES['image']['tmp_name'];
    $course_tags = escape($_POST['course_tags']);
    $course_category_id = escape($_POST['course_category']);
    
    move_uploaded_file($image_fileName_temp, "../images/$image_fileName");
    
    // If image is empty -> get the last image
    if(empty($image_fileName)) {
        
        $query = "SELECT * FROM courses WHERE course_id = $courseToEdit ";
        $select_image = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_image)) {
            
            $image_fileName = $row['image_fileName'];   
        }  
    }
    // Query for edit course 
    $query = "UPDATE courses SET ";
    $query .= "course_name = '{$course_name}', ";
    $query .= "course_description = '{$course_description}', ";
    $query .= "image_fileName = '{$image_fileName}', ";
    $query .= "course_tags = '{$course_tags}', ";
    $query .= "course_category_id = '{$course_category_id}' ";
    $query .= "WHERE course_id = {$courseToEdit} ";
    
    $update_course = mysqli_query($connection, $query);
    
    confirmQuery($update_course);
    
    echo "<p class='bg-success'>Course Updated . <a href='../course.php?c_id={$courseToEdit}'>View Course</a> or <a href='courses.php'>Edit More Courses</a></p>";   
}

?>
<!-- Form to handle edit course request  -->
<form action="" method="post" enctype="multipart/form-data">
   
   <?php 
    // Query to get all courses belonging to specific user
    $query = "SELECT * FROM users WHERE user_course_name LIKE '%$course_name%' ";
    $searchQuery = mysqli_query($connection, $query);

    if(!$searchQuery) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    $count = mysqli_num_rows($searchQuery);

    echo "<h3 class='page-header'>Total of <strong>$count</strong>" . " " . "Registered Students taking this course</h3>" ;  

    ?>

    <div class="form-group">
        <label for="course_name">Course Name</label>
        <input value="<?php echo $course_name; ?>" type="text" maxlength="30" class="form-control" name="course_name" required>
    </div>

    <div class="form-group">

        <label for="course_category">Category :</label>
        <select name="course_category" id="">

            <?php 
                // Query to get all categories & a specific course category
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                confirmQuery($select_categories);

                while($row = mysqli_fetch_assoc($select_categories)) {
                    $category_id = $row['category_id'];
                    $category_title = $row['category_title'];

                    if($category_id == $course_category_id) {

                       echo "<option selected value='$category_id'>{$category_title}</option>"; 

                    } else {

                        echo "<option value='$category_id'>{$category_title}</option>";    
                    }
                }

            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="course_description">Course Description</label>
        <textarea type="text" class="form-control" name="course_description" id="" cols="30" rows="10"><?php echo str_replace('\r\n', '</br>', $course_description); ?></textarea>
    </div>

    <div class="form-group">
        <label for="image_fileName">Course Image</label><br />
        <img width="200" src="../images/<?php echo $image_fileName ;?>" alt=""><input  type="file" name="image">
    </div>

    <div class="form-group">
        <label for="course_tags">Course Tags</label>
        <input value="<?php echo $course_tags; ?>"  type="text" class="form-control" name="course_tags" placeholder="Tag, Tag, Tag ...">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_course" value="Update Course">
    </div>
</form>