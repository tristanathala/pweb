<?php
$base = '';
$page_title = 'Kontak Sekolah';
$active = 'kontak';
require 'includes/header.php';
?>

<main>
    <section class="page-head">
        <div class="container py-5">
            <h1 class="mb-2">Kontak Sekolah</h1>
            <p class="mb-0">Panitia PPDB siap membantu pada hari dan jam layanan.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <ul class="daftar-cek mb-4">
                    <li><span class="ikon-bulat"><i class="bi bi-geo-alt"></i></span>
                        <span><strong class="d-block">Alamat</strong>Jl. Nusantara Raya No. 17, Gubeng, Surabaya, Jawa Timur</span></li>
                    <li><span class="ikon-bulat"><i class="bi bi-telephone"></i></span>
                        <span><strong class="d-block">Telepon</strong><a href="tel:+623112345678">(031) 1234 5678</a></span></li>
                    <li><span class="ikon-bulat"><i class="bi bi-envelope"></i></span>
                        <span><strong class="d-block">Email</strong><a href="mailto:ppdb@smknusantara.sch.id">ppdb@smknusantara.sch.id</a></span></li>
                </ul>
                <div class="panel p-3 bagian-sage border-0">
                    <strong class="d-block mb-1">Jam layanan</strong>
                    Senin sampai Jumat, pukul 08.00 - 15.00 WIB
                </div>
            </div>
            <div class="col-lg-7">
                <iframe class="map-frame" title="Peta lokasi SMK Nusantara"
                        src="https://www.openstreetmap.org/export/embed.html?bbox=112.735%2C-7.290%2C112.765%2C-7.265&amp;layer=mapnik"
                        loading="lazy"></iframe>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>
