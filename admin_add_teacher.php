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

$data=mysqli_connect($host, $user, $password, $db);
if(isset($_POST['add_teacher']))
{
    $t_name=$_POST['name'];
    $t_description=$_POST['description'];
    $file=$_FILES['image']['name'];
    $dst = "./image/".$file;  
    $dst_db = "image/".$file;  // Ensure correct folder structure
    
    // move_uploaded_file($_FILES['image']['tmp_name'],$dst);
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    
    
    $sql="INSERT INTO teacher (name,description,image) VALUES ('$t_name','$t_description','$dst_db')";
    $result=mysqli_query($data,$sql);
    
    if($result){
        header('location:admin_add_teacher.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin home</title>
    <?php
    include 'admin_css.php';
    ?>
    <style>
        label{
            display: inline-block;
            width: 100px;
            text-align:left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_design{
            background-color: skyblue;
            width: 400px;
            padding-left: 40px ;
            padding-bottom: 70px;
            padding-top: 70px;
        }
        
        .content{
            margin-top:5%;
            margin-left: 45%!important; 
        }
       
    </style>
    
</head>
<body>
    <?php
    include 'admin_sidebar.php';
    ?>
    <div class="content">
        <h1>Add Teacher</h1>
        
        <div class="div_design">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div >
                    <label for="tname">Teacher name:</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label for="desig">Description:</label>
                    <input type="text" name="description">
                </div>
                <div>
                    <label>Image:</label>
                    <input type="file" name="image" >
                </div>
                <br>
                
                <div class="add_btn" style="position:relative; left:35%;">
                    <input type="submit" class="btn btn-primary" value="Add Teacher" name="add_teacher">
                </div>
                
            </form>
        </div>
        </div>
    
</body>
</html>