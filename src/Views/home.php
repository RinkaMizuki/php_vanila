<?php
// Đặt tiêu đề trang
$title = "Home";
// Include header
include __DIR__ . '/Layouts/header.php';
?>

<h1 class="text-center">Welcome to PHP MVC Vanila</h1>
<p class="lead">This is a simple MVC website using Bootstrap and PHP.</p>

<!-- Sử dụng Bootstrap Grid -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card 1</h5>
                <p class="card-text">Some example text for Card 1.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card 2</h5>
                <p class="card-text">Some example text for Card 2.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card 3</h5>
                <p class="card-text">Some example text for Card 3.</p>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include __DIR__ . '/Layouts/footer.php';
?>