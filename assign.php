<?php
session_start();
include("db.php");

$pdo = db_connect();

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Manager')
{

header("location: /login.php");

}

if(!$pdo)
{
    echo ("Null PDO Object");
    exit;
}


if(!empty($_POST))
{

$id=$_SESSION["project_id"];
    $user_tablename="project";
    $staff=$_POST['role'];
    echo $staff;
    $query = "UPDATE $user_tablename  SET Leaderid = '$staff' WHERE project_id = '$id'";
$result = $pdo->query($query);
header ( "Location:  Allocate_TeamLeader.php?");
  exit;



     







}



$user_tablename="project";
$id=$_GET['project_id'];
$_SESSION["project_id"]=$id;

$query = "SELECT * FROM $user_tablename WHERE project_id = '$id'";

$result = $pdo->query($query);
$row = $result->fetch();

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
<main id="assign">  
<form action=<?php echo $PHP_SELF.'?'.'ticketID='.$id; ?> method="post">
    <fieldset>
        <legend>Project Details</legend>
        <?php
        echo '<nav>';
        echo '<ul>';
        echo '<li><strong>Project ID :  </strong>'. $id .'</li>';
        echo '<li><strong>Project Title : </strong> ' . $row['project_title'] . '</li>';
        echo '<li><strong>Description : </strong> ' . $row['project_description'] . '</li>';
        echo '<li><strong>Customer Name : </strong> ' . $row['customer_name'] . '</li>';
        echo '<li><strong>Budget : </strong> ' . $row['total_budget'] . '</li>';
        echo '<li><strong>Start Date : </strong> '. $row['start_date'] .'</li>';
        echo '<li><strong>End Date : </strong>'. $row['end_date'] .'"</li>';
         

        echo '</ul>';
        echo '</nav>';
        ?>
    </fieldset>

    <fieldset>
        <legend>Select Team Leader</legend>
        <?php
        $tablename = "users";
        $name = "Project Leader";
        $quer = "SELECT * FROM $tablename WHERE role = '$name'";
        $resul = $pdo->query($quer);

        echo "<select name='role'>";
        while ($r = $resul->fetch()) {
            echo "<option value=".$r['id']."> ".$r['id']."-".$r['Username']."</option>";
        }
        echo "</select>";
        ?>
    </fieldset>
    
    <br>

    <input type="submit" name="submet" id="submet" value="Assign">

<a href="Files/"></a>

    <?php
          echo '<nav i>';
          echo '<ul  id="filedoc">';
         global $id;
          if ($row['file1_name'] != null) {
            echo '<li><strong>File 1 : </strong><a href="/download.php?project_id='.$id.'&name=' .($row['file1_name']) . '">' . $row['file1_name'] . '</a></li>';
        }
        
        else{
            
            echo '<li><strong>File 1 : </strong>Nofile</li>';
          

        }
        if($row['file2_name']!=null)
        {
            echo '<li><strong>File 2 : </strong><a href="/download.php?project_id='.$id.'&name=' .($row['file2_name']) . '">' . $row['file2_name'] . '</a></li>';
      


        }
        else{
            echo '<li><strong>File 2 : </strong>Nofile</li>';
          

        }
        if($row['file3_name']!=null)
        {
            echo '<li><strong>File 3 : </strong><a href="/download.php?project_id='.$id.'&name=' .($row['file3_name']) . '">' . $row['file3_name'] . '</a></li>';
      

        }
        else{
            echo '<li><strong>File 3 : </strong>Nofile</li>';
          

        }
  


        echo '</ul>';
        echo '</nav>';
        ?>



</form>

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
