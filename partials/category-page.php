<?php 
    function draw_category_page($channel, $pubOfChannel) { 
?>
    <div class="article-container">
        <div class="category-name">
            <p><?=$channel['cType']?></p>            
        </div>        
        <?php if (isset($_SESSION['username']))  { ?>
            <div class="subscribe">    
                <a class="button login-register">
                    <?php draw_sub($channel['id']); ?>
                </a>
                <input type="hidden" name="channel" value="<?=$channel['id']?>">
            </div>
        <?php } ?>
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