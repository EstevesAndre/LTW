<?php
    include_once('../includes/database.php');
    
    //DONE
    function getUserPublications($username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM publication WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    //DONE
    function getUserComments($username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM comment WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    // NEED TO BE CHANGED
    function getCommentsOfUserPublication($idPublication)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM comment WHERE news_id= ?');
        $stmt->execute(array($idPublication));
        return $stmt->fetchAll();
    }

    // NOT DONEEEE
    function getUserUpVotes();
    function getUserDownVotes();

    //DONE
    function insertUserLikesChannel($idChannel, $username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO userLikesChannel VALUES(?, ?)');
        $stmt->execute(array($idChannel, $username));
    }

    //DONE
    function deleteUserLikesChannel($idChannel, $username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM userLikesChannel WHERE id_channel= ? username_user= ?');
        $stmt->execute(array($idChannel, $username));
    }

    //DONE
    function checkIsPublicationOwner($idPublication)
    {        
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM publication WHERE id= ?');
        $stmt->execute(array($idPublication));
        return $stmt->fetch()?true:false; // return true if a line exists
    }
    
    //DONE
    function checkIsCommentOwner($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM comment WHERE id= ?');
        $stmt->execute(array($idComment));
        return $stmt->fetch()?true:false; // return true if a line exists
    }
        
    function insertPublication($type, $title, $published, $tags, $username, $introduction, $fulltext, $image_path)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO publication VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0)');
        $stmt->execute(array($type, $title, $published, $tags, $username, $introduction, $fulltext, $image_path));        
    }

    function deletePublication($id)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM publication WHERE id= ?');
        $stmt->execute(array($id));
    }

    function getPublication($idPublication)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM publication WHERE id= ?');
        $stmt->execute(array($idPublication));
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    function insertComment($type, $news_id, $username, $comment_to, $published, $tags, $text)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO comment VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, 0, 0)');
        $stmt->execute(array($type, $news_id, $username, $comment_to, $published, $tags, $text));        
    }

    function deleteComment($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM comment WHERE id= ?');
        $stmt->execute(array($idComment));
    }

    function getComment($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM comment WHERE id= ?');
        $stmt->execute(array($idComment));
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    function insertVote($type, $username, $idOfType)
    {
        $db = Database::instance()->db();
        if($type == 'C')
            $stmt = $db->prepare('INSERT INTO voted VALUES(NULL, ?, ?, NULL, ?)');
        else if($type == 'P')
            $stmt = $db->prepare('INSERT INTO voted VALUES(NULL, ?, ?, ?, NULL)');
        
        $stmt->execute(array($type,$username,$idOfType));
    }

    function deleteVote($idVote)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM voted WHERE id= ?');
        $stmt->execute(array($idVote));
    }

?>