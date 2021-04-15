<?php 

	if (isset($_GET['edit_user'])) {
		$the_user_id=$_GET['edit_user'];
		$sql = "SELECT * FROM users WHERE user_id = $the_user_id";
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
		}
	}
	if (isset($_POST['create_user'])) {
        //$user_id=$_POST['user_id'];
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $user_role=$_POST['user_role'];
        // $post_image = $_FILES['post_image']['name'];
        // $post_image_temp = $_FILES['post_image']['tmp_name'];
		$username=$_POST['username'];
		$user_email=$_POST['user_email'];
		$user_password=$_POST['user_password'];
        //$post_date = date('d-m-y');

		//move_uploaded_file($post_image_temp, "../images/$post_image");
		// $sql="SELECT randSalt FROM users";
        // 	$select_randSalt_query=$con->query($sql);
    
        //     if (!$select_randSalt_query) {
        //         die("Query FAILED" . $con->error);
        //     }
    
		// $row=$select_randSalt_query->fetch_array(); 
		// 	$salt=$row['randSalt'];
		// 	$password=crypt($user_password, $salt);
		if (!empty($user_password)) {
			$query_password="SELECT user_password FROM users WHERE user_id = $the_user_id";
			$get_user_password=$con->query($query_password);
			//$confirmQuery($get_user_password);
			$row=$get_user_password->fetch_array();
			$db_user_password=$row['user_password'];
			
			if ($db_user_password != $user_password) {
				$user_password = password_hash('$user_password', PASSWORD_BCRYPT, array('cost'=>12));
			}
		
			$query = "UPDATE users SET ";
			$query.= "user_firstname = '{$user_firstname}', ";
			$query.= "user_lastname = '{$user_lastname}', ";
			$query.= "user_role = '{$user_role}', ";
			$query.= "username = '{$username}', ";
			$query.= "user_email = '{$user_email}', ";
			$query.= "user_password = '{$user_password}' ";
			$query.= "WHERE user_id = {$the_user_id} ";
	
			$update_user=$con->query($query);
	
			confirmQuery($update_user);
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname; ?>">
	</div>
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname; ?>">
	</div>
	<div class="form-group">
		<label for="role">Role</label>
		<select name="user_role" id="">
			<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

			<?php
				if ($user_role == 'Admin') {
					echo"<option value='subscriber'>Subscriber</option>";
				}else{
					echo"<option value='admin'>Admin</option>";
				}
			?>
        </select>
	</div>
	<!-- <div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="post_image">
	</div> -->
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="user_email" class="form-control" value="<?php echo $user_email;?>">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" name="user_password" class="form-control" autocomplete="off" value="">
	</div>
	<div class="form-group">
		<input type="submit" name="create_user" class="btn btn-primary" value="Edit User">
	</div>
</form>