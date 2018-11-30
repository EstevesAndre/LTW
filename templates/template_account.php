<?php 
    function draw_login() { 
?>
    <section id="login">        

        <!-- Acrescentar class para fazer o css para isto -->
        <h2>Welcome Prayer</h2>

        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/login.php">
                    <p class="title">Login</p>
                    <p>Username:</p>
                    <input type="text" name="username"><br>
                    <p>Password:</p>
                    <input type="password" name="username"><br>
                    <input class="button" type="submit" value="Login">
                </form>
            </div>
        </div>

        <!-- Same here -->
        <p>Don't have an account? <a href="signup.php">Signup!</a></p>

    </section>
<?php 
    } 
?>


<?php 
    function draw_signup() { 
?>
    <section id="signup">

        <!-- Same here -->
        <h2>New Account Prayer</h2>
        
        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/action_signup.php">
                    <p class="title">Join Us</p>
                    <p>E-mail:</p>
                    <input type="email" name="email"><br>
                    <p>Username:</p>
                    <input type="text" name="username"><br>
                    <p>Password:</p>
                    <input type="password" name="password"><br>
                    <input class="button" type="submit" value="Register">
                </form>
            </div>
        </div>
        
        <!-- Same here -->
        <p>Already have an account? <a href="login.php">Login!</a></p>


    </section>
<?php } ?>