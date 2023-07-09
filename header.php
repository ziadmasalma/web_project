
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="hstyle.css">
</head>
<body >
    <header>
    <div class="header-section left">
        <img src="logo.jpg" style="width: 100px;" >
     
</div>
<div class="header-section middle">
        Ziad Masalma
</div>
<div class="header-section right">
    <p>
        <a href="aboutus.php" >about us</a>
        <?php
        session_start();
        if(isset($_SESSION['user'])){
            $username=$_SESSION['user'];
            echo"<figure>
                 <img src='user.png' style='width: 40px;'> 
                 <figcaption>welcome $username </figcaption>
                 </figure>";
        }
        else {
            echo"<a href='index.php'>log in</a>";
        }
        ?>
        <a href="logout.php">log out</a>
    </p>
    </div>
    </header>
</body>
</html>