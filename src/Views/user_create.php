<?php
// Đặt tiêu đề trang
$title = "Create User";

// Include header
include_once __DIR__ . "/Layouts/header.php";
?>

<form action="create" method="POST" enctype="application/x-www-form-urlencoded" class="mt-4">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="fullname" class="form-label">Full name</label>
    <input type="text" class="form-control" id="fullname" name="fullname">
  </div>
  <div class="mb-3">
    <label for="age" class="form-label">Age</label>
    <input type="number" class="form-control" id="age" name="age">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address">
  </div>
  <div class="mb-3">
    <label for="birthday" class="form-label">Birthday</label>
    <input type="date" class="form-control" id="birthday" name="birthday" value="2024-01-09">
  </div>
  <div class="mb-3">
    <label for="gender" class="form-label me-4">Gender: </label>
    <input type="radio" id="male" name="gender" value="male" checked>
    <label for="gender" class="form-label">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="gender" class="form-label">Female</label>
  </div>
  <button type="submit" class="btn btn-primary">Create user</button>
</form>

<?php

// Include footer
include_once __DIR__ . "/Layouts/footer.php";
?>