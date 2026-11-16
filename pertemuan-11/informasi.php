<?php
$base = '';
$page_title = 'Informasi PPDB';
$active = 'informasi';
require 'config/database.php';
require 'includes/jadwal.php';
require 'includes/header.php';

$result = mysqli_query($conn, 'SELECT kode_jurusan, nama_jurusan, kuota, deskripsi FROM jurusan ORDER BY id_jurusan');
$daftar_jurusan = mysqli_fetch_all($result, MYSQLI_ASSOC);

$alur = [
    ['Buat akun', 'Daftar dengan nama, email dan password.'],
    ['Lengkapi biodata', 'Isi NISN, data diri, alamat dan asal sekolah.'],
    ['Pilih jurusan', 'Tentukan satu program keahlian.'],
    ['Unggah berkas', 'Kirim KK, akta, rapor dan pas foto.'],
    ['Verifikasi panitia', 'Panitia memeriksa biodata dan berkas.'],
    ['Seleksi dan pengumuman', 'Hasil seleksi tampil di dashboard siswa.'],
];
?>

<main>
    <section class="page-head">
        <div class="container py-5">
            <h1 class="mb-2">Informasi PPDB</h1>
            <p class="mb-0">Jadwal, syarat, alur dan program keahlian untuk tahun ajaran <?= $tahun_ajaran ?>.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <aside class="col-lg-3">
                <nav class="sub-nav sticky-lg-top" aria-label="Isi halaman">
                    <a href="#jadwal">Jadwal</a>
                    <a href="#syarat">Syarat pendaftaran</a>
                    <a href="#alur">Alur pendaftaran</a>
                    <a href="#jurusan">Program keahlian</a>
                </nav>
            </aside>

            <div class="col-lg-9">
                <section id="jadwal" class="mb-5">
                    <h2 class="h3 mb-3">Jadwal</h2>
                    <p class="status-hitung d-inline-block"><?= status_pendaftaran($buka, $tutup) ?></p>
                    <div class="table-responsive panel">
                        <table class="table mb-0">
                            <thead><tr><th class="ps-3">Kegiatan</th><th>Tanggal</th></tr></thead>
                            <tbody>
                            <?php foreach ($jadwal as $item): ?>
                                <tr><td class="ps-3"><?= $item[0] ?></td><td><?= $item[1] ?></td></tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="syarat" class="mb-5">
                    <h2 class="h3 mb-3">Syarat pendaftaran</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h3 class="h6 fw-bold">Calon siswa</h3>
                            <ul class="daftar-cek">
                                <li><span class="ikon-bulat"><i class="bi bi-mortarboard"></i></span>Lulusan SMP/MTs atau sederajat</li>
                                <li><span class="ikon-bulat"><i class="bi bi-person-vcard"></i></span>Memiliki NISN</li>
                                <li><span class="ikon-bulat"><i class="bi bi-envelope"></i></span>Memiliki email aktif</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6 fw-bold">Berkas yang diunggah</h3>
                            <ul class="daftar-cek">
                                <li><span class="ikon-bulat"><i class="bi bi-people"></i></span>Kartu Keluarga (KK)</li>
                                <li><span class="ikon-bulat"><i class="bi bi-file-earmark-text"></i></span>Akta kelahiran</li>
                                <li><span class="ikon-bulat"><i class="bi bi-journal-bookmark"></i></span>Rapor SMP/MTs</li>
                                <li><span class="ikon-bulat"><i class="bi bi-person-square"></i></span>Pas foto terbaru</li>
                            </ul>
                        </div>
                    </div>
                    <p class="small text-secondary mb-0">Berkas diunggah dalam format PDF, JPG atau PNG setelah masuk ke akun siswa.</p>
                </section>

                <section id="alur" class="mb-5">
                    <h2 class="h3 mb-4">Alur pendaftaran</h2>
                    <ol class="langkah">
                        <?php foreach ($alur as $item): ?>
                            <li>
                                <h3><?= $item[0] ?></h3>
                                <p class="text-secondary mb-0"><?= $item[1] ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </section>

                <section id="jurusan">
                    <h2 class="h3 mb-3">Program keahlian</h2>
                    <div class="table-responsive panel">
                        <table class="table mb-0 align-middle">
                            <thead><tr><th class="ps-3">Kode</th><th>Program keahlian</th><th>Keterangan</th><th class="text-end pe-3">Kuota</th></tr></thead>
                            <tbody>
                            <?php foreach ($daftar_jurusan as $jurusan): ?>
                                <tr>
                                    <td class="ps-3"><span class="kode-jurusan"><?= e($jurusan['kode_jurusan']) ?></span></td>
                                    <td class="fw-semibold"><?= e($jurusan['nama_jurusan']) ?></td>
                                    <td class="text-secondary"><?= e($jurusan['deskripsi']) ?></td>
                                    <td class="text-end pe-3"><?= (int) $jurusan['kuota'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>
