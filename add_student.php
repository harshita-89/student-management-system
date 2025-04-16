<?php
session_start();
if (!isset($_SESSION['username'])) {  //this prevent anyone from logging-in without a username. (like from URL)
    header("location:login.php");
}
elseif($_SESSION['usertype']=='student') {
        header("location:login.php");
}


$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host,$user,$password,$db);
// Check connection
if(isset($_POST['add_student'])){
    $username=$_POST['name'];
    $user_email=$_POST['email'];
    $user_phone=$_POST['phone'];
    $user_password=$_POST['password'];
    $usertype="student";

    //check for duplicate entry
    $check = "SELECT * FROM user WHERE username= '$username'";
    $check_user = mysqli_query($data, $check);

    $row_count= mysqli_num_rows($check_user);
    if($row_count==0){

    $sql= "INSERT INTO user (username, email, phone, usertype, password) 
    VALUES ('$username', '$user_email','$user_phone', '$usertype','$user_password')";

    $result=mysqli_query($data,$sql);
    if($result){
        echo "Student Added Successfully";
    }
    else{
        echo "Error";
    }
}
else {
    echo "<script>
    alert('Username already exists. Try another one');
    </script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <style>
        label{
            display: inline-block;
            width: 100px;
            text-align:right;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_design{
            background-color: skyblue;
            width: 400px;
            padding-bottom: 70px;
            padding-top: 70px;
        }
        .content{
            margin-top:5%;
            margin-left: 45%!important; 
        }
        

    </style>
    <?php
    include 'admin_css.php';
    ?> 
</head>

<body>
    <?php
    include 'admin_sidebar.php';
    ?>
    <div class="content">

        <h1>Add Student</h1>
        <div class="div_design">
            <form action="#" method="POST">
                <div>
                <label for="username">Username</label>
                <input type="text"  name="name" placeholder="Enter username">
                </div>
                
                <div>
                <label for="email">Email</label>
                <input type="email"  name="email" placeholder="Enter Email">
                </div>
                
                <div>
                <label for="phone">Phone</label>
                <input type="number" name="phone" placeholder="Enter yor phone number">
                </div>
                
                <div>
                <label for="password">Password</label>
                <input type="text"  name="password" placeholder="Enter Password">
                </div>

                <div class="stdnt_btn" style="position:relative; left:35%;">
                    <input type="submit" class="btn btn-primary" value="Add Student" name="add_student"> 
                </div>
                
                
            </form>
        </div>
        </div>
    
</body>
</html>