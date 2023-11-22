<?php $this->view('includes/import', $data) ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css">
</head>

<body>
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
                                1,074
                            </h3>
                            <p class="m-0">Total Posts</p>
                        </span>
                    </li>
                    <li><i class="fa-solid fa-eye"></i>
                        <span class="info">
                            <h3>
                                3,944
                            </h3>
                            <p class="m-0">Site Visit</p>
                        </span>
                    </li>
                    <li><i class="fa-solid fa-paw"></i>
                        <span class="info">
                            <h3>
                                <?php echo $totalAnimal ?>
                            </h3>
                            <p class="m-0">Total Animals</p>
                        </span>
                    </li>
                    <li><i class="fa-solid fa-tree"></i>
                        <span class="info">
                            <h3>
                                <?php echo $totalPlant ?>
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
                                <tr>
                                    <td>John Doe</td>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><span class="status pending">Pending</span></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><span class="status approved">Approved</span></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><span class="status rejected">Rejected</span></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="form-tab" role="tabpanel">
                <div class="header d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <h1>Form Management</h1>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Form Status
                        </button>
                        <ul class="dropdown-menu">
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
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><span class="status pending">Pending</span></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><span class="status approved">Approved</span></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><span class="status rejected">Rejected</span></td>
                                    <td><a href="#">View</a></td>
                                </tr>
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
                        <div class="header">
                            <i class="fa-solid fa-clipboard-list fs-5"></i>
                            <h3 class="m-0">Posts</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Creature Name</th>
                                    <th>Update Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Hổ</td>
                                    <td>14-08-2023</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
</body>

<script src="<?= ROOT ?>/assets/js/libs/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/js/admin.js"></script>