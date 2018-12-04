<?php 
    function draw_login() 
    { 
?>
    <section id="login">    

        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/login.php">
                    <p class="title">Welcome Prayer</p><br><br>
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
                    <p class="title">Create a new account<br>Join Us!</p>
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