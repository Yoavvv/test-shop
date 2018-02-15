<?php require_once "includes/admin_header.php" ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php require_once "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="page-header">
                        Welcome to Comments
                        <small><?php echo $_SESSION['firstname']; ?></small>
                    </h1>
                    <!-- Display table with specific course comments -->
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
                        </tr>
                    </thead>
                    <tbody>

                   <?php
                    // Query for specific course comments
                    $query = "SELECT * FROM comments WHERE comment_course_id =" . mysqli_real_escape_string($connection, $_GET['id']). " ";
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
                        echo "</tr>";
                    }

                    ?>

                    </tbody>
                </table>

                 <?php 
                  // If get request for approval has made
                  if(isset($_GET['approve'])) {

                    $commentToApprove = $_GET['approve'];
                    // Update the comment to be approved
                    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $commentToApprove ";
                    $approveCommentQuery = mysqli_query($connection, $query);
                    header("Location: comments.php");
                }
                 // If get request for unapproval has made
                 if(isset($_GET['unapprove'])) {

                    $commentToUnapprove = $_GET['unapprove'];
                    // Update the comment to be unapproved
                    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $commentToUnapprove ";
                    $unapproveCommentQuery = mysqli_query($connection, $query);
                    header("Location: comments.php");
                }
                // If get request for delete has made
                if(isset($_GET['delete'])) {

                    $commentToDelete = $_GET['delete'];
                    // Delete the comment from the DB
                    $query = "DELETE FROM comments WHERE comment_id = {$commentToDelete} ";
                    $deleteQuery = mysqli_query($connection, $query);
                    header("Location: course_comments.php?id=" . $_GET['id'] . " ");
                }
                    
                ?>

               </div>
            </div>
        </div>
    </div>

<?php require_once "includes/admin_footer.php" ?>

