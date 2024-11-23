<?php

namespace App;

use PDO;
use PDOException;
class databaseController
{

    public $instance = null;

    public function __construct()
    {
        // Config dosyasını dahil et
        require_once 'config.php';

        // PDO ile bağlantı oluştur
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname='.DB_NAME.';charset=utf8mb4';
            $this->instance = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->instance;
        } catch (PDOException $e) {
            die('Veritabanı bağlantı hatası: ' . $e->getMessage());
        }
    }

}