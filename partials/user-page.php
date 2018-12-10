<?php 
    function draw_user_page($user, $pubOfUser) { 
?>
    <div class="article-container">
        <div class="user">
            <p><?=$user?></p>
        </div>
        <div class="edit-profile">
            <a href="../pages/profile.php" class="button login-register"><p>Edit Profile</p></a>
        </div>
        <?php
            draw_publications($pubOfUser);
        ?>
    </div>
<?php 
    }
?>