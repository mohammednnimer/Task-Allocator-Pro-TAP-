<?php
session_start();

include("db.php");


if(!isset($_SESSION["role"])||$_SESSION["role"]!='Team Member')
{
header("location: /login.php");
}



$issset=0;



$PHP_SELF = $_SERVER['PHP_SELF'];
$user_tablename="ticket";

$pdo = db_connect();


$issset=issett();



    global $PHP_SELF;
 ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
   
    <title>Allocate Team Leader</title>
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
    <li
    ><a class= <?php
    global $issset; 
    echo  $issset==1? "assign":"";
     ?> href="/membertask.php"> Assignments</a></li>
    <li><a href="/searchTask.php">Ubdate Task</a></li>
    <li ><a href="/searchTaskmember.php">search Task</a></li>
    </ul>
</nav>

<main>
<?php

table();
?>

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
<?php


function table()
{
    $user_tablename = "tasks";
    $user_tablename2 = "project";
    $user_tablename3 = "user_task";
    $userid = $_SESSION['loginid'];
    
    $query = "SELECT task.TaskID, task.TaskName, project.project_title,task.StartDate,user.Role,user.id
              FROM $user_tablename as task
              JOIN $user_tablename3 as user ON user.id_tasks = task.TaskID
              JOIN $user_tablename2 as project ON task.ProjectID = project.project_id
              WHERE user.id_user = :userid and user.accept is NULL";
    
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute(['userid' => $userid]);

   
    echo   "<table id='tabletaskconform'>";
    
    echo "<thead>
    <tr>
        <th>Task Id</th>
        <th>Task Name</th>
        <th>Project Name</th>
        <th>Starts Date</th>
         <th>confirm</th>
    </tr>
</thead>";
echo "<tbody>";
global $issset;

$rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
if($rows )
{
foreach($rows as $row)
{
    echo "<tr>";
    echo "<td>" .$row['TaskID']. "</td>";
    echo "<td>{$row['TaskName']}</td>";
    echo "<td>{$row['project_title']}</td>";
    echo "<td>{$row['StartDate']}</td>";
    echo "<td><a href='TaskConfirmation.php?Task_id=".$row['TaskID']."&Role=".$row['Role']."&tuserTaskid=".$row['id']."'>Confirm
     <img width='20' height='15' src='./Files/check.png' alt='true' </a></td>";
    echo "</tr>";
}

}else{

    echo "<td colspan=5>No task</td>";
}



    echo "</tbody>";
     echo "</table>";
    
}

function issett()
{
    $user_tablename = "tasks";
    $user_tablename2 = "project";
    $user_tablename3 = "user_task";
    $userid = $_SESSION['loginid'];
    
    $query = "SELECT task.TaskID, task.TaskName, project.project_title,task.StartDate
              FROM $user_tablename as task
              JOIN $user_tablename3 as user ON user.id_tasks = task.TaskID
              JOIN $user_tablename2 as project ON task.ProjectID = project.project_id
              WHERE user.id_user = :userid  and user.accept is NULL";
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute(['userid' => $userid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
global $issset;
if($row)
{
   return 1;
}
   
return 0;
    
}



?>
 