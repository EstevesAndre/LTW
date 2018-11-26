<?php

    include_once('./includes/database.php');

    /**
     * Verifies if a certain loggin, password combination
     * exists in the database.
     */
    function isLoginCorrect($username,$password)
    {
        $db = Database::instace()->db();
        $stmt = $dbRel->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
        $stmt->execute(array($username,sha1($password)));
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    function insertUser($username, $password, $name)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('INSERT INTO user VALUES(?, ?, ?)');
        $stmt->execute(array($username, sha1($password), $name));
    }
?>