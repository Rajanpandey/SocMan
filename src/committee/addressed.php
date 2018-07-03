<?php
$conn=mysqli_connect("localhost", "root", "", "socman");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$status=1;
$url=$_POST['url'];
$sql="UPDATE issues SET status='$status' WHERE url='$url'";

if(mysqli_query($conn, $sql)){
    header('Location: http://localhost/socman/committee/issues.php?url='.$url);
}

$conn->close();
?>