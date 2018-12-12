<?php 
    function draw_category_page($channel, $pubOfChannel) { 
?>
    <div class="article-container">
        <div class="category-title">
            <p><?=$channel['cType']?></p>
            <?php if (isset($_SESSION['username']))  { ?>
                <div class="subs-toggle">
                    <a id="subscribe">
                        <?php draw_sub($channel['id']); ?>
                        <input type="hidden" name="channel" value="<?=$channel['id']?>">
                    </a>
                </div>
            <?php } ?>
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