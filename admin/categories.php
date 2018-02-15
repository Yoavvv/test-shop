<?php require_once "includes/admin_header.php" ?>
<?php require_once("includes/delete_modal.php"); ?>    

    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['firstname']; ?></small>
                        </h1>
                        <div class="col-xs-6">
                        
                        <!-- DB Add categories function -->
                        <?php insertCategories(); ?>
                        
                        <form action="" method="post">
                           <div class="form-group">
                              <label for="category_title">Add Category: </label>
                               <input type="text" class="form-control" name="category_title" required maxlength="15">
                           </div>
                           <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                           </div>  
                        </form>
                        
                        <?php 
                            
                            // DB Update categories
                            if(isset($_GET['edit'])) {
                                $category_id = $_GET['edit'];
                                
                                require_once "includes/update_categories.php";
                            }
                            
                        ?>
                        </div>
                        
                        <div class="col-xs-6" style="overflow-x:auto;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <!-- Get categories from DB function-->
                                <?php findAllCategories(); ?> 
                                    
                                <!-- Delete categories from DB function-->
                                <?php deleteCategories(); ?>
                                
                                </tbody>
                            </table>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
<?php require_once "includes/admin_footer.php" ?>


<script>

    $(document).ready(function() {
       
       // Confirm delete modal 
       $(".delete_link").on('click', function() {
           
            var id = $(this).attr("rel");
           
            var delete_url = "categories.php?delete="+ id + " ";
           
            $(".modal_delete_link").attr("href", delete_url);
          
            $("#myModal").modal('show');
           
       });
        
    });

</script>