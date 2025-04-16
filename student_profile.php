<?php
session_start();
if (!isset($_SESSION['username'])) {  //this prevent anyone from logging-in without a username. (like from URL)
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}
$host="localhost";
$user="root";
$password="";
$db= "schoolproject";

$data=mysqli_connect($host,$user,$password,$db);
$name = $_SESSION['username'];
$sql="SELECT* FROM user WHERE username='$name'";
$result=mysqli_query($data,$sql);
$info=mysqli_fetch_assoc($result);

if(isset($_POST['update_profile'])){
    $s_email=$_POST['email'];
    $s_phone=$_POST['phone'];
    $s_password=$_POST['password'];

    $sql2="UPDATE user SET email='$s_email', phone='$s_phone',password='$s_password' WHERE username='$name'";
    $result2=mysqli_query($data,$sql2);
    if($result2){
        header('location: student_profile.php');

    }
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
    <style>
         label {
            display: inline-block;
            width: 100px;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg {
            background-color: skyblue;
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
            margin: 0 auto; /* Centers the div horizontally */
        }
        .content h1{
            text-align: center;
        }
    </style>
   
    <title>admin home</title>
</head>
<body>
    <?php
        include 'student_sidebar.php'
    ?>
    <div class="content">
    <h1>Update Profile</h1>
        <div class="div_deg">
            <form action="#" method ="POST">

                <div>
                    <label for="">Email</label>
                    <input type="text" name ="email" value="<?php
                    echo $info['email']; ?>">
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="text" name ="phone"
                    value="<?php
                    echo $info['phone']; ?>">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="text" name ="password" value="<?php
                    echo $info['password']; ?>">
                </div>
                <div style="text-align: center;">
                    <input class="btn btn-success" type="submit" name="update_profile">
                </div>
            </form>
        </div>
    </div>


    
</body>
</html>