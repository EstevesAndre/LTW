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
    function checkIsCommentOwner($username, $idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE username= ? AND id= ?');
        $stmt->execute(array($username, $idComment));
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
    function deletePublication($idPublication)
    {
        deleteComments($idPublication);
        deleteVotes($idPublication);
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Publication WHERE id= ?');
        $stmt->execute(array($idPublication));
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
    function deleteComments($publication_id)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Comment WHERE publication_id= ?');
        $stmt->execute(array($publication_id));
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
    function getCommentsOfComment($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE id= ? AND IFNULL(publication_id, "") = ""');
        $stmt->execute(array($idComment));
        return $stmt->fetchAll(); 
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
    function getVote($username, $publication_id)
    {        
        $db = Database::instance()->db();

        $upVotes = $db->prepare('SELECT * FROM Votes WHERE username= ? AND publication_id= ?');
        $upVotes->execute(array($username,$publication_id));

        return $upVotes->fetch();
    }

    //DONE
    function insertVote($type, $username, $publication_id, $comment_id, $upDown)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO Votes VALUES(NULL, ?, ?, ?, ?, ?)');

        $stmt->execute(array($type,$username,$publication_id, $comment_id, $upDown));
    }

    //DONE
    function deleteVote($idVote)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Votes WHERE id= ?');

        $stmt->execute(array($idVote));
    }
    
    //DONE
    function deleteVotes($publication_id)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Votes WHERE publication_id= ?');

        $stmt->execute(array($publication_id));
    }

    //DONE
    function toggleVote($idVote)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('UPDATE Votes SET upDown = -upDown WHERE id= ?');

        $stmt->execute(array($idVote));
    }

    function toggleFollowPublication($publication_id) {
        $db = Database::instance()->db();

        $stmt = $db->prepare('UPDATE Publication SET item_done = 1 - item_done WHERE item_id = ?');
        $stmt->execute(array($publication_id));
    }

?>