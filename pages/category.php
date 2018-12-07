<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');  
    include_once('../templates/template_publications.php');    
    include_once('../partials/category-page.php');

    $category = $_GET['category'];

    $pubOfCategory = getCategoryPublications('%' . $category . '%');
    
    draw_header($_SESSION['username'], ' | ' . $category);
    draw_category_page($category, $pubOfCategory);
    draw_footer();
?>