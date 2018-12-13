<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');

    $username = $_POST['session_username'];
    $userInfo = getUserInfo($username);

    drawPoints($userInfo['points']);
?>