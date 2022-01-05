<?php
    include 'partials/_db.php';
$showalert=false;
$showerror=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $existSql= "SELECT * FROM `user` WHERE user_email='$email'";
    $result=mysqli_query($conn,$existSql);
    $num = mysqli_num_rows($result);
    if($num>0){
        $showerror = "Email is already in use";
    }else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `user` ( `username`, `user_email`, `user_password`, `timestamp`, `subscription`, `status`, `token`) VALUES ('$username', '$email', '$hash', current_timestamp(), 'yes', 'in-active', 'adf')";
            // echo $sql;
            $result=mysqli_query($conn,$sql);
            // echo var_dump($result);
            if($result){
                $showalert="Login now";
                header("Location: /project/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showerror = "Password donot match";
        }
    }

}

    // echo $username;
    // echo "<br>";
    // echo $email;
    // echo "<br>";

    // echo $pass;
    // echo "<br>";

    // echo $cpass;
    // echo "<br>";
    // echo var_dump($exists);

 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php include 'partials/_nav.php';
    if($showalert)
    {
        echo "success" . $showalert;
    }
    if($showerror)
    {
        echo "ERROR" . $showerror;
    }
    ?>
    <h2>Sign up to create your account</h2>
    <form action="signup.php" method="post">
        <div>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username">
        </div><br>
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email">
        </div><br>
        <div><label for="password">PASSWORD</label><br>
            <input type="password" name="password" id="password">
        </div><br>
        <div>
            <label for="cpassword">Confirm Password</label><br>
            <input type="password" name="cpassword" id="cpassword">
        </div><br>
        <input type="submit" name="submit" id="submit" value="SignUp">
    </form>
</body>

</html>