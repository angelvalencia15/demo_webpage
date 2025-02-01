#!/usr/local/bin/php
<?php
  session_save_path(__DIR__ . '/sessions/');
  session_name('sessions');
  session_start();
  if ($_SERVER["REQUEST_METHOD"]==="POST"){
    $username = $_POST['username']; //get this by usernamebox name='username'
    $password = $_POST['password']; //get this by passwordbox name='password'
    $_SESSION['myWebpage'] = 'notloggedin'; //user is not logged in
    $file = fopen('h_password.txt', 'r');
    $hashed_pw = fgets($file); //gets hashed pw
    $hashed_pw = trim($hashed_pw);
    fclose($file);
    $user_hashed_pw = hash('md2', $password);

    if($user_hashed_pw === $hashed_pw){ 
      //if username validates and $password is the same as $hashed_pw
      //username is validated in login.js
      $_SESSION['myWebpage'] = 'loggedin';
      header("Location: index.php");
      exit();
    }
    else{
      $_SESSION['myWebpage'] = 'notloggedin';
      $error_message = "Invalid password!";
      echo "<script> alert('$error_message'); </script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <script src="username.js" defer></script>
    <script src="login.js" defer></script>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <header>
      <h1>Welcome! Ready to check out my webpage?</h1>
    </header>

    <main>
      <h2>Enter a username.</h2>

      <p id='greetingonlogin'>
        So that you can make your own posts and purchases, select a username and
        password.
      </p>

      <form method='POST'>
        <fieldset>
          <label for="usernamebox">Username: </label>
          <input type="text" id="usernamebox" name='username'/>

          <br />
          <label for="passwordbox">Password: </label>
          <input type="password" id="passwordbox" name='password'/>

          <input type="submit" value="Login" id="loginButton" />
        </fieldset>
      </form>

    </main>

    <!-- bottom section of webpage, including horizontal line-->
    <hr />
    <footer>
      <hr />
      <small>
        Copyright &copy; 2024, Angel Valencia, all rights reserved.
        <br />
        The content of this website, including text, graphics, and images, is
        the intellectual property of Angel Valencia and is protected under
        international copyright laws. Unauthorized reproduction, distribution,
        or use of any materials, in whole or in part, without explicit
        permission is prohibited. For inquiries regarding usage rights, please
        contact us through the provided channels. This website and its content
        may not be copied, shared, or reproduced without prior written consent.
      </small>
    </footer>
  </body>
</html>