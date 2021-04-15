<?php

    if (isset($_GET['p_id'])) {
        $p_id=$_GET['p_id'];
    }
    
    $sql = "SELECT * FROM posts WHERE post_id = $p_id";
    $select_posts_query_by_id = $con->query($sql);
    
    while ($row = $select_posts_query_by_id->fetch_assoc()) {
        $post_id = $row['post_id'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
  	}

	  
	if (isset($_POST['update_post'])) {
		//echo"howdy there?";

		$post_user = $_POST['post_user'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
        //$post_comment_count = 4;
        //$post_date = date('d-m-y');

		move_uploaded_file($post_image_temp, '../images/$post_image');
		if (empty($post_image)) {
			$sql = "SELECT * FROM posts WHERE post_id = $p_id ";
			$select_image = $con->query($sql);

			while($row = $select_image->fetch_assoc()){
				$post_image = $row['post_image'];
			}
		}
		$query = "UPDATE posts SET
            post_title = '{$post_title}',
            post_category_id = '{$post_category_id}',
            post_date = now(),
            post_user = '{$post_user}',
            post_status = '{$post_status}',
            post_tags = '{$post_tags}',
            post_content = '{$post_content}',
            post_image = '{$post_image}'
            WHERE post_id = {$p_id}";

		$update_post=$con->query($query);

		confirmQuery($update_post);
		echo"<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$p_id}'>View Post</a></p>";
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" value="<?php echo $post_title; ?>" name="post_title" class="form-control">
	</div>
	<div class="form-group">
		<label for="post_category">Categories</label>
		<select name="post_category_id" id="">
            <?php
                $sql = "SELECT * FROM categories";
                $select_categories_query = $con->query($sql);
                                    
                while ($row = $select_categories_query->fetch_assoc()) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo"<option value='$cat_id'>{$cat_title}</option>";
                }    
            ?>
        
        </select>
	</div>
	<!-- <div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" value="<?php echo $post_author; ?>" name="post_author" class="form-control">
	</div> -->

	<div class="form-group">
		<label for="users">Users</label>
		<select name="post_user" id="">
            <?php
                $sql = "SELECT * FROM users";
                $select_users_query = $con->query($sql);
                                    
                while ($row = $select_users_query->fetch_assoc()) {
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    echo"<option value='$username'>{$username}</option>";
                }    
            ?>
        </select>
	</div>

	<div class="form-group">
		<label for="status">Post Status</label>
		<select name="post_status" id="">
			<option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
			<?php
				if ($post_status == 'published') {
					echo"<option value='draft'>Draft</option>";
				}else {
					echo"<option value='published'>Publish</option>";
				}
			?>
		</select>
	</div>
	<!-- <div class="form-group">
		<label for="status">Post Status</label>
		<input type="text" name="post_status" value="<?php //echo $post_status; ?>" class="form-control">
	</div> -->
	<div class="form-group">
		<label for="post_image">Post Image</label><br>
		<img width="100" src="../images/<?php echo $post_image?>" alt="">
		<input type = "file" name = "image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" value="<?php echo $post_tags; ?>" class="form-control">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea  class="form-control "name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
	</div>
	<div class="form-group">
		<input type="submit" name="update_post" class="btn btn-primary" value="Update">
	</div>
</form> 