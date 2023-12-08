<?php $this->view('includes/import', $data); ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="card">
            <?php
            if ($currentForm === 'email') {
            ?>
                <form method="post" class="d-flex flex-column">
                    <div class="text-white d-flex align-items-center title-container">
                        <a href="<?= ROOT ?>/login" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
                        <span class="h3 m-auto">Forgot Password</span>
                    </div>

                    <div class="d-flex align-items-center input-field mt-3">
                        <i class="fa-regular fa-user p-2"></i>
                        <input type="text" value="<?= old_value('email') ?>" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="my-2"><small class="text-danger"><?= $user->getError('email') ?></small></div>

                    <button class="btn btn-primary mb-3" id="main-btn">Send</button>
                </form>
            <?php
            } elseif ($currentForm === 'otp') {
            ?>
                <?php if (message()) : ?>
                    <div class="alert alert-success text-center"><?= message('', true) ?></div>
                <?php endif; ?>
                <form method="post" class="d-flex flex-column">
                    <div class="text-white d-flex align-items-center title-container">
                        <a href="<?= ROOT ?>/forgot?form=email" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
                        <span class="h3 m-auto">Code Verification</span>
                    </div>

                    <div class="d-flex align-items-center input-field mt-3">
                        <i class="fa-solid fa-key p-2"></i>
                        <input type="number" name="otp" placeholder="Enter verification code" class="form-control">
                    </div>
                    <div class="my-2"><small class="text-danger"><?= $user->getError('otp') ?></small></div>

                    <button class="btn btn-primary mb-3" id="main-btn">Verify</button>
                </form>
            <?php
            } elseif ($currentForm === 'password') {
            ?>
                <?php if (message()) : ?>
                    <div class="alert alert-success text-center"><?= message('', true) ?></div>
                <?php endif; ?>
                <form method="post" class="d-flex flex-column">
                    <div class="text-white d-flex align-items-center title-container">
                        <a href="<?= ROOT ?>/forgot?form=otp" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
                        <span class="h3 m-auto">New Password</span>
                    </div>

                    <div class="d-flex align-items-center input-field mt-3">
                        <i class="fa-solid fa-lock p-2"></i>
                        <input type="password" name="new_pass" placeholder="New Password" class="form-control pwd" id="newPass">
                        <span class="btn eye-icon">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>
                    </div>
                    <div class="my-2"><small class="text-danger"><?= $user->getError('password') ?></small></div>

                    <div class="d-flex align-items-center input-field">
                        <i class="fa-solid fa-lock p-2"></i>
                        <input type="password" placeholder="Confirm Password" class="form-control pwd" id="confirmPass">
                        <span class="btn eye-icon">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>
                    </div>
                    <div class="my-2"><small class="text-danger" id="confirmError"></small></div>

                    <button class="btn btn-primary mb-3" id="main-btn">Change</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/login.js"></script>
</body>

</html>