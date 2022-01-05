
<?php
session_start();
echo '<nav>
<ul>
    <li><a href="index.php">HOME</a></li>';

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<li><a href="logout.php">LOGOUT</a></li>';
    }
    else{
        echo '<li><a href="signup.php">SIGN-UP</a></li>
            <li><a href="login.php">LOGIN</a></li>';
    }
    echo'
    </ul>
    <hr>
    </nav>';
    ?>
