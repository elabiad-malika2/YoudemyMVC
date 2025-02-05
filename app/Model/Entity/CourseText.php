<?php
namespace App\Model\Entity;
Use App\Model\Entity\Course;

class CourseText extends Course {
    private $contenue;

    public function __construct($id = null, $titre = "", $description = null, $id_categorie = null, $image = null, $enseignant_id = null, $contenue = null, $type = "texte") {
        parent::__construct($id, $titre, $description, $id_categorie, $image, $enseignant_id, $type);
        $this->contenue = $contenue;
    }

    public function getContenue() {
        return $this->contenue;
    }

    public function setContenue($contenue) {
        $this->contenue = $contenue;
    }

    public function afficherCours() {
        echo "<div class=''>
                <div class='space-y-6'>
                    <div class='border-b pb-4'>
                        <h3 class='text-xl font-bold mb-3 text-gray-800 p-4'>Chapitre 1 : Pour commencer</h3>
                        <p class='text-gray-600 p-4 mb-4'>Introduction au cours et concepts de base.</p>
                        <div class='pl-4 text-gray-600 border-l-4 border-blue-100'>
                            " . htmlspecialchars($this->contenue) . "
                        </div>
                    </div>
                </div>
            </div>";
    }
}
?>
