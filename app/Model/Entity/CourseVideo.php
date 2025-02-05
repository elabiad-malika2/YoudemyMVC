<?php
namespace App\Model\Entity;

Use App\Model\Entity\Course;

class CourseVideo extends Course {
    private $video_url;

    public function __construct($id = null, $titre = null, $description = null, $id_categorie = null, $image = null, $enseignant_id = null, $video_url = null, $type = null) {
        parent::__construct($id, $titre, $description, $id_categorie, $image, $enseignant_id, $type);
        $this->video_url = $video_url;
    }

    public function afficherCours() {
        echo "<div class='space-y-6'>
                <div class='aspect-video bg-gray-100 rounded-lg overflow-hidden'>
                    <video controls class='w-full h-full object-cover'>
                        <source src='./../".$this->video_url."' type='video/mp4'>
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </video>
                </div>
                
                <div class='space-y-4'>
                    <h3 class='text-xl font-bold text-gray-800'>Chapitres vidéo</h3>
                    <div class='bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer'>
                        <div class='flex items-center justify-between'>
                            <div class='flex items-center gap-3'>
                                <i class='ri-play-circle-line text-blue-500 text-xl'></i>
                                <span class='font-medium'>1. Introduction</span>
                            </div>
                            <span class='text-gray-500'>15:30</span>
                        </div>
                    </div>
                    <div class='bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer'>
                        <div class='flex items-center justify-between'>
                            <div class='flex items-center gap-3'>
                                <i class='ri-play-circle-line text-blue-500 text-xl'></i>
                                <span class='font-medium'>2. Pour commencer</span>
                            </div>
                            <span class='text-gray-500'>20:45</span>
                        </div>
                    </div>
                </div>
            </div>";
    }

    public function getVideo_url() {
        return $this->video_url;
    }

    public function setVideo_url($video_url) {
        $this->video_url = $video_url;
    }
}
?>
