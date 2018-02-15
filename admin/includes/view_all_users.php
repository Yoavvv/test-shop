<?php require_once("delete_modal.php"); ?>
<?php require_once "functions.php";?>

  <!-- Users table structure -->    
  <div style="overflow-x:auto;">
   <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Image</th>
            <th>Courses Enrolled</th>
            <th>Change role to :</th>
            <th>Change role to :</th>
            <th>Edit</th>
            <th>Delete</th>
            
        </tr>
    </thead>
    <tbody>
                                
   <?php 
    // Query for getting all users & order them by role
    $query = "SELECT * FROM users ORDER BY users.user_role ASC";
    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_phone = $row['user_phone'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_course_name = $row['user_course_name'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_phone</td>";
        echo "<td>$user_role</td>";
        echo "<td><img width='100' src='../images/$user_image' alt='image'></td>";
        echo "<td>$user_course_name</td>";
        echo "<td><a href='users.php?change_to_manager={$user_id}'>Manager</a></td>";
        echo "<td><a href='users.php?change_to_student={$user_id}'>Student</a></td>";
        echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
        echo "<td><a rel='$user_id' href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";
        echo "</tr>";
    }

    ?>

    </tbody>
</table>
</div>
                   
 <?php 
      // Check for change to manager button submit request
      if(isset($_GET['change_to_manager'])) {

        $the_user_id = $_GET['change_to_manager'];
        //Query for changing role to manager
        $query = "UPDATE users SET user_role = 'manager' WHERE user_id = $the_user_id ";
        $changeToManagerQuery = mysqli_query($connection, $query);
        redirect("users.php");
    }
     // Check for change to student button submit request
     if(isset($_GET['change_to_student'])) {

        $the_user_id = $_GET['change_to_student'];
        //Query for changing role to student
        $query = "UPDATE users SET user_role = 'student' WHERE user_id = $the_user_id ";
        $changeToStudentQuery = mysqli_query($connection, $query);
        redirect("users.php");
    }
    // Check for delete button submit request
    if(isset($_GET['delete'])) {

        if(isset($_SESSION['user_role'])) {

            if($_SESSION['user_role'] == 'manager') {

        $userToDelete = mysqli_real_escape_string($connection, $_GET['delete']);
        // Query for delete user from DB
        $query = "DELETE FROM users WHERE user_id = {$userToDelete} ";
        $deleteUserQuery = mysqli_query($connection, $query);
        redirect("users.php");
                
            }

        }

    }

?>

<script>

    $(document).ready(function() {
       
       // Confirm delete modal
       $(".delete_link").on('click', function() {
           
            var id = $(this).attr("rel");
           
            var delete_url = "users.php?delete="+ id + " ";
           
            $(".modal_delete_link").attr("href", delete_url);
          
            $("#myModal").modal('show');
           
       });
        
    });

</script>