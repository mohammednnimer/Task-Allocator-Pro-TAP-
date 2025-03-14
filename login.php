<?php


session_start();
session_unset();
session_destroy();
session_start();

include("db.php");





$pdo = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
   

    if ($pdo != null) {
        if (isset($_POST["User_Name"]) && isset($_POST["Password"])) {
            $name=$_POST["User_Name"];
            $pass=$_POST["Password"];
        
    
        

     if(cheackname($pdo,$name,$pass)){
      
        
        if($_SESSION["role"]=="Project Leader")
        {
            header("location: /createTask.php");
        }
        else if($_SESSION["role"]=="Team Member"){

            header("location: /memberTask.php");
        }
        else{
            header("location: /AddProject.php");
        }


       
    }
    show();



           }


          



        }
    }
    else{
        show();
        exit;
    }


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

<nav>
<ul>
   <a id="signup" href="/Sing-up.php">sign-up</a>
    <!-- <li>Login</li>
    <li>logout</li> -->
</ul>


</nav>

</header>


    <article id="article"> 
        <img  id="imglog" width="400" height="500" src="./Files/photo_updated (2).png" alt="">

        <form class="reg1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h2>Log in to Account</h2>
            <br>
            <br>
            <br>
           <br>
            <br>
            <label for="User_Name">User Name: </label>
            <input class="acc2"  type="text" id="User_Name" name="User_Name" required>

            <br>
            <br>
          
           
            <label for="Password: ">Password</label>
            
            <input class="acc2"   type="password" id="Password" name="Password" required>
            <br>
         
           
            <button class="acc2" type="submit">submit</button>
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



function validname($username) {
    if (strlen($username) < 6 || strlen($username) > 13) {
        return false;
     }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {//from wwwchoole
      
        return false;
    }

    return true;
}

function validPass($password) {
    if (strlen($password) < 8 || strlen($password) > 12) {
        return false;
    }
    if (!preg_match('/[a-zA-Z]/', $password)) {
        return false ;
    }
    if (!preg_match('/[0-9]/', $password)) {
    
        return false;
    }
    return true;
}





function cheackname($pdo,$name,$pass) {


    
      $query = "SELECT id,role,images,name  FROM users WHERE Username = :username and password = :pass";
      $stmt = $pdo->prepare($query);



      $stmt->bindParam(':username',$name);
      $stmt->bindParam(':pass', $pass);
      $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row)
 {
    $_SESSION["role"]=$row['role'];
    $_SESSION["loginid"]=$row['id'];
    $_SESSION["images"]=$row['images'];
    $_SESSION["name"]=$row['name'];

    return true;
 } 
 echo "nooooooo";
    return false;
}



?>