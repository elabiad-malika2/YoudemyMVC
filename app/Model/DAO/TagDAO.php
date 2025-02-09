<?php
namespace App\Model\DAO;
use PDO ;
use App\Config\Database;
use App\Model\Entity\Tag;



class TagDao {
    public static function add(Tag $tag) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("INSERT INTO tag (titre) VALUES (:titre)");
        $stm->bindParam(':titre', $tag->getTitre(), PDO::PARAM_STR);
        
        if ($stm->execute()) {
            $tag->setId($pdo->lastInsertId());
            return true;
        }
        return false;
    }

    public static function afficherTags() {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("SELECT * FROM tag");
        $stm->execute();
        $resultat = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        $tags = [];
        foreach ($resultat as $value) {
            $tags[] = new Tag($value['id'], $value['titre']);
        }
        return $tags;
    }


    public static function supprimer($id) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("DELETE FROM tag WHERE id = :id");
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stm->execute();
    }
}
?>
