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
                            Comments
                            <small>Author name</small>
                        </h1>  

                                <?php 
                                if (isset($_GET['delete'])) {
                                    $the_post_id = $_GET['delete'];
                                    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

                                    $delete_query = $con->query($query);
                                   
                                }
                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>In Response To</th>
                                            <th>Date</th>
                                            <th>Approve</th>
                                            <th>Disapprove</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT * FROM comments WHERE comment_post_id =" . $con->real_escape_string($_GET['id']). " ";
                                        $select_comments_query = $con->query($sql);

                                        while ($row = $select_comments_query->fetch_assoc()) {
                                            $comment_id = $row['comment_id'];
                                            $comment_post_id = $row['comment_post_id'];
                                            $comment_author = $row['comment_author'];    
                                            $comment_content = $row['comment_content'];
                                            $comment_email = $row['comment_email'];
                                            $comment_status = $row['comment_status'];
                                            $comment_date = $row['comment_date'];

                                            echo "<tr>";
                                            echo "<td>{$comment_id}</td>";
                                            echo "<td>{$comment_author}</td>";
                                            echo "<td>{$comment_content}</td>";

                                            // $sql = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                                            // $select_categories_query = $con->query($sql);
                                                                
                                            //     while ($row = $select_categories_query->fetch_assoc()) {
                                            //             $cat_id = $row['cat_id'];
                                            //             $cat_title = $row['cat_title'];
                                            //             echo "<td>{$cat_title}</td>";
                                            //     }

                                            echo "<td>{$comment_email}</td>";
                                            echo "<td>{$comment_status}</td>";

                                            $sql = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                            $select_post_id_query=$con->query($sql);
                                            while ($row=$select_post_id_query->fetch_assoc()) {
                                                $post_id=$row['post_id'];
                                                $comment_title=$row['post_title'];
                                                echo "<td><a href='../post.php?p_id=$post_id'>{$comment_title}</a></td>";
                                            }
                                            echo "<td>{$comment_date}</td>";
                                            echo "<td><a href='post_comment.php?approve=$comment_id&id=". $_GET['id'] ."''>Approve</a></td>";
                                            echo "<td><a href='post_comment.php?disapprove=$comment_id&id=". $_GET['id'] ."''>Disapprove</a></td>";
                                            echo "<td><a href='post_comment.php?delete=$comment_id&id=". $_GET['id'] ."'>Delete</a></td>";
                                            echo "</tr>";
                                        }                           
                                        ?>
                                    </tbody>
                                </table>

                                <?php
                                    if (isset($_GET['approve'])) {
                                        $the_comment_id=$_GET['approve'];
                                        $approve_sql="UPDATE comments SET comment_status='Approved' WHERE comment_id={$the_comment_id}";
                                        $query=$con->query($approve_sql);
                                        header("Location: post_comment.php?id=".$_GET['id']." ");
                                    }

                                    if (isset($_GET['disapprove'])) {
                                        $the_comment_id=$_GET['disapprove'];
                                        $disapprove_sql="UPDATE comments SET comment_status='Disapproved' WHERE comment_id={$the_comment_id}";
                                        $query=$con->query($disapprove_sql);
                                        header("Location: post_comment.php?id=".$_GET['id']." ");
                                    }

                                    if (isset($_GET['delete'])) {
                                        $the_comment_id=$_GET['delete'];
                                        $sql="DELETE FROM comments WHERE comment_id={$the_comment_id}";
                                        $query=$con->query($sql);
                                        header("Location: post_comment.php?id=".$_GET['id']." ");
                                    }
                                ?>                      

                    </div>
                </div>
            </div>
        </div>
    
            
        <!-- /#page-wrapper -->
        <?php include"includes/admin_footer.php"; ?>
