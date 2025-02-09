<?php
namespace App\controller;
use App\core\Controller;
use App\Model\Admin;
use App\Model\Enseignant;
use App\Model\Etudiant;

class UserController extends Controller {
    public function index() {

    }
    public function setBan() {
        $id = $_POST['user_id'];
        $value = $_POST['ban'];

        if($value == 'ban')
        {
            $ban = true;
        }else {
            $ban = false;
        }
        $res = Admin::setBan($id,$ban);
        header('Location: /youdemy-mvc/public/admin/users');
    }
    public function setActive() {
        $id = $_POST['user_id'];
        $value = $_POST['active'];

        if($value == 'activate')
        {
            $active = true;
        }else {
            $active = false;
        }
        Enseignant::setActive($id,$active);
        header('Location: /youdemy-mvc/public/admin/users');
    }
}
?>