<?php
$id = $_GET['id'];
$sql = "SELECT dma_eg_data FROM tl_content WHERE id=$id";
$dbQuery = Database::getInstance()->prepare($sql);
$dbResult = $dbQuery->execute();
$headline = '';
$zip = '';
$city = '';
$location = '';
$price = '';
$size = '';
$rooms = '';
$photo = '';
$photos = '';
$plan = '';
$link = '';
$description = '';
while($row = $dbResult->fetchRow()) {
    $pattern = "/(?s)headline\"(.*?)\"(.*?)\"(.*)zip\"(.*?)\"(.*?)\"(.*)city\"(.*?)\"(.*?)\"(.*)location\"(.*?)\"(.*?)\"(.*)price\"(.*?)\"(.*?)\"(.*)size\"(.*?)\"(.*?)\"(.*)rooms\"(.*?)\"(.*?)\"(.*)photo\"(.*?)\"(.*?)\"(.*)plan\"(.*?)\"(.*?)\"(.*)link\"(.*?)\"(.*?)\"(.*)description\"(.*?)\"(.*?)\"/";
    preg_match($pattern, $row[0], $results);
    $headline = $results[2];
    $zip = $results[5];
    $city = $results[8];
    $location = $results[11];
    $price = $results[14];
    $size = $results[17];
    $rooms = $results[20];
    $photo = $results[23];
    $plan = $results[26];
    $link = $results[29];
    $description = $results[32];
}
$pics_array = explode(",", $photos);
?>
<div id="realestate-detail">
        <section class="photos">
            <img src="{{file::<?= $photo ?>}}">
        </section>
        <div class="realestate-text">
            <section class="headline">
                <h2><?= $headline ?></h2>
            </section>
            <div class="info">
                <section class="location">
                    <div class="address">
                        <p><?php if ($location != ''): ?><i class="fas fa-map-marker-alt"></i> <?= $location ?></p>
                        <?php endif; ?>
                        <p><?php if ($location = ''): ?><i class="fas fa-map-marker-alt"></i> <?php endif; ?><?= $zip . ' ' . $city ?></p>
                    </div>
                </section>
                <section class="numbers">
                    <div class="price">
                        <span><strong><?= $price ?> <?php if (gettype($price) == 'integer') { echo ' €';} ?></strong></span><br>
                        <span>Preis</span>
                    </div>
                    <div class="size">
                        <span><?= $size ?> m²</span><br>
                        <span>Wohnfläche</span>
                    </div>
                    <div class="rooms">
                        <span><?= $rooms ?></span><br>
                        <span>Zimmer</span>
                    </div>
                </section>
                <section class="description">
                    <p class="button-paragraph"><a class="button-immo" href="<?= $link ?>" target="_blank">&raquo; Mehr Infos bei ImmoWelt</a></p>
                    <p><?= $description ?></p>
                </section>
                <section class="plan">
                    <?php if ($plan != '') :?><iframe class="plan-pdf" src="{{file::<?= $plan ?>}}#toolbar=0&navpanes=0&scrollbar=0"></iframe><?php endif; ?>
                </section>
            </div>
        </div>
    <div class="ce_text">
        <p>« {{link::back}}</p>
    </div>
</div>
