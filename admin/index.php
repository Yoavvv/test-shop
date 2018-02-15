<?php require_once "includes/admin_header.php" ?>

    <div id="wrapper">
        
    <!-- Navigation -->
    <?php require_once "includes/admin_navigation.php" ?>
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to Admin
                        <small><?php echo $_SESSION['firstname']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- Manager list count -->
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <small>
                          <h4><a href="users.php?source=add_user" class="btn btn-primary">+</a></h4>
                           <?php echo $users_count = managersCount('users'); ?> Total Managers     
                        </small>
                    </h1>
                </div>
            </div>
            
            <div>
                   
               <?php 
                    
                $query = "SELECT * FROM users WHERE user_role  = 'manager' ";
                $select_managers = mysqli_query($connection, $query);

                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <ol>

                           <?php 

                            while($row = mysqli_fetch_assoc($select_managers)) {

                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_id = $row['user_id'];
                                $user_image = $row['user_image'];
                                $user_email = $row['user_email'];
                                $user_phone = $row['user_phone'];

                                echo "<li><a href='users.php?source=edit_user&edit_user=$user_id'>{$user_firstname} {$user_lastname} , {$user_email} , {$user_phone}</a></li>";
                            }

                            ?>

                        </ol>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- Widgets per table + count -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                               <div class='huge'><?php echo $courses_count = recordCount('courses'); ?></div>
                                    <div>Courses</div>
                                </div>
                            </div>
                        </div>
                        <a href="courses.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <div class='huge'><?php echo $comments_count = recordCount('comments'); ?></div>
                                  <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $users_count = recordCount('users'); ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $categories_count = recordCount('categories'); ?></div>
                                     <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <?php 
            // Get tables data to insert to charts
            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $unapprovedCommentsQuery = mysqli_query($connection, $query);
            $unapprovedCommentCount = mysqli_num_rows($unapprovedCommentsQuery);  

            $query = "SELECT * FROM users WHERE user_role = 'student' ";
            $selectAllStudents = mysqli_query($connection, $query);
            $studentCount = mysqli_num_rows($selectAllStudents); 

            ?>

            <div class="row">
            <!-- Google charts functionality -->
            <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Data', 'Count'],

                    <?php 
                        // Insert tables data to charts display
                        $elementText = ['Courses', 'Comments', 'Pending Comments', 'Users', 'Students', 'Categories'];
                        $elementCount = [$courses_count, $comments_count, $unapprovedCommentCount, $users_count, $studentCount, $categories_count];

                        for($i = 0; $i < 6; $i++) {

                            echo "['{$elementText[$i]}'" . "," . "{$elementCount[$i]}],";
                        }
                    ?>
                ]);

                var options = {
                  chart: {
                    title: '',
                    subtitle: '',
                  }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
              }

            </script>
            <!-- Charts div -->
            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

            </div>
        </div>
    </div>
    
<?php require_once "includes/admin_footer.php" ?>