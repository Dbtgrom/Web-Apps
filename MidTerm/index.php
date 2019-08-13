 <?php
       session_start();
       if(isset($_GET["log_out"])){
           session_destroy();
           header("location: index.php");
       }
       require_once 'func.php';
       $link = db_connect();
       $is_valid = TRUE;
       $error = '';
       if (isset($_POST['reg_submit'])){
           if(empty($_POST['reg_name'])){
               $error = "Please insert name!";
           }
           elseif(empty($_POST['pwd'])){
               $error = "Please insert password!";
           }
           elseif(empty($_POST['email'])){
               $error = "Please insert email!";
           }
          else{
               $reg_name = trim(filter_input(INPUT_POST, 'reg_name', FILTER_SANITIZE_STRING));
               $email_reg = strtolower(filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL));
               $reg_pwd = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));
               $check_mail = "SELECT * FROM users WHERE email = '$email_reg'";
               $check_mail_query = mysqli_query($link, $check_mail);
               if(mysqli_num_rows($check_mail_query) > 0){
                   $error = "Email already exists in the system!";
                   $is_valid = FALSE;
               }
               else{
                  $reg_pwd = password_hash($reg_pwd, PASSWORD_BCRYPT);
               }
               $reg_query = "INSERT INTO users(uName, email, pwd) VALUES ('$reg_name', '$email_reg', '$reg_pwd')";
               if($is_valid){
               if($reg_request = mysqli_query($link, $reg_query)){
                   header("location:thanks.php");              }
                   
               }   
           }
       }
             if (isset($_POST['log_submit'])){
           if($_POST['token'] == $_SESSION['csrf_token']){
           if(empty($_POST['u_email'])){
               $error = "Please insert email!";
           }
           elseif(empty($_POST['pswd'])){
               $error = "Please insert password!";
           }
     
          else{
               $email_log = strtolower(filter_input(INPUT_POST, 'u_email', FILTER_SANITIZE_EMAIL));
               $log_pwd = trim(filter_input(INPUT_POST, 'pswd', FILTER_SANITIZE_STRING));
               $log_query = "SELECT * FROM users WHERE email = '$email_log'";
               if($log_req = mysqli_query($link, $log_query)){
                   if(mysqli_num_rows($log_req)> 0){
                       $row_arr = mysqli_fetch_assoc($log_req);
                       if(password_verify($log_pwd, $row_arr['pwd'])){
                           $_SESSION['id'] = $row_arr['id'];
                           $_SESSION['uName'] = $row_arr['uName'];
                           $_SESSION['email'] = $row_arr['email'];
                          $_SESSION['the_guy'] = $_SERVER['HTTP_USER_AGENT'];
                          $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                           header("location: blog.php");
                       }
                       }
                   
               }
             
                  

                        
          $error = "You must register!"; 
          }
       }
       else{
           $error = "NO NO NO!!!!";
       }
       }
       $csrf_token = hash("sha256", rand(10000000, 99999999));
       $_SESSION['csrf_token'] = $csrf_token;
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pitbull Club</title>
        <link rel="stylesheet" href="CSSpibble.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <style>
            body{
                background-image: url(images/wallpaper_site.jpg);
            }
            
        </style>
    </head>
    <body>
<div class="login-page">
  <div class="form">
      <form class="login-form" method="POST">
        <input type="text" name="u_email" placeholder="email"/>
        <input type="password" name="pswd" placeholder="password"/>
        <input type="submit" class="button1" value="Enter" name="log_submit">
      <p class="message">Not registered? <a href="#">Create an account</a></p>
      <input type="hidden" name="token" value="<?=$csrf_token?>">
    </form>
      <form class="register-form" method="POST">
          <input type="text" name="reg_name" placeholder="name"/>
          <input type="password" name="pwd" placeholder="password"/>
          <input type="text" name="email" placeholder="email address"/>
          <input type="submit" class="button1" value="Submit" name="reg_submit">
      <p class="message">Already registered? <a href="#">Sign In</a></p>
      <span style="color:red"><?=$error?></span>
      
             </form>

  </div>
</div>
          <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
        <script>$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});</script>
    </body>
</html>
<!--
Copyright (c) 2018 by Aigars Silkalns (https://codepen.io/colorlib/pen/rxddKy)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
