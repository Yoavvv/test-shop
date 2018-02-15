<?php require_once "includes/db.php";?>
<?php require_once "includes/header.php";?>
<?php require_once "./admin/functions.php"; ?>
<?php

    // Check for user email in web session
    if(isset($_SESSION['email'])) { ?>

    <!-- Navigation -->
    <?php require_once "includes/navigation.php";?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col">
                
            <?php 
                // Check for page request
                if(isset($_GET['page'])) {

                    $page = $_GET['page'];

                } else {

                    $page = "";
                }

                if($page == "" || $page == 1) {

                    $page_1 = 0;

                } else {

                    $page_1 = ($page * 5) - 5;
                }
                // Set Pagination count to 5 courses per page
                $course_query_count = "SELECT * FROM courses";
                $find_count = mysqli_query($connection, $course_query_count);
                $count = mysqli_num_rows($find_count);

                if($count < 1) {

                    echo "<h1 class='text-center'>NO COURSES TO DISPLAY</h1>";

                } else {

                $count = ceil($count / 5);

                // Get courses properties to display
                $query = "SELECT * FROM courses LIMIT $page_1, 5";
                $allCoursesQuery = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($allCoursesQuery)) {
                    $course_id = $row['course_id'];
                    $course_name = $row['course_name'];
                    $course_description = substr($row['course_description'],0,100);
                    $image_fileName = $row['image_fileName'];
                    $course_tags = $row['course_tags'];
                   
            ?>

                <h2>
                    <a href="course.php?c_id=<?php echo $course_id; ?>"><?php echo $course_name ?></a>
                </h2>

                <h3 class="page-header">Course Tags --> <small><?php echo $course_tags; ?></small></h3>
                <a href="course.php?c_id=<?php echo $course_id; ?>"><img class="img-responsive" src="images/<?php echo $image_fileName; ?>" alt=""></a>
                <p class="check"><?php echo $course_description ?></p>
                <a class="btn btn-primary" href="course.php?c_id=<?php echo $course_id; ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } } ?>
                    
            </div>

            <!-- Course Sidebar -->
            <?php require_once "includes/sidebar.php";?>

        </div>
        

        <hr>
        <!-- Pagination bottom links -->
        <ul class="pager">
            
        <?php 
            
            for($i = 1; $i <= $count; $i++) {
                
                if($i == $page) {
                    
                   echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>"; 
                    
                } else if($page == "") {
                    
                    $page = 1;
                    
                    echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                    
                
                } else {
                    
                   echo "<li><a href='index.php?page={$i}'>{$i}</a></li>"; 
                    
                }
                
            } 
            
            } else {
                // If there isn't user email in web session - redirect to register / login
                redirect("registration.php");
            }
            
        ?>
           
        </ul>
        
<?php require_once "includes/footer.php";?>
        