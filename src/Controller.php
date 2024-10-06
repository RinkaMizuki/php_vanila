<?php

namespace App;

class Controller
{
    protected function render($view, $data = []): void
    {
        extract($data);

        include_once __DIR__ . "/Views/$view.php";
    }
    protected function redirect($url, $message, $type = 'error'): void
    {
        $_SESSION['message'] = $message;
        $_SESSION['type'] = $type;
        header("Location: $url");
        exit();
    }
}
