<?php 
    function draw_categories($channels) { 
?>
    <div class="article-container">

        <?php foreach($channels as $channel) 
            {
        ?>
            <a href="../pages/category.php?category=<?=$channel['cType']?>" class="category">
                <img src="../assets/Buddhism.png" />
                <p class="title"><?=$channel['cType']?></p>
            </a>
        <?php 
            }
        ?>

        
    </div>    
<?php 
    }
?>