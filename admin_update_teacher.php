<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {  
    header("location:login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit;
}
    $host="localhost";
    $user="root";
    $pass="";
    $db="schoolproject";
    $data=mysqli_connect($host,$user,$pass,$db);
    if($_GET['id']){
        $t_id=$_GET['id'];
        $sql="SELECT * FROM teacher WHERE id='$t_id' ";
        $result=mysqli_query($data,$sql);
        $info=$result->fetch_assoc();
    }
    if(isset($_POST['update_teacher'])){
        $t_id=$_POST['id'];
        $t_name=$_POST['name'];
        $t_description=$_POST['description'];
        $file=$_FILES['image']['name'];
        $dst="./image/".$file;
        $dst_db="image/".$file;
        
        move_uploaded_file($_FILES['image']['tmp_name'],$dst);
        
        if($file){
            $sql2="UPDATE teacher SET name='$t_name',description='$t_description',image='$dst_db' WHERE id='$t_id'";
        }
        else{
            $sql2="UPDATE teacher SET name='$t_name',description='$t_description' WHERE id='$t_id'";
        }
        
        $result2=mysqli_query($data,$sql2);
        
        if ($result2) {
            
            header('location:admin_view_teacher.php');
            echo "<script>alert('Teacher information Updated successfully');</script>";
            exit;
        } else {
            echo "<script>alert('Error updating the details');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher</title>
    <?php include 'admin_css.php'; ?>
    <style>
        .update-form {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .old-image {
            display: block;
            margin-top: 10px;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn-submit {
            background-color: skyblue;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            display: block;
            width: 100%;
            text-align: center;
        }

        .btn-submit:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <h1>Update Teacher</h1>

        <form class="update-form" action="admin_update_teacher.php" method="POST" enctype="multipart/form-data">
            
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>"> 
            
            <label>Teacher Name:</label>
            <input type="text" name="name" value="<?php echo "{$info['name']}";?>" >

            <label>About Teacher:</label>
            <input type="text" name="description" value="<?php echo "{$info['description']}"; ?>">

            <label>Teacher Old Image:</label>
            <img src="<?php echo "{$info['image']}"; ?>" class="old-image" alt="Old Image">

            <label>Teacher New Image:</label>
            <input type="file" name="image">

            <input type="submit" class="btn-submit" value="Update Teacher" name="update_teacher">
        </form>
    </div>
</body>
</html>
