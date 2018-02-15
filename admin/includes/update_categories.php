<?php require_once "../admin/functions.php";?>
  

  <form action="" method="post">
   <div class="form-group">
      <label for="category_title">Edit Category: </label>

    <?php 
    
    if(isset($_GET['edit'])) {

        $category_id = $_GET['edit'];
        
        // Query for DB to get specific category id
        $query = "SELECT * FROM categories WHERE category_id = $category_id ";
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];

    ?>
               
        <input value="<?php if(isset($category_title)){echo $category_title;} ?>" type="text" class="form-control" name="category_title" required maxlength="15">

        <?php }} ?>

        <?php 

        // UPDATE CATEGORY QUERY
        if(isset($_POST['update_category'])) {
            $categoryToUpdate = escape($_POST['category_title']);
            $query = "UPDATE categories SET category_title = '{$categoryToUpdate}' WHERE category_id = {$category_id} ";
            $updateQuery = mysqli_query($connection, $query);

            if(!$updateQuery) {
                
                die("QUERY FAILED!!" . mysqli_error($connection));
                
            } else {
                
                redirect("categories.php");
            }
        }

        ?>
        
   </div>
   
   <div class="form-group">
       <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
   </div>
</form>