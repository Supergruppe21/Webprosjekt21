<?php
require("search.php");


header('Content-Type: text/html; charset=UTF-8');
?>

    <link rel="stylesheet" type="text/css" href="css/results_style.css">
<?php foreach ($events as $event) { ?>


    <?php
    $object = $event;
    require("getImages.php");
    require("googleJson.php");

    ?>
    <!-- Start Event Card -->
    <div class="mdl-card mdl-shadow--2dp">
        <a href="info.php?go&pictureId=<?= $event['sted_id'] ?>" method="post" id="id" value="<?= $event['sted_id'] ?>">
            <img src="<? echo $object['img'] . "/" . $imgList[0]; ?>" height="200" width="300">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text"><?= $event['navn'] ?></h2>
        </a>
    </div>

    <div class="mdl-card__supporting-text timestamp">
        <script> /*henter adresse fra googles database*/
            getAdress();
        </script>
    </div>
    <div class="mdl-card__supporting-text">Kategori: <?= $event['kategori'] ?></div>

    </div>
    <!-- End Event Card -->

<?php }
