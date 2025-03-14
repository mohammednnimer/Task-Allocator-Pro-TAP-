<?php
session_start();


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
      <a  id="signup" href="./login.php">Login</a>
    </ul>
</nav>
</header>

<main id="msg">
<figure id="truecaper">
<img id="trueimg" src="./Files/check.png" alt="true">

</figure> 

   <h2 id="Successful">Registration Successful! </h2>

   
   <hr >
    <p id="iduser"><strong>The User Id is : </strong><?php
    
    echo $_SESSION["id"];
  
    
    
    
    ?></p>

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
