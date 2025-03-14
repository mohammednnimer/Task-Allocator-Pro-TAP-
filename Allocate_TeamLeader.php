<?php
session_start();

include("db.php");


if(!isset($_SESSION["role"])||$_SESSION["role"]!='Manager')
{

header("location: /login.php");

}




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
    <li ><a href="/AddProject.php">Add project</a></li>
    <li ><a href="/Allocate_TeamLeader.php">Allocate Team Leader</a></li>
    <li ><a href="/searchTaskManeger.php">search Task</a></li>
 
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
    $user_tablename="project";
 $query = "SELECT * FROM $user_tablename WHERE Leaderid IS NULL";

   global $pdo; 
    $result = $pdo->query($query);
    echo   "<table id='tableprojectleader'>";
    
    echo "<thead>
    <tr>
        <th>Project ID</th>
        <th>Project Title</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Action</th>
    </tr>
</thead>";
echo "<tbody>";
$rows = $result->fetchAll();
if($rows)
{
foreach($rows as $row)
{
    echo "<tr>";
    echo "<td>" .$row['project_id']. "</td>";
    echo "<td>{$row['project_title']}</td>";
    echo "<td>{$row['start_date']}</td>";
    echo "<td>{$row['end_date']}</td>";
    echo "<td><a href='assign.php?project_id=".$row['project_id']."'><img src='./Files/assign.jpg'/></a></td>";
    echo "</tr>";
}
}else{
    echo "<td colspan=5> No Project</td>";
}

    
     echo "</table>";
     echo "</table>";
}
?>
