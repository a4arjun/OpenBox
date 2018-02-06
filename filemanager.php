<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>OpenBox Cloud</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="nav purple-nav" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo white-text waves-effect waves-light">OpenBox</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="white-text waves-effect waves-light" href="dashboard.php">HOME</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">ABOUT</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">CONTACT</a></li>
        <li><a class="white-text waves-effect waves-light" href="logout.php">LOGOUT</a></li>
         </ul>

      <ul id="nav-mobile" class="side-nav">
        <div class="mob-nav-img ">
        	<?php echo 'Hi, <strong>'.$_SESSION['username'].'</strong> ';?>
        </div>
        <li><a class="waves-effect" href="dashboard.php"><i class="blue-text material-icons">home</i>HOME</a></li>
        <li><a class="waves-effect" href="#"><i class="green-text material-icons">info</i>ABOUT</a></li>
        <li><a class="waves-effect" href="#"><i class="red-text material-icons">feedback</i>CONTACT</a></li>
        <li><a class="waves-effect" href="logout.php"><i class="purple-text material-icons">call_missed</i>LOGOUT</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons white-text">menu</i></a>
    </div>
  </nav>
<body>
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        
        <h1 class="header center  text-lighten-2">Hi <?php echo ' '.$_SESSION['username'].'';?></h1>
        <div class="row center">
          <h5 class="header col s12 light">Upload a new file in a click</h5>
        </div>
        <div class="row center">
          <a href="uploader.php" class="btn-large waves-effect waves-light red">Upload Now</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="img/yyy.jpg" alt="Unsplashed background img 1"></div>
  </div>

<div id="wrapper">

<div class="container">	
<div id="masonry-grid" class="row">

<?php

if(isset($_POST['delete_file']))
{
 $filename = $_POST['file_name'];
 unlink('uploads/'.$_SESSION['username'].'/'.$filename);
 echo '<script>alert("Deleted successfully")</script>';
}

$folder = 'uploads/'.$_SESSION['username'].'';
$scan = opendir($folder);

if ($dir = opendir($folder))
{
 while (($res = readdir($dir)) !== false)
 {
 	$file = str_replace('..', 'Directory', $res);
 	if($file == 'Directory'){

 	}
 	elseif($file == '.'){

 	}
 	else{
 		echo '<div class="col s6">';
 		echo '<div class="card">
         	<div class="card-image">';
	  echo "<p>".$file."</p>";
	  echo "<form method='post' action=''>";
	  echo '<img src="'.$folder.'/'.$file.'" width="260vh" height="auto"><br/>';
	  echo '</div>';
	  echo "<input type='hidden' name='file_name' value='".$file."'>";
	  echo '<a href="'.$folder.'/'.$file.'" target="_blank" class="btn blue"><i class="material-icons">get_app</i></a>&nbsp;';
	  echo '<button name="delete_file" class="btn red" value="delete"><i class="material-icons white-text">delete</i></button>';
	  echo "</form>";
	  
	  echo "</div>
	  			</div>";
}
 }
 closedir($dir);
}
?>
<?php

?>
</div>
</div>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/material-kit.js"></script>  
  <script src="js/masonry.pkgd.min.js"></script>
</body>
</html>
<?php } ?>
