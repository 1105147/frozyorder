-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2023 at 04:27 PM
-- Server version: 8.0.30
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fira_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_costumer`
--

CREATE TABLE `m_costumer` (
  `id_costumer` int NOT NULL,
  `user_id` int NOT NULL,
  `dpn_cst` varchar(50) DEFAULT NULL,
  `blkg_cst` varchar(50) DEFAULT NULL,
  `lahir_cst` date DEFAULT NULL,
  `kontak_cst` char(15) DEFAULT NULL,
  `kelamin_cst` char(10) DEFAULT NULL,
  `alamat_cst` varchar(255) DEFAULT NULL,
  `level_cst` enum('0','1') DEFAULT '0',
  `status_cst` enum('0','1') DEFAULT '0',
  `update_cst` datetime DEFAULT NULL,
  `log_cst` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_costumer`
--

INSERT INTO `m_costumer` (`id_costumer`, `user_id`, `dpn_cst`, `blkg_cst`, `lahir_cst`, `kontak_cst`, `kelamin_cst`, `alamat_cst`, `level_cst`, `status_cst`, `update_cst`, `log_cst`) VALUES
(1, 3, 'Pelang', 'Gan 4', '2020-06-09', '082929929292', 'Laki Laki', 'Majaran adsadasdMajaran adsadasdMajaran adsadasdMajaran adsadasd', '0', '1', '2020-07-07 16:17:28', 'Pelanggan Contoh merubah pengaturan akun');

-- --------------------------------------------------------

--
-- Table structure for table `m_favorit`
--

CREATE TABLE `m_favorit` (
  `costumer_id` int NOT NULL,
  `produk_id` int NOT NULL,
  `status_favorit` enum('0','1') DEFAULT '1',
  `buat_favorit` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE `m_item` (
  `produk_id` int NOT NULL,
  `order_id` int NOT NULL,
  `jumlah_item` int DEFAULT '0',
  `harga_item` int DEFAULT '0',
  `status_item` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `id_kategori` int NOT NULL,
  `parent_kat` int DEFAULT NULL,
  `nama_kat` varchar(50) DEFAULT NULL,
  `slug_kat` varchar(200) DEFAULT NULL,
  `status_kat` int DEFAULT NULL,
  `foto_kat` varchar(250) DEFAULT NULL,
  `icon_kat` char(20) DEFAULT NULL,
  `order_kat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`id_kategori`, `parent_kat`, `nama_kat`, `slug_kat`, `status_kat`, `foto_kat`, `icon_kat`, `order_kat`) VALUES
(1, 0, 'Sosis', 'ayam & bebek', 1, 'app/upload/kategori/fashion-pria.jpg', 'fa fa-male', 1),
(2, 1, 'Asimo sosis', 'asimo sosis', 1, NULL, 'fa fa-list', 2),
(3, 0, 'Korean Food', 'korean food', 1, 'app/upload/kategori/fashion-wanita.jpg', 'fa fa-female', 2),
(4, 1, 'Kimbo Sosis', 'kimbo sosis', 1, NULL, 'fa fa-list', 3),
(5, 3, 'Omoni', 'omoni', 1, NULL, 'fa fa-list', 2),
(6, 0, 'Kentang', 'aneka kentang', 1, 'app/upload/kategori/perawatan-kecantikan1.jpg', 'fa fa-users', 10),
(7, 6, 'Aviko Kentang Premium', 'aviko-kentang-premium', 1, NULL, 'fa fa-list', 2),
(8, 0, 'Cireng', 'cireng', 1, 'app/upload/kategori/elektronik.jpg', 'fa fa-tv', 6),
(9, 8, 'Brecxelle Rujak Cireng', 'rujak cireng', 1, NULL, 'fa fa-list', 2),
(10, 8, 'Srikandi Cireng', 'srikandi cireng', 1, NULL, 'fa fa-list', 3),
(11, 8, 'Cireng Salju', 'cireng salju', 1, NULL, 'fa fa-list', 4),
(13, 8, 'Sosis', 'sosis', 1, NULL, 'fa fa-list', 6),
(14, 8, 'Aneka Olahan Bakso', 'bakso', 1, NULL, 'fa fa-list', 7),
(15, 0, 'Olahan Ikan Segar', 'ikan segar', 1, 'app/upload/kategori/handphone.jpg', 'fa fa-phone', 5),
(16, 15, 'Cumi', 'cumi', 1, NULL, 'fa fa-list', 2),
(17, 15, 'Udang', 'udang', 1, NULL, 'fa fa-list', 3),
(18, 15, 'Tuna', 'tuna', 1, NULL, 'fa fa-list', 4),
(19, 15, 'Tenggiri', 'tenggiri', 1, NULL, 'fa fa-list', 5),
(23, 0, 'Kedaton Olahan Ayam, Bebek&Puyuh', 'olahan', 1, 'app/upload/kategori/komputer1.jpg', 'fa fa-laptop', 4),
(24, 23, 'Bebek Kuning', 'bebek bumbu kuning', 1, NULL, 'fa fa-list', 2),
(64, 1, 'El Primo Sosis', 'sosis', 1, NULL, 'fa fa-list', 16),
(65, 0, 'Bakso', 'bakso', 1, 'app/upload/kategori/fashion-anak.png', 'fa fa-child', 3),
(66, 65, 'Bonanza Bakso', 'fashion-anak/perhiasan-aksesoris', 1, NULL, 'fa fa-list', 2),
(67, 65, 'Belmeat Bakso', 'fashion-anak/pakaian-anak-laki-laki', 1, NULL, 'fa fa-list', 3),
(71, 6, 'Barts Kentang Shoestring', 'perawatan-kecantikan/hair-care', 1, NULL, 'fa fa-list', 3),
(72, 6, 'Belgian Kentang Crinkle Cut', 'perawatan-kecantikan/make-up', 1, NULL, 'fa fa-list', 4),
(73, 6, 'Fiesta Kentang', 'perawatan-kecantikan/perawatan-wajah', 1, NULL, 'fa fa-list', 5),
(74, 6, 'Frozenland Kentang', 'perawatan-kecantikan/perawatan-kulit', 1, NULL, 'fa fa-list', 6),
(75, 6, 'Golden Fram Kentang', 'perawatan-kecantikan/perawatan-tubuh', 1, NULL, 'fa fa-list', 6),
(76, 6, 'Kemfood Kentang', 'perawatan-kecantikan/produk-kewanitaan', 1, NULL, 'fa fa-list', 7),
(77, 0, 'Durian Frozen', 'makanan-minuman', 1, 'app/upload/kategori/makanan-minuman1.jpg', 'fa fa-cutlery', 7),
(78, 77, 'Pancake', 'makanan-minuman/makanan', 1, NULL, 'fa fa-list', 2),
(79, 77, 'Durian Kupas Medan', 'makanan-minuman/minuman', 1, NULL, 'fa fa-list', 3),
(80, 77, 'Cemilan & Snack', 'makanan-minuman/cemilan-snack', 1, NULL, 'fa fa-list', 4),
(81, 77, 'Kue & Roti', 'makanan-minuman/kue-roti', 1, NULL, 'fa fa-list', 5),
(82, 77, 'Bumbu & Bahan Dasar', 'makanan-minuman/bumbu-bahan-dasar', 1, NULL, 'fa fa-list', 6),
(85, 0, 'Madu AL QUBRO', 'hobi-koleksi', 1, 'app/upload/kategori/hobi-koleksi1.jpg', 'fa fa-android', 8),
(86, 85, 'AL QUBRO Madu Propolis', 'hobi-koleksi/game-pc-console', 1, NULL, 'fa fa-list', 2),
(90, 0, 'Nugget', 'olahraga', 1, 'app/upload/kategori/olahraga.jpg', 'fa fa-futbol-o', 9),
(91, 90, 'Akumo Chicken', 'olahraga/akumo-chicken', 1, NULL, 'fa fa-list', 2),
(97, 0, 'Roti Maryam', 'perlengkapan-kantor', 1, 'app/upload/kategori/perlengkapan-kantor.jpg', 'fa fa-building-o', 11),
(98, 97, 'Pandega Roti Maryam', 'makanan', 1, NULL, 'fa fa-list', 1),
(99, 97, 'Radja Roti Maryam', 'Makanan', 1, NULL, 'fa fa-list', 2),
(100, 90, 'So Good', 'Nugget-SoGood', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_order`
--

CREATE TABLE `m_order` (
  `id_order` int NOT NULL,
  `costumer_id` int NOT NULL,
  `code_order` char(30) DEFAULT NULL,
  `total_payment` int DEFAULT '0',
  `ship_payment` int DEFAULT '0',
  `pay_order` enum('0','1') DEFAULT '0' COMMENT '0 = COD, 1 = Transfer Bank',
  `ship_order` enum('0','1') DEFAULT '0' COMMENT '0 = Ambil Langsung, 1 = Jasa Kurir',
  `status_order` enum('0','1','2','3','4','5','6') DEFAULT '0' COMMENT '0 = Pending, 1 = Proses, 2 = Siap, 3 = Pengantaran, 4 = Selesai, 5 = Tolak, 6 = Belum Terima',
  `status_payment` enum('0','1') DEFAULT '0' COMMENT '0 = Belum Bayar, 1 = Sudah Bayar',
  `status_ship` enum('0','1','2','3') DEFAULT '0' COMMENT '0 = Pending, 1 = Proses, 2 = Sampai, 3 = Belum',
  `status_ongkir` enum('0','1') DEFAULT '0' COMMENT '0 = Belum, 1 = Sudah',
  `jenis_ship` enum('0','1') DEFAULT NULL COMMENT '0 = Kurir Toko, 1 = Kurir Luar',
  `kurir` varchar(100) DEFAULT NULL,
  `nama_ship` varchar(50) DEFAULT NULL,
  `kontak_ship` char(15) DEFAULT NULL,
  `alamat_ship` varchar(255) DEFAULT NULL,
  `buat_order` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_order` datetime DEFAULT NULL,
  `update_payment` datetime DEFAULT NULL,
  `update_ship` datetime DEFAULT NULL,
  `log_order` varchar(100) DEFAULT NULL,
  `log_payment` varchar(100) DEFAULT NULL,
  `log_ship` varchar(100) DEFAULT NULL,
  `note_order` varchar(255) DEFAULT NULL,
  `note_payment` varchar(255) DEFAULT NULL,
  `note_ship` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_order`
--

INSERT INTO `m_order` (`id_order`, `costumer_id`, `code_order`, `total_payment`, `ship_payment`, `pay_order`, `ship_order`, `status_order`, `status_payment`, `status_ship`, `status_ongkir`, `jenis_ship`, `kurir`, `nama_ship`, `kontak_ship`, `alamat_ship`, `buat_order`, `update_order`, `update_payment`, `update_ship`, `log_order`, `log_payment`, `log_ship`, `note_order`, `note_payment`, `note_ship`) VALUES
(3, 1, 'FI206RA06516SO53', 290000, 0, '0', '0', '2', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, '2020-06-16 07:53:06', '2020-06-17 14:07:33', '2020-06-23 14:48:35', NULL, 'Pelang Gan 4 sudah menerima pesanan.', 'Fira Papua telah memvalidasi pembayaran pelanggan', NULL, 'Ini ambil sendirii, bayar dengan COD', 'Tagihan telah dibayar', NULL),
(4, 1, 'FI206RA32516SO54', 115000, 5000, '1', '1', '4', '1', '2', '1', '1', 'JNE - [JN1024729374023948]', 'Pelang Gan 4', '82929929292', 'Majaran adsadasdMajaran adsadasdMajaran adsadasdMajaran adsadasd', '2020-06-16 07:54:32', '2020-06-19 11:46:09', '2020-06-17 13:58:35', '2020-06-19 11:45:06', 'Pelang Gan 4 sudah menerima pesanan.', 'Galih Bayu Sambayon telah memvalidasi pembayaran p', 'Galih Bayu Sambayon mengubah status pengiriman', 'Ini pakai kurir bayar lewat Bank', 'Tagihan sudah lunas', 'Pesanan telah sampai. Mohon konfirmasi penerimaan pesanan anda kepada kami.'),
(5, 1, 'FI206RA02516SO39', 108000, 10000, '1', '1', '4', '1', '2', '1', '0', 'Galih Bayu - [08349835435]', 'Pelang Gan 4', '82929929292', 'Majaran adsadasdMajaran adsadasdMajaran adsadasdMajaran adsadasd', '2020-06-18 07:39:02', '2020-06-19 11:47:37', '2020-06-19 11:46:39', '2020-06-19 11:47:31', 'Pelang Gan 4 sudah menerima pesanan.', 'Galih Bayu Sambayon telah memvalidasi pembayaran pelanggan', 'Galih Bayu Sambayon mengubah status pengiriman', 'Ini di antar Kurir Toko', 'Tagihan telah dibayar', 'Pesanan telah sampai. Mohon konfirmasi penerimaan pesanan anda kepada kami.'),
(6, 1, 'FI206RA01511SO48', 90000, 0, '0', '0', '4', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, '2020-06-19 02:48:01', '2020-06-19 11:49:00', '2020-06-19 11:48:54', NULL, 'Pelang Gan 4 sudah menerima pesanan.', 'Galih Bayu Sambayon telah memvalidasi pembayaran pelanggan', NULL, 'Ini ambil sendiri', 'Tagihan telah dibayar', NULL),
(7, 1, 'FI206RA15512SO56', 200000, 0, '1', '1', '4', '1', '2', '1', '1', 'JNE - [JN2385495743]', 'UNIMUDA', '082929929292', 'AimasAimasAimasAimas', '2020-06-19 03:56:15', '2020-06-19 13:27:42', '2020-06-19 13:24:12', '2020-06-19 13:25:35', 'Pelang Gan 4 sudah menerima pesanan.', 'Galih Bayu Sambayon telah memvalidasi pembayaran pelanggan', 'Galih Bayu Sambayon mengubah status pengiriman', 'Pesanan untuk UNIMUDA Sorong', 'Tagihan telah dibayar', 'Pesanan telah sampai. Mohon konfirmasi penerimaan pesanan anda kepada kami.'),
(8, 1, 'FI206RA2817SO07', 80000, 5000, '1', '1', '2', '1', '0', '1', NULL, NULL, 'Pelang Gan 4', '082929929292', 'Majaran adsadasdMajaran adsadasdMajaran adsadasdMajaran adsadasd', '2020-06-22 08:07:28', '2020-06-22 17:08:55', '2020-06-22 17:09:23', NULL, 'Fira Papua mengubah status pemesananan', 'Fira Papua telah memvalidasi pembayaran pelanggan', NULL, 'Cobaaaaa Cobaaaaa', 'Tagihan telah dibayar', 'Produk telah dipesan. Menunggu estimasi Biaya Pengiriman dari Toko.'),
(9, 1, 'BIO2310U117MRT51', 108000, 0, '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, '2023-10-01 10:51:26', NULL, NULL, NULL, 'Pelanggan Contoh membuat pesanan baru', NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_produk`
--

CREATE TABLE `m_produk` (
  `id_produk` int NOT NULL,
  `kategori_id` int NOT NULL,
  `nama_pdk` varchar(200) DEFAULT NULL,
  `slug_pdk` varchar(200) DEFAULT NULL,
  `status_pdk` enum('0','1') DEFAULT '1',
  `stok_pdk` int DEFAULT '0',
  `harga_pdk` int DEFAULT '0',
  `diskon_pdk` int DEFAULT '0',
  `kondisi_pdk` enum('0','1') DEFAULT '1',
  `rate_pdk` int DEFAULT '0',
  `review_pdk` int DEFAULT '0',
  `informasi_pdk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `buat_pdk` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_pdk` datetime DEFAULT NULL,
  `log_pdk` varchar(50) DEFAULT NULL,
  `fotosatu_pdk` varchar(250) DEFAULT NULL,
  `fotodua_pdk` varchar(250) DEFAULT NULL,
  `fototiga_pdk` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk`
--

INSERT INTO `m_produk` (`id_produk`, `kategori_id`, `nama_pdk`, `slug_pdk`, `status_pdk`, `stok_pdk`, `harga_pdk`, `diskon_pdk`, `kondisi_pdk`, `rate_pdk`, `review_pdk`, `informasi_pdk`, `buat_pdk`, `update_pdk`, `log_pdk`, `fotosatu_pdk`, `fotodua_pdk`, `fototiga_pdk`) VALUES
(9, 2, 'asimo sosis 500g isi 15', 'asimo-sosis-500g-isi-15', '1', 15, 20000, 0, '1', 0, 0, 'Terbuat dari daging ayam dengan aroma yang khas', '2023-12-01 10:54:00', NULL, 'Administrator membuat produk baru', 'app/upload/produk/asimo-sosis-500g-isi-15-960-1280.jpg', NULL, NULL),
(10, 4, 'Sosis Kimbo coctail bratwurst 450g', 'sosis-kimbo-coctail-bratwurst-450g', '1', 10, 34500, 0, '1', 0, 0, 'Sosis Kimbo coctail bratwurst sangat cocok untuk dijadikan sate sosis bakar dengan tambahan bumbu BBQ,saus tomat atau lainnya', '2023-12-01 11:05:40', NULL, 'Administrator membuat produk baru', 'app/upload/produk/sosis-kimbo-coctail-bratwurst-450g-960-1280.jpg', NULL, NULL),
(11, 64, 'El primo sosis sapi keju isi 5,berat 500gr', 'el-primo-sosis-sapi-keju-isi-5berat-500gr', '1', 10, 66000, 0, '1', 0, 0, 'dibuat dari bahan bahan berkualitas yang diolah secara highienis memiliki rasa yang nikmat dan lezat', '2023-12-01 11:10:10', NULL, 'Administrator membuat produk baru', 'app/upload/produk/el-primo-sosis-sapi-keju-isi-5berat-500gr-960-1280.jpg', NULL, NULL),
(12, 5, 'Corndog omoni isi 2', 'corndog-omoni-isi-2', '1', 10, 27000, 0, '1', 0, 0, 'empuknya corndog ditambah keju mozarella yang meleleh dan diolesi saus italia yang memiliki rasa yang khas.', '2023-12-01 11:13:16', NULL, 'Administrator membuat produk baru', NULL, NULL, NULL),
(13, 66, 'Bonanza bakso sapi isi 40, 500g', 'bonanza-bakso-sapi-isi-40-500g', '1', 10, 56000, 0, '1', 0, 0, 'Bakso bonanza kenyal dan empuk meski tanpa pengenyal dan pengawet karena terbuat dari 84', '2023-12-01 11:23:36', NULL, 'Administrator membuat produk baru', 'app/upload/produk/bonanza-bakso-sapi-isi-40-500g-960-1280.jpg', NULL, NULL),
(14, 67, 'Belmeat bakso daging sapi', 'belmeat-bakso-daging-sapi', '1', 10, 49000, 0, '1', 0, 0, 'bakso yang sangat cocok untuk bakso kuah,sup bakso serta campuran nasi goreng dan capcay', '2023-12-01 11:28:28', NULL, 'Administrator membuat produk baru', 'app/upload/produk/belmeat-bakso-daging-sapi-958-901.jpg', NULL, NULL),
(15, 24, 'Olahan kedaton Bebek kuning', 'olahan-kedaton-bebek-kuning', '1', 10, 64000, 0, '1', 0, 0, 'produk home made terbuat dari bebek pilihan berkualitas', '2023-12-01 12:15:32', NULL, 'Administrator membuat produk baru', 'app/upload/produk/olahan-kedaton-bebek-kuning-960-1280.jpg', NULL, NULL),
(16, 16, 'cumi ring import 500g', 'cumi-ring-import-500g', '1', 10, 33000, 0, '1', 0, 0, 'cuma kupas bersih yang diolah(dipotong) menjadi cumi ring yang fresh', '2023-12-01 12:24:52', NULL, 'Administrator membuat produk baru', 'app/upload/produk/cumi-ring-import-500g-1280-960.jpg', NULL, NULL),
(17, 17, 'udang vaname 250g', 'udang-vaname-250g', '1', 10, 31000, 0, '1', 0, 0, 'udang vaname yang kaya akan protein', '2023-12-01 12:30:07', NULL, 'Administrator membuat produk baru', 'app/upload/produk/udang-vaname-250g-960-1280.jpg', NULL, NULL),
(18, 18, 'Tuna utuh 1kg', 'tuna-utuh-1kg', '1', 10, 42000, 0, '1', 0, 0, 'ikan tuna segar premium', '2023-12-01 12:47:18', NULL, 'Administrator membuat produk baru', 'app/upload/produk/tuna-utuh-1kg-1280-960.jpg', NULL, NULL),
(19, 19, 'ikan giling tenggiri grade B 500g', 'ikan-giling-tenggiri-grade-b-500g', '1', 10, 22000, 0, '1', 0, 0, 'ikan giling premium cocok untuk olahan pempek,tekwan,otak-otak dll', '2023-12-01 12:50:24', NULL, 'Administrator membuat produk baru', 'app/upload/produk/ikan-giling-tenggiri-grade-b-500g-960-1280.jpg', NULL, NULL),
(20, 9, 'Brexcelle rujak cireng', 'brexcelle-rujak-cireng', '1', 10, 14500, 0, '1', 0, 0, 'krispy dan gurih serta tambahan bumbu cireng', '2023-12-01 12:58:32', NULL, 'Administrator membuat produk baru', 'app/upload/produk/brexcelle-rujak-cireng-960-1280.jpg', NULL, NULL),
(21, 10, 'srikandi cireng isi 10', 'srikandi-cireng-isi-10', '1', 10, 10000, 0, '1', 0, 0, 'crispy,gurih dan sensasi bumbu rujak yang enak', '2023-12-01 13:03:36', NULL, 'Administrator membuat produk baru', 'app/upload/produk/srikandi-cireng-isi-10-1079-1280.jpeg', NULL, NULL),
(22, 11, 'Cireng salju isi 24', 'cireng-salju-isi-24', '1', 10, 15000, 0, '1', 0, 0, 'renyah gurih + bumbu', '2023-12-01 13:07:22', NULL, 'Administrator membuat produk baru', 'app/upload/produk/cireng-salju-isi-24-960-1280.jpeg', NULL, NULL),
(23, 78, 'pancake durian isi 21', 'pancake-durian-isi-21', '1', 10, 70000, 0, '1', 0, 0, 'rasa durian yang khas dan wangi', '2023-12-01 13:13:10', NULL, 'Administrator membuat produk baru', 'app/upload/produk/pancake-durian-isi-21-1280-1024.jpg', NULL, NULL),
(24, 79, 'Durian Kupas medan 400g', 'durian-kupas-medan-400g', '1', 10, 26000, 0, '1', 0, 0, 'durian kupas premium manis', '2023-12-01 13:18:12', NULL, 'Administrator membuat produk baru', 'app/upload/produk/durian-kupas-medan-400g-960-1280.jpg', NULL, NULL),
(25, 86, 'madu al qubro 1kg', 'madu-al-qubro-1kg', '1', 10, 130000, 0, '1', 0, 0, 'berkhasiat yang sangat baik', '2023-12-01 13:35:22', NULL, 'Administrator membuat produk baru', 'app/upload/produk/madu-al-qubro-1kg-1200-704.jpg', NULL, NULL),
(26, 100, 'So Good Crispy Chicken Nugget 400g', 'so-good-crispy-chicken-nugget-400g', '1', 10, 40000, 0, '1', 0, 0, 'enak gurih dan renyah', '2023-12-01 13:48:10', NULL, 'Administrator membuat produk baru', 'app/upload/produk/so-good-crispy-chicken-nugget-400g-960-1280.jpg', NULL, NULL),
(27, 91, 'akumo chicken nugget', 'akumo-chicken-nugget', '1', 10, 23000, 0, '1', 0, 0, 'renyah dan gurih dll', '2023-12-01 13:53:16', NULL, 'Administrator membuat produk baru', 'app/upload/produk/akumo-chicken-nugget-960-1280.jpg', NULL, NULL),
(28, 7, 'aviko kentang shoestring', 'aviko-kentang-shoestring', '1', 10, 37000, 0, '1', 0, 0, 'renyah,gurih dan premium', '2023-12-01 14:07:47', NULL, 'Administrator membuat produk baru', 'app/upload/produk/aviko-kentang-shoestring-1280-960.jpg', NULL, NULL),
(29, 98, 'pandega roti maryam isi 10', 'pandega-roti-maryam-isi-10', '1', 10, 21000, 0, '1', 0, 0, 'lembut dan sangat lezat', '2023-12-01 14:13:22', NULL, 'Administrator membuat produk baru', 'app/upload/produk/pandega-roti-maryam-isi-10-960-1280.jpg', NULL, NULL),
(30, 99, 'Radja Roti maryam original isi 5', 'radja-roti-maryam-original-isi-5', '1', 10, 17500, 0, '1', 0, 0, 'Roti maryam original isi 5 nikmat dan lezat', '2023-12-01 14:16:07', NULL, 'Administrator membuat produk baru', 'app/upload/produk/radja-roti-maryam-original-isi-5-960-1280.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_review`
--

CREATE TABLE `m_review` (
  `costumer_id` int NOT NULL,
  `produk_id` int NOT NULL,
  `rate_review` int DEFAULT '0',
  `isi_review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `buat_review` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_review` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rf_file`
--

CREATE TABLE `rf_file` (
  `id_file` int NOT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `type_file` varchar(50) DEFAULT NULL,
  `size_file` varchar(50) DEFAULT NULL,
  `url_file` varchar(200) DEFAULT NULL,
  `update_file` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_file` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rf_galeri`
--

CREATE TABLE `rf_galeri` (
  `id_galeri` int NOT NULL,
  `judul_galeri` varchar(200) DEFAULT NULL,
  `slug_galeri` varchar(250) DEFAULT NULL,
  `jenis_galeri` enum('0','1') DEFAULT '0',
  `isi_galeri` text,
  `status_galeri` enum('0','1') DEFAULT '1',
  `is_header` enum('0','1') DEFAULT '0',
  `foto_galeri` varchar(200) DEFAULT NULL,
  `update_galeri` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_galeri` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rf_galeri`
--

INSERT INTO `rf_galeri` (`id_galeri`, `judul_galeri`, `slug_galeri`, `jenis_galeri`, `isi_galeri`, `status_galeri`, `is_header`, `foto_galeri`, `update_galeri`, `log_galeri`) VALUES
(1, 'Galeri Satu', 'galeri-satu', '0', '<p><span style=\"color:rgb(54, 52, 50); font-family:roboto,sans-serif; font-size:16px\"> Spesial PROMO NOVEMBER! Discount up tp 50K untuk produk pilihan.\r\nYuk geser ke kanan untuk info produk apa saja yang diskon</span></p>', '1', '1', 'app/upload/galeri/promo1.jpeg', '2023-11-21 05:13:41', 'Administrator'),
(2, 'Galeri Dua', 'galeri-dua', '0', '<p><span style=\"color:rgb(77, 81, 86); font-family:arial,sans-serif; font-size:14px\">Spesial PROMO NOVEMBER! </span><strong>Discount up tp 50K </strong><span style=\"color:rgb(77, 81, 86); font-family:arial,sans-serif; font-size:14px\">&nbsp;untuk produk pilihan&nbsp;</span><strong>Yuk geser ke kanan untuk info produk apa saja yang diskon</strong><span style=\"color:rgb(77, 81, 86); font-family:arial,sans-serif; font-size:14px\">&nbsp;Order bisa langsung ke website ini yaa</span><strong></strong><span style=\"color:rgb(77, 81, 86); font-family:arial,sans-serif; font-size:14px\"></span></p>', '1', '1', 'app/upload/galeri/promo2.jpeg', '2023-11-21 05:20:59', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `rf_nav`
--

CREATE TABLE `rf_nav` (
  `id_nav` int NOT NULL,
  `parent_nav` int NOT NULL,
  `judul_nav` varchar(100) NOT NULL,
  `url_nav` varchar(200) NOT NULL,
  `link_nav` enum('0','1') DEFAULT '0',
  `status_nav` enum('0','1') NOT NULL DEFAULT '1',
  `order_nav` int NOT NULL,
  `icon_nav` varchar(20) NOT NULL,
  `update_nav` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_nav` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rf_nav`
--

INSERT INTO `rf_nav` (`id_nav`, `parent_nav`, `judul_nav`, `url_nav`, `link_nav`, `status_nav`, `order_nav`, `icon_nav`, `update_nav`, `log_nav`) VALUES
(1, 0, 'Tentang Kami', 'pages/hubungi-kami', '0', '1', 1, 'fa fa-home', '2020-06-24 06:50:00', 'Administrator'),
(2, 7, 'Cara Order', 'pages/visi-dan-misi', '0', '0', 2, 'fa fa-users', '2023-11-21 20:46:15', 'Administrator'),
(3, 7, 'Tanya Jawab', 'galeri', '0', '0', 4, 'fa fa-image', '2023-11-21 20:46:36', 'Administrator'),
(4, 7, 'Cara Pembayaran', 'pages/struktur-organisasi', '0', '0', 3, 'fa fa-list', '2023-11-21 20:46:24', 'Administrator'),
(5, 0, 'Program Studi', 'pages/program-studi', '0', '0', 2, 'fa fa-list', '2020-06-24 06:46:06', 'Administrator'),
(6, 0, 'Artikel dan Berita', 'tag/all', '0', '0', 3, 'fa fa-newspaper-o', '2020-06-24 06:46:11', 'Administrator'),
(7, 0, 'Bantuan', '#home', '0', '1', 5, 'fa fa-list', '2023-11-21 05:24:29', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `rf_page`
--

CREATE TABLE `rf_page` (
  `id_page` int NOT NULL,
  `judul_page` varchar(200) DEFAULT NULL,
  `slug_page` varchar(250) DEFAULT NULL,
  `status_page` enum('0','1') DEFAULT '1',
  `isi_page` text,
  `foto_page` varchar(200) DEFAULT NULL,
  `update_page` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_page` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rf_page`
--

INSERT INTO `rf_page` (`id_page`, `judul_page`, `slug_page`, `status_page`, `isi_page`, `foto_page`, `update_page`, `log_page`) VALUES
(1, 'Profil', 'profil', '0', '<p style=\"text-align: justify;\">Universitas Pendidikan Muhammadiyah Sorong (UNIMUDA Sorong) adalah lembaga pendidikan tinggi di bawah persyarikatan Muhammadiyah yang didirikan pada 5 Mei 2018 melalui SK Menristekdikti Nomor 547/KPT/I/2018 sebagai perubahan bentuk dari STKIP Muhammadiyah Sorong.</p>\r\n\r\n<p style=\"text-align: justify;\">Awalnya, UNIMUDA Sorong merupakan sebuah Sekolah Tinggi Keguruan dan Ilmu Pendidikan (STKIP) Muhammadiyah Sorong yang berdiri pada tanggal 19 Agustus 2004 SK Mendiknas RI Nomor 127/D/O/2004. Adapun izin penyelenggaraan program studi meliputi : 1. Pendidikan Bahasa dan Sastra Indonesia, 2. Pendidikan Bahasa Inggris, dan 3. Pendidikan Biologi.<br />\r\nPrakarsa pendirian STKIP Muhammadiyah Sorong muncul pada saat Pimpinan Daerah Muhammadiyah Kabupaten Sorong Periode 2000-2005 menyelenggarakan Rapat Kerja Daerah (RAKERDA) Majelis Pendidikan Dasar dan Menengah bertempat di Madrasah Aliyah Muhammadiyah Aimas pada tanggal 13 November 2001. RAKERDA menghasilkan program kerja yang salah satunya adalah mendirikan STKIP Muhammadiyah Sorong pada tahun 2003. Keputusan tersebut disepakati bersama karena belum ada lembaga pendidikan tinggi bidang pendidikan di Kabupaten Sorong dan hadirnya Persyarikatan Muhammadiyah di Sorong turut mengambil peran dalam mencerdaskan anak bangsa yang bukan hanya tanggung jawab pemerintah semata. Dalam proses pendirian dibentuk panitia yang terdiri dari : Ketua: Drs. Rustamadji, Sekretaris : Manut Pratikno, B.A., Anggota : Sulardi, S.Pd., Suwarto, S.Sos., Sutikno, Ir. Eko Tavip Maryanto, Muhadi, Supirman, S.Sos. Pada tahun 2003, terbitlah SK Pimpinan Pusat Muhammadiyah Nomor 78/KEP/I.0/D/2003 Tanggal 20 September 2003, tentang Pengangkatan Ketua STKIP Muhammadiyah Sorong pertama adalah Drs. Rustamadji, sebelumnya telah mengundurkan diri sebagai Ketua Pimpinan Daerah Muhammadiyah Kabupaten Sorong. Pada saat bersamaan terbit SK Majelis Diktilitbang Pimpinan Pusat Muhammadiyah tentang Pengangkatan Pengurus Badan Pelaksana Harian (BPH) STKIP Muhammadiyah Sorong yang diketuai oleh Drs. Suwarto Abbas, M.H. Namun berhubung Drs. Suwarto Abbas, M.H. telah pindah tugas, maka tahun 2004 Majelis Diktilitbang mengangkat kembali Pengurus BPH Pengganti Antar Waktu yang diketuai oleh Drs. Nursono Sidiq. Tahun 2004, saat kunjungan Pimpinan Pusat Muhammadiyah yakni Prof. H. Zamroni, Ph.D.&nbsp; di Kabupaten Sorong membawa kabar baik bahwa Mendiknas RI Prof. Drs. H.A. Malik Fadjar, M.Sc. telah menyetujui pendirian STKIP Muhammadiyah Sorong.<br />\r\nTujuh tahun kemudian, tepatnya tahun 2011, STKIP Muhammadiyah Sorong menambah dua program studi lagi, yaitu Pendidikan Matematika dan Pendidikan Pancasila dan Kewarganegaraan. Beberapa tahun berikutnya mendapatkan izin operasional penyelenggaraan Program Studi Pendidikan Jasmani, Pendidikan Guru Sekolah Dasar, Pendidikan Teknologi dan Informasi serta Pendidikan Ilmu Pengetahuan Alam.<br />\r\nFakultas Keguruan dan Ilmu Pendidikan, sebagai embrio berdirinya Universitas Pendidikan Muhammadiyah Sorong, pada&nbsp; mulanya hanya memiliki tiga program studi, 1. Pendidikan Bahasa dan Sastra Indonesia, 2. Pendidikan Bahasa Inggris, 3. Pendidikan Biologi. Saat ini Fakultas Keguruan dan Ilmu Pendidikan Universitas Pendidikan Muhammadiyah Sorong memiliki sepuluh program studi, yakni Program Studi Pendidikan Biologi, Program Studi Pendidikan Bahasa Indonesia, Program Studi Pendidikan Bahasa Inggris, Program Studi Pendidikan Matematika, Program Studi Pendidikan Pancasila dan Kewarganegaraan, Program Studi Pendidikan Jasmani, Program Studi Pendidikan Guru Sekolah Dasar, Program Studi Pendidikan Teknologi Informasi, Program Studi Pendidikan Ilmu Pengetahuan Alam, dan Program Studi Pendidikan Guru Pendidikan Anak Usia Dini.</p>\r\n', 'app/upload/page/profil.jpeg', '2023-11-21 20:47:23', 'Administrator'),
(2, 'Visi dan Misi', 'visi-dan-misi', '0', '', 'app/upload/page/visi-dan-misi.jpeg', '2023-11-21 09:06:23', 'Administrator'),
(3, 'Struktur Organisasi', 'struktur-organisasi', '0', '', 'app/upload/page/struktur-organisasi.jpeg', '2023-11-21 09:06:12', 'Administrator'),
(4, 'Program Studi', 'program-studi', '0', '<h2><strong>FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN:</strong></h2>\r\n\r\n<h2>1. Pendidikan Biologi</h2>\r\n\r\n<h2>2. Pendidikan Bahasa Indonesia</h2>\r\n\r\n<h2>3. Pendidikan Bahas Inggris</h2>\r\n\r\n<h2>4. Pendidikan Matematika</h2>\r\n\r\n<h2>5. Pendidikan Pkn</h2>\r\n\r\n<h2>6. Pendidikan Jasmani</h2>\r\n\r\n<h2>7. Pendidikan Guru Sekolah Dasar</h2>\r\n\r\n<h2>8. Pendidikan Teknologi Informasi/Komputer</h2>\r\n\r\n<h2>9. Pendidikan IPA</h2>\r\n\r\n<h2>10. Pendidikan Guru Pendidikan Anak Usia Dini</h2>\r\n', 'app/upload/page/program-studi.png', '2023-11-21 09:06:01', 'Administrator'),
(5, 'Hubungi Kami', 'hubungi-kami', '1', '<p> Dakon frozen food merupakan toko frozen food yang sudah berdiri sejak tahun 2018 yang terletak di Daerah Istimewa Yogyakarta tepatnya di Perum citra Kedaton 1 Jl. Sukun no. 11 , Ngringin Condongcatur,Kec.Depok, Kabupaten Sleman yang menjual aneka makanan beku dan sekarang sudah merangkap menjual berbagai macam saus dan bumbu instan.</p>', 'app/upload/page/hubungi-kami-1080-607.jpeg', '2023-11-21 09:20:30', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `yk_aksi`
--

CREATE TABLE `yk_aksi` (
  `id_aksi` int NOT NULL,
  `nama_aksi` varchar(10) DEFAULT NULL,
  `fungsi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_aksi`
--

INSERT INTO `yk_aksi` (`id_aksi`, `nama_aksi`, `fungsi`) VALUES
(1, 'Lihat', 'index'),
(2, 'Tambah', 'add'),
(3, 'Ubah', 'edit'),
(4, 'Hapus', 'delete'),
(5, 'Detail', 'detail'),
(6, 'Cetak', 'cetak'),
(7, 'Export', 'export');

-- --------------------------------------------------------

--
-- Table structure for table `yk_aplikasi`
--

CREATE TABLE `yk_aplikasi` (
  `id_aplikasi` int NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(250) DEFAULT NULL,
  `cipta` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `tema` varchar(255) DEFAULT NULL,
  `update_aplikasi` datetime DEFAULT NULL,
  `session_aplikasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_aplikasi`
--

INSERT INTO `yk_aplikasi` (`id_aplikasi`, `judul`, `deskripsi`, `cipta`, `logo`, `tema`, `update_aplikasi`, `session_aplikasi`) VALUES
(1, 'Frozy Order', 'Situs Belanja Online Dakon Frozen Food', 'UNIMUDA Sorong', 'app/img/frozy.jpeg', 'skin-1,3,0,0,0,0,0,0,0,0,#2dcf81,#4f4f4f', '2021-11-09 14:22:36', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `yk_group`
--

CREATE TABLE `yk_group` (
  `id_group` int NOT NULL,
  `nama_group` varchar(50) DEFAULT NULL,
  `level` enum('1','2') DEFAULT NULL,
  `keterangan_group` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_group`
--

INSERT INTO `yk_group` (`id_group`, `nama_group`, `level`, `keterangan_group`) VALUES
(1, 'Administrator', '1', 'Super Admin Sistem'),
(2, 'Toko', '2', 'Pemilik Toko'),
(3, 'Pelanggan', '2', 'Pelanggan Toko');

-- --------------------------------------------------------

--
-- Table structure for table `yk_group_menu_aksi`
--

CREATE TABLE `yk_group_menu_aksi` (
  `id_menu_aksi` int DEFAULT NULL,
  `id_group` int DEFAULT NULL,
  `segmen` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_group_menu_aksi`
--

INSERT INTO `yk_group_menu_aksi` (`id_menu_aksi`, `id_group`, `segmen`) VALUES
(112, 3, 'sistem/notif/index'),
(115, 3, 'sistem/notif/delete'),
(20, 3, 'sistem/password/index'),
(21, 3, 'sistem/password/edit'),
(24, 3, 'sistem/profil/index'),
(25, 3, 'sistem/profil/edit'),
(26, 2, 'master/all/index'),
(37, 2, 'master/mcostumer/index'),
(38, 2, 'master/mcostumer/add'),
(39, 2, 'master/mcostumer/edit'),
(40, 2, 'master/mcostumer/delete'),
(41, 2, 'master/mcostumer/detail'),
(42, 2, 'master/mkategori/index'),
(43, 2, 'master/mkategori/add'),
(44, 2, 'master/mkategori/edit'),
(45, 2, 'master/mkategori/delete'),
(47, 2, 'shop/all/index'),
(73, 2, 'shop/shistory/index'),
(74, 2, 'shop/shistory/add'),
(75, 2, 'shop/shistory/edit'),
(76, 2, 'shop/shistory/delete'),
(77, 2, 'shop/shistory/detail'),
(78, 2, 'shop/shistory/cetak'),
(79, 2, 'shop/shistory/export'),
(58, 2, 'shop/sorder/index'),
(59, 2, 'shop/sorder/add'),
(60, 2, 'shop/sorder/edit'),
(61, 2, 'shop/sorder/delete'),
(62, 2, 'shop/sorder/detail'),
(80, 2, 'shop/sorder/cetak'),
(81, 2, 'shop/sorder/export'),
(86, 2, 'shop/spayment/index'),
(87, 2, 'shop/spayment/add'),
(88, 2, 'shop/spayment/edit'),
(89, 2, 'shop/spayment/delete'),
(90, 2, 'shop/spayment/detail'),
(53, 2, 'shop/sproduk/index'),
(54, 2, 'shop/sproduk/add'),
(55, 2, 'shop/sproduk/edit'),
(56, 2, 'shop/sproduk/delete'),
(57, 2, 'shop/sproduk/detail'),
(68, 2, 'shop/sshipment/index'),
(69, 2, 'shop/sshipment/add'),
(70, 2, 'shop/sshipment/edit'),
(71, 2, 'shop/sshipment/delete'),
(72, 2, 'shop/sshipment/detail'),
(84, 2, 'shop/sshipment/cetak'),
(85, 2, 'shop/sshipment/export'),
(20, 2, 'sistem/password/index'),
(21, 2, 'sistem/password/edit'),
(24, 2, 'sistem/profil/index'),
(127, 1, 'konten/all/index'),
(140, 1, 'konten/file/index'),
(141, 1, 'konten/file/add'),
(142, 1, 'konten/file/edit'),
(143, 1, 'konten/file/delete'),
(136, 1, 'konten/galeri/index'),
(137, 1, 'konten/galeri/add'),
(138, 1, 'konten/galeri/edit'),
(139, 1, 'konten/galeri/delete'),
(132, 1, 'konten/halaman/index'),
(133, 1, 'konten/halaman/add'),
(134, 1, 'konten/halaman/edit'),
(135, 1, 'konten/halaman/delete'),
(128, 1, 'konten/navigasi/index'),
(129, 1, 'konten/navigasi/add'),
(130, 1, 'konten/navigasi/edit'),
(131, 1, 'konten/navigasi/delete'),
(14, 1, 'sistem/akses/index'),
(125, 1, 'sistem/akses/add'),
(15, 1, 'sistem/akses/edit'),
(126, 1, 'sistem/akses/delete'),
(1, 1, 'sistem/all/index'),
(22, 1, 'sistem/aplikasi/index'),
(23, 1, 'sistem/aplikasi/edit'),
(2, 1, 'sistem/group/index'),
(3, 1, 'sistem/group/add'),
(4, 1, 'sistem/group/edit'),
(5, 1, 'sistem/group/delete'),
(10, 1, 'sistem/menu/index'),
(11, 1, 'sistem/menu/add'),
(12, 1, 'sistem/menu/edit'),
(13, 1, 'sistem/menu/delete'),
(112, 1, 'sistem/notif/index'),
(113, 1, 'sistem/notif/add'),
(115, 1, 'sistem/notif/delete'),
(20, 1, 'sistem/password/index'),
(21, 1, 'sistem/password/edit'),
(24, 1, 'sistem/profil/index'),
(25, 1, 'sistem/profil/edit'),
(6, 1, 'sistem/user/index'),
(7, 1, 'sistem/user/add'),
(8, 1, 'sistem/user/edit'),
(9, 1, 'sistem/user/delete'),
(116, 1, 'sistem/user/detail');

-- --------------------------------------------------------

--
-- Table structure for table `yk_group_role`
--

CREATE TABLE `yk_group_role` (
  `group_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_group_role`
--

INSERT INTO `yk_group_role` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `yk_menu`
--

CREATE TABLE `yk_menu` (
  `id_menu` int NOT NULL,
  `parent_menu` int DEFAULT NULL,
  `nama_menu` varchar(150) DEFAULT NULL,
  `module_menu` varchar(150) DEFAULT NULL,
  `status_menu` enum('1','0') DEFAULT NULL,
  `icon_menu` varchar(30) DEFAULT 'fa fa-list',
  `order_menu` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_menu`
--

INSERT INTO `yk_menu` (`id_menu`, `parent_menu`, `nama_menu`, `module_menu`, `status_menu`, `icon_menu`, `order_menu`) VALUES
(1, 0, 'Sistem', 'sistem/all', '1', 'fa fa-cogs', 2),
(2, 1, 'Group', 'sistem/group', '1', 'fa fa-list', 2),
(3, 1, 'User', 'sistem/user', '1', 'fa fa-list', 3),
(4, 1, 'Menu', 'sistem/menu', '1', 'fa fa-list', 4),
(5, 1, 'Hak Akses', 'sistem/akses', '1', 'fa fa-list', 5),
(7, 1, 'Ubah Password', 'sistem/password', '0', 'fa fa-list', 6),
(8, 1, 'Aplikasi', 'sistem/aplikasi', '1', 'fa fa-list', 7),
(9, 1, 'Akun Saya', 'sistem/profil', '0', 'fa fa-list', 8),
(10, 0, 'Master', 'master/all', '1', 'fa fa-pencil-square-o', 2),
(13, 10, 'Costumer', 'master/mcostumer', '1', 'fa fa-users', 3),
(14, 10, 'Kategori', 'master/mkategori', '1', 'fa fa-list', 4),
(15, 0, 'Toko', 'shop/all', '1', 'fa fa-building', 1),
(17, 15, 'Produk', 'shop/sproduk', '1', 'fa fa-product-hunt', 2),
(18, 15, 'Pemesanan', 'shop/sorder', '1', 'fa  fa-shopping-cart', 3),
(20, 15, 'Pengiriman', 'shop/sshipment', '1', 'fa fa-truck', 5),
(21, 15, 'Riwayat', 'shop/shistory', '1', 'fa fa-history', 6),
(22, 15, 'Pembayaran', 'shop/spayment', '1', 'fa fa-money', 4),
(28, 1, 'Notifikasi', 'sistem/notif', '0', 'fa fa-bell', 9),
(31, 0, 'Konten', 'konten/all', '1', 'fa  fa-inbox', 3),
(32, 31, 'Navigasi', 'konten/navigasi', '1', 'fa fa-list', 1),
(33, 31, 'Halaman', 'konten/halaman', '1', 'fa fa-book', 2),
(34, 31, 'Galeri', 'konten/galeri', '1', 'fa fa-image', 3),
(35, 31, 'File Server', 'konten/file', '1', 'fa fa-file', 4);

-- --------------------------------------------------------

--
-- Table structure for table `yk_menu_aksi`
--

CREATE TABLE `yk_menu_aksi` (
  `id_menu_aksi` int NOT NULL,
  `id_menu` int DEFAULT NULL,
  `id_aksi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_menu_aksi`
--

INSERT INTO `yk_menu_aksi` (`id_menu_aksi`, `id_menu`, `id_aksi`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 2, 3),
(5, 2, 4),
(6, 3, 1),
(7, 3, 2),
(8, 3, 3),
(9, 3, 4),
(10, 4, 1),
(11, 4, 2),
(12, 4, 3),
(13, 4, 4),
(14, 5, 1),
(15, 5, 3),
(20, 7, 1),
(21, 7, 3),
(22, 8, 1),
(23, 8, 3),
(24, 9, 1),
(25, 9, 3),
(26, 10, 1),
(37, 13, 1),
(38, 13, 2),
(39, 13, 3),
(40, 13, 4),
(41, 13, 5),
(42, 14, 1),
(43, 14, 2),
(44, 14, 3),
(45, 14, 4),
(46, 14, 5),
(47, 15, 1),
(53, 17, 1),
(54, 17, 2),
(55, 17, 3),
(56, 17, 4),
(57, 17, 5),
(58, 18, 1),
(59, 18, 2),
(60, 18, 3),
(61, 18, 4),
(62, 18, 5),
(68, 20, 1),
(69, 20, 2),
(70, 20, 3),
(71, 20, 4),
(72, 20, 5),
(73, 21, 1),
(74, 21, 2),
(75, 21, 3),
(76, 21, 4),
(77, 21, 5),
(78, 21, 6),
(79, 21, 7),
(80, 18, 6),
(81, 18, 7),
(84, 20, 6),
(85, 20, 7),
(86, 22, 1),
(87, 22, 2),
(88, 22, 3),
(89, 22, 4),
(90, 22, 5),
(112, 28, 1),
(113, 28, 2),
(115, 28, 4),
(116, 3, 5),
(125, 5, 2),
(126, 5, 4),
(127, 31, 1),
(128, 32, 1),
(129, 32, 2),
(130, 32, 3),
(131, 32, 4),
(132, 33, 1),
(133, 33, 2),
(134, 33, 3),
(135, 33, 4),
(136, 34, 1),
(137, 34, 2),
(138, 34, 3),
(139, 34, 4),
(140, 35, 1),
(141, 35, 2),
(142, 35, 3),
(143, 35, 4);

-- --------------------------------------------------------

--
-- Table structure for table `yk_notif`
--

CREATE TABLE `yk_notif` (
  `id_notif` int NOT NULL,
  `from_id` int DEFAULT NULL,
  `send_id` int NOT NULL,
  `status_notif` enum('0','1') DEFAULT NULL,
  `subject_notif` varchar(50) DEFAULT NULL,
  `msg_notif` text,
  `buat_notif` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `link_notif` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_notif`
--

INSERT INTO `yk_notif` (`id_notif`, `from_id`, `send_id`, `status_notif`, `subject_notif`, `msg_notif`, `buat_notif`, `link_notif`) VALUES
(1, 3, 2, '0', 'Pemesanan Produk', 'Anda mendapatkan pemesanan terbaru. Silahkan cek menu Pemesanan', '2023-10-01 10:51:26', 'shop/sorder/detail/QkFJWHBKMWg1eEVVczJRUFJNYSttQT09'),
(2, NULL, 3, '0', 'Pemesanan Produk', 'Pemesanan anda berhasil dibuat. Harap menunggu permintaan agar segera di proses', '2023-10-01 10:51:26', 'order/detail/QkFJWHBKMWg1eEVVczJRUFJNYSttQT09');

-- --------------------------------------------------------

--
-- Table structure for table `yk_site_log`
--

CREATE TABLE `yk_site_log` (
  `site_log_id` int UNSIGNED NOT NULL,
  `no_of_visits` int UNSIGNED NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `requested_url` tinytext NOT NULL,
  `referer_page` tinytext NOT NULL,
  `page_name` tinytext NOT NULL,
  `query_string` tinytext NOT NULL,
  `user_agent` tinytext NOT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `access_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `yk_user`
--

CREATE TABLE `yk_user` (
  `id_user` int NOT NULL,
  `id_group` int NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status_user` enum('1','0') DEFAULT '0',
  `buat_user` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` datetime DEFAULT NULL,
  `log_user` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ip_user` varchar(100) DEFAULT NULL,
  `foto_user` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_user`
--

INSERT INTO `yk_user` (`id_user`, `id_group`, `fullname`, `username`, `email`, `password`, `status_user`, `buat_user`, `update_user`, `log_user`, `last_login`, `ip_user`, `foto_user`) VALUES
(1, 1, 'Administrator', 'admin', 'galihbayu17@gmail.com', '$2y$10$3jETlonRpoUXg2/N416LdOZJXWDoINCLJBuj2GaL7R3XTl1H8l5Ka', '1', '2017-07-18 05:12:37', '2020-06-24 14:13:53', 'Administrator Login Sistem with Switch Account', '2023-12-01 21:29:46', '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', 'app/upload/profil/administrator-fq0k-300-300.jpg'),
(2, 2, 'Fira Papua', 'papua', NULL, '$2y$10$3jETlonRpoUXg2/N416LdOZJXWDoINCLJBuj2GaL7R3XTl1H8l5Ka', '1', '2020-06-22 03:11:54', NULL, 'Fira Papua Login Sistem', '2020-07-01 16:59:55', '::1 | Desktop  - Linux | Chrome 80.0.3987.163', NULL),
(3, 3, 'Pelanggan Contoh', 'plgn4', 'galihbayu172@gmail.com', '$2y$10$XVZKEs8V7M0rB6Mft1E0tusvdR4jrkI9yLc8YZKxyX2uLsslxvt4m', '1', '2018-11-07 14:18:16', '2021-11-09 15:26:09', 'Pelanggan Contoh Login Sistem', '2023-12-01 21:37:29', '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yk_user_log`
--

CREATE TABLE `yk_user_log` (
  `user_id` int NOT NULL,
  `ip_log` varchar(100) DEFAULT NULL,
  `buat_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `msg_log` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yk_user_log`
--

INSERT INTO `yk_user_log` (`user_id`, `ip_log`, `buat_log`, `msg_log`) VALUES
(1, '::1 | Desktop  - Linux | Chrome 93.0.4577.63', '2021-11-09 06:16:37', 'Administrator Login Sistem'),
(1, '::1 | Desktop  - Linux | Chrome 93.0.4577.63', '2021-11-09 06:16:44', 'Administrator Login Sistem with Switch Account'),
(1, '::1 | Desktop  - Linux | Chrome 93.0.4577.63', '2021-11-09 06:25:28', 'Administrator Login Sistem with Switch Account'),
(3, '::1 | Desktop  - Linux | Chrome 93.0.4577.63', '2021-11-09 06:25:58', 'Pelanggan Contoh Login Sistem'),
(3, '::1 | Desktop  - Linux | Chrome 93.0.4577.63', '2021-11-09 06:26:09', 'Pelanggan Contoh Ubah Profil User'),
(1, '::1 | Desktop  - Linux | Chrome 93.0.4577.63', '2021-11-09 06:27:40', 'Administrator Login Sistem with Switch Account'),
(1, '::1 | Desktop  - Linux | Chrome 115.0.0.0', '2023-09-22 04:26:47', 'Administrator Login Sistem'),
(3, '::1 | Desktop  - Linux | Chrome 115.0.0.0', '2023-09-22 04:27:16', 'Pelanggan Contoh Login Sistem'),
(1, '::1 | Desktop  - Linux | Chrome 115.0.0.0', '2023-09-22 04:27:48', 'Administrator Login Sistem'),
(1, '::1 | Desktop  - Linux | Chrome 115.0.0.0', '2023-09-22 04:28:02', 'Administrator Login Sistem with Switch Account'),
(1, '::1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-24 08:01:50', 'Administrator Login Sistem'),
(1, '::1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-24 08:03:10', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-25 05:53:18', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-25 05:53:40', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-25 05:57:31', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-25 08:33:32', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 116.0.0.0', '2023-09-25 08:34:05', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 17:19:58', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 18:00:18', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:09:43', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:09:53', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:17:55', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:32:53', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:33:04', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:33:19', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-09-30 19:45:15', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-01 10:49:03', 'Administrator Login Sistem'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-01 10:50:45', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-02 06:43:24', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-02 06:43:43', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-02 08:10:50', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-02 08:59:14', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-02 08:59:24', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 18:31:17', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 18:31:49', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 18:50:23', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 19:15:24', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 19:15:33', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 19:16:05', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 19:16:22', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-05 19:19:00', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-09 04:46:37', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 117.0.0.0', '2023-10-09 04:46:50', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 118.0.0.0', '2023-10-12 13:50:37', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 118.0.0.0', '2023-10-12 13:50:59', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 118.0.0.0', '2023-10-15 16:49:42', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 118.0.0.0', '2023-10-15 17:01:18', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 118.0.0.0', '2023-10-15 17:01:40', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 17:35:26', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 17:41:22', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 17:42:06', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 18:34:14', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 18:37:06', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 19:12:04', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 19:20:11', 'Pelanggan Contoh Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 20:38:40', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-20 20:38:59', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 05:05:04', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 05:07:30', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 05:07:56', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 05:23:37', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 05:27:17', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 08:27:40', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 08:52:04', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 09:05:32', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 09:21:57', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 10:43:54', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 10:44:58', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 20:17:00', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 20:34:09', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 20:46:00', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-21 20:48:47', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-22 08:37:38', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-27 04:31:30', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-27 04:45:20', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-28 08:55:03', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-28 08:56:03', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-29 08:52:38', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-11-29 08:53:03', 'Administrator Login Sistem with Switch Account'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-12-01 10:19:20', 'Administrator Login Sistem'),
(1, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-12-01 10:22:26', 'Administrator Login Sistem with Switch Account'),
(3, '127.0.0.1 | Desktop  - Windows 10 | Chrome 119.0.0.0', '2023-12-01 14:34:09', 'Pelanggan Contoh Login Sistem');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_costumer`
--
ALTER TABLE `m_costumer`
  ADD PRIMARY KEY (`id_costumer`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `m_favorit`
--
ALTER TABLE `m_favorit`
  ADD KEY `costumer_id` (`costumer_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `m_item`
--
ALTER TABLE `m_item`
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `m_order`
--
ALTER TABLE `m_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `costumer` (`costumer_id`);

--
-- Indexes for table `m_produk`
--
ALTER TABLE `m_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `kategori` (`kategori_id`);

--
-- Indexes for table `m_review`
--
ALTER TABLE `m_review`
  ADD KEY `user` (`costumer_id`),
  ADD KEY `produk` (`produk_id`);

--
-- Indexes for table `rf_file`
--
ALTER TABLE `rf_file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `rf_galeri`
--
ALTER TABLE `rf_galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `rf_nav`
--
ALTER TABLE `rf_nav`
  ADD PRIMARY KEY (`id_nav`);

--
-- Indexes for table `rf_page`
--
ALTER TABLE `rf_page`
  ADD PRIMARY KEY (`id_page`);

--
-- Indexes for table `yk_aksi`
--
ALTER TABLE `yk_aksi`
  ADD PRIMARY KEY (`id_aksi`);

--
-- Indexes for table `yk_aplikasi`
--
ALTER TABLE `yk_aplikasi`
  ADD PRIMARY KEY (`id_aplikasi`);

--
-- Indexes for table `yk_group`
--
ALTER TABLE `yk_group`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `yk_group_menu_aksi`
--
ALTER TABLE `yk_group_menu_aksi`
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_menu_aksi` (`id_menu_aksi`);

--
-- Indexes for table `yk_group_role`
--
ALTER TABLE `yk_group_role`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `yk_menu`
--
ALTER TABLE `yk_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `yk_menu_aksi`
--
ALTER TABLE `yk_menu_aksi`
  ADD PRIMARY KEY (`id_menu_aksi`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_aksi` (`id_aksi`);

--
-- Indexes for table `yk_notif`
--
ALTER TABLE `yk_notif`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `send_id` (`send_id`),
  ADD KEY `from_id` (`from_id`);

--
-- Indexes for table `yk_site_log`
--
ALTER TABLE `yk_site_log`
  ADD PRIMARY KEY (`site_log_id`);

--
-- Indexes for table `yk_user`
--
ALTER TABLE `yk_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_group` (`id_group`);

--
-- Indexes for table `yk_user_log`
--
ALTER TABLE `yk_user_log`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_costumer`
--
ALTER TABLE `m_costumer`
  MODIFY `id_costumer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `m_order`
--
ALTER TABLE `m_order`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_produk`
--
ALTER TABLE `m_produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rf_file`
--
ALTER TABLE `rf_file`
  MODIFY `id_file` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rf_galeri`
--
ALTER TABLE `rf_galeri`
  MODIFY `id_galeri` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rf_nav`
--
ALTER TABLE `rf_nav`
  MODIFY `id_nav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rf_page`
--
ALTER TABLE `rf_page`
  MODIFY `id_page` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `yk_aksi`
--
ALTER TABLE `yk_aksi`
  MODIFY `id_aksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `yk_aplikasi`
--
ALTER TABLE `yk_aplikasi`
  MODIFY `id_aplikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `yk_group`
--
ALTER TABLE `yk_group`
  MODIFY `id_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yk_menu`
--
ALTER TABLE `yk_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `yk_menu_aksi`
--
ALTER TABLE `yk_menu_aksi`
  MODIFY `id_menu_aksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `yk_notif`
--
ALTER TABLE `yk_notif`
  MODIFY `id_notif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yk_site_log`
--
ALTER TABLE `yk_site_log`
  MODIFY `site_log_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yk_user`
--
ALTER TABLE `yk_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_costumer`
--
ALTER TABLE `m_costumer`
  ADD CONSTRAINT `m_costumer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `yk_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_favorit`
--
ALTER TABLE `m_favorit`
  ADD CONSTRAINT `m_favorit_ibfk_1` FOREIGN KEY (`costumer_id`) REFERENCES `m_costumer` (`id_costumer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `m_favorit_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `m_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_item`
--
ALTER TABLE `m_item`
  ADD CONSTRAINT `m_item_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `m_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `m_item_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `m_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_order`
--
ALTER TABLE `m_order`
  ADD CONSTRAINT `m_order_ibfk_1` FOREIGN KEY (`costumer_id`) REFERENCES `m_costumer` (`id_costumer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_produk`
--
ALTER TABLE `m_produk`
  ADD CONSTRAINT `m_produk_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `m_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_review`
--
ALTER TABLE `m_review`
  ADD CONSTRAINT `m_review_ibfk_1` FOREIGN KEY (`costumer_id`) REFERENCES `m_costumer` (`id_costumer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `m_review_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `m_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yk_group_menu_aksi`
--
ALTER TABLE `yk_group_menu_aksi`
  ADD CONSTRAINT `yk_group_menu_aksi_ibfk_1` FOREIGN KEY (`id_menu_aksi`) REFERENCES `yk_menu_aksi` (`id_menu_aksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yk_group_menu_aksi_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `yk_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yk_group_role`
--
ALTER TABLE `yk_group_role`
  ADD CONSTRAINT `yk_group_role_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `yk_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yk_group_role_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `yk_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yk_menu_aksi`
--
ALTER TABLE `yk_menu_aksi`
  ADD CONSTRAINT `yk_menu_aksi_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `yk_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yk_menu_aksi_ibfk_2` FOREIGN KEY (`id_aksi`) REFERENCES `yk_aksi` (`id_aksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yk_notif`
--
ALTER TABLE `yk_notif`
  ADD CONSTRAINT `yk_notif_ibfk_2` FOREIGN KEY (`send_id`) REFERENCES `yk_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yk_notif_ibfk_3` FOREIGN KEY (`from_id`) REFERENCES `yk_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yk_user`
--
ALTER TABLE `yk_user`
  ADD CONSTRAINT `yk_user_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `yk_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yk_user_log`
--
ALTER TABLE `yk_user_log`
  ADD CONSTRAINT `yk_user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `yk_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
