<?php
session_start();


include("db.php");

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Team Member')
{
header("location: /login.php");
}


$PHP_SELF = $_SERVER['PHP_SELF'];
$user_tablename="ticket";

$pdo = db_connect();


if($_SERVER['REQUEST_METHOD'] === 'POST')
{


    if(empty($_POST["task_id"])&&empty($_POST["task_name"])&&empty($_POST["project_name"]))
        {
            $_SESSION['errors']="Please enter any data to search for the Tasks";
            $_SESSION['search']=true;
            header("location: /searchTask.php");
            exit;
        }


    $pdo=db_connect();
    $user_tablename = "tasks";
    $user_tablename2 = "project";
    $user_tablename3 = "user_task";
    $userid = $_SESSION['loginid']; 
    $sql = "SELECT user.stute,user.progress,user.id, task.TaskID, task.TaskName, project.project_title, task.Progress, task.Status 
    FROM tasks as task 
    JOIN user_task as user ON user.id_tasks = task.TaskID 
    JOIN project as project ON task.ProjectID = project.project_id 
    WHERE user.id_user = :userid";
    
$cont = [':userid' => $userid];

if (!empty($_POST["task_id"])) {
$sql .= " AND task.TaskID = :task_id"; 
$_SESSION['task_id']=$_POST["task_id"];


$cont[':task_id'] = $_POST["task_id"];
}

if (!empty($_POST["task_name"])) {
$sql .= " AND task.TaskName = :task_name";
 $cont[':task_name'] = $_POST["task_name"];
 $_SESSION['task_name']=$_POST["task_name"];

}

if (!empty($_POST["project_name"])) {
$sql .= " AND project.project_title = :project_name";
$_SESSION['project_name']=$_POST["project_name"];
$cont[':project_name'] = $_POST["project_name"];

}

$stmt = $pdo->prepare($sql);
$stmt->execute($cont);



}
else{
   // echo 'mohammmmmmmmmmmmad';
    header("location: /searchTask.php");
}


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
    <li
    <?php
    global $issset;    if($issset==1){echo ' id="assign"';}
     ?> 
    ><a  href="/membertask.php"> Assignments</a></li>
   
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
}

function table()
{
    global $stmt;
    $results = $stmt->fetchAll();
    

    if ($results) {
        echo "<table id='updatetable' border='1' cellpadding='10' cellspacing='0'>";
        echo "<thead>
                <tr>
                    <th>Task ID</th>
                    <th>Task Name</th>
                    <th>Project Name</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Update Links</th>
                </tr>
              </thead>";
        echo "<tbody>";
        $i=1;
        foreach ($results as $row) {
            $_SESSION['taskid'.$i] = $row['TaskID'];
            $_SESSION['taskname'.$i] = $row['TaskName'];
            $_SESSION['ProjectName'.$i] = $row['project_title'];
            $_SESSION['taskProgress'.$i] = $row['Progress'];
            $_SESSION['taskStatus'.$i] = $row['Status'];
            $_SESSION['userProgress'.$i] = $row['progress'];
            $_SESSION['userstatue'.$i] = $row['stute'];
            echo "<tr>";
            echo "<td>" . $row['TaskID']. "</td>";
            echo "<td>" . $row['TaskName'] . "</td>";
            echo "<td>" . $row['project_title'] . "</td>";
            echo "<td>" . $row['progress'] . "%</td>";
            echo "<td>" . $row['stute'] . "</td>";
            echo "<td><a href='ubdateTask.php?No=".$i."&task_userid=".$row['id']."'>Update</a></td>";
            echo "</tr>";
            $i=$i+1;
        
        }
        echo "</tbody>";
        echo "</table>";
    if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']); 
        }
  
    } else {
        $_SESSION['errors'] = "There are no tasks for the data you entered";
        $_SESSION['search']=true;
    
       header("location: /searchTask.php");
    
    }
}
?>
 