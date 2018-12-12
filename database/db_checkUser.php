<?php

    include_once('../includes/database.php');

    /**
     * Verifies if a certain loggin, password combination
     * exists in the database.
     */
    function isLoginCorrect($username,$password)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        $stmt->execute(array($username));

        $user = $stmt->fetch();
        return $user !== false && password_verify($password, $user['password']);
    }

    function insertUser($username, $email, $password)
    {
        $db = Database::instance()->db();

        $options = ['cost' => 12];

        $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?, NULL, NULL, NULL, NULL, 0)');
        $stmt->execute(array($username, $email, password_hash($password, PASSWORD_DEFAULT, $options)));
    } 
?>