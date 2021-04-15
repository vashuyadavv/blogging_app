
<?php 
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {
            if (isset($_GET['delete'])) {
            $the_user_id = $con->real_escape_string($_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_query = $con->query($query);
            header("Location: users.php");
            }    
        }
    }
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = "SELECT * FROM users";
        $select_users_query = $con->query($sql);

        while ($row = $select_users_query->fetch_assoc()) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];    
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";

            // $sql = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            // $select_categories_query = $con->query($sql);
                                
            //     while ($row = $select_categories_query->fetch_assoc()) {
            //             $cat_id = $row['cat_id'];
            //             $cat_title = $row['cat_title'];
            //             echo "<td>{$cat_title}</td>";
            //     }

            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td>{}</td>";
            // $sql = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_post_id_query=$con->query($sql);
            // while ($row=$select_post_id_query->fetch_assoc()) {
            //     $post_id=$row['post_id'];
            //     $comment_title=$row['post_title'];
            //     echo "<td><a href='../post.php?p_id=$post_id'>{$comment_title}</a></td>";
            // }
            
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_users&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }                           
        ?>
    </tbody>
</table

<?php
    if (isset($_GET['change_to_admin'])) {
        $the_admin_id=$_GET['change_to_admin'];
        $admin_sql="UPDATE users SET user_role='Admin' WHERE user_id={$the_admin_id}";
        $query=$con->query($admin_sql);
        header("Location: users.php");
    }

    if (isset($_GET['change_to_sub'])) {
        $the_user_id=$_GET['change_to_sub'];
        $user_sql="UPDATE users SET user_role='Subscriber' WHERE user_id={$the_user_id}";
        $query=$con->query($user_sql);
        header("Location: users.php");
    }

?>
