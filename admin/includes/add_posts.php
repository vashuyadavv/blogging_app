<?php  
	if (isset($_POST['create_post'])) {
		//$post_id = $_POST['post_id'];
        $post_user = $_POST['post_user'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
        //$post_comment_count = 4;
        $post_date = date('d-m-y');



		move_uploaded_file($post_image_temp, "../images/$post_image");
		$sql = "INSERT INTO posts(post_user, post_title, post_category_id, post_status, post_image, post_tags, 
				post_date, post_content) VALUES('$post_user', '$post_title', $post_category_id, '$post_status', '$post_image', 
				'$post_tags', now(), '$post_content')";
		
		$create_post_query=$con->query($sql);
		confirmQuery($create_post_query);

		$for_view_post_id=$con->insert_id;
		echo"<p class='bg-success'>Post Created: " . "" . "<a href='../post.php?p_id={$for_view_post_id}'>View Posts</a></p>";
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" name="post_title" class="form-control">
	</div>
	<div class="form-group">
		<label for="post_category">Category</label>
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
		<input type="text" name="post_author" class="form-control">
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
		
		<select name="post_status" id="">
			<option value="draft">Post Status</option>
			<option value="published">Publish</option>
			<option value="draft">Draft</option>
		</select>

		<!-- <input type="text" name="post_status" class="form-control"> -->
	</div>
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="post_image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea name="post_content" class="form-control" id="body" cols="30" rows="10"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" name="create_post" class="btn btn-primary" value="Publish">
	</div>
</form>