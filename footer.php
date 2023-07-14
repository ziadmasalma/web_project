<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="footerstyle.css">
</head>

<body>
  <footer>
    <div class="footer-content">
      <?php
      $company_name = "Stella Gold";
      $address = "Sinjel , Ramallah,Palestine";
      $phone_number = "059-9484889";
      $email = "z.j.masalma@gmail.com";
      $year = date("Y");
      ?>

      <img src="logo.jpg" alt="Company Logo" class="footer-logo" width="40" height="40">
      <div class="footer-text">
        <?php
        echo '
    <p>© ' . $year . ' ' . $company_name . '. All rights reserved.</p>
    <p>' . $company_name . '</p>
    <p>' . $address . '</p>
    <p>Customer Support: ' . $phone_number . '</p>
    <p>Email: <a href="mailto:' . $email . '">' . $email . '</a></p>
    <p><a href="https://www.facebook.com/goldstella66">Contact Us</a></p>'
          ?>
      </div>
    </div>
  </footer>
</body>

</html>