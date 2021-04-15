<form method = "post" action="">
    <div class="form-group">
        <label for = "edit_category">Update Category: </label>
            <?php
                if (isset($_GET['update'])) {
                        $cat_update_id = $_GET['update'];
                                              
                            $sql = "SELECT * FROM categories WHERE cat_id = {$cat_update_id}";
                            $select_categories_update_query = $con->query($sql);
                                                
                                while ($row = $select_categories_update_query->fetch_assoc()) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
            ?>
                                        <input type="text" name="cat_update_title" class="form-control" value="<?php echo $cat_title; ?>">   
                                        
            <?php               }
                } 
            ?>

            <?php 
                //update query

                if (isset($_POST['update'])) {
                    $cat_update_title=$_POST['cat_update_title'];

                    $sql = "UPDATE categories SET cat_title = '{$cat_update_title}' WHERE cat_id = {$cat_id}";
                    $update_query=$con->query($sql);

                    if (!$update_query) {
                        die("Query FAILED" . $con->error);
                    }                                            
                }
            ?>                                    
    </div>
        <div class="form-group">
            <input type="submit" name="update" value="Update Category" class="btn btn-primary">
        </div>
</form>