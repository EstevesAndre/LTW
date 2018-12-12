<?php 
    include_once('../includes/session.php');
    include_once('../database/db_checkUser.php');
    include_once('../templates/template_account.php');
    include_once('../templates/template_common.php');
        
    draw_header(null, ' | Login');
    draw_login();
    draw_footer();
?>