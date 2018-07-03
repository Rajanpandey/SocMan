<?php
$username=$_POST['adminName'];
$password=$_POST['adminPassword'];

if($username=='admin' && $password==admin){
    header('Location: http://localhost/socman/committee/committee-home.php');
}
else{
    header('Location: http://localhost/socman');
}
?>