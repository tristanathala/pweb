<?php
$base = '';
$page_title = 'Beranda';
$active = 'beranda';
require 'config/database.php';
require 'includes/jadwal.php';
require 'includes/header.php';

$result = mysqli_query($conn, 'SELECT kode_jurusan, nama_jurusan, kuota, deskripsi FROM jurusan ORDER BY id_jurusan');
$daftar_jurusan = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<main>
    <section class="hero">
        <div class="container py-5">
            <div class="row align-items-center g-5 py-lg-4">
                <div class="col-lg-6">
                    <h1 class="mb-3">Pendaftaran Siswa Baru SMK Nusantara Tahun Ajaran <?= $tahun_ajaran ?></h1>
                    <p class="mb-4">Daftar dari rumah, unggah berkas secara online dan pantau hasil seleksi lewat akunmu sendiri.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-manila btn-lg" href="auth/register.php">Buat akun pendaftaran</a>
                        <a class="btn btn-garis btn-lg" href="informasi.php#syarat">Lihat syarat</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-foto">
                        <img src="assets/images/gedung-sekolah.jpg" alt="Gedung SMK Nusantara dengan lapangan dan bendera merah putih"
                             width="800" height="450">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <h2 class="h3 mb-2"><?= count($daftar_jurusan) ?> program keahlian</h2>
        <p class="text-secondary mb-4">Pilih satu program keahlian saat mengisi formulir pendaftaran.</p>
        <div class="row g-3">
            <?php foreach ($daftar_jurusan as $jurusan): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="panel p-3 h-100">
                        <span class="kode-jurusan mb-2"><?= e($jurusan['kode_jurusan']) ?></span>
                        <h3 class="h6 fw-bold mb-1"><?= e($jurusan['nama_jurusan']) ?></h3>
                        <p class="small text-secondary mb-2"><?= e($jurusan['deskripsi']) ?></p>
                        <small class="fw-semibold">Kuota <?= (int) $jurusan['kuota'] ?> siswa</small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bagian-sage">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h2 class="h3 mb-3">Siapkan berkas ini sebelum mendaftar</h2>
                    <ul class="daftar-cek mb-0">
                        <li><span class="ikon-bulat"><i class="bi bi-people"></i></span>Kartu Keluarga (KK)</li>
                        <li><span class="ikon-bulat"><i class="bi bi-file-earmark-text"></i></span>Akta kelahiran</li>
                        <li><span class="ikon-bulat"><i class="bi bi-journal-bookmark"></i></span>Rapor SMP/MTs</li>
                        <li><span class="ikon-bulat"><i class="bi bi-person-square"></i></span>Pas foto terbaru</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="panel p-4">
                        <h2 class="h4 mb-2">Baru pertama kali mendaftar?</h2>
                        <p class="text-secondary">Baca panduan langkah demi langkah, mulai dari membuat akun sampai melihat hasil seleksi.</p>
                        <a class="btn btn-papan" href="panduan.php">Baca panduan</a>
                        <hr class="my-4">
                        <p class="mb-0">Sudah punya akun? <a href="auth/login.php" class="fw-semibold">Masuk ke akunmu</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require 'includes/footer.php'; ?>
