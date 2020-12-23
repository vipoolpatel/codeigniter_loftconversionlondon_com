<?php
if(!empty($home_city)){
?>
    <div class="serv_foot">
        <div class="container">
            <h3>Service Coverage Click on your region for details of service coverage in your area.</h3>
            <ul>
                <?php
                foreach ($home_city as $value_city) {
                ?>
                <li><a href="<?=base_url()?><?=$value_city->page_seo?>" class="btn btn-primary"><?=$value_city->title?></a></li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
<?php }
?>    