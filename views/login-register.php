<!DOCTYPE <!DOCTYPE html>
<html>
    <?php $subtitle=''; ?>
    <?php include'../partials/head.php';?>
<body>
    <?php include'../partials/nav-bar.php';?>
    <div class="article-container">
        <div class="form-container">
            <form>
                <p class="title">Login</p>
                <p>Username:</p>
                <input type="text" name="username"><br>
                <p>Password:</p>
                <input type="password" name="username"><br>
                <input class="button" type="submit" value="Login">
            </form>
        </div>
        <div class="form-container">
            <form>
                <p class="title">Join Us</p>
                <p>E-mail:</p>
                <input type="email" name="username"><br>
                <p>Username:</p>
                <input type="text" name="username"><br>
                <p>Password:</p>
                <input type="password" name="username"><br>
                <input class="button" type="submit" value="Register">
            </form>
        </div>
    </div>
    <?php include'../partials/footer.php';?> 
</body>

</html>