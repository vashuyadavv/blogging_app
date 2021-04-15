<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include"includes/admin_navbar.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql="SELECT * FROM posts";
                                            $select_all_posts=$con->query($sql);
                                            $posts_count=$select_all_posts->num_rows;
                                        ?>
                                        <div class='huge'><?php echo $posts_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
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
                                    <?php
                                        $sql="SELECT * FROM comments";
                                        $select_all_comments=$con->query($sql);
                                        $comments_count=$select_all_comments->num_rows;
                                    ?>
                                    <div class='huge'><?php echo $comments_count; ?></div>
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
                                    <?php
                                        $sql="SELECT * FROM users";
                                        $select_all_users=$con->query($sql);
                                        $users_count=$select_all_users->num_rows;
                                    ?>
                                    <div class='huge'><?php echo $users_count; ?></div>
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
                                    <?php
                                        $sql="SELECT * FROM categories";
                                        $select_all_categories=$con->query($sql);
                                        $categories_count=$select_all_categories->num_rows;
                                    ?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
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
                <!-- /.row -->

                <?php
                    
                    $sql="SELECT * FROM posts WHERE post_status='published' ";
                    $select_all_published_posts=$con->query($sql);
                    $published_post_count=$select_all_published_posts->num_rows;
                    
                    $sql="SELECT * FROM posts WHERE post_status='draft' ";
                    $select_all_draft_posts=$con->query($sql);
                    $draft_post_count=$select_all_draft_posts->num_rows;
                    
                    $sql="SELECT * FROM comments WHERE comment_status='Disapproved' ";
                    $select_all_disapproved_comments=$con->query($sql);
                    $disapproved_comments_count=$select_all_disapproved_comments->num_rows;

                    $sql="SELECT * FROM users WHERE user_role='subscriber' ";
                    $select_all_subscribers=$con->query($sql);
                    $subscribers_count=$select_all_subscribers->num_rows;

                ?>

                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                                $element_text=['Active Posts', 'Active Posts', 'Draft Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Pending Comments'];
                                $element_count=[$posts_count, $published_post_count, $draft_post_count, $categories_count, $users_count, $subscribers_count, $comments_count, $disapproved_comments_count];
                                for ($i=0; $i < 8; $i++) { 
                                    echo"['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            
                            ?>

                            //['Posts', 1000],
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
                        $(window).resize(function(){
                        drawChart();
                        });
                    </script>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include"includes/admin_footer.php"; ?>
    