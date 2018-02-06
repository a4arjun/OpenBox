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
        <li><a class="white-text waves-effect waves-light" href="#">HOME</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">ABOUT</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">CONTACT</a></li>
         <li><a class="white-text waves-effect waves-light" href="logout.php">LOGOUT</a></li>
         </ul>

      <ul id="nav-mobile" class="side-nav">
        <div class="mob-nav-img ">
        	<?php echo 'Hi, <strong>'.$_SESSION['username'].'</strong> ';?>
        </div>
        <li><a class="waves-effect" href="index.html"><i class="blue-text material-icons">home</i>HOME</a></li>
        <li><a class="waves-effect" href="#"><i class="green-text material-icons">info</i>ABOUT</a></li>
        <li><a class="waves-effect" href="#"><i class="red-text material-icons">feedback</i>CONTACT</a></li>
        <li><a class="waves-effect" href="logout.php"><i class="purple-text material-icons">call_missed</i>LOGOUT</a></li> 
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons white-text">menu</i></a>
    </div>
  </nav>

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

  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center purple-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Quicker</h5>

            <p class="light">OpenBox is quicker. We have the most advanced and lightning fast servers to serve you. And most importantly, we provide a whole another level of security..</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center purple-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User accounts</h5>

            <p class="light">
            In OpenBox, you can create free user accounts and, unlike other cloud services, we provide specific drives for every single user. That makes the loading even faster and less risk of security</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center purple-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Customize</h5>

            <p class="light">OpenBox is customizable and you can choose what to do with your account. Whether you want to use it as a web server or something like that, OpenBox is the best way to choose.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Sometimes clouds can be your best companions</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="img/zzz.png" alt="Unsplashed background img 3"></div>
  </div>

  <footer class="page-footer purple">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Open Box</h5>
          <p class="grey-text text-lighten-4">
          OpenBox helps you to store your files online so that you can access them from anywhere on the planet.
          </p>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made with <i class="material-icons">favorite</i> <a class="brown-text text-lighten-3" href="http://arjunv.cf">OpenBox</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/material-kit.js"></script>

  </body>
</html>
<?php }?>