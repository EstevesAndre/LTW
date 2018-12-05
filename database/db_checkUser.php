<?php

    include_once('../includes/database.php');

    /**
     * Verifies if a certain loggin, password combination
     * exists in the database.
     */
    function isLoginCorrect($username,$password)
    {
        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute(array($username));

        $user = $stmt->fetch();
        return $user !== false && password_verify($password, $user['password']);
    }

    function insertUser($username, $email, $password)
    {
        $db = Database::instance()->db();

        $options = ['cost' => 12];

        $stmt = $db->prepare('INSERT INTO user VALUES(?, ?, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($username, $email, password_hash($password, PASSWORD_DEFAULT, $options)));
    }
?>