<?php 
    function draw_user_page($username, $pubOfUser) { 
?>
    <div class="article-container">
        <div class="user">
            <p><?=$username?></p>
        </div>
        <div class="edit-profile">    
            <?php if ($username == $_SESSION['username'])  { ?>
                <a href="../pages/profile.php" class="button login-register"><p>Edit Profile</p></a>
            <?php } ?>        
        </div>
        <?php
            draw_publications($pubOfUser);
        ?>
    </div>
<?php 
    }
?>