<?php
    include_once('../includes/database.php');
    
    //DONE
    function getPublications()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //DONE
    function getUserPublications($username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    //DONE
    function getUserInfo($username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM User WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    //DONE
    function updateUser($username, $email, $name, $surname, $genre, $age)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('UPDATE User SET email= ? , name= ? , surname= ? , genre= ? , age= ? WHERE username= ?');
        $stmt->execute(array($email, $name, $surname, $genre, $age, $username));
        return $stmt->fetch();
    }    
    
    //DONE
    function getAllReligions()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare("SELECT * FROM Channel ORDER BY cType");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //DONE
    function getUserComments($username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    //DONE
    function getPublicationComments($pudlication_id)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE publication_id= ?');
        $stmt->execute(array($pudlication_id));
        return $stmt->fetchAll();
    }

    //DONE
    function insertUserLikesChannel($idChannel, $username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO UserLikesChannel VALUES(?, ?)');
        $stmt->execute(array($idChannel, $username));
    }

    //DONE
    function deleteUserLikesChannel($idChannel, $username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM UserLikesChannel WHERE id_channel= ? username_user= ?');
        $stmt->execute(array($idChannel, $username));
    }

    //DONE
    function checkIsPublicationOwner($username, $idPublication)
    {        
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication WHERE username= ? AND id= ?');
        $stmt->execute(array($username, $idPublication));
        return $stmt->fetch()?true:false; // return true if a line exists
    }
    
    //DONE
    function checkIsCommentOwner($idComment, $username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE id= ? AND username= ?');
        $stmt->execute(array($idComment,$username));
        return $stmt->fetch()?true:false; // return true if a line exists
    }
    
    //DONE
    function insertPublication($username, $published, $tags, $title, $fulltext)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO Publication VALUES(NULL, ?, ?, ?, ?, ?)');
        $stmt->execute(array($username, $published, $tags, $title, $fulltext));
    }

    //DONE
    function deletePublication($id)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Publication WHERE id= ?');
        $stmt->execute(array($id));
    }

    //DONE
    function getPublication($idPublication)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication WHERE id= ?');
        $stmt->execute(array($idPublication));
        return $stmt->fetch();
    }

    //DONE
    function insertComment($username, $publication_id, $comment_id, $published, $tags, $text)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO Comment VALUES(NULL, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($username, $publication_id, $comment_id, $published, $tags, $text));        
    }

    //DONE
    function deleteComment($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Comment WHERE id= ?');
        $stmt->execute(array($idComment));
    }

    //DONE
    function getComment($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE id= ?');
        $stmt->execute(array($idComment));
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    //DONE
    function getUserVotes($username, $upDown)
    {
        $db = Database::instance()->db();
        if($upDown == 1)
            $stmt = $db->prepare('SELECT count(*) FROM UpVote WHERE username= ?');
        else if($upDown == -1)
            $stmt = $db->prepare('SELECT count(*) FROM DownVote WHERE username= ?');
        else return;

        $stmt->execute(array($username));
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    //DONE
    function getPublicationVotes($publication_id, $upDown)
    {
        $db = Database::instance()->db();

        $upVotes = $db->prepare('SELECT count(*) as cnt FROM Votes WHERE publication_id= ? AND upDown= ?');
        $upVotes->execute(array($publication_id,$upDown));
        return $upVotes->fetch();
    }


    //DONE
    function get_PC_Votes($pub_com_id, $upDown, $pub_com)
    {
        $db = Database::instance()->db();
        if($upDown == 1 && $pub_com == 1)
            $stmt = $db->prepare('SELECT count(*) FROM UpVote WHERE publication_id= ?');
        else if($upDown == 1 && $pub_com == -1)
            $stmt = $db->prepare('SELECT count(*) FROM UpVote WHERE comment_id= ?');
        else if($upDown == -1 && $pub_com == 1)
            $stmt = $db->prepare('SELECT count(*) FROM DownVote WHERE publication_id= ?');
        else if($upDown == -1 && $pub_com == -1)
            $stmt = $db->prepare('SELECT count(*) FROM DownVote WHERE comment_id= ?');
        else return;

        $stmt->execute(array($pub_com_id));
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    //DONE
    function insertVote($type, $username, $idOfType, $upDown)
    {
        $db = Database::instance()->db();
        if($type === 'C' && $upDown == 1)
            $stmt = $db->prepare('INSERT INTO UpVote VALUES(NULL, ?, ?, NULL, ?)');
        else if($type === 'C' && $upDown == 1)
            $stmt = $db->prepare('INSERT INTO DownVote VALUES(NULL, ?, ?, NULL, ?)');
        else if($type === 'P' && $upDown == -1)
            $stmt = $db->prepare('INSERT INTO DownVote VALUES(NULL, ?, ?, ?, NULL)');
        else if($type === 'P' && $upDown == -1)
            $stmt = $db->prepare('INSERT INTO DownVote VALUES(NULL, ?, ?, ?, NULL)');
        else return;

        $stmt->execute(array($type,$username,$idOfType));
    }

    //DONE
    function deleteVote($idVote, $upDown)
    {
        $db = Database::instance()->db();
        if($upDown == 1)
            $stmt = $db->prepare('DELETE FROM UpVote WHERE id= ?');
        else if($upDown == -1)
            $stmt = $db->prepare('DELETE FROM DownVote WHERE id= ?');
        else return;

        $stmt->execute(array($idVote));
    }

    function toggleFollowPublication($publication_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Publication SET item_done = 1 - item_done WHERE item_id = ?');
        $stmt->execute(array($publication_id));
    }

?>