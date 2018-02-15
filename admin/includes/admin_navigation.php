<?php require_once "../admin/functions.php" ?>
   
<!-- Admin navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">Admin Area</a>
</div>

<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
    <li><a href="../index.php">HOME SITE</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img width="50" src="../images/<?php echo $_SESSION['user_image'];?>" alt="">
            <?php 

                if(isset($_SESSION['firstname'])) {

                    echo $_SESSION['firstname'];
                }    
            ?>

            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul>

<!-- Side Menu Items -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#coursesDropDown"><i class="fa fa-fw fa-arrows-v"></i> Courses <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="coursesDropDown" class="collapse">
                <li>
                    <a href="./courses.php">View all courses</a>
                </li>
                <li>
                    <a href="courses.php?source=add_course">Add courses</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
        </li>

        <li class="">
            <a href="./comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="users.php">View All Users</a>
                </li>
                <li>
                    <a href="users.php?source=add_user">Add User</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
        </li>
    </ul>
</div>
</nav>