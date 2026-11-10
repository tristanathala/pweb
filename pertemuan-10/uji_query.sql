USE db_ppdb_smk;

-- 1. Daftar pendaftaran beserta nama siswa dan jurusan
SELECT p.id_pendaftaran, s.nisn, s.nama_lengkap, j.nama_jurusan,
       p.tahun_ajaran, p.status
FROM pendaftaran p
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN jurusan j ON p.id_jurusan = j.id_jurusan;

-- 2. Jumlah pendaftar per jurusan
SELECT j.kode_jurusan, j.nama_jurusan, j.kuota,
       COUNT(p.id_pendaftaran) AS jumlah_pendaftar
FROM jurusan j
LEFT JOIN pendaftaran p ON j.id_jurusan = p.id_jurusan
GROUP BY j.id_jurusan, j.kode_jurusan, j.nama_jurusan, j.kuota;

-- 3. Jumlah pendaftaran per status
SELECT status, COUNT(*) AS jumlah
FROM pendaftaran
GROUP BY status;

-- 4. Riwayat status satu pendaftaran beserta admin yang mengubahnya
SELECT r.tanggal_perubahan, s.nama_lengkap, r.status_sebelumnya,
       r.status_baru, r.catatan, u.nama AS diubah_oleh
FROM riwayat_status r
JOIN pendaftaran p ON r.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN users u ON r.id_admin = u.id_user
WHERE r.id_pendaftaran = 1
ORDER BY r.tanggal_perubahan, r.id_riwayat;

-- 5. Jumlah berkas per pendaftaran
SELECT s.nama_lengkap, COUNT(b.id_berkas) AS jumlah_berkas
FROM pendaftaran p
JOIN siswa s ON p.id_siswa = s.id_siswa
LEFT JOIN berkas b ON p.id_pendaftaran = b.id_pendaftaran
GROUP BY p.id_pendaftaran, s.nama_lengkap;

-- 6. Email ganda (UNIQUE), harus gagal dengan error #1062
INSERT INTO users (nama, email, password)
VALUES ('Triple T Palsu', 'triplet@gmail.com', 'x');

-- 7. NISN ganda (UNIQUE), harus gagal dengan error #1062
UPDATE siswa SET nisn = '0098765432' WHERE id_siswa = 2;

-- 8. Jurusan yang tidak ada (FOREIGN KEY), harus gagal dengan error #1452
INSERT INTO pendaftaran (id_siswa, id_jurusan, tahun_ajaran)
VALUES (3, 99, '2028/2029');

-- 9. Mendaftar dua kali di tahun ajaran yang sama (UNIQUE id_siswa dan tahun_ajaran), harus gagal dengan error #1062
INSERT INTO pendaftaran (id_siswa, id_jurusan, tahun_ajaran)
VALUES (1, 2, '2027/2028');

-- 10. Menghapus jurusan yang masih dipakai pendaftaran (FOREIGN KEY), harus gagal dengan error #1451
DELETE FROM jurusan WHERE kode_jurusan = 'RPL';
