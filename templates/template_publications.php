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
                <p class="article-category"><?=$pub['tags']?></p>
                <p class="op"><span>Posted by <?=$pub['username']?></span></p>
                <p class="time"><span><?=$pub['timestamp']?></span></p>
                <p class="title"><span><?=$pub['title']?></span></p>
                <p class="text"><?=$pub['fulltext']?></p>
            </div>
            <div class="dynamic-article">
                <div class="vote-section">
                    <div class="votes">
                        <a id="thumb">
                            <input type="hidden" name="publication_id" value="<?=$pub['id']?>">
                            <input type="hidden" name="comment_id">  
                            <input type="hidden" name="choice" value="up">
                            <input type="hidden" name="option" value="single_article"> 

                            <?php if($vote == 1) { ?>
                                <i class="fas fa-thumbs-up"></i>
                            <?php } else { ?>
                                <i class="far fa-thumbs-up"></i>
                            <?php } ?>
                        </a>                        
                        <span><?=$votes_cnt['up']?></span>
                    </div>
                    <div class="votes">
                        <a id="thumb">
                            <input type="hidden" name="publication_id" value="<?=$pub['id']?>">
                            <input type="hidden" name="comment_id">  
                            <input type="hidden" name="choice" value="down">
                            <input type="hidden" name="option" value="single_article">   

                            <?php if($vote == -1) { ?>
                                <i class="fas fa-thumbs-down"></i>
                            <?php } else { ?>
                                <i class="far fa-thumbs-down"></i>
                            <?php } ?>
                        </a>
                        <span><?=$votes_cnt['down']?></span>
                    </div>
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
                        <div class="sub-comment">
                            <?php
                                foreach($comments as $comment)
                                {   
                                    $commentVote = getVote($_SESSION['username'], NULL, $comment['id']);
                                    $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$comment['id'],1)['cnt'], 'down' => getPublicationVotes(NULL, $comment['id'],-1)['cnt']]; 
                                    draw_comment($comment, $pub['id'], $commentVote['upDown'], $commentVoteCnt);
                                }
                            ?>  
                        </div>
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
            <a href="" class="com-user"><?=$comment['username']?></a>
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
                <div class="votes">
                    <a id="thumb">
                        <input type="hidden" name="publication_id" value="<?=$pub_id?>">
                        <input type="hidden" name="comment_id" value="<?=$comment['id']?>">  
                        <input type="hidden" name="choice" value="up">
                        <input type="hidden" name="option" value="single_article">    

                        <?php if($vote == 1) { ?>
                            <i class="fas fa-thumbs-up"></i>
                        <?php } else { ?>
                            <i class="far fa-thumbs-up"></i>
                        <?php } ?>                            
                    </a>
                    <span><?=$votes_cnt['up']?></span>
                </div>
                <div class="votes">
                    <a href="../api/thumbsUpDown.php?publication_id=<?=$pub_id?>&choice=down&option=single_article&comment_id=<?=$comment['id']?>">
                        <?php if($vote == -1) { ?>
                            <i class="fas fa-thumbs-down"></i>
                        <?php } else { ?>
                            <i class="far fa-thumbs-down"></i>
                        <?php } ?>
                    </a>
                    <span><?=$votes_cnt['down']?></span>
                </div>
            </div>
            <section class="sub-comment-section">
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
                <form method="post" action="../api/add_publication.php">
                    <p class="title">New Article</p><br><br>
                    <p>Title:</p>
                        <input type="text" name="title"><br>
                    <p>Category:</p>
                    <input name="category" list="categories" value="General">
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