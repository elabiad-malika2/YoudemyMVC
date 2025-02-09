<?php

namespace App\controller;

use App\core\Controller;
use App\Model\Enseignant;
use App\Model\Etudiant;
use App\Model\Admin;
use App\Model\User;

class AuthController extends Controller
{
    public function login() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $email = trim(htmlspecialchars($_POST['username']));
          $password = trim(htmlspecialchars($_POST['password']));

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $_SESSION['message'] = "Invalid email format";
              $_SESSION['message_type'] = "error";
              header('Location: /Youdemy-mvc/admin/login');
              exit;
          }

          $user = User::login($email, $password);

          if($user === 403)
          {
              $_SESSION['message'] = "Invalid email or password ";
              $_SESSION['message_type'] = "error";
              header('Location: /Youdemy-mvc/home/login');
          }
          else if ($user) {
              if ($user->isBanned()){
                  $_SESSION['message'] = "This User is banned";
                  $_SESSION['message_type'] = "error";
                  User::logout();
                  header('Location: /Youdemy-mvc/home/login');
              } else {
                  if($user->getRole() == 'enseignant')
                  {
                      $res = $user->isActive();
                      if($res )
                      {
                          $_SESSION['message'] = "Welcome back ".$user->getNom();
                          $_SESSION['message_type'] = "success";
                          header('Location: /Youdemy-mvc/enseignant');
                      } else if(!$res) {
                          $_SESSION['message'] = "Compte pas encore activé ";
                          $_SESSION['message_type'] = "error";
                          User::logout();
                          header('Location: /Youdemy-mvc/home/login');
                      } else {
                          echo "aa";
                      }

                  } else if($user->getRole() == 'etudiant'){
                      $_SESSION['message'] = "Welcome back ".$user->getNom();
                      $_SESSION['message_type'] = "success";
                      header('Location: /Youdemy-mvc/etudiant');
                  } else if($user->getRole() == 'admin'){
                      $_SESSION['message'] = "Welcome back ".$user->getNom();
                      $_SESSION['message_type'] = "success";
                      header('Location: /Youdemy-mvc/admin');
                  }
              }

          } else {
              $_SESSION['message'] = "User Not Found";
              $_SESSION['message_type'] = "error";
              header('Location: /Youdemy-mvc/home/login');
          }
          exit;
      }
    }
    public function signup() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            print_r($_POST);
            $email = trim(htmlspecialchars($_POST['email-signup']));
            $password = trim(htmlspecialchars($_POST['password-signup']));
            $fullName = trim(htmlspecialchars($_POST['fullName-signup']));
            $role = trim(htmlspecialchars($_POST['role-signup']));

            if ($role === 'etudiant') {
                $res = Etudiant::signup($fullName, $email, $password, $role);
            } else if ($role === 'enseignant') {
                $res = Enseignant::signup($fullName, $email, $password, $role, 0);
            } else {
                $_SESSION['message'] = "Invalid role selected";
                $_SESSION['message_type'] = "error";
                header("Location: /Youdemy-mvc/home/signup");
                exit;
            }

            if ($res) {
                $_SESSION['message_type'] = "success";
                $_SESSION['message'] = "Signup successful! Please log in.";
                header("Location: /Youdemy-mvc/home/login");

            } else {
                $_SESSION['message_type'] = "error";
                $_SESSION['message'] = "Email already exists";
                header("Location: /Youdemy-mvc/home/signup");

            }
            exit;
        }

    }
    public function logout() {
        User::logout();
        header('Location: /Youdemy-mvc/home/login');
    }
}