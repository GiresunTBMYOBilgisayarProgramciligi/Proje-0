<!doctype html>
<html class="no-js" lang="zxx">
<?php
include "theme/head.php";

$page = isset($_GET['p']) ? htmlspecialchars($_GET['p']) : 'main';
?>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<?php
include "theme/header.php";

// Dinamik içerik yükleme
$content_file = "pages/{$page}.php";
if (file_exists($content_file)) {
    include_once $content_file;
} else {
    include_once "pages/404.php"; // Sayfa bulunamazsa 404 sayfası göster
}

include "theme/footer.php";

include "theme/footer_script.php";
?>
</body>

</html>