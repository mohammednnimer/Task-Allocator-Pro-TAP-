<?php
session_start();
include("db.php");

if(!isset($_SESSION['step']))
{
    header("location: /signup.php");   
}





if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $pdo = db_connect();

    if ($pdo != null) {
        if (isset($_POST["User_Name"]) && isset($_POST["Password"]) && isset($_POST["Confirm"])) {

            $name=$_POST["User_Name"];

            $pass=$_POST["Password"];
            $conf=$_POST["Confirm"];
           
          if(!validname($name)==0||validPass($pass)==0||cheackname($pdo,$name)==0||$pass!= $conf||strlen($name)<6|| strlen($name)>13
         || strlen($pass)<8|| strlen($pass)>13 )
         {
            if(!validname($name)==0)
            {
       
       $errors['validname']="please enter valid user name with 6-12 char ";
      
            }
            if(validPass($pass)==0)
            {
                $errors['validpassword']="please enter valid password with 6-12 char and should number and charr ";
      
             
            }
            if(cheackname($pdo,$name)==0){
                $errors['validname']="he user name is already in database enter a new user name";
              
            }
       
       
       
       
                  if($pass!= $conf)
                  {
                  $errors['validpassword']="The password and the confirmation word are not the same";
      
                
                 
                  }






          //from PHP.net 
                 if( strlen($name)<6|| strlen($name)>13)
                 {
       
              
                   $errors['validname']="The number of characters in the username is invalid. It should be greater than 5 and less than 14 ";
              
                    
                 }
                 if( strlen($pass)<8|| strlen($pass)>13)
                 {
       
                   $errors['validpassword']="The number of characters in the password is invalid. It should be greater than 7 and less than 14 ";
      
               
                 }
                 show();
                 exit;
       
         }else{
            $_SESSION["User_Name"]=$name;
            $_SESSION["Password"]=$pass;
            $_SESSION['step']=2;
            header("location: ./Confirmation.php");

         }
            


      
          
         
          


            // if(is_numeric($_POST["id_number"]))
            // {

            //     $name = $_POST["full_name"];
            //     $country = $_POST["country"];
            //     $street = $_POST["street"];
            //     $city = $_POST["city"];
            //     $house_no = $_POST["house_no"];
            //     $dob = $_POST["dob"];
            //     $id_number = $_POST["id_number"];
            //     $email = $_POST["email"];
            //     $telephone = $_POST["telephone"];
            //     $role = $_POST["role"];
            //     $qualification = $_POST["qualification"];
            //     $skills = $_POST["skills"];
    
            //     $query = "INSERT INTO users(name, address_flat_house_no, address_street, address_city, address_country,
            //                                date_of_birth, id_number, email, telephone, role, qualification, skills)
            //               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            //     $stmt = $pdo->prepare($query);
            //     $stmt->execute([$name, $house_no, $street, $city, $country, $dob, $id_number, $email, $telephone, $role, $qualification, $skills]);
            // }
            // else{
            //     echo "Enter valid Id number";
            // }

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
<nav id="account">
    <ul>
        <li class="li"><a href="./login.php">Login</a></li>
    </ul>
</nav>
</header>
    <article> 
        <img class="username" id="img" width="400" height="600" src="./Files/photo_updated (2).pngg" alt="">

        <form class="username" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h2>Create Account</h2>
            <br>
            <br>
            <label for="User_Name">User Name: </label>
            <input class="acc2" type="text" id="User_Name" name="User_Name" required>
            <?php
            global $errors;
if(isset($errors["validname"]))
        {  
            echo '<small> <span class="error" >'.$errors["validname"].'</span> </small> ';
        }
 ?>
           
            <br>
            <br>
      
            <label for="Password">Password</label>
            
            <input class="acc2" type="password" id="Password" name="Password" required>


            <br>
            <br>
          
            <label for="Confirmation">Password Confirmation</label>
            
            <input class="acc2" type="password" id="Confirmation" name="Confirm" required>
            <?php
            global $errors;
if(isset($errors["validpassword"]))
        {  
            echo '<small> <span class="error" >'.$errors["validpassword"].'</span> </small> ';
        }
 ?>
            <br>
            <br>
   
         
           
            <button id="Confirmationusername" type="submit">Proceed to Confirmation</button>
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





function cheackname($pdo,$name) {
   
 
       
        $query = "SELECT COUNT(*) AS count FROM users WHERE Username = :user_id";
      $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $name]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

if( $row['count'] == 0)
  return true;

    return false;
}




?>