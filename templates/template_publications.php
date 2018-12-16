<?php function draw_publications($publications, $order, $pref_category = NULL, $type = "pub") 
    {
?>
    <?php
        foreach($publications as $pub)
        {
            if(!isset($_SESSION['username']))
                draw_publication($pub, 0, $order);
            else
            { 
                    $vote = getVote($_SESSION['username'], $pub['id'], NULL);
                if($vote == NULL)
                    draw_publication($pub, 0, $order);
                else 
                    draw_publication($pub,$vote['upDown'], $order); 
            }
        }
        
        if($type == "pub")
            draw_add_publication($pref_category);
    ?>
<?php
    }
?>

<?php function draw_publication($pub, $vote, $order) 
    {
?>
     <article class="min-article">
        <div class="article-head">
            <div class="categories">
                <a class="category" href="../pages/category.php?category=<?=$pub['category']?>"><?=$pub['category']?></a>
            </div>
            <div class="op">
                <span>
                    Posted by <a href="../pages/user-posts.php?username=<?=$pub['username']?>" class="com-user"><?=$pub['username']?></a>
                </span>
            </div>
            <div class="time">
                <span><?=$pub['timestamp']?></span>
            </div>
            <a class="link" href="../pages/publication.php?publication_id=<?=$pub['id']?>">
                <div class="title">
                    <span><?=$pub['title']?></span>
                </div>
                <div class="text-container">
                    <p class="text">
                        <?=drawTextWithTags($pub['fulltext']);?>
                    </p>
                </div>
            </a>
        </div>
        <div class="footer">                        
            <div class="vote-toggle">
                <?php
                    drawFreshVotes($pub['id'], $vote, $pub['username']);
                ?>
            </div>
            <div class="comments">
                <?php if(isset($_SESSION['username'])) { ?>
                    <a href="../pages/publication.php?publication_id=<?=$pub['id']?>">
                        <i class="far fa-comments"></i> 
                    </a>
                <?php } else { ?>                
                    <a href="../pages/login.php">
                        <i class="far fa-comments"></i> 
                    </a>
                <?php } ?>
            </div>
            <?php if(isset($_SESSION['username']) && checkIsPublicationOwner($_SESSION['username'], $pub['id'])) { ?>
                <div class="trash">
                    <a class="fresh-trash">
                        <input type="hidden" name="publication_id" value="<?=$pub['id']?>">
                        <input type="hidden" name="order" value="<?=$order?>">
                        <i class="far fa-trash-alt"></i>
                    </a> 
                </div>
            <?php } ?>
        </div>
    </article>
<?php
    }
?>

<?php function draw_add_publication($category = NULL) 
    {
?>
    <?php if(isset($_SESSION['username'])) { ?>
            <a href="../pages/new-article.php?pref_category=<?=$category?>">
    <?php } else { ?> 
        <a href="../pages/login.php">
    <?php } ?>
        <article class="min-article">
            <img class="add" src="../assets/plus.png" />
        </article>
    </a>
<?php
    }
?>

<?php 
    function draw_new_article($channels, $category = "") 
    { 
?>
    <section id="login">      
        <div class="article-container">
            <div class="form-container">
                <form method="post" action="../actions/add_publication.php">
                    <p class="title">New Article</p><br><br>
                    <p>Title:</p>
                        <input type="text" name="title" required><br>
                    <p>Category:</p>
                    <input name="category" list="categories" value='<?=$category?>' required>
                    <datalist id="categories">
                        <?php foreach($channels as $channel) { ?>
                            <option value="<?=$channel['cType']?>">
                        <?php } ?>
                    </datalist>
                    <p>Write Something:</p>
                    <textarea name="fulltext" required></textarea><br>
                    <input class="button" type="submit" value="Post">
                </form>
            </div>
        </div>

    </section>
<?php 
    } 
?>

 <?php 
    function draw_singlePublication($pub, $comments, $vote, $votes_cnt) 
    {
        if(isset($_SESSION['username']))
            $session = $_SESSION['username'];
        else
            $session = NULL;
?>
    <div class="article-container">
        <article class="max-article">
            <div class="static-article">
                <p class="article-category">
                    <a href="../pages/category.php?category=<?=$pub['category']?>" class="com-user"><?=$pub['category']?>&nbsp</a>
                </p>
                <p class="op"><span>Posted by <a href="../pages/user-posts.php?username=<?=$pub['username']?>" class="com-user"><?=$pub['username']?></a></span></p>
                <p class="time"><span><?=$pub['timestamp']?></span></p>
                <p class="title"><span><?=$pub['title']?></span></p>
                <p class="text"><?=drawTextWithTags($pub['fulltext']);?></p>
            </div>
            <div class="dynamic-article">
                <div class="vote-section">
                    <?php 
                        drawInPubVotes($pub['id'], NULL, $vote, $votes_cnt, $pub['username'], NULL);
                    ?>
                    <?php if(isset($_SESSION['username']) && checkIsPublicationOwner($_SESSION['username'], $pub['id'])) { ?>
                        <div class="trash">
                            <a href="../actions/deletePublication.php?publication_id=<?=$pub['id']?>">                                
                                <i class="far fa-trash-alt"></i>
                            </a> 
                        </div>
                    <?php } ?>
                </div>                
                <div class="comment-section">
                    <?php if($session != NULL) { ?>
                        <section id="comments-section">
                    <?php } ?>     
                            <div class="new-comment">
                            <?php if($session != NULL) { ?>
                                <form>
                                    <input type="hidden" name="publication_id" value="<?=$pub['id']?>">
                                    <input type="hidden" name="comment_id">
                                    <textarea name="fulltext" rows="4" cols="100"></textarea><br>
                                    <input class="button" type="button" value="Comment">
                            <?php } else { ?>                                 
                                <textarea name="fulltext" rows="4" cols="100"></textarea><br>
                                <a href="../pages/login.php"> 
                                    <input class="button" type="button" value="Comment">
                                </a>
                            <?php } ?>
                            </div>                            
                            <div class="sub-comment">
                                <?php
                                    drawCommentsOfPublication($pub['id'], $comments);
                                ?>      
                            </div>
                    <?php if($session != NULL) { ?>                  
                        </section> 
                    <?php } ?>                 
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
        if(isset($_SESSION['username']))
            $session = $_SESSION['username'];
        else
            $session = NULL;
?>        
        <div class="comment">
            <a href="../pages/user-posts.php?username=<?=$comment['username']?>" class="com-user"><?=$comment['username']?></a>
            <p class="sep">&nbsp - &nbsp</p>
            <p class="com-date"><?=$comment['timestamp']?></p>
            <?php if(isset($_SESSION['username']) && checkIsCommentOwner($_SESSION['username'], $comment['id'])) { ?>
                <a class="com-trash">
                    <input type="hidden" name="publication_id" value="<?=$pub_id?>">                    
                    <input type="hidden" name="comment_id" value="<?=$comment['id']?>">
                    <i class="far fa-trash-alt"></i>
                </a>
            <?php } ?>
            <p class="com-text">&nbsp  &nbsp<?=drawTextWithTags($comment['text'])?></p>            
            <div class="vote-section">
                <?php drawInPubVotes($pub_id, $comment['id'], $vote, $votes_cnt, NULL, $comment['username']); ?>
            </div>
            <div class="comment-response">
            <?php if($session != NULL) { ?>
                <section class="sub-comment-section">
                    <form class="comment-response">
                        <input type="hidden" name="publication_id" value="<?=$pub_id?>">
                        <input type="hidden" name="comment_id" value="<?=$comment['id']?>">
                        <textarea name="fulltext" rows="2" cols="40"></textarea>
                        <input class="button" type="button" value="Comment">
                    </form>
                <?php } else { ?>
                    <a href="../pages/login.php"> 
                        <input class="button" type="button" value="Comment">
                    </a>
                <?php } ?>
                <div class="sub-comment">
                    <?php 
                        $childComments = getCommentsOfComment($comment['id']);
                        foreach($childComments as $childcomment)
                        {   
                            if(!isset($_SESSION['username']))
                                $commentVote = ['upDown' => 0];
                            else                      
                                $commentVote = getVote($_SESSION['username'], NULL, $childcomment['id']);
                                
                            $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$childcomment['id'],1)['cnt'], 'down' => getPublicationVotes(NULL, $childcomment['id'],-1)['cnt']]; 
                            draw_comment($childcomment, $pub_id, $commentVote['upDown'], $commentVoteCnt);
                        }
                    ?>            
                </div>
            <?php if($session != NULL) { ?>
                </section>
            <?php } ?>
            </div>
        </div>
<?php
    }
?>

<?php
    function drawFreshVotes($publication_id, $vote, $pub_owner_name)
    {
        if(isset($_SESSION['username']))
            $session = $_SESSION['username'];
        else
            $session = NULL;
?>
        <div class="thumbs-up">
            <?php if($session != NULL) { ?>
                <a id="thumb">
            <?php } ?>
                <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                <input type="hidden" name="comment_id">
                <input type="hidden" name="publication_username" value="<?=$pub_owner_name?>">
                <input type="hidden" name="comment_username">
                <input type="hidden" name="session_username" value="<?=$session?>">
                <input type="hidden" name="choice" value="up">
                <input type="hidden" name="option" value="fresh"> 
                
                <?php if($vote == 1) { ?>
                    <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                        <i class="fas fa-thumbs-up"></i>
                    <?php if($session == NULL) { ?> </a> <?php } ?>
                <?php } else { ?>
                    <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                        <i class="far fa-thumbs-up"></i>
                    <?php if($session == NULL) { ?> </a> <?php } ?>
                <?php } ?>
            <?php if($session != NULL) { ?>
                </a>
            <?php } ?>
        </div>
        <div class="thumbs-down">
            <?php if($session != NULL) { ?>
                <a id="thumb">
            <?php } ?>
                <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                <input type="hidden" name="comment_id">  
                <input type="hidden" name="publication_username" value="<?=$pub_owner_name?>">
                <input type="hidden" name="comment_username">
                <input type="hidden" name="session_username" value="<?=$session?>">
                <input type="hidden" name="choice" value="down">
                <input type="hidden" name="option" value="fresh"> 

                <?php if($vote == -1) { ?>
                    <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                        <i class="fas fa-thumbs-down"></i>
                    <?php if($session == NULL) { ?> </a> <?php } ?>
                <?php } else { ?>
                    <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                        <i class="far fa-thumbs-down"></i>
                    <?php if($session == NULL) { ?> </a> <?php } ?>
                <?php } ?>
            <?php if($session != NULL) { ?>
                </a>
            <?php } ?>
        </div>
<?php
    }
?>

<?php
    function drawInPubVotes($publication_id, $comment_id, $vote, $votes_cnt, $pub_owner_name, $com_owner_name)
    {
        if(isset($_SESSION['username']))
            $session = $_SESSION['username'];
        else
            $session = NULL;

?>
        <div class="vote-toggle">
            <div class="votes">
                <?php if($session != NULL) { ?>
                    <a id="thumb">
                <?php } ?>
                    <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                    <input type="hidden" name="comment_id" value="<?=$comment_id?>">
                    <input type="hidden" name="publication_username" value="<?=$pub_owner_name?>">
                    <input type="hidden" name="comment_username" value="<?=$com_owner_name?>">
                    <input type="hidden" name="session_username" value="<?=$session?>">
                    <input type="hidden" name="choice" value="up">
                    <input type="hidden" name="option" value="single_article"> 

                    <?php if($vote == 1) { ?>
                        <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                            <i class="fas fa-thumbs-up"></i>
                        <?php if($session == NULL) { ?> </a> <?php } ?>
                    <?php } else { ?>
                        <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                            <i class="far fa-thumbs-up"></i>
                        <?php if($session == NULL) { ?> </a> <?php } ?>
                    <?php } ?>
                <?php if($session != NULL) { ?>
                    </a>
                <?php } ?>                  
                <span><?=$votes_cnt['up']?> </span>
            </div>
            <div class="votes">
                <?php if($session != NULL) { ?>
                    <a id="thumb">
                <?php } ?>
                    <input type="hidden" name="publication_id" value="<?=$publication_id?>">
                    <input type="hidden" name="comment_id" value="<?=$comment_id?>"> 
                    <input type="hidden" name="publication_username" value="<?=$pub_owner_name?>">
                    <input type="hidden" name="comment_username" value="<?=$com_owner_name?>"> 
                    <input type="hidden" name="session_username" value="<?=$session?>">
                    <input type="hidden" name="choice" value="down">
                    <input type="hidden" name="option" value="single_article">   

                    <?php if($vote == -1) { ?>
                        <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                            <i class="fas fa-thumbs-down"></i>
                        <?php if($session == NULL) { ?> </a> <?php } ?>
                    <?php } else { ?>
                        <?php if($session == NULL) { ?> <a href="../pages/login.php"> <?php } ?>
                            <i class="far fa-thumbs-down"></i>
                        <?php if($session == NULL) { ?> </a> <?php } ?>
                    <?php } ?>
                <?php if($session != NULL) { ?>
                    </a>
                <?php } ?>
                <span><?=$votes_cnt['down']?> </span>
            </div>
        </div>
<?php
    }
?>

<?php
    function drawCommentsOfPublication($publication_id, $comments) 
    {
        foreach($comments as $comment)
        {   
            if(!isset($_SESSION['username']))  
                $commentVote = ['upDown' => 0];
            else
                $commentVote = getVote($_SESSION['username'], NULL, $comment['id']);
                
            $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$comment['id'],1)['cnt'], 'down' => getPublicationVotes(NULL, $comment['id'],-1)['cnt']]; 
            draw_comment($comment, $publication_id, $commentVote['upDown'], $commentVoteCnt);
        }
    }
?>

<?php
    function drawSearchedComments($comments)
    {
        foreach($comments as $comment)
        {
            if(!isset($_SESSION['username']))  
                $commentVote = ['upDown' => 0];
            else
                $commentVote = getVote($_SESSION['username'], NULL, $comment['id']);
                
            $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$comment['id'],1)['cnt'], 'down' => getPublicationVotes(NULL, $comment['id'],-1)['cnt']]; 
            draw_single_comment($comment, $comment['publication_id'], $commentVote['upDown'], $commentVoteCnt);
        }
    }
?>

<?php
    function draw_single_comment($comment, $pub_id, $vote, $votes_cnt)
    {
        if(isset($_SESSION['username']))
            $session = $_SESSION['username'];
        else
            $session = NULL;
?>        
        <div class="single-comment">
            <a href="../pages/user-posts.php?username=<?=$comment['username']?>" class="com-user"><?=$comment['username']?></a>
            <p class="sep">&nbsp - &nbsp</p>
            <p class="com-date"><?=$comment['timestamp']?></p>
            <?php if(isset($_SESSION['username']) && checkIsCommentOwner($_SESSION['username'], $comment['id'])) { ?>
                <a class="com-trash">
                    <input type="hidden" name="publication_id" value="<?=$pub_id?>">                    
                    <input type="hidden" name="comment_id" value="<?=$comment['id']?>">
                    <i class="far fa-trash-alt"></i>
                </a>
            <?php } ?>
            <p class="com-text">&nbsp  &nbsp<?=$comment['text']?></p>
            <div class="vote-section">
                <?php drawInPubVotes($pub_id, $comment['id'], $vote, $votes_cnt, NULL, $comment['username']); ?>
        </div>
<?php
    }
?>

<?php
    function getTagType($tag)
    {
        $type = 'no-type';

        if(existsCategory($tag))
            $type = 'channel';
        else if(existsUser($tag))
            $type = 'user';
        else if (filter_var($tag, FILTER_VALIDATE_URL))
            $type = 'url';
        else if(substr($tag, 0, 3) == 'www')
        {
            $tag = "https://" . $tag;
            if (filter_var($tag, FILTER_VALIDATE_URL))
                $type = 'url-h';
        }

        return $type;
    }
?>

<?php
    function drawTextWithTags($text)
    {
        preg_match_all("~\[tag\](.*?)\[\/tag\]~",$text,$tags);

        for($i = 0; $i < sizeof($tags[0]); $i++)
        {
            $type = getTagType($tags[1][$i]);

            switch($type)
            {
                case 'channel':
                    $tags[1][$i] = "<a href='../pages/category.php?category=" . $tags[1][$i] . "'>[Channel]" . $tags[1][$i] . "</a>";                    
                    $text = str_replace($tags[0][$i], $tags[1][$i], $text);
                    break;
                case 'user':
                    $tags[1][$i] = "<a href='../pages/user-posts.php?username=" . $tags[1][$i] . "'>[User]" . $tags[1][$i] . "</a>";
                    $text = str_replace($tags[0][$i], $tags[1][$i], $text);
                    break;
                case 'url':
                    $tags[1][$i] = "<a href='" . $tags[1][$i] . "'>Extern Link</a>";
                    $text = str_replace($tags[0][$i], $tags[1][$i], $text);
                    break;
                case 'url-h':
                    $tags[1][$i] = "<a href='https://" . $tags[1][$i] . "'>External Link</a>";
                    $text = str_replace($tags[0][$i], $tags[1][$i], $text);
                    break;
                default: // NONE
                    $text = str_replace($tags[0][$i], $tags[1][$i], $text);
            }
        }

        return $text;
    }
?>
