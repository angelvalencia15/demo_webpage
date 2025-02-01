#!/usr/local/bin/php
<?php
  session_save_path(__DIR__ . '/sessions/');
  session_name('sessions');
  session_start();
  if($_SESSION['myWebpage'] === 'notloggedin'){
    header("Location: login.php");
    exit();
  }
  if(!isset($_COOKIE['username'])){
    header("Location: login.php");
    exit();
  }
  // Ensure proper header setting (if necessary)
  header("Content-Type: text/html; charset=UTF-8");

  // Cookie handling
  if (isset($_COOKIE['username'])) {
    $author = $_COOKIE['username'];
  } else {
    setcookie('username', 'user123');
    $author = 'user123'; // Assign default value to $author
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Our Posts</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li>
            <a href="index.html" target="_blank" rel="noopener">Home</a>
          </li>
          <li>
            <a href="login.php" target="_blank" rel="noopener">Login</a>
          </li>
          <li>
            <a href="blog.php" target="_blank" rel="noopener">Our Posts</a>
          </li>
          <li>
            <a href="merch.php" target="_blank" rel="noopener">Our Products</a>
          </li>
        </ul>
      </nav>
      <h1>Blog posts</h1>
    </header>
    <main id='blog'>
      <form method="POST" action="post.php">
        <label for="author">Author: </label>
        <input type="text" name="author" id="author" value="<?php echo $author; ?>">
        <br>
        <label for="content">Content: </label>
        <textarea name="content" id="content"></textarea>
        <input type="submit" value="Post">
      </form>
      <section>
        <h2>Posts by other users:</h2>
        <?php
          $postsFile = 'posts.txt';
          if (file_exists($postsFile)) {
            echo "<p>";
            $file = fopen($postsFile, 'r');
            while (!feof($file)) {
              $line = fgets($file);
              echo $line, "<br>";
            }
            fclose($file);
            echo "</p>";
          } 
        ?>
      </section>
    </main>
    <footer>
      <hr>
      <small>&copy; Angel Valencia, 2024</small>
    </footer>
  </body>
</html>