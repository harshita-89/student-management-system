<?php
    error_reporting(0);
    session_start();
    session_destroy();
    if($_SESSION['message']){
        $message =$_SESSION['message'];
        echo"<script type='text/javascript'>
        alert('$message');
        </script>";        
    }
    $host="localhost";
    $user="root";
    $pass="";
    $db="schoolproject";

    $data=mysqli_connect($host,$user,$pass,$db);
    $sql="SELECT * FROM teacher";

    $result=mysqli_query($data,$sql);

?> 
<!DOCTYPE html>
<html lang="en">
<head>

<title>Student Management system</title>

<link rel="stylesheet" type="text/css" href="style.css">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
</head>
<body>

       <nav>
        <label class="logo">Our-School</label>
        <ul >
            <li><a href="#home">Home</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#admission">Admission</a></li>
            <li><a href="login.php" class="btn btn-success">Logins</a></li>
        </ul>
       </nav> 
       <div class="section1">
        <label class="img_text">We Teach Children With Care</label>
        <img class="main_img" src="classroom.jpg" alt="ClassroomImage">
       </div>
       <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="image1" src="school2.jpg" alt="image" style="margin-top: 50px;">
            </div>
            <div class="col-md-8" id="info">
                <h1>WELCOME TO OUR KINDERGATEN</h1>
                <p class="paragraph">
                    Hello,Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero aut culpa unde sint illo, 
                    in tempore quidem recusandae natus obcaecati eveniet quod consequatur ullam ipsum 
                    repellendus ut quam animi beatae rem labrum cumque rerum deserunt perspiciatis iure! 
                    Qui similique minima reprehenderit sed laudantium autem ratione? Consectetur.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. At perspiciatis ipsam 
                    repudiandae alias voluptates soluta.
                       
                </p>
            </div>
        </div>
       </div>
       
       <div id="center" style="text-align: center;">
            <h1 >OUR TEACHERS</h1>
        </div>

        <div class="container">
            <div class="row">
                <?php
                while($info=$result->fetch_assoc())
                {

                ?>
                <div class="col-md-4">
                    <img class="teacher-intro" style="width: 90%; height: 250px;" 
                    src="<?php echo"{$info['image']}" ?>">
                    <h3 class="paragraph2"> 
                        <?php echo "{$info['name']}" ?>
                    </h3>
                    <h5>
                        <?php echo "{$info['description']}" ?>
                    </h5>
                </div>
                <?php
                }
                ?>
            </div>
        </div>




        <div id="center" style="text-align: center;">
            <h1 >AVAILABLE ACTIVITIES</h1>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <img class="teacher-intro" src="preschooler1.jpg" alt="teacher">   <!-- style="width: 90%; height: 250px;" -->
                    <p class="paragraph2">
                        Social Skills
                    </p>
                </div>

                <div class="col-md-4">
                    <img class="teacher-intro" style="width: 90%; height: 250px;" src="preschooler2.jpg" alt="teacher">
                    <p class="paragraph2">
                        Fine Motor Skills
                    </p>
                </div>

                <div class="col-md-4">
                    <img class="teacher-intro" style="width: 90%; height: 250px;" src="preschooler3.jpg" alt="teacher">
                    <p class="paragraph2">
                        Outdoor Games
                    </p>
                </div>
            </div>
        </div>

        <!-- admission_form -->
        <div id="form-container" >
            <div class="form-wrap" >
                <h1>Admission form

                </h1>
                <form action="data_check.php" method="POST">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name">
                    </div>
                    <div class="form-group">
                	    <label for="">Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone">
                    </div>
                    <div class="form-group">
           		        <label for="">Message</label>
                        <textarea name="message"></textarea>
                    </div>
                    <div class="form-group">
            		        <button name="apply">Submit</button>
                    </div>
			    </form>
            </div>
        </div>

        <footer>
            <h3 class="footer_text">All @copyrights are reserved by ABC</h3>
        </footer>

    </body>
</html>