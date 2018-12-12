<?php 
    function draw_category_page($channel, $pubOfChannel) { 
?>
    <div class="article-container">
        <div class="category-name">
            <p><?=$channel['cType']?></p>
        </div>
        <div class="subscribe">    
        <?php draw_sub($channel['id']); ?>
        </div>
        <?php
            draw_publications($pubOfChannel);
        ?>
    </div>
<?php 
    }
?>

<?php
    function draw_sub($idChannel) 
    {
        if(isUserSubOfChannel($_SESSION['username'], $idChannel)) 
        {
?>
            <a href="../pages/profile.php" class="button login-register"><p>Unsubscribe</p></a>
<?php   } 
        else 
        { 
?>
            <a href="../pages/profile.php" class="button login-register"><p>Subscribe</p></a>
<?php 
        }
    }
?>