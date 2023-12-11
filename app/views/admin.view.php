<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css">
<script src="<?= ROOT ?>/assets/js/admin.js"></script>

</head>

<body>
    <?php $this->view('includes/infor', $data) ?>

    <?php $this->view('includes/sidebar_nav', $data) ?>

    <main>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="dashboard-tab" role="tabpanel">
                <div class="header">
                    <h1>Dashboard</h1>
                </div>

                <ul class="insights">
                    <li><i class="fa-solid fa-clipboard-list"></i>
                        <span class="info">
                            <h3>
                                <?= $form->getTotalForms() ?>
                            </h3>
                            <p class="m-0">Total Posts</p>
                        </span>
                    </li>
                    <li><i class="fa-solid fa-eye"></i>
                        <span class="info">
                            <h3>
                                12
                            </h3>
                            <p class="m-0">Site Visit</p>
                        </span>
                    </li>
                    <li><i class="fa-solid fa-paw"></i>
                        <span class="info">
                            <h3>
                                <?= $animal->getTotal() ?>
                            </h3>
                            <p class="m-0">Total Animals</p>
                        </span>
                    </li>
                    <li><i class="fa-solid fa-tree"></i>
                        <span class="info">
                            <h3>
                                <?= $plant->getTotal() ?>
                            </h3>
                            <p class="m-0">Total Plants</p>
                        </span>
                    </li>
                </ul>

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class="fa-solid fa-clipboard-list fs-5"></i>
                            <h3 class="m-0">Recent Posts</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Creature Name</th>
                                    <th>Submit Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recentPosts = $form->getPosts(5);

                                if (empty($recentPosts)) :
                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No posts available</td>
                                    </tr>
                                <?php else : ?>
                                    <?php foreach ($recentPosts as $post) : ?>
                                        <tr>
                                            <td><?= $post->username; ?></td>
                                            <td><?= $post->name; ?></td>
                                            <td><?= date('H:i:s d/m/Y', strtotime($post->submission_date)); ?></td>
                                            <td><span class="status <?= strtolower($post->status); ?>"><?= $post->status; ?></span></td>
                                            <td><a href="#" class="view-post" data-bs-toggle="modal" data-bs-target="#modalInfor" data-post-id="<?= $post->id; ?>" data-post-type="<?= $post->type ?>">View</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="form-tab" role="tabpanel">
                <div class="header d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <h1>Form Management</h1>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" id="statusBtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            All
                        </button>
                        <ul class="dropdown-menu" id="statusForm">
                            <li><a class="dropdown-item" href="#">All</a></li>
                            <li><a class="dropdown-item" href="#">Pending</a></li>
                            <li><a class="dropdown-item" href="#">Approved</a></li>
                            <li><a class="dropdown-item" href="#">Rejected</a></li>
                        </ul>
                    </div>
                </div>

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class="fa-solid fa-clipboard-list fs-5"></i>
                            <h3 class="m-0">Posts</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Creature Name</th>
                                    <th>Submit Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="formInfor">
                                <?php
                                $posts = json_encode($form->getPosts());

                                echo "<script>updatePostsTable($posts)</script>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="information-tab" role="tabpanel">
                <div class="header d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <h1>Creature Management</h1>
                    <ul class="form-select-sm d-flex justify-content-between m-0" id="creature-type">
                        <li>
                            <input type="radio" id="animal" name="type" value="Animal" checked>
                            <label for="animal">Động vật</label>
                        </li>
                        <li>
                            <input type="radio" id="plant" name="type" value="Plant">
                            <label for="plant">Thực vật</label>
                        </li>
                    </ul>
                </div>

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header d-flex justify-content-between">
                            <div class="d-flex">
                                <i class="fa-solid fa-clipboard-list fs-4 me-3"></i>
                                <h3 class="m-0 creature-title"></h3>
                            </div>
                            <button type="button" class="btn-add btn border-2 border-secondary text-secondary" data-bs-toggle='modal' data-bs-target='#modalInfor'>
                                <i class="fa-solid fa-plus px-1"></i>
                            </button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Creature Name</th>
                                    <th>Scientific Name</th>
                                    <th>Update Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="creaturesInfor" class="position-relative">
                                <?php
                                $animals = json_encode($animal->getAllCreatures("animal"));

                                echo "<script>updateCreaturesTable($animals, 'Animal')</script>";
                                ?>
                                <div class="preview position-absolute hidden">
                                    <img src="<?= get_image() ?>" class="img-thumbnail" />
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<script>
    $(document).ready(() => {
        const imgPreview = $(".preview");

        function showImage(x, y, image) {
            imgPreview.css({
                left: x + "px",
                top: y + "px"
            });

            imgPreview.find("img").attr("src", image)
            imgPreview.css("display", "block");
        }

        function hideImage() {
            imgPreview.css("display", "none");
        }

        $("#creaturesInfor").on("mousemove", "tr", function(e) {
            var x = e.pageX - 215;
            var y = e.pageY + 10;
            console.log(y, e.pageY)

            if (x > 3 / 4 * $("#creaturesInfor").width()) {
                x -= imgPreview.width();
            }
            if (y > $("#creaturesInfor").height() - imgPreview.height()) {
                y -= imgPreview.height();
            }

            showImage(x, y, $(this).find("td:eq(0)").text());
        });

        $("#creaturesInfor").on("mouseleave", "tr", function() {
            hideImage();
        });
    });
</script>