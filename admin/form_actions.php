<?php
namespace App\Admin;
session_start();
require_once __DIR__ . '/../autoload.php';

use App\User;
use App\userController;

/*
 * Bu dosya projedeki tüm form işlemlerini yöneten dosya olacak
 * Her form başına hangi form olduğunu belirten bir değişken eklemesi yapacağım
 * bu değişkene göre gerekli işlemleri yapacağım.
 */
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST['formName'] ?? '';
    switch ($formName) {
        case 'login':
            $userController = new userController();
            try {
                $userController->login([
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    "remember_me" => isset($_POST['remember_me'])
                ]);
            } catch (\Exception $e) {
                $errors[] = $e->getMessage();
            }

            if (!count($errors) > 0)
                header("location: /admin");
            else
                var_dump($errors);
            break;
        case 'register':
            var_dump($_POST);
            $new_user = new User();
            if (!isset($_POST['terms'])) {
                $errors[] = ['terms' => "Koşullar kabul edilmelidir"];
            }
            if ($_POST['password'] != $_POST['password_confirm']) {
                $errors[] = ['password' => "Parolalar uyuşmuyor"];
                $errors[] = ['password_confirm' => "Parolalar uyuşmuyor"];

            }
            //todo Kayıt işlemleri yapılacak
            $new_user->email = $_POST['email'];
            $new_user->name = $_POST['name'];
            $new_user->lastname = $_POST['lastname'];
            $new_user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            var_dump($new_user);
            if (!count($errors) > 0)
                echo "";
            //header("location: /admin/login.php");
            else
                var_dump($errors);
            break;
        default:
            echo "Form adı belirtilmemiş";
            break;
    }
}