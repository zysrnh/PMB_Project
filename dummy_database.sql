-- Database Dump Dummy untuk Lokal PMB IAI Persis Bandung
-- Database: `iais9713_pmb`

CREATE DATABASE IF NOT EXISTS `iais9713_pmb`;
USE `iais9713_pmb`;

-- 1. Tabel Setting
CREATE TABLE IF NOT EXISTS `tb_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email_Admin` varchar(255) DEFAULT 'admin@iaipibandung.ac.id',
  `Web_Title` varchar(255) DEFAULT 'PMB IAI Persis Bandung',
  `Url_Situs` varchar(255) DEFAULT 'http://localhost:8000',
  `Meta_Desc` text DEFAULT NULL,
  `Meta_Key` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_setting` (`id`, `Email_Admin`, `Web_Title`, `Url_Situs`, `Meta_Desc`, `Meta_Key`)
VALUES (1, 'pmb@iaipibandung.ac.id', 'Penerimaan Mahasiswa Baru - IAI Persis Bandung', 'http://localhost:8000', 'Penerimaan Mahasiswa Baru IAI Persis Bandung', 'PMB, IAI Persis, Kuliah, Bandung')
ON DUPLICATE KEY UPDATE `Web_Title` = VALUES(`Web_Title`);

-- 2. Tabel Profil Kampus
CREATE TABLE IF NOT EXISTS `mod_data_profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT 'IAI Persis Bandung',
  `alamat` varchar(255) DEFAULT 'Jl. Ciganitri No. 2, Cipagalo, Bojongsoang, Bandung',
  `telp` varchar(50) DEFAULT '(022) 8752-1234',
  `email` varchar(100) DEFAULT 'info@iaipibandung.ac.id',
  `slogan` varchar(255) DEFAULT 'Senin - Jumat: 08.00 - 16.00 WIB',
  `foto` varchar(255) DEFAULT 'logo.png',
  `warnah` varchar(20) DEFAULT '#1b4332',
  `warnaf` varchar(20) DEFAULT '#081c15',
  `warnaf2` varchar(20) DEFAULT '#040d0a',
  `fb` varchar(255) DEFAULT '#',
  `tw` varchar(255) DEFAULT '#',
  `in` varchar(255) DEFAULT '#',
  `tele` varchar(255) DEFAULT '#',
  `wa` varchar(50) DEFAULT '6281234567890',
  `desc` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_data_profil` (`id`, `nama`, `alamat`, `telp`, `email`, `slogan`, `foto`, `warnah`, `warnaf`, `fb`, `tw`, `in`, `tele`, `wa`, `desc`)
VALUES (1, 'PENERIMAAN MAHASISWA BARU IAI PERSIS BANDUNG TAHUN AKADEMIK 2026/2027', 'Jl. Ciganitri No. 2, Bojongsoang, Bandung', '0812-3456-7890', 'pmb@iaipibandung.ac.id', 'Senin - Sabtu: 08.00 - 16.00 WIB', 'logo.png', '#1b4332', '#081c15', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', 'https://t.me', '6281234567890', 'Institut Agama Islam Persis Bandung menyelenggarakan pendidikan tinggi Islam yang unggul, kompetitif, dan berakhlak mulia.')
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`);

-- 3. Tabel Slider
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT 'Penerimaan Mahasiswa Baru',
  `foto` varchar(255) DEFAULT 'slide1.jpg',
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `slider` (`id`, `nama`, `foto`, `keterangan`)
VALUES (1, 'Pendaftaran Mahasiswa Baru', 'banner1.jpg', 'Selamat Datang di Portal PMB IAI Persis Bandung')
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`);

-- 4. Tabel Menu & Submenu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `published` int(1) DEFAULT 1,
  `ordering` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menu` (`id`, `menu`, `url`, `published`, `ordering`) VALUES
(1, 'Beranda', 'index.html', 1, 1),
(2, 'Informasi PMB', 'pages/1/informasi-pmb.html', 1, 2),
(3, 'Alur Pendaftaran', 'pages/2/alur-pendaftaran.html', 1, 3),
(4, 'Program Studi', 'pages/3/program-studi.html', 1, 4),
(5, 'Biaya Kuliah', 'pages/4/biaya-kuliah.html', 1, 5),
(6, 'Kontak Kami', 'hubungi.html', 1, 6)
ON DUPLICATE KEY UPDATE `menu` = VALUES(`menu`);

CREATE TABLE IF NOT EXISTS `submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `published` int(1) DEFAULT 1,
  `ordering` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `submenumenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `published` int(1) DEFAULT 1,
  `ordering` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Footer Menu (menu2 & submenu2)
CREATE TABLE IF NOT EXISTS `menu2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu2` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `published` int(1) DEFAULT 1,
  `ordering` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menu2` (`id`, `menu2`, `url`, `published`, `ordering`) VALUES
(1, 'Link Terkait', '#', 1, 1)
ON DUPLICATE KEY UPDATE `menu2` = VALUES(`menu2`);

CREATE TABLE IF NOT EXISTS `submenu2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `menu2` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `published` int(1) DEFAULT 1,
  `ordering` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `submenu2` (`id`, `parent`, `menu2`, `url`, `published`, `ordering`) VALUES
(1, 1, 'Website Utama IAI Persis', 'https://iaipibandung.ac.id', 1, 1),
(2, 1, 'SIAKAD IAI Persis', 'https://siakad.iaipibandung.ac.id', 1, 2)
ON DUPLICATE KEY UPDATE `menu2` = VALUES(`menu2`);

-- Tabel Warna Tema
CREATE TABLE IF NOT EXISTS `mod_data_warna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT '#1b4332',
  `nama2` varchar(50) DEFAULT '#2d6a4f',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_data_warna` (`id`, `nama`, `nama2`) VALUES (1, '#1b4332', '#2d6a4f')
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`);

-- 5. Tabel Statistik
DROP TABLE IF EXISTS `stat_browse`;
CREATE TABLE IF NOT EXISTS `stat_browse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pjawaban` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `stat_browse` (`id`, `pjawaban`) VALUES
(1, '0#0#0#0#0#0#0#0#0#0'),
(2, '0#0#0#0#0#0#0#0#0#0'),
(3, '0#0#0#0#0#0#0'),
(4, '0#0#0#0#0#0#0#0#0#0#0#0'),
(5, '0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0#0');

-- 6. Tabel Layanan / Menu Utama PMB
CREATE TABLE IF NOT EXISTS `mod_data_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT 'fa-user-plus',
  `warna` varchar(20) DEFAULT '#1b4332',
  `ket` text DEFAULT NULL,
  `link` varchar(255) DEFAULT 'index.php?pilih=pmb&modul=yes',
  `link_text` varchar(50) DEFAULT 'Daftar Sekarang',
  `foto` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_data_layanan` (`id`, `nama`, `icon`, `warna`, `ket`, `link`, `link_text`, `foto`) VALUES
(1, 'Pendaftaran Online', 'fa fa-user-plus', '#1b4332', 'Daftar sebagai calon mahasiswa baru secara online mudah dan cepat.', 'index.php?pilih=pmb&modul=yes', 'Daftar Sekarang', ''),
(2, 'Jalur Beasiswa', 'fa fa-graduation-cap', '#1b4332', 'Tersedia berbagai pilihan jalur beasiswa prestasi dan tahfidz.', 'pages/5/beasiswa.html', 'Lihat Info', ''),
(3, 'Cek Kelulusan', 'fa fa-check-square-o', '#1b4332', 'Cek hasil seleksi ujian masuk penerimaan mahasiswa baru.', 'index.php?pilih=lulus&modul=yes', 'Cek Hasil', ''),
(4, 'Konfirmasi Pembayaran', 'fa fa-credit-card', '#1b4332', 'Unggah bukti transfer pembayaran formulir pendaftaran.', 'index.php?pilih=konfirmasi&modul=yes', 'Konfirmasi', '')
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`);

CREATE TABLE IF NOT EXISTS `mod_data_layanan2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT 'fa-star',
  `warna` varchar(20) DEFAULT '#2d6a4f',
  `ket` text DEFAULT NULL,
  `link` varchar(255) DEFAULT '#',
  `link_text` varchar(50) DEFAULT 'Detail',
  `foto` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Tabel Artikel & Topik
CREATE TABLE IF NOT EXISTS `topik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topik` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `topik` (`id`, `topik`) VALUES (1, 'Berita PMB')
ON DUPLICATE KEY UPDATE `topik` = VALUES(`topik`);

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `user` varchar(50) DEFAULT 'Admin',
  `tgl` date DEFAULT '2026-01-01',
  `gambar` varchar(255) DEFAULT '',
  `publikasi` int(1) DEFAULT 1,
  `topik` int(11) DEFAULT 1,
  `tags` varchar(255) DEFAULT 'PMB',
  `hits` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `artikel` (`id`, `judul`, `konten`, `user`, `tgl`, `gambar`, `publikasi`, `topik`, `tags`, `hits`) VALUES
(1, 'Penerimaan Mahasiswa Baru Tahun Akademik 2026/2027 Resmi Dibuka', 'Institut Agama Islam Persis Bandung resmi membuka pendaftaran mahasiswa baru.', 'Admin', CURDATE(), '', 1, 1, 'PMB, Pendaftaran', 1)
ON DUPLICATE KEY UPDATE `judul` = VALUES(`judul`);

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `tgl` datetime DEFAULT CURRENT_TIMESTAMP,
  `publikasi` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Tabel FAQ
CREATE TABLE IF NOT EXISTS `mod_data_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_data_faq` (`id`, `pertanyaan`, `jawaban`) VALUES
(1, 'Bagaimana cara mendaftar PMB secara online?', 'Klik tombol Daftar Sekarang pada halaman utama, isi data diri dengan lengkap, lalu ikuti panduan pembayaran.'),
(2, 'Apa saja syarat pendaftaran?', 'Scan Ijazah/SKL, scan KK, KTP, dan pas foto terbaru berwarna.')
ON DUPLICATE KEY UPDATE `pertanyaan` = VALUES(`pertanyaan`);

-- 9. Tabel Video & Meta
CREATE TABLE IF NOT EXISTS `mod_data_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT 'Profil IAI Persis Bandung',
  `link` varchar(255) DEFAULT 'https://www.youtube.com/embed/dQw4w9WgXcQ',
  `foto` varchar(255) DEFAULT '',
  `ket` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 12. Tabel Halaman Dinamis (Pages)
CREATE TABLE IF NOT EXISTS `halaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` longtext NOT NULL,
  `foto` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `halaman` (`id`, `judul`, `konten`, `foto`) VALUES
(1, 'Informasi PMB 2026/2027', '<p>Penerimaan Mahasiswa Baru (PMB) IAI Persis Bandung Tahun Akademik 2026/2027 telah dibuka. Pendaftaran dapat dilakukan secara online melalui website ini.</p><p>Persyaratan umum meliputi lulusan SMA/MA/SMK/Sederajat atau Pondok Pesantren.</p>', ''),
(2, 'Alur Pendaftaran PMB', '<ol><li>Membuat akun pendaftaran online</li><li>Mengisi biodata dan memilih program studi</li><li>Membayar biaya pendaftaran formulir</li><li>Mengunggah berkas persyaratan</li><li>Mengikuti ujian seleksi / tes masuk</li><li>Pengumuman kelulusan dan registrasi ulang</li></ol>', ''),
(3, 'Program Studi Pilihan', '<p>Institut Agama Islam Persis Bandung memiliki berbagai Program Studi unggulan:</p><ul><li><strong>S1 Pendidikan Agama Islam (PAI)</strong> - Akreditasi Unggul</li><li><strong>S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)</strong></li><li><strong>S1 Ekonomi Syariah</strong></li><li><strong>S1 Komunikasi dan Penyiaran Islam (KPI)</strong></li><li><strong>S1 Pendidikan Bahasa Arab (PBA)</strong></li></ul>', ''),
(4, 'Rincian Biaya Kuliah', '<p>IAI Persis Bandung menawarkan biaya pendidikan yang terjangkau dengan kemudahan cicilan:</p><table class="table table-bordered"><thead><tr><th>Komponen Biaya</th><th>Nominal</th></tr></thead><tbody><tr><td>Biaya Formulir Pendaftaran</td><td>Rp 250.000</td></tr><tr><td>Infaq Pembangunan (DPP)</td><td>Rp 2.500.000</td></tr><tr><td>SPP per Semester</td><td>Rp 1.800.000</td></tr></tbody></table>', '')
ON DUPLICATE KEY UPDATE `judul` = VALUES(`judul`), `konten` = VALUES(`konten`);

-- 10. Tabel Periode & PMB
CREATE TABLE IF NOT EXISTS `mod_data_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT 'Gelombang 1 (2026/2027)',
  `tgl_buka` date DEFAULT '2026-01-01',
  `tgl_tutup` date DEFAULT '2026-08-31',
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_data_periode` (`id`, `nama`, `tgl_buka`, `tgl_tutup`, `status`)
VALUES (1, 'Gelombang 1 Tahun 2026/2027', '2026-01-01', '2026-08-31', 1)
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`);

CREATE TABLE IF NOT EXISTS `mod_data_bayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(100) DEFAULT 'Bank BSI',
  `norek` varchar(100) DEFAULT '1234567890',
  `atas_nama` varchar(100) DEFAULT 'IAI Persis Bandung',
  `nominal` varchar(50) DEFAULT '250.000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_data_bayar` (`id`, `nama_bank`, `norek`, `atas_nama`, `nominal`)
VALUES (1, 'Bank Syariah Indonesia (BSI)', '7123456789', 'IAI PERSIS BANDUNG', '250000')
ON DUPLICATE KEY UPDATE `nama_bank` = VALUES(`nama_bank`);

-- 11. Tabel Gallery
CREATE TABLE IF NOT EXISTS `mod_gallery_kat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mod_gallery_kat` (`id`, `name`) VALUES
(1, 'Kegiatan Mahasiswa'),
(2, 'Gedung & Fasilitas')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

CREATE TABLE IF NOT EXISTS `mod_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kid` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT '',
  `gambar` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
