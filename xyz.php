<?php
$to="sharmapalak0018@gmail.com";
$subject="Testing";
$body="Hloo";

if(mail($to,$subject,$body)){
    echo "done";
} else {
    echo "failed";
}
?>