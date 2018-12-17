<?php
    include_once('../includes/session.php');
    include_once('../database/db_checkUser.php');

    $username = $_POST['username'];
    $password = $_POST['password'];


    if(time() < $_SESSION['timeout'])
    {
        die(header('Location: ../pages/login.php'));
    }

    if(isLoginCorrect($username, $password))
    {
        $_SESSION['username'] = $username;
        $_SESSION['wait'] = false;
        //$_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
        header('Location: ../pages/initialPage.php');
    }
  
    else{
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
        $_SESSION['tries']++;

        if($_SESSION['tries'] % 3 == 0)
        {
            $_SESSION['timeout'] = time() + (pow(2,floor($_SESSION['tries']/3) - 1) * 60);
            $_SESSION['wait'] = true;
            
        }
        header('Location: ../pages/login.php');
    }

?>