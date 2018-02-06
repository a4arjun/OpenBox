<?php
error_reporting(0);
require_once 'inc/config.php';
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validat
    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt); 
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Login - OpenBox Cloud</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style type="text/css">
    html,
      body{
          background-color: #e57123;
          background: linear-gradient(45deg, rgba(229, 28, 35, 0.5) 0%, rgba(229, 201, 35, 0.45) 100%); */
          background-color: -moz-linear-gradient(135deg, rgba(101, 47, 142, 0.3) 0%, rgba(125, 46, 185, 0.45) 100%);
          background-color: -webkit-linear-gradient(135deg, rgba(101, 47, 142, 0.3) 0%, rgba(125, 46, 185, 0.45) 100%);
          background-repeat: no-repeat;
            height: 100%;
            min-height: 100%;
      }
    .content{
        padding:5%;
        padding-top:60px;
        padding-top: 10%;
    }
        .main {
          background: #FFFFFF;
          position: relative;
          z-index: 3;
          padding: 10%;
        }
        .main-raised {
          margin: 60px 20px 0px;
          border-radius: 6px;
          box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        }

  </style>
</head>
<body>
  <nav class="orange" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo white-text waves-effect waves-light">OpenBox</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="white-text waves-effect waves-light" href="index">HOME</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">ABOUT</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">CONTACT</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <div class="mob-nav-img">  </div>
        <li><a class="waves-effect" href="index.html"><i class="blue-text material-icons">home</i>HOME</a></li>
        <li><a class="waves-effect" href="#"><i class="green-text material-icons">info</i>ABOUT</a></li>
        <li><a class="waves-effect" href="#"><i class="red-text material-icons">feedback</i>CONTACT</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="white-text material-icons">menu</i></a>
    </div>
  </nav>  
<div class="content">
  <div class="main main-raised">
    <h4 class="orange-text darken-4">Sign in</h4>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn orange" value="Submit">
            </div>
            <p>Don't have an account? <a href="reg.php">Sign up now</a>.</p>
        </form>
    </div>
</div> 
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
</body>
</html>