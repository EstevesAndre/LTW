<?php function draw_publications($publications) 
    {
?>

    <?php
        foreach($publications as $pub)
        {
            $vote = getVote($_SESSION['username'], $pub['id'], NULL);
            if($vote == NULL)
                draw_publication($pub, 0);
            else 
                draw_publication($pub,$vote['upDown']); 
        }
        
        draw_add_publication();
    ?>
<?php
    }
?>

<?php function draw_publication($pub, $vote) 
    {
?>
    <article class="min-article">
        <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
        <div class="article-head">
            <div class="categories">
                <span>
        </a>
                    <?php
                        $tags = explode(",",$pub['tags']);
                        foreach($tags as $tag) 
                        { 
                    ?>
                        <a href="../pages/category.php?category=<?=$tag?>" class="com-user"><?=$tag?>&nbsp</a>
                    <?php } ?>
                </span>
            </div>
            <div class="op"><span>Posted by <a href="../pages/user-posts.php?username=<?=$pub['username']?>" class="com-user"><?=$pub['username']?></a></span></div>
        <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
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
            <?php
                drawFreshVotes($pub['id'], $vote);
            ?>
            <div class="comments">
                <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
                    <i class="far fa-comments"></i> 
                </a>
            </div>
            <?php if(checkIsPublicationOwner($_SESSION['username'], $pub['id'])) { ?>
                <div class="trash">
                    <a href="../api/deletePublication.php?publication_id=<?=$pub['id']?>">
                        <i class="far fa-trash-alt"></i>
                    </a> 
                </div>
            <?php } ?>
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
                <p class="article-category">
                    <?php
                        $tags = explode(",",$pub['tags']);
                        foreach($tags as $tag) 
                        { 
                    ?>
                        <a href="../pages/category.php?category=<?=$tag?>" class="com-user"><?=$tag?>&nbsp</a>
                    <?php } ?>
                </p>
                <p class="op"><span>Posted by <a href="../pages/user-posts.php?username=<?=$pub['username']?>" class="com-user"><?=$pub['username']?></a></span></p>
                <p class="time"><span><?=$pub['timestamp']?></span></p>
                <p class="title"><span><?=$pub['title']?></span></p>
                <p class="text"><?=$pub['fulltext']?></p>
            </div>
            <div class="dynamic-article">
                <div class="vote-section">
                    <?php 
                        drawInPubVotes($pub['id'], NULL, $vote, $votes_cnt);
                    ?>
                    <?php if(checkIsPublicationOwner($_SESSION['username'], $pub['id'])) { ?>
                        <div class="trash">
                            <a href="../api/deletePublication.php?publication_id=<?=$pub['id']?>">
                                <i class="far fa-trash-alt"></i>
                            </a> 
                        </div>
                    <?php } ?>
                </div>                
                <div class="comment-section">
                    <section id="comments-section">
                        <div class="new-comment">
                            <form>
                                <input type="hidden" name="publication_id" value="<?=$pub['id']?>">
                                <input type="hidden" name="comment_id">
                                <textarea name="fulltext" rows="4" cols="100"></textarea><br>
                                <input class="button" type="button" value="Comment">
                            </form>
                        </div>
                        <?php
                            drawCommentsOfPublication($pub['id'], $comments);
                        ?>                        
                    </section>                
                </div> 
            </div>
        </article>
    </div>
<?php
    }
?>

<?php
    function draw_comment($comment, $pub_id, $vote, $votes_cnt)
    {
?>        
        <div class="comment">
            <a href="../pages/user-posts.php?username=<?=$comment['username']?>" class="com-user"><?=$comment['username']?></a>
            <p class="sep">&nbsp - &nbsp</p>
            <p class="com-date"><?=$comment['timestamp']?></p>
            <?php if(checkIsCommentOwner($_SESSION['username'], $comment['id'])) { ?>
                <a class="com-trash" href="../api/deleteComment.php?publication_id=<?=$pub_id?>&comment_id=<?=$comment['id']?>">
                    <i class="far fa-trash-alt"></i>
                </a>
            <?php } ?>
            <p class="com-text">&nbsp  &nbsp
            <?php if ($comment['tags'] != null) { ?> 
                @<?=$comment['tags']?>,
            <?php } ?>
            &nbsp<?=$comment['text']?></p>
            <div class="vote-section">
                <?php
                    drawInPubVotes($pub_id, $comment['id'], $vote, $votes_cnt);
                ?>
            </div>
            <section class="sub-comment-section" id="comments-section">
                <form class="comment-response">                                
                    <input type="hidden" name="publication_id" value="<?=$pub_id?>">
                    <input type="hidden" name="comment_id" value="<?=$comment['id']?>">
                    <textarea name="fulltext" rows="2" cols="40"></textarea>
                    <input class="button" type="button" value="Comment">
                </form>
                <div class="sub-comment">
                    <?php 
                        $childComments = getCommentsOfComment($comment['id']);
                        foreach($childComments as $childcomment)
                        {   
                            $commentVote = getVote($_SESSION['username'], NULL, $childcomment['id']);
                            $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$childcomment['id'],1)['cnt'], 'down' => getPublicationVotes(NULL, $childcomment['id'],-1)['cnt']]; 
                            draw_comment($childcomment, $pub_id, $commentVote['upDown'], $commentVoteCnt);
                        }
                    ?>            
                </div>
            </section>
        </div>
<?php
    }
?>

<?php 
    function draw_new_article($channels) 
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
                    <input name="category" list="categories" value="">
                    <datalist id="categories">
                        <?php foreach($channels as $channel) { ?>
                            <option value="<?=$channel['cType']?>">
                        <?php } ?>
                    </datalist>
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

<?php
    function drawFreshVotes($publication_id, $vote)
    {
?>
        <div class="vote-toggle">
            <div class="thumbs-up">
                <a id="thumb">
                    <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                    <input type="hidden" name="comment_id">  
                    <input type="hidden" name="choice" value="up">
                    <input type="hidden" name="option" value="fresh"> 
                    
                    <?php if($vote != 1) { ?><i class="far fa-thumbs-up"></i>
                    <?php } else { ?><i class="fas fa-thumbs-up"></i>
                    <?php } ?>
                </a>
            </div>
            <div class="thumbs-down">
                <a id="thumb">
                    <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                    <input type="hidden" name="comment_id">  
                    <input type="hidden" name="choice" value="down">
                    <input type="hidden" name="option" value="fresh"> 

                    <?php if($vote != -1) { ?><i class="far fa-thumbs-down"></i>
                    <?php } else { ?><i class="fas fa-thumbs-down"></i>
                    <?php } ?>
                </a>
            </div>
        </div>
<?php
    }
?>

<?php
    function drawInPubVotes($publication_id, $comment_id, $vote, $votes_cnt)
    {
?>
        <div class="vote-toggle">
            <div class="votes">
                <a id="thumb">
                    <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                    <input type="hidden" name="comment_id" value="<?=$comment_id?>">  
                    <input type="hidden" name="choice" value="up">
                    <input type="hidden" name="option" value="single_article"> 

                    <?php if($vote == 1) { ?>
                        <i class="fas fa-thumbs-up"></i>
                    <?php } else { ?>
                        <i class="far fa-thumbs-up"></i>
                    <?php } ?>
                </a>                        
                <span><?=$votes_cnt['up']?> </span>
            </div>
            <div class="votes">
                <a id="thumb">
                    <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                    <input type="hidden" name="comment_id" value="<?=$comment_id?>">  
                    <input type="hidden" name="choice" value="down">
                    <input type="hidden" name="option" value="single_article">   

                    <?php if($vote == -1) { ?>
                        <i class="fas fa-thumbs-down"></i>
                    <?php } else { ?>
                        <i class="far fa-thumbs-down"></i>
                    <?php } ?>
                </a>
                <span><?=$votes_cnt['down']?> </span>
            </div>
        </div>
<?php
    }
?>

<?php
    function drawCommentsOfPublication($publication_id, $comments) 
    {
?>
    <div class="sub-comment">
        <?php
            foreach($comments as $comment)
            {   
                $commentVote = getVote($_SESSION['username'], NULL, $comment['id']);
                $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$comment['id'],1)['cnt'], 'down' => getPublicationVotes(NULL, $comment['id'],-1)['cnt']]; 
                draw_comment($comment, $publication_id, $commentVote['upDown'], $commentVoteCnt);
            }
        ?>  
    </div>
<?php
    }
?>