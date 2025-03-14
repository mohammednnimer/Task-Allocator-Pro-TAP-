<?php

session_start();
if(!isset($_SESSION["role"])||$_SESSION["role"]!='Project Leader')
{
header("location: /login.php");
}
include("db.php");

$pdo = db_connect();

if(isset($_GET['Task_id'])&& $_GET['Taskname'])
{
    $tastid = $_GET['Task_id'];
   $taskname=$_GET['Taskname'];
    $_SESSION['Task_id']= $tastid ;
    $_SESSION['Taskname']= $taskname;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    if ($pdo != null) {
        $taskid = $_POST['taskid'];
        $start_date =$_POST['start_date'];
        $userid=$_POST['member'];
        $Percentage =$_POST['Percentage'];
        $role=$_POST['role'];
        

        if ($Percentage > 100||$Percentage<0) {
            unset($_POST['budget']);
            $errors["Percentage"]="The budget must be Greater than zero and least than 100";
            show();
            exit;
        }
        if (datevalied($start_date)==0) {
            unset($_POST['start_date']);
            $errors["start_date"]="The date must be after the start date date of task";
            show();
            exit;
        }
        if(validPes($Percentage)!='succ')
        {
            unset($_POST['Percentage']);
            $errors["Percentage"]=validPes($Percentage);
            show();
            exit;
        }

        $sql = "INSERT INTO user_task (
            id_user , 	id_tasks, Start_Date, 
            Role, Contribution	
        ) VALUES (?, ?, ?, ?, ?)";
           $stmt = $pdo->prepare($sql);
            $stmt->execute([
    $userid,  $taskid, $start_date ,$role,
    $Percentage ] );
    header("location: /anutherTeamMemeber.php");
   
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
    <li><a href="/ListOfproject.php">List of Project</a></li>
    <li><a href="/CreateTask.php">Create Task</a></li>
    <li ><a href="/searchTaskleader.php">search Task</a></li>   
    <!-- <li ><a href="/listofTasks.php">Task Details</a></li> -->
</ul>
</nav>

<main id="artAddmember">
<?php

global $errors;
        
?>

<h1 id="h12">Set Member</h1> 
    <form method="POST" id="formmember" action="<?php $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
    <fieldset class="formmember"> 
   
        <label for="Task Id">Task ID:  </label>
        <input type="text" class="constant" name="taskid" value="<?php $id=$_GET['Task_id'];echo $id; ?>" id="taskid" readonly>
          
        <label for="title">Task Name:</label>
        <input type="text" class="constant" id="taskname" value="<?php $name=$_GET['Taskname'];echo $name; ?>"  readonly>
       


        <label for="start_date">Start Date:</label>
        <input type="date"   id="taskdatestart"
        <?php 
        if(isset($errors["start_date"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
       name="start_date" required  value="<?php $currentDate = date("Y-m-d");
        echo isset($_POST['start_date']) ? $_POST['start_date'] : $currentDate; ?>">
          
    
   
            <?php
if(isset($errors["start_date"]))
        {  
            echo '<small> <span class="error" >'.$errors["start_date"].'</span> </small> ';
        }
 ?>



        
        <label for="start_date">Team Member:</label>  
        <?php
        global $pdo;
        $tablename = "users";
        $name = "Team Member";
        $quer = "SELECT * FROM $tablename where role='$name'";
        $resul = $pdo->query($quer);

        echo "<select id='number' name='member'>";
        while ($r = $resul->fetch()) {
            echo "<option value=".$r['id']."> ".$r['name']."</option>";
        }
        echo "</select>";
        ?>
      
        <label for="role">Role Member :</label>  
    <select name="role" id="number">

    <option value="Developer" select>Developer</option>
    <option value="Designer">Designer</option>
    <option value="Tester">Tester</option>
    <option value="Analyst">Analyst</option>
    <option value="Support">Support</option>
    </select>



        
        <label for="number">Contribution : </label>  
        <input type="number" <?php
        if(isset($errors["Percentage"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        name="Percentage" required id="number" max="100" min="1">
        </fieldset>
        <?php
if(isset($errors["Percentage"]))
        {  
            echo '<small> <span class="error" >'.$errors["Percentage"].'</span> </small> ';
        }
 ?>
 


    <button id="addmemeber" type="submit">Submet</button>
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
function datevalied($start_date)
{


global $pdo;

    $user_tablename="tasks";

    $tastid=$_GET['Task_id'];
 $query = "SELECT * FROM $user_tablename WHERE TaskID = '$tastid'";

   global $pdo; 
    $result = $pdo->query($query);

    $row=$result->fetch();

    if($row)
    {
      $Date1=new DateTime($start_date);
      $Date2=new DateTime($row['StartDate']);
        if($Date1>$Date2)
        {
          return true;
        }
    }
           return false;
}


function validPes($pars)
{
    global $pdo;

    $user_tablename = "user_task";
    $tastid = $_GET['Task_id'];
  



    $query = "SELECT SUM(Contribution) as total_contribution FROM $user_tablename WHERE id_tasks = :taskid";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['taskid' => $tastid]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $current_total = $result['total_contribution'] ?? 0; //from php study
   if ($current_total + $pars <= 100) {
        return "succ";
    } else {
        $remaining = 100 - $current_total;
        return "Sorry, but the remaining percentage of the work is " . $remaining . "%.";
    }
}


?>
