<?php 
    function draw_header($username) { 
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Prayers R Us<?php echo($subtitle) ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="../styles/stylesheet.css" />
            <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
            <link rel="icon" href="../assets/logo.png" type="image/x-icon" />
            <script src="../scripts/script.js"></script>
        </head>

        <body>
            <header>
                <a href="../pages/mainMenu.php" class="logo"> </a>            
                <a href="../pages/mainMenu.php" class="button"><p>Home</p> </a>            
                <a href="../pages/fresh.php" class="button"><p>Fresh</p> </a>            
                <a href="../pages/categories.php" class="button"><p>Categories</p> </a>                
                <a href="../pages/login.php" class="button login-register"><p>Login | Register</p> </a>
            </header>

<?php } ?>

<?php 
    function draw_footer() { 
?>
            <footer>
                <div class="copywrite">
                    <span>All rights reserved to ANTERO TOTAL™</span>
                </div>
            </footer>
        </body>
    </html>
<?php } ?>
