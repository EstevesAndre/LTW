<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');        
    include_once('../partials/search-page.php');
    include_once('../partials/categories-page.php');

    if (!isset($_SESSION['username']))
        draw_header(NULL, ' | Searched');
    else
        draw_header($_SESSION['username'], ' | Searched');

    $search = $_GET['search'];
    
    $publicationsLike = getPublicationsSearch('%' . $search . '%');
    $commentsLike = getCommentsSearch('%' . $search . '%');
    $channelsLike = getChannelsSearch('%' . $search . '%');
    $usersLike = getUsersSearch('%' . $search . '%');

    draw_searched_pub($publicationsLike);

    /*if($commentsLike != NULL)
    {
        draw_searched_comments($commentsLike);
    }*/

    draw_searched_channels($channelsLike);
    
    draw_searched_users($usersLike);
    
    draw_footer();
?>