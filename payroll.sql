-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 Jan 2019 pada 08.59
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ampas`
--

CREATE TABLE `ampas` (
  `bulanPengambilan` date NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `tunggal` int(11) NOT NULL,
  `tunggalPlus` int(11) NOT NULL,
  `ganda` int(11) NOT NULL,
  `gandaPlus` int(11) NOT NULL,
  `tonase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ampas`
--

INSERT INTO `ampas` (`bulanPengambilan`, `idPegawai`, `tunggal`, `tunggalPlus`, `ganda`, `gandaPlus`, `tonase`) VALUES
('2018-12-00', 11, 0, 20, 0, 11, 1014),
('2018-12-00', 12, 0, 20, 0, 11, 1014),
('2018-11-00', 11, 1, 19, 0, 11, 945),
('2018-11-00', 12, 1, 19, 0, 11, 945),
('2019-01-00', 11, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bonus`
--

CREATE TABLE `bonus` (
  `idPegawai` int(11) NOT NULL,
  `bulanBonus` date NOT NULL,
  `ketBonus` varchar(50) NOT NULL,
  `jumlahBonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bonus`
--

INSERT INTO `bonus` (`idPegawai`, `bulanBonus`, `ketBonus`, `jumlahBonus`) VALUES
(12, '2018-12-30', 'kedisiplinan', 155000),
(12, '2018-12-30', 'usaha', 235000),
(11, '2018-12-30', 'kedisiplinan', 155000),
(11, '2018-12-30', 'tugas lain', 600000),
(11, '2018-12-30', 'usaha ampas', 355000),
(2, '2018-12-30', 'Susu Keluar', 108000),
(2, '2018-12-30', 'rawat + jual pedet', 200000),
(9, '2018-11-30', 'rawat + jual pedet', 175000),
(1, '2018-11-30', 'Susu Keluar', 130000),
(1, '2018-11-30', 'rawat + jual pedet', 200000),
(12, '2018-11-30', 'usaha ampas', 164000),
(12, '2018-11-30', 'kedisiplinan', 150000),
(12, '2018-11-30', 'Nabung', -500000),
(1, '2018-11-30', 'Nabung', -30000),
(10, '2018-11-30', 'rawat + jual pedet', 175000),
(4, '2018-11-30', 'Susu Keluar', 31000),
(4, '2018-11-30', 'jual pedet', 200000),
(13, '2018-11-30', 'Susu Keluar', 90000),
(13, '2018-11-30', 'usaha', 65000),
(13, '2018-11-30', 'bunting 5 ekor', 50000),
(13, '2018-11-30', '1x ngampas', 50000),
(2, '2018-11-30', 'Susu Keluar', 130000),
(2, '2018-11-30', 'rawat + jual pedet', 200000),
(2, '2018-11-30', 'bantu listrik', 30000),
(8, '2018-11-30', 'Populasi dan jual pe', 205000),
(3, '2018-11-30', 'Susu Keluar', 6500),
(3, '2018-11-30', '> populasi', 400000),
(3, '2018-11-30', 'jual pedet & pen. P.', 273000),
(11, '2018-11-30', 'tugas lain', 600000),
(11, '2018-11-30', 'kedisiplinan', 150000),
(11, '2018-11-30', 'usaha', 245000),
(6, '2018-11-30', 'Populasi+jual pedet', 269000),
(7, '2018-11-15', 'Populasi dan jual pedet', 245000),
(15, '2018-11-22', 'jual pedet', 70000),
(7, '2018-11-22', 'Susu Keluar', 5900),
(1, '2018-12-31', 'Susu Keluar', 108000),
(1, '2018-12-11', 'rawat dan jual pedet', 200000),
(1, '2018-12-31', 'Nabung', -10000),
(2, '2018-12-05', 'bantu listrik', 30000),
(3, '2018-12-31', 'Susu Keluar', 11000),
(3, '2018-12-31', 'populasi lebih', 440000),
(4, '2018-12-31', 'bonus ayah', -100000),
(4, '2018-12-31', 'Susu Keluar', 5000),
(15, '2018-12-31', 'usaha', 100000),
(6, '2018-12-31', 'Susu Keluar', 5000),
(6, '2018-12-31', 'lebih populasi', 120000),
(7, '2018-12-31', 'Susu Keluar', 11000),
(7, '2018-12-31', 'lebih populasi', 160000),
(8, '2018-12-31', 'Susu Keluar', 4000),
(8, '2018-12-31', 'lebih populasi', 40000),
(9, '2018-12-12', 'Rawat pedet', 100000),
(10, '2018-12-31', 'Susu Keluar', 4000),
(10, '2018-12-16', 'Rawat pedet', 100000),
(13, '2018-12-31', 'usaha', 65000),
(13, '2018-12-31', 'Susu Keluar', 90000),
(13, '2018-12-19', 'yunus absen', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `idPegawai` int(11) NOT NULL,
  `tanggalGaji` date NOT NULL,
  `totalHutang` int(11) NOT NULL,
  `totalGaji` int(11) NOT NULL,
  `flag` enum('1','0','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`idPegawai`, `tanggalGaji`, `totalHutang`, `totalGaji`, `flag`) VALUES
(1, '2018-11-00', 0, 2250000, '1'),
(2, '2018-11-00', 1900000, 835000, '1'),
(3, '2018-11-00', 250000, 1885000, '1'),
(4, '2018-11-00', 1100000, 1230000, '1'),
(6, '2018-11-00', 1600000, 730000, '1'),
(7, '2018-11-00', 1200000, 225000, '1'),
(8, '2018-11-00', 500000, 1090000, '1'),
(9, '2018-11-00', 200000, 1115000, '1'),
(10, '2018-11-00', 250000, 985000, '1'),
(11, '2018-11-00', 0, 3230000, '1'),
(12, '2018-11-00', 700000, 955000, '1'),
(13, '2018-11-00', 250000, 3465000, '1'),
(15, '2018-11-00', 450000, 420000, '1'),
(1, '2018-12-00', 0, 2245000, '1'),
(2, '2018-12-00', 1900000, 900000, '1'),
(3, '2018-12-00', 0, 1885000, '1'),
(4, '2018-12-00', 1930000, 0, '0'),
(6, '2018-12-00', 2130000, 105000, '1'),
(7, '2018-12-00', 580000, 845000, '1'),
(8, '2018-12-00', 1295000, 160000, '1'),
(9, '2018-12-00', 0, 1240000, '1'),
(10, '2018-12-00', 0, 1260000, '1'),
(11, '2018-12-00', 0, 3370000, '1'),
(12, '2018-12-00', 0, 2260000, '1'),
(13, '2018-12-00', 0, 4025000, '1'),
(15, '2018-12-00', 0, 800000, '0'),
(4, '2018-12-00', 1930000, 0, '0'),
(4, '2018-12-00', 1930000, 0, '1'),
(15, '2018-12-00', 1020000, 0, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `namaItem` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `tipe` enum('sistem','pemasukan','pengeluaran','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`namaItem`, `harga`, `tipe`) VALUES
('pasar lebih', 2500, 'sistem'),
('tonase', 500, 'sistem'),
('Susu Amal', 6500, 'pemasukan'),
('Susu KPS', 5250, 'pemasukan'),
('Susu Arman', 6500, 'pemasukan'),
('Susu Fahri', 6500, 'pemasukan'),
('Ampas', 15000, 'pengeluaran'),
('Pasar', 5000, 'pengeluaran'),
('Susu Ali', 6500, 'pemasukan'),
('OP Ku + Pak Mamad', 850000, 'pengeluaran'),
('OP Mul', 475000, 'pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `tanggalHutang` date NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `jumlahHutang` int(11) NOT NULL,
  `sisaHutang` int(11) NOT NULL,
  `tanggalLunas` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`tanggalHutang`, `idPegawai`, `jumlahHutang`, `sisaHutang`, `tanggalLunas`) VALUES
('2018-11-09', 9, 200000, 0, '2018-11-00'),
('2018-11-13', 3, 250000, 0, '2018-11-00'),
('2018-11-17', 15, 450000, 0, '2018-11-00'),
('2018-11-24', 10, 250000, 0, '2018-11-00'),
('2018-11-16', 12, 700000, 0, '2018-11-00'),
('2018-11-13', 7, 600000, 0, '2018-11-00'),
('2018-11-17', 4, 1100000, 0, '2018-11-00'),
('2018-11-15', 2, 1900000, 0, '2018-11-00'),
('2018-11-15', 6, 1600000, 0, '2018-11-00'),
('2018-11-06', 13, 250000, 0, '2018-11-00'),
('2018-11-15', 8, 500000, 0, '2018-11-00'),
('2018-11-10', 7, 600000, 0, '2018-11-00'),
('2018-12-16', 2, 1900000, 0, '2018-12-00'),
('2018-12-15', 4, 1930000, 0, '2018-12-00'),
('2018-12-17', 15, 1020000, 0, '2018-12-00'),
('2018-12-16', 6, 2130000, 0, '2018-12-00'),
('2018-12-19', 7, 580000, 0, '2018-12-00'),
('2018-12-19', 8, 1295000, 0, '2018-12-00'),
('2018-01-00', 4, 180000, 180000, '0000-00-00'),
('2018-01-00', 15, 120000, 120000, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandang`
--

CREATE TABLE `kandang` (
  `idKandang` int(11) NOT NULL,
  `namaKandang` varchar(20) NOT NULL,
  `lokasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kandang`
--

INSERT INTO `kandang` (`idKandang`, `namaKandang`, `lokasi`) VALUES
(1, 'Bu Nunung', 'Kunak 2 Kav. 136 Rt 003/012 Situ udik, Cibungbulang, Kabupaten Bogor.'),
(2, 'Pak Hamid', 'Kunak 2 Kav. 148 Rt 003/012 Situ udik, Cibungbulang, Kabupaten Bogor.'),
(3, 'Ali', 'Kunak 1 kav. 66 Pasarean, Pamijahan, Kabupaten Bogor.'),
(4, 'Dedi', 'Kunak 1 Kav. 78 Pasarean, Pamijahan, Kabupaten Bogor'),
(5, 'Didin', 'Kunak 1 Kav. 76 Pasarean, Pamijahan, Kabupaten Bogor'),
(6, 'Basri', 'Kunak 1 Kav. 84 Pasarean, Pamijahan, Kabupaten Bogor'),
(7, 'Machdum', 'Kunak 2 kav. 144 Pemijahan, Pamijahan, Kabupaten Bogor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuntungan`
--

CREATE TABLE `keuntungan` (
  `keuntunganTanggal` date NOT NULL,
  `idKandang` int(11) NOT NULL,
  `totalKeuntungan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keuntungan`
--

INSERT INTO `keuntungan` (`keuntunganTanggal`, `idKandang`, `totalKeuntungan`) VALUES
('2018-11-00', 1, 18690600),
('2018-11-00', 2, 5020850),
('2018-11-00', 3, 17313300),
('2018-11-00', 4, 6485400),
('2018-11-00', 5, 2464700),
('2018-11-00', 6, 2288900),
('2018-11-00', 7, 527800),
('2018-12-00', 1, 18574250),
('2018-12-00', 2, 4593750),
('2018-12-00', 3, 12211375),
('2018-12-00', 4, 7472750),
('2018-12-00', 5, 4024500),
('2018-12-00', 6, 2763500),
('2018-12-00', 7, 2491750);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `idPegawai` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namaPegawai` varchar(40) NOT NULL,
  `tahunMasuk` date NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `bonusBeras` int(11) NOT NULL,
  `bonusMasaKerja` int(11) NOT NULL,
  `tipePegawai` enum('Kandang','Ampas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`idPegawai`, `username`, `password`, `namaPegawai`, `tahunMasuk`, `telepon`, `bonusBeras`, `bonusMasaKerja`, `tipePegawai`) VALUES
(1, 'nunung', 'nunung', 'Bu Nunung', '2000-00-00', '85890386575', 30, 180000, 'Kandang'),
(2, 'tewin', 'tewin', 'Mas Tewin', '2012-00-00', '085779443659', 30, 60000, 'Kandang'),
(3, 'hamid', 'hamid', 'Pak Hamid', '2018-00-00', '085765444445', 30, 0, 'Kandang'),
(4, 'ali', 'ali', 'Mas Ali', '2015-00-00', '085647899887', 30, 30000, 'Kandang'),
(6, 'dedy', 'dedy', 'Mas Dedy', '2007-00-00', '081945612340', 30, 110000, 'Kandang'),
(7, 'didin', 'didin', 'Dik Didin', '2018-00-00', '089778778787', 20, 0, 'Kandang'),
(8, 'basri', 'basri', 'Pak Basri', '2016-00-00', '081223886545', 30, 20000, 'Kandang'),
(9, 'maryah', 'maryah', 'Bu Maryah', '2014-00-00', '085641238123', 30, 40000, 'Kandang'),
(10, 'machdum', 'machdum', 'Dik Machdum', '2015-00-00', '085699835472', 20, 30000, 'Kandang'),
(11, 'sahdad', 'sahdad', 'Om Sahdad', '2009-00-00', '085674334321', 30, 90000, 'Ampas'),
(12, 'ari', 'ari', 'Dik Ari', '2017-00-00', '085611128656', 20, 10000, 'Ampas'),
(13, 'mulyana', 'mulyana', 'Mas Mulyana', '2001-00-00', '081567843256', 30, 170000, 'Kandang'),
(15, 'sahri', 'sahri', 'Pak Sahri', '2018-00-00', '085678783265', 20, 0, 'Kandang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawaiampas`
--

CREATE TABLE `pegawaiampas` (
  `idPegawai` int(11) NOT NULL,
  `tunggal` int(11) NOT NULL,
  `tunggalPlus` int(11) NOT NULL,
  `ganda` int(11) NOT NULL,
  `gandaPlus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawaiampas`
--

INSERT INTO `pegawaiampas` (`idPegawai`, `tunggal`, `tunggalPlus`, `ganda`, `gandaPlus`) VALUES
(11, 50000, 60000, 55000, 65000),
(12, 35000, 50000, 40000, 55000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawaikandang`
--

CREATE TABLE `pegawaikandang` (
  `idPegawai` int(11) NOT NULL,
  `idKandang` int(11) DEFAULT NULL,
  `gajiPokok` int(11) NOT NULL,
  `bonusKeluarga` int(11) NOT NULL,
  `bonusUsaha` enum('ya','tidak','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawaikandang`
--

INSERT INTO `pegawaikandang` (`idPegawai`, `idKandang`, `gajiPokok`, `bonusKeluarga`, `bonusUsaha`) VALUES
(1, 1, 1300000, 0, 'ya'),
(2, 1, 1150000, 275000, 'ya'),
(3, 2, 1200000, 0, 'ya'),
(4, 3, 1050000, 150000, 'ya'),
(6, 4, 1350000, 275000, 'ya'),
(7, 5, 1050000, 0, 'ya'),
(9, 7, 1100000, 0, 'tidak'),
(10, 7, 1000000, 0, 'ya'),
(8, 6, 1000000, 250000, 'ya'),
(13, 1, 1500000, 300000, 'tidak'),
(15, 3, 800000, 0, 'tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `idKandang` int(11) NOT NULL,
  `tanggalMasuk` date NOT NULL,
  `jenisPemasukan` varchar(50) NOT NULL,
  `jumlahPemasukan` int(11) NOT NULL,
  `tipePemasukan` enum('rutin','nonrutin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`idKandang`, `tanggalMasuk`, `jenisPemasukan`, `jumlahPemasukan`, `tipePemasukan`) VALUES
(1, '2018-11-01', 'Jual anak \"Gemes\"', 5850000, 'nonrutin'),
(1, '2018-11-01', 'Jual anak \"Susi\"', 3950000, 'nonrutin'),
(1, '2018-11-30', 'Jual anak \"Dolar\"', 4400000, 'nonrutin'),
(1, '2018-11-30', 'Susu Amal - 3132', 20358000, 'rutin'),
(1, '2018-11-30', 'susu KPS', 18481100, 'rutin'),
(1, '2018-11-30', 'Sulang - 563', 3778500, 'rutin'),
(1, '2018-11-30', 'Susu Arman - 240', 1560000, 'rutin'),
(2, '2018-11-19', 'Jual anak Madinah', 3500000, 'nonrutin'),
(2, '2018-11-30', 'Susu Amal - 65', 422500, 'rutin'),
(2, '2018-11-30', 'susu KPS', 19713350, 'rutin'),
(3, '2018-11-01', 'Jual anak Rina', 5250000, 'nonrutin'),
(3, '2018-11-01', 'Jual anak rosana', 3450000, 'nonrutin'),
(3, '2018-11-01', 'Jual anak ayu', 2100000, 'nonrutin'),
(3, '2018-11-27', 'susu KPS', 32123300, 'rutin'),
(3, '2018-11-27', 'Susu Fahri', 2015000, 'rutin'),
(4, '2018-11-01', 'Jual anak bayem', 2450000, 'nonrutin'),
(4, '2018-11-01', 'Jual anak bayun', 3500000, 'nonrutin'),
(4, '2018-11-30', 'susu KPS', 19970400, 'rutin'),
(5, '2018-11-01', 'Jual anak delima', 2450000, 'nonrutin'),
(5, '2018-11-01', 'Jual anak geboy', 3300000, 'nonrutin'),
(5, '2018-11-30', 'Sulang - 59', 413000, 'rutin'),
(5, '2018-11-30', 'susu KPS', 14781700, 'rutin'),
(6, '2018-11-30', 'jual anak lia', 2000000, 'nonrutin'),
(6, '2018-11-30', 'jual anak geulis', 3000000, 'nonrutin'),
(6, '2018-11-30', 'susu KPS', 15173900, 'rutin'),
(7, '2018-11-03', 'jual anak indah', 3950000, 'nonrutin'),
(7, '2018-11-01', 'jual anak tujuh', 2950000, 'nonrutin'),
(7, '2018-11-30', 'jual anak nur', 4000000, 'nonrutin'),
(7, '2018-11-30', 'susu KPS - 2706', 14341800, 'rutin'),
(1, '2018-12-14', 'jual anak manis', 8500000, 'nonrutin'),
(1, '2018-12-14', 'jual anak satu', 10500000, 'nonrutin'),
(1, '2018-12-30', 'Susu keluar - 250', 1625000, 'rutin'),
(1, '2018-12-30', 'susu KPS - 4307x5250', 22611750, 'rutin'),
(1, '2018-12-30', 'Susu Ali - 60', 390000, 'rutin'),
(1, '2018-12-30', 'Susu amal  - 2915', 18947500, 'rutin'),
(2, '2018-12-25', 'susu KPS - 5250x3611', 18957750, 'rutin'),
(2, '2018-12-25', 'Susu Ali - 40', 260000, 'rutin'),
(2, '2018-12-25', 'Susu Amal - 70', 455000, 'rutin'),
(3, '2018-12-25', 'susu KPS - 5250x5701.5', 29932875, 'rutin'),
(3, '2018-12-25', 'Susu Ali - 45', 292500, 'rutin'),
(2, '2018-11-30', 'penelitian Pak Jur', 6000000, 'nonrutin'),
(4, '2018-12-05', 'susu KPS - 3921', 20585250, 'rutin'),
(4, '2018-12-05', 'susu Ali - 45', 292500, 'rutin'),
(5, '2018-12-25', 'Susu keluar - 434', 434000, 'rutin'),
(5, '2018-12-25', 'susu KPS - 2982', 15655500, 'rutin'),
(5, '2018-12-25', 'Susu Ali - 40', 260000, 'rutin'),
(6, '2018-12-25', 'susu KPS - 3018', 15844500, 'rutin'),
(6, '2018-12-25', 'Susu Ali - 40', 260000, 'rutin'),
(7, '2018-12-13', 'jual bunga', 9500000, 'nonrutin'),
(7, '2018-12-25', 'susu KPS - 3191', 16752750, 'rutin'),
(7, '2018-12-25', 'susu Ali', 260000, 'rutin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `idKandang` int(11) NOT NULL,
  `tanggalKeluar` date NOT NULL,
  `jenisPengeluaran` varchar(50) NOT NULL,
  `jumlahPengeluaran` int(11) NOT NULL,
  `tipePengeluaran` enum('rutin','nonrutin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`idKandang`, `tanggalKeluar`, `jenisPengeluaran`, `jumlahPengeluaran`, `tipePengeluaran`) VALUES
(1, '2018-11-03', 'Gaji Ust. Aang', 1170000, 'rutin'),
(1, '2018-11-03', 'operasionalku + pak mamad', 850000, 'rutin'),
(1, '2018-11-04', 'tewin CB 1,2Jt + 300', 20000, 'rutin'),
(1, '2018-11-07', 'bonus bulan & dolar P', 225000, 'rutin'),
(1, '2018-11-08', 'listrik', 75000, 'rutin'),
(1, '2018-11-15', 'obat subur', 100000, 'rutin'),
(1, '2018-11-28', 'bonus bintang + berkah', 40000, 'rutin'),
(1, '2018-11-30', 'jual anak dolar', 75000, 'rutin'),
(1, '2018-11-30', 'Ampas - 532', 7980000, 'rutin'),
(1, '2018-11-30', 'Konsentrat', 6011000, 'rutin'),
(1, '2018-11-30', 'Obat KPS + potongan', 700000, 'rutin'),
(1, '2018-11-30', 'Pasar - 582', 2910000, 'rutin'),
(1, '2018-11-30', 'OP Mul', 421000, 'rutin'),
(1, '2018-11-30', 'pulsa+plastik', 390000, 'rutin'),
(1, '2018-11-01', 'beli perahan', 20250000, 'nonrutin'),
(1, '2018-12-05', 'OP Ku', 850000, 'rutin'),
(1, '2018-12-05', 'listrik', 55000, 'rutin'),
(1, '2018-12-14', 'jual anak manis+satu', 100000, 'rutin'),
(1, '2018-12-25', 'obat cacing', 250000, 'rutin'),
(1, '2018-12-30', 'konsentrat T=34 R=25', 5354000, 'rutin'),
(1, '2018-12-30', 'ampas - 523', 7845000, 'rutin'),
(1, '2018-12-30', 'pasar - 664', 3320000, 'rutin'),
(1, '2018-12-30', 'listrik pulsa', 406000, 'rutin'),
(1, '2018-12-30', 'OP Mul', 585000, 'rutin'),
(2, '2018-11-03', 'operasionalku + pak mamad', 850000, 'rutin'),
(2, '2018-11-08', 'listrik', 170000, 'rutin'),
(2, '2018-11-15', 'lampu', 80000, 'rutin'),
(2, '2018-11-19', 'madinah parlus', 160000, 'rutin'),
(2, '2018-11-29', 'bonus marni + lampu', 65000, 'rutin'),
(2, '2018-11-30', 'jual anak madinah', 50000, 'rutin'),
(2, '2018-11-30', 'Ampas - 329', 4935000, 'rutin'),
(2, '2018-11-30', 'konsentrat T=25 R=16', 3770000, 'rutin'),
(2, '2018-11-30', 'polongan KPS', 625000, 'rutin'),
(2, '2018-11-30', 'Pasar - 314', 1570000, 'rutin'),
(2, '2018-11-30', 'OP Mul', 250000, 'rutin'),
(3, '2018-11-03', 'operasionalku + pak mamad', 850000, 'rutin'),
(3, '2018-11-01', 'Beli perahan No.3', 21250000, 'nonrutin'),
(3, '2018-11-11', 'dara 2 bengong', 60000, 'rutin'),
(3, '2018-11-08', 'listrik', 30000, 'rutin'),
(3, '2018-11-17', 'ngasih', 70000, 'rutin'),
(3, '2018-11-17', 'obat subur', 100000, 'rutin'),
(3, '2018-11-27', 'bonus melati', 30000, 'rutin'),
(3, '2018-11-27', 'lampu 2', 35000, 'rutin'),
(3, '2018-11-27', 'ampas - 360', 5400000, 'rutin'),
(3, '2018-11-27', 'Kon T=30 R=16', 4300000, 'rutin'),
(3, '2018-11-27', 'Potongan KPS', 625000, 'rutin'),
(3, '2018-11-27', 'Pasar - 347', 1735000, 'rutin'),
(3, '2018-11-27', 'OP Mul', 250000, 'rutin'),
(4, '2018-11-03', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(4, '2018-11-04', 'bonus bayem lahir', 100000, 'rutin'),
(4, '2018-11-01', 'beli perahan No.1', 19000000, 'nonrutin'),
(4, '2018-11-08', 'listrik', 55000, 'rutin'),
(4, '2018-11-15', 'obat subur', 100000, 'rutin'),
(4, '2018-11-17', 'ngasih 4 gugur', 20000, 'rutin'),
(4, '2018-11-30', 'jual anak bayun 2', 75000, 'rutin'),
(4, '2018-11-30', 'Ampas - 265', 3975000, 'rutin'),
(4, '2018-11-30', 'Kon T=25 R=12', 3490000, 'rutin'),
(4, '2018-11-30', 'polongan KPS', 625000, 'rutin'),
(4, '2018-11-30', 'Pasar - 272', 1360000, 'rutin'),
(4, '2018-11-30', 'penggajian 22-11-18', 150000, 'rutin'),
(4, '2018-11-30', 'OP Mul', 250000, 'rutin'),
(5, '2018-11-03', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(5, '2018-11-01', 'beli perahan No.4', 19250000, 'nonrutin'),
(5, '2018-11-08', 'listrik', 270000, 'rutin'),
(5, '2018-11-15', 'obat subur', 100000, 'rutin'),
(5, '2018-11-21', 'bengong + dara lahir', 200000, 'rutin'),
(5, '2018-11-30', 'jual a geboy 2', 50000, 'rutin'),
(5, '2018-11-30', 'ampas - 263', 3945000, 'rutin'),
(5, '2018-11-30', 'Kon T=25 R=12', 3490000, 'rutin'),
(5, '2018-11-30', 'Potongan KPS', 625000, 'rutin'),
(5, '2018-11-30', 'pasar - 271', 1355000, 'rutin'),
(5, '2018-11-29', 'pengajian', 150000, 'rutin'),
(5, '2018-11-30', 'OP Mul', 250000, 'rutin'),
(6, '2018-11-03', 'cash bon ngasih', 50000, 'rutin'),
(6, '2018-11-03', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(6, '2018-11-01', 'beli perahan No.2: beta', 18250000, 'nonrutin'),
(6, '2018-11-01', 'beli perahan No.5: rani', 19250000, 'nonrutin'),
(6, '2018-11-08', 'listrik', 75000, 'rutin'),
(6, '2018-11-13', 'no. 2 roboh', 100000, 'rutin'),
(6, '2018-11-15', 'obat subur', 100000, 'rutin'),
(6, '2018-11-17', 'ngasih basri + mul', 70000, 'rutin'),
(7, '2018-11-03', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(7, '2018-11-03', 'bonus nur lahir', 150000, 'rutin'),
(7, '2018-11-07', 'bonus bunga lahir', 100000, 'rutin'),
(7, '2018-11-10', 'dara tanggung bengong', 50000, 'rutin'),
(7, '2018-11-08', 'listrik', 90000, 'rutin'),
(7, '2018-11-15', 'obat subur', 100000, 'rutin'),
(7, '2018-11-17', 'dara nbengong + pedet diare', 35000, 'rutin'),
(7, '2018-11-29', 'bonus tuti', 25000, 'rutin'),
(7, '2018-11-30', 'ampas - 255', 3825000, 'rutin'),
(7, '2018-11-30', 'Kon T=24 R=12', 3384000, 'rutin'),
(7, '2018-11-30', 'Potongan KPS', 625000, 'rutin'),
(7, '2018-11-30', 'pasar - 294', 1470000, 'rutin'),
(7, '2018-11-30', 'OP Mul', 250000, 'rutin'),
(6, '2018-11-18', 'bonus geulis + jamu', 100000, 'rutin'),
(6, '2018-11-24', 'bonus lia lahir + jamu', 120000, 'rutin'),
(6, '2018-11-27', 'bonus dara', 20000, 'rutin'),
(6, '2018-11-30', 'jual anak lia', 100000, 'rutin'),
(6, '2018-11-30', 'lampu 2', 35000, 'rutin'),
(6, '2018-11-30', 'ampas - 246', 3690000, 'rutin'),
(6, '2018-11-30', 'Kon T=22,5 R=13', 3295000, 'rutin'),
(6, '2018-11-30', 'polongan KPS', 625000, 'rutin'),
(6, '2018-11-30', 'pasar - 270', 1350000, 'rutin'),
(6, '2018-11-30', 'OP Mul', 250000, 'rutin'),
(6, '2018-11-30', 'beli perahan', 1300000, 'nonrutin'),
(6, '2018-11-20', 'jual rani 5+3', 11500000, 'nonrutin'),
(6, '2018-11-20', 'bonus jual rani', 200000, 'rutin'),
(1, '2018-12-05', 'Gaji Ust. Aang', 710000, 'rutin'),
(2, '2018-12-01', 'Jajan Hendri', 200000, 'rutin'),
(2, '2018-12-05', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(2, '2018-12-08', 'listrik', 154000, 'rutin'),
(2, '2018-12-08', 'Berkah bengong', 50000, 'rutin'),
(2, '2018-12-18', 'Mekkah parlis', 100000, 'rutin'),
(2, '2018-12-25', 'obat cacing', 250000, 'rutin'),
(2, '2018-12-25', 'Kons T=20 R=20', 3520000, 'rutin'),
(2, '2018-12-25', 'Ampas - 351', 5265000, 'rutin'),
(2, '2018-12-25', 'Pasar - 362', 1810000, 'rutin'),
(2, '2018-12-25', 'OP Mul', 475000, 'rutin'),
(3, '2018-12-05', 'Ngasih Uchri', 130000, 'rutin'),
(3, '2018-12-05', 'OP Ku + Pak Mamad', 1020000, 'rutin'),
(3, '2018-12-12', 'bonus baru 2 lahir', 125000, 'rutin'),
(3, '2018-12-25', 'obat cacing ali', 250000, 'rutin'),
(3, '2018-12-25', 'kons T=24 R=20', 3944000, 'rutin'),
(3, '2018-12-25', 'ampas - 429', 6435000, 'rutin'),
(3, '2018-12-25', 'OP Mul', 475000, 'rutin'),
(3, '2018-12-25', 'Pasar - 395', 1975000, 'rutin'),
(3, '2018-12-18', 'listrik', 10000, 'rutin'),
(4, '2018-12-05', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(4, '2018-12-07', 'listrik', 35000, 'rutin'),
(4, '2018-12-08', 'obat cacing', 250000, 'rutin'),
(4, '2018-12-25', 'Kons T=20 R=15', 3170000, 'rutin'),
(4, '2018-12-25', 'Ampas - 302', 4530000, 'rutin'),
(4, '2018-12-25', 'Pasar - 299', 1495000, 'rutin'),
(4, '2018-12-25', 'OP Mul', 475000, 'rutin'),
(5, '2018-12-05', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(5, '2018-12-05', 'listrik', 280000, 'rutin'),
(5, '2018-12-13', 'bonus mini lahir', 125000, 'rutin'),
(5, '2018-12-25', 'obat cacing', 250000, 'rutin'),
(5, '2018-12-25', 'Konsentrat', 3170000, 'rutin'),
(5, '2018-12-25', 'ampas - 272', 4080000, 'rutin'),
(5, '2018-12-25', 'pasar - 298', 1490000, 'rutin'),
(5, '2018-12-25', 'OP Mul', 475000, 'rutin'),
(5, '2018-12-25', 'bayar jan, feb, maret', 2223000, 'nonrutin'),
(6, '2018-12-05', 'OP Ku + Pak Mamad', 850000, 'rutin'),
(6, '2018-12-05', 'beli kayu dan paku', 175000, 'rutin'),
(6, '2018-12-08', 'listrik', 53000, 'rutin'),
(6, '2018-12-08', 'bonus 8 lahir', 130000, 'rutin'),
(6, '2018-12-08', 'nyumbang EUIS', 1000000, 'rutin'),
(6, '2018-12-17', 'jual lia', 50000, 'rutin'),
(6, '2018-12-17', 'rugi jual lia', 7000000, 'nonrutin'),
(6, '2018-12-23', 'jamu manis', 225000, 'rutin'),
(6, '2018-12-25', 'obat cacing', 250000, 'rutin'),
(6, '2018-12-25', 'Konsentrat', 2958000, 'rutin'),
(6, '2018-12-25', 'ampas - 245', 3675000, 'rutin'),
(6, '2018-12-25', 'pasar - 298', 1490000, 'rutin'),
(6, '2018-12-25', 'pengajian', 150000, 'rutin'),
(6, '2018-12-25', 'OP Mul', 475000, 'rutin'),
(7, '2018-12-05', 'OP ku dan pak mamad', 850000, 'rutin'),
(7, '2018-12-08', 'listrik', 71000, 'rutin'),
(7, '2018-12-13', 'jual bunga', 75000, 'rutin'),
(7, '2018-12-13', 'rugi jual bunga', 9500000, 'nonrutin'),
(7, '2018-12-19', 'bayar sewa', 7000000, 'nonrutin'),
(7, '2018-12-25', 'obat cacing', 250000, 'rutin'),
(7, '2018-12-25', 'konsentrat', 3170000, 'rutin'),
(7, '2018-12-25', 'ampas - 332', 4980000, 'rutin'),
(7, '2018-12-25', 'pasar - 330', 1650000, 'rutin'),
(7, '2018-12-25', 'OP Mul', 475000, 'rutin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sayur`
--

CREATE TABLE `sayur` (
  `bulanPengambilan` date NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `totalKarung` int(11) NOT NULL,
  `karungPokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sayur`
--

INSERT INTO `sayur` (`bulanPengambilan`, `idPegawai`, `totalKarung`, `karungPokok`) VALUES
('2018-11-00', 13, 865, 270),
('2018-11-00', 2, 289, 120),
('2018-12-00', 2, 324, 120),
('2018-12-00', 13, 1007, 255);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ampas`
--
ALTER TABLE `ampas`
  ADD KEY `fk_ampas_pegawai` (`idPegawai`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD KEY `fk_bonus_pegawai` (`idPegawai`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD KEY `fk_pegawai_gaji` (`idPegawai`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD KEY `fk_hutang_pegawai` (`idPegawai`);

--
-- Indexes for table `kandang`
--
ALTER TABLE `kandang`
  ADD PRIMARY KEY (`idKandang`);

--
-- Indexes for table `keuntungan`
--
ALTER TABLE `keuntungan`
  ADD KEY `fk_keuntungan_kandang` (`idKandang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idPegawai`);

--
-- Indexes for table `pegawaiampas`
--
ALTER TABLE `pegawaiampas`
  ADD KEY `fk_pegawaiampas` (`idPegawai`);

--
-- Indexes for table `pegawaikandang`
--
ALTER TABLE `pegawaikandang`
  ADD KEY `fk_pegawaikandang` (`idPegawai`),
  ADD KEY `fk_pegawaikandang_kandang` (`idKandang`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD KEY `fk_pemasukan_kandang` (`idKandang`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD KEY `fk_pengeluaran_kandang` (`idKandang`);

--
-- Indexes for table `sayur`
--
ALTER TABLE `sayur`
  ADD KEY `fk_sayur_pegawai` (`idPegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kandang`
--
ALTER TABLE `kandang`
  MODIFY `idKandang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idPegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ampas`
--
ALTER TABLE `ampas`
  ADD CONSTRAINT `fk_ampas_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bonus`
--
ALTER TABLE `bonus`
  ADD CONSTRAINT `fk_bonus_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `fk_pegawai_gaji` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `fk_hutang_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keuntungan`
--
ALTER TABLE `keuntungan`
  ADD CONSTRAINT `fk_keuntungan_kandang` FOREIGN KEY (`idKandang`) REFERENCES `kandang` (`idKandang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawaiampas`
--
ALTER TABLE `pegawaiampas`
  ADD CONSTRAINT `fk_pegawaiampas` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawaikandang`
--
ALTER TABLE `pegawaikandang`
  ADD CONSTRAINT `fk_pegawaikandang` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawaikandang_kandang` FOREIGN KEY (`idKandang`) REFERENCES `kandang` (`idKandang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `fk_pemasukan_kandang` FOREIGN KEY (`idKandang`) REFERENCES `kandang` (`idKandang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_pengeluaran_kandang` FOREIGN KEY (`idKandang`) REFERENCES `kandang` (`idKandang`);

--
-- Ketidakleluasaan untuk tabel `sayur`
--
ALTER TABLE `sayur`
  ADD CONSTRAINT `fk_sayur_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
