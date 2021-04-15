<?php error_reporting(E_ALL);?>
<?php  include "includes/config.php"; ?>
<?php  include "includes/header.php"; ?>
<?php 
    if (isset($_POST['submit'])) {
        $username=trim($_POST['name']);
        $subject=wordwrap($_POST['subject'], 70);
        $body=trim($_POST['body']);
        $header="From: " . $_POST['email'];
        $to="vashu.yadav65@gmail.com";
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail($to,$subject,$body);
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
                    <h1 class="text-center">Contact</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        
                        <div class="form-group">
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="sub" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="sub" class="form-control" placeholder="Subject">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only"></label>
                            <textarea class="form-control" name="body" id="body" rows="5" placeholder="Body"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-default btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
