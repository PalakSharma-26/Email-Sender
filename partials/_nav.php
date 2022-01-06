<?php
session_start();
echo '
<div class="container" id="navbar">
    <a href="index.php">HOME</a>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<a href="logout.php">LOGOUT</a>';
    }
    else{
        echo '<a href="signup.php">SIGNUP</a>
        <a href="login.php">LOGIN</a>';
    }
    echo'
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
  <script>
function myFunction() {
  var x = document.getElementById("navbar");
  if (x.className === "container") {
    x.className += " responsive";
  } else {
    x.className = "container";
  }
}
</script>
</div>';
?>