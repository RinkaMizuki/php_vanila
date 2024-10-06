<?php

namespace App\Middlewares;

class AuthMiddleware implements IMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
        return true;
    }
}
