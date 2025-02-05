<?php
// require_once 'CoursText.php';
// require_once 'CoursVideo.php';
// require_once 'Tag.php';
namespace App\Model\Entity;


abstract class Course {
    protected $id;
    protected $titre;
    protected $description;
    protected $categorie_id;
    protected $image;
    protected $enseignant_id;
    protected $type;

    public function __construct($id = null, $titre = null, $description = null, $categorie_id = null, $image = null, $enseignant_id = null, $type = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie_id = $categorie_id;
        $this->image = $image;
        $this->enseignant_id = $enseignant_id;
        $this->type = $type;
    }

    abstract public function ajouter();
    abstract public function afficherCours();
    abstract public function mettreAJour();

    // Getters et Setters
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCategorieId() {
        return $this->categorie_id;
    }

    public function setCategorieId($categorie_id) {
        $this->categorie_id = $categorie_id;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
?>
