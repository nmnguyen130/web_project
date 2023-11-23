<?php $this->view('includes/import', $data); ?>

<link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
</head>

<body>
	<div class="wrapper">
		<div class="card">
			<form method="post" class="d-flex flex-column">
				<div class="text-white d-flex align-items-center title-container">
					<a href="<?= ROOT ?>/home" class="text-white text-decoration-underline fs-5 ms-2">Back</a>
					<span class="h3 m-auto">Signup</span>
				</div>

				<div class="d-flex align-items-center input-field mt-3">
					<i class="fa-regular fa-user p-2"></i>
					<input type="text" value="<?= old_value('username') ?>" name="username" placeholder="Username" class="form-control">
				</div>
				<div class="my-2"><small class="text-danger"><?= $user->getError('username') ?></small></div>

				<div class="d-flex align-items-center input-field">
					<i class="fa-regular fa-user p-2"></i>
					<input type="text" value="<?= old_value('email') ?>" name="email" placeholder="Email" class="form-control">
				</div>
				<div class="my-2"><small class="text-danger"><?= $user->getError('email') ?></small></div>

				<div class="d-flex align-items-center input-field">
					<i class="fa-solid fa-lock p-2"></i>
					<input type="password" value="<?= old_value('password') ?>" name="password" placeholder="Password" class="form-control pwd" id="newPass">
					<span class="btn eye-icon">
						<i class="fa-solid fa-eye-slash"></i>
					</span>
				</div>
				<div class="my-2"><small class="text-danger"><?= $user->getError('password') ?></small></div>

				<div class="d-flex align-items-center input-field">
					<i class="fa-solid fa-lock p-2"></i>
					<input type="password" value="<?= old_value('password') ?>" name="password" placeholder="Confirm Password" class="form-control pwd" id="confirmPass">
					<span class="btn eye-icon">
						<i class="fa-solid fa-eye-slash"></i>
					</span>
				</div>
				<div class="my-2"><small class="text-danger" id="confirmError"></small></div>

				<button class="btn btn-primary mb-3" id="signup-btn">Signup</button>

				<div class="d-flex justify-content-center">
					<p class="small fw-bold mt-1 mb-0 text-form">
						Already have an account?<a href="<?= ROOT ?>/login" class="link-primary ms-2">Log in!</a>
					</p>
				</div>
			</form>
		</div>
	</div>

	<script src="<?= ROOT ?>/assets/js/libs/bootstrap.bundle.min.js"></script>
	<script src="<?= ROOT ?>/assets/js/libs/jquery-3.7.1.min.js"></script>
	<script src="<?= ROOT ?>/assets/js/login.js"></script>
</body>

</html>