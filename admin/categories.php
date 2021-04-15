<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include"includes/admin_navbar.php"; ?>

            <div class="container-fluid">

        <div id="page-wrapper">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Author name</small>
                        </h1>
                        <div class="col-md-6">    
                            <?php 
                                insert_categories();
                            ?>
                            <form method = "post" action="">
                                <div class="form-group">
                                    <label for = "add_category">Add Category: </label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                    <div class="form-group">
                                    <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                                </div>
                            </form>

                            <?php 
                                if (isset($_GET['update'])) {
                                    $cat_id = $_GET['update'];
                                    include"includes/update_categories.php"; 
                                }
                            ?>    
                        </div> <!-- Add category form -->
                        <div class="col-md-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Find all categories

                                        findAllCategories(); 
                                    ?>

                                    <?php 
                                        //DELETE QUERY
                                        delete_categories();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include"includes/admin_footer.php"; ?>
    