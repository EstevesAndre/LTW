<?php function drawTitle($title) 
    {
?>
    <div class="article-container">
        <div class="category-name">
            <p><?=$title?></p>
        </div>        
        <div class="subscribe"></div>        
<?php
    }
?>

<?php
    function draw_searched_pub($publications) 
    {
        drawTitle("Publications");
?>
        <?php draw_publications($publications, "Fresh", "search"); ?>
    </div>
<?php
    }
?>

<?php
    function draw_searched_comments($comments) 
    {
        drawTitle("Comments");
?>
    <section id="comments-section">
        <div class="sub-comment">
            <?php drawCommentsOfPublication($pub['id'], $comments); ?>      
        </div>
    </section>
    </div>
<?php
    }
?>

<?php
    function draw_searched_channels($channels) 
    {
        drawTitle("Channels");
        if(count($channels) != 0)
            draw_categories($channels);
?> 
    </div>
<?php
    }
?>


<?php
    function draw_searched_users($users) 
    {
        drawTitle("Users");
        foreach($users as $user)
        {
?>
            <a href="../pages/user-posts.php?username=<?=$user['username']?>"><?=$user['username']?></a><br>
<?php
        }
?>
    </div>
<?php
    }
?>