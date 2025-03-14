<?php

session_start();

include("db.php");

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Team Member')
{
header("location: ./login.php");
}
$pdo=db_connect();
if(!isset($_SESSION['search']))
{
unset($_SESSION['errors']);

}
else{
    unset($_SESSION['search']);
}

// if($_SERVER['REQUEST_METHOD'] === 'POST')
// {

//     if(!empty($_POST["task_id"])&&!empty($_POST["task_name"])&&!empty($_POST["project_name"]))
//     {

//         $pdo=db_connect();
//         $user_tablename = "tasks";
//         $user_tablename2 = "project";
//         $user_tablename3 = "user_task";
//         $userid = $_SESSION['loginid']; 
//         $sql = "SELECT task.TaskID, task.TaskName, project.project_title, task.Progress, task.Status 
//         FROM tasks as task 
//         JOIN user_task as user ON user.id_tasks = task.TaskID 
//         JOIN project as project ON task.ProjectID = project.project_id 
//         WHERE user.id_user = :userid";
        
//     $cont = [':userid' => $userid];
    
//     if (!empty($_POST["task_id"])) {
//     $sql .= " AND task.TaskID = :task_id"; 
//     $cont[':task_id'] = $_POST["task_id"];
//     }
    
//     if (!empty($_POST["task_name"])) {
//     $sql .= " AND task.TaskName = :task_name";
//      $cont[':task_name'] = $_POST["task_name"];
//     }
    
//     if (!empty($_POST["project_name"])) {
//     $sql .= " AND project.project_title = :project_name"; $cont[':project_name'] = $_POST["project_name"];
//     }
    
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($cont);
//     $result = $stmt->fetch();
        
//         if ($result) {
//             $errors="yes";
      
//             $_SESSION['taskid'] = $result['TaskID'];
//             $_SESSION['taskname'] = $result['TaskName'];
//             $_SESSION['ProjectName'] = $result['project_title'];
//             $_SESSION['taskProgress'] = $result['Progress'];
//             $_SESSION['taskStatus'] = $result['Status'];
    
//             unset($_SESSION['errors']);
//     header("location: /ubdateTask.php");
    
     
//         } 
//         else{
//             $_SESSION['errors']="no Task";
           
//         }
//     }
//     else{
//         $_SESSION['errors']="Please enter any data to search for the Tasks";
//     }
// }





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

<a id="logout" href="./login.php"> <small>Logout</small></a>
 
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
    <li
    <?php
    global $issset;    if($issset==1){echo ' class="assign"';}
     ?>
    
    ><a  href="./membertask.php"> Assignments</a></li>
   
    <li><a href="./searchTask.php">Ubdate Task</a></li>
    <li ><a href="./searchTaskmember.php">search Task</a></li>
</ul>
</nav>

<main id="succ">
<figure id="truecaper">
<img id="true" src="./Files/searching.png"  alt="true">

</figure> 


<form id="searching2" action="searchubdateTask.php" method="POST">
<?php
global $errors;
if(isset($_SESSION['errors']))
{
echo "<small>".$_SESSION['errors']." !!</small>";
echo "<br>";

}
 unset($_SESSION['errors']);

?>
<?php
global $errors;
if(isset($_SESSION['sucses']))
{
echo "<small  class='success-message2'>".$_SESSION['sucses']." !!</small>";
echo "<br>";

}
 unset($_SESSION['sucses']);

?>



<label for="task-id">Task ID : </label>

    <input type="text" id="task-id" name="task_id" height="100" placeholder="Enter Task ID">
    <br>
    
    <label for="task-name">Task Name : </label>
    <input type="text" id="task-name" name="task_name" placeholder="Enter Task Name">
    <br>    
    <label for="project-name">Project Name : </label>
    <input type="text" id="project-name" name="project_name" placeholder="Enter Project Name">
    
    


     <button id="searching3" type="submit">Search</button>
</form>

<!-- 
<a href="/setmember.php?Task_id=<?php echo $_SESSION['Task_id']; ?>&Taskname=<?php echo $_SESSION['Taskname']; ?>">
    <button id="buttom">Add Another Member</button></a>
<a href="/TaskListTable.php?project_id=<?php echo $_SESSION['projectid']; ?>"><button id="buttom">Finish Allocation</button></a>   
 -->


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