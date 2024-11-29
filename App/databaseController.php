<?php

namespace App;

use PDO;
use PDOException;
use App\Config;
class databaseController
{

    public $instance = null;

    public function __construct()
    {
        // Config dosyasını dahil et
        require_once 'Config.php';

        // PDO ile bağlantı oluştur
        try {
            $dsn = 'mysql:host=' . Config::$DB_HOST . ';dbname='.Config::$DB_NAME.';charset=utf8mb4';
            $this->instance = new PDO($dsn, Config::$DB_USER, Config::$DB_PASSWORD);
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->instance;
        } catch (PDOException $e) {
            die('Veritabanı bağlantı hatası: ' . $e->getMessage());
        }
    }

}