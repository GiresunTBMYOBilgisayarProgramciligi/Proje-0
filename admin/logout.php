<?php

namespace App\Admin;
require_once __DIR__ . '/../autoload.php';

use App\Config;

// Session başlat
session_start();

// 1. Tüm session verilerini temizle
session_unset(); // Session içeriğini temizler
session_destroy(); // Session'ı tamamen sonlandırır

// 2. "Beni Hatırla" çerezini temizle
if (isset($_COOKIE[Config::$COOKIE_KEY])) {
    setcookie(Config::$COOKIE_KEY, "", time() - 3600, "/"); // Çerezi geçmiş zamana ayarlayarak siler
}

// 3. Kullanıcıyı giriş sayfasına yönlendir
header("Location: /admin/login.php");
exit;