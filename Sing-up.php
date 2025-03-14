<?php
session_start();
session_unset();
session_destroy();
session_start();

include("db.php");

$pdo=db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {


      if(cheacknIdnumber($pdo,$_POST["id_number"])==0)
      {
        $errors["validname"]="the Id number is already in databease ";
          show();
           exit;
}


    $_SESSION["full_name"]=$_POST["full_name"];             
    $_SESSION["country"] = $_POST["country"];
    $_SESSION["street"] = $_POST["street"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["house_no"] = $_POST["house_no"];
    $_SESSION["dob"] = $_POST["dob"];
    $_SESSION["id_number"] = $_POST["id_number"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["telephone"] = $_POST["telephone"];
    $_SESSION["role"] = $_POST["role"];
    $_SESSION["qualification"] = $_POST["qualification"];
    $_SESSION["skills"] = $_POST["skills"];



    if(isset($_FILES["file1"]))
    {
        if ($_FILES["file1"]["error"] == 0) {

            $filename = $_FILES["file1"]["name"];
            $fileTmpName = $_FILES["file1"]["tmp_name"];
            $fileSize = $_FILES["file1"]["size"];
            $fileType = $_FILES["file1"]["type"];
        
            $uploadDir = 'Files/';
            $uploadPath = $uploadDir . $filename; // سيتم تخزين الملف بنفس اسمه
        
             if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            move_uploaded_file($fileTmpName, $uploadPath) ;
              
        
            $_SESSION["file1"] =   $filename; 
        
        }
    
    
                       if(!is_numeric($_POST["id_number"]))
                    {
    
                 show();
                  
                
                
                }
    }

  

            $_SESSION['step']=1;
    header("location: /Account.php");





    // $pdo = db_connect();

    // if ($pdo != null) {
    //     if (isset($_POST["full_name"]) && isset($_POST["country"]) && isset($_POST["street"]) && isset($_POST["city"]) && isset($_POST["house_no"])
    //         && isset($_POST["dob"]) && isset($_POST["id_number"]) && isset($_POST["email"])
    //         && isset($_POST["telephone"]) && isset($_POST["role"]) && isset($_POST["qualification"]) && isset($_POST["skills"])) {

    //             if(is_numeric($_POST["id_number"]))
    //             {

    //                 $name = $_POST["full_name"];
    //                 $country = $_POST["country"];
    //                 $street = $_POST["street"];
    //                 $city = $_POST["city"];
    //                 $house_no = $_POST["house_no"];
    //                 $dob = $_POST["dob"];
    //                 $id_number = $_POST["id_number"];
    //                 $email = $_POST["email"];
    //                 $telephone = $_POST["telephone"];
    //                 $role = $_POST["role"];
    //                 $qualification = $_POST["qualification"];
    //                 $skills = $_POST["skills"];
        
    //                 $query = "INSERT INTO users(name, address_flat_house_no, address_street, address_city, address_country,
    //                                            date_of_birth, id_number, email, telephone, role, qualification, skills)
    //                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
    //                 $stmt = $pdo->prepare($query);
    //                 $stmt->execute([$name, $house_no, $street, $city, $country, $dob, $id_number, $email, $telephone, $role, $qualification, $skills]);
    //             }
    //             else{
    //                 echo "Enter valid Id number";
    //             }




    //     }
    // }
}
show();


function show()
{



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Document</title>
</head>
<body>
<header>

<h1>Task Allocator Pro (TAP)</h1>
<nav id="account">
    <ul>

    <a id="signup" href="/login.php">Login</a>
    </ul>
</nav>
</header>
    <article id="art"> 
        <img id="imgsignup" class="reg" width="400" height="600" src="photo.png" alt="">
        <form id="signupform" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            
        <h2>Create Account</h2>
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="country">Country</label>
            <input type="text" id="country" name="country" required>

            <label for="street">Street</label>
            <input type="text" id="street" name="street" required>

            <label for="city">City</label>
            <input type="text" id="city" name="city" required>

            <label for="house_no">House No or Flat</label>
            <input type="text" id="house_no" name="house_no" required>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>
            <?php
global $errors;
if(isset($errors["validname"]))
{  
echo '<small> <span class="error" >'.$errors["validname"].'</span> </small> ';
}
?>
            <label for="id_number">ID Number</label>
            <input type="number" id="id_number"     name="id_number"   required pattern="\d{9}>

            <label for="email">Email address</label>
            <input type="email" id="email" name="email" required>

            <label for="telephone">Telephone</label>
  <input type="tel" id="telephone" name="telephone" required minlength="10" maxlength="10" pattern="\d{10}" >


            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="Manager">Manager</option>
                <option value="Project Leader">Project Leader</option>
                <option value="Team Member">Team Member</option>
            </select>

            <label for="qualification">Qualification</label>
            <input type="text" id="qualification" name="qualification" required>

            <label for="skills">Skills</label>
            <textarea id="skills" name="skills" rows="2" required></textarea>
            <label for="file">Image(optional) :</label>
            <input type="file" name="file1">

            <button type="submit">Submit</button>
        </form>
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
function cheacknIdnumber($pdo,$name) {
       
    $query = "SELECT COUNT(*) AS count FROM users WHERE id_number = :user_id";
  $stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $name]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if( $row['count'] == 0)
return true;

return false;
}
?>