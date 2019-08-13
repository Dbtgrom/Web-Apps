  <?php
    session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
}

require_once 'func.php';
$link = db_connect();
$error = "";
$posts = get_post($link);
if(!isset($_POST['kill'])){
    
$_SESSION['id'] == $_GET['post_id'];
}
foreach ($posts as $row ){
    if($row['uid'] == $_SESSION['id']){
        $post_check = $row;
    }
}
if(isset($_POST['kill'])){
    if($delete_query = delete_post($link, $post_check['id'])){
        header("location: blog.php");
    }
    
}
        ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pitbull Club</title>

    <!-- Bootstrap core CSS -->
    <link href="blogpibbleBootStrap.css" rel="stylesheet">
    <link href="styleShits.css" rel="stylesheet">
    <!--Bootstrap CDN-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

    
    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">
<style>
            body{
                background-image: url(images/wallpaper_site.jpg);
            }
            
        </style>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Pitbull Club!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="services.php">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?log_out=1">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <form method="post" action="#">
            <div class="form-group">
            <h1>You sure you want to delete?</h1>
            <button type="submit" name="kill" class="btn-primary btn-danger">Delete</button>
        </div>
        </form>
    </div>
    </body>
    </html>
