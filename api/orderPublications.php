<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_publications.php');

    if (!isset($_SESSION['username']))
        $username = NULL;
    else
        $username = $_SESSION['username'];
        
    $order = $_POST['order'];

    switch($order)
    {
        case 'Fresh':
            draw_publications(getNewestPublications(), $order, NULL);
            break;
        case 'Old':
            draw_publications(getOldestPublications(), $order, NULL);
            break;
        case 'Alphabetical':
            draw_publications(getAlphabeticalPublications(), $order, NULL);
            break;
        case 'Hot':
            draw_publications(getMostVotedPublications(), $order, NULL);
            break;
        case 'Subscribed':
            draw_publications(getSubscribedPublications($username), $order, NULL);
            break;
        default:
            draw_publications(getNewestPublications(), $order, NULL);
    }
?>