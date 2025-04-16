<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="classroom.jpg" class="body_bg" style=" background-repeat: no-repeat; background-attachment: fixed; background-size:100%">
<div id="form-container"  style="margin:170px auto">
            <div class="form-wrap">
                <h1>Login form</h1>
                <h4><?php
                error_reporting(0);
                session_start();
                session_destroy();
                echo $_SESSION['loginMessage']; ?>
                </h4>
                
                <form action="login_check.php" method="POST">
                    <div class="form-group" style="display:flex">
                        <label for="" style="align-self:center; padding-right:10px">Username </label>
                        <input type="text" name="username">
                    </div>
                    <div class="form-group" style="display:flex">
                	    <label for="" style="align-self:center; padding-right:10px">Password </label>
                        <input type="Password" name="password">
                    </div>
                    
                    <div class="form-group">
            		        <button>login</button>
                    </div>
			    </form>
            </div>
        </div>

</body>
</html> 