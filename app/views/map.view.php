<?php
require_once "import.php";
?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/map.css">

<div class="container">
    <div class="row vh-100">
        <div class="col-5 bg-primary-subtle">
            <div id="map"></div>
            <div id="info-box"></div>
        </div>
        <div class="col-7"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/js/raphael.min.js"></script>
<script src="<?= ROOT ?>/assets/js/mapdata.js"></script>
<script src="<?= ROOT ?>/assets/js/countrymap.js"></script>

<script src="<?= ROOT ?>/assets/js/drawmap.js"></script>
</body>

</html>