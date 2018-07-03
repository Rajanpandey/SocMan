<?php
$conn=mysqli_connect("localhost", "root", "", "socman");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}


//Calculate number of unaddressed, addressing and addressd issues
$selectUnaddressed = "SELECT * FROM issues where status='-1'";         	  
$allUnaddressed = mysqli_query($conn, $selectUnaddressed);	
$total_unaddressed =mysqli_num_rows($allUnaddressed);

$selectAddressing = "SELECT * FROM issues where status='0'";         	  
$allAddressing = mysqli_query($conn, $selectAddressing);
$total_addressing =mysqli_num_rows($allAddressing);

$selectAddressed = "SELECT * FROM issues where status='1'";         	  
$allAddressed = mysqli_query($conn, $selectAddressed);
$total_addressed =mysqli_num_rows($allAddressed);


$selecAllIssues = "SELECT * FROM issues";         	  
$allIssues = mysqli_query($conn, $selecAllIssues);

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
  <title>Committee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/my-css/committee/committee.css">
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

<div class="container" style="background-color: ">
 <div class="row">    
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <h2>To Address: <a href="#"><button type="button" class="btn btn-outline-danger"><?php echo $total_unaddressed ?> issues unsolved</button></a></h2>
     </div>    
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
         <h2>Addressing: <a href="#"><button type="button" class="btn btn-outline-primary"><?php echo $total_addressing ?> issues solving</button></a></h2>
     </div>   
     <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <h2>Addressed: <a href="#"><button type="button" class="btn btn-outline-success"><?php echo $total_addressed ?> issues solved</button></a></h2>
     </div>         
  </div>
</div><hr/>

<div class="container">
 <div class="row">

     <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
         <button type="button" class="btn btn-outline-success btn-block">Post a notice</button><br/>
     </div>
     
     <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
         <button type="button" class="btn btn-outline-primary btn-block">View Notice Board</button><br/>
     </div>
          
  </div>
</div><hr/>


<div class="container">
<div class="row">
 <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <h2>Top Issues and Grievances</h2>   
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

</body>
</html>
