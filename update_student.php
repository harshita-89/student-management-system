<?php
session_start();
if (!isset($_SESSION['username'])) {  // This prevents anyone from logging in without a username (e.g., via URL)
    header("location:login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit;
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['student_id'];
$sql = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($data, $sql);

// Check if the SELECT query executed successfully.
if (!$result) {
    die("Error in SELECT query: " . mysqli_error($data));
}

$info = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $query = "UPDATE user SET username='$name', email='$email', phone='$phone', password='$password' WHERE id='$id'";
    $result2 = mysqli_query($data, $query);
    if ($result2) {
       header("location:view_student.php");
       exit;
    } else {
       die("Update failed: " . mysqli_error($data));
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
        label {
            display: inline-block;
            width: 100px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg {
            background-color: skyblue;
            width: 500px;
            padding: 70px;
            margin: 0 auto; /* Centers the div horizontally */
        }
        .content h1 {
            text-align: center;
        }
    </style>
    
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="content">
        <h1>Update Student</h1>
        <br><br>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label for="">Username</label>
                    
                    <input type="text" name="name" value="<?php echo htmlspecialchars($info['username']); ?>" />
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($info['email']); ?>" />
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="number" name="phone" value="<?php echo htmlspecialchars($info['phone']); ?>" />
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="text" name="password" value="<?php echo htmlspecialchars($info['password']); ?>" />
                </div>
                <div style="text-align: center;">
                    <input class="btn btn-success" type="submit" name="update" value="Update">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
