<?php

namespace App\controller;

use App\core\Controller;
use App\Model\Cours;
use Exception;
use App\model\CoursTexte;
use App\Model\CoursVideo;
use App\Model\Tag;
session_start();
class CoursController extends Controller
{
    public function ajouter()
    {
        try {
            $titre = $_POST['title'];
            $description = $_POST['description'];
            $id_categorie = $_POST['categorie'];
            $type = $_POST['type'];
            $enseignant_id = $_SESSION['logged_id'];

            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = '/uploads/images/' . basename($_FILES['image']['name']);
                $destination = __DIR__ . '/../../public' . $imagePath;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    throw new Exception('Failed to upload image.');
                }
            }

            if ($type === 'text') {
                $contenue = $_POST['content'] ?? null;
                $cours = new CoursTexte(null, $titre, $description, $id_categorie, $imagePath, $enseignant_id, $contenue, 'texte');
            } elseif ($type === 'video') {
                $videoPath = null;
                if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                    $videoPath = '/uploads/videos/' . basename($_FILES['video']['name']);
                    $videoDestination = __DIR__ . '/../../public' . $videoPath;

                    if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoDestination)) {
                        throw new Exception('Failed to upload video.');
                    }
                }
                $cours = new CoursVideo(null, $titre, $description, $id_categorie, $imagePath, $videoPath, $enseignant_id,  'video');
            } else {
                throw new Exception('Invalid course type.');
            }

            if ($cours->ajouter()) {
                $selectedTags = json_decode($_POST['selectedTags'], true);
                if ($selectedTags) {
                    foreach ($selectedTags as $tag) {
                        if (strpos($tag['id'], 'new') === 0) {
                            $nom = htmlspecialchars($tag['titre']);
                            $newTag = new Tag(null,$nom);
                            $result = $newTag->add();
                            $tagId=$newTag->getId();
                        } else {
                            $tagId = $tag['id'];
                        }

                        $cours->attachTag($tagId);
                    }
                }
                echo json_encode(['success' => true, 'message' => 'Course added successfully.']);
            } else {
                throw new Exception('Failed to add the course to the database.');
            }
        } catch (Exception $e) {
            $errorLog = __DIR__ . '/../../../logs/error.log';
            file_put_contents($errorLog, '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL, FILE_APPEND);

            echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
        }

    }
    public function updateStatus()
    {
        $idCours = $_POST['cours_id'];
        if(isset($_POST['action']))
        {
            $newStatus = $_POST['action'];
            $res = Cours::updateStatus($idCours,$newStatus);
            header("Location: /youdemy-mvc/admin/cours");
        }
    }
    public function afficher($id)
    {
        echo json_encode(Cours::getAllJson($id));
    }

    public function supprimer($id)
    {
        Cours::supprimer($id);
        header('Location: /youdemy-mvc/enseignant');
    }

}