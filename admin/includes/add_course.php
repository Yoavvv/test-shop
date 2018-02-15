<?php 
// Check for create course submit button request
if(isset($_POST['create_course'])) {
    
    $course_name = escape($_POST['course_name']);
    $course_description = escape($_POST['course_description']);
    $image_fileName = escape($_FILES['image']['name']);
    $image_fileName_temp = escape($_FILES['image']['tmp_name']);
    $course_tags = escape($_POST['course_tags']);
    $course_category_id = escape($_POST['course_category']);
    
    move_uploaded_file($image_fileName_temp, "../images/$image_fileName");
    // Query to insert course into DB
    $query = "INSERT INTO courses(course_name, course_description, image_fileName, course_tags, course_category_id) "; 
    
    $query .= "VALUES('{$course_name}', '{$course_description}', '{$image_fileName}', '{$course_tags}', '{$course_category_id}' ) "; 
    
    $create_course_query = mysqli_query($connection, $query);
    
    confirmQuery($create_course_query);
    
    $courseToEdit = mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>Course Created . <a href='../course.php?c_id={$courseToEdit}'>View Course</a> or <a href='courses.php'>View All Courses</a></p>";
    
}

?>
<!-- Form to handle creation of new course  -->
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="course_name">Course Name</label>
    <input type="text" maxlength="50" class="form-control" name="course_name" required>
</div>

<div class="form-group">
    <label for="category">Category :</label>
    <select name="course_category" id="">

    <?php 

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        confirmQuery($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];

            echo "<option value='$category_id'>{$category_title}</option>";
        }

    ?>

    </select>
</div>

<div class="form-group">
    <label for="course_description">Course Description</label>
    <textarea type="text" class="form-control" name="course_description" id="" cols="30" rows="10" maxlength="200"></textarea>
</div>

<div class="form-group">
    <label for="image_fileName">Course Image</label>
    <input type="file" class="form-control" name="image">
</div>

<div class="form-group">
    <label for="course_tags">Course Tags</label>
    <input type="text" class="form-control" name="course_tags" placeholder="Tag, Tag, Tag ...">
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_course" value="Publish Course">
</div>
</form>