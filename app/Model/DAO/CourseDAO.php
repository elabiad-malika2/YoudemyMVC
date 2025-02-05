<?php
// require_once 'Connection.php';
// require_once 'CoursText.php';
// require_once 'CoursVideo.php';
namespace App\Model\DAO;

Use App\Model\Entity\Cours;


class CourseDAO {

    public function afficherCoursProf($idEnseignant) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("SELECT * FROM cours WHERE enseignant_id = :enseignant_id");
        $stm->bindParam(':enseignant_id', $idEnseignant, PDO::PARAM_INT);
        $stm->execute();
        $resultat = $stm->fetchAll(PDO::FETCH_ASSOC);
        $coursProf = [];

        foreach ($resultat as $c) {
            if ($c['contenu_type'] == 'video') {
                $coursProf[] = new CourseVideo($c['id'], $c['titre'], $c['description'], $c['categorie_id'], $c['image'], $c['video_url'], $c['contenu_type']);
            } else {
                $coursProf[] = new CourseText($c['id'], $c['titre'], $c['description'], $c['categorie_id'], $c['image'], $c['contenu'], $c['contenu_type']);
            }
        }
        return $coursProf;
    }

    public function afficherCoursId($idCours) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("SELECT * FROM cours WHERE id = :idCours");
        $stm->bindParam(':idCours', $idCours, PDO::PARAM_INT);
        $stm->execute();
        $resultat = $stm->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            if ($resultat['contenu_type'] == 'video') {
                return new CoursVideo($resultat['id'], $resultat['titre'], $resultat['description'], $resultat['categorie_id'], $resultat['image'], $resultat['enseignant_id'], $resultat['video_url'], $resultat['contenu_type']);
            } else {
                return new CoursTexte($resultat['id'], $resultat['titre'], $resultat['description'], $resultat['categorie_id'], $resultat['image'], $resultat['enseignant_id'], $resultat['contenu'], $resultat['contenu_type']);
            }
        }
        return null;
    }

    public function afficherTous($search = '', $page = 1, $limit = 6) {
        $pdo = Database::getInstance()->getConnection();
        $offset = ($page - 1) * $limit;

        $stm = $pdo->prepare("SELECT * FROM cours WHERE (titre LIKE :search OR description LIKE :search) AND status = 'Accepte' LIMIT :limit OFFSET :offset");
        $searchT = "%$search%";
        $stm->bindParam(':search', $searchT, PDO::PARAM_STR);
        $stm->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $cours = [];
        foreach ($result as $row) {
            if ($row['contenu_type'] == 'video') {
                $cours[] = new CoursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image'], $row['video_url'], $row['contenu_type']);
            } else {
                $cours[] = new CoursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image'], $row['contenu'], $row['contenu_type']);
            }
        }
        return $cours;
    }

    public function modifierStatus($idC, $status) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("UPDATE cours SET status = :status WHERE id = :idC");
        $stm->bindParam(":status", $status, PDO::PARAM_STR);
        $stm->bindParam(":idC", $idC, PDO::PARAM_INT);
        return $stm->execute();
    }

    public function afficherTotalSomme($search = '') {
        $pdo = Database::getInstance()->getConnection();
        if (empty($search)) {
            $stm = $pdo->query("SELECT count(*) FROM cours");
        } else {
            $stm = $pdo->prepare("SELECT count(*) FROM cours WHERE titre LIKE :search OR description LIKE :search");
            $searchT = "%$search%";
            $stm->bindParam(":search", $searchT, PDO::PARAM_STR);
            $stm->execute();
        }
        return $stm->fetchColumn();
    }

    public function supprimer($id) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("DELETE FROM cours WHERE id = :id");
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }

    public function addEtudiant($coursId, $etudiantId) {
        $pdo = Database::getInstance()->getConnection();
        $stm = $pdo->prepare("INSERT INTO etudiant_cours (cours_id, etudiant_id) VALUES (:cours_id, :etudiant_id)");
        $stm->bindParam(':cours_id', $coursId, PDO::PARAM_INT);
        $stm->bindParam(':etudiant_id', $etudiantId, PDO::PARAM_INT);
        return $stm->execute();
    }
}
?>
