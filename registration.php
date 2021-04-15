<?php error_reporting(E_ALL);?>
<?php  include "includes/config.php"; ?>
<?php  include "includes/header.php"; ?>
<?php 
    if (isset($_POST['submit'])) {
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        if (!empty($username) && !empty($email) && !empty($password)) {
            $username=$con->real_escape_string($username);
            $email=$con->real_escape_string($email);
            $password=$con->real_escape_string($password);
            $password=password_hash($password, PASSWORD_BCRYPT, array('cost'=>10));


            // $sql="SELECT randSalt FROM users";
            // $select_randSalt_query=$con->query($sql);
    
            // if (!$select_randSalt_query) {
            //     die("Query FAILED" . $con->error);
            // }
    
            // $row=$select_randSalt_query->fetch_array(); 
            //     $salt=$row['randSalt'];
            //     $password=crypt($password, $salt);
    
            $sql="INSERT INTO users (username, user_email, user_password, user_role)" ;
            $sql.="VALUES('{$username}', '{$email}', '{$password}', 'subscriber' )" ;
            $register_user_query=$con->query($sql);
            if (!$register_user_query) {
                die("Query FAILED " . $con->error);
            }            
            $message="Your registration has been submitted";            
        }else{
            $message="Fields cannot be empty";
        }
    }else{
        $message="";
    }

?>
<!-- Navigation -->  
<?php  include "includes/navbar.php"; ?>
    
 
<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h5 class="text-center"><?php echo $message;?></h5>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-default btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
