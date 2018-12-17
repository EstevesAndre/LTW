<?php 
    function draw_login($command) 
    { 
?>
    <section id="login">    

        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/login.php">
                    <p class="title">Welcome Prayer</p><br><br>
                    <?php print_messages();

                    if($command != null)
                    {   $time_left = $_SESSION['timeout'] - time();
                        if($time_left > 0)
                        {
                            $date1 =  new DateTime();
                            $date1->setTimestamp($_SESSION['timeout']);
                            $date1->format('Y-m-d H:i:s');

                            $date2 =  new DateTime();
                            $date2->setTimestamp(time());
                            $date2->format('Y-m-d H:i:s');
                            
                    
                            $intervalo = $date1->diff($date2);
                            $final = $intervalo->format(' %h hours %i minutes %s seconds');
                            echo ('<p class="title"> You failed login too many times, please wait '.$final.'</p>'); 
                        }
                        
                    }
                    
                    ?>
                    <p>Username:</p>
                    <input type="text" name="username" required><br>
                    <p>Password:</p>
                    <input type="password" name="password" required><br>
                    <input class="button" type="submit" value="Login">
                    <p class="title">Don't have an account? <a href="signup.php"><br>Signup!</a></p>
                </form>
            </div>
        </div>

    </section>
<?php 
    } 
?>


<?php 
    function draw_signup() 
    { 
?>
    <section id="signup">
        
        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/signup.php">
                    <p class="title">Create a new account</p>
                    <?php print_messages() ?>
                    <p>Username:</p>
                    <input type="text" name="username" required><br>
                    <p>E-mail:</p>
                    <input type="email" name="email" required><br>
                    <p>Password:</p>
                    <input type="password" name="password" required><br>
                    <input class="button" type="submit" value="Register">
                    <p class="title">Already have an account? <a href="login.php"><br>Login!</a></p>
                </form>
            </div>
        </div>

    </section>
<?php 
    } 
?>

<?php
    function draw_editProfile($user)
    {
?>
    <div class="article-container">
        <div class="form-container">
            <form method="post" action="../actions/update_profile.php">
                <p class="title">Hello <?=$user['username']?>,</p>          
                <p class="title">Edit your profile:</p><br>

                <p>Name:</p>
                    <input type="text" name="name" <?php if(!$user['name']) { ?>required<?php } ?> placeholder=<?=$user['name']?>><br>                    
                <p>Surname:</p>
                    <input type="text" name="surname" <?php if(!$user['surname']) { ?>required<?php } ?> placeholder=<?=$user['surname']?> ><br>
                <p>Email:</p>
                    <input type="text" name="email" <?php if(!$user['email']) { ?>required<?php } ?> placeholder=<?=$user['email']?>><br>
                <p>Genre:</p>
                <input type="text" name="genre" <?php if(!$user['genre']) { ?>required<?php } ?> placeholder=<?=$user['genre']?>><br>
                <p>Age:</p>
                    <input type="text" name="age" <?php if(!$user['age']) { ?>required<?php } ?> placeholder=<?=$user['age']?> ><br>
                <input class="button" type="submit" value="Save Changes">
            </form>
        </div>
    </div>
<?php
    }
?>