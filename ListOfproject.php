<?php
session_start();

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Project Leader')
{
header("location: /login.php");
}

include("db.php");

$pdo = db_connect();

if(!$pdo)
{
    echo ("Null PDO Object");
    exit;
}
$user_tablename="project";


$PHP_SELF=$_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css"> 
    <title>Ticket</title>
</head>
<body>
<header>
<h1>Task Allocator Pro (TAP)</h1>

<nav id="account">

    <figure>

    <img id="imgpersonal" src="./Files/<?php echo $_SESSION['images']; ?>" alt="pimg">
  <figcaption>  <a id="hehm"  href="/pesonalpage.php">
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

<article id="contener">

<nav id="Manager">
    <ul>
    <li><a href="/ListOfproject.php">List of Project</a></li>
    <li><a href="/CreateTask.php">Create Task</a></li>
    <li ><a href="/searchTaskleader.php">search Task</a></li>
    <!-- <li ><a href="/listofTasks.php">Task Details</a></li> -->
    </ul>
</nav>
<main id="assign">  
  <fieldset>
        <legend>Projects</legend>
        <?php

$id=$_SESSION["loginid"];

$query = "SELECT * FROM $user_tablename WHERE Leaderid = '$id'";

$result = $pdo->query($query);
echo '<ul id="listofproject">';
while ($row = $result->fetch()) {
  
    echo "<li><a href='TaskListTable.php?project_id=".$row['project_id']."'>".$row['project_title']."</a></li>";

}
   


echo '</ul>';  
       
        ?>
    </fieldset>

    

</main>

</article>
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
