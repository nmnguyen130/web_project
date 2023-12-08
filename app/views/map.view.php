<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/map.css">

<div class="container-fluid">
    <div class="row justify-content-center justify-content-md-start vh-100">
        <div class="col-10 col-md-5 bg-primary-subtle position-fixed">
            <div id="map" class="map-bg">
                <div class="search d-flex align-items-center w-100">
                    <div class="search-bar d-flex align-items-center rounded-1 position-absolute">
                        <div class="dropdown position-relative rounded-1 shadow w-50">
                            <div class="dropdown-text d-flex align-items-center justify-content-between text-white py-2 px-3">
                                <span>Choose:</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown-list overflow-hidden position-absolute w-100 rounded-2 mt-1">
                                <?php
                                $creatures = array("All", "Animal", "Plant");

                                foreach ($creatures as $creature) {
                                    echo "<li class='dropdown-list-item py-2 ps-3'>$creature</li>";
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="pe-5 w-100 ms-2">
                            <div class="search-box">
                                <input type="text" class="p-1 w-100 border-0" id="search-input" placeholder="Search" />
                            </div>
                            <ul class="dropdown-menu list-result p-1 m-0 mt-1"></ul>
                        </div>
                    </div>
                    <div class="search-icon py-2 px-3 rounded-1 z-1">
                        <i class="fa-solid fa-magnifying-glass"></i>
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

<script src="<?= ROOT ?>/assets/js/libs/raphael.min.js"></script>

<script src="<?= ROOT ?>/assets/js/mapdata.js"></script>
<script src="<?= ROOT ?>/assets/js/countrymap.js"></script>

<script src="<?= ROOT ?>/assets/js/drawmap.js"></script>
<script src="<?= ROOT ?>/assets/js/updateInfor.js"></script>
<script src="<?= ROOT ?>/assets/js/search.js"></script>
</body>

</html>