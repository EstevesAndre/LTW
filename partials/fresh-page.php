<?php 
    function draw_fresh_page($publications) { 
?>
    <div class="article-container">
        <div class="order" id="orderDiv">
            <button class="order-button active"><p>Fresh</p></button>
            <button class="order-button"><p>Hot</p></button>
            <button class="order-button"><p>Discussed</p></button>
        </div>
        <?php
            draw_publications($publications);
        ?>
    </div>
<?php 
    }
?>