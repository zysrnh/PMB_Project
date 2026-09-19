<?php
// router.php untuk PHP Built-in Server (php -S localhost:8000 router.php)
// Mengemulasi RewriteRule .htaccess

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$filePath = __DIR__ . $uri;

// 1. Jika request file static fisik yang ada di disk (CSS, JS, gambar, font, dll), biarkan PHP server serve langsung
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false;
}

// 2. Routing URL rewrite berbasis .htaccess
if ($uri === '/' || $uri === '/index.html') {
    $_GET['pilih'] = null;
    include __DIR__ . '/index.php';
    return true;
}

if ($uri === '/admin.html') {
    $_GET['pilih'] = 'siteadmin';
    $_GET['modul'] = 'yes';
    include __DIR__ . '/index.php';
    return true;
}

// pages/{id}/{slug}.html
if (preg_match('#^/pages/([0-9]+)/([^/]+)\.html$#', $uri, $matches)) {
    $_GET['pilih'] = 'hal';
    $_GET['id'] = $matches[1];
    include __DIR__ . '/index.php';
    return true;
}

// artikel/{id}/{slug}.html
if (preg_match('#^/artikel/([^/]+)/([^/]+)\.html$#', $uri, $matches)) {
    $_GET['pilih'] = 'artikel';
    $_GET['modul'] = 'yes';
    $_GET['aksi'] = 'lihat';
    $_GET['id'] = $matches[1];
    include __DIR__ . '/index.php';
    return true;
}

// kategori/{id}/...
if (preg_match('#^/kategori/([0-9]+)/#', $uri, $matches)) {
    $_GET['pilih'] = 'artikel';
    $_GET['modul'] = 'yes';
    $_GET['aksi'] = 'arsip';
    $_GET['topik'] = $matches[1];
    include __DIR__ . '/index.php';
    return true;
}

// register.html
if ($uri === '/register.html') {
    $_GET['pilih'] = 'user';
    $_GET['aksi'] = 'register';
    include __DIR__ . '/index.php';
    return true;
}

// login.html
if ($uri === '/login.html') {
    $_GET['pilih'] = 'login';
    $_GET['modul'] = 'yes';
    include __DIR__ . '/index.php';
    return true;
}

// Generic modul: {modul}.html (contoh: faq.html, hubungi.html, pengaduan.html, dll)
if (preg_match('#^/([a-zA-Z0-9_-]+)\.html$#', $uri, $matches)) {
    $mod = $matches[1];
    if ($mod === 'hubungi') $mod = 'contact';
    $_GET['pilih'] = $mod;
    $_GET['modul'] = 'yes';
    include __DIR__ . '/index.php';
    return true;
}

// Default fallback ke index.php
include __DIR__ . '/index.php';
return true;
