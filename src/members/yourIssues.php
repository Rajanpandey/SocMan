<?php
include('../session.php');

if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
$conn=mysqli_connect("localhost", "root", "", "socman");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

//Fetch Issues Posted By User
$numOfIssues=0;
$sql="SELECT * FROM issues WHERE username='$login_session'";
$result=mysqli_query($conn, $sql);
if($result==NULL){
    
}
else{
    $array = array();
    while($row=$result->fetch_array()){
         $array[]=$row;
         $numOfIssues++;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Posted Issues</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/my-css/members/yourIssue.css">
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

<div class="container" style="background-color: ">
 <div class="row">    
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <h2>Welcome <?php echo $array[0]['username']; ?></h2>
     </div>    
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <h2>Your Posted Issues:</h2>
     </div>      
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <a href="logout.php" style="margin-left: 70%;"><button type="button" class="btn btn-info">Logout!</button></a>
     </div>         
  </div>
</div><hr/>

<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Posted By</th>
        <th>View</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
     <?php
        for($i=0; $i<$numOfIssues; $i++){
     ?>
      <tr>
        <td><?php echo $array[$i]['title']; ?></td>
        <td><?php echo date("jS-F-Y H:i", strtotime($array[$i]['date'])); ?></td>
        <td><?php echo $array[$i]['username']; ?></td>
        <td><a href="issues.php?url=<?php echo $array[$i]['url'] ?>">
        <?php 
            if($array[$i]['status']<0){
         ?>
            <button type="button" class="btn btn-danger btn-block">View</button><br/>
         <?php 
            }
            else if($array[$i]['status']==0){
         ?>
                <button type="button" class="btn btn-info btn-block">View</button><br/>
         <?php 
            }
            else{
         ?>
                <button type="button" class="btn btn-success btn-block">View</button><br/>
         <?php 
            }         
         ?>
        
        </a></td>
        <td>
        <form method="post" action="delete.php">
            <input type="submit" class="btn btn-outline-danger btn-block" name="delete" value="Delete"/>
            <input type="hidden" name="url" value="<?php echo $array[$i]['url'] ?>"/>
        </form>
        </td>
      </tr>
     <?php
            }
     ?>
    </tbody>
  </table> 
</div><br/>

<footer class="footer">
  <p>© Copyright: RPTech &nbsp;&nbsp;&nbsp;</p>
</footer>

</body>
</html>
