<?php
session_start();
include("db.php");

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Team Member')
{
header("location: /login.php");
}

$errors="";
$i=1;
if(isset($_GET['No'])&&isset($_GET['task_userid']))
{
$i=$_GET['No'];

$_SESSION["task_userid"]=$_GET['task_userid'];

}



if(!isset($_GET['No'])&&!isset($_POST['status']))
{
header("location: /searchTask.php");
exit;
}

$taskStatus=$_SESSION['taskStatus'.$i];
$taskProgress= $_SESSION['taskProgress'.$i];
$endtime=null;
   
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
$pdo=db_connect();
$id = $_SESSION["task_userid"];
$state = $_POST['status'];
$taskid=$_POST['task_id'];
$progress = $_POST['progress'];
    $user_tablename = "tasks";
    $user_tablename2 = "user_task";
if($state === 'Completed')
{
    $progress = 100;
}
    
if($state === 'In Progress' &&( $progress == 0||$progress == 100))
{
    $errors= "Error: Progress value must be greater than 0% and leass than 100% for 'In Progress' status.";
   
}
else{

    
    if ($progress == 100) {
        $endtime=date('Y-m-d');
        if($_SESSION['userProgress'.$i]<100)
        {
            $query = "SELECT * FROM $user_tablename2 WHERE id = :id";
            $result = $pdo->prepare($query);
            $state ="Completed";
            $endtime=date('Y-m-d');
            
            $success = $result->execute([
                'id' => $id
            ]);
        
            if ($success) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
        
                   $nextpregress=$row['Contribution']+$taskProgress;
                  if($nextpregress<=100)
                  {
                    if($nextpregress==100)
                    {
                        $taskStatus='Completed';
                    }else if($nextpregress<100&&$nextpregress>0)
                    {
                        $taskStatus='In Progress';
                    }else{
                        $taskStatus='Pending';
                    }
    
                    $query = "UPDATE $user_tablename SET Progress = :progress, Status = :status WHERE TaskID  = :id";
      
                    $result = $pdo->prepare($query);
                
                    $success = $result->execute([
                        'progress' => $nextpregress,
                        'status' => $taskStatus,
                        'id' => $taskid
                        // 'end_date' => ($progress == 100 ? $current_time : null)
                    ]);
    
                  }
    
             

        }else{

        }
  
       


                }


}else if ($state === 'Pending') {
    $progress = 0;
}


$query = "UPDATE $user_tablename2 SET progress = :progress,End_Date =:endtime, stute = :status WHERE id  = :id";
  
$result = $pdo->prepare($query);

$success = $result->execute([
    'progress' => $progress,
    'endtime'=>$endtime,
    'status' => $state,
    'id' => $id
    // 'end_date' => ($progress == 100 ? $current_time : null)
]);

$_SESSION['sucses']='The modification process succeeded';
unset($_SESSION["task_userid"]);

header ( "Location:  searchTask.php?");


}


// if (($progress == 0 || $progress == 100) && $state == "In Progress") {
//     $errors = "The state should not be 'In Progress' when the progress is 0 or 100.";
// } else {
//     $user_tablename = "tasks";
//     $user_tablename2 = "user_task";
//     $current_time = date("Y-m-d");
   


   

// }




}




global $i;


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
    global $issset;    if($issset==1){echo ' class="assign"';}
     ?> 
    ><a  href="/membertask.php"> Assignments</a></li>
   
    <li><a href="/searchTask.php">Ubdate Task</a></li>
    <li ><a href="/searchTaskmember.php">search Task</a></li>
   </ul>
</nav>
<main id="assign1">  

<fieldset>
<legend>Update Task</legend>
<form id="ubdate" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

<label for="task_id">Task ID</label>
<input type="text" id="task_id"  class="constant" name="task_id" value="<?php
global $i;
echo isset($_SESSION['taskid'.$i]) ? $_SESSION['taskid'.$i] : ''; ?>" readonly>
<br>
    <label for="task_name">Task Name :</label>
    <input type="text" id="task_name" class="constant" name="task_name" value="<?php echo isset($_SESSION['taskname'.$i]) ? $_SESSION['taskname'.$i] : ''; ?>" readonly>
<br>
    <label for="project_name">Project Name :</label>
    <input type="text" id="project_name"  class="constant" name="project_name" value="<?php echo isset($_SESSION['ProjectName'.$i]) ? $_SESSION['ProjectName'.$i] : ''; ?>" readonly>
    <br>
   <label for="progress">Current Progress : (<?php echo isset($_SESSION['userProgress'.$i]) ? $_SESSION['userProgress'.$i]  : ''; ?>%)</label>
   <input type="range" id="progress" name="progress" min="0" max="100" value="<?php echo  isset($_SESSION['userProgress'.$i]) ? $_SESSION['userProgress'.$i] 
    : ''; ?>">
<br>
    <label for="status">Current Status</label>
    <select aria-readonly="truex" id="statuscurnet" name="status">
        <option value="In Progress" <?= $_SESSION['userstatue'.$i]=== 'In Progress' ? 'selected' : '' ?>>In Progress</option>
        <option value="Completed" <?= $_SESSION['userstatue'.$i]=== 'Completed' ? 'selected' : '' ?>>Completed</option>
        <option value="Pending" <?= $_SESSION['userstatue'.$i] === 'Pending' ? 'selected' : '' ?>>Pending</option>
    </select>
<small></small>
    <?php
if($errors!="")
{
    echo '<small>'.$errors.'</small> ';
}


?>

<br>


<!-- 
    <button id="ubdatesubmet" type="submit">Update Task</button>
    -->
    <div id="buttuns2">
<button  id="buttunaccept">  Save Update <img width="20" height="15" src="Files/check.png" alt="true"></button>
<a id="buttunrejected2" href="/membertask.php">Cancel Update <img width="20" height="15" src="Files/delete.png" alt="false"> </a>

</div>
</form>
 
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
