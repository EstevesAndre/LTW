<?php 
    function draw_user_page($username, $pubOfUser) { 
?>
    <div class="article-container">
        <div class="user">
            <p><?=$username?></p>
        </div>
        <div class="edit-profile">    
            <?php if (isset($_SESSION['username']) && $username == $_SESSION['username'])  { ?>
                <a href="../pages/profile.php" class="button login-register"><p>Edit Profile</p></a>
            <?php } ?>        
        </div>
        <?php
            if(sizeof($pubOfUser))
            {
                if (isset($_SESSION['username']) && $username == $_SESSION['username'])
                    draw_publications($pubOfUser, "Fresh");
                else
                    draw_publications($pubOfUser, "Fresh", NULL, "search");
            }
            else
            {?>
                <p class="not-found">Prayer <?=$username?> has no publications!</p>
            <?php }
        ?>
    </div>
<?php 
    }
?>