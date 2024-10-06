<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'PHP MVC Vanila'; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet" />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css"
        rel="stylesheet" />

    <!-- Custom CSS (nếu có) -->
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>
    <!-- Navigation bar hoặc header của trang -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">PHP MVC Vanila</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/users">User</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <?php
                if (isset($_SESSION['user'])):
                    $profile_href = "/auth/profile/{$_SESSION['user']['id']}";
                    echo "<div class='d-flex gap-2 align-items-center'>
                        <span>Hello,</span>
                        <a href={$profile_href} class='me-3'>{$_SESSION['user']['username']}</span>
                        <a href='/logout'>Logout</a>
                    </div>"
                ?>
                <?php else: ?>
                    <div class="d-flex gap-3">
                        <button id="login-btn" type="button" class="btn btn-primary" data-mdb-ripple-init>Login</button>
                        <button id="register-btn" type="button" class="btn btn-secondary" data-mdb-ripple-init>Register</button>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>

    <div class="container">