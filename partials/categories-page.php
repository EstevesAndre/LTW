<?php 
    function draw_categories($channels) { 
?>
    <div class="article-container">

        <?php foreach($channels as $channel) 
            {
        ?>
            <a href="../pages/category.php?category=<?=$channel['cType']?>" class="category-card">
            <?php
                $image  = "../assets/".strtolower(str_replace(' ','',$channel['cType'])).".png";
                if(!file_exists($image)){
                    $image ="../assets/Buddhism.png";
                }   
                ?>
                <img src= <?=$image?> />
                <p class="title"><?=$channel['cType']?></p>
            </a>
        <?php 
            }
        ?>        
    </div>    
<?php 
    }
?>