<?php 
    function draw_category_page($category, $pubOfCategory) { 
?>
    <div class="article-container">
        <div class="category-title">
            <p><?=$category?></p>
        </div>
        <?php
            draw_publications($pubOfCategory);
        ?>
    </div>
<?php 
    }
?>