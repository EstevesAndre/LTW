<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    header('Content-Type: application/json');

    // Verify if user is logged in
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'not_logged_in')));


    $publication_id = $_POST['publication_id'];

    

    // Verifies if item exists and user is owner
    if (!$publication || !checkIsPublicationOwner($_SESSION['username'], $publication['id']))
        die(json_encode(array('error' => 'not_item_owner')));

    // Toggles the done state
    toggleItem($item_id);
    // Gets the item from the database
    $publication = getPublication($publication_id);
    // Returns the item as JSON
    echo json_encode($item);
?>