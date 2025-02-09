<?php
namespace App\controller;
use App\core\Controller;
use App\Model\Categorie;
use App\Model\Cours;
use App\Model\Etudiant;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class HomeController extends Controller {
    public function index() {
      $data[] = Cours::afficherDeux();
      $data[] = Categorie::getAll();
      $this->view('client/index', $data);
    }
    public function cours($page = 0) {
        $data['$isEtudiant'] = false;
        $start = null;
        $search = null;

        if (isset($_SESSION['role']) && $_SESSION['role'] == 'etudiant') {
            $data['$isEtudiant'] = true;
            $data['$idLog'] = $_SESSION['logged_id'];

        }

        if ($page != 0) {
            if (ctype_digit($page) && intval($page) > 0) {
                $start = (intval($page) - 1) * 6;
            } else {
                $start = 0;
                $search = $page;
            }
        }

        if ($search) {
            $data['cours'] = Cours::searchCours($search);
            $totalCours = count($data['cours']);
        } else {
            $data['cours'] = Cours::afficherCoursPagination($start);
            $totalCours = Cours::totalCours();
        }

        $totalPage = ceil($totalCours / 6);

        $data['categorie'] = Categorie::getAll();
        $data['totalpage'] = $totalPage;

        $this->view('client/cours', $data);
    }


    public function viewCours($id) {
        $idE = $_SESSION['logged_id'];
        $data['categorie'] = Categorie::getAll();
        $data['mine'] = false;
        $data['cours'] = Cours::afficherParId($id);
        if($_SESSION['role'] == 'enseignant')
        {
            $data['cours'] = Cours::afficherParIdProf($id);
            $data['etudiant'] = Etudiant::getEtudiantsByCours($data['cours']->getId());
            if($data['cours']->getEnseignantId() == $idE)
            {
                $data['mine'] = true;
            }
        }
        $this->view('client/viewCours', $data);
    }
    public function login() {
        $data = [
            'title' => 'Welcome'
        ];

        $this->view('login', $data);
    }
    public function signup() {
        $data = [
            'title' => 'Welcome'
        ];

        $this->view('signup', $data);
    }
    public function myfunction(...$data)
    {
        print_r($data);
    }
}
?>