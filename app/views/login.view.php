<?php $this->view('includes/import', $data); ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
</head>

<body>
	<div class="wrapper">
		<div class="card">
			<?php if (message()) : ?>
				<div class="alert alert-success text-center"><?= message('', true) ?></div>
			<?php endif; ?>

			<form method="post" class="d-flex flex-column">
				<div class="text-white d-flex align-items-center title-container">
					<a href="<?= ROOT ?>/home" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
					<span class="h3 m-auto">Login</span>
				</div>

				<div class="d-flex align-items-center input-field mt-3">
					<i class="fa-regular fa-user p-2"></i>
					<input type="text" value="<?= old_value('email') ?>" name="email" placeholder="Email" class="form-control">
				</div>
				<div class="my-2"><small class="text-danger"><?= $user->getError('email') ?></small></div>

				<div class="d-flex align-items-center input-field">
					<i class="fa-solid fa-lock p-2"></i>
					<input type="password" value="<?= old_value('password') ?>" name="password" placeholder="Password" class="form-control pwd">
					<span class="btn eye-icon">
						<i class="fa-solid fa-eye-slash"></i>
					</span>
				</div>
				<div class="my-2"><small class="text-danger"><?= $user->getError('password') ?></small></div>

				<div class="d-flex align-items-center justify-content-between">
					<div class="d-flex align-items-center">
						<label class="option d-flex align-items-center">
							<input type="checkbox" class="checkbox me-2" checked>
							<span class="text-form">Remember Me</span>
						</label>
					</div>
					<div class="mt-sm-0"><a href="<?= ROOT ?>/forgot">Forgot password?</a></div>
				</div>

				<button class="btn btn-primary mb-3 my-3">Login</button>

				<div class="d-flex justify-content-center">
					<p class="small fw-bold mt-1 mb-0 text-form">
						Don't have an account? <a href="<?= ROOT ?>/signup" class="link-primary ms-2">Register</a>
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
	</div>

	<script src="<?= ROOT ?>/assets/js/libs/bootstrap.bundle.min.js"></script>
	<script src="<?= ROOT ?>/assets/js/login.js"></script>

</body>

</html>