<?php

namespace App\controller;

use App\core\Controller;

class NotFoundController extends Controller{
    public function index() {
        echo "404 Not Found";
    }
}