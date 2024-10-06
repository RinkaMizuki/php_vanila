<?php

namespace App\Middlewares;

class SessionMiddleware implements IMiddleware {
    public function handle() {
        session_start();
    }
}