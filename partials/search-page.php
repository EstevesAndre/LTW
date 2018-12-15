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
            draw_publications($publications, "Fresh", "search");
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
            <section id="comments-section">
                <div class="sub-comment">
                    <?php drawSearchedComments($comments); ?>
                </div>
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
            foreach($users as $user)
            {
?>
                <a href="../pages/user-posts.php?username=<?=$user['username']?>"><?=$user['username']?></a><br>
<?php
            }
        }
        else{
            draw_not_found(" Users");
        }
    }
?>