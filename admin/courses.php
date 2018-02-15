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
                        
                      <?php 
                        
                        if(isset($_GET['source'])) {
                            
                            $source = $_GET['source'];
                            
                        } else {
                            $source = '';
                        }
                        
                        // Switch between course pages depends on specific source request
                        switch($source) {
                                
                            case 'add_course';
                                require_once "includes/add_course.php";
                                break;
                                
                            case 'edit_course';
                                require_once "includes/edit_course.php";
                                break;
                                
                            default:
                                
                                require_once "includes/view_all_courses.php";
                                
                                break;       
                        }
                        
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    
<?php require_once "includes/admin_footer.php" ?>