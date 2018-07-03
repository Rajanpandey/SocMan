<?php
$conn=mysqli_connect("localhost", "root", "", "socman");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$url=$_POST['url'];
$sql="DELETE FROM issues WHERE url='$url'";

if(mysqli_query($conn, $sql)){
    echo "Your issue has been deleted!";
}

$conn->close();
?>