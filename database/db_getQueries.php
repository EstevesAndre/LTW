<?php
    include_once('../includes/database.php');
 
    //DONE
    function getNewestPublications()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication ORDER BY timestamp DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //DONE
    function getOldestPublications()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication ORDER BY timestamp');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //DONE
    function getAlphabeticalPublications()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication ORDER BY title COLLATE NOCASE ASC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //DONE
    function getSubscribedPublications($username)
    {
        $db = Database::instance()->db();
        
        $stmt = $db->prepare("SELECT * FROM Publication 
                                WHERE category IN (SELECT cType 
                                    FROM Channel
                                    WHERE id IN (
                                        SELECT id_Channel
                                        FROM UserLikesChannel 
                                        WHERE username_user= ?)
                                    ) 
                                ORDER BY timestamp DESC");
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function getPublicationsSearch($search)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare("SELECT * FROM Publication 
                                WHERE (title LIKE ?) OR
                                    (category LIKE ?) OR
                                    (username LIKE ?) OR
                                    (fulltext LIKE ?)");
        $stmt->execute(array($search,$search,$search,$search));
        return $stmt->fetchAll();
    }
    
    function getChannelsSearch($search)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Channel 
                                WHERE cType LIKE ?');
        $stmt->execute(array($search));
        return $stmt->fetchAll();
    }

    function getUsersSearch($search)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM User 
                                WHERE (username LIKE ?) OR
                                    (name LIKE ?) OR
                                    (surname LIKE ?)');
        $stmt->execute(array($search,$search,$search));
        return $stmt->fetchAll();
    }

    function getCommentsSearch($search)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment 
                                WHERE (username LIKE ?) OR
                                    (text LIKE ?)');
        $stmt->execute(array($search,$search));
        return $stmt->fetchAll();
    }

    //DONE
    function getMostVotedPublications()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication ORDER BY upVotes DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }    

    //DONE
    function getUserPublications($username)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication JOIN User USING (username) WHERE username= ?');
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
        $stmt = $db->prepare('SELECT * FROM Comment JOIN User USING (username) WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    //DONE
    function getChannels()
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Channel');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //DONE
    function getPublicationComments($pudlication_id)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE publication_id= ? AND comment_id IS NULL');
        $stmt->execute(array($pudlication_id));
        return $stmt->fetchAll();
    }
    
    //DONE
    function getChannel($cType)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Channel WHERE cType= ?');
        $stmt->execute(array($cType));
        return $stmt->fetch();
    }

    //DONE
    function isUserSubOfChannel($username, $idChannel)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM UserLikesChannel WHERE id_Channel= ? AND username_user= ?');
        $stmt->execute(array($idChannel, $username));
        return $stmt->fetch()?true:false;
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
        $stmt = $db->prepare('DELETE FROM UserLikesChannel WHERE id_Channel= ? AND username_user= ?');
        $stmt->execute(array($idChannel, $username));
    }

    function getCategoryPublications($category)
    {
        $db = Database::instance()->db();        
        $stmt = $db->prepare('SELECT * FROM Publication WHERE category LIKE ?');
        $stmt->execute(array($category));
        return $stmt->fetchAll();
    }

    //DONE
    function checkIsPublicationOwner($username, $idPublication)
    {        
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Publication JOIN User USING (username) WHERE username= ? AND id= ?');
        $stmt->execute(array($username, $idPublication));
        return $stmt->fetch()?true:false; // return true if a line exists
    }
    
    //DONE
    function checkIsCommentOwner($username, $idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment JOIN User USING (username) WHERE username= ? AND id= ?');
        $stmt->execute(array($username, $idComment));
        return $stmt->fetch()?true:false; // return true if a line exists
    }
    
    //DONE
    function insertPublication($username, $category, $title, $fulltext)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare("INSERT INTO Publication VALUES(NULL, ?, DATETIME('now'), ?, ?, ?, 0, 0)");
        $stmt->execute(array($username, $category, $title, $fulltext));
        return $db->lastInsertId();
    }

    //DONE
    function deletePublication($idPublication)
    {
        deleteComments($idPublication, NULL);
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
    function insertComment($username, $publication_id, $comment_id, $text)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare("INSERT INTO Comment VALUES(NULL, ?, ?, ?, DATETIME('now'), ?, 0, 0)");
        $stmt->execute(array($username, $publication_id, $comment_id, $text));        
        return $db->lastInsertId();
    }

    //DONE
    function deleteComments($publication_id, $comment_id)
    {
        $db = Database::instance()->db();
        
        if($publication_id != NULL)
        {
            $stmt = $db->prepare('DELETE FROM Comment WHERE publication_id= ?');
            $stmt->execute(array($publication_id));
        }
        else if($comment_id != NULL)
        {
            $stmt = $db->prepare('DELETE FROM Comment WHERE comment_id= ?');
            $stmt->execute(array($comment_id));
        }
    }

    //DONE
    function deleteComment($idComment)
    {
        deleteVotes(NULL, $idComment);
        deleteComments(NULL, $idComment);
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
        return $stmt->fetch();
    }

    //DONE
    function getCommentsOfComment($idComment)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comment WHERE comment_id= ?');
        $stmt->execute(array($idComment));
        return $stmt->fetchAll(); 
    }    

    //DONE
    function getPublicationVotes($publication_id, $comment_id, $upDown)
    {
        $db = Database::instance()->db();

        if($comment_id != NULL)
        {
            $votes = $db->prepare('SELECT count(*) as cnt FROM Votes WHERE comment_id= ? AND upDown= ?');
            $votes->execute(array($comment_id,$upDown));
        }
        else
        {
            $votes = $db->prepare('SELECT count(*) as cnt FROM Votes WHERE publication_id= ? AND upDown= ?');
            $votes->execute(array($publication_id,$upDown));
        }

        return $votes->fetch();
    }

    //DONE
    function getVote($username, $publication_id, $comment_id)
    {        
        $db = Database::instance()->db();

        if($comment_id != NULL)
        {
            $votes = $db->prepare('SELECT * FROM Votes WHERE username= ? AND comment_id= ?');
            $votes->execute(array($username,$comment_id));
        }
        else
        {
            $votes = $db->prepare('SELECT * FROM Votes WHERE username= ? AND publication_id= ?');
            $votes->execute(array($username,$publication_id));
        }

        return $votes->fetch();
    }

    //DONE
    function getVoteWithId($id)
    {        
        $db = Database::instance()->db();        
        $stmt = $db->prepare('SELECT * FROM Votes WHERE id= ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    //DONE
    function insertVote($type, $username, $publication_id, $comment_id, $upDown)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO Votes VALUES(NULL, ?, ?, ?, ?, ?)');
        $stmt->execute(array($type,$username,$publication_id, $comment_id, $upDown));        
        return $db->lastInsertId();
    }

    //DONE
    function deleteVote($idVote)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('DELETE FROM Votes WHERE id= ?');
        $stmt->execute(array($idVote));
    }
    
    //DONE
    function deleteVotes($publication_id, $comment_id)
    {
        $db = Database::instance()->db();

        if($publication_id != NULL)
        {
            $stmt = $db->prepare('DELETE FROM Votes WHERE publication_id= ?');
            $stmt->execute(array($publication_id));
        }
        else if($comment_id != NULL)
        {
            $stmt = $db->prepare('DELETE FROM Votes WHERE comment_id= ?');
            $stmt->execute(array($comment_id));   
        }
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

    //DONE
    function existsCategory($category)
    {        
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Channel WHERE cType= ?');
        $stmt->execute(array($category));
        return $stmt->fetch()?true:false;
    }

    //DONE
    function createsCategory($category)
    {        
        $db = Database::instance()->db();        
        $stmt = $db->prepare('INSERT INTO Channel VALUES(NULL, ?)');
        $stmt->execute(array($category));
        return $stmt->fetch();
    }

    //DONE
    function existsUser($username)
    {        
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM User WHERE username= ?');
        $stmt->execute(array($username));
        return $stmt->fetch()?true:false;
    }

?>