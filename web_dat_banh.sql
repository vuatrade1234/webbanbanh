-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 07, 2024 lúc 02:38 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_dat_banh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBL` int(11) NOT NULL,
  `TenNBL` varchar(255) NOT NULL,
  `binhluan` text NOT NULL,
  `MaSP` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `TraLoi_BL` text DEFAULT NULL,
  `hinhanh` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `SoHD` int(11) NOT NULL,
  `MaHD` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dadathang`
--

CREATE TABLE `dadathang` (
  `MaDDH` int(11) NOT NULL,
  `MaDonH` varchar(20) NOT NULL,
  `tinhtrang` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dadathang`
--

INSERT INTO `dadathang` (`MaDDH`, `MaDonH`, `tinhtrang`, `MaKH`, `date_create`) VALUES
(31, '5224', 2, 1, '2023-12-03 07:41:50'),
(46, '3864', 0, 1, '2023-12-03 07:16:45'),
(47, '883', 0, 1, '2023-12-04 12:43:07'),
(48, '6061', 3, 8, '2023-12-05 14:56:43'),
(49, '6106', 2, 8, '2023-12-07 14:12:35'),
(50, '5311', 2, 10, '2023-12-07 11:07:44'),
(51, '7483', 1, 13, '2023-12-09 02:35:48'),
(52, '2918', 1, 14, '2024-03-07 10:50:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgiasao`
--

CREATE TABLE `danhgiasao` (
  `id` int(11) NOT NULL,
  `sosao` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `MAKH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgiasao`
--

INSERT INTO `danhgiasao` (`id`, `sosao`, `MaSP`, `MAKH`) VALUES
(13, 3, 24, 2),
(14, 4, 24, 2),
(15, 3, 24, 2),
(16, 2, 24, 2),
(17, 5, 24, 2),
(18, 4, 24, 2),
(19, 2, 24, 2),
(20, 4, 31, 1),
(21, 3, 34, 1),
(22, 4, 24, 2),
(23, 4, 24, 2),
(24, 4, 24, 2),
(25, 5, 24, 2),
(26, 4, 32, 2),
(27, 4, 0, 0),
(28, 5, 32, 2),
(29, 3, 32, 2),
(30, 4, 31, 2),
(31, 5, 28, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgiasp`
--

CREATE TABLE `danhgiasp` (
  `ID_DG` int(11) NOT NULL,
  `HoTen` int(11) NOT NULL,
  `Email` int(11) NOT NULL,
  `Ngay` datetime NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `MaSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` int(11) NOT NULL,
  `TenDM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDM`) VALUES
(3, 'Bánh kem'),
(4, 'Bánh mì'),
(5, 'Bánh trung thu'),
(6, 'Bánh SANDWICH'),
(7, 'Bánh bông lan'),
(8, 'Bánh tết'),
(9, 'Tráng miệng'),
(10, 'Bánh mặn'),
(11, 'Bánh ngọt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `id` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `Gia` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `ngaymua` timestamp NOT NULL DEFAULT current_timestamp(),
  `MaDonH` varchar(20) NOT NULL,
  `tinhtrang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`id`, `MaSP`, `TenSP`, `MaKH`, `SoLuong`, `Gia`, `hinhanh`, `ngaymua`, `MaDonH`, `tinhtrang`) VALUES
(84, 40, 'BÁNH DỪA DỨA', 14, 1, '11000', '646465800e.jpg', '2024-03-07 10:01:50', '2918', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvivanchuyen`
--

CREATE TABLE `donvivanchuyen` (
  `MaVC` int(11) NOT NULL,
  `TenVC` varchar(50) NOT NULL,
  `ThoiGianGiaoHangDuKien` datetime NOT NULL,
  `DiaChiGiaoHang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGH` int(11) NOT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `MaSP` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `Gia` varchar(200) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `tinhtrang` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MaGH`, `MaKH`, `MaSP`, `sid`, `TenSP`, `Gia`, `SoLuong`, `hinhanh`, `tinhtrang`) VALUES
(69, 2, 32, 'lop0gteq3tgdrgag3d9mhn0nbd', 'Nước hoa CK', '1174000', 1, '916e893c3b.jpg', 1),
(70, 2, 24, 'lop0gteq3tgdrgag3d9mhn0nbd', 'Serum dưỡng ẩm', '165000', 1, 'ef1d45b579.jpg', 0),
(96, 1, 45, 'lf27spc60f1vufcm6536il4kmt', 'KEM DƯỠNG ẨM PLACENTOR REGENERATING', '630000', 1, '75ea802023.jfif', 0),
(98, 1, 24, 'lf27spc60f1vufcm6536il4kmt', 'SERUM DƯỠNG ẨM TORRIDENT DIVE IN', '165000', 1, 'ec9016cb58.jpg', 1),
(105, 8, 45, '2ack3iffdjsdjalrnru963cft3', 'KEM DƯỠNG ẨM PLACENTOR REGENERATING', '630000', 1, '75ea802023.jfif', 0),
(108, 10, 24, 'n47eu3deef695rsk465hopie6a', 'SERUM DƯỠNG ẨM TORRIDENT DIVE IN', '165000', 1, 'ec9016cb58.jpg', 1),
(109, 8, 27, 'n47eu3deef695rsk465hopie6a', 'KEM NỀN FITME', '250000', 1, 'e26a95c05a.png', 1),
(110, 8, 32, 'n47eu3deef695rsk465hopie6a', 'NƯỚC HOA CK', '1174000', 1, '916e893c3b.jpg', 0),
(111, 11, 27, 'qicluase4ls8vsc3586fne87am', 'KEM NỀN FITME', '250000', 10, 'e26a95c05a.png', 0),
(114, 13, 24, 'qicluase4ls8vsc3586fne87am', 'SERUM DƯỠNG ẨM TORRIDENT DIVE IN', '165000', 1, 'ec9016cb58.jpg', 1),
(115, 0, 45, 'ntl3emk8omrq0jtg5444smn4u0', 'BÁNH MÌ TRỨNG', '9800', 7, 'b5013d4b7f.jpg', 0),
(118, 14, 49, 'ntl3emk8omrq0jtg5444smn4u0', 'BÁNH MÌ TRỨNG', '14000', 1, 'a71be00b7b.jpg', 1),
(119, 0, 62, 'ntl3emk8omrq0jtg5444smn4u0', 'BÁNH KEM SỮA CHUA DÂU', '23000', 1, '881d3ddc62.jpg', 0),
(120, 14, 56, 'ntl3emk8omrq0jtg5444smn4u0', 'Bánh tét', '12000', 1, '698e548e62.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayDatHang` datetime NOT NULL,
  `MaPTTT` int(11) NOT NULL,
  `MaVC` int(11) NOT NULL,
  `MaNV` int(11) NOT NULL,
  `TongTien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotro`
--

CREATE TABLE `hotro` (
  `MaHT` int(11) NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `NoiDung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MAKH` int(11) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` varchar(10) NOT NULL,
  `DiaChi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MAKH`, `Email`, `Username`, `Password`, `HoTen`, `NgaySinh`, `SDT`, `DiaChi`) VALUES
(14, 'nghia@gmail.com', 'nghia', 'ca2b46b4960815fa27f334a13299b552', 'Nghia', '2005-01-01', '0123456789', 'TPHCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKM` int(11) NOT NULL,
  `MaSP` int(11) DEFAULT NULL,
  `GiaGoc` float DEFAULT NULL,
  `GiaKM` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `thutu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `name`, `thutu`) VALUES
(1, 'Tài khoản', 1),
(2, 'Danh mục', 2),
(3, 'Sản phẩm', 3),
(4, 'Thương hiệu', 4),
(5, 'Đơn hàng', 5),
(6, 'Thống kê', 6),
(7, 'Bình luận', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `HoTenNV` varchar(50) NOT NULL,
  `SDTNV` int(11) NOT NULL,
  `DiachiNV` varchar(50) NOT NULL,
  `GioiTinh` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanquyen`
--

CREATE TABLE `phanquyen` (
  `MaQuyen` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `TenQuyen` varchar(255) NOT NULL,
  `url_match` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanquyen`
--

INSERT INTO `phanquyen` (`MaQuyen`, `menu_id`, `TenQuyen`, `url_match`) VALUES
(1, 1, 'Thêm tài khoản', 'useradd\\.php$'),
(2, 1, 'Danh sách tài khoản', 'userlist\\.php$'),
(3, 1, 'Sửa tài khoản', 'useredit\\.php\\?user_id=\\d+$'),
(4, 1, 'Xóa tài khoản', 'del_id=\\d+$'),
(5, 1, 'Phân quyền tài khoản', 'privilegesuser\\.php\\?taikhoan_id=\\d+$'),
(6, 2, 'Danh sách danh mục', 'catlist\\.php$'),
(7, 2, 'Thêm danh mục', 'catadd\\.php$'),
(8, 2, 'Sửa danh mục', 'catedit\\.php\\?catid=\\d+$'),
(9, 2, 'Xóa danh mục', 'catlist=\\d+$'),
(10, 4, 'Danh sách thương hiệu', 'brandlist\\.php$'),
(11, 4, 'Thêm thương hiệu', 'brandadd\\.php$'),
(12, 4, 'Sửa thương hiệu', 'brandedit\\.php\\?brandid=\\d+$'),
(13, 4, 'Xóa thương hiệu', 'brand_id=\\d+$'),
(14, 3, 'Danh sách sản phẩm', 'productlist\\.php$'),
(15, 3, 'Thêm sản phẩm', 'productadd\\.php$'),
(16, 3, 'Sửa sản phẩm', 'productedit\\.php\\?productid=\\d+$'),
(17, 3, 'Xóa sản phẩm', 'productid=\\d+$'),
(18, 3, 'Chi tiết ảnh', 'productimages\\.php\\?productid=\\d+$'),
(20, 5, 'Đơn hàng', 'inbox\\.php$'),
(21, 5, 'Chi tiết đơn hàng', 'customer\\.php\\?customerid=\\d+&order_code=\\d+$'),
(22, 5, 'Tình trạng đơn hàng\r\n', 'inbox\\.php\\?shifid=\\d+$'),
(23, 6, 'Thống kê', 'dashboard\\.php$'),
(24, 7, 'Bình luận', 'comment\\.php$'),
(25, 7, 'Xóa bình luận', 'blid=\\d+$');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuongthucthanhtoan`
--

CREATE TABLE `phuongthucthanhtoan` (
  `MaPTTT` int(11) NOT NULL,
  `TenPTTT` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `MaHA` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `ct_hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`MaHA`, `MaSP`, `ct_hinhanh`) VALUES
(2, 34, 'ce10978bca.jpg'),
(3, 34, '682896cb55.jpg'),
(4, 38, '328d085fed.jpg'),
(5, 38, 'e30fac9f9b.jpg'),
(6, 38, 'a2805b1e73.jfif'),
(7, 38, '8828c1042e.jfif'),
(8, 39, 'bf771d4eec.jfif'),
(9, 39, 'ce28b83e1a.jpg'),
(10, 39, '563faeccd8.jpg'),
(11, 34, 'f449ba7182.jpg'),
(12, 34, '5b4d203de7.jpg'),
(13, 40, '5026fc39c4.jfif'),
(14, 40, '535dcd79c7.jfif'),
(15, 40, 'cd9970f3e0.jfif'),
(16, 41, '2930a67e86.png'),
(17, 41, 'ffd4dc98b5.jfif'),
(18, 42, '1a024a6700.jfif'),
(19, 42, 'b3436ffffd.jfif'),
(20, 42, 'b7f1b67541.jfif'),
(21, 42, '80aaf1ba69.jfif'),
(22, 42, '2b560a6ca9.jfif'),
(23, 43, '501187def9.jfif'),
(24, 43, '8c22758ea8.jfif'),
(25, 43, 'b10d5edc84.jfif'),
(26, 44, '96c8cb1703.jfif'),
(27, 44, 'c8f04e6be8.jfif'),
(28, 44, 'f3f2f8ce66.jfif'),
(29, 33, 'af50f09b51.jpg'),
(30, 33, '613df6f64c.jpg'),
(31, 33, '575202d047.jpg'),
(32, 24, '1e833bc799.jpg'),
(33, 24, '73b3438825.jpg'),
(34, 24, 'f16548d77d.jpg'),
(35, 32, '0335bf95a8.jpg'),
(36, 32, '6138f2d99a.png'),
(37, 31, '1fcf4d0b90.jpg'),
(38, 31, '832499bdb2.jpg'),
(39, 45, 'd4650499f9.jfif'),
(40, 45, '114cb20d2d.jfif'),
(41, 45, '9210fdae19.jfif'),
(42, 45, '74a5e1e078.jpg'),
(43, 45, '05c09fbb06.jpg'),
(44, 45, 'd8d33eed4a.jpg'),
(45, 59, '3825290ca8.jpg'),
(46, 60, '9a2f24488d.jpg'),
(47, 62, '212f0bb259.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(50) NOT NULL,
  `MaDM` int(11) NOT NULL,
  `MaTH` int(11) NOT NULL,
  `MoTa` text NOT NULL,
  `Gia` float NOT NULL,
  `GiaSale` varchar(100) DEFAULT NULL,
  `Type` int(11) NOT NULL,
  `XuatXu` varchar(10) NOT NULL,
  `NgaySX` date NOT NULL,
  `HanSD` varchar(50) NOT NULL,
  `KhoiLuong` varchar(20) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `MaDM`, `MaTH`, `MoTa`, `Gia`, `GiaSale`, `Type`, `XuatXu`, `NgaySX`, `HanSD`, `KhoiLuong`, `SoLuong`, `hinhanh`) VALUES
(40, 'BÁNH DỪA DỨA', 11, 10, '<p class=\"irIKAp\"><span>Th&agrave;nh phần:&nbsp;Bột m&igrave;, đường, bơ, &nbsp;trứng, g&agrave;, sữa, men, dừa, bột nếp, hương liệu,...&nbsp;</span></p>', 11000, '0', 1, 'Việt Nam', '2024-03-07', '2 ngày kể từ ngày sản xuất', '11g', 236, '646465800e.jpg'),
(47, 'Flan Gato Berry Mix', 11, 15, '<ul>\r\n<li><span>Hương thơm v&agrave; m&ugrave;i vị:</span><br />Ngọt dịu &ndash; B&eacute;o nhẹ &ndash; Thơm &ndash;&nbsp;Đắng nhẹ</li>\r\n<li><span>Cấu tr&uacute;c b&aacute;nh:<br /></span>Phần th&acirc;n b&aacute;nh gồm c&aacute;c lớp ch&iacute;nh:<br />+ B&aacute;nh flan<br />+ B&ocirc;ng lan s&ocirc;-c&ocirc;-la<br />Phần trang tr&iacute;: jelly caramel, d&acirc;u tươi, việt quất</li>\r\n<li><span>Phụ kiện tặng k&egrave;m:<br /></span>Dao cắt b&aacute;nh, 1 bộ dĩa v&agrave; muỗng, 10 nến nhỏ (hoặc nến số nếu bạn y&ecirc;u cầu)</li>\r\n</ul>\r\n<p><span><a href=\"https://cailonuong.com/danh-muc-san-pham/banh-flan-gato/\">Flan Gato</a>&nbsp;l&agrave; d&ograve;ng b&aacute;nh m&agrave;&nbsp;<a href=\"https://cailonuong.com/\">C&aacute;i L&ograve; Nướng</a>&nbsp;chiếm ưu thế về sản lượng cung cấp cho thị trường Hồ Ch&iacute; Minh. B&aacute;nh c&oacute; hương vị ngon l&agrave;nh n&ecirc;n người d&ugrave;ng ở mọi lứa tuổi đều y&ecirc;u th&iacute;ch.</span></p>\r\n<p><span>B&aacute;nh c&oacute; hai lớp ch&iacute;nh, đ&oacute; l&agrave; flan truyền thống ngọt ng&agrave;o mềm, căng mịn v&agrave; b&ocirc;ng lan s&ocirc;-c&ocirc;-la c&oacute; vị đắng nhẹ tinh tế. Hai lớp b&aacute;nh với hai hương vị kh&aacute;c nhau nhưng khi kết hợp tạo n&ecirc;n một chiếc b&aacute;nh ngon nịnh vị v&agrave; khi d&ugrave;ng thực kh&aacute;ch kh&ocirc;ng c&oacute; cảm gi&aacute;c ng&aacute;n.</span></p>\r\n<p><span>Flan Gato Berry Mix l&agrave; mẫu b&aacute;nh c&oacute; phần trang tr&iacute; từ d&acirc;u tươi v&agrave; việt quất tươi m&aacute;t nằm b&ecirc;n tr&ecirc;n lớp jelly caramel. Một phụ kiện kh&ocirc;ng thể thiếu tr&ecirc;n chiếc b&aacute;nh kem m&agrave; đặc biệt cực kỳ ph&ugrave; hợp với Flan Gato đ&oacute; l&agrave; bộ sưu tập c&acirc;y ghim với nhiều chủ đề kh&aacute;c nhau.</span></p>', 485000, NULL, 1, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '20cm', 100, '9424d207e0.jpeg'),
(48, 'Flan Gato Fruit & Pins – Flan Gato Trái Cây', 10, 15, '<p><span><a href=\"https://cailonuong.com/danh-muc-san-pham/banh-flan-gato/\">Flan Gato</a>&nbsp;l&agrave; d&ograve;ng b&aacute;nh m&agrave;&nbsp;<a href=\"https://cailonuong.com/\">C&aacute;i L&ograve; Nướng</a>&nbsp;chiếm ưu thế về sản lượng cung cấp cho thị trường Hồ Ch&iacute; Minh. B&aacute;nh c&oacute; hương vị ngon l&agrave;nh n&ecirc;n người d&ugrave;ng ở mọi lứa tuổi đều y&ecirc;u th&iacute;ch.</span></p>\r\n<p><span>B&aacute;nh c&oacute; hai lớp ch&iacute;nh, đ&oacute; l&agrave; flan truyền thống ngọt ng&agrave;o mềm, căng mịn v&agrave; b&ocirc;ng lan s&ocirc;-c&ocirc;-la c&oacute; vị đắng nhẹ tinh tế. Hai lớp b&aacute;nh với hai hương vị kh&aacute;c nhau nhưng khi kết hợp tạo n&ecirc;n một chiếc b&aacute;nh ngon nịnh vị v&agrave; khi d&ugrave;ng thực kh&aacute;ch kh&ocirc;ng c&oacute; cảm gi&aacute;c ng&aacute;n.</span></p>\r\n<p><span>Flan Gato Berry Mix l&agrave; mẫu b&aacute;nh c&oacute; phần trang tr&iacute; từ d&acirc;u tươi v&agrave; việt quất tươi m&aacute;t nằm b&ecirc;n tr&ecirc;n lớp jelly caramel. Một phụ kiện kh&ocirc;ng thể thiếu tr&ecirc;n chiếc b&aacute;nh kem m&agrave; đặc biệt cực kỳ ph&ugrave; hợp với Flan Gato đ&oacute; l&agrave; bộ sưu tập c&acirc;y ghim với nhiều chủ đề kh&aacute;c nhau.</span></p>', 14000, '0', 1, 'Việt Nam', '2024-03-07', '2 ngày', '20cm', 3, 'f3b1984225.jpeg'),
(49, 'BÁNH MÌ TRỨNG', 4, 15, '<p>Th&agrave;nh phần: B&aacute;nh mỳ, rau, ớt, dưa leo, pate,...</p>\r\n<p>Gi&aacute; giao động: 10.000đ , 13.000đ</p>', 14000, '0', 0, 'Việt Nam', '2024-03-07', '2 ngày kể từ ngày sản xuất', '20g', 20, 'a71be00b7b.jpg'),
(50, 'BÁNH MỲ SẤY CARAMEL HẠNH NHÂN', 10, 14, '<p><strong>HSD: 15 ng&agrave;y kể từ ng&agrave;y&nbsp;<span>sản</span>&nbsp;xuất</strong></p>', 14000, '10', 1, 'Việt Nam', '2024-03-07', 'HSD: 15 ngày kể từ ngày sản xuất', '2g', 20, 'bf3f4116e8.jpg'),
(51, 'BÁNH KEM SỮA TƯƠI 1S3-011', 3, 10, '<p><span>K&iacute;ch thước (đường k&iacute;nh b&aacute;nh)&nbsp;: 20cm</span></p>', 130000, '10', 0, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '2g', 20, 'acb1c5617d.jpg'),
(52, 'BÁNH CHẢ SỐT HÀN QUỐC', 10, 15, '<p>B&aacute;nh mặn</p>', 16000, '0', 0, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '2g', 22, '0c0d582003.jpg'),
(53, 'SANDWICH CACAO', 6, 14, '<p><span>Th&agrave;nh phần: Bột m&igrave;, bột cacao (2.3%), bột sữa, men, đường, muối, bơ, trứng g&agrave;,...</span></p>', 17000, '0', 1, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '22g', 20, 'eb57551bb6.png'),
(54, 'GÀ QUAY JAMBON_1 TRỨNG_180G', 5, 14, '<p><span>Bột m&igrave;, đường, trứng vịt muối, mứt b&iacute;, mứt chanh, mứt gừng, mứt hạt sen, mỡ heo, x&aacute; x&iacute;u, bột nếp, m&egrave;, hạt điều, hạt dưa, lạp xưởng, rượu, dầu ăn, mạch nha, thịt g&agrave;, chất bảo quản (202), natri hydro cacbonat (500ii).</span></p>', 90000, '0', 1, 'Việt Nam', '2024-03-07', '90 ngày kể từ ngày sản xuất', '90g', 100, 'bbf8380c01.jfif'),
(55, 'BÁNH KEM PHÔ MAI CHANH DÂY LÁT', 9, 15, '<p><span>Th&agrave;nh phần:&nbsp;Trứng g&agrave;, bột m&igrave;, đường, bơ, dầu ăn, phomai,kem sữa tươi, chanh d&acirc;y, galentine,&hellip;</span></p>', 23000, '10', 0, 'Việt Nam', '2024-03-07', '2 ngày kể từ ngày sản xuất', '20g', 100, '97ef940eaf.jpg'),
(56, 'Bánh tét', 8, 15, '<p>Đậu xanh, thịt,..</p>', 12000, '0', 0, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '20g', 20, '698e548e62.jpg'),
(57, 'BƠ PHERE TRÁI CÂY', 7, 15, '<p><span>Th&agrave;nh phần:&nbsp;Trứng g&agrave;, bột m&igrave;, đường,bơ phere, bột sữa, sữa tươi, tr&aacute;i c&acirc;y,&hellip;</span></p>', 130000, '10', 0, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '20g', 100, 'e5bae9b05a.jpg'),
(58, 'BÔNG LAN HOÀNG HẬU', 7, 10, '<p><span>Th&agrave;nh phần:&nbsp;Trứng g&agrave;, đường, bột m&igrave;, sữa tươi, bơ, bột sữa, dừa,&hellip;</span></p>', 540000, '0', 1, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '2g', 100, 'e82fedbec0.jpg'),
(59, 'BÔNG LAN LỚP', 7, 14, '<p><span>Th&agrave;nh phần:&nbsp;Trứng g&agrave;, bột m&igrave;, dầu ăn, bột cacao,&hellip;</span></p>', 130000, '0', 1, 'Việt Nam', '2024-03-07', '2 ngày kể từ ngày sản xuất', '25g', 100, '8101d05153.jpg'),
(60, 'BÁNH MỲ THỊT CHẢ', 4, 15, '<p>Th&agrave;nh phần: b&aacute;nh mỳ, rau, dưa, ớt tương, pate, sốt,...</p>\r\n<p>Gi&aacute; giao động: 15.000 - 20.000đ</p>', 13000, '0', 1, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '16cm', 100, '2416c27598.jpg'),
(61, 'CUPCAKE SOCOLA', 9, 15, '<p><span>Th&agrave;nh phần:&nbsp;Trứng g&agrave;, bột m&igrave;, đường, sữa tươi, dầu ăn,&hellip;</span></p>', 23000, '10', 0, 'Việt Nam', '2024-03-07', '2 ngày kể từ ngày sản xuất', '20g', 100, 'b8a3075da9.jpg'),
(62, 'BÁNH KEM SỮA CHUA DÂU', 9, 15, '<p><span>Th&agrave;nh phần:&nbsp;Trứng g&agrave;, bột m&igrave;, đường, sữa tươi, dầu ăn,&hellip;</span></p>', 23000, '0', 0, 'Việt Nam', '2024-03-07', '2 ngày kể từ ngày sản xuất', '20g', 100, '881d3ddc62.jpg'),
(63, 'HẠT SEN 1 TRỨNG_180G', 5, 14, '<h2>HẠT SEN 1 TRỨNG_180G</h2>', 72000, '0', 1, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '180g', 100, '06bb8719a6.jpg'),
(64, 'HẠT SEN TRÀ XANH_1 TRỨNG_200G', 5, 14, '<h2>HẠT SEN 1 TRỨNG_180G</h2>', 72000, '10', 1, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '180g', 100, 'abea4a5f0b.gif'),
(65, 'SANDWICH SỮA', 6, 14, '<p><span>Th&agrave;nh phần:&nbsp;Bột m&igrave;, bơ, đường, bột sữa, trứng g&agrave;, men ngọt,&hellip;</span></p>', 14000, '20', 0, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '180g', 100, '8b3aa5a5ad.jpg'),
(66, 'BÁNH KEM PHÔ MAI CHANH DÂY - 18CM', 3, 15, '<p><span>Th&agrave;nh phần:&nbsp;Bột m&igrave;, bơ, đường, bột sữa, trứng g&agrave;, men ngọt,&hellip;</span></p>', 145000, '10', 0, 'Việt Nam', '2024-03-07', '30 ngày kể từ ngày sản xuất', '180g', 100, '898c0400af.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spyeuthich`
--

CREATE TABLE `spyeuthich` (
  `MaSPYT` int(11) NOT NULL,
  `TenSPYT` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `MaKH` int(11) NOT NULL,
  `Gia` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `MaSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `adminId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`adminId`, `username`, `password`, `name`, `email`) VALUES
(1, 'admin', '9ebf76e7c3a20446c0c63cf1b771a688', 'Nghia', 'nghia@gmail.com'),
(31, 'writer', '885ebd18d4ec74aa6d4a4d31dbe70021', 'thuan', 'thuan@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke`
--

CREATE TABLE `thongke` (
  `MaTK` int(11) NOT NULL,
  `ngaydat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `donhang` int(11) NOT NULL,
  `danhthu` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongke`
--

INSERT INTO `thongke` (`MaTK`, `ngaydat`, `donhang`, `danhthu`, `soluong`) VALUES
(29, '2023-11-27 07:40:01', 1, '1174000', 1),
(30, '2023-11-29 04:17:41', 2, '500000', 3),
(31, '2023-10-01 04:17:45', 2, '500000', 4),
(32, '2023-10-08 04:18:11', 5, '1000000', 12),
(33, '2023-09-25 04:18:40', 2, '100000', 2),
(34, '2023-11-30 08:44:28', 3, '1394000', 1),
(35, '2023-12-03 00:43:14', 2, '310000', 1),
(36, '2023-12-03 01:34:03', 1, '165000', 1),
(37, '2023-12-05 08:56:14', 1, '252000', 1),
(38, '2023-12-07 05:07:44', 1, '464000', 1),
(39, '2023-12-07 08:12:35', 2, '1638000', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `id` int(11) NOT NULL,
  `TenTH` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`id`, `TenTH`) VALUES
(7, 'Orion'),
(10, 'Kinh đô'),
(12, 'Biscafun'),
(13, 'BreadTalk'),
(14, 'Bibica'),
(15, 'Bánh nhà làm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `MaTinTuc` int(11) NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `TomTat` varchar(255) NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `NgayDangTin` varchar(255) NOT NULL,
  `TacGia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_privileges`
--

CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL,
  `taikhoan_id` int(11) NOT NULL,
  `phanquyen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `taikhoan_id`, `phanquyen_id`) VALUES
(208, 31, 14),
(209, 31, 16),
(210, 31, 10),
(211, 31, 20),
(212, 31, 21),
(236, 1, 1),
(237, 1, 2),
(238, 1, 3),
(239, 1, 4),
(240, 1, 5),
(241, 1, 6),
(242, 1, 7),
(243, 1, 8),
(244, 1, 9),
(245, 1, 14),
(246, 1, 15),
(247, 1, 16),
(248, 1, 17),
(249, 1, 18),
(250, 1, 10),
(251, 1, 11),
(252, 1, 12),
(253, 1, 13),
(254, 1, 20),
(255, 1, 21),
(256, 1, 22),
(257, 1, 23),
(258, 1, 24),
(259, 1, 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vipaypal`
--

CREATE TABLE `vipaypal` (
  `MaVi` int(11) NOT NULL,
  `TenChuSoHuu` varchar(255) NOT NULL,
  `ChonTheTT` varchar(255) NOT NULL,
  `SoDu` float NOT NULL,
  `Voucher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBL`),
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`SoHD`),
  ADD KEY `MaHD` (`MaHD`),
  ADD KEY `MaSP_ct` (`MaSP`);

--
-- Chỉ mục cho bảng `dadathang`
--
ALTER TABLE `dadathang`
  ADD PRIMARY KEY (`MaDDH`);

--
-- Chỉ mục cho bảng `danhgiasao`
--
ALTER TABLE `danhgiasao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhgiasp`
--
ALTER TABLE `danhgiasp`
  ADD PRIMARY KEY (`ID_DG`),
  ADD KEY `MaSP_DG` (`MaSP`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `donvivanchuyen`
--
ALTER TABLE `donvivanchuyen`
  ADD PRIMARY KEY (`MaVC`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGH`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `MaVC` (`MaVC`),
  ADD KEY `MaNV` (`MaNV`),
  ADD KEY `MAPTTTT` (`MaPTTT`),
  ADD KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `hotro`
--
ALTER TABLE `hotro`
  ADD PRIMARY KEY (`MaHT`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MAKH`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKM`),
  ADD KEY `fk_sanpham_masp` (`MaSP`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`MaQuyen`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Chỉ mục cho bảng `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  ADD PRIMARY KEY (`MaPTTT`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`MaHA`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaDM` (`MaDM`),
  ADD KEY `MaTH` (`MaTH`);

--
-- Chỉ mục cho bảng `spyeuthich`
--
ALTER TABLE `spyeuthich`
  ADD PRIMARY KEY (`MaSPYT`),
  ADD KEY `MaSPYT` (`MaSP`),
  ADD KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `thongke`
--
ALTER TABLE `thongke`
  ADD PRIMARY KEY (`MaTK`);

--
-- Chỉ mục cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`MaTinTuc`);

--
-- Chỉ mục cho bảng `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taikhoan_id` (`taikhoan_id`),
  ADD KEY `phanquyen_id` (`phanquyen_id`);

--
-- Chỉ mục cho bảng `vipaypal`
--
ALTER TABLE `vipaypal`
  ADD PRIMARY KEY (`MaVi`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `SoHD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dadathang`
--
ALTER TABLE `dadathang`
  MODIFY `MaDDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `danhgiasao`
--
ALTER TABLE `danhgiasao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `danhgiasp`
--
ALTER TABLE `danhgiasp`
  MODIFY `ID_DG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `donvivanchuyen`
--
ALTER TABLE `donvivanchuyen`
  MODIFY `MaVC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MaGH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hotro`
--
ALTER TABLE `hotro`
  MODIFY `MaHT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MAKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  MODIFY `MaQuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  MODIFY `MaPTTT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `MaHA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `spyeuthich`
--
ALTER TABLE `spyeuthich`
  MODIFY `MaSPYT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `thongke`
--
ALTER TABLE `thongke`
  MODIFY `MaTK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `MaTinTuc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT cho bảng `vipaypal`
--
ALTER TABLE `vipaypal`
  MODIFY `MaVi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MAKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `MaHD` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MaSP_ct` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `danhgiasp`
--
ALTER TABLE `danhgiasp`
  ADD CONSTRAINT `MaSP_DG` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MAKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `MAPTTTT` FOREIGN KEY (`MaPTTT`) REFERENCES `phuongthucthanhtoan` (`MaPTTT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MaKH` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MAKH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MaNV` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MaVC` FOREIGN KEY (`MaVC`) REFERENCES `donvivanchuyen` (`MaVC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `fk_sanpham_masp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD CONSTRAINT `phanquyen_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`MaTH`) REFERENCES `thuonghieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `spyeuthich`
--
ALTER TABLE `spyeuthich`
  ADD CONSTRAINT `MaSPYT` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spyeuthich_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MAKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD CONSTRAINT `user_privileges_ibfk_1` FOREIGN KEY (`phanquyen_id`) REFERENCES `phanquyen` (`MaQuyen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privileges_ibfk_2` FOREIGN KEY (`taikhoan_id`) REFERENCES `taikhoan` (`adminId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
