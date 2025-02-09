<?php

namespace App\controller;

use App\core\Controller;
use App\Model\Categorie;

class CategorieController extends Controller
{
    public function index(){

    }
    public function ajouter()
    {
        if(isset($_POST['submit']) ){
            $nom = trim(htmlspecialchars($_POST['nom-category']));
            $category = new Categorie(null,$nom);
            $res = $category->ajouter();
            if($res == 202)
            {
                header('location: /Youdemy-mvc/admin/categories');
            }
            else {
                echo "couldn't add Category";
            }

        }
    }
    public function modifier(){
        $id = trim(htmlspecialchars($_POST['id-category-edit']));
        $nom = trim(htmlspecialchars($_POST['nom-category-edit']));
        $category = new Categorie($id,$nom);
        $category->mettreAJour();
        header('location: /Youdemy-mvc/admin/categories');

    }
    public function supprimer($id){
        $res=Categorie::supprimer($id);
        if($res['success'])
        {
            header('location: /Youdemy-mvc/admin/categories');
        }
        else
        {
            echo "couldn't delete category";
        }
    }

}