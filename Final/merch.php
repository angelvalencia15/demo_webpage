#!/usr/local/bin/php
<?php
  session_save_path(__DIR__ . '/sessions/');
  session_name('sessions;');
  session_start();
  if($_SESSION['myWebpage'] === 'notloggedin'){
    header("Location: login.php");
    exit();
  }
  if(!isset($_COOKIE['username'])){
    header("Location: login.php");
    exit();
  }
  //if user is correctly logged in...
  $username = $_COOKIE['username'];
  //$credit = 20;

  /*
    credit.db is created when merch.php is opened by user
    A table is created as well if one already doesnt exists
    This table stores the user's username, and credit
  */
  $db = new SQLite3('credit.db');
  $create_table = "CREATE TABLE IF NOT EXISTS users(username TEXT PRIMARY KEY, credit REAL)";
  $db->exec($create_table);

  //get info from table of the current user
  $select = "SELECT credit FROM users WHERE username='$username'";
  $result = $db->query($select);
  $row = $result->fetchArray();

  //if($row = $result->fetchArray()){
  if($row){
    //user exists, retrieve credit
    $credit = $row['credit'];
  }
  else{
    //user doesnt exists, insert his info
    $credit = 20;
    $insert = "INSERT INTO users(username, credit) VALUES('$username', $credit)";
    $db->exec($insert);
  }
  $db->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Our Merchandise</title>
        <script>
            const username = "<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>";
            let credit = <?php echo json_encode($credit); ?>; // Output as a valid JavaScript number
        </script>
        <script src="merch.js" defer></script>
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
            <h1>Our Merchandise</h1>
        </header>
        
        <main id='merchmain'>
          <section>
            <h2>Futbol Referee Items</h2>
            <p>
                Please have a look around. Our new members are awarded with $20.00 in credit. 
                You can add credit at any time with a coupon code. When you want to make
                a purchase, please select the checkboxes of the items you wish to purchase and
                click the "Checkout" button below.
            </p>
            <p id="EmptyP1">
                Your Credit: $
                    <?php 
                        echo number_format($credit,2);
                    ?>
            </p>
            <table id='merchtable'>
                <tbody>
                    <tr>
                        <td id='refshirt'>
                            <img src="https://cdn11.bigcommerce.com/s-mzx05o3/images/stencil/500x500/products/1572/8308/PhotoCrab_14300_25__67368.1697747670.jpg?c=2" width="150" alt='NCAA Referee Jersey'>
                            <h3>NCAA Referee Jersey</h3>
                            <input type="checkbox" id="JerseyInput">
                            <span></span>
                            <p>Dry-Fit Jerseys with unique colors.</p>
                        </td>
                        <td id='refwhistle'>
                            <img src="https://cdn11.bigcommerce.com/s-mzx05o3/images/stencil/500x500/products/129/363/fox_40_official_classic_fingergrip_black_20116__94446.1651694829.jpg?c=2" width="150" alt='FOX 40 Whistle'>
                            <h3>FOX 40 Whistle</h3>
                            <input type="checkbox" id="WhistleInput">
                            <span></span>
                            <p>Loud and professional whistle with fingergrip.</p>
                        </td>
                        
                        <td id='refflags'>
                            <img src="https://cdn11.bigcommerce.com/s-mzx05o3/images/stencil/500x500/products/158/7884/United_Attire_Quadro_Flags_with_Case__48219.1670669366.jpg?c=2" width="150" alt='Assistant Referee Flags'>
                            <h3>Assistant Referee Flags</h3>
                            <input type="checkbox" id="FlagsInput">
                            <span></span>
                            <p>Lightweight and soft grip professional flags.</p>
                        </td>
                        <td id='refwatch'>
                            <img src="https://cdn11.bigcommerce.com/s-mzx05o3/images/stencil/500x500/products/121/8068/casio-referee-watch__50109.1569879134__20480.1662832015.png?c=2" width="150" alt='Casio Sport Watch'>
                            <h3>Casio Sport Watch</h3>
                            <input type="checkbox" id="WatchInput">
                            <span></span>
                            <p>Professional sports watch.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <fieldset>
                <label for="textbox">Coupon Code</label>
                <input type="text" id="textbox">
                <input type="button" value="Checkout" id="Checkout">
                <p id="EmptyP2"></p>
            </fieldset>
          </section>
        </main>
        
        
        <hr>
        <footer>
            <small>&copy; Angel Valencia, 2024</small>
        </footer>
    </body>
</html>