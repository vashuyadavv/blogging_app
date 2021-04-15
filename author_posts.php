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
                        $post_author = $_GET['author'];
                    }
                    $sql = "SELECT * FROM posts WHERE post_user = '{$post_author}' ";
                    $select_all_posts_query = $con->query($sql);
                    while ($row = $select_all_posts_query->fetch_assoc()) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    Post by <?php echo $post_author;?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
                <?php } ?>


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
                        $sql="UPDATE posts SET post_comment_count=post_comment_count + 1 ";
                        $sql.="WHERE post_id = $the_post_id ";

                        $update_post_comment_count_query=$con->query($sql);    
                        }else{
                            echo"<script>alert('Fields cannot be empty')</script>";
                        }
                    }
                ?>   
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>    
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php";?>

        