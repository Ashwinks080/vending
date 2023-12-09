<?php
@include 'config.php';


?>



<html>
  <head>
    <title>HTML_NEW</title>
    <meta
      charset="utf-8"
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />

   
  </head>
  <body>
    <div class="login-form">
      <h2>ADMIN LOGIN</h2>
      <form method="POST" >
        <div class="input-field">
          <i class="bi bi-person-circle"></i> 
          <input type="text" placeholder="Username" name="Namor"/>
        </div>
        <div class="input-field" >
          <i class="bi bi-shield-lock"></i>
          <input type="password" placeholder="Password" name="AdminPassword"/>
        </div>

        <button name="Signin" type="submit">Sign In</button>

        <!-- <div class="extra">
          <a href="#">Forgot Password ?</a>
          <a href="#">Create an Account</a>
        </div> -->
      </form>
    </div>
<?php

if(isset($_POST['Signin']))
{
 $query= "SELECT * FROM `admin_login` WHERE  `Admin_Password`='$_POST[AdminPassword]' AND `Admin_Name`='$_POST[Namor]';";

    $result=mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==1)
  {
      session_start();
      $_SESSION['AdminLoginId']= $_POST['Namor'];
      header("location: admin.php");
  }
  else
  {
     echo "<script>alert('login successful')</script>";
  }
}

?>
    
  </body>
</html>