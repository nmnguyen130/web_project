<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioMap</title>
    <!-- Bootstraps 5.3.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Link CSS -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/base.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="card" id="login-form">
            <form action="#" class="d-flex flex-column">
                <div class="text-white d-flex align-items-center title-container">
                    <a href="<?= ROOT ?>/home" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
                    <span class="h3 m-auto">Login</span>
                </div>

                <div class="d-flex align-items-center input-field my-3 mb-4">
                    <i class="fa-regular fa-user p-2"></i>
                    <input type="text" placeholder="Username or Email" class="form-control">
                </div>

                <div class="d-flex align-items-center input-field mb-4">
                    <i class="fa-solid fa-lock p-2"></i>
                    <input type="password" placeholder="Password" class="form-control pwd">
                    <button class="btn eye-icon">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <label class="option d-flex align-items-center">
                            <input type="checkbox" class="checkbox me-2" checked>
                            <span class="text-form">Remember Me</span>
                        </label>
                    </div>
                    <div class="mt-sm-0"><a href="#">Forgot password?</a></div>
                </div>

                <button type="button" class="btn btn-primary mb-3 my-3">Login</button>

                <div class="d-flex justify-content-center">
                    <p class="small fw-bold mt-1 mb-0 text-form">
                        Don't have an account? <a href="#" class="link-primary ms-2" id="btn-signup">Register</a>
                    </p>
                </div>

                <div class="divider d-flex align-items-center my-2">
                    <p class="text-center text-white fw-bold mx-3 mb-0">OR</p>
                </div>

                <div class="d-flex align-items-center justify-content-between gap-3">
                    <a href="#" class="w-100 btn btn-primary btn-social">
                        <i class="fa-brands fa-facebook me-2"></i>
                        Facebook
                    </a>
                    <a href="#" class="w-100 btn btn-danger btn-social">
                        <i class="fa-brands fa-google me-2"></i>
                        Google
                    </a>
                </div>
            </form>
        </div>

        <div class="card hidden" id="signup-form">
            <form action="#" class="d-flex flex-column">
                <div class="text-white d-flex align-items-center title-container">
                    <a href="<?= ROOT ?>/home" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
                    <span class="h3 m-auto">Signup</span>
                </div>

                <div class="d-flex align-items-center input-field my-3 mb-4">
                    <i class="fa-regular fa-user p-2"></i>
                    <input type="text" placeholder="Username or Email" class="form-control" required>
                </div>

                <div class="d-flex align-items-center input-field mb-4">
                    <i class="fa-solid fa-lock p-2"></i>
                    <input type="password" placeholder="Password" required class="form-control pwd">
                    <button class="btn eye-icon">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center input-field mb-4">
                    <i class="fa-solid fa-lock p-2"></i>
                    <input type="password" placeholder="Rewrite Password" required class="form-control pwd">
                    <button class="btn eye-icon">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>

                <button type="button" class="btn btn-primary mb-3 my-3">Signup</button>

                <div class="d-flex justify-content-center">
                    <p class="small fw-bold mt-1 mb-0 text-form">
                        Already have an account?<a href="#" class="link-primary ms-2" id="btn-login">Log in!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/login.js"></script>
</body>

</html>