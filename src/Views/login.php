<?php
$title = "Login";

include_once __DIR__ . "/Layouts/header.php";
?>

<section class="vh-100" style="background-color: #9A616D;">
	<div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col col-xl-10">
				<div class="card" style="border-radius: 1rem;">
					<div class="row g-0">
						<div class="col-md-6 col-lg-5 d-none d-md-block">
							<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img2.webp"
								alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
						</div>
						<div class="col-md-6 col-lg-7 d-flex align-items-center">
							<div class="card-body p-4 p-lg-5 text-black">
								<form id="login-form" action="login" method="POST" enctype="application/x-www-form-urlencoded">

									<?php
									if (isset($_SESSION['message'])):
									?>
										<div class="alert alert-danger" role="alert">
											<?= $_SESSION['message'] ?>
										</div>
									<?php
										session_destroy();
									endif;
									?>

									<div class="d-flex align-items-center mb-3 pb-1">
										<i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
										<span class="h1 fw-bold mb-0">Vanila</span>
									</div>

									<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

									<div data-mdb-input-init class="form-outline mb-4">
										<input type="email" id="email" name="email" class="form-control form-control-lg" />
										<label class="form-label" for="email">Email address</label>
									</div>

									<div data-mdb-input-init class="form-outline mb-4">
										<input type="password" id="password" name="password" class="form-control form-control-lg" />
										<label class="form-label" for="password">Password</label>
									</div>

									<div class="pt-1 mb-4">
										<button id="submit-login-btn" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="button">Login</button>
									</div>

									<a class="small text-muted" href="#!">Forgot password?</a>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
include_once __DIR__ . "/Layouts/footer.php";
?>