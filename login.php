<?php
$login=false;
$showerror=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'partials/_db.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql ="SELECT * FROM `user` WHERE `user_email` = '$email'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($pass, $row['user_password'])){
                if($row['status'] =='active'){
                    $login=true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['sno'] = $row['sno'];
                    $_SESSION['useremail'] = $email;
                    // echo "logged in".$email;
                header("location: index.php");
                }
                else{
                    $showerror='Please verify your email to activate 
                    your account.';
                }
               
            }
            else{
                $showerror="Invalid credentials";
            }
        }

}
else{
    $showerror="Invalid credentials";
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
     if($showerror){
         echo "ERROR " . $showerror;
         }
    ?>
    <div class="signupForm">
        <form action="login.php" class="form" method="post">
            <h1 class="title">Login</h1>

            <div class="inputContainer">
                <input type="email" class="input" name="email">
                <label for="" class="label">Email</label>
            </div>

            <div class="inputContainer">
                <input type="password" name="password" class="input">
                <label for="" class="label">Password</label>
            </div>

            <input type="submit" class="submitBtn" value="Sign up">
        </form>
    </div>
</body>

</html>