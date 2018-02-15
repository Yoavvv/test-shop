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
        // Get request for category 
        if(isset($_GET['category'])) {

            $course_category_id = $_GET['category'];
        // Query to get specific course category
        $query = "SELECT * FROM courses WHERE course_category_id = $course_category_id ";
        $allCoursesQuery = mysqli_query($connection, $query);
        // Check if there is atleast 1 course on specific category & if so display the courses properties
        if(mysqli_num_rows($allCoursesQuery) < 1) {

            echo "<h3 class='text-center'>THIS CATEGORY DOES NOT INCLUDE COURSES TO DISPLAY</h3>";

        } else {

        while($row = mysqli_fetch_assoc($allCoursesQuery)) {
            $course_id = $row['course_id'];
            $course_name = $row['course_name'];
            $course_description = substr($row['course_description'],0,100);
            $image_fileName = $row['image_fileName'];
            $course_tags = $row['course_tags'];
            $course_category_id = $row['course_category_id'];
            $course_comment_count = $row['course_comment_count'];

        ?>

            <h2>
                <a href="course.php?c_id=<?php echo $course_id; ?>"><?php echo $course_name ?></a>
            </h2>

            <h3 class="page-header">Course Tags --> <small><?php echo $course_tags; ?></small></h3>

            <img class="img-responsive" src="images/<?php echo $image_fileName; ?>" alt="">
            <p><?php echo $course_description ?></p>
            <a class="btn btn-primary" href="course.php?c_id=<?php echo $course_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>

           <?php } } } else {

                redirect("index.php");
            }
            
            ?>
        </div>

        <!-- Course Sidebar -->
        <?php require_once "includes/sidebar.php";?>

    </div>
    <hr>
        
<?php require_once "includes/footer.php";?>
        