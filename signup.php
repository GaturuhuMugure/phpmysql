<?php
require 'header.php';
require 'config.php';
?>
<!--reg form-->
<div class="container">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div id="form-section">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="">username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm password</label>
                            <input type="password" name="password2" class="form-control" required>
                        </div>
                            <span>
                                Supplier <input type="radio" name="user-type" value="supplier">
                            </span>
                            <span>
                                Customer <input type="radio" name="user-type" value="Customer">
                            </span>
                        </div>
                        <button class="btn btn-warning btn-block">Create Account</button>

                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
    </div>
</div>
<?php
//define empty variables to store data from the form
$username=$email=$password=$password2='';
//define empty variables to store errors
$username_err=$email_err=$password_err='';
if($_SERVER['REQUEST_METHOD']=='POST') {
    //grab data using the $_POST superglobal
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];


    if (empty($username)) {
        //check if the username is empty
        $username_err = "Please fill in username";
    } else {
        $username = cleandata($username);
    }
    if (empty($email)) {
        //check if  email is empty
        $email_err = "Please fill in your email";
    } else {
        $email = cleandata($email);
    }
    if (empty($password)) {
        //check if password is empty
        $password_err = "Fill in your password";
    }
    if (empty($password2)) {
        //check if confirm password is empty
        $password_err = "Fill in confirm password";
    }
    //check if passwords are matching
    if ($password != $password2) {
        $password_err = "passwords do not match";
    } else {
        //check the number of characters
        if (strlen($password) < 8) {
            $password_err = "Password should be more than 8 characters";
        } else {
            $password = md5($password);
        }
    }

    //add data into the database
    $sql="INSERT INTO `users`(`id`, `username`, `email`, `password`) VALUES (NULL,'$username','$email','$password')";
    if(mysqli_query($conn,$sql)){
        header('location:index.php');
    }else{
        echo "Data has not been added".mysqli_error($conn);
        echo "$$sql<br>";
    }
    }
//cleandata for whitespaces, characters etc
function cleandata($data){
    //remove whitespaces
    $data=trim($data);
    //remove slashes
    $data=stripcslashes($data);
    //remove specialcharacters
    $data=htmlspecialchars($data);
    //return clean data
    return $data;
}
require 'footer.php';
?>
