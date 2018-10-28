<?php

include('../session.php');

if(!isset($_SESSION['login_user'])){
    header("location: ../index.html");
}

?>

<?php

$conn=mysqli_connect("localhost", "root", "", "socman");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

//Fetch User Details
$sql="SELECT * FROM login where username='$login_session'";
$result=mysqli_query($conn, $sql);
$array1 = array();
while($row=$result->fetch_array()){
         $array1[]=$row;
}

//Fetch Issues Posted By User
$numOfIssues=0;
$sql2="SELECT * FROM issues where username='$login_session'";
$result2=mysqli_query($conn, $sql2);
if($result2==NULL){
    
}
else{
    $array2 = array();
    while($row2=$result2->fetch_array()){
         $array2[]=$row2;
         $numOfIssues++;
    }
}

//Logic to count total pages for pagination
$num_rec_per_page=10;
$selecAllIssues = "SELECT * FROM issues";         	  
$allIssues = mysqli_query($conn, $selecAllIssues);			  
$total_records =mysqli_num_rows($allIssues);  //count number of issues					  
$total_pages = ceil($total_records / $num_rec_per_page);   

//Fetch Issues Posted By All Users
if(isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} else { 
    $page=1; 
}; 

$issues=0;

$start_from=($page-1)*$num_rec_per_page; 
$sql3="SELECT * FROM issues ORDER BY status ASC, serial DESC LIMIT $start_from, $num_rec_per_page";
$result3=mysqli_query($conn, $sql3);
if($result3!=NULL){
    $array3 = array();
    while($row3=$result3->fetch_array()){
         $array3[]=$row3;
         $issues++;
    }
}


$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Member</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/my-css/members/members.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  
</head>


<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">
    <img src="../assets/pictures/logo-small.png" alt="logo" style="width:100px">
  </a>

</nav><br/>    

<div class="container-fluid" style="background-color: ">
 <div class="row">    
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <h2>Welcome <?php echo $array1[0]['username']; ?></h2>
     </div>    
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <?php
         if($numOfIssues==0){
        ?>
             <h2>You have posted: <a href="yourIssues.php"><button type="button" class="btn btn-outline-danger" disabled><?php echo $numOfIssues ?> issues</button></a></h2>
        <?php
         }
         else{
        ?>
             <h2>You have posted: <a href="yourIssues.php"><button type="button" class="btn btn-outline-danger"><?php echo $numOfIssues ?> issues</button></a></h2>
        <?php
         }
         ?>
         
     </div>      
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <a href="logout.php" style="margin-left: 70%;"><button type="button" class="btn btn-info">Logout!</button></a>
     </div>         
  </div>
</div><hr/>

<div class="container">
 <div class="row">

     <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
         <button id="postIssue" type="button" class="btn btn-outline-danger btn-block">Address an issue/grievance</button><br/>
     </div>
     
     <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
         <button id="profile" type="button" class="btn btn-outline-primary btn-block">View your profile</button><br/>
     </div>
          
  </div>
</div><hr/>


<div class="container">
<div class="row">
 <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <h2>Recent Issues and Grievances</h2>   
 </div>
 <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
     <?php  
    //If page 1-3 is selected, show first 5 pages
    if($page<4){
?>
    <ul class="pagination">
    <?php     
    if($page==1){
        ?>
        <li class="page-item disabled"><a class="page-link" href='members-home.php?page=1'> << </a></li>
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='members-home.php?page=1'> << </a></li>
    <?php
    }    
        
    if($total_pages<=5) {
        for ($i=1; $i<=$total_pages; $i++) { 							 
            if($i == $page){	
                ?>
                <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
                <?php				   
            } else{
                ?>
                <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
            <?php	
            }							
        };
    }
        
    else {
        for ($i=1; $i<=5; $i++) { 							 
            if($i == $page){	
                ?>
                <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
                <?php				   
            } else{
                ?>
                <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
            <?php	
            }							
        };
    }
                             
    if($page==$total_pages){
    ?>
    <li class="page-item disabled"><a class="page-link" href='members-home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
     <?php	
        }
    ?>
</ul> 

<?php	
        }
    //If page selected is more than total-3, show last five pages
    elseif($page>$total_pages-3){
?>
<ul class="pagination">
    <?php     
    if($page==1){
        ?>
        <li class="page-item disabled"><a class="page-link" href='members-home.php?page=1'> << </a></li>
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='members-home.php?page=1'> << </a></li>
    <?php
    }
                             
    for ($i=$total_pages-4; $i<=$total_pages; $i++) { 							 
        if($i == $page){	
            ?>
            <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
            <?php				   
        } else{
            ?>
            <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
        <?php	
        }							
    };
                             
    if($page==$total_pages){
    ?>
    <li class="page-item disabled"><a class="page-link" href='members-home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
     <?php	
        }
    ?>
</ul> 

<?php	
        }
    //If any middle page is selected, show that page and left two and right two along with it
    else{
?>

<ul class="pagination">
    <?php     
    if($page==1){
        ?>
        <li class="page-item disabled"><a class="page-link" href='members-home.php?page=1'> << </a></li>
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='members-home.php?page=1'> << </a></li>
    <?php
    }
                             
    for ($i=$page-2; $i<=$page+2; $i++) { 							 
        if($i == $page){	
            ?>
            <li class="page-item active"><a class="page-link"><?php echo "$i" ?></a></li>	
            <?php				   
        } else{
            ?>
            <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$i" ?>'><?php echo "$i" ?></a></li>
        <?php	
        }							
    };
                             
    if($page==$total_pages){
    ?>
    <li class="page-item disabled"><a class="page-link" href='members-home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
    <?php
    }
    else {
        ?>
        <li class="page-item"><a class="page-link" href='members-home.php?page=<?php echo "$total_pages" ?>'> >> </a></li>	
     <?php	
        }
    ?>
</ul> 
<?php	
        }
?>
 </div></div>
        
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Posted By</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
     <?php
        if($page==$total_pages && ($total_records % 10)!=0){
          $n=$total_records % 10;
      }else{
          $n=10;
      }
        for($i=0; $i<$n; $i++){
     ?>
      <tr>
        <td><?php echo $array3[$i]['title']; ?></td>
        <td><?php echo date("jS-F-Y H:i", strtotime($array3[$i]['date'])); ?></td>
        <td><?php echo $array3[$i]['username']; ?></td>
        <td><a href="issues.php?url=<?php echo $array3[$i]['url'] ?>">
        <?php 
            if($array3[$i]['status']<0){
         ?>
            <button type="button" class="btn btn-danger btn-block">View</button><br/>
         <?php 
            }
            else if($array3[$i]['status']==0){
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

<div id="profileModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close1">&times;</span>
      <h2>My Profile</h2>
    </div>
    <div class="modal-body">
     
      <p class="profileData">
          Username: <?php echo $array1[0]['username']; ?>
          <br/>
          Password: <?php echo $array1[0]['password']; ?>
          <br/><br/>
          Name: [Name]
          <br/>
          Address: [Address]
          <br/>
          Contact: [Contact]          
      </p>
    
    </div>
  </div>
</div>

<div id="issueModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close2">&times;</span>
      <h2>Post your issue/grievance</h2>
    </div>
    <div class="modal-body">
      
    <form action="postIssue.php" method="POST">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="body">Body:</label>
        <textarea class="form-control" id="body" rows="10" name="body"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
        
    </div>
  </div>
</div>

<script>
var profileModal = document.getElementById('profileModal');
var profileBtn = document.getElementById("profile");
// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close1")[0];
// When the user clicks the button, open the modal 
profileBtn.onclick = function() {
    profileModal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    profileModal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == profileModal) {
        profileModal.style.display = "none";
    }
}

var issueModal = document.getElementById('issueModal');
var issueBtn = document.getElementById("postIssue");
var span2 = document.getElementsByClassName("close2")[0];
issueBtn.onclick = function() {
    issueModal.style.display = "block";
}
span2.onclick = function() {
    issueModal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == issueModal) {
        issueModal.style.display = "none";
    }
}
</script>

</body>
</html>
