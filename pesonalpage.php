<?php

session_start();
if(!isset($_SESSION["role"]))
{
header("location: ./login.php");
}

include("db.php");


   
    $pdo=db_connect();
    $id=$_SESSION['loginid'];
    $user_tablename = "users";
 
    $userid = $_SESSION['loginid']; 
    $sql = "SELECT *  FROM $user_tablename  WHERE id = :userid";

    $cont[':userid']=$id;
$stmt = $pdo->prepare($sql);
$stmt->execute($cont);
$result = $stmt->fetch();
    
    if ($result) {
    
        $id= $result['id'];
        $name= $result['name'];
        $country= $result['address_country'];
        $city= $result['address_city']; 
        $email= $result['email'];
        $images= $result['images'];
        $date_of_birth=$result['date_of_birth'];
        $role= $result['role'];

     

    } 
    







?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Add Project</title>
</head>
<body>
<header>
<h1>Task Allocator Pro (TAP)</h1>

<nav id="account">

    <figure>

    <img id="imgpersonal" src="./Files/<?php echo $_SESSION['images']; ?>" alt="pimg">
  <figcaption>  <a id="hehm"  href="./pesonalpage.php">
    <?php
echo $_SESSION['name']; ?></a></figcaption>

<a id="logout" href="/login.php"> <small>Logout</small></a>
 
</figure>
<!-- <button id="logoutbutt"> -->
<!-- <img id="logout" src="/Files/logout.png" alt="logout"> -->
        <!-- <ul>
            <li class="li"><a href="/Sing-up.php">Sign-up</a></li>
            <li class="li"><a href="/login.php">Login</a></li>
            <li class="li"><a href="/login.php">Logout</a></li>
        </ul> -->
    </nav>
</header>
<div id="contener"> 

<nav id="Manager">

    

    <ul>
    <?php
if($_SESSION['role']=='Manager')
{

?>
    <li><a href="./AddProject.php">Add project</a></li>
    <li ><a href="./Allocate_TeamLeader.php">Allocate Team Leader</a></li>
    <li ><a href="./searchTaskManeger.php">search Task</a></li>
      <?php

}

?>
    <?php
if($_SESSION['role']=='Project Leader')
{

?>
      <li><a href="./ListOfproject.php">List of Project</a></li>
    <li><a href="./CreateTask.php">Create Task</a></li>
    <li ><a href="./searchTaskleader.php">search Task</a></li>
    <!-- <li ><a href="/listofTasks.php">Task Details</a></li> -->
    <?php

}

?>
    <?php
if($_SESSION['role']=='Team Member')
{

?>
  <li
    <?php
    global $issset;    if($issset==1){echo ' id="assign"';}
     ?>
    ><a  href="./membertask.php"> Assignments</a></li>
   
    <li><a href="./searchTask.php">Ubdate Task</a></li>
    <li ><a href="./searchTaskmember.php">search Task</a></li>
      <?php

}

?>


</ul>



</nav>

<main id="succ">
<figure id="truecaper">
<img id="true" src="/Files/<?php  echo   $images; ?> " alt="true">

</figure> 

<?php
echo '<ul>';
echo "<li><strong>ID:</strong> $id</li>";
echo "<li><strong>Name:</strong> $name</li>";
echo "<li><strong>Country:</strong> $country</li>";
echo "<li><strong>City:</strong> $city</li>";
echo "<li><strong>Email:</strong> $email</li>";
echo "<li><strong>Date of Birth:</strong> $date_of_birth</li>";
echo "<li><strong>Role:</strong> $role</li>";
echo '</ul>';



?>
</main>

</div>
<footer>
 <small id="small">
 <a href="https://www.facebook.com/Future.Center.Haybrid.cars/?locale=ar_AR"> <small id="small"> Contact Us Page</small></a>
<a href="https://web.whatsapp.com/">|<small id="small">  0569145345 </small></a>
 Birzait-Rammalh
</small> 
 <br>
&copy; 2024 Mohammad nemer -Id 1222300 |<a href="./../../index.html"><small id="small">Mohammad Nemer Hame Page</small></a>

</footer>
</body>
</html>

