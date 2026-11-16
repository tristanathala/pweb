<?php
$tahun_ajaran = '2027/2028';

$jadwal = [
    ['Pendaftaran', '1 - 20 Juni 2027'],
    ['Verifikasi berkas', '1 - 22 Juni 2027'],
    ['Seleksi', '23 - 25 Juni 2027'],
    ['Pengumuman', '26 Juni 2027'],
];

$buka = new DateTime('2027-06-01');
$tutup = new DateTime('2027-06-20 23:59:59');

function status_pendaftaran($buka, $tutup)
{
    $hari_ini = new DateTime('today');

    if ($hari_ini < $buka) {
        $sisa = $hari_ini->diff($buka)->days;
        return 'Pendaftaran dibuka ' . $sisa . ' hari lagi';
    }

    if ($hari_ini <= $tutup) {
        return 'Pendaftaran sedang dibuka sampai 20 Juni 2027';
    }

    return 'Pendaftaran tahun ini sudah ditutup';
}
