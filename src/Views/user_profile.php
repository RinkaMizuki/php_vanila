<?php
// Đặt tiêu đề trang
$title = "User profile";

// Include header
include_once __DIR__ . "/Layouts/header.php";
?>

<section class="vh-100" style="background-color: #f4f5f7;">
	<div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col col-lg-6 mb-4 mb-lg-0">
				<div class="card mb-3" style="border-radius: .5rem;">
					<div class="row g-0">
						<div class="col-md-4 gradient-custom text-center text-white"
							style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
							<img src="<?=
												!empty($user['url']) ?  $user['url'] : 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp';
												?>"
								alt="Avatar" class="img-fluid my-5" style="width: 130px; height: 130px; object-fit: cover; border-radius: 50%" />
							<h5><? echo $user['fullname'] ? $user['fullname'] : '-' ?></h5>
							<p><? echo $user['major'] ? $user['major'] : '-' ?></p>

							<!-- Button trigger modal -->
							<i class="far fa-edit mb-5" role="button" data-mdb-modal-init data-mdb-target="#profileModal"></i>

							<!-- Modal -->
							<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="profileModalLabel">Profile information</h5>
										</div>
										<div class="modal-body">
											<form id="profile-form" action="update" method="POST" enctype="multipart/form-data">
												<input name="id" value="<? echo $user['id'] ?>" hidden>
												<label class="form-label" for="facebook">Personal</label>
												<input
													name="fullname"
													type="text"
													class="form-control mb-3"
													placeholder="Enter your name"
													aria-label="fullname"
													value="<? echo $user['fullname'] ?>" />
												<input
													name="major"
													type="text"
													class="form-control mb-3"
													placeholder="Enter your major"
													aria-label="major"
													value="<? echo $user['major'] ?>" />

												<input
													name="phone"
													type="text"
													class="form-control mb-3"
													placeholder="Enter your phone"
													aria-label="phone"
													value="<? echo $user['phone'] ?>" />
												<div class="input-group mb-3">
													<input
														name="email"
														type="text"
														class="form-control"
														placeholder="Enter your email"
														aria-label="Email"
														aria-describedby="basic-addon2"
														value="<? echo strtok($user['email'], '@') ?>" />
													<span class="input-group-text" id="basic-addon2">@gmail.com</span>
												</div>

												<input type="file" name="avatar" class="form-control" id="avatar" accept="image/*" />

												<label class='form-label mt-3'>Socials</label>
												<?php
												foreach ($socials as $social) {
													$is_social_exist = false;
													foreach ($user['socials'] as $user_social) {
														if ($social['id'] === $user_social['social_id']) {
															$is_social_exist = true;
															echo
															"<div class='input-group mb-3'>
																	<label class='input-group-text' for={$user_social['social_id']}>{$user_social['base_url']}</label>
																	<input
																		name={$user_social['name']}
																		type='text'
																		class='form-control'
																		id={$user_social['social_id']}
																		aria-describedby={$user_social['link']} 
																		value={$user_social['link']}
																	/>
																	<input
																		name={$user_social['name']}Id
																		value={$user_social['social_id']}
																		hidden
																	/>
															</div>";
														}
													}
													if (!$is_social_exist) {
														echo
														"<div class='input-group mb-3'>
																	<label class='input-group-text' for={$social['id']}>{$social['base_url']}</label>
																	<input
																		name={$social['name']}
																		type='text'
																		class='form-control'
																		id={$social['id']}
																	/>
																	<input
																		name={$social['name']}Id
																		value={$social['id']}
																		hidden
																	/>
															</div>";
													}
												}
												?>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
											<button id="submit-profile-btn" type="button" class="btn btn-primary" data-mdb-ripple-init>Save changes</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card-body p-4">
								<h6>Information</h6>
								<hr class="mt-0 mb-4">
								<div class="row pt-1">
									<div class="col-6 mb-3">
										<h6>Email</h6>
										<p class="text-muted"><? echo $user['email'] ? $user['email']  :  '-' ?></p>
									</div>
									<div class="col-6 mb-3">
										<h6>Phone</h6>
										<p class="text-muted"><? echo $user['phone'] ? $user['phone'] : '-' ?></p>
									</div>
								</div>
								<h6>Social networks</h6>
								<hr class="mt-0 mb-4">
								<div class="d-flex justify-content-start">
									<?php
									foreach ($user['socials'] as $user_social) {
										echo "<a href='{$user_social['base_url']}{$user_social['link']}' class='me-3' target='_blank'>{$user_social['icon']}</a>";
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
// Include footer
include_once __DIR__ . "/Layouts/footer.php";
?>