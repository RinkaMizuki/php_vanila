<?php

namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home');
    }
    public function getNotFoundPage()
    {
        $this->render('not-found');
    }
}
