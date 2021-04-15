<?php include"config.php";?>
<?php session_start(); ?>
<?php
    if (isset($_POST['login'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $username=$con->real_escape_string($username);
        $password=$con->real_escape_string($password);
        
        

        $sql = "SELECT * from users WHERE username = '{$username}' ";
        $select_user_query=$con->query($sql);
        if (!$select_user_query) {
            die("Query FAILED ".$con->error);
        }

        while ($row=$select_user_query->fetch_array()) {
            $user_id=$row['user_id'];
            $db_username=$row['username'];
            $db_user_password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_role=$row['user_role'];
        }

        //$password=crypt($password, $db_user_password);
        
        if(password_verify($password, $db_user_password)){
            $_SESSION['username']=$db_username;
            $_SESSION['firstname']=$user_firstname;
            $_SESSION['lastname']=$user_lastname;
            $_SESSION['user_role']=$user_role;
            header("Location: ../admin");
        }
        else{
            header("Location: ../index.php");
        }
    }
?>