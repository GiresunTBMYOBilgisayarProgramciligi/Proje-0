<?php
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/App/';

    // Prefix kontrolü
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Sınıfın dosya yolunu belirle
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Dosyayı yükle
    if (file_exists($file)) {
        require_once $file;
    }
});