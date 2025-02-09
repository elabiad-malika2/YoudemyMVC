<?php
namespace App\Controllers;
Use App\Model\Entity\Tag;
Use App\Model\DAO\TagDao;
Use PDO ;

class TagController{
    public function add(){
        $tags=$_POST['tags'];
        foreach ($tags as $tag) {
            $tagTitle = trim(htmlspecialchars($tag));
            $tagT = new Tag(null, $tagTitle);
            TagDao::add($tagT);
        }
        header('Location: /../View/admin/index.php');
        exit();
    }
    public function show(){
        $tags=new Tag();
        $data=$tags->afficherTags();
        include_once __DIR__ . '/../View/admin/index.php';

    }
}



?>