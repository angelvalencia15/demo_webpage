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
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title> My favorite movie</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <header>
      <h3 id='usergreeting'>Hello <?php echo $_COOKIE['username'] ?> !</h3>
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
      <h1> Angel's Favorite Movie</h1>
    </header>
  
    <main id='indexmain'>
      <h2> Pelé: Birth of a Legend</h2>
      <p>
      This movie is about a very famous Brazilian soccer player who created a huge impact on the sport. At the age of 17, he became part of his professional national team and won a World Cup. Pelé grew up in the slums of brazil, the poorest of the cities where he overcame his obstacles and became an idol for all of soccer. He holds many world records and is still, to this day, considered the greatest soccer player ever.
      </p>
   
      <figure>
        <img src=https://upload.wikimedia.org/wikipedia/commons/5/5e/Pele_con_brasil_%28cropped%29.jpg width=100 >
        <figcaption>
          A photograph of Pelé in the Brazil nationional jersey
        </figcaption>
      </figure>
    
     <section>
       <h2>Pelé's Greatest Accomplishments</h2>
       <ul>
         <li>Brazil's all-time top scorer with 77 goals in 92 international matches </li>
         <li>The youngest player to ever score a goal in the men's FIFA World Cup </li>
         <li>The youngest player to score a hat-trick in the World Cup </li>
         <li>The youngest player to ever score in a football FIFA World Cup final </li>
       </ul>
     </section> 
     
     <section>
       <h1> Some recent post by other users:</h1>
       <p>
       <b>User (malicious666):</b>
       Hello guys, my name is Mali. Here is a 
       <a href='scarf1.html' target='_blank' rel='opener'>picture</a>
       of myself with Pelé when he won his first World Cup!!! We were actually such best friends back in our time, that he gifted me a scarf for my birthday. I AM AUCTIONING IT OFF 
       <a href='scarf2.html' target='_blank' rel='opener'>HERE</a>
       !!!
 
       </p>
       
     </section>
    </main>
    
    <footer>
      <hr/>
      <small>
        Copyright &copy; 2024, Angel Valencia, all rights reserved.
      <br>
      The content of this website, including text, graphics, and images, is the intellectual property of Angel Valencia and is protected under international copyright laws. Unauthorized reproduction, distribution, or use of any materials, in whole or in part, without explicit permission is prohibited. For inquiries regarding usage rights, please contact us through the provided channels. This website and its content may not be copied, shared, or reproduced without prior written consent.
     </small>
    </footer>
  </body>
</html>