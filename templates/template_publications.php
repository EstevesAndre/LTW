<?php function draw_publications($publications) 
    {
?>
    <div class="article-container">

    <?php
        foreach($publications as $pub)
        {
            $vote = getVote($_SESSION['username'], $pub['id']);
            if($vote == NULL)
                draw_publication($pub, 0);
            else 
                draw_publication($pub,$vote['upDown']); 
        }
        
        draw_add_publication();
    ?>
    
    </div>
<?php
    }
?>

<?php function draw_publication($pub, $vote) 
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
                <a href="../api/thumbsUpDown.php?publication_id=<?=$pub['id']?>&choice=up&option=fresh">
                    <?php if($vote == 1) { ?>
                        <i class="fas fa-thumbs-up"></i>
                    <?php } else { ?>
                        <i class="far fa-thumbs-up"></i>
                    <?php } ?>
                </a>
            </div>
            <div class="thumbs-down">                
                <a href="../api/thumbsUpDown.php?publication_id=<?=$pub['id']?>&choice=down&option=fresh">
                    <?php if($vote == -1) { ?>
                        <i class="fas fa-thumbs-down"></i>
                    <?php } else { ?>
                        <i class="far fa-thumbs-down"></i>
                    <?php } ?>
                </a>
            </div>
            <div class="comments">
                <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
                    <i class="far fa-comments"></i> 
                </a>
            </div>
            <div class="trash">
                <a href="../api/deletePublication.php?publication_id=<?=$pub['id']?>">
                    <i class="far fa-trash-alt"></i>
                </a> 
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
    function draw_singlePublication($pub, $comments, $vote, $votes_cnt) 
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
                        <a href="../api/thumbsUpDown.php?publication_id=<?=$pub['id']?>&choice=up&option=single_article">
                            <?php if($vote == 1) { ?>
                                <i class="fas fa-thumbs-up"></i>
                            <?php } else { ?>
                                <i class="far fa-thumbs-up"></i>
                            <?php } ?>
                            <span><?=$votes_cnt['up']?></span>
                        </a>
                    </div>
                    <div class="votes">
                        <a href="../api/thumbsUpDown.php?publication_id=<?=$pub['id']?>&choice=down&option=single_article">
                            <?php if($vote == -1) { ?>
                                <i class="fas fa-thumbs-down"></i>
                            <?php } else { ?>
                                <i class="far fa-thumbs-down"></i>
                            <?php } ?>
                            <span><?=$votes_cnt['down']?></span>
                        </a>
                    </div>
                </div>
                <div class="comment-section">
                    <div class="new-comment">
                        <form method="post" action="../actions/add_comment.php?publication_id=<?=$pub['id']?>">
                            <textarea name="fulltext" rows="4" cols="100"></textarea><br>
                            <input class="button" type="submit" value="Comment">
                        </form>
                    </div>
                            <?php   
                                foreach($comments as $comment)
                                    draw_comment($comment, $pub['id']);
                            ?>                 
                </div>
            </div>
        </article>
    </div>
<?php
    }
?>

<?php
    function draw_comment($comment, $pub_id)
    {
?>        
<div class="comment">
            <p class="com-user"><?=$comment['username']?></p>
            <p class="sep">&nbsp - &nbsp</p>
            <p class="com-date"><?=$comment['timestamp']?></p> 
            <a class="com-trash" href="../api/deleteComment.php?publication_id=<?=$pub_id?>&comment_id=<?=$comment['id']?>">
                <i class="far fa-trash-alt"></i>
            </a>
            <p class="com-text">&nbsp  &nbsp
            <?php if ($comment['tags'] != null) { ?> 
                @<?=$comment['tags']?>,
            <?php } ?>
            &nbsp<?=$comment['text']?></p>            
            </div>
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