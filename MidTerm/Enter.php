 <?php
       session_start();
       require_once 'func.php';
       $link = db_connect();
       $error = '';
       if (isset($_POST['log_submit'])){
           if($_POST['token'] == $_SESSION['csrf_token']){
           if(empty($_POST['u_mail'])){
               $error = "Please insert email!";
           }
           elseif(empty($_POST['pswd'])){
               $error = "Please insert password!";
           }
     
          else{
               $email_log = strtolower(filter_input(INPUT_POST, 'u_mail', FILTER_SANITIZE_EMAIL));
               $log_pwd = trim(filter_input(INPUT_POST, 'pswd', FILTER_SANITIZE_STRING));
               $log_query = "SELECT * FROM users WHERE email = '$email_log'";
               if($log_req = mysqli_query($link, $log_query)){
                   if(mysqli_num_rows($log_req)> 0){
                       $row_arr = mysqli_fetch_assoc($log_req);
                       if(password_verify($log_pwd, $row_arr['pwd'])){
                           $session['id'] = $row_arr['id'];
                           $session['uName'] = $row_arr['uName'];
                           $session['email'] = $row_arr['email'];
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
      <form  method="POST">
        <input type="text" name="u_mail" placeholder="email"/>
        <input type="password" name="pswd" placeholder="password"/>
        <input type="submit" class="button1" value="Enter" name="log_submit">
        <span style="color:red"><?="$error"?></span>;
        <input type="hidden" name="token" value="<?=$csrf_token?>">
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
    </body>
</html>
