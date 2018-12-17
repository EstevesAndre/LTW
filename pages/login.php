<?php 
    include_once('../includes/session.php');
    include_once('../database/db_checkUser.php');
    include_once('../templates/template_account.php');
    include_once('../templates/template_common.php');
        
    draw_header(null, ' | Login');
    if($_SESSION['wait'])
    {
        draw_login('wait_command');
    }
    else{
        draw_login(null);
    }
   
    draw_footer();
?>