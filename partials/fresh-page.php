<?php 
    function draw_fresh_page($publications) { 
?>
    <div class="article-container">
        <div class="order">
            <div class="order-button active"><p>Fresh</p></div>
            <div class="order-button"><p>Hot</p></div>
            <div class="order-button"><p>Discussed</p></div>
        </div>
        <?php
            draw_publications($publications);
        ?>
    </div>
<?php 
    }
?>