      <?php require_once "functions.php";?>
      <?php require_once("delete_modal.php"); ?>
     
      <div style="overflow-x:auto;">
       <!-- Create comments table structure -->
       <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response To</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

           <?php 
            // Query to get all comments from DB 
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['comment_id'];
                $comment_course_id = $row['comment_course_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";
                
                // Query to get specific course depends on which comment linked to course
                $query = "SELECT * FROM courses WHERE course_id = $comment_course_id ";

                $select_course_id_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_course_id_query)) {

                    $course_id = $row['course_id'];
                    $course_name = $row['course_name'];

                    echo "<td><a href='../course.php?c_id=$course_id'>{$course_name}</a></td>";
                }

                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                echo "<td><a rel='$comment_id' href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";
                echo "</tr>";

            }

            ?>

        </tbody>
    </table>
</div>
 <?php 

// Check for approval button submit request
if(isset($_GET['approve'])) {

    $commentToApprove = $_GET['approve'];
    // Query for update comment as approved
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $commentToApprove ";
    $approveCommentQuery = mysqli_query($connection, $query);
    redirect("comments.php");
}

// Check for unapproval button submit request
if(isset($_GET['unapprove'])) {

    $commentToUnapprove = $_GET['unapprove'];
    // Query for update comment as unapproved
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $commentToUnapprove ";
    $unapproveCommentQuery = mysqli_query($connection, $query);
    redirect("comments.php");
}

// Check for delete button submit request
if(isset($_GET['delete'])) {

    $commentToDelete = $_GET['delete'];
    // Query for delete comment 
    $query = "DELETE FROM comments WHERE comment_id = {$commentToDelete} ";
    $deleteQuery = mysqli_query($connection, $query);
    redirect("comments.php");
}

?>


<script>

    $(document).ready(function() {
       
       // Confirm delete modal  
       $(".delete_link").on('click', function() {
           
            var id = $(this).attr("rel");
           
            var delete_url = "comments.php?delete="+ id + " ";
           
            $(".modal_delete_link").attr("href", delete_url);
          
            $("#myModal").modal('show');
           
       });
        
    });

</script>