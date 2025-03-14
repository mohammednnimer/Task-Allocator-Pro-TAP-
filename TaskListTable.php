<?php
session_start();
if(!isset($_SESSION["role"])||$_SESSION["role"]!='Project Leader')
{
header("location: /login.php");
}


include("db.php");


$PHP_SELF = $_SERVER['PHP_SELF'];
$user_tablename="ticket";

$pdo = db_connect();



main();
function main()
{
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

    <img id="imgpersonal" src="/Files/<?php echo $_SESSION['images']; ?>" alt="pimg">
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
}

function table()
{
    $user_tablename="tasks";

    $projectid=$_GET['project_id'];

    $_SESSION['projectid'] = $projectid;

    $sort='TaskID' ;
    if(isset($_GET['sort']))
    {

        $sort=$_GET['sort'];

    }


    $query = "SELECT * FROM $user_tablename WHERE ProjectID = :projectid ORDER BY $sort ASC";
   global $pdo; 

   $stmt = $pdo->prepare($query);

 $stmt->execute(['projectid' => $projectid]);
 
   
    echo   "<table id='tableelisttask'>";
    
    echo "<thead>
    <tr>
        <th><a href='?sort=TaskID&project_id=$projectid'>Task Id</a></th>
        <th><a href='?sort=TaskName&project_id=$projectid'>Task Name</a></th>
        <th><a href='?sort=StartDate&project_id=$projectid'>Start Date</a></th>
        <th><a href='?sort=Status&project_id=$projectid'>Status</a></th>
        <th><a href='?sort=Priority&project_id=$projectid'>Priority</a></th>
         <th>Team Allocation</th>
    </tr>
</thead>";
echo "<tbody>";
$rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
if($rows)
{
    foreach ($rows as $row) {
      
        echo "<tr>";
        echo "<td>" .$row['TaskID']. "</td>";
        echo "<td>{$row['TaskName']}</td>";
        echo "<td>{$row['StartDate']}</td>";
        echo "<td>{$row['Status']}</td>";
        echo "<td>{$row['Priority']}</td>";
        echo "<td><a href='setmember.php?Task_id=".$row['TaskID']."&Taskname=".$row['TaskName']."'>Assign Team Members</a></td>";
        echo "</tr>";
    }

}else{
    echo "<td colspan=6><strong> No Tasks </strong></td>";
}
    
    echo "</tbody>";
     echo "</table>";
    
}
?>
 