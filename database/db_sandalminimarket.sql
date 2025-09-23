-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2025 at 04:13 PM
-- Server version: 11.8.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_myfurniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(10) NOT NULL,
  `nm_admin` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nm_admin`, `username`, `email`, `password`) VALUES
(1, 'administrator', 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `id_detail_order` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `nm_produk` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL,
  `jml_order` int(3) NOT NULL,
  `berat` int(10) NOT NULL,
  `subberat` int(10) NOT NULL,
  `subharga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_detail_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_kat_pos`
--

CREATE TABLE `tbl_kat_pos` (
  `id_kategori` int(10) NOT NULL,
  `nm_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kat_pos`
--

INSERT INTO `tbl_kat_pos` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Tips Perawatan Sendal'),
(2, 'Tren Fashion Sendal'),
(3, 'Panduan Memilih Sendal'),
(4, 'Promo dan Diskon'),
(5, 'Review Produk'),
(6, 'Gaya Hidup Sehat'),
(7, 'Berita Toko'),
(8, 'Tutorial Style'),
(9, 'Event dan Aktivitas'),
(10, 'Kesehatan Kaki');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kat_produk`
--

CREATE TABLE `tbl_kat_produk` (
  `id_kategori` int(10) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kat_produk`
--

INSERT INTO `tbl_kat_produk` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Sendal Jepit'),
(2, 'Sendal Gunung'),
(3, 'Sendal Selop'),
(4, 'Sendal Anak'),
(5, 'Sendal Wanita'),
(6, 'Sendal Pria'),
(7, 'Sendal Olahraga'),
(8, 'Sendal Rumah'),
(9, 'Sendal Karet'),
(10, 'Sendal Kulit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `nm_penerima` varchar(30) NOT NULL DEFAULT '',
  `telp` varchar(13) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `alamat_pengiriman` varchar(50) NOT NULL,
  `tgl_order` date NOT NULL,
  `ongkir` int(10) NOT NULL,
  `total_order` int(10) NOT NULL,
  `status` varchar(30) DEFAULT 'Belum Dibayar',
  `no_resi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `id_pelanggan`, `nm_penerima`, `telp`, `provinsi`, `kota`, `kode_pos`, `alamat_pengiriman`, `tgl_order`, `ongkir`, `total_order`, `status`, `no_resi`) VALUES
(80, 1, 'jjjkk', '9898989898', '18', '458', 88787, 'kklklkl', '2019-12-27', 0, 3161500, 'Menyiapkan Produk', ''),
(82, 1, 'Terbaru', '88787878787', '14', '296', 787878, 'kjkjkjkjkj', '2019-12-27', 1125000, 8424000, 'Produk Diterima', '55454dgdgdg'),
(83, 1, 'Jack Ber', '997997979', '14', '221', 87878, 'hjhjhjhjhj', '2019-12-27', 1100000, 4395000, 'Produk Dikirim', 'A65AS6AS6SA7A'),
(84, 1, 'jkj', '87878787878', '15', '215', 87878, 'hjsdsd', '2019-12-27', 950000, 1249000, 'Sudah Dibayar', NULL),
(85, 1, 'Arif', '081225789373', '10', '249', 76253, 'Jalan Suka Aku', '2019-12-30', 400000, 8295000, 'Belum Dibayar', NULL),
(86, 4, 'Bintang Reny', '082255305424', '14', '205', 74114, 'Jl.Pakanegara Gg.Ramania', '2020-01-08', 1000000, 1899000, 'Belum Dibayar', NULL),
(87, 5, 'Rizal Wijoyo', '85652385926', '5', '419', 78212, 'Jl.Turi 6. NO 153', '2020-01-08', 250000, 4248000, 'Sudah Dibayar', NULL),
(88, 1, '1222221212', '08754323332', '5', '39', 55792, '121341414', '2020-01-10', 250000, 17348000, 'Sudah Dibayar', NULL),
(89, 7, 'Wisnu Nugroho Aji', '0817779996858', '5', '501', 55223, 'Terban', '2020-01-11', 250000, 40747000, 'Belum Dibayar', NULL),
(90, 1, 'Arief Gilang', '0812266537363', '10', '196', 57474, 'Jl Suka saya', '2020-01-11', 450000, 67945000, 'Produk Diterima', 'A65AS6AS6SA7A'),
(91, 7, 'Wisnu Nugroho Aji', '087846915184', '2', '56', 12223, 'Situ', '2020-01-11', 600000, 5997000, 'Belum Dibayar', NULL),
(92, 8, 'user', '0127381723', '1', '17', 57463, 'Burikan,Cawas,Klaten', '2025-07-05', 50000, 13499000, 'Produk Diterima', '001'),
(93, 8, 'Agus Kabel', '0821390123', '11', '42', 57463, 'Burikan,Cawas,Klaten', '2025-07-05', 50000, 2499000, 'Belum Dibayar', NULL),
(94, 8, 'user', '082137819238', '2', '27', 57463, 'Burikan,Cawas,Klaten', '2025-07-05', 50000, 899000, 'Belum Dibayar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(10) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nm_pelanggan`, `username`, `email`, `password`) VALUES
(1, 'Arif Nur R', 'arifnur', 'arif@gmail.com', '123'),
(2, 'Arief Gilang', 'ariefgilan', 'arief@gmail.com', '123'),
(4, ' Bintang Reny', 'Bintang', 'Bintangre10@gmail.com', 'Kepo56789_'),
(5, ' Rizal Wijoyo', 'Rizal', 'Wijal16@gmail.com', 'Kambing123'),
(6, ' aris Juliyanto', 'aris', 'aris@gmail.com', '12345'),
(7, ' Wisnu', 'Ajik', 'wisnu@gmail.com', '123456'),
(8, ' user', 'user', 'user@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `nm_pembayar` varchar(30) NOT NULL,
  `nm_bank` varchar(20) NOT NULL,
  `jml_pembayaran` int(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_transfer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_order`, `nm_pembayar`, `nm_bank`, `jml_pembayaran`, `tgl_bayar`, `bukti_transfer`) VALUES
(7, 80, 'Jack Berwin', 'Mandiri', 889778888, '2019-12-27', '7.jpeg'),
(8, 82, 'JAck Berwin', 'MANDIRI', 789977667, '2019-12-27', 'sky.jpg'),
(9, 83, 'JackBer', 'BCA', 2147483647, '2019-12-27', '10.jpg'),
(10, 87, 'Rizal Wijoyo', 'Bank Bersama', 4248000, '2020-01-08', 'userphoto.png'),
(11, 84, '', '', 0, '2020-01-10', '9.jpg'),
(12, 88, '1212', '1212', 17348000, '2020-01-10', '5.jpg'),
(13, 90, 'Arief Gilang', 'BRI', 67945000, '2020-01-11', '8.jpg'),
(14, 92, 'user', 'Mandiri', 13499000, '2025-07-05', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pos`
--

CREATE TABLE `tbl_pos` (
  `id_pos` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` longtext NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pos`
--

INSERT INTO `tbl_pos` (`id_pos`, `id_kategori`, `judul`, `isi`, `gambar`, `tgl`) VALUES
(1, 1, 'Cara Merawat Sendal Kulit Agar Awet dan Tahan Lama', '<p>Sendal kulit adalah investasi yang baik untuk kenyamanan kaki Anda. Namun, untuk menjaga agar sendal kulit tetap awet dan tahan lama, diperlukan perawatan yang tepat.</p>\r\n<p>Pertama, bersihkan sendal secara rutin dengan kain lembab dan sabun khusus kulit. Hindari penggunaan air berlebihan yang dapat merusak tekstur kulit.</p>\r\n<p>Kedua, gunakan pelembab kulit atau leather conditioner setiap 2-3 bulan untuk menjaga kelembaban dan mencegah kulit pecah-pecah.</p>\r\n<p>Ketiga, simpan sendal di tempat yang kering dan sejuk, hindari paparan sinar matahari langsung yang dapat membuat kulit menjadi kering dan pudar.</p>\r\n<p>Terakhir, gunakan shoe tree atau isian kertas untuk menjaga bentuk sendal saat tidak digunakan.</p>', '1.jpg', '2025-06-15'),
(2, 2, 'Tren Sendal Wanita 2025: Gaya yang Sedang Hits', '<p>Tahun 2025 membawa berbagai tren sendal wanita yang menarik dan stylish. Dari model minimalis hingga yang penuh dengan detail, ada banyak pilihan untuk mengekspresikan gaya pribadi Anda.</p>\n<p>Tren pertama adalah sendal dengan tali chunky atau tebal. Model ini memberikan kesan bold dan modern, cocok untuk dipadukan dengan outfit kasual maupun semi formal.</p>\n<p>Tren kedua adalah sendal dengan platform tinggi namun nyaman. Kombinasi tinggi dan kenyamanan menjadi kunci utama dalam tren ini.</p>\n<p>Warna-warna earth tone seperti beige, coklat, dan nude masih mendominasi pilihan warna. Namun, aksen metalik seperti gold dan silver juga mulai populer.</p>\n<p>Jangan lupa untuk memilih sendal yang sesuai dengan bentuk kaki dan aktivitas sehari-hari Anda!</p>', '2.jpg', '2025-06-20'),
(3, 3, 'Panduan Lengkap Memilih Sendal yang Tepat untuk Kaki Anda', '<p>Memilih sendal yang tepat bukan hanya soal penampilan, tetapi juga kenyamanan dan kesehatan kaki. Berikut panduan lengkap untuk membantu Anda memilih sendal yang ideal.</p>\r\n<p>Pertama, kenali bentuk kaki Anda. Apakah Anda memiliki kaki datar, lengkung tinggi, atau normal? Setiap bentuk kaki membutuhkan dukungan yang berbeda.</p>\r\n<p>Kedua, pertimbangkan aktivitas yang akan Anda lakukan. Sendal untuk jalan-jalan santai berbeda dengan sendal untuk hiking atau aktivitas outdoor lainnya.</p>\r\n<p>Ketiga, perhatikan material sendal. Kulit asli lebih tahan lama namun memerlukan perawatan khusus. Karet lebih mudah dibersihkan namun mungkin tidak se-breathable kulit.</p>\r\n<p>Keempat, pastikan ukuran yang pas. Sendal yang terlalu sempit dapat menyebabkan lecet, sedangkan yang terlalu longgar dapat menyebabkan kaki mudah lelah.</p>\r\n<p>Terakhir, jangan lupakan faktor budget. Investasi pada sendal berkualitas akan menghemat pengeluaran jangka panjang.</p>', '3.jpg', '2025-06-25'),
(4, 4, 'Promo Spesial Ramadan: Diskon hingga 50% untuk Semua Jenis Sendal', '<p>Menyambut bulan suci Ramadan, toko sendal kami memberikan promo spesial yang sayang untuk dilewatkan! Dapatkan diskon hingga 50% untuk semua jenis sendal.</p>\r\n<p>Promo ini berlaku untuk semua kategori sendal, mulai dari sendal jepit, sendal gunung, hingga sendal formal. Periode promo dimulai dari 1 Ramadan hingga 15 Syawal.</p>\r\n<p>Khusus untuk pembelian sendal dengan harga di atas Rp 200.000, Anda akan mendapatkan bonus tas kecil yang eksklusif dan limited edition.</p>\r\n<p>Jangan lewatkan kesempatan emas ini untuk memperbarui koleksi sendal Anda atau membelinya sebagai hadiah untuk orang tercinta.</p>\r\n<p>Syarat dan ketentuan berlaku. Promo tidak dapat digabung dengan promo lainnya. Persediaan terbatas, jadi datang sekarang juga!</p>', '4.jpg', '2025-03-01'),
(5, 5, 'Review Sendal Adidas Adilette: Kenyamanan yang Tak Tertandingi', '<p>Sendal Adidas Adilette telah menjadi pilihan favorit para atlet dan pecinta olahraga selama bertahun-tahun. Setelah menggunakan sendal ini selama 6 bulan, berikut review lengkap dari tim kami.</p>\r\n<p>Dari segi kenyamanan, sendal ini memberikan bantalan yang sangat baik untuk kaki. Material EVA yang digunakan mampu menyerap tekanan dengan sempurna, sehingga kaki tidak mudah lelah meski digunakan dalam waktu lama.</p>\r\n<p>Desain yang simpel namun iconic membuat sendal ini cocok dipadukan dengan berbagai outfit, dari pakaian olahraga hingga kasual sehari-hari.</p>\r\n<p>Kualitas material sangat baik dan tahan lama. Setelah 6 bulan penggunaan intensif, sendal masih dalam kondisi prima tanpa kerusakan berarti.</p>\r\n<p>Harga memang sedikit lebih tinggi dibanding sendal biasa, namun sebanding dengan kualitas dan kenyamanan yang diberikan. Rating: 9/10!</p>', '5.jpg', '2025-06-30'),
(6, 6, 'Manfaat Jalan Kaki dengan Sendal yang Tepat untuk Kesehatan', '<p>Jalan kaki adalah salah satu olahraga paling sederhana namun memberikan manfaat luar biasa untuk kesehatan. Namun, pemilihan sendal yang tepat sangat penting untuk memaksimalkan manfaat ini.</p>\r\n<p>Sendal yang baik untuk jalan kaki harus memiliki sol yang empuk untuk menyerap impact saat kaki menyentuh tanah. Hal ini dapat mengurangi risiko cedera pada lutut dan pinggul.</p>\r\n<p>Jalan kaki rutin selama 30 menit setiap hari dapat membantu menurunkan risiko penyakit jantung, diabetes, dan obesitas. Dengan sendal yang nyaman, Anda akan lebih termotivasi untuk berjalan kaki secara teratur.</p>\r\n<p>Pastikan sendal memiliki ventilasi yang baik untuk menjaga kaki tetap kering dan mencegah timbulnya jamur atau bakteri.</p>\r\n<p>Mulailah dengan jarak pendek dan tingkatkan secara bertahap. Dengarkan tubuh Anda dan jangan memaksakan diri jika merasa tidak nyaman.</p>', '6.jpg', '2025-07-01'),
(7, 7, 'Grand Opening Cabang Baru: Kini Hadir di Mall Central Park', '<p>Kami dengan bangga mengumumkan pembukaan cabang baru toko sendal kami di Mall Central Park! Setelah sukses melayani pelanggan selama bertahun-tahun, kini kami hadir lebih dekat dengan Anda.</p>\r\n<p>Cabang baru ini mengusung konsep modern dengan display yang lebih luas dan nyaman. Anda dapat mencoba semua produk dengan lebih leluasa dan mendapat pelayanan yang lebih personal.</p>\r\n<p>Untuk merayakan grand opening, kami memberikan promo khusus berupa diskon 30% untuk semua produk selama 2 minggu pertama. Tersedia juga door prize menarik setiap harinya.</p>\r\n<p>Lokasi strategis di lantai 2 Mall Central Park memudahkan akses dengan transportasi umum maupun kendaraan pribadi. Tersedia juga fasilitas parkir yang luas.</p>\r\n<p>Tim customer service kami siap membantu Anda menemukan sendal yang sempurna sesuai kebutuhan. Datang dan rasakan pengalaman berbelanja yang berbeda!</p>', '7.jpg', '2025-07-02'),
(8, 8, 'Tutorial Mix and Match Sendal dengan Outfit Kasual', '<p>Sendal bukan hanya alas kaki, tetapi juga aksesori fashion yang dapat mempercantik penampilan Anda. Berikut tutorial mix and match sendal dengan outfit kasual yang stylish.</p>\r\n<p>Untuk look kasual sehari-hari, padukan sendal jepit dengan celana pendek dan kaos polos. Pilih warna sendal yang senada atau kontras dengan outfit untuk tampilan yang lebih menarik.</p>\r\n<p>Sendal wedges cocok dipadukan dengan dress midi atau celana kulot untuk tampilan semi formal yang tetap nyaman. Tambahkan aksesori seperti tas selempang kecil untuk melengkapi look.</p>\r\n<p>Jika ingin tampil sporty, gunakan sendal gunung dengan celana hiking dan kaos outdoor. Gaya ini perfect untuk aktivitas alam atau traveling.</p>\r\n<p>Untuk tampilan bohemian, padukan sendal strappy dengan maxi dress dan aksesori vintage. Kombinasi ini akan memberikan kesan free-spirited yang menarik.</p>\r\n<p>Ingat, kunci utama adalah confidence. Pilih kombinasi yang membuat Anda merasa nyaman dan percaya diri!</p>', '8.jpg', '2025-07-03'),
(9, 9, 'Event Fashion Show Sendal Terbaru: Saksikan Koleksi Eksklusif Kami', '<p>Jangan lewatkan event fashion show spektakuler yang akan menampilkan koleksi sendal terbaru dari brand-brand ternama! Acara ini akan berlangsung pada tanggal 15 Juli 2025 di Grand Ballroom Hotel Mulia.</p>\r\n<p>Fashion show ini akan menampilkan lebih dari 50 model sendal terbaru dari berbagai kategori. Mulai dari sendal kasual hingga formal, semuanya akan dipamerkan dalam runway yang memukau.</p>\r\n<p>Sebagai tamu undangan, Anda akan mendapat kesempatan untuk melihat koleksi eksklusif yang belum tersedia di pasaran. Tersedia juga pre-order dengan harga spesial.</p>\r\n<p>Acara ini juga akan menghadirkan talk show dengan fashion stylist terkenal yang akan berbagi tips memilih dan memadukan sendal dengan outfit yang tepat.</p>\r\n<p>Tiket masuk gratis namun terbatas untuk 200 orang pertama. Daftar sekarang melalui website atau datang langsung ke toko kami. Jangan sampai terlewat!</p>', '9.jpg', '2025-07-04'),
(10, 10, 'Pentingnya Memilih Sendal yang Tepat untuk Kesehatan Kaki', '<p>Kesehatan kaki sering diabaikan, padahal kaki merupakan fondasi tubuh yang menopang seluruh aktivitas kita. Pemilihan sendal yang tepat berperan penting dalam menjaga kesehatan kaki jangka panjang.</p>\r\n<p>Sendal yang terlalu datar dapat menyebabkan plantar fasciitis, yaitu peradangan pada jaringan yang menghubungkan tumit dengan jari kaki. Pilih sendal dengan arch support yang adequate.</p>\r\n<p>Material yang tidak breathable dapat menyebabkan jamur dan bakteri berkembang biak. Pilih sendal dengan material yang memungkinkan sirkulasi udara yang baik.</p>\r\n<p>Heel yang terlalu tinggi dapat menyebabkan masalah pada postur tubuh dan nyeri punggung. Pilih tinggi heel yang sesuai dengan aktivitas dan durasi pemakaian.</p>\r\n<p>Konsultasikan dengan dokter kaki jika Anda memiliki kondisi khusus seperti diabetes, arthritis, atau masalah kaki lainnya. Mereka dapat memberikan rekomendasi sendal yang sesuai dengan kondisi Anda.</p>\r\n<p>Investasi pada sendal berkualitas adalah investasi untuk kesehatan kaki jangka panjang Anda.</p>', '10.jpg', '2025-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nm_produk` varchar(50) NOT NULL,
  `berat` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(3) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_kategori`, `nm_produk`, `berat`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(1, 1, 'Sendal Jepit Swallow Classic Hitam', 200, 25000, 50, '1.jpg', 'Sendal jepit klasik dengan kualitas terbaik, nyaman digunakan sehari-hari'),
(2, 1, 'Sendal Jepit Swallow Classic Biru', 200, 25000, 45, '2.jpg', 'Sendal jepit klasik warna biru, tahan lama dan anti slip'),
(3, 1, 'Sendal Jepit GSJ Rainbow', 180, 22000, 60, '3.jpg', 'Sendal jepit dengan motif pelangi, cocok untuk anak muda'),
(4, 1, 'Sendal Jepit Havaianas Top Mix', 220, 45000, 30, '4.jpg', 'Sendal jepit premium dari Brazil dengan kualitas internasional'),
(5, 2, 'Sendal Gunung Eiger Lightspeed', 450, 185000, 25, '5.jpg', 'Sendal gunung dengan teknologi quick dry dan anti slip sole'),
(6, 2, 'Sendal Gunung Consina Amazone', 480, 165000, 20, '6.jpg', 'Sendal gunung dengan tali webbing kuat dan bantalan empuk'),
(7, 2, 'Sendal Gunung Rei Granit', 520, 195000, 18, '7.jpg', 'Sendal gunung outdoor dengan grip maksimal untuk tracking'),
(8, 2, 'Sendal Gunung Outdoor Pro Adventure', 500, 175000, 22, '8.jpg', 'Sendal gunung dengan desain sporty dan material berkualitas'),
(9, 3, 'Sendal Selop Bata Comfort', 300, 85000, 35, '9.jpg', 'Sendal selop dengan bantalan memory foam untuk kenyamanan maksimal'),
(10, 3, 'Sendal Selop Fladeo Casual', 280, 65000, 40, '10.jpg', 'Sendal selop kasual dengan desain modern dan elegan'),
(11, 3, 'Sendal Selop Homyped Relax', 320, 75000, 30, '11.jpg', 'Sendal selop dengan teknologi anti bakteri dan anti bau'),
(12, 4, 'Sendal Anak Karakter Hello Kitty', 150, 35000, 55, '12.jpg', 'Sendal anak dengan karakter Hello Kitty yang lucu dan menarik'),
(13, 4, 'Sendal Anak Cars McQueen', 160, 38000, 48, '13.jpg', 'Sendal anak dengan karakter Cars McQueen, disukai anak laki-laki'),
(14, 4, 'Sendal Anak Frozen Elsa', 150, 35000, 52, '14.jpg', 'Sendal anak dengan karakter Frozen Elsa untuk anak perempuan'),
(15, 4, 'Sendal Anak Doraemon', 155, 32000, 45, '15.jpg', 'Sendal anak dengan karakter Doraemon yang menggemaskan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tbl_kat_pos`
--
ALTER TABLE `tbl_kat_pos`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kat_produk`
--
ALTER TABLE `tbl_kat_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_order2` (`id_order`);

--
-- Indexes for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  ADD PRIMARY KEY (`id_pos`),
  ADD KEY `id_kat_pos` (`id_kategori`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `id_detail_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_kat_pos`
--
ALTER TABLE `tbl_kat_pos`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_kat_produk`
--
ALTER TABLE `tbl_kat_produk`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  MODIFY `id_pos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_produk` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `id_order2` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  ADD CONSTRAINT `id_kat_pos` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kat_pos` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kat_produk` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
