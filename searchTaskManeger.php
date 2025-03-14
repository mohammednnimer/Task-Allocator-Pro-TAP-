<?php

session_start();
if(!isset($_SESSION["role"])||$_SESSION["role"]!='Manager')
{
header("location: /login.php");
}


include("db.php");

     $pdo=db_connect();
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
 
    if(empty($_POST["priority"])&&empty($_POST["status"])&&empty($_POST["duedate"])
    &&empty($_POST["projectName"])){


        $_SESSION['errors']='Please enter any value to search by';
      

    }
    else{
 
        $_SESSION['search']=true;

        if (isset($_POST["priority"]) && !empty($_POST["priority"])) {
            $_SESSION['priority'] = $_POST["priority"];
        } else {
            unset($_SESSION['priority']);
        }
        if (isset($_POST["status"]) && !empty($_POST["status"])) {
            $_SESSION['status'] = $_POST["status"];
        } else {
            unset($_SESSION['status']);
        }
        if (isset($_POST["duedate"]) && !empty($_POST["duedate"])) {
            $_SESSION['duedate'] = $_POST["duedate"];
        } else {
            unset($_SESSION['duedate']);
        }
        if (isset($_POST["projectName"]) && !empty($_POST["projectName"])) {
            $_SESSION['projectName'] = $_POST["projectName"];
        } else {
            unset($_SESSION['projectName']);
        }
        
        
        
        // !empty($_POST["status"])? $_SESSION['status']=$_POST["status"]:'';
        // !empty($_POST["duedate"])? $_SESSION['duedate']=$_POST["duedate"]:'';
        // !empty($_POST["projectName"])? $_SESSION['projectName']=$_POST["projectName"]:'';

header("location: /TableTaskmaneger.php");
        unset($_SESSION['errors']);
    }
}

// if($_SERVER['REQUEST_METHOD'] === 'POST')
// {
      



   
//     $pdo=db_connect();
//     $user_tablename = "tasks";
//     $user_tablename2 = "project";
//     $user_tablename3 = "user_task";
//     $userid = $_SESSION['loginid']; 
//     $sql = "SELECT task.TaskID, task.TaskName, project.project_title, task.Progress, task.Status 
//     FROM tasks as task 
//     JOIN user_task as user ON user.id_tasks = task.TaskID 
//     JOIN project as project ON task.ProjectID = project.project_id 
//     WHERE user.id_user = :userid";
    
// $cont = [':userid' => $userid];

// if (!empty($_POST["task_id"])) {
// $sql .= " AND task.TaskID = :task_id"; 
// $cont[':task_id'] = $_POST["task_id"];
// }

// if (!empty($_POST["task_name"])) {
// $sql .= " AND task.TaskName = :task_name";
//  $cont[':task_name'] = $_POST["task_name"];
// }

// if (!empty($_POST["project_name"])) {
// $sql .= " AND project.project_title = :project_name"; $cont[':project_name'] = $_POST["project_name"];
// }

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
<div id="contener"> 
<nav id="Manager">
    <ul>
    <li ><a href="/AddProject.php">Add project</a></li>
    <li ><a href="/Allocate_TeamLeader.php">Allocate Team Leader</a></li>
    <li ><a href="/searchTaskManeger.php">search Task</a></li>
</ul>
</nav>

<main id="succ">
<figure id="truecaper">
<img id="true" src="/Files/searching.png"  alt="true">

</figure> 
<!-- <hr id="hr"> -->

<form id="searching" action="searchTaskManeger.php" method="POST">
<?php
global $errors;

if(isset($_SESSION['errors']))
{
echo "<small>".$_SESSION['errors']."</small>";
echo "<br>";

}

?>


<label for="task-id">priority : </label>

<select name="priority" class="searhingtask" aria-valuetext="priority">
<option value="" disabled selected>Priority</option>
           <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>

        <label for="status">Task Status:</label>
        <select class="searhingtask"  name="status" id="status">
        <option value="" disabled selected>status</option> 
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>
    
        <label for="date">Start Date:</label>
        <input name="duedate" class="searhingtask" type="date" id="-date">

        

        <label for="project">Project:</label>
        <?php
global $pdo;
        $tablename = "project";
         $quer = "SELECT * FROM $tablename WHERE true";
         $resul = $pdo->query($quer);
echo "<select class='searhingtask'  name='projectName' >";
echo "<option disabled  selected value=''>" .'Project'."</option>";
while ($r = $resul->fetch()) {
    echo "<option value=".$r['project_id']."> ".$r['project_title']."</option>";
}
echo "</select>";
      ?>

     <button type="submit">Search</button>
    
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

