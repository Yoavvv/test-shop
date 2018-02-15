<?php require_once "includes/db.php";?>
<?php require_once "includes/header.php";?>
<?php require_once "./admin/functions.php";?>


    <!-- Navigation -->
    <?php require_once "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                
                <?php 
                // Check for getting specific course id               
                if(isset($_GET['c_id'])) {

                    $courseToDisplay = $_GET['c_id'];
                    // Comments count adjustment 
                    $view_query = "UPDATE courses SET course_views_count = course_views_count + 1 WHERE course_id = $courseToDisplay ";
                    $send_query = mysqli_query($connection, $view_query);

                    if(!$send_query) {

                        die("QUERY FAILED");
                    }
                    // Query for getting specific course & display his properties
                    $query = "SELECT * FROM courses WHERE course_id = $courseToDisplay ";
                    $allCoursesQuery = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($allCoursesQuery)) {
                        $course_name = $row['course_name'];
                        $course_description = $row['course_description'];
                        $image_fileName = $row['image_fileName'];
                        $course_tags = $row['course_tags'];
                        $course_category_id = $row['course_category_id'];
                        $course_comment_count = $row['course_comment_count'];
                        
                    ?>
                    
                    <h2>
                        <?php echo $course_name ?>
                    </h2>
                        
                    <h3 class="page-header">Course Tags --> <small><?php echo $course_tags; ?></small></h3>
                    <img class="img-responsive" src="images/<?php echo $image_fileName; ?>" alt="">
                    <p><?php echo $course_description ?></p>         
                    <hr>
                    
                    <?php
                    // Query for checking which users registered to a specific course 
                    $query = "SELECT * FROM users WHERE user_course_name LIKE '%$course_name%' ";
                    $searchQuery = mysqli_query($connection, $query);

                    if(!$searchQuery) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($searchQuery);

                    if($count == 0) {

                        echo "<h3 class='page-header'>No Registered Students</h3>";

                    } else {

                        echo "<h3 class='page-header'>$count" . " " . "Registered Students</h3>" ;    

                        while($row = mysqli_fetch_assoc($searchQuery)) {
                            $user_id = $row['user_id'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_course_name = $row['user_course_name'];
                    ?>
                            
                            <ul>
                                <li><?php echo $user_firstname . " " . $user_lastname ?></li>
                            </ul>                    
                    
                    
                    
                   <?php } } } } ?>
            
                   
                    
                    <!-- Course Comments -->
                
                    <?php 
                    // Check for create comment submit button request
                    if(isset($_POST['create_comment'])) {
                        
                        $courseToDisplay = $_GET['c_id'];
                        $comment_author = escape($_POST['comment_author']);
                        $comment_email = escape($_POST['comment_email']);
                        $comment_content = escape($_POST['comment_content']);
                        
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                            // Query for insertion a comment to a specific course, unapproved as default
                            $query = "INSERT INTO comments (comment_course_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        
                            $query .= "VALUES  ($courseToDisplay, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now()) ";
                        
                            $create_comment_query = mysqli_query($connection, $query);
                        
                            if(!$create_comment_query) {
                                
                                die('QUERY FAILED . ' . mysqli_error($connection));
                            }
                        
                        } else {
                            
                            echo "<script>alert('Fields cannot be empty!!!')</script>";
                        }
                             
                    }
                       
                    ?>
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" name="comment_author" required maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="comment_email" required maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment_content" class="form-control" rows="3" required maxlength="100"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php 
                
                    $query = "SELECT * FROM comments WHERE comment_course_id = {$courseToDisplay} ";
                
                    $query .= "AND comment_status = 'approved' ";
                
                    $query .= "ORDER BY comment_id DESC ";
                
                    $select_comment_query = mysqli_query($connection, $query);
                
                    if(!$select_comment_query) {
                        
                        die('QUERY FAILED . ' . mysqli_error($connection));
                    }
                        while($row = mysqli_fetch_array($select_comment_query)) {

                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                            $comment_author = $row['comment_author'];
                        
                    ?>
                       
                      <!-- Comment -->
                    <div class="media">

                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>
                    
                  <?php } ?>
            
            </div>

            <!-- Course Sidebar -->
            <?php require_once "includes/sidebar.php";?>

        </div>
        <hr>
        
<?php require_once "includes/footer.php";?>





        