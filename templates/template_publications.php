<?php function draw_publications($publications) 
    {
?>
    <div class="article-container">

    <?php
        foreach($publications as $pub)
            draw_publication($pub);

        //draw_add_publication();
    ?>
    
    </div>
<?php
    }
?>

<?php function draw_publication($pub) 
    {
        $time = strtotime($pub['published']);
        $myFormatForView = date("m/d/y g:i A", $time);
?>
    <article class="min-article">
        <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
            <div class="article-head">
                <div class="categories"><span><?=$pub['tags']?></span></div>
                <div class="op"><span>Posted by <?=$pub['username']?></span></div>
                <div class="time"><span><?=$myFormatForView?></span></div>
                <div class="title"><span><?=$pub['title']?></span></div>
            </div>
            <div class="text-container">
                <p class="text">
                    <?=$pub['fulltext']?>
                </p>
            </div>
        </a>
        <div class="footer">
            <div class="thumbs-up">
                <img src="../assets/thumbs-up.png" />
            </div>
            <div class="thumbs-down">
                <img src="../assets/thumb-down.png" />
            </div>
            <div class="comments">
                <img src="../assets/comment.png" />
            </div>
        </div>
    </article>
<?php
    }
?>

 <?php 
    function draw_singlePublication($pub,$comments,$upVotes,$downVotes) 
    {
        $time = strtotime($pub['published']);
        $myFormatForView = date("m/d/y g:i A", $time);
?>
    <div class="article-container">
        <article class="max-article">
            <div class="static-article">
                <p class="article-category"><?=$pub['tags']?></p>
                <p class="op"><span>Posted by <?=$pub['username']?></span></p>
                <p class="time"><span><?=$myFormatForView?></span></p>
                <p class="title"><span><?=$pub['title']?></span></p>
                <p class="text"><?=$pub['fulltext']?></p>
            </div>
            <div class="dynamic-article">
                <div class="vote-section">
                    <div class="votes">
                        <img src="../assets/thumbs-up.png" />
                        <span><?=$upVotes['up']?></span>
                    </div>
                    <div class="votes">
                        <img src="../assets/thumb-down.png" />
                        <span><?=$downVotes['down']?></span>
                    </div>
                </div>
                <div class="comment-section">
                    <div class="new-comment">
                        <textarea rows="4" cols="100"></textarea><br>
                        <input class="button" type="submit" value="Comment">
                    </div>
                    <div class="comment">
<?php   
    foreach($comments as $comment)
        draw_comment($comment);
?>                    
                    </div>
                </div>
            </div>
        </article>
    </div>
<?php
    }
?>

<?php
    function draw_comment($comment)
    {
        $time = strtotime($comment['published']);
        $myFormatForView = date("m/d/y g:i A", $time);
?>    
        <p class="com-user"><?=$comment['username']?></p>
        <p class="sep">&nbsp - &nbsp</p>
        <p class="com-date"><?=$myFormatForView?></p>    
        <p class="com-text">&nbsp  &nbsp@<?=$comment['tags']?>,&nbsp<?=$comment['text']?></p>
<?php
    }
?>