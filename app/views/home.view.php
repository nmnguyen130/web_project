<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/home.css">

<?php $this->view('includes/header', $data) ?>

<main>
    <!-- Hero Section -->
    <section id="hero">
        <video id="heroVideoBg" autoplay loop muted>
            <source type="video/mp4" src="<?= ROOT ?>/assets/video/1015.mp4" />
        </video>

        <div class="container d-flex">
            <div class="row text-center">
                <div class="d-flex flex-column justify-content-center">
                    <h1 class="display-5 mb-4 fw-medium">
                        Bio<span class="text-warning">Map</span>
                    </h1>
                    <p class="lh-lg">
                        Chào mừng bạn đến với BioMap - Nơi khám phá vẻ đẹp độc đáo của thiên nhiên
                        Việt Nam. Hãy tham gia để kết nối với những cảnh quan rực rỡ, khám phá động
                        vật hoang dã hấp dẫn và trở thành một phần trong sứ mệnh của chúng tôi nhằm
                        bảo tồn và trân trọng những kỳ quan môi trường đã tô đậm sắc màu thiên nhiên
                        Việt Nam.
                    </p>
                    <a href="<?= ROOT ?>/map" class="discover-btn btn align-self-center btn-outline-warning btn-lg fw-bold w-50">
                        Khám phá ngay
                    </a>
                </div>
            </div>
        </div>

        <img src="<?= ROOT ?>/assets/images/wave1.jpg" class="bottom-img" alt="wave_image" />
    </section>

    <!-- Feature Section -->
    <section id="features">
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom shadow-text">Chúng tôi cung cấp:</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-eye logo"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Khám phá</h3>
                    <p>
                        Hãy tham gia hành trình khám phá sinh vật thông qua sự tương tác cùng bản đồ
                        Việt Nam nhằm hé lộ sự phong phú của hệ động thực vật ở mọi tỉnh thành của
                        Việt Nam.
                    </p>
                </div>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-book logo"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Giáo dục</h3>
                    <p>
                        Khám phá và tìm hiểu về đặc điểm, môi trường sống, tập tính của các loài
                        động thực vật sống ở từng vùng miền trên đất nước Việt Nam và nắm bắt được
                        tầm quan trọng của việc bảo tồn sinh thái.
                    </p>
                </div>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-repeat logo"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Phát triển</h3>
                    <p>
                        Hãy dồng hành cùng chúng tôi để xây dựng một nguồn tài nguyên toàn diện và
                        đáng tin cậy nhằm tôn vinh vẻ đẹp và sự đa dạng sinh học ở Việt Nam. Cùng
                        nhau góp phần nâng cao sự hiểu biết và bảo tồn thế giới tự nhiên của chúng
                        ta.
                    </p>
                </div>

            </div>
            <h2 class="border-bottom"></h2>
        </div>
    </section>

    <!-- Gallery section -->
    <section id="galleries">
        <div class="album py-5">
            <?php $name = $province->randomProvince() ?>
            <h1 class="d-flex justify-content-center mb-5 shadow-text">Nổi bật</h1>
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 d-flex justify-content-center">
                    <?php
                    $animals = $province->randomCreature($name->name, 'animal', 6);
                    foreach ($animals as $animal) {
                    ?>
                        <div class="col d-flex">
                            <div class="card shadow-sm">
                                <div>
                                    <img src="<?= $animal->image; ?>" alt="<?= $animal->name; ?>" class="my-1 float-start" />
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <p class="card-text hide-text">
                                            <?= $animal->characteristic; ?>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="<?= ROOT ?>/map" class="btn btn-sm btn-outline-secondary" id="viewMap" onclick="passName('<?= $animal->scientific_name ?>')">
                                                    Xem
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->view('includes/footer', $data) ?>

<script>
    function passName(name) {
        sessionStorage.setItem("name", name);
    }
</script>