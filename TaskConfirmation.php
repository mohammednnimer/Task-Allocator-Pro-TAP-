<?php
session_start();
include("db.php");

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Team Member')
{
header("location: /login.php");
}

$pdo = db_connect();

if(!$pdo)
{
    echo ("Null PDO Object");
    exit;
}

if(isset($_GET['valid']))
{

$valid;
$usertaskid=$_SESSION["user_task"];
$name='user_task';
    if(isset($_GET['valid'])&&$_GET['valid']=='true')
    {
        $valid=1;
       
    $quere='update '.$name.'  set  accept='.$valid.'  where id=:id';

    $result=$pdo->prepare($quere);
  $result=$result->execute(['id' => $usertaskid]);

    }
    else{
        $valid=0;


        $quere='delete from  '.$name.' where id=:id';

        $result=$pdo->prepare($quere);
      $result=$result->execute(['id' => $usertaskid]);
    }



   

  header("location: /memberTask.php");



}


$user_tablename="tasks";

$issset=issett();

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
    <li
    <?php global $issset;    if($issset==1){echo ' class="assign"';}?>
    ><a  href="/membertask.php"> Assignments</a></li>
    <li><a href="/searchTask.php">Ubdate Task</a></li>
    <li ><a href="/searchTaskmember.php">search Task</a></li>

    </ul>
</nav>
<main id="assign2">  
  <fieldset>
        <legend>Task Details </legend>
        <?php

$id=$_GET["Task_id"];
$_SESSION["Task_id"]=$id;
$_SESSION["user_task"]=$_GET["tuserTaskid"];
$role=$_GET['Role'];

$query = "SELECT * FROM $user_tablename WHERE TaskID  = :id";

$result = $pdo->prepare($query);
$result->execute(['id' => $id]);

echo "<nav>";

echo '<ul>';


$row = $result->fetch();

if($row)
{
    echo "<li>Task ID : <strong>".$row['TaskID']."</strong></li>";
    echo "<li>Task Title: <strong>".$row['TaskName']."</strong> </li>";
    echo "<li>Description: <strong>".$row['Description']."</strong></li>";
    echo "<li>Status : <strong>".$row['Status']."</strong></li>";
    echo "<li>Total Effort :<strong>".$row['Effort']."</strong></li>";
    echo "<li>Role : <strong>".$role."</li></strong>";
    echo "<li>Start Date : <strong>".$row['StartDate']."</strong></li>";
    echo "<li> End Date    :  <strong>".$row['EndDate']."</strong></li>";
}

echo '</ul>';
echo "</nav>"         
        ?>
    </fieldset>

    <div id="buttuns">

<a  href="/TaskConfirmation.php?valid=true"><button  id="buttunaccept">  Accept Task <img width="20" height="15" src="Files/check.png" alt="true"></button>   </a>
<a  href="/TaskConfirmation.php?valid=false"><button  id="buttunrejected">  Reject Task <img width="20" height="15" src="Files/delete.png" alt="false"></button></a>


</div>
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
              WHERE user.id_user = :userid";
    
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
