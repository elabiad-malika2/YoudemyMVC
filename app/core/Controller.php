<?php

namespace App\core;

class Controller {


    // Appeler view
    public function view($view, $data = []) {
        // check 
        if(file_exists('../app/view/' . $view . '.php')) {
            
            require_once '../app/view/' . $view . '.php';
        } else {
            echo("View " . $view . " does not exist");
        }
    }
}
