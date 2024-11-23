<?php

namespace App;

use PDO;
use PDOException;
class databaseController
{

    public $pdo = null;

    public function __construct()
    {
        // Config dosyasını dahil et
        require_once 'config.php';

        // PDO ile bağlantı oluştur
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname='.DB_NAME.';charset=utf8mb4';
            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die('Veritabanı bağlantı hatası: ' . $e->getMessage());
        }
    }

}