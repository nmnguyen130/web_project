<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/map.css">

<div class="container-fluid">
    <div class="row justify-content-center justify-content-md-start vh-100">
        <div class="col-10 col-md-5 bg-primary-subtle position-fixed">
            <div id="map" class="map-bg">
                <div class="search-bar">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
            <div id="info-box"></div>
        </div>
        <div class="col-12 col-md-7 bg-image offset-0 offset-md-5">
            <?php $this->view('includes/detail', $data) ?>
        </div>
    </div>
</div>

<script src="<?= ROOT ?>/assets/js/libs/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/js/libs/raphael.min.js"></script>

<script src="<?= ROOT ?>/assets/js/mapdata.js"></script>
<script src="<?= ROOT ?>/assets/js/countrymap.js"></script>

<script src="<?= ROOT ?>/assets/js/drawmap.js"></script>
<script src="<?= ROOT ?>/assets/js/updateInfor.js"></script>
<script>
    const searchBtn = $(".search-bar .form-input button");
    const searchBtnIcon = $(".search-bar .form-input button i");

    searchBtn.on("click", function(e) {
        $(".search-bar").addClass("active");
    });
</script>
</body>

</html>