<?php function drawTitle($title) 
    {
?>
        <div class="search-title">
            <p><?=$title?></p>
        </div>             
<?php
    }
?>

<?php function draw_not_found() 
    {
?>
        <p class="not-found">Not Found</p>
<?php
    }
?>

<?php
    function draw_searched_pub($publications) 
    {
        drawTitle("Publications");
?>
        <?php 

        if (sizeof($publications) != 0) {
            draw_publications($publications, "Fresh", "search");
        }
        else {
            draw_not_found();
        }
        ?>
<?php
    }
?>

<?php
    function draw_searched_comments($comments) 
    {
        drawTitle("Comments");

        if (sizeof($comments) != 0) {
?>
    <section id="comments-section">
        <div class="sub-comment">
            <?php drawCommentsOfPublication($pub['id'], $comments); ?>      
        </div>
    </section>
<?php
        }
        else {
            draw_not_found();
        }
    }
?>

<?php
    function draw_searched_channels($channels) 
    {
        drawTitle("Channels");
        if(sizeof($channels) != 0) {
            draw_categories($channels);
        } else {
            draw_not_found();
        }
?> 
<?php
    }
?>


<?php
    function draw_searched_users($users) 
    {
        drawTitle("Users");

        if (sizeof($users)) {
        foreach($users as $user)
        {
?>
            <a href="../pages/user-posts.php?username=<?=$user['username']?>"><?=$user['username']?></a><br>
<?php
        }
    } else {
        draw_not_found();
    }
?>
<?php
    }
?>