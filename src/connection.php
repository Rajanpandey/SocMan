<?php
include('login.php'); 
if(isset($_SESSION['login_user'])){
    header("location: members/members-home.php");    
}    
else{
    echo "<script type=\"text/javascript\">
    alert('Invalid User Details. Please Try Again.');
    window.location='index.html';
    </script>";
}
    
?> 