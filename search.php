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
            // If submit search button pressed
            if(isset($_POST['submit'])) {

                $search = escape($_POST['search']);
                
                // Query for getting all course tags similar to search keyword 
                $query = "SELECT * FROM courses WHERE course_tags LIKE '%$search%' ";
                $searchQuery = mysqli_query($connection, $query);

                if(!$searchQuery) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($searchQuery);
                
                // If found any -> get course details to display
                if($count == 0) {
                    echo "<h1> NO RESULT </h1>";
                } else {

                while($row = mysqli_fetch_assoc($searchQuery)) {
                    $course_name = $row['course_name'];
                    $course_description = $row['course_description'];
                    $image_fileName = $row['image_fileName'];
                    $course_tags = $row['course_tags'];
                    $course_id = $row['course_id'];

                    ?>

                    <h2>
                        <a href="course.php?c_id=<?php echo $course_id; ?>"><?php echo $course_name ?></a>
                    </h2>
                        
                    <h3 class="page-header">Course Tags --> <small><?php echo $course_tags; ?></small></h3>

                    <img class="img-responsive" src="images/<?php echo $image_fileName; ?>" alt="">
                    <p><?php echo $course_description ?></p>
                    <a class="btn btn-primary" href="course.php?c_id=<?php echo $course_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>


<?php           } 


                }
            }
?>

        </div>

        <!-- Course Sidebar -->
        <?php require_once "includes/sidebar.php";?>

    </div>
    <hr>
        
<?php require_once "includes/footer.php";?>

