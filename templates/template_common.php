<?php 
    function draw_header($username, $subtitle) 
    { 
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Prayers R Us<?= $subtitle ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="../styles/stylesheet.css" />
            <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
            <link rel="icon" href="../assets/logo.png" type="image/x-icon" />
            <script src="../scripts/main.js"></script>
            <script src="../scripts/script.js" defer></script>
            
        </head>

        <body>
            <header class="topnav" id="myTopnav">
                <a href="javascript:void(0);" class="icon" onclick="burguer_menu()">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="../pages/initialPage.php" class="logo"> </a>            
                <a href="../pages/initialPage.php" class="button"><p>Home</p> </a>            
                <a href="../pages/fresh.php" class="button"><p>Fresh</p> </a>            
                <a href="../pages/categories.php" class="button"><p>Categories</p> </a>
                <?php
                    if($username == null)
                    {
                ?>       
                        <a href="../pages/signup.php" class="button login-register"><p>Register</p> </a>         
                        <a href="../pages/login.php" class="button login-register"><p>Login</p> </a>  
                <?php
                    }
                    else
                    {
                ?>
                        <a href="../actions/logout.php" class="button login-register"><p>Logout</p> </a>         
                        <a class="button login-register"><p>20 points</p></a>
                        <a href="../pages/user-posts.php" class="button login-register"><p>Hi, <?=$username?></p></a> 
                <?php
                    }
                ?>
            </header>
<?php 
    }
?>

<?php 
    function print_messages() 
    { 
?>
    <?php if (isset($_SESSION['messages'])) 
            {
    ?>
        <section>
        <?php foreach($_SESSION['messages'] as $message) { ?>
            <div class="message-log"><?=$message['content']?></div>
    <?php 
        } 
    ?>
        </section>
        <?php unset($_SESSION['messages']); 
            } 
        ?>

<?php 
    }
?>

<?php 
    function draw_footer() 
    { 
?>
            <footer>
                <div class="copywrite">
                    <span>All rights reserved to ANTERO TOTAL™</span>
                </div>
            </footer>
        </body>
    </html>
<?php 
    }
?>
