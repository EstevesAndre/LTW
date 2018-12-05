<?php function draw_publications($publications) 
    {
?>
    <div class="article-container">

    <?php
        foreach($publications as $pub)
            draw_publication($pub);
            draw_add_publication();
    ?>
    
    </div>
<?php
    }
?>

<?php function draw_publication($pub) 
    {
?>
    <article class="min-article">
        <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
            <div class="article-head">
                <div class="categories"><span><?=$pub['tags']?></span></div>
                <div class="op"><span>Posted by <?=$pub['username']?></span></div>
                <div class="time"><span><?=$pub['timestamp']?></span></div>
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
                <i class="far fa-thumbs-up"></i>
            </div>
            <div class="thumbs-down">
                <i class="far fa-thumbs-down"></i>
            </div>
            <div class="comments">
                <a href="../actions/add_comment.php?publication_id=<?=$pub['id']?>">
                    <i class="far fa-comments"></i> 
                </a>
            </div>
            <div class="trash">
                <i class="far fa-trash-alt"></i>                
            </div>
        </div>
    </article>
<?php
    }
?>

<?php function draw_add_publication() 
    {
?>
    <a href="../pages/new-article.php">
        <article class="min-article">
            <img class="add" src="../assets/plus.png" />
        </article>
    </a>
<?php
    }
?>

 <?php 
    function draw_singlePublication($pub,$comments,$votes) 
    {
?>
    <div class="article-container">
        <article class="max-article">
            <div class="static-article">
                <p class="article-category"><?=$pub['tags']?></p>
                <p class="op"><span>Posted by <?=$pub['username']?></span></p>
                <p class="time"><span><?=$pub['timestamp']?></span></p>
                <p class="title"><span><?=$pub['title']?></span></p>
                <p class="text"><?=$pub['fulltext']?></p>
            </div>
            <div class="dynamic-article">
                <div class="vote-section">
                    <div class="votes">
                        <i class="far fa-thumbs-up"></i>
                        <span><?=$votes['up']?></span>
                    </div>
                    <div class="votes">
                        <i class="far fa-thumbs-down"></i>
                        <span><?=$votes['down']?></span>
                    </div>
                </div>
                <div class="comment-section">
                    <div class="new-comment">
                        <form method="post" action="../actions/add_comment.php?publication_id=<?=$pub['id']?>">
                            <textarea name="fulltext" rows="4" cols="100"></textarea><br>
                            <input class="button" type="submit" value="Comment">
                        </form>
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
?>    
        <p class="com-user"><?=$comment['username']?></p>
        <p class="sep">&nbsp - &nbsp</p>
        <p class="com-date"><?=$comment['timestamp']?></p> 
        <p class="com-text">&nbsp  &nbsp
        <?php if ($comment['tags'] != null) { ?> 
            @<?=$comment['tags']?>,
        <?php } ?>
        &nbsp<?=$comment['text']?></p>
<?php
    }
?>

<?php 
    function draw_new_article() 
    { 
?>
    <section id="login">      
        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/add_publication.php">
                    <p class="title">New Article</p><br><br>
                    <p>Title:</p>
                        <input type="text" name="title"><br>
                    <p>Category:</p>
                        <input type="text" name="category" placeholder="Ex: 'Buddhism,Christianity'"><br>
                    <p>Write Something:</p>
                        <textarea name="fulltext"></textarea><br>
                        <input class="button" type="submit" value="Post">
                </form>
            </div>
        </div>

    </section>
<?php 
    } 
?>