 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>              
 <script src="searching.js"></script>              

<?php require_once "./admin/functions.php" ?>
<div class="col-md-4">

    <!-- Course search area -->
    <div class="well">
        <h4>Course Search By Tags</h4>
        <form action="search.php" method="post" class="well">
        <div class="input-group">
            <input name="search" type="text" class="form-control" required maxlength="30">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form>
    </div>

    <!-- Login (extra -> if needed without registration) -->
    <div class="well">

       <?php if(isset($_SESSION['user_role'])): ?>

       <h4>Logged In As <?php echo $_SESSION['firstname'] ?></h4>
       <img width="150" src="./images/<?php echo $_SESSION['user_image'];?>" alt=""><br />
       <h4>Role : <?php echo $_SESSION['user_role'] ?></h4>


       <a href="includes/logout.php" class="btn btn-primary">Logout</a>

       <?php else: ?>

       <h4>Login</h4>
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="email" type="email" class="form-control" placeholder="Enter Email:">
        </div>

        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Enter Password:">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Submit</button>
            </span>
        </div>
        <br/><br/>
        <a href="registration.php">Not a member? Register now!</a>
        <br/><br/>
        </form>

       <?php endif; ?>

    </div>

    <!-- Courses Area -->
    <div class="well">

    <?php 

        $query = "SELECT * FROM courses";
        $select_courses_sidebar = mysqli_query($connection, $query);

    ?>
        <!-- Show courses count & display the courses -->
        <h3>Total Courses: <?php echo $courses_count = recordCount('courses'); ?></h3>
        <h4>Courses : <a href="admin/courses.php?source=add_course" class="btn btn-primary">Add Course +</a></h4>
        <div class="row">
            <div class="col-lg-12">
                <ol>

                   <?php 

                        while($row = mysqli_fetch_assoc($select_courses_sidebar)) {

                            $course_name = $row['course_name'];
                            $course_id = $row['course_id'];

                            echo "<li><a href='course.php?c_id=$course_id'>{$course_name}</a></li>";
                        }

                    ?>

                </ol>
            </div>
        </div><br/>
        <hr><hr><hr>
    <div>

    <?php 
        // Query to select all students
        $query = "SELECT * FROM users WHERE user_role  = 'student' ";
        $select_users_sidebar = mysqli_query($connection, $query);

    ?>   
        <!-- Show students count & display the students -->
        <h3>Total Students: <?php echo $users_count = studentsCount('users'); ?></h3>

        <h4>Students : <a href="admin/users.php?source=add_user" class="btn btn-primary">Add User +</a></h4>
        <div class="row">
            <div class="col-lg-12">
                <ol>

                   <?php 

                        while($row = mysqli_fetch_assoc($select_users_sidebar)) {

                            $user_firstname = $row['user_firstname'];
                            $user_id = $row['user_id'];

                            echo "<li><a href='user.php?u_id=$user_id'>{$user_firstname}</a></li>";
                        }
                    ?>

                </ol>
            </div>
        </div>
    </div>
    </div>


    <div class="well">

    <?php 
    // Query to get all categories & display them
    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);

    ?>

    <h4>Course Categories :</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul>

               <?php 

                    while($row = mysqli_fetch_assoc($select_categories_sidebar)) {

                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];

                        echo "<li><a href='category.php?category=$category_id'>{$category_title}</a></li>";
                    }

                ?>

            </ul>
        </div>

    </div>
    </div>
    
    <!-- Section for the angular random array shuffle -->
    <div class="well">
        <div ng-app="myApp" ng-controller="myCtrl"> 
        <h4>Today's Discounted Course Number :</h4>
        <h3>{{courseNumber}}</h3>
        </div>
        <p>* 95% off !!!</p>
    </div>
</div>


<!-- Script for angular random course array shuffle -->
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
  $http.get("includes/randomCourse.php")
  .then(function(response) {
      $scope.courseNumber = response.data;
  });
});
</script>  

