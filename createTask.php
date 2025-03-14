<?php

session_start();
if(!isset($_SESSION["role"])||$_SESSION["role"]!='Project Leader')
{
header("location: /login.php");
}

include("db.php");

if(!isset($_SESSION["loginid"]))
{
    header("location: /login.php");
}


$pdo = db_connect();


    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            if ($pdo != null) {

         $id = $_POST['Task_id'];
        if(cheackId($pdo,$id)==0)
        {
            $errors["id"]="The id is already exist in databease";    
            show();
            exit;
        }

        $start = new DateTime($_POST['start_date']);
        $end = new DateTime($_POST['end_date']);
  
       
      
       
      

        if ($start > $end) {
            unset($_POST['start_date']);
            unset($_POST['end_date']);
        
            $errors["start_date"]="The budget must be Greater than zero";
            $errors["end_date"]="The start date must be before the end date";
            show();
            exit;
        }
        $start_date =$_POST['start_date'];
        $end_date =$_POST['end_date'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        $projectName=$_POST["projectName"];
        $Effort=$_POST["Effort"];
        $Status=$_POST["status"];
        $Priority=$_POST["priority"];


    
        $sql = "INSERT INTO tasks (
            TaskID, TaskName, Description, ProjectID, 
            StartDate, 	EndDate, Effort, Status, Priority, Progress
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
           $stmt = $pdo->prepare($sql);
            $stmt->execute([
    $id, $name, $description, $projectName,
    $start_date, $end_date, $Effort,
    $Status, $Priority,0
          ]);
          $succ="The entry process was completed successfully";
     

          unset($_POST);


    }





}
show();

function show() {
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

    <figure >

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
<div id="contener"> 

<nav id="Manager">
    <ul>
    <li><a href="/ListOfproject.php">List of Project</a></li>
    <li><a href="/CreateTask.php">Create Task</a></li>
    <li ><a href="/searchTaskleader.php">search Task</a></li>
    <!-- <li ><a href="/listofTasks.php">Task Details</a></li> -->
 
</ul>
</nav>

<main id="artAddProject">



    <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
    <h1 id="h11">Create Task</h1>   
    <?php 
    global $succ;
    if (!empty($succ)): ?>
    <small class="success-message"><?php echo $succ; ?></small>
     <?php endif; 
?>
    <fieldset class='createtask'>
        <label for="project_id">Project ID:</label>
        <input id="prioritycratetask" type="number" <?php 
        global $errors;
        if(isset($errors["id"]))
        {
            ?>
            class ="errors";
            <?php
        }
        ?> id="Task_id" name="Task_id" required placeholder="Ex:98364"
               value="<?php echo isset($_POST['project_id']) ? $_POST['project_id'] : generateId(); ?>">
          
        <label for="title">Task Name:</label>
        <input id="prioritycratetask" type="text" id="title" name="name" required placeholder="Enter the Task Name"
               value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
   
               
            </fieldset>  

    <fieldset class='createtask'> 
        <label for="description">Task Description:</label>
        <textarea id="description" name="description" cols="46" required placeholder="Enter description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
    </fieldset>

    <fieldset class='createtask'>
        <label for="start_date">Start Date:</label>
        <input id="prioritycratetask" type="date" 
        <?php 
        if(isset($errors["start_date"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        id="start_date" name="start_date" required
               value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
          
        <label for="end_date">End Date:</label>
        <input id="prioritycratetask" type="date"
        <?php 
        if(isset($errors["end_date"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        id="end_date" name="end_date" required
               value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
    </fieldset>

    <?php
if(isset($errors["end_date"]))
        {  
            echo '<small> <span class="error" >'.$errors["end_date"].'</span> </small> ';
        }
 ?>

    <fieldset class='createtask'>
        <label for="Project">Project :</label>
       <?php


global $pdo;
        $tablename = "project";
         $name = $_SESSION["loginid"];
         $quer = "SELECT * FROM $tablename WHERE Leaderid  = '$name'";
         $resul = $pdo->query($quer);


echo "<select id='prioritycratetask' name='projectName' required>";
while ($r = $resul->fetch()) {
    echo "<option value=".$r['project_id']."> ".$r['project_title']."</option>";
}
echo "</select>";
         ?>

        
         
        <label class="shift" for="Effort">Project Effort:</label>
        <input  id="prioritycratetask"type="number"
        <?php 
        if(isset($errors["Effort"]))
        {
            ?>
            class ="errors";
            <?php
        }
        ?> id="budget" name="Effort" required min="0" step="any" placeholder="Enter the Effort"
               value="<?php echo isset($_POST['budget']) ? $_POST['budget'] : ''; ?>">
    </fieldset>



    <fieldset class='createtask'>
        <label for="Status">Stattus  :</label>
    
        <select id="prioritycratetask" name="status" required>
            <option value="Pending" selected>Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>
        <label class="shift" for="priority">Task Priority:</label>
        <select id="prioritycratetask" name="priority" required>
            <option value="Low">Low</option>
            <option value="Medium" selected>Medium</option>
            <option value="High">High</option>
        </select>
            
    
    </fieldset>


    <button id="submetcreatetask" type="submit">Submit</button>
</form>

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
}

function validFile($file) {
    


    $maxFileSize = 2 * 1024 * 1024;

    if ($file['size'] > $maxFileSize) {
      
        return false;
    }

    $allowed= ['png', 'docx', 'pdf', 'jpg'];
    $fileEx = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileEx, $allowed)) {
      
        return false;
    }
   
    return true;
}

function cheackId($pdo,$id) {

    $query = "SELECT TaskID FROM tasks WHERE TaskID = :id";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':id',$id);
  $stmt->execute();
  
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row)
{
return false;
} 
return true;
}




function generateId() {
   
 global $pdo;
    do {
        $userId = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);//from WWW schole
 
        $query = "SELECT COUNT(*) AS count FROM tasks WHERE TaskID = :user_id";
      $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $userId]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} while ($row['count'] > 0);

return $userId;

}

?>

