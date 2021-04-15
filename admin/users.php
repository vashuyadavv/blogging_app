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
                        <?php  
                           //
                           if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }

                            switch ($source) {
                                case 'add_users':
                                    include"includes/add_users.php";
                                    break;

                                case 'edit_users':
                                    include"includes/edit_users.php";
                                    break;
                                
                                default:
                                    include"includes/view_all_users.php";
                                    break;
                            }
                        ?>  
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <?php include"includes/admin_footer.php"; ?>
    