<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_POST['publication_id'];
    $order = $_POST['order'];

    if(checkIsPublicationOwner($username,$publication_id))
    {
        deletePublication($publication_id);
    }

    switch($order)
    {
        case 'Fresh':
            draw_publications(getNewestPublications(), $order);
            break;
        case 'Old':
            draw_publications(getOldestPublications(), $order);
            break;
        case 'Alphabetical':
            draw_publications(getAlphabeticalPublications(), $order);
            break;
        case 'Hot':
            draw_publications(getMostVotedPublications(), $order);
            break;
        case 'Subscribed':
            draw_publications(getSubscribedPublications($username), $order);
            break;
        default:
            draw_publications(getNewestPublications(), $order);
    }
?>