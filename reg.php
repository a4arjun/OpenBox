<?php
error_reporting(0);
require_once 'inc/config.php';
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        mkdir("uploads/{$_POST['username']}", 0777, true);
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
        
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page. First your project. Security next ;).
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
          background: linear-gradient(45deg, rgba(34, 251, 65, 0.5) 0%, rgba(229, 201, 35, 0.45) 100%); */
          background-color: -moz-linear-gradient(135deg, rgba(101, 47, 142, 0.3) 0%, rgba(125, 46, 185, 0.45) 100%);
          background-color: -webkit-linear-gradient(135deg, rgba(101, 47, 142, 0.3) 0%, rgba(125, 46, 185, 0.45) 100%);
          background-repeat: no-repeat;
            height: 100%;
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
  <nav class="green" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo white-text waves-effect waves-light">OpenBox</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="white-text waves-effect waves-light" href="#">HOME</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">ABOUT</a></li>
        <li><a class="white-text waves-effect waves-light" href="#">CONTACT</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <div class="mob-nav-img">ggg</div>
        <li><a class="waves-effect" href="index.html"><i class="blue-text material-icons">home</i>HOME</a></li>
        <li><a class="waves-effect" href="#"><i class="green-text material-icons">info</i>ABOUT</a></li>
        <li><a class="waves-effect" href="#"><i class="red-text material-icons">feedback</i>CONTACT</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="white-text material-icons">menu</i></a>
    </div>
  </nav>
  <div class="content">
  <div class="main main-raised">
    <h4 class="green-text darken-4">Sign up</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn green" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>