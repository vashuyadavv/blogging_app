<?php

include"delete_modal.php";
if (isset($_GET['delete'])) {
    $the_post_id = escape($_GET['delete']);
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

    $delete_query = $con->query($query);
}

if (isset($_GET['reset'])) {
    $the_reset_post_id = escape($_GET['reset']);
    $query = "UPDATE posts SET post_views_count=0 WHERE post_id=" . $con->real_escape_string($the_reset_post_id) . " ";

    $reset_query = $con->query($query);
}
?>

<?php
    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $postValueId) {
            $bulk_options=$_POST['bulk_options'];
            switch ($bulk_options) {
                case 'published':
                    $sql="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$postValueId}";
                    $update_to_publish=$con->query($sql);
                    break;
                    
                case 'draft':
                    $sql="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$postValueId}";
                    $update_to_draft=$con->query($sql);
                    break;
                

                case 'delete':
                    $sql="DELETE FROM posts WHERE post_id={$postValueId}";
                    $delete_post=$con->query($sql);
                    break;

                case 'clone':
                    $sql="SELECT * FROM posts WHERE post_id={$postValueId} ";
                    $select_posts_query=$con->query($sql);
                    while ($row=$select_posts_query->fetch_array()) {
                        //$post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];    
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        $post_date = $row['post_date'];    
                    }
                    $sql="INSERT INTO posts (post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content, post_date) ";
                    $sql.="VALUES('{$post_author}', '{$post_title}', {$post_category_id}, '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now()) ";
                    $copy_query=$con->query($sql);
                    if (!$copy_query) {
                        die("Query FAILED " . $con->error);
                    }
                    break;
                
                default:
                    echo"Try Again";
                break;
            }
        }
    }

?>
<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-md-4">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Choose</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAll"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Images</th>
                <th>Tags</th>
                <th>Content</th>
                <th>Comments</th>
                <th>Date</th>
                <th colspan=3>Action</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts_query = $con->query($sql);

            while ($row = $select_posts_query->fetch_assoc()) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];    
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
                ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id;?>'/></td>
                <?php
                
                echo "<td>{$post_id}</td>";
                
                if (!empty($post_author)) {
                    echo "<td>{$post_author}</td>";    
                }elseif (!empty($post_user)){
                    echo "<td>{$post_user}</td>";
                }
                
                
                
                
                echo "<td>{$post_title}</td>";

                $sql = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories_query = $con->query($sql);
                                    
                    while ($row = $select_categories_query->fetch_assoc()) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<td>{$cat_title}</td>";
                    }
                echo "<td>{$post_status}</td>";
                echo "<td><img src='../images/{$post_image}' width='100px'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_content}</td>";
                
                $sql="SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                $send_comment_count_query=$con->query($sql);
                $row=$send_comment_count_query->fetch_array();
                $comment_id=$row['comment_id'];
                $comment_count=$send_comment_count_query->num_rows;
                echo "<td><a href='post_comment.php?id={$post_id}'>{$comment_count}</a></td>";
                
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a rel='$post_id' href='' class='delete_link'>Delete</a></td>";
                // echo "<td><a onClick=\" javascript: return confirm('Are you sure?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                echo "</tr>";
            }                           
            ?>
        </tbody>
    </table>
</form>

<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function() {
            //alert("works");
            var id = $(this).attr("rel");
            alert(id);
        });
    });
</script>