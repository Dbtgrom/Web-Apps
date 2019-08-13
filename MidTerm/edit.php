
<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
}
require_once 'func.php';
$link = db_connect();
$error = "";

$posts = get_post($link);
$post_check;
foreach ($posts as $row ){
    if($row['id'] == $_GET['post_id']){
        $post_check = $row;
    }
}


if(isset($_POST['submit'])){
    if(empty($_POST['title-input'])){
        $error = "Enter Title!";
    }
    elseif(empty($_POST['text-input'])){
        $error = "A short description is required!";
    }
    elseif(isset($_FILES['image_input'])){
        $file = $_FILES['image_input'];
        
        $whitelist = array('image/jpeg', 'image/png','image/gif','image/jpg');
     if(function_exists('finfo_open')){    
        $file_info = finfo_open(FILEINFO_MIME_TYPE);

     if (!in_array(finfo_file($file_info, $file['tmp_name']),$whitelist)) {
         $error  = "Uploaded file is not a valid image";
        
    }
    
}
elseif(file_exists($file)){
    $error  = "File already in the Database!";
}
elseif($file['size'] > 5000000){
    $error = "File too large!";
}
    }
 if($error == ''){
     $title = mysqli_real_escape_string($link, $_POST['title-input']);
     $text = mysqli_real_escape_string($link,$_POST['text-input']);
     $image = $_FILES["image_input"];
     $image_name = basename($_FILES["image_input"]["name"]);
     $insert_post = edit_post($link, $_GET['post_id'],$_SESSION['id'], $image_name, $title, $text);
     $target_dir = "uploads/";
     $uid_add = "doggy - " . $_SESSION['id'];
     $target_file = $target_dir . basename($_FILES["image_input"]["name"]);
     if (move_uploaded_file($_FILES["image_input"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image_input"]["name"]). " has been uploaded.";
        header("location: blog.php");
    } else {
        $error = "Sorry, there was an error uploading your file.";
    }
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

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">A Warm Welcome!</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
      </header>
      
      <!-- Blog Form -->
      <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="InputTitle">Title</label>
    <input type="text" class="form-control" name="title-input" id="InputTitle" aria-describedby="titleHelp" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label for="image_input">Image</label>
    <input type="file" class="form-control" name="image_input" id="imageInput" placeholder="Submit Image">
  </div>
          <div class="form-group">
    <label for="textArea">Text</label>
    <textarea class="form-control" name="text-input" id="textArea"></textarea>
  </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  <span style="color:red"><?=$error?></span>
</form>
      
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Pitbull club 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
   <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

