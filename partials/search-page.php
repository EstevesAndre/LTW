<?php function drawTitle($title) { ?>
    <div class="search-title">
        <p><?=$title?></p>
    </div>
<?php } ?>

<?php function draw_not_found($title = "t") { ?>
    <p class="not-found">No<?=$title?> Found</p>
<?php } ?>

<?php
    function draw_searched_pub($publications) 
    {
        drawTitle("Publications");
        
        if (sizeof($publications))
            draw_publications($publications, "Fresh", NULL, "search");
        else
            draw_not_found(" Publications");
    }
?>

<?php
    function draw_searched_comments($comments) 
    {
        drawTitle("Comments");

        if (sizeof($comments)) 
        {
?>
            <section class="comments-section">
                <?php drawSearchedComments($comments); ?>
            </section>
<?php
        }
        else
        {
            draw_not_found(" Comments");
        }
    }
?>

<?php
    function draw_searched_channels($channels) 
    {
        drawTitle("Channels");

        if(sizeof($channels))
            draw_categories($channels);
        else
            draw_not_found(" Channels");
    }
?>


<?php
    function draw_searched_users($users) 
    {
        drawTitle("Users");
        if(sizeof($users)) {
?>
            <div class="search-users">
<?php
            foreach($users as $user)
            {
?>
            <a href="../pages/user-posts.php?username=<?=$user['username']?>">
                <p><?=$user['username']?></p>
            </a><br>
<?php
            }
            ?>
            </div>
            <?php
        }
        else{
            draw_not_found(" Users");
        }
    }
?>