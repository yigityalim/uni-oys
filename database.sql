-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:8889
-- Üretim Zamanı: 31 May 2024, 07:49:36
-- Sunucu sürümü: 5.7.39
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

CREATE TABLE `courses` (
                           `id` int(11) NOT NULL,
                           `name` varchar(255) NOT NULL,
                           `code` varchar(10) NOT NULL,
                           `credit` int(11) NOT NULL,
                           `season` int(11) NOT NULL,
                           `department_id` int(11) DEFAULT NULL,
                           `lecturer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `credit`, `season`, `department_id`, `lecturer_id`) VALUES
                                                                                                     (1, 'İNGİLİZCE I', 'İNGL101', 4, 1, 1, 1),
                                                                                                     (2, 'EKONOMİYE GİRİŞ I', 'TBF111', 3, 1, 1, 6),
                                                                                                     (3, 'GENEL MATEMATİK I', 'TBF121', 3, 1, 1, 5),
                                                                                                     (4, 'HUKUKA GİRİŞ', 'TBF141', 3, 1, 1, 7),
                                                                                                     (5, 'TÜRK DİLİ I', 'TÜRK101', 2, 1, 1, 4),
                                                                                                     (7, 'SEÇMELİ GÜZEL SANATLAR/İLK YARDIM', 'GSBHSH', 1, 2, 1, 2),
                                                                                                     (8, 'İNGİLİZCE II', 'İNGL102', 4, 2, 1, 5),
                                                                                                     (9, 'EKONOMİYE GİRİŞ II', 'TBF112', 3, 2, 1, 3),
                                                                                                     (10, 'GENEL MATEMATİK II', 'TBF122', 3, 2, 1, 1),
                                                                                                     (11, 'TÜRK DİLİ II', 'TÜRK102', 2, 2, 1, 1),
                                                                                                     (12, 'İŞLETME YÖNETİMİNE GİRİŞ', 'YBS112', 3, 2, 1, 1),
                                                                                                     (13, 'ALGORİTMAYA GİRİŞ', 'YBS116', 3, 2, 1, 2),
                                                                                                     (14, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ I', 'ATA201', 2, 3, 1, 5),
                                                                                                     (15, 'İNGİLİZCE III', 'İNGL201', 4, 3, 1, 6),
                                                                                                     (16, 'MUHASEBE İLKELERİ I', 'TBF211', 3, 3, 1, 1),
                                                                                                     (17, 'MATEMATİKSEL İSTATİSTİK I', 'TBF221', 3, 3, 1, 1),
                                                                                                     (18, 'TEKNOLOJİ VE İNOVASYON YÖNTEMİ', 'YBS203', 3, 3, 1, 7),
                                                                                                     (19, 'YAPISAL PROGRAMLAMA I', 'YBS215', 3, 3, 1, 6),
                                                                                                     (20, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ II', 'ATA202', 2, 4, 1, 7),
                                                                                                     (21, 'İNGİLİZCE IV', 'İNGL202', 4, 4, 1, 2),
                                                                                                     (22, 'MUHASEBE İLKELERİ II', 'TBF212', 3, 4, 1, 3),
                                                                                                     (23, 'MATEMATİKSEL İSTATİSTİK II', 'TBF226', 3, 4, 1, 3),
                                                                                                     (24, 'ÖRGÜTSEL DAVRANIŞ', 'TBF232', 3, 4, 1, 3),
                                                                                                     (25, 'VERİ TABANI YÖNETİM SİSTEMLERİ', 'YBS212', 3, 4, 1, 5),
                                                                                                     (26, 'YAPISAL PROGRAMLAMA II', 'YBS216', 3, 4, 1, 4),
                                                                                                     (27, 'İŞLETME FİNANSI', 'TBF321', 3, 5, 1, 2),
                                                                                                     (28, 'SEÇİMLİK DERS I', 'YBS001', 3, 5, 1, 4),
                                                                                                     (29, 'SEÇİMLİK DERS II', 'YBS002', 3, 5, 1, 2),
                                                                                                     (30, 'SEÇİMLİK DERS III', 'YBS003', 3, 5, 1, 6),
                                                                                                     (31, 'NESNE YÖNELİMLİ PROGRAMLAMA', 'YBS313', 3, 5, 1, 6),
                                                                                                     (32, 'İNTERNET BİLGİ SİSTEMLERİ', 'YBS343', 3, 5, 1, 5),
                                                                                                     (33, 'SEÇİMLİK DERS IV', 'YBS004', 3, 6, 1, 6),
                                                                                                     (34, 'SEÇİMLİK DERS V', 'YBS005', 3, 6, 1, 2),
                                                                                                     (35, 'İNSAN KAYNAKLARI YÖNETİMİ VE BİLGİ SİSTEMLERİ', 'YBS315', 3, 6, 1, 5),
                                                                                                     (36, 'ZORUNLU YAZ STAJI', 'YBS360', 5, 6, 1, 6),
                                                                                                     (37, 'WEB UYGULAMALARI TASARIM VE GELİŞTİRME', 'YBS364', 3, 6, 1, 1),
                                                                                                     (38, 'SİSTEM ANALİZİ VE TASARIMI', 'YBS370', 5, 6, 1, 7),
                                                                                                     (39, 'SEÇİMLİK DERS VI', 'YBS006', 3, 7, 1, 1),
                                                                                                     (40, 'SEÇİMLİK DERS VII', 'YBS007', 3, 7, 1, 6),
                                                                                                     (41, 'SEÇİMLİK DERS VIII', 'YBS008', 3, 7, 1, 4),
                                                                                                     (42, 'SEÇİMLİK DERS IX', 'YBS009', 3, 7, 1, 4),
                                                                                                     (43, 'İNSAN BİLGİSAYAR ETKİLEŞİMİ', 'YBS433', 3, 7, 1, 6),
                                                                                                     (44, 'YÖNETİM BİLGİ SİSTEMLERİ', 'YBS471', 3, 7, 1, 2),
                                                                                                     (45, 'SEÇİMLİK DERS X', 'YBS010', 3, 8, 1, 6),
                                                                                                     (46, 'SEÇİMLİK DERS XI', 'YBS011', 3, 8, 1, 2),
                                                                                                     (47, 'İŞLETMEDE MESLEKİ EĞİTİM', 'YBS450', 20, 8, 1, 7),
                                                                                                     (48, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ I', 'ATA101', 2, 1, 4, 23),
                                                                                                     (49, 'ENGLISH FOR ACADEMIC PURPOSES I', 'ENGL101', 4, 1, 4, 22),
                                                                                                     (50, 'ALAN DIŞI SEÇİMLİK DERS 1', 'HUKY001', 2, 1, 4, 22),
                                                                                                     (51, 'ALAN DIŞI SEÇİMLİK DERS 2', 'HUKY002', 2, 1, 4, 21),
                                                                                                     (52, 'HUKUK BAŞLANGICI', 'HUKY104', 3, 1, 4, 22),
                                                                                                     (53, 'MEDENİ HUKUK I (BAŞLANGIÇ-KİŞİLER HUKUKU)', 'HUKY113', 5, 1, 4, 22),
                                                                                                     (54, 'ANAYASA HUKUKU I (GENEL ESASLAR)', 'HUKY123', 3, 1, 4, 22),
                                                                                                     (55, 'ROMA HUKUKU I', 'HUKY136', 2, 1, 4, 20),
                                                                                                     (56, 'TÜRK DİLİ I', 'TÜRK101', 2, 1, 4, 21),
                                                                                                     (57, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ II', 'ATA102', 2, 2, 4, 22),
                                                                                                     (58, 'ENGLISH FOR ACADEMIC PURPOSES II', 'ENGL102', 4, 2, 4, 21),
                                                                                                     (59, 'SEÇMELİ GÜZEL SANATLAR/İLK YARDIM', 'GSBHSH', 1, 2, 4, 23),
                                                                                                     (60, 'ALAN DIŞI SEÇİMLİK DERS 3', 'HUKY003', 2, 2, 4, 21),
                                                                                                     (61, 'ALAN DIŞI SEÇİMLİK DERS 4', 'HUKY004', 2, 2, 4, 22),
                                                                                                     (62, 'MEDENİ HUKUK II (AİLE HUKUKU)', 'HUKY114', 5, 2, 4, 23),
                                                                                                     (63, 'ANAYASA HUKUKU II (TÜRK ANAYASA HUKUKU)', 'HUKY124', 4, 2, 4, 20),
                                                                                                     (64, 'ROMA HUKUKU II', 'HUKY137', 3, 2, 4, 22),
                                                                                                     (65, 'TÜRK DİLİ II', 'TÜRK102', 2, 2, 4, 21),
                                                                                                     (66, 'ENGLISH FOR ACADEMIC PURPOSES III', 'ENGL201', 4, 3, 4, 21),
                                                                                                     (67, 'ALAN SEÇİMLİK DERS 5', 'HUKY005', 4, 3, 4, 22),
                                                                                                     (68, 'BORÇLAR HUKUKU I', 'HUKY213', 4, 3, 4, 20),
                                                                                                     (69, 'CEZA HUKUKU I (GENEL HÜKÜMLER)', 'HUKY235', 3, 3, 4, 21),
                                                                                                     (70, 'TÜRK HUKUK TARİHİ', 'HUKY257', 3, 3, 4, 20),
                                                                                                     (71, 'İDARE HUKUKU I', 'HUKY260', 4, 3, 4, 23),
                                                                                                     (72, 'GENEL KAMU HUKUKU', 'HUKY263', 3, 3, 4, 21),
                                                                                                     (73, 'MİLLETLER ARASI KAMU HUKUKU I', 'HUKY291', 4, 3, 4, 22),
                                                                                                     (74, 'ENGLISH FOR ACADEMIC PURPOSES IV', 'ENGL202', 5, 4, 4, 22),
                                                                                                     (75, 'ALAN SEÇİMLİK DERS 6', 'HUKY006', 4, 4, 4, 21),
                                                                                                     (76, 'ALAN SEÇİMLİK DERS 7', 'HUKY007', 4, 4, 4, 23),
                                                                                                     (77, 'BORÇLAR HUKUKU II (GENEL HÜKÜMLER)', 'HUKY214', 5, 4, 4, 23),
                                                                                                     (78, 'CEZA HUKUKU II (GENEL HÜKÜMLER)', 'HUKY238', 4, 4, 4, 23),
                                                                                                     (79, 'İDARE HUKUKU II', 'HUKY261', 3, 4, 4, 22),
                                                                                                     (80, 'İNSAN HAKLARI HUKUKU I (MİLLETLERARASI İNSAN HAKLARI HUKUKU)', 'HUKY269', 2, 4, 4, 23),
                                                                                                     (81, 'MALİYE', 'HUKY286', 3, 4, 4, 22),
                                                                                                     (82, 'CEZA HUKUKU I (ÖZEL HÜKÜMLER)', 'HUKY325', 4, 5, 4, 23),
                                                                                                     (83, 'VERGİ HUKUKU', 'HUKY351', 3, 5, 4, 20),
                                                                                                     (84, 'HUKUK FELSEFESİ', 'HUKY355', 2, 5, 4, 22),
                                                                                                     (85, 'EŞYA HUKUKU I', 'HUKY361', 4, 5, 4, 21),
                                                                                                     (86, 'BORÇLAR HUKUKU I (ÖZEL HÜKÜMLER)', 'HUKY371', 3, 5, 4, 20),
                                                                                                     (87, 'İDARİ YARGILAMA HUKUKU I', 'HUKY373', 3, 5, 4, 20),
                                                                                                     (88, 'MEDENİ USUL HUKUKU I', 'HUKY381', 4, 5, 4, 21),
                                                                                                     (89, 'TİCARET HUKUKU I (TİCARİ İŞLETME HUKUKU)', 'HUKY391', 4, 5, 4, 23),
                                                                                                     (90, 'TRANSLATION I', 'LENG305', 2, 5, 4, 21),
                                                                                                     (91, 'ALAN SEÇİMLİK DERS 8', 'HUKY008', 4, 6, 4, 22),
                                                                                                     (92, 'CEZA HUKUKU II (ÖZEL HÜKÜMLER)', 'HUKY326', 3, 6, 4, 21),
                                                                                                     (93, 'HUKUK SOSYOLOJİSİ', 'HUKY358', 3, 6, 4, 23),
                                                                                                     (94, 'EŞYA HUKUKU II', 'HUKY362', 3, 6, 4, 22),
                                                                                                     (95, 'İDARİ YARGILAMA HUKUKU II', 'HUKY370', 3, 6, 4, 23),
                                                                                                     (96, 'BORÇLAR HUKUKU II (ÖZEL HÜKÜMLER)', 'HUKY380', 3, 6, 4, 20),
                                                                                                     (97, 'MEDENİ USUL HUKUKU II', 'HUKY382', 4, 6, 4, 22),
                                                                                                     (98, 'TİCARET HUKUKU II (ŞİRKETLER HUKUKU)', 'HUKY392', 4, 6, 4, 21),
                                                                                                     (99, 'TRANSLATION II', 'LENG306', 3, 6, 4, 22),
                                                                                                     (100, 'ALAN SEÇİMLİK DERS 9', 'HUKY009', 4, 7, 4, 20),
                                                                                                     (101, 'ADLİ TIP', 'HUKY411', 3, 7, 4, 22),
                                                                                                     (102, 'MİRAS HUKUKU I', 'HUKY450', 3, 7, 4, 21),
                                                                                                     (103, 'MİLLETLERARASI ÖZEL HUKUK I', 'HUKY465', 4, 7, 4, 20),
                                                                                                     (104, 'İŞ HUKUKU', 'HUKY467', 4, 7, 4, 22),
                                                                                                     (105, 'İCRA-İFLAS HUKUKU I (İCRA HUKUKU)', 'HUKY471', 4, 7, 4, 21),
                                                                                                     (106, 'TİCARET HUKUKU I (KIYMETLİ EVRAK HUKUKU)', 'HUKY481', 4, 7, 4, 21),
                                                                                                     (107, 'CEZA USULÜ HUKUKU I', 'HUKY491', 4, 7, 4, 23),
                                                                                                     (108, 'ALAN SEÇİMLİK DERS 10', 'HUKY010', 4, 8, 4, 23),
                                                                                                     (109, 'MİRAS HUKUKU II', 'HUKY451', 3, 8, 4, 23),
                                                                                                     (110, 'AVRUPA KONSEYİ İNSAN HAKLARI HUKUKU VE TÜRKİYE', 'HUKY452', 2, 8, 4, 20),
                                                                                                     (111, 'MİLLETLERARASI ÖZEL HUKUK II', 'HUKY466', 4, 8, 4, 20),
                                                                                                     (112, 'TOPLU İŞ HUKUKU', 'HUKY468', 4, 8, 4, 23),
                                                                                                     (113, 'İCRA-İFLAS HUKUKU II (İFLAS HUKUKU)', 'HUKY472', 4, 8, 4, 22),
                                                                                                     (114, 'TİCARET HUKUKU II (SİGORTA HUKUKU)', 'HUKY482', 4, 8, 4, 20),
                                                                                                     (115, 'CEZA USULÜ HUKUKU II', 'HUKY492', 4, 8, 4, 20),
                                                                                                     (116, 'BİLGİSAYAR YAZILIMI I', 'BİL101', 5, 1, 2, 17),
                                                                                                     (117, 'PROGRAMLAMA LABORATUVARI I', 'BİL105', 2, 1, 2, 19),
                                                                                                     (118, 'BİLGİSAYAR MÜHENDİSLİĞİNE GİRİŞ', 'BİL110', 4, 1, 2, 18),
                                                                                                     (119, 'ADVANCED ENGLISH I', 'ENG199', 4, 1, 2, 18),
                                                                                                     (120, 'MEKANİK LABORATUVARI', 'FİZ103', 2, 1, 2, 16),
                                                                                                     (121, 'GENEL FİZİK I', 'FİZ105', 5, 1, 2, 19),
                                                                                                     (122, 'MATEMATİKSEL ANALİZ I', 'MAT151', 6, 1, 2, 16),
                                                                                                     (123, 'TÜRK DİLİ I', 'TÜRK101', 2, 1, 2, 18),
                                                                                                     (124, 'İLERİ PROGRAMLAMA', 'BİL122', 5, 2, 2, 17),
                                                                                                     (125, 'İLERİ PROGRAMLAMA UYGULAMALARI', 'BİL124', 2, 2, 2, 18),
                                                                                                     (126, 'YAŞAM BİLİMLERİ VE BİLGİSAYAR MÜHENDİSLİĞİ', 'BİL172', 4, 2, 2, 18),
                                                                                                     (127, 'ELEKTRİK LABORATUVARI', 'FİZ104', 2, 2, 2, 17),
                                                                                                     (128, 'GENEL FİZİK II', 'FİZ110', 5, 2, 2, 16),
                                                                                                     (129, 'MATEMATİKSEL ANALİZ II', 'MAT152', 6, 2, 2, 17),
                                                                                                     (130, 'DOĞRUSAL CEBİR', 'MAT210', 4, 2, 2, 17),
                                                                                                     (131, 'TÜRK DİLİ II', 'TÜRK102', 2, 2, 2, 19),
                                                                                                     (132, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ I', 'ATA201', 2, 3, 2, 17),
                                                                                                     (133, 'AYRIK YAPILAR', 'BİL231', 6, 3, 2, 19),
                                                                                                     (134, 'VERİ YAPILARI', 'BİL265', 7, 3, 2, 19),
                                                                                                     (135, 'SAYISAL MANTIK TASARIMI', 'BİL275', 7, 3, 2, 18),
                                                                                                     (136, 'ADVANCED ENGLISH II', 'ENG200', 4, 3, 2, 19),
                                                                                                     (137, 'EKONOMİ', 'SOS203', 4, 3, 2, 18),
                                                                                                     (138, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ II', 'ATA202', 2, 4, 2, 17),
                                                                                                     (139, 'ELEKTRONİĞE GİRİŞ', 'BİL210', 6, 4, 2, 18),
                                                                                                     (140, 'BİLGİSAYAR ORGANİZASYONU', 'BİL218', 6, 4, 2, 17),
                                                                                                     (141, 'PROGRAMLAMA DİLLERİ', 'BİL240', 6, 4, 2, 17),
                                                                                                     (142, 'OLASILIK VE İSTATİSTİK', 'MAT250', 5, 4, 2, 18),
                                                                                                     (143, 'BİLGİSAYAR MÜHENDİSLİĞİ İÇİN MATEMATİK', 'MAT286', 5, 4, 2, 17),
                                                                                                     (144, 'STAJ I', 'BİL300', 2, 5, 2, 17),
                                                                                                     (145, 'MİKROİŞLEMCİLER', 'BİL324', 5, 5, 2, 16),
                                                                                                     (146, 'NESNE YÖNELİMLİ PROGRAMLAMA', 'BİL343', 5, 5, 2, 18),
                                                                                                     (147, 'ALGORİTMALAR', 'BİL367', 5, 5, 2, 16),
                                                                                                     (148, 'DEVELOPING ENGLISH LANGUAGE SKILLS', 'ENG330', 4, 5, 2, 19),
                                                                                                     (149, 'SAYISAL ANALİZ TEKNİKLERİ', 'MAT311', 5, 5, 2, 17),
                                                                                                     (150, 'İŞLETME', 'SOS204', 4, 5, 2, 17),
                                                                                                     (151, 'TEKNİK SEÇİMLİK I', 'BİL001', 5, 6, 2, 17),
                                                                                                     (152, 'SOSYAL SEÇİMLİK', 'BİL007', 3, 6, 2, 16),
                                                                                                     (153, 'İŞLETİM SİSTEMLERİ', 'BİL332', 7, 6, 2, 18),
                                                                                                     (154, 'VERİTABANI SİSTEMLERİ', 'BİL344', 7, 6, 2, 16),
                                                                                                     (155, 'YAZILIM MÜHENDİSLİĞİNE GİRİŞ', 'BİL386', 7, 6, 2, 16),
                                                                                                     (156, 'TEKNİK SEÇİMLİK II', 'BİL002', 5, 7, 2, 16),
                                                                                                     (157, 'TEKNİK SEÇİMLİK III', 'BİL003', 5, 7, 2, 18),
                                                                                                     (158, 'BİTİRME PROJESİ I', 'BİL493', 7, 7, 2, 16),
                                                                                                     (159, 'STAJ II', 'BİL498', 3, 7, 2, 17),
                                                                                                     (160, 'BİLGİSAYAR AĞLARI', 'BİL499', 6, 7, 2, 19),
                                                                                                     (161, 'PRESENTATION SKILLS', 'ENG460', 4, 7, 2, 17),
                                                                                                     (162, 'TEKNİK SEÇİMLİK IV', 'BİL004', 5, 8, 2, 17),
                                                                                                     (163, 'TEKNİK SEÇİMLİK V', 'BİL005', 5, 8, 2, 17),
                                                                                                     (164, 'TEKNİK SEÇİMLİK VI', 'BİL006', 5, 8, 2, 19),
                                                                                                     (165, 'ETİK, TOPLUM VE MESLEK', 'BİL482', 7, 8, 2, 16),
                                                                                                     (166, 'BİTİRME PROJESİ II', 'BİL494', 8, 8, 2, 19),
                                                                                                     (167, 'GENEL İNGİLİZCE I', 'İNGL111', 4, 1, 3, 15),
                                                                                                     (168, 'ALGORİTMA VE PROGRAMLAMAYA GİRİŞ', 'SBST101', 2, 1, 3, 9),
                                                                                                     (169, 'TIBBİ TERMİNOLOJİ', 'SBST109', 2, 1, 3, 10),
                                                                                                     (170, 'MESLEKİ MATEMATİK I', 'SBST115', 4, 1, 3, 14),
                                                                                                     (171, 'TIBBİ DOKÜMANTASYON', 'SBST119', 3, 1, 3, 8),
                                                                                                     (172, 'SEÇİMLİK DERS I', 'TEKN001', 2, 1, 3, 9),
                                                                                                     (173, 'TÜRK DİLİ I', 'TÜRK101', 2, 1, 3, 11),
                                                                                                     (174, 'GENEL İNGİLİZCE II', 'İNGL112', 4, 2, 3, 15),
                                                                                                     (175, 'TEKNİK SEÇİMLİK I', 'SBST001', 3, 2, 3, 8),
                                                                                                     (176, 'NESNEYE YÖNELİK PROGRAMLAMA I', 'SBST104', 2, 2, 3, 11),
                                                                                                     (177, 'VERİ TABANI I', 'SBST106', 2, 2, 3, 10),
                                                                                                     (178, 'MESLEKİ MATEMATİK II', 'SBST116', 4, 2, 3, 9),
                                                                                                     (179, 'SEÇİMLİK DERS II', 'TEKN002', 2, 2, 3, 13),
                                                                                                     (180, 'TÜRK DİLİ II', 'TÜRK102', 2, 2, 3, 10),
                                                                                                     (181, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ I', 'ATA201', 2, 3, 3, 10),
                                                                                                     (182, 'TEKNİK SEÇİMLİK II', 'SBST002', 3, 3, 3, 11),
                                                                                                     (183, 'TEKNİK SEÇİMLİK III', 'SBST003', 1, 3, 3, 9),
                                                                                                     (184, 'VERİ TABANI II', 'SBST209', 2, 3, 3, 15),
                                                                                                     (185, 'GÖRSEL PROGRAMLAMA I', 'SBST223', 2, 3, 3, 15),
                                                                                                     (186, 'SAĞLIK BİLGİ SİSTEMLERİ', 'SBST225', 3, 3, 3, 14),
                                                                                                     (187, 'STAJ I', 'SBST251', 0, 3, 3, 10),
                                                                                                     (188, 'SEÇİMLİK III', 'TEKN008', 2, 3, 3, 15),
                                                                                                     (189, 'ATATÜRK İLKELERİ VE İNKILAP TARİHİ II', 'ATA202', 2, 4, 3, 13),
                                                                                                     (190, 'TEKNİK SEÇİMLİK IV', 'SBST004', 1, 4, 3, 15),
                                                                                                     (191, 'TEKNİK SEÇİMLİK V', 'SBST005', 3, 4, 3, 10),
                                                                                                     (192, 'AĞ TEMELLERİ', 'SBST206', 2, 4, 3, 8),
                                                                                                     (193, 'SAĞLIK BİLİŞİMİ', 'SBST224', 3, 4, 3, 8),
                                                                                                     (194, 'HASTANE BİLGİ YÖNETİM SİSTEMLERİ', 'SBST226', 2, 4, 3, 10),
                                                                                                     (195, 'MESLEKİ PROJE', 'SBST238', 2, 4, 3, 12),
                                                                                                     (196, 'STAJ II', 'SBST252', 0, 4, 3, 11),
                                                                                                     (197, 'SEÇİMLİK DERS IV', 'TEKN004', 2, 4, 3, 14);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `course_status`
--

CREATE TABLE `course_status` (
                                 `id` int(11) NOT NULL,
                                 `status_id` int(11) NOT NULL,
                                 `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `course_status`
--

INSERT INTO `course_status` (`id`, `status_id`, `status_name`) VALUES
                                                                   (1, 1, 'Alındı'),
                                                                   (2, 2, 'Kaldı'),
                                                                   (3, 3, 'Muaf'),
                                                                   (4, 4, 'Sayıldı'),
                                                                   (5, 5, 'Tekrar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departments`
--

CREATE TABLE `departments` (
                               `id` int(11) NOT NULL,
                               `name` varchar(255) NOT NULL,
                               `faculty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `departments`
--

INSERT INTO `departments` (`id`, `name`, `faculty_id`) VALUES
                                                           (1, 'Yönetim Bilişim Sistemleri Bölümü', 1),
                                                           (2, 'Bilgisayar Mühendisliği Bölümü', 2),
                                                           (3, 'Bilgisayar Programcılığı Bölümü', 3),
                                                           (4, 'Hukuk Bölümü', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `faculties`
--

CREATE TABLE `faculties` (
                             `id` int(11) NOT NULL,
                             `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `faculties`
--

INSERT INTO `faculties` (`id`, `name`) VALUES
                                           (1, 'Ticari Bilimler Fakültesi'),
                                           (2, 'Mühendislik Fakültesi'),
                                           (3, 'Teknik Bilimler Meslek Yüksekokulu'),
                                           (4, 'Hukuk Fakültesi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lecturers`
--

CREATE TABLE `lecturers` (
                             `id` int(11) NOT NULL,
                             `name` varchar(255) NOT NULL,
                             `title` varchar(30) NOT NULL,
                             `password` varchar(255) NOT NULL,
                             `phone` bigint(20) NOT NULL,
                             `room` varchar(10) NOT NULL,
                             `image_url` varchar(255) NOT NULL,
                             `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `title`, `password`, `phone`, `room`, `image_url`, `department_id`) VALUES
                                                                                                               (1, 'Esma Ergüner Özkoç', 'Doç. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466698, 'C201', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=375889', 1),
                                                                                                               (2, 'Erdem Kırkbeşoğlu', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'C202', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=139023', 1),
                                                                                                               (3, 'Murat Paşa Uysal', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'C203', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=126012099', 1),
                                                                                                               (4, 'Gizem Öğütçü Ulaş', 'Dr. Öğr. Üyesi', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'C203', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=276335', 1),
                                                                                                               (5, 'Gülten Şenkul', 'Öğr. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'C204', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=76583', 1),
                                                                                                               (6, 'Begüm Şener', 'Araş. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'C205', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=627511', 1),
                                                                                                               (7, 'İlker Kocaoğlu', 'Araş. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'C206', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=688215', 1),
                                                                                                               (8, 'Sıtkı Çağdaş İmam', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B200', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=117617', 3),
                                                                                                               (9, 'Arif Koçoğlu', 'Öğr. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B201', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=76667', 3),
                                                                                                               (10, 'Emre Öner Tartan', 'Öğr. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B202', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=338243', 3),
                                                                                                               (11, 'Seda Bengi', 'Dr. Öğr. Üyesi', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B203', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=126008081', 3),
                                                                                                               (12, 'Gökay karayeğen', 'Dr. Öğr. Üyesi', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B204', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=126012687', 3),
                                                                                                               (13, 'Ahmet Turgut Tunceer', 'Dr. Öğr. Üyesi', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B206', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=139009', 3),
                                                                                                               (14, 'Tuğba Altındağ', 'Öğr. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B207', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=577027', 3),
                                                                                                               (15, 'Ramazan Tekinarslan', 'Öğr. Gör.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'B208', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=53357', 3),
                                                                                                               (16, 'Emre Sümer', 'Doç. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'A100', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=76345', 2),
                                                                                                               (17, 'Musatafa Sert', 'Doç. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'A101', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=348253', 2),
                                                                                                               (18, 'Hasan Hamit Yurtseven', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'A102', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=126012253', 2),
                                                                                                               (19, 'Çağatay Berke', 'Dr. Öğr. Üyesi', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'A102', 'https://bil.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=33995', 2),
                                                                                                               (20, 'İhsan Erdoğan', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466645, 'H100', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=653565', 4),
                                                                                                               (21, 'Mehmet Emin Akgül', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466640, 'H101', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=418841', 4),
                                                                                                               (22, 'Zeynep İpek Yücer', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'H103', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=153569', 4),
                                                                                                               (23, 'Ali Akyıldız', 'Prof. Dr.', 'QVeePSMxicLiw69FwQyWxQ==', 3122466666, 'H104', 'https://truva.baskent.edu.tr/kw/akademik_kadro_foto.php?oid=126005407', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seasons`
--

CREATE TABLE `seasons` (
                           `id` int(11) NOT NULL,
                           `season_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `seasons`
--

INSERT INTO `seasons` (`id`, `season_name`) VALUES
                                                (1, 'Birinci Yarıyıl (Güz)'),
                                                (2, 'İkinci Yarıyıl (Bahar)'),
                                                (3, 'Üçüncü Yarıyıl (Güz)'),
                                                (4, 'Dördüncü Yarıyıl (Bahar)'),
                                                (5, 'Beşinci Yarıyıl (Bahar)'),
                                                (6, 'Altıncı Yarıyıl (Bahar)'),
                                                (7, 'Yedinci Yarıyıl (Güz)'),
                                                (8, 'Sekizinci Yarıyıl (Bahar)');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) NOT NULL,
                            `surname` varchar(255) NOT NULL,
                            `password` varchar(255) NOT NULL,
                            `email` varchar(100) NOT NULL,
                            `student_no` bigint(20) NOT NULL,
                            `image_url` varchar(100) NOT NULL,
                            `department_id` int(11) DEFAULT NULL,
                            `advisor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `password`, `email`, `student_no`, `image_url`, `department_id`, `advisor_id`) VALUES
                                                                                                                                    (1, 'Mehmet Yiğit', 'Yalım', 'ZUxOy6RbDU77917q3vgB4Q==', 'mehmet@gmail.com', 22399141, '/public/images/myy-profile.jpeg', 1, 5),
                                                                                                                                    (2, 'Özgür', 'Özgün', 'ZUxOy6RbDU77917q3vgB4Q==', 'ozgur@gmail.com', 22297195, '/public/images/ozgur.png', 1, 1),
                                                                                                                                    (3, 'Onur', 'Uçan', 'ZUxOy6RbDU77917q3vgB4Q==', 'onur@gmail.com', 22197056, '/public/images/onur.jpeg', 4, 22),
                                                                                                                                    (4, 'Yağmur', 'Durgen', '123', 'yagmur@gmail.com', 22298581, '/public/images/yagmur.jpeg', 4, 21),
                                                                                                                                    (5, 'Ahmet', 'Korkmaz', '123', 'ahmet@gmail.com', 22195385, '/public/images/ahmet.jpeg', 3, 13),
                                                                                                                                    (6, 'Yağmur', 'Danacı', '123', 'yagmur@gmail.com', 22198714, '/public/images/yagmur.jpeg', 3, 14),
                                                                                                                                    (7, 'Berk Yağız', 'Özlen', '123', 'berk@gmail.com', 22191293, '/public/images/berk.jpeg', 2, 18),
                                                                                                                                    (8, 'Efe', 'Salkım', '123', 'efe@gmail.com', 22298515, '/public/images/efe.jpeg', 2, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `student_courses`
--

CREATE TABLE `student_courses` (
                                   `id` int(11) NOT NULL,
                                   `student_id` int(11) DEFAULT NULL,
                                   `course_id` int(11) DEFAULT NULL,
                                   `semester` varchar(50) DEFAULT NULL,
                                   `grade` char(2) DEFAULT NULL,
                                   `status` int(11) DEFAULT NULL,
                                   `first_time_taken` tinyint(1) DEFAULT NULL,
                                   `repeated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `student_courses`
--

INSERT INTO `student_courses` (`id`, `student_id`, `course_id`, `semester`, `grade`, `status`, `first_time_taken`, `repeated`) VALUES
                                                                                                                                   (1, 1, 13, 'Birinci Yarıyıl', 'B+', 1, 0, 0),
                                                                                                                                   (2, 1, 2, 'Birinci Yarıyıl', 'F1', 2, 0, 0),
                                                                                                                                   (3, 1, 4, 'Birinci Yarıyıl', 'C', 1, 0, 0),
                                                                                                                                   (4, 1, 31, 'Altıncı Yarıyıl', 'DD', 4, 0, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `courses`
--
ALTER TABLE `courses`
    ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `lecturer_id` (`lecturer_id`),
  ADD KEY `courses_ibfk_3` (`season`);

--
-- Tablo için indeksler `course_status`
--
ALTER TABLE `course_status`
    ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `departments`
--
ALTER TABLE `departments`
    ADD PRIMARY KEY (`id`),
  ADD KEY `departmens_ibfk_1` (`faculty_id`);

--
-- Tablo için indeksler `faculties`
--
ALTER TABLE `faculties`
    ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `lecturers`
--
ALTER TABLE `lecturers`
    ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Tablo için indeksler `seasons`
--
ALTER TABLE `seasons`
    ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
    ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `advisor_id` (`advisor_id`);

--
-- Tablo için indeksler `student_courses`
--
ALTER TABLE `student_courses`
    ADD PRIMARY KEY (`id`),
  ADD KEY `student_ibfk` (`student_id`),
  ADD KEY `course_ibfk` (`course_id`),
  ADD KEY `course_status_ibfk` (`status`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `courses`
--
ALTER TABLE `courses`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- Tablo için AUTO_INCREMENT değeri `course_status`
--
ALTER TABLE `course_status`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `departments`
--
ALTER TABLE `departments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `faculties`
--
ALTER TABLE `faculties`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `lecturers`
--
ALTER TABLE `lecturers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `seasons`
--
ALTER TABLE `seasons`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `students`
--
ALTER TABLE `students`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `student_courses`
--
ALTER TABLE `student_courses`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `courses`
--
ALTER TABLE `courses`
    ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`),
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`season`) REFERENCES `seasons` (`id`);

--
-- Tablo kısıtlamaları `departments`
--
ALTER TABLE `departments`
    ADD CONSTRAINT `departmens_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Tablo kısıtlamaları `lecturers`
--
ALTER TABLE `lecturers`
    ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Tablo kısıtlamaları `students`
--
ALTER TABLE `students`
    ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`advisor_id`) REFERENCES `lecturers` (`id`);

--
-- Tablo kısıtlamaları `student_courses`
--
ALTER TABLE `student_courses`
    ADD CONSTRAINT `course_ibfk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_status_ibfk` FOREIGN KEY (`status`) REFERENCES `course_status` (`id`),
  ADD CONSTRAINT `student_ibfk` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
