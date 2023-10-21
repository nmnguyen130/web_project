<?php
require_once "import.php";
?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">

<?php
require_once "header.php";
?>

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
                        Welcome to BioMap - The place to explore the unique beauty of
                        Vietnam's nature. Join in to connect with the vibrant
                        landscapes, discover fascinating wildlife, and be part of our
                        mission to preserve and cherish the environmental wonders that
                        make Vietnam truly special.
                    </p>
                    <a href="<?= ROOT ?>/map" class="discover-btn btn align-self-center btn-outline-warning btn-lg fw-bold w-50">
                        Discover Now
                    </a>
                </div>
            </div>
        </div>

        <img src="<?= ROOT ?>/assets/images/wave1.jpg" class="bottom-img" alt="wave_image" />
    </section>

    <!-- Feature Section -->
    <section id="features">
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Our Features:</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-eye logo"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Exploration</h3>
                    <p>
                        Take on the journey to discover every creatures through an
                        interactive map that unveils the incredible richness of flora
                        and fauna in every province of Vietnam.
                    </p>
                </div>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-book logo"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Education</h3>
                    <p>
                        Explore and learn about the characteristics, habitat, and
                        behavior of species living in each region of Vietnam and grasp
                        the importance of conservation.
                    </p>
                </div>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-repeat logo"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Revalidation</h3>
                    <p>
                        Join us in building a comprehensive and reliable resource to
                        celebrates the biodiversity in Vietnam.Together, we contribute
                        to a better understanding and conservation of our natural world.
                    </p>
                </div>
            </div>
            <h2 class="border-bottom"></h2>
        </div>
    </section>

    <!-- Gallery section -->
    <section id="galleries">
        <div class="album py-5">
            <h1 class="d-flex justify-content-center mb-5">Popular</h1>
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://files.worldwildlife.org/wwfcmsprod/images/Tiger_resting_Bandhavgarh_National_Park_India/hero_small/6aofsvaglm_Medium_WW226365.jpg" alt="Image 1" />
                            <div class="card-body">
                                <p class="card-text">
                                    This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a
                                    little bit longer.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://vcdn-vnexpress.vnecdn.net/2023/03/14/VNE-True-3915-1678790661.jpg" alt="Image 2" />
                            <div class="card-body">
                                <p class="card-text">
                                    This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a
                                    little bit longer.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://www.thiennhien.net/wp-content/uploads/2013/10/141013_LK_voichaua.jpg" alt="Image 3" />
                            <div class="card-body">
                                <p class="card-text">
                                    This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a
                                    little bit longer.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/1e/Sarus_Crane_%28Grus_antigone%29.jpg" alt="Image 4" />
                            <div class="card-body">
                                <p class="card-text">
                                    This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a
                                    little bit longer.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://www.aquapharm.com.vn/images/qua-tang-thien-nhien/gioi-thieu-ve-chim-yen.jpg" alt="Image 5" />
                            <div class="card-body">
                                <p class="card-text">
                                    This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a
                                    little bit longer.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Capricornis_milneedwardsii_2.jpg/300px-Capricornis_milneedwardsii_2.jpg" alt="Image 6" />
                            <div class="card-body">
                                <p class="card-text">
                                    This is a wider card with supporting text below as a
                                    natural lead-in to additional content. This content is a
                                    little bit longer.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require_once 'footer.php';
?>