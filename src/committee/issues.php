<?php
$conn=mysqli_connect("localhost", "root", "", "socman");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$url=$_GET["url"];

$sql="SELECT * FROM issues WHERE url='$url'";
$result=mysqli_query($conn, $sql);
$array = array();
while($row=$result->fetch_array()){
         $array[]=$row;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Issues</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/my-css/committee/issues.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>  
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="../members/members-home.php">
    <img src="../assets/pictures/logo-small.png" alt="logo" style="width:100px">
  </a>

</nav><br/>    

<div class="container">
 <div class="row">
     
     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <?php 
            if($array[0]['status']<0){
         ?>
            <button type="button" class="btn btn-danger btn-block" disabled>Issue is not yet addressed!</button><hr/>
         <?php 
            }
            else if($array[0]['status']==0){
         ?>
                <button type="button" class="btn btn-primary btn-block" disabled>Issue is being addressed!</button><hr/>
         <?php 
            }
            else{
         ?>
                <button type="button" class="btn btn-success btn-block" disabled>Issue has been addressed!</button><hr/>
         <?php 
            }         
         ?>
     </div>

     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <h1><?php echo $array[0]['title']; ?></h1><hr/>
     </div>
     
     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <pre><?php echo $array[0]['body']; ?></pre><br/>
     </div><hr/>
              
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="row">          
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
             <form method="post" action="addressing.php">
                <input type="submit" class="btn btn-primary btn-block" name="addressing" value="Addressing!"/>
                <input type="hidden" name="url" value="<?php echo $array[0]['url'] ?>"/>
            </form>
          </div>
          
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
             <form method="post" action="addressed.php">
                <input type="submit" class="btn btn-success btn-block" name="addressed" value="Addressed!"/>
                <input type="hidden" name="url" value="<?php echo $array[0]['url'] ?>"/>
            </form>
          </div>
        </div>
     </div>
               
  </div>
</div><hr/>

<footer class="footer">
  <p>© Copyright: RPTech &nbsp;&nbsp;&nbsp;</p>
</footer>

</body>
</html>
