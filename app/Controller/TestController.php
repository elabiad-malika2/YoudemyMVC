<?php

namespace App\controller;

use App\core\Controller;

class TestController extends Controller
{
    public function myfunction($param)
    {
        $this->view('client/test',$param);
    }
}