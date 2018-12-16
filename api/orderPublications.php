<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_publications.php');

    $username = $_SESSION['username'];
    $order = $_POST['order'];

    switch($order)
    {
        case 'Fresh':
            draw_publications(getNewestPublications(), NULL, $order);
            break;
        case 'Old':
            draw_publications(getOldestPublications(), NULL, $order);
            break;
        case 'Alphabetical':
            draw_publications(getAlphabeticalPublications(), NULL, $order);
            break;
        case 'Hot':
            draw_publications(getMostVotedPublications(), NULL, $order);
            break;
        case 'Subscribed':
            draw_publications(getSubscribedPublications($username), NULL, $order);
            break;
        default:
            draw_publications(getNewestPublications(), NULL, $order);
    }
?>