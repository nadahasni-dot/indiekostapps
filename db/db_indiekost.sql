-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2020 pada 05.40
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_indiekost`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `nilai_booking` int(11) NOT NULL,
  `bukti_booking` varchar(255) NOT NULL,
  `status_booking` enum('belum dikonfirmasi','sudah dikonfirmasi','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_akses` int(1) NOT NULL,
  `nama_akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id_akses`, `nama_akses`) VALUES
(1, 'Admin'),
(2, 'Penghuni'),
(3, 'Calon Penghuni'),
(4, 'nonaktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_kost`
--

CREATE TABLE `info_kost` (
  `id_kost` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `jenis_kost` enum('Kost Putra','Kost Putri') NOT NULL,
  `nama_kost` varchar(255) NOT NULL,
  `alamat_kost` varchar(255) NOT NULL,
  `provinsi_kost` varchar(255) NOT NULL,
  `kota_kost` varchar(255) NOT NULL,
  `no_kost` varchar(255) NOT NULL,
  `email_kost` varchar(255) NOT NULL,
  `logo_kost` varchar(255) NOT NULL,
  `foto_kost` varchar(255) NOT NULL,
  `deskripsi_kost` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_kost`
--

INSERT INTO `info_kost` (`id_kost`, `id_pengguna`, `jenis_kost`, `nama_kost`, `alamat_kost`, `provinsi_kost`, `kota_kost`, `no_kost`, `email_kost`, `logo_kost`, `foto_kost`, `deskripsi_kost`) VALUES
(1, 7, 'Kost Putri', 'Kost Putri Bidadari', 'Jl Baturaden 10', 'Jawa Timur', 'Jember', '085735678159', 'kostputribidadari@gmail.com', '', '5e1a933f6a2c9.jpeg', 'Kost Putri yang nyaman, aman, bersih, dan modern. Memiliki 2 lantai, dan 30 kamar. Fasilitas oke harga bersahabat. Terletak di daerah yang strategis. Cocok untuk pelajar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pengeluaran`
--

CREATE TABLE `jenis_pengeluaran` (
  `id_jenis_pengeluaran` int(11) NOT NULL,
  `kode_pengeluaran` varchar(255) NOT NULL,
  `kategori_pengeluaran` enum('Biaya Operasional','Biaya Pemeliharaan','Biaya Makanan','Biaya Marketing','Biaya Lainnya','Pajak') NOT NULL,
  `nama_pengeluaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_pengeluaran`
--

INSERT INTO `jenis_pengeluaran` (`id_jenis_pengeluaran`, `kode_pengeluaran`, `kategori_pengeluaran`, `nama_pengeluaran`) VALUES
(1, 'P0001', 'Pajak', 'Pajak Bumi dan Bangunan'),
(2, 'P0002', 'Biaya Operasional', 'Listrik (PLN)'),
(3, 'P0003', 'Biaya Operasional', 'Air (PDAM)'),
(4, 'P0005', 'Biaya Pemeliharaan', 'Kebersihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_status_pembayaran`
--

CREATE TABLE `jenis_status_pembayaran` (
  `id_status` int(11) NOT NULL,
  `nama_status_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_status_pembayaran`
--

INSERT INTO `jenis_status_pembayaran` (`id_status`, `nama_status_pembayaran`) VALUES
(1, 'sudah dikonfirmasi'),
(2, 'belum dikonfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nomor_kamar` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `luas_kamar` varchar(255) NOT NULL,
  `lantai_kamar` enum('1','2','3','4','5','6','7','8') NOT NULL,
  `kapasitas_kamar` int(11) NOT NULL,
  `deskripsi_kamar` varchar(255) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `harga_harian` double NOT NULL,
  `harga_mingguan` double NOT NULL,
  `harga_bulanan` double NOT NULL,
  `harga_tahunan` double NOT NULL,
  `denda` double NOT NULL,
  `foto_kamar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nomor_kamar`, `id_tipe`, `luas_kamar`, `lantai_kamar`, `kapasitas_kamar`, `deskripsi_kamar`, `id_layanan`, `harga_harian`, `harga_mingguan`, `harga_bulanan`, `harga_tahunan`, `denda`, `foto_kamar`) VALUES
(3, 111, 2, '4x4', '1', 1, 'Kamar nomor satu', 2, 10000, 80000, 300000, 360000, 5000, '5e166d07c1269.jpg'),
(4, 2, 1, '4x4', '1', 1, 'Kamar nomor satu', 2, 10000, 70000, 300000, 1200000, 5000, '5e166d1d291b0.jpg'),
(5, 3, 1, '4x4', '1', 1, 'Kamar nomor satu', 2, 10000, 65000, 300000, 330000, 5000, '5e166d28510e6.jpg'),
(6, 4, 1, '4x4', '1', 1, 'Kamar Mandi Dalam, Satu tempat tidur, satu lemari, satu meja, 2 kursi', 2, 10000, 65000, 300000, 330000, 5000, '5e166d36598d9.jpg'),
(7, 5, 1, '4x4', '1', 1, 'Kamar nomor satu', 2, 10000, 65000, 300000, 330000, 5000, '5e166d4179726.jpeg'),
(8, 6, 1, '4x4', '1', 1, 'asdasdasdasdsad', 1, 0, 0, 300000, 0, 5000, '5e192d0d9e4d6.jpg'),
(9, 7, 1, '4x4', '1', 1, 'asdadasdadasadds', 2, 0, 0, 400000, 0, 5000, '5e1a901df0b7d.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `harga_harian` double NOT NULL,
  `harga_mingguan` double NOT NULL,
  `harga_bulanan` double NOT NULL,
  `harga_tahunan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `harga_harian`, `harga_mingguan`, `harga_bulanan`, `harga_tahunan`) VALUES
(1, 'Laundry', 10000, 65000, 30000, 330000),
(2, 'tidak ada layanan', 0, 0, 0, 0),
(3, 'setrika', 0, 0, 20000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lupa_password`
--

CREATE TABLE `lupa_password` (
  `id` int(11) NOT NULL,
  `email_pengguna` varchar(255) NOT NULL,
  `code_lupas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lupa_password`
--

INSERT INTO `lupa_password` (`id`, `email_pengguna`, `code_lupas`) VALUES
(1, 'nadasthing@gmail.com', '15e19541ee4617');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menghuni`
--

CREATE TABLE `menghuni` (
  `id_menghuni` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menghuni`
--

INSERT INTO `menghuni` (`id_menghuni`, `id_kamar`, `id_pengguna`, `tanggal_masuk`, `tanggal_keluar`) VALUES
(7, 3, 14, '2019-12-21', '0000-00-00'),
(8, 4, 15, '2019-12-21', '0000-00-00'),
(9, 5, 16, '2019-12-26', '0000-00-00'),
(12, 6, 20, '2020-01-11', '0000-00-00'),
(13, 7, 22, '2020-01-11', '0000-00-00'),
(15, 8, 23, '2020-01-12', '0000-00-00'),
(16, 9, 24, '2020-01-12', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_menghuni` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `nilai_pembayaran` double NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_menghuni`, `tanggal_pembayaran`, `nilai_pembayaran`, `bukti_pembayaran`, `keterangan`, `id_status`) VALUES
(12, 7, '2019-12-21', 200000, '5e186903a45dc.jpg', 'asdsadasdasd', 2),
(13, 8, '2019-11-13', 400000, '', 'jjsiiqjjqwkewq', 1),
(15, 7, '2019-10-16', 300000, '', 'qwewqeqw', 1),
(16, 7, '2020-01-05', 300000, '', 'sudah bayar dos', 1),
(17, 8, '2020-01-01', 600000, '5e18691e0128e.jpg', 'baru bayar tahun baruan', 2),
(19, 8, '2020-01-04', 500000, '5e1853b0c7fc1.jpg', 'Bayar euy', 1),
(20, 8, '2020-01-10', 400000, '5e1853da38082.jpg', 'bayar Lagi skuy', 1),
(23, 12, '2020-01-11', 300000, '5e196c21806bc.jpg', 'Pembayaran Booking kamar no.4 tanggal: 2020-01-11', 1),
(25, 9, '2020-01-11', 300000, '5e19c630d449a.jpg', 'Pembayaran kamar 3. Oleh Jony Januari 2020', 1),
(26, 13, '2020-01-11', 300000, '5e19cf5a8efe2.jpg', 'Pembayaran Booking kamar no.5 tanggal: 2020-01-11', 1),
(28, 15, '2020-01-12', 330000, '5e1a8fa039c64.jpg', 'Pembayaran Booking kamar no.6 tanggal: 2020-01-12', 1),
(29, 16, '2020-01-12', 400000, '5e1a988099e58.jpg', 'Pembayaran Booking kamar no.7 tanggal: 2020-01-12', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_jenis_pengeluaran` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `nilai_pengeluaran` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `bukti_pengeluaran` varchar(255) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_jenis_pengeluaran`, `tanggal_pengeluaran`, `nilai_pengeluaran`, `keterangan`, `bukti_pengeluaran`, `id_pengguna`) VALUES
(1, 1, '2019-12-13', 200000, 'Pembayaran pajak PBB', '5e18485b06634.jpg', 7),
(3, 3, '2020-01-09', 120000, 'Pembayaran AIR januari 2020', '5e18484f73d87.jpg', 7),
(4, 1, '2020-01-10', 200000, 'Bayar Pajak Gaes', '5e184877dab47.jpg', 7),
(5, 2, '2020-10-12', 300000, 'bayar pajak', '5e1a9b477ab06.jpg', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `alamat_pengguna` varchar(255) DEFAULT NULL,
  `provinsi_pengguna` varchar(255) DEFAULT NULL,
  `kota_pengguna` varchar(255) DEFAULT NULL,
  `telepon_pengguna` varchar(255) NOT NULL,
  `email_pengguna` varchar(255) NOT NULL,
  `kelamin_pengguna` enum('Pria','Wanita') DEFAULT NULL,
  `tanggal_lahir_pengguna` date DEFAULT NULL,
  `no_ktp_pengguna` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_akses` int(1) NOT NULL,
  `foto_pengguna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `alamat_pengguna`, `provinsi_pengguna`, `kota_pengguna`, `telepon_pengguna`, `email_pengguna`, `kelamin_pengguna`, `tanggal_lahir_pengguna`, `no_ktp_pengguna`, `password`, `id_akses`, `foto_pengguna`) VALUES
(7, 'Abdul Jali', 'Jl Baturaden Gg 10 No. 7', 'Jawa Timur', 'Jember', '082335783552', 'nadasthing@gmail.com', 'Pria', '1999-12-15', '000988166627120913', '$2y$10$/zKXUB/5gVTDq6UaR8FiEeGgSGT/xPtpAOb.ebQqCCmtEkeiw72am', 1, '5e1a943eeae2e.jpg'),
(14, 'Mamank Garox', 'Jl Jalan skuy', 'Jawa TImur', 'Jember', '08123456789', 'epriot23@gmail.com', 'Wanita', '2019-12-21', '2991001876178721', '1234', 2, '5e15a93bb371b.jpg'),
(15, 'RIcardo Milos', 'Jl Banjarsengon', 'Jawa Timur', 'Jember', '08322144718', 'royhanalghazy@gmail.com', 'Pria', '1999-04-08', '299100188123', '321441', 2, '5e15b0ac5724d.jpg'),
(16, 'Jony', 'Jl maroko', 'Jawa Barat', 'Bandung', '08123456789', 'jonyjona@gmail.com', 'Pria', '2000-12-06', '1233443211233212', '$2y$10$/zKXUB/5gVTDq6UaR8FiEeGgSGT/xPtpAOb.ebQqCCmtEkeiw72am', 2, ''),
(17, 'Alip', 'Jl. Diponegoro VII 73', 'Jawa Timur', 'Jember', '085735678159', 'alip@gmail.com', 'Pria', '2020-01-15', '3509191412990213213', '$2y$10$L3m4Gu/u8QWz4A/9Y6EU7e1BWEx4/LfI75g2qeh2ztzmT8hqv9VTm', 2, '5e16c17bb55fa.jpg'),
(18, 'Akun Test', '', '', '', '1234566', 'test@gmail.com', 'Pria', '0000-00-00', '', '$2y$10$NirDbzOkmkNjSrMkaWiN..pMC4NLpJ6h2WbUA9VIlV/Po0uijsgVi', 2, ''),
(19, 'Siti Maemunah', '', '', '', '0856722458819', 'sitimaemun@gmail.com', 'Pria', '0000-00-00', '', '$2y$10$RsLYh4vjOYpjLZFJ1RWm..F793eN9kwbl/XNDJdTIqEFce8USNoQe', 3, ''),
(20, 'Devina Kurniawati S', 'Jl. Patimura No. 89', 'Jawa Timur', 'Banyuwangi', '089677827716', 'devina@gmail.com', 'Wanita', '1999-05-14', '3509191412992321', '$2y$10$QEZHdQk.U0OGKvidR4he9e/mR2hXOKun6a8FkdlEWFJYHZrj5WYPi', 2, '5e1936fa16a27.jpg'),
(21, 'asdas', NULL, NULL, NULL, '12321321', 'admin@indiekost.com', NULL, NULL, NULL, '$2y$10$41IrPu69caH8C6IriO5WkOg7wWPe4QwnEszubCnYaG1YHmF9UgfE.', 3, NULL),
(22, 'siti', 'Jl Jakarta Raya 88', 'Jawa Timur', 'Jember', '085735678159', 'siti@gmail.com', 'Wanita', '2020-01-10', '12312321312', '$2y$10$uqtbquIB9pedSERlVwcbI.23OuDI8h9t4R6s1.NsiiGS3MXNGqMAq', 2, '5e19cf3d77a31.jpg'),
(23, 'Meisa', 'Jl. Patimura No. 89', 'Jawa Timur', 'Jember', '12392388213', 'meisa@gmail.com', 'Wanita', '2020-01-12', '3509191412990007', '$2y$10$ZmlZ/KokAtfu2SYTxJRAzOLuxbjVMaeu3495sHZHyCJ.jcXt23G9C', 2, '5e1a8e671f1aa.jpg'),
(24, 'ruryana', 'Jl Kalisat 99', 'Jawa Timur', 'Jember', '085735678159', 'ruryagista@gmail.com', 'Wanita', '2020-01-22', '3509191412990007', '$2y$10$cIpDtuNguYInu8qQHNkLrOYrASxT2C9UDmA1K0GzxwXwW2ftSba4q', 2, '5e1a980ac4324.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe`, `nama_tipe`) VALUES
(1, 'reguler'),
(2, 'vip'),
(3, 'biasa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_kamar_2` (`id_kamar`,`id_pengguna`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `info_kost`
--
ALTER TABLE `info_kost`
  ADD PRIMARY KEY (`id_kost`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `jenis_pengeluaran`
--
ALTER TABLE `jenis_pengeluaran`
  ADD PRIMARY KEY (`id_jenis_pengeluaran`);

--
-- Indeks untuk tabel `jenis_status_pembayaran`
--
ALTER TABLE `jenis_status_pembayaran`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_tipe` (`id_tipe`,`id_layanan`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `lupa_password`
--
ALTER TABLE `lupa_password`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menghuni`
--
ALTER TABLE `menghuni`
  ADD PRIMARY KEY (`id_menghuni`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_menghuni` (`id_menghuni`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_jenis_pengeluaran` (`id_jenis_pengeluaran`,`id_pengguna`),
  ADD KEY `pengeluaran_ibfk_2` (`id_pengguna`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_akses` (`id_akses`);

--
-- Indeks untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_akses` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `info_kost`
--
ALTER TABLE `info_kost`
  MODIFY `id_kost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jenis_pengeluaran`
--
ALTER TABLE `jenis_pengeluaran`
  MODIFY `id_jenis_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_status_pembayaran`
--
ALTER TABLE `jenis_status_pembayaran`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lupa_password`
--
ALTER TABLE `lupa_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menghuni`
--
ALTER TABLE `menghuni`
  MODIFY `id_menghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `info_kost`
--
ALTER TABLE `info_kost`
  ADD CONSTRAINT `info_kost_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_2` FOREIGN KEY (`id_tipe`) REFERENCES `tipe_kamar` (`id_tipe`),
  ADD CONSTRAINT `kamar_ibfk_4` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`);

--
-- Ketidakleluasaan untuk tabel `menghuni`
--
ALTER TABLE `menghuni`
  ADD CONSTRAINT `menghuni_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menghuni_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_menghuni`) REFERENCES `menghuni` (`id_menghuni`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `jenis_status_pembayaran` (`id_status`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_jenis_pengeluaran`) REFERENCES `jenis_pengeluaran` (`id_jenis_pengeluaran`),
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `hak_akses` (`id_akses`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
