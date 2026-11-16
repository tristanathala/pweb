<?php
require_once __DIR__ . '/auth.php';

$menu = [
    'beranda'   => ['Beranda', 'index.php'],
    'informasi' => ['Informasi PPDB', 'informasi.php'],
    'panduan'   => ['Panduan', 'panduan.php'],
    'kontak'    => ['Kontak', 'kontak.php'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?> - PPDB Online SMK Nusantara</title>
    <link rel="stylesheet" href="<?= $base ?>assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base ?>assets/vendor/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white site-nav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $base ?>index.php">
            <span>SMK Nusantara</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto me-lg-3">
                <?php foreach ($menu as $key => $item): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $active === $key ? 'active' : '' ?>" href="<?= $base . $item[1] ?>"><?= $item[0] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="d-flex gap-2 py-2 py-lg-0">
                <?php if (is_logged_in()): ?>
                    <a class="btn btn-outline-dark" href="<?= dashboard_url($base) ?>">Dashboard</a>
                    <a class="btn btn-papan" href="<?= $base ?>auth/logout.php">Keluar</a>
                <?php else: ?>
                    <a class="btn btn-outline-dark" href="<?= $base ?>auth/login.php">Masuk</a>
                    <a class="btn btn-papan" href="<?= $base ?>auth/register.php">Buat akun</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
