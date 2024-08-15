-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-05-11 11:00:08
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `library system`
--

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `ISBN` char(13) NOT NULL,
  `書名` varchar(50) NOT NULL,
  `作者` varchar(50) NOT NULL,
  `類別` varchar(15) NOT NULL,
  `是否被租借` char(1) NOT NULL,
  `租借學號` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`ISBN`, `書名`, `作者`, `類別`, `是否被租借`, `租借學號`) VALUES
('9789864764846', 'Deep Learning：用Python進行深度學習的基礎理論實作', '斎藤康毅', '學術', '否', ''),
('9789862894514', 'Cheers！深夜台北：小酒館、咖啡屋、酒吧、餐廳…不想回家的時候就到這裡逗留吧', 'TRAVELER Luxe旅人誌 編輯室', '美食', '否', ''),
('9786263296824', '啡嚐日本：走訪五大城市的精品咖啡散策指南，體驗咖啡甜點、空間選物的漫旅享受', 'Chez Kuo', '旅遊', '否', ''),
('9789577436368', '我想成為影之強者！ (1)', '逢沢大介', '輕小說', '否', ''),
('9786263235205', '行政學百分百(命題焦點暨題庫解析)(高普考‧初等考‧三、四、五等特考‧升等考適用)', '陳真', '其他', '否', ''),
('9789863126522', '深度強化式學習', 'Alexander Zai, Brandon Brown', '學術', '否', ''),
('9786263522770', '鈴芽之旅', '新海誠', '輕小說', '是', 'M123456789'),
('9786263520912', '關於我轉生變成史萊姆這檔事 (18)', '伏瀬', '輕小說', '否', ''),
('9789861305745', '手工餅乾的基礎：忍不住就想烤來吃！從口感、口味、夾餡到造型，簡單做出專賣店般的美味曲奇', '金多恩', '美食', '否', ''),
('9786263604988', '在超商搶案中救下的不起眼店員，竟是同班的純情可愛辣妹 2', 'あボーン', '輕小說', '否', ''),
('9786263524484', '借給朋友500圓，他竟然拿妹妹來抵債，我到底該如何是好(1)', 'としぞう', '輕小說', '否', '');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `account` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `學號` char(10) NOT NULL,
  `manager` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`account`, `password`, `學號`, `manager`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'M123456789', 1),
('admin01', '18c6d818ae35a3e8279b5330eda01498', 'M456789123', 1),
('test01', '0e698a8ffc1a0af622c7b4db3cb750cc', 'M097355122', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `學生`
--

CREATE TABLE `學生` (
  `學號` varchar(10) NOT NULL,
  `姓名` text NOT NULL,
  `電話` varchar(10) NOT NULL,
  `信箱` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `學生`
--

INSERT INTO `學生` (`學號`, `姓名`, `電話`, `信箱`) VALUES
('M097355122', '破貓', '0938740632', 'jimmy0844@mail.fcu.edu.tw'),
('M123456789', '歐金棒', '0973056123', 'jimmy0844@gmail.com'),
('M456789123', '田所浩二', '0988621354', 'm113040113@student.nsysu.edu.tw');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
