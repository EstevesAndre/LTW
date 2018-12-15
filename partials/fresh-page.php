<?php 
    function draw_fresh_page() { 
?>
    <div class="article-container">
        <div class="order" id="orderDiv">
            <button class="order-button active"><p>Fresh</p></button>
            <button class="order-button"><p>Old</p></button>
            <button class="order-button"><p>Alphabetical</p></button>
            <button class="order-button"><p>Hot</p></button>
            <button class="order-button"><p>Subscribed</p></button>
        </div>
        <div class="ordered-publications">
            <?php                
                $publications = getNewestPublications();
                draw_publications($publications, "Fresh");
            ?>
        </div>
    </div>
<?php 
    }
?>