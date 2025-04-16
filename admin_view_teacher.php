<?php
session_start();
if (!isset($_SESSION['username'])) {  
    header("location:login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $pass, $db);

$sql = "SELECT * FROM teacher";
$result = mysqli_query($data, $sql);

if (isset($_GET['id'])) {  // Check if 'id' is passed in the URL
    $t_id = $_GET['id'];
    $sql2 = "DELETE FROM teacher WHERE id='$t_id'";  // Ensure the column name is correct
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        echo "<script>alert('Teacher removed successfully');</script>";
        header('location:admin_view_teacher.php');
        exit;
    } else {
        echo "<script>alert('Error removing teacher');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <?php include 'admin_css.php'; ?>
    <style>
        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #444;
        }

        th {
            background-color: skyblue;
            color: white;
            padding: 12px;
            text-align: center;
        }

        td {
            background-color: #f9f9f9;
            padding: 10px;
            text-align: center;
        }

        td img {
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    
    <div class="content">
        <h1>View All Teachers</h1>
        <table>
            <tr>
                <th>Teacher Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php while ($info = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $info['name']; ?></td>
                    <td><?php echo $info['description']; ?></td>
                    <td><img src="<?php echo $info['image']; ?>" width="100" height="100"></td>
                    <td>
                        <a class="btn btn-danger" href="admin_view_teacher.php?id=<?php echo $info['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this teacher?');">
                            Delete
                        </a>
                    </td>
               
                    <td>
                        <a class="btn btn-success" href="admin_update_teacher.php?id=<?php echo $info['id']; ?>">
                            Update
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
