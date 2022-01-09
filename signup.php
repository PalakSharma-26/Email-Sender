<?php
include 'partials/_db.php';
$showalert=false;
$showerror=false;
$showwarn=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $token = bin2hex(random_bytes(10));
    if($_POST['username']=="" || $_POST['email']=="" || $_POST['password']=="" || $_POST['cpassword']==""){
        $showwarn="Please fill all the fields";
    }
    else{
        $existSql= "SELECT * FROM `user` WHERE user_email='$email'";
        $result=mysqli_query($conn,$existSql);
        $num = mysqli_num_rows($result);
        if($num>0){
            $showerror = "Email is already in use";
        }
        else{
            if($pass==$cpass){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql="INSERT INTO `user` ( `username`, `user_email`, `user_password`, `timestamp`, `subscription`, `status`, `token`) VALUES ('$username', '$email', '$hash', current_timestamp(), 'yes', 'in-active', '$token')";
                $result=mysqli_query($conn,$sql);
                if($result){
                    $to_email = $email;
                    $subject = "Account verification";
                    $body="Hi, .$username";
                    $body = "Click here to activate your account";
                    if(mail($to_email, $subject, $body)){
                        $showalert="Check your mail to verify your account";
                    } else {
                        echo"failed";
                    }
                    // $showalert="Login now";
                    // header("Location: index.php?signupsuccess=true");
                    // exit();
                }
            }
            else{
                $showerror = "Password donot match";
            }
        }
    }
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleForm.css">
    <title>Document</title>
</head>

<body>
    <?php include 'partials/_nav.php';
    if($showalert)
    {
        echo "success " . $showalert;
    }
    if($showerror)
    {
        echo "ERROR" . $showerror;
    }
    if($showwarn)
    {
        echo "ERROR " . $showwarn;
    }
    ?>
    <div class="signupForm">
        <form action="signup.php" class="form" method="post">
            <h1 class="title">Sign up</h1>
         

            <div class="inputContainer">
                <input type="text" name="username"  class="input" >
                <label for="" class="label">Username</label>
            </div>
            <div class="inputContainer">
                <input type="email" class="input" name="email" >
                <label for="" class="label">Email</label>
            </div>

            <div class="inputContainer">
                <input type="password" name="password" class="input" >
                <label for="" class="label">Password</label>
            </div>

            <div class="inputContainer">
                <input type="password" name="cpassword" class="input" >
                <label for="" class="label">Confirm Password</label>
            </div>

            <input type="submit" class="submitBtn" value="Sign up">
        </form>
    </div>
</body>

</html>