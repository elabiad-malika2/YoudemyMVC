<?php
namespace App\controller;
use App\core\Controller;
use App\Model\Categorie;
use App\Model\Cours;
use App\Model\Tag;
use App\Model\User;

class AdminController extends Controller{
    public function index() {
        $data = [];
        $data['totalCours'] = Cours::totalCoursAdmin();
        $data['totalCoursByCategory'] = Cours::totalCoursByCategory();
        $data['mostInscriptions']= Cours::mostInscriptions();
        $data['topCoursesWithInstructor'] = Cours::topCoursesWithInstructor();
        $this->view('admin/index', $data);
        
    }
   public function cours() {
        $cours = Cours::afficherTousAdmin();
        $this->view('admin/cours',$cours);
   }
   public function tags() {
        $tags = Tag::getAll();
        $this->view('admin/tags',$tags);
   }
    public function categories(){
        $data = Categorie::getAll();
        $this->view('admin/categories',$data);
    }
    public function users(){
        $users = User::afficherTout();
        $this->view('admin/users',$users);
    }

}
?>