<?php
    function isLoginCorrect($username,$password)
    {
        global $dbRel;
        $stmt = $dbRel->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
        $stmt->execute(array($username,sha1($password)));
        return $stmt->fetch() !== false;
    }
?>