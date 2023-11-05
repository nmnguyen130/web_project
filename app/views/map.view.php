<?php
require_once "import.php";
?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/map.css">

<div class="container-fluid">
    <div class="row vh-100">
        <div class="col-5 bg-primary-subtle" style="position: fixed">
            <div id="map"></div>
            <div id="info-box"></div>
        </div>
        <div class="col-7 bg-image offset-5">
            <div class="d-flex justify-content-between align-items-center">
                <a href="<?= ROOT ?>/home"><i class="fa-solid fa-backward fs-5 text-white ms-3"></i></a>
                <h2 style="text-align: right; color: var(--text-color)" class="pt-1">
                    Hòa Bình
                </h2>
            </div>
            <div class="card card-infor">
                <div>
                    <img src="https://vcdn-vnexpress.vnecdn.net/2023/03/14/VNE-True-3915-1678790661.jpg" class="infor-img m-2" alt="image" />
                    <h5 class="px-4 my-3">Gấu ngựa (tên khoa học: Ursus thibetanus)</h5>
                    <p class="px-4">
                        Còn được biết đến với tên gọi gấu đen Tây Tạng, gấu đen Himalaya,
                        hay gấu đen châu Á, là một loài gấu có kích thước trung bình, vuốt
                        sắc, màu đen với hình chữ "V" đặc trưng màu trắng hay kem trên
                        ngực.
                    </p>
                    <p class="px-4">
                        Gấu ngựa có chiều dài khoảng 1,30 - 1,90 m. Con đực cân nặng
                        khoảng 110 – 150 kg còn con cái nhẹ hơn, khoảng 65 – 90 kg. Tuổi
                        thọ của gấu khoảng 25 năm. Gấu ngựa là loài ăn tạp, chúng ăn các
                        loại thức ăn như hoa quả, quả mọng, cỏ, hạt, quả hạch, động vật
                        thân mềm, mật ong và thịt (cá, chim, động vật gặm nhấm cũng như
                        các động vật có vú nhỏ hay xác súc vật).
                    </p>
                </div>
            </div>
            <hr>
            <div class="card card-list">
                <h5 class="px-4 mt-2">Những sinh vật khác thuộc Hòa Bình:</h5>
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3 g-3 mx-2 mb-2">
                    <div class="col">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img src="https://files.worldwildlife.org/wwfcmsprod/images/Tiger_resting_Bandhavgarh_National_Park_India/hero_small/6aofsvaglm_Medium_WW226365.jpg" class="card-img" alt="img1" />
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Hổ</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img src="https://www.thiennhien.net/wp-content/uploads/2013/10/141013_LK_voichaua.jpg" class="card-img" alt="img2" />
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Voi</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img src="https://www.aquapharm.com.vn/images/qua-tang-thien-nhien/gioi-thieu-ve-chim-yen.jpg" class="card-img" alt="img3" />
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Chim Yến</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img src="https://vcdn-vnexpress.vnecdn.net/2023/03/14/VNE-True-3915-1678790661.jpg" class="card-img" alt="img4" />
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Gấu ngựa</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/1e/Sarus_Crane_%28Grus_antigone%29.jpg" class="card-img" alt="img5" />
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Sếu</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Capricornis_milneedwardsii_2.jpg/300px-Capricornis_milneedwardsii_2.jpg" class="card-img" alt="img6" />
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Sơn Dương</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="btn btn-primary mx-2 my-2 custom-btn">Động Vật</div>
                <div class="btn btn-secondary mx-2 my-2 custom-btn">Thực Vật</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/js/libs/raphael.min.js"></script>
<script src="<?= ROOT ?>/assets/js/libs/jquery-3.7.1.min.js"></script>

<script src="<?= ROOT ?>/assets/js/mapdata.js"></script>
<script src="<?= ROOT ?>/assets/js/countrymap.js"></script>

<script src="<?= ROOT ?>/assets/js/drawmap.js"></script>
</body>

</html>