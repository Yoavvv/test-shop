<?php require_once "includes/admin_header.php" ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once "includes/admin_navigation.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    
                       <h1 class="page-header">
                            All Comments
                            <small>Totally</small>
                        </h1>
                        
                      <?php 
                        
                        if(isset($_GET['source'])) {
                            
                            $source = $_GET['source'];
                            
                        } else {
                            $source = '';
                        }
                        // Switch between comment pages depends on specific source request
                        switch($source) {
                                 
                            default:
                                
                                require_once "includes/view_all_comments.php";
                                
                                break;      
                        }
                         
                    ?>
                        
                    </div>
                </div>
            </div>
        </div>
       
<?php require_once "includes/admin_footer.php" ?>