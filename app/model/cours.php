<?php
namespace App\Model;
use App\Model\Database;
use App\Model\CoursTexte;
use App\Model\Categorie;
use PDO;
use PDOException;
use App\Model\Tag;

abstract class Cours  {
    protected $id;
    protected $titre;
    protected $description;
    protected $id_categorie;
    protected $type;
    protected $enseignant_id;
    protected $status;
    protected $fullName;
    protected $tags ;

    public function getTags()
    {
        $tags = Tag::getAllForCours($this->id);
        return $tags;
    }

    public function __construct($id = null, $titre = null, $description = null, $id_categorie = null, $image_path = null,$enseignant_id=null,$type=null,$status = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->id_categorie = $id_categorie;
        $this->image_path = $image_path;
        $this->enseignant_id = $enseignant_id;
        $this->type = $type;
        $this->status = $status;
    }

    abstract public function ajouter() ;
    abstract public function afficherCours();
    abstract public function mettreAJour();

        public static function afficherCoursPagination($start)
        {
            $pdo = Database::getInstance()->getConnection();
            $stmt = $pdo->prepare("SELECT * from CoursView where status = 'Accepte' LIMIT 6 OFFSET :offset");
            $stmt->bindValue(':offset',$start,PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $coursList = [];
            foreach ($result as $row) {
                if($row['contenu_type'] == 'video')
                {
                    $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    $cour->setFullName($row['fullname']);
                    $coursList[]=$cour;
                } else 
                {
                    $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    $cour->setFullName($row['fullname']);
                    $coursList[]=$cour;
                }
            }
            return $coursList;
        }

     public static function afficherTous(){
  
            $pdo = Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT * FROM CoursView where status = 'Accepte' ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $coursList = [];
            foreach ($result as $row) {
                if($row['contenu_type'] == 'video')
                {
                    $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    $cour->setFullName($row['fullName']);
                    $coursList[]=$cour;
                } else 
                {
                    $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    $cour->setFullName($row['fullName']);
                    $coursList[]=$cour;
                }
            }
            return $coursList;
        
   }
   
   public static function afficherTousAdmin(){
  
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->query("SELECT * FROM CoursView ");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $coursList = [];
    foreach ($result as $row) {
        if($row['contenu_type'] == 'video')
        {
            $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
            $cour->setFullName($row['fullname']);
            $coursList[]=$cour;
        } else 
        {
            $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
            $cour->setFullName($row['fullname']);
            $coursList[]=$cour;
        }
    }
    return $coursList;

}
   public static function afficherParIdProf($idCours)
   {
      $idCourss = (int) $idCours;
   
       $pdo = Database::getInstance()->getConnection();
       $stmt = $pdo->prepare("SELECT * FROM Cours WHERE id = :id ");
       $stmt->bindValue(':id', $idCourss, PDO::PARAM_INT);
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
       if (!$row) {
           throw new Exception("Course with ID $idCours not found.");
       }
   
       if($row['contenu_type'] == 'video')
                {
                    return new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    
                } else 
                {
                    return new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['enseignant_id'],$row['contenu'] ,$row['contenu_type'],$row['status']);

                }
   }
   public static function afficherParId($idCours)
   {
      $idCours = (int) $idCours;
   
       $pdo = Database::getInstance()->getConnection();
       $stmt = $pdo->prepare("SELECT * FROM CoursView WHERE id = :id ");
       $stmt->bindValue(':id', $idCours, PDO::PARAM_INT);
   
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
       if (!$row) {
           throw new Exception("Course with ID $idCours not found.");
       }
   
       if($row['contenu_type'] == 'video')
                {
                    $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    $cour->setFullName($row['fullname']);
                  
                } else 
                {
                    $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'],$row['enseignant_id'], $row['contenu'] ,$row['contenu_type'],$row['status']);
                    $cour->setFullName($row['fullname']);
                  
                }
                return $cour;
   }
   public static function afficherTousParProf($id_enseignant){
  
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM Cours where enseignant_id  = :id ");
    $stmt->bindValue(':id',$id_enseignant,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $coursList = [];
    foreach ($result as $row) {
        if($row['contenu_type'] == 'video')
                {
                    $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    
                    $coursList[]=$cour;
                } else 
                {
                    $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                    $coursList[]=$cour;
                }
    }
    return $coursList;

}
    public static function afficherDeux(){
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->query("SELECT * FROM CoursView ORDER BY id DESC LIMIT 2");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $coursList = [];
    foreach ($result as $row) {
        if($row['contenu_type'] == 'video')
        {
            $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
            $cour->setFullName($row['fullname']);
            $coursList[]=$cour;
        } else 
        {
            $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
            $cour->setFullName($row['fullname']);
            $coursList[]=$cour;
        }
    }
    return $coursList;


}
    public static function searchCours($data)
    {
        $pdo = Database::getInstance()->getConnection();
        $dataSearch = "%" . $data . "%";
        $stmt = $pdo->prepare("SELECT * from CoursView where titre LIKE :data or description LIKE :data ");
        $stmt->bindParam(':data',$dataSearch);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $coursList = [];
        foreach ($result as $row) {
            if($row['contenu_type'] == 'video')
            {
                $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                $cour->setFullName($row['fullname']);
                $coursList[]=$cour;
            } else 
            {
                $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                $cour->setFullName($row['fullname']);
                $coursList[]=$cour;
            }
        }
        return $coursList;

    }
   public static function totalCours()
   {
    try {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("SELECT COUNT(*) as totalCours from public.coursview where status = 'Accepte' ");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['totalcours'];
    } catch (Exception $e ) {
        return 401;

    }
   }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Cours SET titre = :titre, description = :description, id_categorie = :id_categorie, image_path = :image_path, contenue = :contenue, type = :type WHERE id = :id");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':contenue', $this->contenue);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
    public static function updateStatus($idC,$newStatus) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE cours SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':id', $idC);

        return $stmt->execute();
    }


    public static function supprimer($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $status = "Archive";
            $stmt = $db->prepare("UPDATE Cours set status = :status WHERE id = :id");

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':status', $status);
            $res = $stmt->execute();
            if ($res) {
                return 202;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return "Error Deleting Course: " . $e->getMessage();
        }
    }
    public static function supprimerCours($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE from  Cours  WHERE id = :id");

            $stmt->bindParam(':id', $id);
            $res = $stmt->execute();
            if ($res) {
                return 202;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return "Error Deleting Course: " . $e->getMessage();
        }
    }

    public function addEtudiant($etudiant_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO etudiant_cours (cours_id, etudiant_id) VALUES (:cours_id, :etudiant_id)");
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->bindParam(':etudiant_id', $etudiant_id);

        return $stmt->execute();
    }

    public function addTag($tag_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO cours_tag (cours_id, tag_id) VALUES (:cours_id, :tag_id)");
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->bindParam(':tag_id', $tag_id);

        return $stmt->execute();
    }
    public function detachAllTags() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM cours_tag WHERE cours_id = :cours_id");
        $stmt->bindParam(':cours_id', $this->id);
        return $stmt->execute();
    }
    
    static function afficherTousParEtudiant($idE)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT c.*, u.fullname from cours c inner join etudiant_cours e on e.cours_id = c.id inner join "user" u on c.enseignant_id = u.id where e.etudiant_id = :id ');
        $stmt->bindValue(':id', $idE,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $coursList = [];
        foreach ($result as $row) {
            if($row['contenu_type'] == 'video')
            {
                $cour = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                $cour->setFullName($row['fullname']);
                $coursList[]=$cour;
            } else 
            {
                $cour = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                $cour->setFullName($row['fullname']);
                $coursList[]=$cour;
            }
        }
        return $coursList;
        
    }

    public static function totalCoursAdmin()
    {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("SELECT COUNT(*) as totalCours FROM cours");
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['totalcours'];
        } catch (Exception $e) {
            return 401; 
        }
    }

    // 2. Total courses by category (limited to 3)
    public static function totalCoursByCategory()
    {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("SELECT count(c.id) as totalCours,ca.titre,(SELECT COUNT(*) FROM categorie) AS totalCategorie from cours c inner join categorie ca on c.categorie_id = ca.id GROUP BY c.categorie_id,ca.titre LIMIT 3;
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 401;
        }
    }

   
    public static function mostInscriptions()
    {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("
                SELECT COUNT(*) AS totalInscription, cours.titre 
                FROM etudiant_cours e 
                INNER JOIN cours ON cours.id = e.cours_id 
                GROUP BY e.cours_id,cours.titre  
                ORDER BY totalInscription DESC 
                LIMIT 1
            ");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 401;
        }
    }

    // 4. Top 3 courses with the most inscriptions along with the instructor
    public static function topCoursesWithInstructor()
    {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare('SELECT u.fullname, COUNT(e.id) AS totalInscriptions FROM etudiant_cours e INNER JOIN cours c ON c.id = e.cours_id INNER JOIN "user" u ON c.enseignant_id = u.id GROUP BY c.enseignant_id,u.fullname ORDER BY totalInscriptions DESC LIMIT 3;');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 401;
        }
    }
    public static function getAllJson($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM Cours where id = :id ");
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;

    }
    public function attachTag($tagId) {
        try {
            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("INSERT INTO cours_tag (cours_id, tag_id) VALUES (?, ?)");
           $res = $stmt->execute([$this->id, $tagId]);
            return $res;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }
    

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    } 
     public function getStatus() {
        return $this->status;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }
    public function getFullName() {
        return $this->fullName;
    }
    public function setFullName($fullName) {
         $this->fullName = $fullName;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getIdCategorie() {
        return $this->id_categorie;
    }

    public function setIdCategorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }

    public function getImagePath() {
        return $this->image_path;
    }

    public function setImagePath($image_path) {
        $this->image_path = $image_path;
    }
    public function getEnseignantId()
    {
        return $this->enseignant_id;
    }

    public function setContenue($contenue) {
        $this->contenue = $contenue;
    }
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
?>
