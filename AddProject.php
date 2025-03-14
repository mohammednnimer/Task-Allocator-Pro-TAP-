<?php

session_start();

include("db.php");

if(!isset($_SESSION["role"])||$_SESSION["role"]!='Manager')
{

header("location: /login.php");

}


$succ='';
$pdo = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    if ($pdo != null) {
        $id = $_POST['project_id'];
        $succ='';




        $title =$_POST['title'];
        $description =$_POST['description'];
        $customer_name =$_POST['customer_name'];
     




        $file1_name=null;
        $file2_name=null;
        $file3_name=null;

        if (validID($id) == 0) {


            $errors["id"]="Please enter Valid ID";
           
            show();
            exit;
        }
        if(cheackId($pdo,$id)==0)
        {
            $errors["id"]="The id is already exist in databease";   
          
            show();
            exit;
        }

        $start = new DateTime($_POST['start_date']);
        $end = new DateTime($_POST['end_date']);
        $budget = $_POST["budget"];

        if ($budget < 0) {
            unset($_POST['budget']);
        
            
            $errors["budget"]="The budget must be Greater than zero";
           
            show();
            exit;
        }

        if ($start > $end) {
            unset($_POST['start_date']);
            unset($_POST['end_date']);
        
            
            $errors["end_date"]="The start date must be before the end date";
           
         
             show();
            exit;
        }
        $start_date =$_POST['start_date'];
        $end_date =$_POST['end_date'];

    

        if (isset($_FILES["file1"]) && $_FILES["file1"]["error"] === 0) {
            $file1 = $_FILES["file1"];

            if (validFile($file1) == 0) {
                $errors["file1"]="The file1 was not accepted. File types: PDF, DOCX, PNG, JPG and Maximum file size: 2MB.";
                show();
                exit;
            }
            $photo_tmp = $_FILES['file1']['tmp_name'];
            $photo_name = $_FILES['file1']['name'];

            if (empty($_POST["file1_title"])) {
                
                $errors["file1_title"]="Title of file 1 doesn't exist";  
                show();
                exit;  
            }
          
            $file_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
            $photo_new_name = $_POST["file1_title"].".". $file_ext;
            $file1_name=$photo_new_name;
            move_uploaded_file($photo_tmp, 'Files/' . $photo_new_name);
        }

        if (isset($_FILES["file2"]) && $_FILES["file2"]["error"] === 0) {

           
      
            $file2 = $_FILES["file2"];
            if (validFile($file2) == 0) {
                $errors["file2"]="The file2 was not accepted. File types: PDF, DOCX, PNG, JPG and Maximum file size: 2MB.";
            
                show();
                exit;
            }

            $photo_tmp = $_FILES['file2']['tmp_name'];
            $photo_name = $_FILES['file2']['name'];

            if (empty($_POST["file2_title"])) {
              
                $errors["file2_title"]="Title of file 2 doesn't exist.";
     
                show();
                exit;
            }

            $file_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
            $photo_new_name = $_POST["file2_title"].".". $file_ext;
            move_uploaded_file($photo_tmp, 'Files/' . $photo_new_name);
            $file2_name=$photo_new_name;
        }


        if (isset($_FILES["file3"]) && $_FILES["file3"]["error"] === 0) {
            $file3 = $_FILES["file3"];
            if (validFile($file3) == 0) {
                $errors["file3"]="The file3 was not accepted. File types: PDF, DOCX, PNG, JPG and Maximum file size: 2MB.";
              
              
                  show();
                exit;
            }

            $photo_tmp = $_FILES['file3']['tmp_name'];
            $photo_name = $_FILES['file3']['name'];

            if (empty($_POST["file3_title"])) {
                $errors["file3_title"]="Title of file 3 doesn't exist.";
            
                show();
                exit;
            }


            $file_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
            $photo_new_name = $_POST["file3_title"].".". $file_ext;
            move_uploaded_file($photo_tmp, 'Files/' . $photo_new_name);
            $file3_name=$photo_new_name;       
       
        }

        $sql = "INSERT INTO project (
            project_id, project_title, project_description, customer_name, 
            total_budget, start_date, end_date, file1_name, file2_name, file3_name
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
           $stmt = $pdo->prepare($sql);
            $stmt->execute([
    $id, $title, $description, $customer_name,
    $budget, $start_date, $end_date,
    $file1_name, $file2_name, $file3_name
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
<div id="contener"> 

<nav id="Manager">
    <ul>
    <li ><a href="/AddProject.php">Add project</a></li>
    <li ><a href="/Allocate_TeamLeader.php">Allocate Team Leader</a></li>
    <li ><a href="/searchTaskManeger.php">search Task</a></li>
    </ul>
</nav>


<main id="artAddProject">



    <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
    <h1 id="h11">Add Project</h1>  
    
    
    <?php 
    global $succ;
    if (!empty($succ)): ?>
    <small class="success-message"><?php echo $succ; ?></small>
     <?php endif; 
?>
    <fieldset>
        <label for="project_id">Project ID:</label>
        <input type="text" <?php 
        global $errors;
        if(isset($errors["id"]))
        {
            ?>
            class ="errors"
            <?php

        }
        ?> id="project_id" name="project_id" required placeholder="Ex: MOHM-73985"
               value="<?php echo isset($_POST['project_id']) ? $_POST['project_id'] : ''; ?>">


          
           
        <label for="title">Project Title:</label>
        <input type="text" id="title" name="title" required placeholder="Enter the project title"
               value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>">
 



            </fieldset>  
            
            <?php
if(isset($errors["id"]))
        {  
            echo '<small> <span class="error" >'.$errors["id"].'</span> </small> ';
        }
 ?>

    <fieldset> 
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="1" cols="53" required placeholder="Enter Description description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
    </fieldset>

    <fieldset>
        <label for="customer_name">Customer:</label>
        <input type="text" id="customer_name" name="customer_name" required placeholder="Enter customer name"
               value="<?php echo isset($_POST['customer_name']) ? $_POST['customer_name'] : ''; ?>">
         
        <label for="budget">Total Budget:</label>
        <input type="number"
        <?php 
        if(isset($errors["budget"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?> id="budget" name="budget" required min="0" step="any" placeholder="Enter the budget"
               value="<?php echo isset($_POST['budget']) ? $_POST['budget'] : ''; ?>">
    </fieldset>

    <?php
if(isset($errors["budget"]))
        {  
            echo '<small> <span class="error" >'.$errors["budget"].'</span> </small> ';
        }
 ?>

    <fieldset>
        <label for="start_date">Start Date:</label>
        <input type="date" 
        <?php 
        if(isset($errors["end_date"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        id="start_date" name="start_date" required
               value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
          
        <label for="end_date">End  Date: </label>
        <input type="date"
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


    <fieldset>
        <label for="file1">File 1:</label>
        <input type="file" id="file1"
        <?php 
        if(isset($errors["file1"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        name="file1">
        <input type="text" 
        <?php 
        if(isset($errors["file1_title"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        name="file1_title" placeholder="Enter title for File 1"
               value="<?php echo isset($_POST['file1_title']) ? $_POST['file1_title'] : ''; ?>">
    </fieldset>


    <?php
if(isset($errors["file1"]))
        {  
            echo '<small> <span class="error" >'.$errors["file1"].'</span> </small> ';
        }
        if(isset($errors["file1_title"]))
        {  
            echo '<small> <span class="error" >'.$errors["file1_title"].'</span> </small> ';
        }
 ?>
 




    
    <fieldset>
        <label for="file2">File 2:</label>
        <input type="file"
        <?php 
        if(isset($errors["file2"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        id="file2" name="file2">
        <input type="text"
        <?php 
        if(isset($errors["file2_title"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        name="file2_title" placeholder="Enter title for File 2"
               value="<?php echo isset($_POST['file2_title']) ? $_POST['file2_title'] : ''; ?>">
    </fieldset>

    <?php
if(isset($errors["file2"]))
        {  
            echo '<small> <span class="error" >'.$errors["file2"].'</span> </small> ';
        }
        if(isset($errors["file2_title"]))
        {  
            echo '<small> <span class="error" >'.$errors["file2_title"].'</span> </small> ';
        }
 ?>
 


    <fieldset>
        <label for="file3">File 3:</label>
        <input type="file"
        <?php 
        if(isset($errors["file3"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        id="file3" name="file3">
        <input type="text"
        <?php 
        if(isset($errors["file3_title"]))
        {
            ?>
            class ="errors";
            <?php
            
        }
        ?>
        name="file3_title" placeholder="Enter title for File 3"
               value="<?php echo isset($_POST['file3_title']) ? $_POST['file3_title'] : ''; ?>">
    </fieldset>

    <?php
if(isset($errors["file3"]))
        {  
            echo '<small> <span class="error" >'.$errors["file3"].'</span> </small> ';
        }
        if(isset($errors["file3_title"]))
        {  
            echo '<small> <span class="error" >'.$errors["file3_title"].'</span> </small> ';
        }
 ?>
 


    <button id="addproject" type="submit">Add Project</button>
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

   
    $allowed = ['png', 'docx', 'pdf', 'jpg'];
    $fileEx = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileEx, $allowed)) {
   
        return false;
    }
   
   
    return true;
}

function cheackId($pdo,$id) {

    $query = "SELECT project_id FROM project WHERE project_id = :id";
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
function validID($projectID) {
    if (preg_match("/^[A-Za-z]{4}-\d{5}$/", $projectID)) {
        return true;
    } else {
        return false;
    }
}


?>
