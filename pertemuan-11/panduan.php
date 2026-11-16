<?php
$base = '';
$page_title = 'Panduan Pendaftaran';
$active = 'panduan';
require 'includes/header.php';

$langkah = [
    ['Buat akun', 'Klik "Buat akun" lalu isi nama lengkap, email aktif dan password minimal 8 karakter. Simpan email dan password untuk masuk berikutnya.'],
    ['Lengkapi biodata', 'Masuk ke akun lalu isi NISN, jenis kelamin, tempat dan tanggal lahir, alamat, asal sekolah dan nomor HP.'],
    ['Pilih jurusan', 'Pilih satu program keahlian. Satu siswa hanya bisa mendaftar sekali dalam satu tahun ajaran.'],
    ['Unggah berkas', 'Unggah KK, akta kelahiran, rapor dan pas foto. Pastikan foto berkas jelas dan tidak terpotong.'],
    ['Pantau status', 'Status pendaftaran berubah dari menunggu menjadi diverifikasi, lalu diterima atau ditolak. Semua bisa dilihat di dashboard.'],
];

$tanya_jawab = [
    ['Apakah pendaftaran dipungut biaya?', 'Tidak. Pendaftaran PPDB Online SMK Nusantara tidak dipungut biaya.'],
    ['Saya lupa password, apa yang harus dilakukan?', 'Hubungi panitia melalui telepon atau email di halaman Kontak dengan menyebutkan email yang dipakai saat mendaftar.'],
    ['Bisakah saya mengganti jurusan setelah mendaftar?', 'Data pendaftaran tidak bisa diubah selama proses verifikasi. Hubungi panitia jika ada kesalahan pilihan.'],
    ['Berkas saya ditolak, bagaimana?', 'Panitia akan menuliskan catatan di riwayat status. Perbaiki berkas sesuai catatan lalu unggah ulang.'],
];
?>

<main>
    <section class="page-head">
        <div class="container py-5">
            <h1 class="mb-2">Panduan Pendaftaran</h1>
            <p class="mb-0">Lima langkah dari membuat akun sampai melihat hasil seleksi.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <ol class="langkah">
                    <?php foreach ($langkah as $item): ?>
                        <li>
                            <h2 class="h5"><?= $item[0] ?></h2>
                            <p class="text-secondary mb-0"><?= $item[1] ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <a class="btn btn-papan" href="auth/register.php">Mulai dengan membuat akun</a>
            </div>

            <div class="col-lg-5">
                <div class="panel p-4 faq">
                    <h2 class="h4 mb-2">Pertanyaan yang sering diajukan</h2>
                    <?php foreach ($tanya_jawab as $item): ?>
                        <details>
                            <summary><?= $item[0] ?></summary>
                            <p class="text-secondary"><?= $item[1] ?></p>
                        </details>
                    <?php endforeach; ?>
                    <p class="small mt-3 mb-0">Pertanyaan lain? <a href="kontak.php">Hubungi panitia</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>
