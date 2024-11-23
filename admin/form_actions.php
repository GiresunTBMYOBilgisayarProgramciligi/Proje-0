<?php

namespace App\Admin;

require_once __DIR__ . '/../autoload.php';

use App\userController;
/*
 * Bu dosya projedeki tüm form işlemlerini yöneten dosya olacak
 * Her form başına hangi form olduğunu belirten bir değişken eklemesi yapacağım
 * bu değişkene göre gerekli işlemleri yapacağım.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formName = $_POST['formName'];
    switch ($formName) {
        case 'login':
            $userController = new userController();
            try {
                $userController->login(['email' => $_POST['email'], 'password' => $_POST['password']]);
            }catch (\Exception $e){
                echo $e->getMessage();
            }

            header("location: /admin");

            break;
        case 'register':

            break;
        default:

            break;
    }
}