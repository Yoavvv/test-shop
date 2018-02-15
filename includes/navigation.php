<!-- Main navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Course Manager</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

               <?php 
                // Set Active Mode for nav links (+ option to echo categories as <li>'s)
                $query = "SELECT * FROM categories";
                $allCategoriesQuery = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($allCategoriesQuery)) {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];

                    $category_class = '';

                    $registration_class = '';

                    $pageName = basename($_SERVER['PHP_SELF']);

                    $registration = 'registration.php';

                    if(isset($_GET['category']) && $_GET['category'] == $category_id) {

                       $category_class = 'active'; 

                    } else if($pageName == $registration) {

                        $registration_class = 'active';

                    }
                }

                ?>

                <li>
                    <a href="admin">Admin</a>
                </li>

                <li class='<?php echo $registration_class; ?>'>
                    <a href="registration.php">Register</a>
                </li>

                <?php 
                    // Only if user's role is manager & course id has requested - show edit course link
                    if($_SESSION['user_role'] == 'manager') { 

                        if(isset($_GET['c_id'])) {

                            $the_course_id = $_GET['c_id'];

                            echo "<li><a href='admin/courses.php?source=edit_course&c_id={$the_course_id}'>Edit Course</a></li>";

                        }
                        // Only if user's role is manager & user id has requested - show edit user link
                        if(isset($_GET['u_id'])) {

                            $the_user_id = $_GET['u_id'];

                            echo "<li><a href='admin/users.php?source=edit_user&edit_user={$the_user_id}'>Edit User</a></li>";

                        }
                    }

                ?>

            </ul>
        </div>
    </div>
</nav>