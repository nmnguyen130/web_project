<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">

<?php $this->view('includes/header', $data) ?>

<main>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
                <div class="row">
                    <div class="col-sm-4 rounded-start user-container">
                        <div class="text-center text-white">
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <h2 class="fw-bold mt-4">User</h2>
                            <p>Biomap Account</p>
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white rounded-end">
                        <h3 class="mt-3 text-center">Information</h3>
                        <hr class=" w-25">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="fw-bold">Email:</p>
                                <h6 class="text-muted">user@gmail.com</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="fw-bold">Phone:</p>
                                <h6 class="text-muted">0123456789</h6>
                            </div>
                        </div>
                        <h4 class="mt-3">Projects</h4>
                        <hr class="bg-primary">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="fw-bold">Recent</p>
                                <h6 class="text-muted">School Web</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="fw-bold">Most Viewed</p>
                                <h6 class="text-muted">Abtract View</h6>
                            </div>
                        </div>
                        <hr class="bg-primary">
                        <ul class="d-flex.justify-content-center mt-4">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>