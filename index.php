<html>

<head>
  <link rel="stylesheet" type="text/css" href="stylenav.css">
  <link rel="icon" href="logo.jpg" type="image/x-icon">
  <title>kickball league</title>
</head>

<body>
  <header>
    <?php include('header.php'); ?>
  </header>
 
  <main>
    <div class="content" style="margin-left:400px">
      <?php

      include('db.php');
      $pdo = db_connect();
      if (!$pdo) {
        die("error");
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Registration"])) {
          $username = $_POST["username"];
          $password = $_POST["password"];
          $email = $_POST["email"];
          $confrim=$_POST['confrim'];
          if($confrim==$password){
          $sql = "SELECT * FROM users WHERE email='$email'";
          $stm = $pdo->prepare($sql);
          $stm->execute();
          if ($stm->rowCount() > 0) {
            echo "the email is used try another one";
          } else {
            $sql = "INSERT INTO users (username, password, email)
    VALUES ('$username', '$password', '$email')";
            $stm = $pdo->prepare($sql);
            $stm->execute();
            if ($stm->rowCount() > 0) {
              echo "the registration is done";
            }
          }
        }else{
            echo"the password not matched";
        } 
             } elseif (isset($_POST["login"])) {
          $email = $_POST["email"];
          $password = $_POST['password'];
          $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
          $stm = $pdo->prepare($sql);
          $stm->execute();
          $detals = $stm->fetch();
          if ($stm->rowCount() > 0) {
            session_start();
            $_SESSION['user'] = $detals['username'];
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $detals['id'];
            header("Location: dashbord.php");
          } else {
            echo "There is an error in the email or password. Please check that they are correct";
          }

          /* if($stm->rowCount() > 0){
            header("Location: login.php");
          }*/
        }

      }

      ?>
      <h2>login</h2>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
       <label>Email:</label>
       <input type="email" name="email" class="input" required>
       <br>
        <label>Password:</label>
        <input type="password" name="password" class="input" required>
        <br>
        <input type="submit" VALUE="login" name="login" class="metaphoric-button"  >
      </form>
      <h2>Registration Form</h2>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
      <label >Username:</label>
        <input type="text" name="username"  class="input" required>
        <br>
        <label >Email:</label>
        <input type="email" name="email" class="input" required>
        <br>
        <label >Password:</label>
         <input type="password" name="password" class="input" required>
         <br>
         <label >Confrim PW:</label>
        <input type="password" name="confrim"  class="input" required>
        <br>
  
        <input type="submit" VALUE="Registration" name="Registration" class="metaphoric-button" >
      
      </form>

    </div>
  </main>
  <footer>
    <?php include('footer.php'); ?>
  </footer>
</body>

</html>