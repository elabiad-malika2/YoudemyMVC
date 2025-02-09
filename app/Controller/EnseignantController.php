<?php
namespace App\controller;
use App\core\Controller;
use App\Model\Categorie;
use App\Model\Cours;
session_start();
class EnseignantController extends Controller {
    public function index() {
        $idE = $_SESSION['logged_id'];
        $data = [];
        $data [] = Categorie::getAll();
        $data [] = Cours::afficherTousParProf($idE);
        $this->view('client/enseignant/index', $data);
    }
    
}
?>