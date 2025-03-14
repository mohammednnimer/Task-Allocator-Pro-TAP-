<?php
session_start();
if(!isset($_SESSION["role"])||$_SESSION["role"]!='Project Leader')
{
header("location: /login.php");
}
if(!isset($_SESSION['priority'])&&!isset($_SESSION['status'])&&!isset($_SESSION['duedate'])&&!isset($_SESSION['projectName']))
{

    header("location: /searchTaskleader.php");
}
{


}

include("db.php");



      

    $pdo=db_connect();
  
    $id=$_SESSION['loginid'];
     $userid = $_SESSION['loginid'];
   
     $sql = "
     SELECT 
         tasks.TaskID , 
         tasks.TaskName, 
         project.project_title, 
         tasks.Status , 
         tasks.Priority , 
         tasks.StartDate , 
         tasks.EndDate, 
         tasks.Progress
     FROM 
         tasks
      JOIN 
         project ON  tasks.ProjectID = project.project_id WHERE project.Leaderid=$id";

    // $sql = "SELECT * FROM  $user_tablename1  
    //  WHERE true";


if (isset($_SESSION['priority'])) {
$sql .= " AND 	tasks.Priority  = :priority"; 
$cont[':priority'] = $_SESSION['priority'];
}

if (isset($_SESSION['status'])) {
$sql .= " AND 	tasks.Status = :status";
 $cont[':status'] = $_SESSION['status'];
}


if (isset($_SESSION['duedate'])) {
$sql .= " AND tasks.StartDate  <= :duedate1 AND tasks.EndDate >= :duedate2" ;
 $cont[':duedate1'] = $_SESSION['duedate'];
 $cont[':duedate2'] = $_SESSION['duedate'];
}
if (isset($_SESSION['projectName'])) {
   $sql .= " AND project.project_id = :project_name";
     $cont['project_name'] = $_SESSION['projectName'];
    
    }

// $stmt = $pdo->prepare($sql);
// $stmt->execute($cont);
// $result = $stmt->fetch();
    
//     if ($result) {
//         $errors="yes";
  
//         $_SESSION['taskid'] = $result['TaskID'];
//         $_SESSION['taskname'] = $result['TaskName'];
//         $_SESSION['ProjectName'] = $result['project_title'];
//         $_SESSION['taskProgress'] = $result['Progress'];
//         $_SESSION['taskStatus'] = $result['Status'];


// header("location: /ubdateTask.php");

  
//     } 
//     else{
// $errors="no Task";
//     }



$PHP_SELF = $_SERVER['PHP_SELF'];
//$user_tablename="ticket";

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
global $sql;
table($sql);
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

function table($sql)
{
    
    $sort='TaskID' ;
    if(isset($_GET['sort']))
    {
        $sort=$_GET['sort'];
    }



    global $cont;

   global $pdo; 
   $sql .= " ORDER BY  $sort ASC";

   //  echo $sql;
   $stmt = $pdo->prepare($sql);
        $stmt->execute($cont);
        
     // print_r($cont);
      
    echo   "<table id='tablee'>";
    
    echo "<thead>
    <tr>
         <th><a href='?sort=tasks.TaskID'>Task Id</a></th>
         <th><a href='?sort=tasks.TaskName'>Task Name</a></th>
         <th><a href='?sort=project.project_title'>Project Name</a></th>
         <th><a href='?sort=tasks.Status'>Status</a></th>
         <th><a href='?sort=tasks.Priority'>Priority</a></th>
         <th><a href='?sort=tasks.StartDate'>Start Date</a></th>
         <th><a href='?sort=tasks.EndDate'>End Date</a></th>
         <th><a href='?sort=tasks.Progress'>Progress %</a></th>
    </tr>
</thead>";
echo "<tbody>";
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($rows){
    foreach ($rows as $row) {
  
        echo "<tr  class='rows'>";
        echo "<td><a href='Task_Details.php?TaskID=".$row['TaskID']."'>" .$row['TaskID'] . "</a></td>";
         echo "<td>{$row['TaskName']}</td>";
        echo "<td>{$row['project_title']}</td>";
        if($row['Priority']=='Low')
        {
            echo "<td class='Low'>{$row['Priority']}</td>";
        }else if($row['Priority']=='Medium'){
            echo "<td  class='Medium'>{$row['Priority']}</td>";
        }else{
            echo "<td  class='High'>{$row['Priority']}</td>";
        }

        if($row['Status']=='Pending')
        {
            echo "<td class='Pending'>{$row['Status']}</td>";
        }else if($row['Status']=='In Progress'){
           echo "<td  class='In_Progress'>{$row['Status']}</td>";
        }else{
            echo "<td  class='Completed'>{$row['Status']}</td>";
        }
      
       echo "<td>{$row['StartDate']}</td>";
        echo "<td>{$row['EndDate']}</td>";
        echo "<td>{$row['Progress']}</td>";
        echo "</tr>";
    }
}
else{
    echo "<td colspan=8><Strong> No Tasks </Strong></td>";
}

    echo "</tbody>";
    echo "</table>";
    
}
?>
 