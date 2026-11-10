CREATE DATABASE db_ppdb_smk;
USE db_ppdb_smk;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'siswa') NOT NULL DEFAULT 'siswa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE siswa (
    id_siswa INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL UNIQUE,
    nisn VARCHAR(20) NOT NULL UNIQUE,
    nama_lengkap VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    tempat_lahir VARCHAR(50),
    tanggal_lahir DATE,
    alamat TEXT,
    asal_sekolah VARCHAR(100),
    no_hp VARCHAR(20),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE jurusan (
    id_jurusan INT AUTO_INCREMENT PRIMARY KEY,
    kode_jurusan VARCHAR(10) NOT NULL UNIQUE,
    nama_jurusan VARCHAR(100) NOT NULL,
    kuota INT NOT NULL DEFAULT 0,
    deskripsi TEXT
);

CREATE TABLE pendaftaran (
    id_pendaftaran INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT NOT NULL,
    id_jurusan INT NOT NULL,
    tahun_ajaran VARCHAR(9) NOT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('menunggu', 'diverifikasi', 'diterima', 'ditolak')
        NOT NULL DEFAULT 'menunggu',
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan),
    UNIQUE (id_siswa, tahun_ajaran)
);

CREATE TABLE berkas (
    id_berkas INT AUTO_INCREMENT PRIMARY KEY,
    id_pendaftaran INT NOT NULL,
    jenis_berkas ENUM('kk', 'akta', 'rapor', 'pas_foto') NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    tanggal_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pendaftaran) REFERENCES pendaftaran(id_pendaftaran)
);

CREATE TABLE riwayat_status (
    id_riwayat INT AUTO_INCREMENT PRIMARY KEY,
    id_pendaftaran INT NOT NULL,
    status_sebelumnya ENUM('menunggu', 'diverifikasi', 'diterima', 'ditolak'),
    status_baru ENUM('menunggu', 'diverifikasi', 'diterima', 'ditolak') NOT NULL,
    catatan TEXT,
    id_admin INT NOT NULL,
    tanggal_perubahan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pendaftaran) REFERENCES pendaftaran(id_pendaftaran),
    FOREIGN KEY (id_admin) REFERENCES users(id_user)
);

-- Contoh data
-- admin@smknusantara.sch.id -> admin123
-- triplet@gmail.com         -> triplet123
-- rizky@gmail.com           -> rizky123
-- dewi@gmail.com            -> dewi123

INSERT INTO jurusan (kode_jurusan, nama_jurusan, kuota, deskripsi) VALUES
('RPL', 'Rekayasa Perangkat Lunak', 36, 'Pengembangan perangkat lunak'),
('TKJ', 'Teknik Komputer dan Jaringan', 36, 'Jaringan komputer'),
('AKL', 'Akuntansi', 36, 'Akuntansi dan keuangan'),
('TBG', 'Tata Boga', 36, 'Kuliner dan pengolahan makanan'),
('TKR', 'Teknik Kendaraan Ringan', 36, 'Perawatan dan perbaikan kendaraan ringan');

INSERT INTO users (nama, email, password, role) VALUES
('Admin PPDB', 'admin@smknusantara.sch.id', '$2y$10$WlM.BQuswx79DKRQGjwP8u.t7oAUCS7/gEZk4EQMdiqBHOxeD4ykq', 'admin'),
('Triple T', 'triplet@gmail.com', '$2y$10$NxtJHg6/sfap/tOfz978fuluUlomiy6n1lWg/a5hUxQjiyR1OBO6S', 'siswa'),
('Rizky Ramadhan', 'rizky@gmail.com', '$2y$10$56PXAMo91aBYOVAmp8F0tOu4uGtiOuP.JTUZfxTcONWinFy5.kiN2', 'siswa'),
('Dewi Lestari', 'dewi@gmail.com', '$2y$10$XmircMEkqSCQhuK7IDUdZunW7E1GEao/6m0GULAhhRWDY4jeNBtfK', 'siswa');

INSERT INTO siswa (id_user, nisn, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, asal_sekolah, no_hp) VALUES
(2, '0098765432', 'Triple T', 'L', 'Surabaya', '2011-05-10', 'Jl. Melati No. 5, Surabaya', 'SMP Negeri 1 Surabaya', '081234567890'),
(3, '0098765433', 'Rizky Ramadhan', 'L', 'Sidoarjo', '2011-08-21', 'Jl. Kenanga No. 12, Sidoarjo', 'SMP Negeri 2 Sidoarjo', '081234567891'),
(4, '0098765434', 'Dewi Lestari', 'P', 'Gresik', '2011-02-14', 'Jl. Mawar No. 3, Gresik', 'MTs Negeri 1 Gresik', '081234567892');

INSERT INTO pendaftaran (id_siswa, id_jurusan, tahun_ajaran, status) VALUES
(1, 1, '2027/2028', 'diterima'),
(2, 3, '2027/2028', 'diverifikasi'),
(3, 1, '2027/2028', 'menunggu');

INSERT INTO berkas (id_pendaftaran, jenis_berkas, nama_file) VALUES
(1, 'kk', 'kk_1_a8f3c2.pdf'),
(1, 'akta', 'akta_1_b71e09.pdf'),
(1, 'rapor', 'rapor_1_c55d14.pdf'),
(1, 'pas_foto', 'foto_1_d02a77.jpg'),
(2, 'kk', 'kk_2_e9b310.pdf'),
(2, 'akta', 'akta_2_f4c628.pdf'),
(2, 'rapor', 'rapor_2_0a7d93.pdf'),
(3, 'kk', 'kk_3_1b6e45.pdf');

INSERT INTO riwayat_status (id_pendaftaran, status_sebelumnya, status_baru, catatan, id_admin) VALUES
(1, 'menunggu', 'diverifikasi', 'Biodata dan dokumen lengkap', 1),
(1, 'diverifikasi', 'diterima', 'Lolos seleksi jurusan RPL', 1),
(2, 'menunggu', 'diverifikasi', 'Dokumen lengkap, pas foto menyusul', 1);
