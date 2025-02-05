<?php
// require_once 'Connection.php';
// require_once 'CoursTexte.php';
namespace App\Model\DAO;

Use App\Model\Entity\CourseText;


class CourseTexteDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    public function ajouter(CourseTexte $coursTexte) {
        $stmt = $this->pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image, contenu, contenu_type, enseignant_id) 
                                    VALUES (:titre, :description, :id_categorie, :image, :contenue, :type, :enseignant_id)");
        return $stmt->execute([
            'titre' => $coursTexte->getTitre(),
            'description' => $coursTexte->getDescription(),
            'id_categorie' => $coursTexte->getCategorieId(),
            'image' => $coursTexte->getImage(),
            'enseignant_id' => $coursTexte->getEnseignantId(),
            'contenue' => $coursTexte->getContenue(),
            'type' => 'texte'
        ]);
    }

    public function mettreAJour(CourseTexte $coursTexte) {
        $stmt = $this->pdo->prepare("UPDATE Cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                                    image = :image, contenu = :contenu WHERE id = :id");
        
        return $stmt->execute([
            'titre' => $coursTexte->getTitre(),
            'description' => $coursTexte->getDescription(),
            'categorie_id' => $coursTexte->getCategorieId(),
            'image' => $coursTexte->getImage(),
            'contenu' => $coursTexte->getContenue(),
            'id' => $coursTexte->getId()
        ]);
    }

    public function supprimer($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Cours WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Cours WHERE id = :id AND contenu_type = 'texte'");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            return new CourseTexte($data['id'], $data['titre'], $data['description'], $data['categorie_id'], $data['image'], $data['enseignant_id'], $data['contenu']);
        }
        return null;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Cours WHERE contenu_type = 'texte'");
        $cours = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cours[] = new CourseTexte($data['id'], $data['titre'], $data['description'], $data['categorie_id'], $data['image'], $data['enseignant_id'], $data['contenu']);
        }
        return $cours;
    }
}
?>
