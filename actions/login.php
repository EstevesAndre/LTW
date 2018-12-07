<?php
    include_once('../includes/session.php');
    include_once('../database/db_checkUser.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isLoginCorrect($username, $password))
    {
        $_SESSION['username'] = $username;
        //$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
        header('Location: ../pages/initialPage.php');
    }
    else
    {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
        header('Location: ../pages/login.php');
    }

?>