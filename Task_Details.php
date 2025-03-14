<?php
session_start();
if(!isset($_SESSION["role"]))
{
header("location: /login.php");
}

include("db.php");


if(!isset($_GET['TaskID']))
{
header("location: /listofTasks");
}

$id=$_GET['TaskID'];

$pdo = db_connect();

if(!$pdo)
{
    echo ("Null PDO Object");
    exit;
}
$user_tablename="tasks";


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
    <?php
if($_SESSION['role']=='Manager')
{

?>
 <li ><a href="/AddProject.php">Add project</a></li>
    <li ><a href="/Allocate_TeamLeader.php">Allocate Team Leader</a></li>
    <li ><a href="/searchTaskManeger.php">search Task</a></li>
      <?php

}

?>
    <?php
if($_SESSION['role']=='Project Leader')
{

?>
      <li><a href="/ListOfproject.php">List of Project</a></li>
    <li><a href="/CreateTask.php">Create Task</a></li>
    <li ><a href="/searchTaskleader.php">search Task</a></li>
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
    ><a  href="/membertask.php"> Assignments</a></li>
   
    <li><a href="/searchTask.php">Ubdate Task</a></li>
    <li ><a href="/searchTaskmember.php">search Task</a></li>
      <?php

}

?>
    </ul>
</nav>
<main id="Task_Details">  
  <fieldset id="informationtasks">
        <legend >Tasks Details</legend>
        <?php
T_LIST();
        ?>
    </fieldset>
  
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

function T_LIST()
{
    global $pdo;

    global $id;

    //$query = "SELECT * FROM $user_tablename WHERE Leaderid = '$id'";
    
    $sql = "
    SELECT * FROM tasks JOIN project ON  tasks.ProjectID = project.project_id WHERE tasks.TaskID=:id";
    
$cont[':id']=$id;
     
   $stmt = $pdo->prepare($sql);
        $stmt->execute($cont);
    
      
 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo '<nav>';
echo '<ul>';
if($row) {
    echo "<li><strong>Task ID :</strong> " .$row['TaskID'] . "</li>";
    echo "<li><strong>Task Name :</strong> {$row['TaskName']}</li>";
    echo "<li><strong>Description: </strong>{$row['Description']}</li>";
    echo "<li><strong>Project Name: </strong> {$row['project_title']}</li>";
    echo "<li><strong>Start Date: </strong>{$row['StartDate']}</li>";
    echo "<li><strong>EndDate: </strong>{$row['EndDate']}</li>";
    echo "<li><strong>Progress: </strong>{$row['Progress']}%</li>";
    echo "<li><strong>Status: </strong>{$row['Status']}</li>";
    echo "<li><strong>Priority :</strong>{$row['Priority']}</li>";
}

echo '</ul>';
  echo '</nav>';
    
}

function table()
{
    

    global $id;
    $cont[':id']=$id;
    $sql = "
    SELECT * FROM 
        user_task
     JOIN 
        users
        ON user_task.id_user = users.id  WHERE user_task.id_tasks=:id and user_task.accept=1";     

 
        global $pdo; 

   //  echo $sql;
   $stmt = $pdo->prepare($sql);
        $stmt->execute($cont);
        
     // print_r($cont);
      
    echo   "<table id='tableuser'>";
    
    echo "<thead>
    <tr>
         <th>Photo</a></th>
         <th>Member ID</a></th>
         <th>Name</a></th>
         <th>Start Date</th>
         <th>End Date</th>
         <th>Effort</th>
    </tr>
</thead>";
echo "<tbody>";
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($rows)
{
    foreach ($rows as $row) {
  
        echo "<tr>";
        echo "<td><img class='imageuser' src='/Files/" . $row['images'] . "' alt='Image' /></td>";
        echo "<td>" .$row['id'] . "</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['Start_Date']}</td>";

        if($row['stute']=='Completed')
        {
            echo "<td>{$row['End_Date']}</td>";
        }else{
            echo "<td>In Progress</td>";
        }
        echo "<td>{$row['Contribution']}%</td>";
        echo "</tr>";
    }

}else{
    echo "<tr>";
     echo "<td colspan='6'>no Human</td>";
     echo "</tr>";
}

    echo "</tbody>";
    echo "</table>";
    
}







?>
 