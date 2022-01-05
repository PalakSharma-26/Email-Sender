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
                $login=true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['useremail'] = $email;
                // echo "logged in".$email;
            header("location: index.php");
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
    <title>Document</title>
</head>

<body>
    <?php include 'partials/_nav.php';
     if($showerror){
         echo "ERROR" . $showerror;
         }
    ?>
    <h2>Login to your account</h2>
    <form action="login.php" method="post">

        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email">
        </div><br>
        <div><label for="password">PASSWORD</label><br>
            <input type="password" name="password" id="password">
        </div><br>

        <input type="submit" name="submit" id="submit" value="Login">
    </form>
</body>

</html>