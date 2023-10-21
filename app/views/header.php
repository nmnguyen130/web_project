</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <!-- Logo & Brand -->
                <a href="<?= ROOT ?>/home" class="navbar-brand mb-0 h1">
                    <i class="fa-solid fa-paw logo"></i>BioMap
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
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                    </ul>

                    <div class="login-signup-btn d-flex flex-column flex-lg-row justify-content-end align-items-end gap-3 mx-sm-2">
                        <a href="<?= ROOT ?>/login" class="btn btn-outline-light px-3 py-1 rounded-4">Login</a>
                        <a href="<?= ROOT ?>/login" class="btn btn-warning px-3 py-1 rounded-4">Sign up</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>