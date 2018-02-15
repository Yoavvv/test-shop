<?php require_once "functions.php";?>

<?php

require_once("delete_modal.php");

    // Check for checkbox submition
    if(isset($_POST['checkBoxArray'])) {
        
        foreach($_POST['checkBoxArray'] as $courseValueId) {
            
            $bulk_options = $_POST['bulk_options'];
            // Switch between cases that handles unique request for checked cells in checkbox zone
            switch($bulk_options) {
                    
                case 'delete':
                    // Query for delete all checked boxes
                    $query = "DELETE FROM courses WHERE course_id = {$courseValueId} ";
                    
                    $deleteCourse = mysqli_query($connection, $query);
                    
                    confirmQuery($deleteCourse);
                    
                    break;
                    
                case 'clone':
                    // Query for clone all checked boxes
                    $query = "SELECT * FROM courses WHERE course_id = '{$courseValueId}' ";
                    
                    $select_course_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_course_query)) {
                        
                        $course_id = $row['course_id'];
                        $course_name = $row['course_name'];
                        $course_description = $row['course_description'];
                        $image_fileName = $row['image_fileName'];
                        $course_tags = $row['course_tags'];
                        $course_category_id = $row['course_category_id'];
                        $course_comment_count = $row['course_comment_count'];
                    }
                    
                    $query = "INSERT INTO courses(course_name, course_description, image_fileName, course_tags, course_category_id, course_comment_count) ";
    
                    $query .= "VALUES('{$course_name}', '{$course_description}', '{$image_fileName}', '{$course_tags}', '{$course_category_id}', '{$course_comment_count}' ) "; 
                    
                    $copy_query = mysqli_query($connection, $query);
                    
                    if(!$copy_query) {
                        
                        die("QUERY FAILED . " . mysqli_error($connection));
                    }
                    
                    break;
            }
        }
    }

?>                      
<!-- Courses table structure -->
<form action="" method="post"> 
<div style="overflow-x:auto;">  
<table class="table table-bordered table-hover">
  <div class="row">  
       <div id="bulkOptionsContainer" class="col-xs-4 form-group">
           <select class="form-control" name="bulk_options" id="">
               <option value="">Select option:</option>
               <option value="delete">Delete Course (or a few courses)</option>
               <option value="clone">Clone Course (or a few courses)</option>
           </select>
       </div>
       
   <div class="col-xs-4 form-group">
       <input type="submit" name="submit" class="btn btn-success" value="Apply"><br/><br/>
       <a class="btn btn-primary" href="courses.php?source=add_course">Add New</a>
   </div>
</div>

<thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Category</th>
        <th>Comments</th>
        <th>View Course</th>
        <th>Edit</th>
        <th><i class="fa fa-fw fa-caret-down"></i>Del / Clo</th>
        <th>Delete</th>
        <th>Views / Reset</th>
        <th>Students Enrolled</th>
    </tr>
</thead>
<tbody>

<?php 
// Query for JOIN course & user tables , to get all data to display
$query = "SELECT courses.course_id, courses.course_name, courses.course_description, courses.image_fileName, courses.course_tags, courses.course_category_id, courses.course_comment_count, courses.course_views_count, "; 
$query .= "users.user_id, users.user_firstname, users.user_course_name ";
$query .= "FROM courses ";
$query .= "LEFT JOIN users ON courses.course_name = users.user_course_name ORDER BY courses.course_name ASC ";

$select_courses = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_courses)) {
    $course_id = $row['course_id'];
    $course_name = $row['course_name'];
    $course_description = $row['course_description'];
    $image_fileName = $row['image_fileName'];
    $course_tags = $row['course_tags'];
    $course_category_id = $row['course_category_id'];
    $course_comment_count = $row['course_comment_count'];
    $course_views_count = $row['course_views_count'];
    $user_id = $row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_course_name = $row['user_course_name'];

    echo "<tr>";

?>

    

<?php

    echo "<td>$course_id</td>";
    echo "<td>$course_name</td>";
    echo "<td>$course_description</td>";
    echo "<td><img width='100' src='../images/$image_fileName' alt='image'></td>";
    echo "<td>$course_tags</td>";
   
    // Get category for specific course
    $query = "SELECT * FROM categories WHERE category_id = $course_category_id ";
    $send_category_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($send_category_query)) {
        
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        
        echo "<td>{$category_title}</td>";
        
    }

    // Get cooments for specific course
    $query = "SELECT * FROM comments WHERE comment_course_id = $course_id ";
    $send_comment_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($send_comment_query);
    $comment_id = $row['comment_id'];
    $count_comments = mysqli_num_rows($send_comment_query);

    echo "<td><a href='course_comments.php?id=$course_id'>$count_comments</a></td>";
    echo "<td><a class='btn btn-primary' href='../course.php?c_id={$course_id}'>View Course</a></td>";
    echo "<td><a class='btn btn-info' href='courses.php?source=edit_course&c_id={$course_id}'>Edit</a></td>";
    
    // Get all users that are registered to a specific course
    $query = "SELECT * FROM users WHERE user_course_name LIKE '%$course_name%' ";
    $searchQuery = mysqli_query($connection, $query);

    if(!$searchQuery) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    $count = mysqli_num_rows($searchQuery);
    
    // Condition - if there is registered users to a course -> then disable delete course option 
    if($count > 0) {
        
?>    
        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $course_id; ?>' disabled></td>
        
<?php   
        echo "<td><a rel='$course_id' href='javascript:void(0)' class='delete_link btn btn-danger' disabled>Delete</a></td>";
                
        echo "<td><a href='courses.php?reset={$course_id}'>{$course_views_count}</a></td>";
        echo "<td>{$count}</td>";
        echo "</tr>";
            
    } else {
?>      
        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $course_id; ?>'></td>
 <?php   
        echo "<td><a rel='$course_id' href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";    
        echo "<td><a href='courses.php?reset={$course_id}'>{$course_views_count}</a></td>";
        echo "<td>{$count}</td>";
        echo "</tr>"; 
        
    }
}

?>

    </tbody>
</table>
</div>
</form>
                      
<?php 

// Check for delete button submit request
if(isset($_GET['delete'])) {

    $courseToDelete = $_GET['delete'];
    // Query for delete course 
    $query = "DELETE FROM courses WHERE course_id = {$courseToDelete} ";
    $deleteQuery = mysqli_query($connection, $query);
    redirect("courses.php");
}

// Check for reset button submit request
if(isset($_GET['reset'])) {

    $viewsReset = $_GET['reset'];
    // Query for reset course views count 
    $query = "UPDATE courses SET course_views_count = 0 WHERE course_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $resetQuery = mysqli_query($connection, $query);
    redirect("courses.php");
}

?>
                                        
<script>

    $(document).ready(function() {
       
       // Confirm delete modal 
       $(".delete_link").on('click', function() {
           
            var id = $(this).attr("rel");
           
            var delete_url = "courses.php?delete="+ id + " ";
           
            $(".modal_delete_link").attr("href", delete_url);
          
            $("#myModal").modal('show');
           
       });
        
    });

</script>