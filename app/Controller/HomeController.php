<?php
namespace App\Controller;
Use App\Model\Entity\Tag;
Use App\Model\DAO\TagDao;
Use PDO ;


class HomeController {
    public function index(){
        include_once __DIR__ . '/../View/index.php';
    }
    public function showAdmin(){
        $tags=new TagDao();
        $data=$tags->afficherTags();
        include_once __DIR__ . '/../View/admin/index.php';
    }
}

?>