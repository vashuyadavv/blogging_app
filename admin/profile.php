<?php include "includes/admin_header.php"; ?>

<?php
    if (isset($_SESSION['username'])) {
        $username=$_SESSION['username'];
        $sql="SELECT * FROM users WHERE username='{$username}' ";
        $select_user_profile=$con->query($sql);

        while ($row=$select_user_profile->fetch_array()) {
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
?>

<?php
    if (isset($_POST['update_profile'])) {
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $user_role=$_POST['user_role'];
        // $post_image = $_FILES['post_image']['name'];
        // $post_image_temp = $_FILES['post_image']['tmp_name'];
		$username=$_POST['username'];
		$user_email=$_POST['user_email'];
		$user_password=$_POST['user_password'];

        $query = "UPDATE users SET ";
		$query.= "user_firstname = '{$user_firstname}', ";
		$query.= "user_lastname = '{$user_lastname}', ";
		
		$query.= "username = '{$username}', ";
		$query.= "user_email = '{$user_email}', ";
		$query.= "user_password = {$user_password} ";
		$query.= "WHERE user_id = {$user_id} ";

		$update_profile=$con->query($query);

		confirmQuery($update_profile);

    }

?>
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
                                <!-- <label for="role">Role</label>
                                <select name="user_role" id="">
                                    <option value="subscriber"><?php //echo $user_role; ?></option>

                                    //<?php
                                    //    if ($user_role == 'Admin') {
                                    //        echo"<option value='subscriber'>Subscriber</option>";
                                    //    }else{
                                    //        echo"<option value='admin'>Admin</option>";
                                    //    }
                                    //?>
                                </select> -->
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
                                <input type="submit" name="update_profile" class="btn btn-primary" value="Update Profile">
                            </div>
                        </form>  
                    </div>
                </div>
        </div>
        <!-- /#page-wrapper -->
        <?php include"includes/admin_footer.php"; ?>
    