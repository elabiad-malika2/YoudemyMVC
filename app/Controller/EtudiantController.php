<?php
namespace App\controller;
use App\core\Controller;
use App\Model\Categorie;
use App\Model\Cours;
use App\Model\Etudiant;
if (session_status() === PHP_SESSION_NONE) {
    session_start();}
class EtudiantController extends Controller {
    public function index() {

        $idS = $_SESSION['logged_id'];

        $cours = Cours::afficherTousParEtudiant($idS);
        $this->view('client/etudiant/index', $cours);
    }
    public function add()
    {
        $content = $_POST;
        print_r($content);

    }
    public function inscrire($courseId)
    {
        $idS = $_SESSION['logged_id'];
        Etudiant::joinCourse($idS,$courseId);
        header('Location: /youdemy-mvc/etudiant');
    }
    
}
?>