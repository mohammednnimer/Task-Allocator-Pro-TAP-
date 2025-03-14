<?php
session_start();

include("db.php");
if(!isset($_SESSION['step'])||$_SESSION['step']!=2)
{
    header("location: /signup.php");   
}
   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $pdo = db_connect();

    if ($pdo != null) {
      
                
                    $id=generateId($pdo);
                   

                    $_SESSION["id"]=$id;
                    $name = $_SESSION["full_name"];
                    $country = $_SESSION["country"];
                    $street = $_SESSION["street"];
                    $city = $_SESSION["city"];
                    $house_no = $_SESSION["house_no"];
                    $dob = $_SESSION["dob"];
                    $id_number = $_SESSION["id_number"];
                    $email = $_SESSION["email"];
                    $telephone = $_SESSION["telephone"];
                    $role = $_SESSION["role"];
                    $qualification = $_SESSION["qualification"];
                    $skills = $_SESSION["skills"];
                    $username=$_SESSION["User_Name"];
                    $pass= $_SESSION["Password"];
                    $namefile=   null;
                    if(isset( $_SESSION["file1"]))
                    {
                        $namefile=   $_SESSION["file1"];


                    }
                     
                    







                    if( strlen($username)<6|| strlen($username)>13)
                    {

                      header("location: /Account.php");
                    exit;
                    }
                    if( strlen($pass)<8|| strlen($pass)>13)
                    {
          
                        
                      header("location: /Account.php");
                    show();
                 exit;
                    }
                    $query = "INSERT INTO users (
                        id, name, address_flat_house_no, address_street, address_city, 
                        address_country, date_of_birth, id_number, email, telephone, 
                        role, qualification, skills, Username, password,images
                    ) VALUES (
                        :id, :name, :house_no, :street, :city, 
                        :country, :dob, :id_number, :email, :telephone, 
                        :role, :qualification, :skills, :username, :password ,:images
                    )";
                    
                    $stmt = $pdo->prepare($query);
        
                    $stmt->bindParam(':id',  $_SESSION["id"]);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':house_no', $house_no);
                    $stmt->bindParam(':street', $street);
                    $stmt->bindParam(':city', $city);
                    $stmt->bindParam(':country', $country);
                    $stmt->bindParam(':dob', $dob);
                    $stmt->bindParam(':id_number', $id_number);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':telephone', $telephone);
                    $stmt->bindParam(':role', $role);
             
                    $stmt->bindParam(':qualification', $qualification);
                    $stmt->bindParam(':skills', $skills);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $pass);
                    $stmt->bindParam(':images', $namefile);

                   $stmt->execute();

                     header("location: /msgdetails.php");


                }
                else{
                    echo "Enter valid Id number";
                }
    


            
        }





    // $_SESSION["full_name"]=$_POST["full_name"];             
    // $_SESSION["country"] = $_POST["country"];
    // $_SESSION["street"] = $_POST["street"];
    // $_SESSION["city"] = $_POST["city"];
    // $_SESSION["house_no"] = $_POST["house_no"];
    // $_SESSION["dob"] = $_POST["dob"];
    // $_SESSION["id_number"] = $_POST["id_number"];
    // $_SESSION["email"] = $_POST["email"];
    // $_SESSION["telephone"] = $_POST["telephone"];
    // $_SESSION["role"] = $_POST["role"];
    // $_SESSION["qualification"] = $_POST["qualification"];
    // $_SESSION["skills"] = $_POST["skills"];

    // header("location: E:Account.php");






    //     }
    // }

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
        <li class="li"><a href="/login.php">Login</a></li>
    </ul>
</nav>
</header>

<main id="displyinfosingup">
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="Post">
        <?php

        echo "<Table>";
        echo "<thead> <tr><th>Field</th>  <th>Source</th></tr> </thead>";

echo "<tbody>";
$lastKey = key(array_slice($_SESSION, -1, 1, true));//i get tgis from WWWschol
        foreach ($_SESSION as $key => $value) {
            if ($key === $lastKey) {
                continue; 
            }
            if($key==="file1")
            {
                continue; 
            }
            echo"<tr><td>$key</td>  <td>$value</td></tr>";
        }
       echo "</tbody>";
       echo "</Table>" ;
        
        ?>
          <button id="Confirm" type="submit">Confirm</button>
 
        </form>
        </main>
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
function generateId($pdo) {
   
 
    do {
        $userId = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);//from WWW schole
 
        $query = "SELECT COUNT(*) AS count FROM users WHERE id = :user_id";
      $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $userId]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} while ($row['count'] > 0);

    return $userId;
}

?>