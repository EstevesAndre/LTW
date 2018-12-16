<?php 
    function draw_category_page($channel, $pubOfChannel) { 
?>
    <div class="article-container">
        <div class="category-name">
            <p><?=$channel['cType']?></p>            
        </div>        
        <div class="subscribe">            
            <?php if (isset($_SESSION['username']))  { ?>
                <a class="button login-register">
                    <?php draw_sub($channel['id']); ?>
                </a>
                <input type="hidden" name="channel" value="<?=$channel['id']?>">
            <?php } ?>
        </div>
        <?php
            draw_publications($pubOfChannel, "Fresh", $channel['cType']);
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
            <p>Unsubscribe</p>
<?php   } 
        else 
        { 
?>
            <p>Subscribe</p>
<?php 
        }
    }
?>