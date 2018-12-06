<?php 
    function draw_login() 
    { 
?>
    <section id="login">    

        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/login.php">
                <p class="title">Welcome Prayer</p><br><br>
                <?php print_messages() ?>
                    <p>Username:</p>
                    <input type="text" name="username"><br>
                    <p>Password:</p>
                    <input type="password" name="password"><br>
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
                    <input type="text" name="username"><br>
                    <p>E-mail:</p>
                    <input type="email" name="email"><br>
                    <p>Password:</p>
                    <input type="password" name="password"><br>
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
    <section id="edit">
        <div class="form-container">
            <form method="post" action="../actions/update_profile.php">
                <p class="title">Hello <?=$user['username']?>,</p><br>              
                <p class="title">Edit your profile:</p><br>
                
                <p>Name:</p>
                    <input type="text" name="name" placeholder=<?=$user['name']?>><br>                    
                <p>Surname:</p>
                    <input type="text" name="surname" placeholder=<?=$user['surname']?> ><br>
                <p>Email:</p>
                    <input type="text" name="email" placeholder=<?=$user['email']?>><br>
                <p>Genre:</p>
                    <input type="text" name="genre" placeholder=<?=$user['genre']?> ><br>
                <p>Age:</p>
                    <input type="text" name="age" placeholder=<?=$user['age']?> ><br>
                <input class="button" type="submit" value="Save Changes">
            </form>
        </div>
    </section>
<?php
    }
?>