-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql110.epizy.com
-- Waktu pembuatan: 22 Jun 2020 pada 08.32
-- Versi server: 5.6.47-87.0
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_26072694_elearning`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailtugas`
--

CREATE TABLE `detailtugas` (
  `id_detail_tugas` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL,
  `tanggal_upload` datetime NOT NULL,
  `nrp` varchar(30) NOT NULL,
  `id_tugas` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detailtugas`
--

INSERT INTO `detailtugas` (`id_detail_tugas`, `nama_file`, `catatan`, `nilai`, `path`, `tanggal_upload`, `nrp`, `id_tugas`) VALUES
(7, '2110191007_1_Feri Afrianto', 'Pra 5', 100, 'assets/file/2110191007_1_Feri Afrianto.pdf', '2020-06-20 07:33:32', '2110191007', 1),
(8, '2110191008_1_Ahmad Ilham Santosa', 'Prak 7\r\n', 80, 'assets/file/2110191008_1_Ahmad Ilham Santosa.pdf', '2020-06-20 07:34:24', '2110191008', 1),
(9, '2110191007_2_Feri Afrianto', 'Maaf bu saya Upload Ulang untuk Tugasnya ternyata saya salah Upload Filenya', 0, 'assets/file/2110191007_2_Feri Afrianto.pdf', '2020-06-21 16:32:09', '2110191007', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `jenis_kelamin`, `tgl_lahir`, `telepon`, `alamat`) VALUES
('20200701001', 'Tessy Badriyah', 'Perempuan', '1980-04-14', '089786567678', 'Gubeng, Surabaya'),
('20200701002', 'Umi Sa\'adah', 'Perempuan', '1985-04-14', '0878787878', 'Keputih,Surabaya'),
('20200701003', 'Kholid Fathoni', 'Laki-Laki', '1978-06-12', '0867676766', 'Rungkut,Surabaya'),
('20200701004', 'Tri Hadiah Muliawati', 'Perempuan', '1990-06-03', '0898787877', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(50) NOT NULL,
  `kd_kelas` int(50) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kd_kelas`, `nama_kelas`) VALUES
(3, 100401, '1 D4 IT A'),
(4, 100402, '1 D4 IT B'),
(5, 100403, '1 D3 IT A'),
(6, 100404, '1 D3 IT B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nrp` int(30) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `kd_kelas` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `nama`, `tgl_lahir`, `alamat`, `telepon`, `kd_kelas`) VALUES
(2110191007, 'Feri Afrianto', '2001-04-14', 'Tulungagung', '085853520984', 100401),
(2110191008, 'Ahmad Ilham Santosa', '2020-06-19', 'Pasuruan', '08767676', 100401),
(2110191042, 'Fachmi Dimas Ardhana', '2001-04-13', 'Sidoarjo', '089787878787', 100402);

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id_matkul` int(11) NOT NULL,
  `kd_matkul` varchar(255) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `id_kelas` int(50) NOT NULL,
  `nip_dosen` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`id_matkul`, `kd_matkul`, `nama_matkul`, `id_kelas`, `nip_dosen`) VALUES
(1, 'IF042001', 'Praktikum Algoritma dan Struktur Data', 100401, '20200701001'),
(2, 'IF042002', 'Basis Data ', 100401, '20200701002'),
(3, 'IF042003', 'Pemrograman Web', 100401, '20200701003'),
(4, 'IF042004', 'Metode Numerik', 100402, '20200701001'),
(5, 'IF042005', 'Agama', 100402, '20200701003'),
(6, 'IF042006', 'Algoritma dan Struktur Data', 100402, '20200701004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `judul_tugas` varchar(255) NOT NULL,
  `deskripsi_tugas` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `id_matkul` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `judul_tugas`, `deskripsi_tugas`, `tanggal`, `id_matkul`) VALUES
(1, 'Ilustrasi Insertion  dan Program', 'Kumpulkan Laporan nya dalam Bentuk PDF', '2020-06-28 07:45:00', 1),
(2, 'Prak 13: Searching', 'Binary dan Sequential Search Jadi 1', '2020-06-27 05:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, '2110191007', 'feri', 'mahasiswa'),
(2, '2110191008', 'ilham', 'mahasiswa'),
(3, '20200701001', 'butessy', 'dosen'),
(4, '20200701002', 'buumi', 'dosen'),
(5, '20200701003', 'kholid', 'dosen'),
(6, '2110191042', 'fahmi', 'mahasiswa'),
(7, '20200701004', 'leli', 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailtugas`
--
ALTER TABLE `detailtugas`
  ADD PRIMARY KEY (`id_detail_tugas`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nrp`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detailtugas`
--
ALTER TABLE `detailtugas`
  MODIFY `id_detail_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
