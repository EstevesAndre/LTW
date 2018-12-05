<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];

    $user = getUserInfo($username);

    if ($_POST['name'] != null) $name = $_POST['name'];
    else $name = $user['name'];

    if ($_POST['surname'] != null) $surname = $_POST['surname'];
    else $surname = $user['surname'];
    
    if ($_POST['email'] != null) $email = $_POST['email'];
    else $email = $user['email'];

    if ($_POST['genre'] != null) $genre = $_POST['genre'];
    else $genre = $user['genre'];

    if ($_POST['age'] != null) $age = $_POST['age'];
    else $age = $user['age'];

    updateUser($username, $email, $name, $surname, $genre, $age);

    header('Location: ../pages/profile.php');
?>