<?php

$db_server = "mysql:host=hosting.studentprojects.ritaj.ps;dbname=web1222300_project_dp";
$db_user = "web1222300";
$db_pass = "Q9Pu\$Cj8Tn";
// $db_server = "mysql:host=localhost;dbname=projectt";  
// $db_user = "root";
// $db_pass = "";

//header("location: /login.php");

// $query = "SELECT id,role,images,name  FROM users WHERE Username = :username and password = :pass";
// $stmt = $pdo->prepare($query);



// $stmt->bindvalue(':username',$name);
// $stmt->bindvalue(':pass', $pass);
// $stmt->execute();
// $row = $stmt->fetch(PDO::FETCH_ASSOC);

function db_connect() {
    global $db_server, $db_user, $db_pass;
    try {     
        $pdo = new PDO($db_server, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
      
        echo "Database connection failed: " . $e->getMessage();
     
        exit;
    }
}

?>