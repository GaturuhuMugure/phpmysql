<?php
require 'header.php';
require 'config.php';
$email=$password='';
$email_err=$password_err='';
//steps
//1.grab user data from form
if (isset($_POST['btn_login'])){
    //2.clean data
    if (isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $email_err = "Fill this field";
    }
    if (isset($_POST['password'])){
        $password = $_POST['password'];
    }else{
        $password = "Fill this field";
    }
//////////////////////////////////////////////////////////////////

            //4.check if user exists

        //5.add user into db
        //5.1 hash password
        $password = md5($password);

        //5.2 add user

       //user password and email to check if user exists
    $sql="SELECT `id`,`email`, `password` FROM `users` WHERE email='$email' AND password='$password'";
    $results=mysqli_query($conn,$sql);
    if(mysqli_num_rows($results)>0){
        //grab individual data about the user from the db
        while($rows=mysqli_fetch_assoc($results)){
            $id=$rows['id'];
            $email=$rows['email'];
            session_start();
            $_SESSION['kipande']=$id;
            $_SESSION['loggedin']=true;
            //return user to index page
            header("location:index.php");
            exit();
        }

    }else{
        //wrong password or email
        header("location:login.php");
    }
}

?>
<!--Reg form-->
<div class="container">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div id="form-section">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-warning btn-block" name="btn_login">LOG IN</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
    </div>
</div>



<?php
require 'footer.php';


?>
