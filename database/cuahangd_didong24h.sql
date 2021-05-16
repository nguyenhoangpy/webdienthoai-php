-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 16, 2021 lúc 12:30 PM
-- Phiên bản máy phục vụ: 5.7.33-cll-lve
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cuahangd_didong24h`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sum` bigint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`, `sum`) VALUES
(72, 59, 15, 2, 21980000),
(113, 1, 31, 1, 8490000),
(116, 58, 33, 1, 2990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(200) NOT NULL,
  `order_id` varchar(200) DEFAULT NULL,
  `thanh_vien` varchar(500) DEFAULT NULL,
  `money` int(200) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `vnp_response_code` varchar(200) DEFAULT NULL,
  `code_vnpay` int(200) DEFAULT NULL,
  `code_bank` varchar(500) DEFAULT NULL,
  `time` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `thanh_vien`, `money`, `note`, `vnp_response_code`, `code_vnpay`, `code_bank`, `time`) VALUES
(23, '20210516052024', 'Nguyen Hoang', 6490000, 'Ghi tieng viet khong dau', '00', 13505292, 'NCB', '2021-05-16 05:20:37.000000'),
(24, '20210516052635', 'Nguyen Hoang', 2990000, 'Ghi tieng viet khong dau', '00', 13505293, 'NCB', '2021-05-16 05:26:48.000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` int(200) NOT NULL,
  `item_price_sale` int(200) DEFAULT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_link` varchar(5000) DEFAULT NULL,
  `item_register` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_price_sale`, `item_image`, `item_link`, `item_register`) VALUES
(2, 'Samsung', 'Samsung Galaxy S21 5G', 20990000, 0, './assets/products/samsung-galaxy-s21-5g.jpg', 'https://cdn.tgdd.vn/Products/Images/42/220833/Image360/samsung-galaxy-s21-org', '2020-03-28 11:08:57'),
(3, 'Samsung', 'Samsung Galaxy A72', 11490000, 10990000, './assets/products/samsung-galaxy-a72.jpg', 'https://cdn.tgdd.vn/Products/Images/42/226101/Image360/samsung-galaxy-a72-org', '2020-03-28 11:08:57'),
(4, 'Samsung', 'Samsung Galaxy S21 Ultra', 30990000, 0, './assets/products/samsung-galaxy-s21-ultra.jpg', 'https://cdn.tgdd.vn/Products/Images/42/234308/Image360/samsung-galaxy-s21-ultra-256gb-360-org', '2020-03-28 11:08:57'),
(5, 'Samsung', 'Samsung Galaxy Note 20', 32990000, 0, './assets/products/sam-sung-note-20-ultra.jpg', 'https://cdn.tgdd.vn/Products/Images/42/230867/Image360/samsung-galaxy-note-20-ultra-5g-trang-360-org', '2020-03-28 11:08:57'),
(6, 'Apple', 'iPhone XR 64GB', 13490000, 0, './assets/products/iphone-xr.jpg', 'https://cdn.tgdd.vn/Products/Images/42/190325/Image360/iphone-xr-org', '2020-03-28 11:08:57'),
(7, 'Apple', 'iPhone 12 Pro 512GB', 38990000, 0, './assets/products/iphone-12-pro.jpg', 'https://cdn.tgdd.vn/Products/Images/42/228739/Image360/iphone-12-pro-512gb-360-org', '2020-03-28 11:08:57'),
(8, 'Apple', 'iPhone 12 64GB', 23990000, 0, './assets/products/iphone-12-64gb.jpg', 'https://cdn.tgdd.vn/Products/Images/42/213031/Image360/iphone-12-360-org', '2020-03-28 11:08:57'),
(9, 'Apple', 'iPhone 12 Pro Max 128GB', 33990000, 31690000, './assets/products/iphone-12promax128gb.jpg', 'https://cdn.tgdd.vn/Products/Images/42/213033/Image360/iphone-12-pro-max-360-org', '2020-03-28 11:08:57'),
(10, 'Apple', 'iPhone 11 64GB', 17990000, 16990000, './assets/products/iphone-11-64gb.jpg', 'https://cdn.tgdd.vn/Products/Images/42/153856/Image360/iphone-11-org', '2020-03-28 11:08:57'),
(11, 'Xiaomi', 'Xiaomi Mi 10T Pro 5G', 12990000, 0, './assets/products/xiaomi-mi-10t-pro.jpg', 'https://cdn.tgdd.vn/Products/Images/42/228136/Image360/xiaomi-mi-10t-pro-org', '2020-03-28 11:08:57'),
(12, 'Xiaomi', 'Xiaomi POCO X3 NFC', 6990000, 0, './assets/products/xiaomi-poco-x3-nfc.jpg', 'https://cdn.tgdd.vn/Products/Images/42/227900/Image360/xiaomi-poco-x3-org', '2020-03-28 11:08:57'),
(13, 'Xiaomi', 'Xiaomi Redmi Note 10', 5490000, 0, './assets/products/xiaomi-redmi-note-10.jpg', 'https://cdn.tgdd.vn/Products/Images/42/222758/Image360/xiaomi-redmi-note-10-360-org', '2020-03-28 11:08:57'),
(14, 'Xiaomi', 'Xiaomi Redmi 9T', 4990000, 4590000, './assets/products/xiaomi-redmi-9t-6gb.jpg', 'https://cdn.tgdd.vn/Products/Images/42/233130/Image360/xiaomi-redmi-9t-6gb-360-org', '2020-03-28 11:08:57'),
(15, 'Oppo', 'Oppo Reno4 Pro', 11990000, 10990000, './assets/products/oppo-reno4-pro.jpg', 'https://cdn.tgdd.vn/Products/Images/42/223497/Image360/oppo-reno4-pro-1-org', '2020-03-28 11:08:57'),
(16, 'Oppo', 'Oppo A15', 3490000, 0, './assets/products/oppo-a15.jpg', 'https://cdn.tgdd.vn/Products/Images/42/229885/Image360/oppo-a15-360-org', '2020-03-28 11:08:57'),
(17, 'Vivo', 'Vivo Y51', 6290000, 5990000, './assets/products/vivo-y51.jpg', 'https://cdn.tgdd.vn/Products/Images/42/228950/Image360/vivo-y51-2020-360-org', '2020-03-28 11:08:57'),
(18, 'Oppo', 'Oppo A93', 6490000, 5990000, './assets/products/oppo-a93.jpg', 'https://cdn.tgdd.vn/Products/Images/42/229056/Image360/oppo-a93-org', '2020-03-28 11:08:57'),
(19, 'Oppo', 'Oppo Reno 5', 8690000, 0, './assets/products/oppo-reno5.jpg', 'https://cdn.tgdd.vn/Products/Images/42/220438/Image360/oppo-reno5-org', '2020-03-28 11:08:57'),
(20, 'Oppo', 'Oppo A74', 6690000, 0, './assets/products/oppo-a74.jpg', 'https://cdn.tgdd.vn/Products/Images/42/235653/Image360/oppo-a74-org', '2020-03-28 11:08:57'),
(21, 'Oppo', 'Oppo A54', 4690000, 0, './assets/products/oppo-a54.jpg', 'https://cdn.tgdd.vn/Products/Images/42/236768/Image360/oppo-a54-360-org', '2020-03-28 11:08:57'),
(22, 'Apple', 'iPhone SE 64GB (2020)', 12490000, 11190000, './assets/products/iphone-se-2020.jpg', 'https://cdn.tgdd.vn/Products/Images/42/230410/Image360/iphone-se-64gb-2020-hop-moi-360-org', '2020-03-28 11:08:57'),
(23, 'Apple', 'iPhone 12 mini 64GB', 19490000, 18190000, './assets/products/iphone-12-mini.jpg', 'https://cdn.tgdd.vn/Products/Images/42/225380/Image360/iphone-12-mini-org', '2020-03-28 11:08:57'),
(24, 'Vivo', 'Vivo A72 5G', 7990000, 0, './assets/products/vivo-y72-5g.jpg', 'https://cdn.tgdd.vn/Products/Images/42/236431/Image360/vivo-y72-5g-360-org', '2020-03-28 11:08:57'),
(25, 'Vivo', 'Vivo V20 SE', 7190000, 6490000, './assets/products/vivo-v20-se.jpg', 'https://cdn.tgdd.vn/Products/Images/42/228141/Image360/vivo-v20-se-360-org', '2020-03-28 11:08:57'),
(26, 'Xiaomi', 'Xiaomi Mi 11 5G', 21990000, 20990000, './assets/products/xiaomi-mi-11.jpg', 'https://cdn.tgdd.vn/Products/Images/42/226264/Image360/xiaomi-mi-11-360-org', '2020-03-28 11:08:57'),
(27, 'Xiaomi', 'Xiaomi Redmi Note 10 Pro', 7490000, 0, './assets/products/xiaomi-redmi-note-10-pro.jpg', 'https://cdn.tgdd.vn/Products/Images/42/229228/Image360/xiaomi-redmi-note-10-pro-org', '2020-03-28 11:08:57'),
(28, 'Realme', 'Realme 8', 7290000, 0, './assets/products/realme-8.jpg', 'https://cdn.tgdd.vn/Products/Images/42/233135/Image360/realme-8-360-org', '2020-03-28 11:08:57'),
(29, 'Realme', 'Realme 7', 6990000, 6690000, './assets/products/realme-7.jpg', 'https://cdn.tgdd.vn/Products/Images/42/227731/Image360/realme-7-org', '2020-03-28 11:08:57'),
(30, 'Realme', 'Realme 6', 5990000, 5390000, './assets/products/realme-6.jpg', 'https://cdn.tgdd.vn/Products/Images/42/214644/Image360/realme-6-org', '2020-03-28 11:08:57'),
(31, 'Realme', 'Realme 7 Pro', 8990000, 8490000, './assets/products/realme-7-pro.jpg', 'https://cdn.tgdd.vn/Products/Images/42/227689/Image360/realme-7-pro-360-org', '2020-03-28 11:08:57'),
(32, 'Realme', 'Realme 6 Pro', 6990000, 0, './assets/products/realme-6-pro.jpg', 'https://cdn.tgdd.vn/Products/Images/42/214645/Image360/realme-6-pro-org', '2020-03-28 11:08:57'),
(33, 'Realme', 'Realme C20', 2690000, 2990000, './assets/products/realme-c20.jpg', 'https://cdn.tgdd.vn/Products/Images/42/232518/Image360/realme-c20-360-org', '2020-03-28 11:08:57'),
(34, 'Samsung', 'Samsung Galaxy S21+ 5G', 25990000, 0, './assets/products/samsung-galaxy-s21-plus.jpg', 'https://cdn.tgdd.vn/Products/Images/42/226385/Image360/samsung-galaxy-s21-plus-360-org', '2020-03-28 11:08:57'),
(35, 'Samsung', 'Samsung Galaxy Note+', 17990000, 16490000, './assets/products/samsung-galaxy-note-10-plus.jpg', 'https://cdn.tgdd.vn/Products/Images/42/206176/Image360/samsung-galaxy-note-10-plus-org', '2020-03-28 11:08:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_options`
--

CREATE TABLE `product_options` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_color` varchar(50) NOT NULL,
  `item_ram` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_special`
--

CREATE TABLE `product_special` (
  `item_id` int(11) NOT NULL,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(500) NOT NULL,
  `item_price` int(200) NOT NULL,
  `item_image` varchar(1000) NOT NULL,
  `item_register` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_special`
--

INSERT INTO `product_special` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_image`, `item_register`) VALUES
(2, 'Samsung', 'Samsung Galaxy S21 5G', 20990000, './assets/products/samsung-galaxy-s21-5g.jpg', '2020-03-28 11:08:57'),
(3, 'Samsung', 'Samsung Galaxy A72', 11490000, './assets/products/samsung-galaxy-a72.jpg', '2020-03-28 11:08:57'),
(4, 'Samsung', 'Samsung Galaxy S21 Ultra', 30990000, './assets/products/samsung-galaxy-s21-ultra.jpg', '2020-03-28 11:08:57'),
(5, 'Samsung', 'Samsung Galaxy Note 20', 32990000, './assets/products/sam-sung-note-20-ultra.jpg', '2020-03-28 11:08:57'),
(6, 'Apple', 'iPhone XR 64GB', 13490000, './assets/products/iphone-xr.jpg', '2020-03-28 11:08:57'),
(7, 'Apple', 'iPhone 12 Pro 512GB', 38990000, './assets/products/iphone-12-pro.jpg', '2020-03-28 11:08:57'),
(8, 'Apple', 'iPhone 12 64GB', 23990000, './assets/products/iphone-12-64gb.jpg', '2020-03-28 11:08:57'),
(11, 'Xiaomi', 'Xiaomi Mi 10T Pro 5G', 12990000, './assets/products/xiaomi-mi-10t-pro.jpg', '2020-03-28 11:08:57'),
(12, 'Xiaomi', 'Xiaomi POCO X3 NFC', 6990000, './assets/products/xiaomi-poco-x3-nfc.jpg', '2020-03-28 11:08:57'),
(13, 'Xiaomi', 'Xiaomi Redmi Note 10', 5490000, './assets/products/xiaomi-redmi-note-10.jpg', '2020-03-28 11:08:57'),
(16, 'Oppo', 'Oppo A15', 3490000, './assets/products/oppo-a15.jpg', '2020-03-28 11:08:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `code` int(6) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `password`, `email`, `code`, `phone`, `status`) VALUES
(1, 'Daily', '123', 'admin@gmail.com', 0, '123', 'verified'),
(2, 'Akshay', '123', 'Kashyap', 0, '12', 'verified'),
(3, 'abc', '123', 'abc@gmail.com', 0, '1234', 'verified'),
(27, 'thuy nguyen', '789', 'thuynguyenminh039@gmail.com', 0, '1234', 'verified'),
(58, 'Nguyen Hoang', '123', 'hoangnguyenminh.py@gmail.com', 0, '641', 'verified'),
(60, 'Minh Hoàng', NULL, 'hoangnguyen210297@gmail.com', NULL, NULL, 'verified');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `product_special`
--
ALTER TABLE `product_special`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `product_options`
--
ALTER TABLE `product_options`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
