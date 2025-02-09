<?php

namespace App\controller;

use App\core\Controller;
use App\Model\Tag;

class TagController extends Controller
{
    public function getAllJson($query) {
        echo json_encode(Tag::searchTag($query));
    }
     public function ajouter()
     {
         $tags = ($_POST['tags']);
         foreach($tags as $tag)
         {
             $newtag = new Tag(null,$tag);
             $newtag->add();
             header('Location: /youdemy-mvc/admin/tags');
         }
     }
     public function supprimer($id){

         $res=Tag::delete($id);
         if($res)
         {
             header('Location: /youdemy-mvc/admin/tags');
         }
         else
         {
             echo "Couldn't delete ";

                     }
     }
     public function modifier(){
         $id = trim(htmlspecialchars($_POST['id-category-edit']));
         $nom = trim(htmlspecialchars($_POST['nom-category-edit']));
         $tag = new Tag($id,$nom);
         $tag->update();
         header('Location: /youdemy-mvc/admin/tags');

     }
     public function afficher($id)
     {
         echo json_encode(Tag::getTagsByCours($id));
     }

}