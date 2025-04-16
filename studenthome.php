<?php
session_start();
if (!isset($_SESSION['username'])) {  //this prevent anyone from logging-in without a username. (like from URL)
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include 'student_css.php'
    ?>
   
    <title>admin home</title>
</head>
<body>
    <?php
        include 'student_sidebar.php'
    ?>

    <div class="content">
        
        <h1>Welcome to your dashboard</h1>
        
    </div>
    
</body>
</html>