<?php include "includes/config.php"; ?>
<?php include "includes/header.php"; ?>


    <!-- Navigation -->
    <?php include "includes/navbar.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php

                    if (isset($_GET['p_id'])) {
                        //echo "hmm";
                        $the_post_id = $_GET['p_id'];
                        
                        $view_query="UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id=$the_post_id";
                        $send_query=$con->query($view_query);
                        
                    $sql = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                    $select_all_posts_query = $con->query($sql);
                    while ($row = $select_all_posts_query->fetch_assoc()) {
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
                <?php } 
            
            }else{
                header("location: index.php");
            }
            
            ?>


                <!-- Blog Comments -->
                <?php 
                    if (isset($_POST['create_comment'])) {
                        $the_post_id = $_GET['p_id'];
                        $comment_author=$_POST['comment_author'];
                        $comment_email=$_POST['comment_email'];
                        $comment_content=$_POST['comment_content'];

                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ) {
                            
                        //echo $_POST['comment_author'];

                        $sql = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $sql .= "VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Disapproved', now())";

                        $create_comment_query=$con->query($sql);
                        if (!$create_comment_query) {
                            die("Query Failed" . $con->error);
                        }
                        // $sql="UPDATE posts SET post_comment_count=post_comment_count + 1 ";
                        // $sql.="WHERE post_id = $the_post_id ";

                        //$update_post_comment_count_query=$con->query($sql);    
                        }else{
                            echo"<script>alert('Fields cannot be empty')</script>";
                        }
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'Approved' ";
                $query .= "ORDER BY comment_id DESC ";
                    $select_comment_query=$con->query($query);
                    if (!$select_comment_query) {
                        die("Query FAILED" . $con->error);
                        
                    }

                    while ($row=$select_comment_query->fetch_assoc()) {
                        $comment_date=$row['comment_date'];
                        $comment_content=$row['comment_content'];
                        $comment_author=$row['comment_author'];
                ?>
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="not available">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author;?>
                                    <small><?php echo $comment_date;?></small>
                                </h4>
                                <?php echo $comment_content;?>
                            </div>
                        </div>
                    <?php }?>   
            </div>

        

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>    
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php";?>

        