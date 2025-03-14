<?php
session_start();

$subjects = ['mathematics', 'computer science', 'physics'];

if (!isset($_SESSION['name'])&&!isset($_POST['name'])) {
  displayInitialForm($subjects);
} else {
    handleSessionState();
}
function handleInitialState() {
  global $subjects;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['subject'])) {
        
      $_SESSION['name'] = $_POST['name'];
      $_SESSION['counters'][$_POST['subject']] = 1;

}
}

function handleSessionState() {

  global $subjects;

     if(!isset($_SESSION["counters"])&&isset($_POST["name"]))
     {
      handleInitialState();   
     }else{
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject'])) {
        $selectedSubject = $_POST['subject'];
        if (isset($_SESSION['counters'][$selectedSubject])) {
            $_SESSION['counters'][$selectedSubject]++;
        } else {
            $_SESSION['counters'][$selectedSubject] = 1;
        }
        }
     }
    displayUserPage($subjects);
}

function displayInitialForm($subjects) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Initial Form</title>
    </head>
    <body>
        <form method="POST">
            Name: <input type="text" name="name" required><br>
            Favorite Subject:
            <select name="subject" required>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?= $subject ?>"><?= $subject ?></option>
                <?php endforeach; ?>
            </select><br>
            <input type="submit" value="Submit">
        </form>
    </body>
    </html>
    <?php
}

function displayUserPage($subjects) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>User Profile</title>
    </head>
    <body>
        <h1>Welcome, <?= ($_SESSION['name']) ?></h1>
        <h2>Subject Selection Counts:</h2>
        <?php foreach ($subjects as $subject): ?>
            <?php $count = $_SESSION['counters'][$subject] ?? 0; ?>
            <p><?= $subject ?>: <?= $count ?></p>
        <?php endforeach; ?>
        
        <form method="POST">
            <label>Update Favorite Subject:
            <select name="subject" required>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?= $subject ?>"><?= $subject ?></option>
                <?php endforeach; ?>
            </select>
            </label>
            <input type="submit" value="Update">
        </form>
    </body>
    </html>
    <?php
}
?>


<!-- 
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

<main id="msg">
<figure id="truecaper">


</figure> 

   <h2 id="Successful">Mohammad nemer</h2>

   
   <hr >
    <p id="iduser"><strong>The User Id is : </strong>1222300</p>

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
</html> -->
