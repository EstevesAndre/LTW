<?php 
    function draw_categories($channels) { 
?>
    <div class="article-container">

        <?php foreach($channels as $channel) 
            {
        ?>
            <a href="../pages/category.php?category=<?=$channel['cType']?>" class="category">
                <img src="../assets/Buddhism.png" />
            </a>
        <?php 
            }
        ?>

        
    </div>    
<?php 
    }
?>