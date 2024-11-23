<?php

namespace App;

class databaseController
{

    public $pdo = null;

    public function __construct()
    {
        // Config dosyasını dahil et
        require_once 'config.php';

        // PDO ile bağlantı oluştur
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';charset=utf8mb4';
            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Veritabanının varlığını kontrol et ve yoksa oluştur
            $this->checkDatabase();
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    private function checkDatabase()
    {
        try {
            // Veritabanı oluşturulmuş mu kontrol et
            $this->pdo->exec("USE " . DB_NAME);
        } catch (PDOException $e) {
            // Veritabanı yoksa oluştur
            $this->setup();
        }
    }

    private function setup()
    {
        // Veritabanını oluştur
        $this->pdo->exec("CREATE DATABASE " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
        $this->pdo->exec("USE " . DB_NAME);

        // Tabloları oluştur
        $this->pdo->exec("
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                role VARCHAR(30) DEFAULT 'user',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $this->pdo->exec("
            CREATE TABLE posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                type VARCHAR(30) NOT NULL DEFAULT 'page',
                title VARCHAR(255) NOT NULL,
                content LONGTEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
                author_id INT,
                FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
            );
        ");

        $this->pdo->exec("
            CREATE TABLE user_meta (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                meta_key VARCHAR(100) NOT NULL,
                meta_value TEXT,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            );
        ");
        $this->pdo->exec("
            CREATE TABLE post_meta (
                id INT AUTO_INCREMENT PRIMARY KEY,
                post_id INT NOT NULL,
                meta_key VARCHAR(100) NOT NULL,
                meta_value TEXT,
                FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
            );
        ");
    }

    // Diğer metodlar (fetchAll, fetch, execute, lastInsertId) burada kalabilir.
}

