<?php
session_start();
if (!isset($_SESSION['username'])) {  
    header("location:login.php");
    exit;
} elseif($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit;
}
//only admin can access this page
        $host="localhost";
        $user="root";
        $password="";
        $db="schoolproject";

        $data =mysqli_connect($host,$user, $password,$db);

        $sql= "SELECT * FROM user WHERE usertype ='student' ";
        $result = mysqli_query($data, $sql);

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
        .table_th{
            background-color: white;
            padding: 20px;
            font-size: 20px;
        }
        .table_data{
            padding: 20px;
            background-color: skyblue;
        }
    </style>
    
</head>
<body>
    <?php
    include 'admin_sidebar.php';
    ?>
    <div class="content">
        <h1>Student data</h1>
        <!-- <?php 

        // if($_SESSION['message']){
        //     echo $_SESSION['message'];
        // }
        // unset($_SESSION['message']);
        // ?> -->

        <br><br>
        <table border="1px">
            <tr>
                <th class="table_th">Student name</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Password</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>

            <?php
            while($info = $result->fetch_assoc())
            {
            ?>
            <tr>
                <td class ="table_data">
                    <?php 
                    echo "{$info ['username']}";
                    ?>
                </td>
                <td class ="table_data">
                    <?php 
                    echo "{$info ['email']}";
                    ?>
                </td>
                <td class ="table_data">
                    <?php 
                    echo "{$info ['phone']}";
                    ?>
                </td>
                <td class ="table_data">
                    <?php 
                    echo "{$info ['password']}";
                    ?>
                </td>
                <td class ="table_data">
                    <?php 
                    echo "<a class='btn btn-danger'
                    onClick=\" javascript:return confirm('Are you sure, you want to delete the student?'); \" 
                    href ='delete.php?student_id={$info['id']}'>
                    Delete 
                    </a>";
                    ?>
                </td>
                <td class ="table_data">
                    <?php 
                    echo "<a class='btn btn-primary'
                    href ='update_student.php?student_id={$info['id']}'>
                    Update 
                    </a>";
                    ?>
                </td>
            </tr>

            <?php
            }
            ?>
        </table>
    </div>
    
</body>
</html>