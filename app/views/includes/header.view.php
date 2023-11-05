</head>

<body>
    <?php
    $ses = new \Core\Session;
    ?>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <!-- Logo & Brand -->
                <a href="<?= ROOT ?>/home" class="navbar-brand mb-0 h1">
                    <i class="fa-solid fa-paw logo"></i><?= APP_NAME ?>
                </a>

                <!-- Nav -->
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto me-lg-4">
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/home">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?= ROOT ?>/services">Services</a>
                        </li>
                    </ul>

                    <?php if ($ses->is_logged_in()) : ?>
                        <div class="dropdown d-flex flex-column flex-lg-row justify-content-end align-items-end py-2 mx-sm-2">
                            <a class="user-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hi, User
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item py-0" href="<?= ROOT ?>/profile">Profile</a></li>

                                <?php if ($ses->user('role' == 'admin')) : ?>
                                    <li><a class="dropdown-item py-0" href="<?= ROOT ?>/admin">Admin</a></li>
                                <?php endif; ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item py-0" href="<?= ROOT ?>/logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <div class="login-signup-btn d-flex flex-column flex-lg-row justify-content-end align-items-end gap-3 py-2 mx-sm-2">
                            <a href="<?= ROOT ?>/login" class="btn btn-outline-light px-3 py-1 rounded-4">Login</a>
                            <a href="<?= ROOT ?>/login" class="btn btn-warning px-3 py-1 rounded-4">Sign up</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>