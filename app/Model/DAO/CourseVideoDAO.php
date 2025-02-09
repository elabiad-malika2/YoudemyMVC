<?php
// require_once 'Connection.php';
namespace App\Model\DAO;
Use App\Model\Entity\CourseVideo;
Use App\Config\Database;


class CoursVideoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function ajouter(CourseVideo $coursVideo) {
        $type = 'video';
        $coursVideo->setType($type);
        $stmt = $this->pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image, video_url, contenu_type, enseignant_id) 
                                    VALUES (:titre, :description, :id_categorie, :image, :video_url, :type, :enseignant_id)");

        $stmt->bindParam(':titre', $coursVideo->getTitre());
        $stmt->bindParam(':description', $coursVideo->getDescription());
        $stmt->bindParam(':id_categorie', $coursVideo->getCategorie_id());
        $stmt->bindParam(':image', $coursVideo->getImage());
        $stmt->bindParam(':enseignant_id', $coursVideo->getEnseignant_id());
        $stmt->bindParam(':video_url', $coursVideo->getVideo_url());
        $stmt->bindParam(':type', $coursVideo->getType());

        if ($stmt->execute()) {
            $coursVideo->setId($this->pdo->lastInsertId());
            return true;
        } 
        return false;
    }

    public function mettreAJour(CourseVideo $coursVideo) {
        $sql = "UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                image = :image, video_url = :video_url WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'titre' => $coursVideo->getTitre(),
            'description' => $coursVideo->getDescription(),
            'categorie_id' => $coursVideo->getCategorie_id(),
            'image' => $coursVideo->getImage(),
            'video_url' => $coursVideo->getVideo_url(),
            'id' => $coursVideo->getId()
        ]);
    }
}
?>
