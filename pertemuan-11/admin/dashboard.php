<?php
$base = '../';
require '../includes/auth.php';
require_role('admin', $base);

$page_title = 'Dashboard Admin';
$active = '';
require '../includes/header.php';
?>

<main class="container py-5">
    <p class="text-secondary mb-1">Panitia PPDB</p>
    <h1 class="mb-3">Halo, <?= e($_SESSION['nama']) ?></h1>
    <div class="panel p-4 mb-4">
        <p class="mb-0">Statistik, data pendaftar, verifikasi, seleksi dan laporan akan tersedia di halaman ini pada tahap berikutnya.</p>
    </div>
    <a class="btn btn-outline-dark" href="../auth/logout.php">Keluar</a>
</main>

<?php require '../includes/footer.php'; ?>
