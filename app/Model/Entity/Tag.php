<?php
namespace App\Model\Entity;

class Tag {
    private $id;
    private $titre;

    public function __construct($id = null, $titre = null) {
        $this->id = $id;
        $this->titre = $titre;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }
}
?>
