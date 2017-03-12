-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 11 Mars 2017 à 16:12
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `winjobx`
--

-- --------------------------------------------------------

--
-- Structure de la table `adminresettoken`
--

DROP TABLE IF EXISTS `adminresettoken`;
CREATE TABLE `adminresettoken` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` varchar(2) NOT NULL,
  `ctime` int(30) NOT NULL,
  `etime` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `adminresettoken`
--

INSERT INTO `adminresettoken` (`id`, `token`, `user`, `status`, `ctime`, `etime`) VALUES
(43, 'e3eb4d4881cd75d219f7ed4fb7cfe51e', '1', '1', 1458927045, 1458937845),
(44, '154dab1587e7dbeab8c900b4e4bdc7ed', '1', '1', 1458927183, 1458937983),
(45, '6569f67932da930d67c7f1e8f4ac00a2', '1', '1', 1458929951, 1458940751),
(46, '1f1db6df057bf9206f7d6396af6d90fd', '1', '1', 1458929966, 1458940766),
(48, 'c1efc57fa035febbc8074680321afa81', '1', '1', 1458931712, 1458942512),
(49, '281be79944e62868b00a8c8ef765236e', '1', '1', 1458931734, 1458942534),
(51, '4e56b82be5325c986a0faa1e7569321c', '1', '1', 1469139039, 1469149839),
(52, '7aee0ff929f83daefdec66a0f897b876', '1', '1', 1469139228, 1469150028),
(53, '2dd6f6ef5393b54f0e963178a706d86f', '1', '1', 1469139628, 1469150428);

-- --------------------------------------------------------

--
-- Structure de la table `billingmethodlist`
--

DROP TABLE IF EXISTS `billingmethodlist`;
CREATE TABLE `billingmethodlist` (
  `sr` int(255) NOT NULL,
  `belongsTo` int(255) NOT NULL,
  `paymentMethod` varchar(11) COLLATE utf8_bin NOT NULL COMMENT 'cc or paypal',
  `attachedTo` int(11) NOT NULL,
  `isPrimary` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `billingmethodlist`
--

INSERT INTO `billingmethodlist` (`sr`, `belongsTo`, `paymentMethod`, `attachedTo`, `isPrimary`, `isDeleted`) VALUES
(21, 18, 'stripe', 40, 0, 1),
(22, 18, 'stripe', 41, 0, 1),
(55, 18, 'paypal', 36, 0, 1),
(56, 18, 'paypal', 38, 0, 1),
(57, 29, 'paypal', 39, 0, 1),
(58, 18, 'paypal', 40, 0, 1),
(59, 18, 'paypal', 41, 0, 0),
(60, 18, 'stripe', 47, 0, 1),
(61, 18, 'stripe', 48, 0, 1),
(62, 18, 'stripe', 52, 1, 0),
(63, 18, 'stripe', 53, 0, 1),
(64, 18, 'stripe', 54, 0, 1),
(65, 18, 'stripe', 55, 0, 1),
(66, 18, 'stripe', 56, 0, 1),
(67, 18, 'stripe', 57, 0, 1),
(68, 18, 'stripe', 58, 0, 1),
(69, 18, 'stripe', 59, 0, 1),
(70, 18, 'stripe', 60, 0, 1),
(71, 18, 'stripe', 61, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ccdetails`
--

DROP TABLE IF EXISTS `ccdetails`;
CREATE TABLE `ccdetails` (
  `sr` int(255) NOT NULL,
  `fname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lname` varchar(255) COLLATE utf8_bin NOT NULL,
  `cardNumber` varchar(20) COLLATE utf8_bin NOT NULL,
  `cvv` int(3) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `country` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` longtext COLLATE utf8_bin NOT NULL,
  `address2` longtext COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `zip` varchar(255) COLLATE utf8_bin NOT NULL,
  `dateAdded` double NOT NULL,
  `dateUpdated` double NOT NULL,
  `belongsTo` double NOT NULL COMMENT 'userID from the user''s table',
  `isDeleted` tinyint(4) NOT NULL COMMENT 'update to 0 if user delete the row'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `ccdetails`
--

INSERT INTO `ccdetails` (`sr`, `fname`, `lname`, `cardNumber`, `cvv`, `month`, `year`, `country`, `address`, `address2`, `city`, `zip`, `dateAdded`, `dateUpdated`, `belongsTo`, `isDeleted`) VALUES
(40, 'asda', 'asdasd', '4242', 123, 2, 2017, 'Pakistan', 'asd32', 'asdsad', 'asdsa', '12456', 1477682792, 1477682792, 18, 0),
(41, 'asdsa', 'sdfds', '4242', 123, 2, 2020, 'Pakistan', 'adsfdsf', 'sdfds', 'dsfsd', 'dsf', 1477685897, 1477685897, 18, 0),
(42, 'John', 'Smith', '4242', 123, 1, 2017, 'Pakistan', 'dgfsdg', 'fghdh', 'gdhgh', '2154', 1479583671, 1479583671, 18, 0),
(43, 'John', 'Smith', '4242', 123, 1, 2017, 'Pakistan', 'dgfsdg', 'fghdh', 'gdhgh', '2154', 1479583685, 1479583685, 18, 0),
(44, 'John', 'Smith', '4242', 123, 1, 2017, 'Pakistan', 'dgfsdg', 'fghdh', 'gdhgh', '2154', 1479583691, 1479583691, 18, 0),
(45, 'John ', 'Smith', '4242', 123, 11, 2017, 'Pakistan', 'test', 'test', 'test', '2154', 1479584352, 1479584352, 18, 0),
(46, 'Haseeb', 'Test', '4242', 223, 2, 2018, 'Pakistan', 'test address', 'te', 'rawalpindi', '46000', 1479655130, 1479655130, 18, 0),
(47, 'Haseeb', 'Test', '4242', 223, 2, 2018, 'Pakistan', 'test address', 'te', 'rawalpindi', '46000', 1479655320, 1479655320, 18, 0),
(48, 'Haseeb', 'Ur Rehma', '4242', 122, 5, 2019, 'Pakistan', 'test address', 'test', 'rawalpindi', '46000', 1479655524, 1479655524, 18, 0),
(49, 'Haseeb', 'Haseeb', '4242', 123, 2, 2017, 'Pakistan', 'tesssssst adddddreess', 'Haseeb', 'Islamabad', '44000', 1480453282, 1480453282, 18, 0),
(50, 'Haseeb', 'Haseeb', '4242', 123, 2, 2017, 'Pakistan', 'tesssssst adddddreess', 'Haseeb', 'Islamabad', '44000', 1480453416, 1480453416, 18, 0),
(51, 'Haseeb', 'Haseeb', '4242', 123, 2, 2017, 'Pakistan', 'tesssssst adddddreess', 'Haseeb', 'Islamabad', '44000', 1480453723, 1480453723, 18, 0),
(52, 'Haseeb', 'Haseeb', '4242', 123, 2, 2017, 'Pakistan', 'tesssssst adddddreess', 'Haseeb', 'Islamabad', '44000', 1480453744, 1480453744, 18, 0),
(53, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480515877, 1480515877, 18, 0),
(54, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480515897, 1480515897, 18, 0),
(55, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480516042, 1480516042, 18, 0),
(56, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480516108, 1480516108, 18, 0),
(57, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480516351, 1480516351, 18, 0),
(58, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480516359, 1480516359, 18, 0),
(59, 'Haseeb', 'Ur Rehma', '0002', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480516398, 1480516398, 18, 0),
(60, 'Haseeb', 'Ur Rehma', '5564', 123, 2, 2017, 'Pakistan', 'test', 'dfg', 'Islamabad', '44000', 1480516656, 1480516656, 18, 0),
(61, 'Haseeb', 'deb', '5556', 123, 2, 2018, 'Pakistan', 'teras', 'asdsa', 'Islamabad', '44000', 1480516905, 1480516905, 18, 0);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_shortcode` varchar(50) NOT NULL,
  `country_dialingcode` varchar(50) NOT NULL,
  `country_currency` varchar(50) NOT NULL,
  `country_currencycode` varchar(50) NOT NULL,
  `country_sub` varchar(2) NOT NULL,
  `country_avaliable` varchar(3) NOT NULL,
  `country_index` int(10) NOT NULL,
  `country_status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `country_shortcode`, `country_dialingcode`, `country_currency`, `country_currencycode`, `country_sub`, `country_avaliable`, `country_index`, `country_status`) VALUES
(1, 'UK', 'GB', '+44', '', '', '', '', 0, '1'),
(2, 'USA', 'US', '+1', '', '', '', '', 0, '1'),
(3, 'Algeria', 'DZ', '+213', '', '', '', '', 0, '1'),
(4, 'Andorra', 'AD', '+376', '', '', '', '', 0, '1'),
(5, 'Angola', 'AO', '+244', '', '', '', '', 0, '1'),
(6, 'Anguilla', 'AI', '+1264', '', '', '', '', 0, ''),
(7, 'Antigua & Barbuda', 'AG', '+1268', '', '', '', '', 0, '1'),
(8, 'Argentina', 'AR', '+54', '', '', '', '', 0, '1'),
(9, 'Armenia', 'AM', '+374', '', '', '', '', 0, '1'),
(10, 'Aruba', 'AW', '+297', '', '', '', '', 0, '1'),
(11, 'Australia', 'AU', '+61', '', '', '', '', 0, '1'),
(12, 'Austria', 'AT', '+43', '', '', '', '', 0, '1'),
(13, 'Azerbaijan', 'AZ', '+994', '', '', '', '', 0, '1'),
(14, 'Bahamas', 'BS', '+1242', '', '', '', '', 0, '1'),
(15, 'Bahrain', 'BH', '+973', '', '', '', '', 0, '1'),
(16, 'Bangladesh', 'BD', '+880', '', '', '', '', 0, '1'),
(17, 'Barbados', 'BB', '+1246', '', '', '', '', 0, '1'),
(18, 'Belarus', 'BY', '+375', '', '', '', '', 0, '1'),
(19, 'Belgium', 'BE', '+32', '', '', '', '', 0, '1'),
(20, 'Belize', 'BZ', '+501', '', '', '', '', 0, '1'),
(21, 'Benin', 'BJ', '+229', '', '', '', '', 0, '1'),
(22, 'Bermuda', 'BM', '+1441', '', '', '', '', 0, '1'),
(23, 'Bhutan', 'BT', '+975', '', '', '', '', 0, '1'),
(24, 'Bolivia', 'BO', '+591', '', '', '', '', 0, '1'),
(25, 'Bosnia Herzegovina', 'BA', '+387', '', '', '', '', 0, '1'),
(26, 'Botswana', 'BW', '+267', '', '', '', '', 0, '1'),
(27, 'Brazil', 'BR', '+55', '', '', '', '', 0, '1'),
(28, 'Brunei', 'BN', '+673', '', '', '', '', 0, '1'),
(29, 'Bulgaria', 'BG', '+359', '', '', '', '', 0, '1'),
(30, 'Burkina Faso', 'BF', '+226', '', '', '', '', 0, '1'),
(31, 'Burundi', 'BI', '+257', '', '', '', '', 0, '1'),
(32, 'Cambodia', 'KH', '+855', '', '', '', '', 0, '1'),
(33, 'Cameroon', 'CM', '+327', '', '', '', '', 0, '1'),
(34, 'Canada', 'CA', '+1', '', '', '', '', 0, '1'),
(35, 'Cape Verde Islands', 'CV', '+238', '', '', '', '', 0, '1'),
(36, 'Cayman Islands', 'KY', '+1345', '', '', '', '', 0, '1'),
(37, 'Central African Republic', 'CF', '+236', '', '', '', '', 0, '1'),
(38, 'Chile', 'CL', '+56', '', '', '', '', 0, '1'),
(39, 'China', 'CN', '+86', '', '', '', '', 0, '1'),
(40, 'Colombia', 'CO', '+57', '', '', '', '', 0, '1'),
(41, 'Comoros', 'KM', '+269', '', '', '', '', 0, '1'),
(42, 'Congo', 'CG', '+242', '', '', '', '', 0, '1'),
(43, 'Cook Islands', 'CK', '+682', '', '', '', '', 0, '1'),
(44, 'Costa Rica', 'CR', '+506', '', '', '', '', 0, '1'),
(45, 'Croatia', 'HR', '+385', '', '', '', '', 0, '1'),
(46, 'Cuba', 'CU', '+53', '', '', '', '', 0, '1'),
(47, 'Cyprus North', 'CY', '+90392', '', '', '', '', 0, '1'),
(48, 'Cyprus South', 'CY', '+357', '', '', '', '', 0, '1'),
(49, 'Czech Republic', 'CZ', '+42', '', '', '', '', 0, '1'),
(50, 'Denmark', 'DK', '+45', '', '', '', '', 0, '1'),
(51, 'Djibouti', 'DJ', '+253', '', '', '', '', 0, '1'),
(52, 'Dominica', 'DM', '+1809', '', '', '', '', 0, '1'),
(53, 'Dominican Republic', 'DO', '+1809', '', '', '', '', 0, '1'),
(54, 'Ecuador', 'EC', '+593', '', '', '', '', 0, '1'),
(55, 'Egypt', 'EG', '+20', '', '', '', '', 0, '1'),
(56, 'El Salvador', 'SV', '+503', '', '', '', '', 0, '1'),
(57, 'Equatorial Guinea', 'GQ', '+240', '', '', '', '', 0, '1'),
(58, 'Eritrea', 'ER', '+291', '', '', '', '', 0, '1'),
(59, 'Estonia', 'EE', '+372', '', '', '', '', 0, '1'),
(60, 'Ethiopia', 'ET', '+251', '', '', '', '', 0, '1'),
(61, 'Falkland Islands', 'FK', '+500', '', '', '', '', 0, '1'),
(62, 'Faroe Islands', 'FO', '+298', '', '', '', '', 0, '1'),
(63, 'Fiji', 'FJ', '+679', '', '', '', '', 0, '1'),
(64, 'Finland', 'FI', '+358', '', '', '', '', 0, '1'),
(65, 'France', 'FR', '+33', '', '', '', '', 0, '1'),
(66, 'French Guiana', 'GF', '+594', '', '', '', '', 0, '1'),
(67, 'French Polynesia', 'PF', '+689', '', '', '', '', 0, '1'),
(68, 'Gabon', 'GA', '+241', '', '', '', '', 0, '1'),
(69, 'Gambia', 'GM', '+220', '', '', '', '', 0, '1'),
(70, 'Georgia', 'GE', '+7880', '', '', '', '', 0, '1'),
(71, 'Germany', 'DE', '+49', '', '', '', '', 0, '1'),
(72, 'Ghana', 'GH', '+233', '', '', '', '', 0, '1'),
(73, 'Gibraltar', 'GI', '+350', '', '', '', '', 0, '1'),
(74, 'Greece', 'GR', '+30', '', '', '', '', 0, '1'),
(75, 'Greenland', 'GL', '+299', '', '', '', '', 0, '1'),
(76, 'Grenada', 'GD', '+1473', '', '', '', '', 0, '1'),
(77, 'Guadeloupe', 'GP', '+590', '', '', '', '', 0, '1'),
(78, 'Guatemala', 'GT', '502', '', '', '', '', 0, '1'),
(79, 'Guinea', 'GN', '+224', '', '', '', '', 0, '1'),
(80, 'Guinea - Bissau', 'GW', '+245', '', '', '', '', 0, '1'),
(81, 'Guyana', 'GY', '+592', '', '', '', '', 0, '1'),
(82, 'Haiti', 'HT', '+509', '', '', '', '', 0, '1'),
(83, 'Honduras', 'HN', '+504', '', '', '', '', 0, '1'),
(84, 'Hong Kong', 'HK', '+852', '', '', '', '', 0, '1'),
(85, 'Hungary', 'HU', '+36', '', '', '', '', 0, '1'),
(86, 'Iceland', 'IS', '+354', '', '', '', '', 0, '1'),
(87, 'India', 'IN', '+91', '', '', '', '', 0, '1'),
(88, 'Indonesia', 'ID', '+62', '', '', '', '', 0, '1'),
(89, 'Iran', 'IR', '+98', '', '', '', '', 0, '1'),
(90, 'Iraq', 'IQ', '+964', '', '', '', '', 0, '1'),
(91, 'Ireland', 'IE', '+353', '', '', '', '', 0, '1'),
(92, 'Israel', 'IL', '+972', '', '', '', '', 0, '1'),
(93, 'Italy', 'IT', '+39', '', '', '', '', 0, '1'),
(94, 'Jamaica', 'JM', '+1876', '', '', '', '', 0, '1'),
(95, 'Japan', 'JP', '+81', '', '', '', '', 0, '1'),
(96, 'Jordan', 'JO', '+962', '', '', '', '', 0, '1'),
(97, 'Kazakhstan', 'KZ', '+7', '', '', '', '', 0, '1'),
(98, 'Kenya', 'KE', '+254', '', '', '', '', 0, '1'),
(99, 'Kiribati', 'KI', '+686', '', '', '', '', 0, '1'),
(100, 'Korea North', 'KP', '+850', '', '', '', '', 0, '1'),
(101, 'Korea South', 'KR', '+82', '', '', '', '', 0, '1'),
(102, 'Kuwait', 'KW', '+965', '', '', '', '', 0, '1'),
(103, 'Kyrgyzstan', 'KG', '+996', '', '', '', '', 0, '1'),
(104, 'Laos', 'LA', '+856', '', '', '', '', 0, '1'),
(105, 'Latvia', 'LV', '+371', '', '', '', '', 0, '1'),
(106, 'Lebanon', 'LB', '+961', '', '', '', '', 0, '1'),
(107, 'Lesotho', 'LS', '+266', '', '', '', '', 0, '1'),
(108, 'Liberia', 'LR', '+231', '', '', '', '', 0, '1'),
(109, 'Libya', 'LY', '+218', '', '', '', '', 0, '1'),
(110, 'Liechtenstein', 'LI', '+417', '', '', '', '', 0, '1'),
(111, 'Lithuania', 'LT', '+370', '', '', '', '', 0, '1'),
(112, 'Luxembourg', 'LU', '+352', '', '', '', '', 0, '1'),
(113, 'Macao', 'MO', '+853', '', '', '', '', 0, '1'),
(114, 'Macedonia', 'MK', '+389', '', '', '', '', 0, '1'),
(115, 'Madagascar', 'MG', '+261', '', '', '', '', 0, '1'),
(116, 'Malawi', 'MW', '+265', '', '', '', '', 0, '1'),
(117, 'Malaysia', 'MY', '+60', '', '', '', '', 0, '1'),
(118, 'Maldives', 'MV', '+960', '', '', '', '', 0, '1'),
(119, 'Mali', 'ML', '+223', '', '', '', '', 0, '1'),
(120, 'Malta', 'MT', '+356', '', '', '', '', 0, '1'),
(121, 'Marshall Islands', 'MH', '+692', '', '', '', '', 0, '1'),
(122, 'Martinique', 'MQ', '+596', '', '', '', '', 0, '1'),
(123, 'Mauritania', 'MR', '+222', '', '', '', '', 0, '1'),
(124, 'Mayotte', 'YT', '+269', '', '', '', '', 0, '1'),
(125, 'Mexico', 'MX', '+52', '', '', '', '', 0, '1'),
(126, 'Micronesia', 'FM', '+691', '', '', '', '', 0, '1'),
(127, 'Moldova', 'MD', '+373', '', '', '', '', 0, '1'),
(128, 'Monaco', 'MC', '+377', '', '', '', '', 0, '1'),
(129, 'Mongolia', 'MN', '+976', '', '', '', '', 0, '1'),
(130, 'Montserrat', 'MS', '+1664', '', '', '', '', 0, '1'),
(131, 'Morocco', 'MA', '+212', '', '', '', '', 0, '1'),
(132, 'Mozambique', 'MZ', '+258', '', '', '', '', 0, '1'),
(133, 'Myanmar', 'MN', '+95', '', '', '', '', 0, '1'),
(134, 'Namibia', 'NA', '+264', '', '', '', '', 0, '1'),
(135, 'Nauru', 'NR', '+674', '', '', '', '', 0, '1'),
(136, 'Nepal', 'NP', '+977', '', '', '', '', 0, '1'),
(137, 'Netherlands', 'NL', '+31', '', '', '', '', 0, '1'),
(138, 'New Caledonia', 'NC', '+687', '', '', '', '', 0, '1'),
(139, 'Nicaragua', 'NI', '+505', '', '', '', '', 0, '1'),
(140, 'New Zealand', 'NZ', '+64', '', '', '', '', 0, '1'),
(141, 'Niger', 'NE', '+227', '', '', '', '', 0, '1'),
(142, 'Nigeria', 'NG', '234', '', '', '', '', 0, '1'),
(143, 'Niue', 'NU', '+683', '', '', '', '', 0, '1'),
(144, 'Norfolk Islands', 'NF', '+672', '', '', '', '', 0, '1'),
(145, 'Northern Marianas', 'NP', '+670', '', '', '', '', 0, '1'),
(146, 'Norway', 'NO', '+47', '', '', '', '', 0, '1'),
(147, 'Oman', 'OM', '+968', '', '', '', '', 0, '1'),
(148, 'Palau', 'PW', '+680', '', '', '', '', 0, '1'),
(149, 'Panama', 'PA', '+507', '', '', '', '', 0, '1'),
(150, 'Papua New Guinea', 'PG', '+675', '', '', '', '', 0, '1'),
(151, 'Paraguay', 'PY', '595', '', '', '', '', 0, '1'),
(152, 'Peru', 'PE', '+51', '', '', '', '', 0, '1'),
(153, 'Philippines', 'PH', '+63', '', '', '', '', 0, '1'),
(154, 'Poland', 'PL', '+48', '', '', '', '', 0, '1'),
(155, 'Portugal', 'PT', '+351', '', '', '', '', 0, '1'),
(156, 'Puerto Rico', 'PR', '+1787', '', '', '', '', 0, '1'),
(157, 'Qatar', 'QA', '+974', '', '', '', '', 0, '1'),
(158, 'Reunion', 'RE', '+262', '', '', '', '', 0, '1'),
(159, 'Romania', 'RO', '+40', '', '', '', '', 0, '1'),
(160, 'Russia', 'RU', '+7', '', '', '', '', 0, '1'),
(161, 'Rwanda', 'RW', '+250', '', '', '', '', 0, '1'),
(162, 'San Marino', 'SM', '+378', '', '', '', '', 0, '1'),
(163, 'Sao Tome & Principe', 'ST', '+239', '', '', '', '', 0, '1'),
(164, 'Saudi Arabia', 'SA', '+966', '', '', '', '', 0, '1'),
(165, 'Senegal', 'SN', '+221', '', '', '', '', 0, '1'),
(166, 'Serbia', 'CS', '+381', '', '', '', '', 0, '1'),
(167, 'Seychelles', 'SC', '+248', '', '', '', '', 0, '1'),
(168, 'Sierra Leone', 'SL', '+232', '', '', '', '', 0, '1'),
(169, 'Singapore', 'SG', '+65', '', '', '', '', 0, '1'),
(170, 'Slovak Republic', 'SK', '+421', '', '', '', '', 0, '1'),
(171, 'Slovenia', 'SI', '+386', '', '', '', '', 0, '1'),
(172, 'Solomon Islands', 'SB', '+677', '', '', '', '', 0, '1'),
(173, 'Somalia', 'SO', '+252', '', '', '', '', 0, '1'),
(174, 'South Africa', 'ZA', '+27', '', '', '', '', 0, '1'),
(175, 'Spain', 'ES', '+34', '', '', '', '', 0, '1'),
(176, 'Sri Lanka', 'LK', '+94', '', '', '', '', 0, '1'),
(177, 'St. Helena', 'SH', '+290', '', '', '', '', 0, '1'),
(178, 'St. Kitts', 'KN', '+1869', '', '', '', '', 0, '1'),
(179, 'St. Lucia', 'SC', '+1758', '', '', '', '', 0, '1'),
(180, 'Sudan', 'SD', '+249', '', '', '', '', 0, '1'),
(181, 'Suriname', 'SR', '+597', '', '', '', '', 0, '1'),
(182, 'Swaziland', 'SZ', '+268', '', '', '', '', 0, '1'),
(183, 'Sweden', 'SE', '+46', '', '', '', '', 0, '1'),
(184, 'Switzerland', 'CH', '+41', '', '', '', '', 0, '1'),
(185, 'Syria', 'SI', '+963', '', '', '', '', 0, '1'),
(186, 'Taiwan', 'TW', '+886', '', '', '', '', 0, '1'),
(187, 'Tajikstan', 'TJ', '+7', '', '', '', '', 0, '1'),
(188, 'Thailand', 'TH', '+66', '', '', '', '', 0, '1'),
(189, 'Togo', 'TG', '+228', '', '', '', '', 0, '1'),
(190, 'Tonga', 'TO', '+676', '', '', '', '', 0, '1'),
(191, 'Trinidad & Tobago', 'TT', '+1868', '', '', '', '', 0, '1'),
(192, 'Tunisia', 'TN', '+216', '', '', '', '', 0, '1'),
(193, 'Turkey', 'TR', '+90', '', '', '', '', 0, '1'),
(194, 'Turkmenistan', 'TM', '+7', '', '', '', '', 0, '1'),
(195, 'Turkmenistan', 'TM', '+993', '', '', '', '', 0, '1'),
(196, 'Turks & Caicos Islands', 'TC', '+1649', '', '', '', '', 0, '1'),
(197, 'Tuvalu', 'TV', '+688', '', '', '', '', 0, '1'),
(198, 'Uganda', 'UG', '+256', '', '', '', '', 0, '1'),
(199, 'Ukraine', 'UA', '+380', '', '', '', '', 0, '1'),
(200, 'United Arab Emirates', 'AE', '+971', '', '', '', '', 0, '1'),
(201, 'Uruguay', 'UY', '+598', '', '', '', '', 0, '1'),
(202, 'Uzbekistan', 'UZ', '+7', '', '', '', '', 0, '1'),
(203, 'Vanuatu', 'VU', '+678', '', '', '', '', 0, '1'),
(204, 'Vatican City', 'VA', '+379', '', '', '', '', 0, '1'),
(205, 'Venezuela', 'VE', '+58', '', '', '', '', 0, '1'),
(206, 'Vietnam', 'VN', '+84', '', '', '', '', 0, '1'),
(207, 'Virgin Islands - British', 'VG', '+1284', '', '', '', '', 0, '1'),
(208, 'Virgin Islands - US', 'VI', '+1340', '', '', '', '', 0, '1'),
(209, 'Wallis & Futuna', 'WF', '+681', '', '', '', '', 0, '1'),
(210, 'Yemen (North)', 'YE', '+969', '', '', '', '', 0, '1'),
(211, 'Yemen (South)', 'YE', '+967', '', '', '', '', 0, '1'),
(212, 'Zambia', 'ZM', '+260', '', '', '', '', 0, '1'),
(213, 'Zimbabwe', 'ZW', '+263', '', '', '', '', 0, '1');

-- --------------------------------------------------------

--
-- Structure de la table `daily_hourly_invoice`
--

DROP TABLE IF EXISTS `daily_hourly_invoice`;
CREATE TABLE `daily_hourly_invoice` (
  `id_daily_hourly_invoice` int(11) NOT NULL,
  `contract_id` int(100) NOT NULL,
  `des` text NOT NULL,
  `fuser_id` int(10) NOT NULL,
  `cuser_id` int(10) NOT NULL,
  `trans_through` varchar(100) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `daily_hourly_transaction`
--

DROP TABLE IF EXISTS `daily_hourly_transaction`;
CREATE TABLE `daily_hourly_transaction` (
  `id_daily_hourly_transaction` int(11) NOT NULL,
  `contract_id` varchar(100) NOT NULL,
  `des` text NOT NULL,
  `fuser_id` int(10) NOT NULL,
  `cuser_id` int(10) NOT NULL,
  `trans_through` varchar(100) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `daily_hourly_transaction`
--

INSERT INTO `daily_hourly_transaction` (`id_daily_hourly_transaction`, `contract_id`, `des`, `fuser_id`, `cuser_id`, `trans_through`, `transaction_id`, `status`, `currency`, `amount`, `date`) VALUES
(1, '13_NYVK5HQ3QP', '1hrs*$5.00', 13, 18, 'paypal', '49B73233JS3005517', 'Processed', '', '5.000', '2017-02-05 11:59:59'),
(2, '13_3Q6QGBXY20', '5hrs*$5.00', 13, 18, 'paypal', '4VV765549N6529153', 'Processed', '', '25.000', '2017-02-06 11:59:59'),
(3, '13_NYVK5HQ3QP', '5hrs*$5.00', 13, 18, 'paypal', '2H871260K5306254F', 'Processed', '', '25.000', '2017-02-21 11:59:59');

-- --------------------------------------------------------

--
-- Structure de la table `freelancer_education`
--

DROP TABLE IF EXISTS `freelancer_education`;
CREATE TABLE `freelancer_education` (
  `id` int(11) NOT NULL,
  `fuser_id` int(11) NOT NULL,
  `school` varchar(300) NOT NULL,
  `dates_attend_from` varchar(100) NOT NULL,
  `dates_attend_to` varchar(100) NOT NULL,
  `degree` varchar(300) NOT NULL,
  `field_of_study` varchar(300) NOT NULL,
  `grade` decimal(10,3) NOT NULL,
  `activities` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `freelancer_education`
--

INSERT INTO `freelancer_education` (`id`, `fuser_id`, `school`, `dates_attend_from`, `dates_attend_to`, `degree`, `field_of_study`, `grade`, `activities`, `description`) VALUES
(3, 26, 'rsv', '1982', '1981', 'btech', 'adadad', '0.000', 'adadad', 'adada adad'),
(4, 9, 'dfdfg', '1995', '1993', 'fgfg', 'fgfg', '0.000', 'fgfg', 'fgfg'),
(9, 13, 'S1', '1984', '1988', 'D1', 'FS1', '0.000', 'AaS1', 'Descr1'),
(10, 13, 'S1', '1984', '1988', 'D1', 'FS1', '0.000', 'AaS1', 'Descr1'),
(15, 13, 'S1', '1984', '1988', 'D1', 'FS1', '0.000', 'AaS1', 'Descr1');

-- --------------------------------------------------------

--
-- Structure de la table `instagramtoken`
--

DROP TABLE IF EXISTS `instagramtoken`;
CREATE TABLE `instagramtoken` (
  `instagramtoken_id` int(11) NOT NULL,
  `instagramtoken_owner` varchar(100) NOT NULL,
  `instagramtoken_userid` varchar(100) NOT NULL,
  `instagramtoken_usertoken` varchar(200) NOT NULL,
  `instagramtoken_name` varchar(100) NOT NULL,
  `instagramtoken_username` varchar(50) NOT NULL,
  `instagramtoken_picture` varchar(500) NOT NULL,
  `instagramtoken_media` varchar(10) NOT NULL,
  `instagramtoken_followedby` varchar(10) NOT NULL,
  `instagramtoken_follows` varchar(10) NOT NULL,
  `instagramtoken_status` varchar(2) NOT NULL,
  `instagramtoken_updated` varchar(30) NOT NULL,
  `instagramtoken_added` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `instagramtoken`
--

INSERT INTO `instagramtoken` (`instagramtoken_id`, `instagramtoken_owner`, `instagramtoken_userid`, `instagramtoken_usertoken`, `instagramtoken_name`, `instagramtoken_username`, `instagramtoken_picture`, `instagramtoken_media`, `instagramtoken_followedby`, `instagramtoken_follows`, `instagramtoken_status`, `instagramtoken_updated`, `instagramtoken_added`) VALUES
(7, 'na', '665850116', '665850116.9d4f6d0.910bbf5551c94e3dbeac83b9b5657a9a', 'Noam', 'noampinch', 'https://scontent.cdninstagram.com/t51.2885-19/11296870_872387159494395_697383944_a.jpg', '19', '54', '34', '1', '1469933454', '1469890816'),
(9, 'na', '1524272104', '1524272104.9d4f6d0.da8ee346945f4265a7790fd0797150d7', 'Sabbir Hossain Sagar', 'sagarmebd', 'https://scontent.cdninstagram.com/t51.2885-19/s150x150/12965801_960344197407034_1432089091_a.jpg', '87', '829', '580', '1', '1469962249', '1469961581');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `job_description` text,
  `job_type` varchar(100) DEFAULT NULL,
  `skills` text,
  `job_duration` varchar(100) DEFAULT NULL,
  `experience_level` varchar(100) DEFAULT NULL,
  `budget` float(10,2) DEFAULT NULL,
  `hours_per_week` varchar(100) DEFAULT NULL,
  `userfile` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>close,open=>1',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `job_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `title`, `category`, `job_description`, `job_type`, `skills`, `job_duration`, `experience_level`, `budget`, `hours_per_week`, `userfile`, `status`, `created`, `job_created`) VALUES
(49, 35, 'seo ', 80, 'need seo for few website', 'fixed', 'seo ', 'less_than_1_week', 'Entry level', 1000.00, 'not_sure', '', 0, '2016-10-14 16:33:27', '0000-00-00 00:00:00'),
(50, 29, 'Wordpress Web Development', 1, 'Wordpress Web Development', 'fixed', 'PHP, ', '3_6_months', 'Entry level', 100.00, 'not_sure', '', 0, '2016-10-14 18:38:22', '0000-00-00 00:00:00'),
(59, 37, 'House keeper ', 32, 'Sweeping dusting,mopping, wiping down walls and desks. ', 'hourly', 'House keeper /Janitor ', 'more_than_6_months', 'Entry level', 0.00, '10-19', '/uploads/147779522717037.pdf', 0, '2016-10-30 02:40:52', '0000-00-00 00:00:00'),
(65, 29, 'houry testing job', 9, 'sdgggggggggggggggggggggggggggggggggggggggggggg\r\nfdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh\r\ndgfhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'hourly', 'PHP, ', '3_6_months', 'Experienced', 0.00, '1-9', '/uploads/1479844248144229.png', 0, '2016-11-22 19:50:48', '0000-00-00 00:00:00'),
(72, 29, 'Categorty test 1', 84, 'Categorty test 1', 'hourly', 'PHP', '3_6_months', 'Entry level', 0.00, '1-9', '', 0, '2016-11-24 15:00:11', '0000-00-00 00:00:00'),
(73, 29, 'catergory 2', 1, 'Create website current website is www.movingtargets.ca Use this as a basic outline of what I need. -must be easy to add or remove a product -integrated inventory tracking. Only sell product that is in stock. List products as in stock or out of stock -phone and desktop friendly -send to search engines, do initial SEO -main shipper for canada is Canpar courier. Canpar will provide sandbox to test website. -secondary couriers for international shipping are Fedex and DHL. Use the courier that is the least expensive -website will notify me when an order is placed, print out shipping labels -payment methods are paypal and credit card If this one is successful I have one other online store to create', 'fixed', 'PHP', '1_3_months', 'Entry level', 500.00, 'not_sure', '', 0, '2016-11-24 15:11:03', '0000-00-00 00:00:00'),
(74, 29, 'category 3', 84, 'Create website current website is www.movingtargets.ca Use this as a basic outline of what I need. -must be easy to add or remove a product -integrated inventory tracking. Only sell product that is in stock. List products as in stock or out of stock -phone and desktop friendly -send to search engines, do initial SEO -main shipper for canada is Canpar courier. Canpar will provide sandbox to test website. -secondary couriers for international shipping are Fedex and DHL. Use the courier that is the least expensive -website will notify me when an order is placed, print out shipping labels -payment methods are paypal and credit card If this one is successful I have one other online store to create', 'hourly', 'HTML', '3_6_months', 'Entry level', 0.00, '20-29', '', 0, '2016-11-24 15:11:35', '0000-00-00 00:00:00'),
(75, 29, 'category 4', 84, 'gdfhgfdhj', 'fixed', 'Jquery', '3_6_months', 'Entry level', 100.00, 'not_sure', '', 0, '2016-11-24 15:12:00', '0000-00-00 00:00:00'),
(82, 29, 'Archive testing', 80, 'dfhggtfdh', 'fixed', 'PHP', '3_6_months', 'Entry level', 500.00, 'not_sure', '', 0, '2016-12-03 17:04:50', '0000-00-00 00:00:00'),
(179, 18, 'php hourly', 1, 'php hourly', 'hourly', '', '3_6_months', 'Entry level', 0.00, '10-19', '', 1, '2017-03-04 17:33:54', '2017-03-04 17:33:54'),
(178, 18, 'Developer testing ', 1, 'Developer testing ', 'fixed', '', '3_6_months', 'Entry level', 15.00, 'not_sure', '', 1, '2017-03-03 21:06:24', '2017-03-03 21:06:24'),
(177, 18, 't9', 1, 'g09', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 20:49:38', '2017-02-27 20:49:38'),
(90, 41, 'seo for 20 websites ', 29, 'i need seo ', 'fixed', 'HTML', 'less_than_1_week', 'Entry level', 450.00, 'not_sure', '', 0, '2016-12-04 19:56:20', '0000-00-00 00:00:00'),
(158, 18, 'test', 1, 'test', 'hourly', 'PHP', 'more_than_6_months', 'Entry level', 0.00, '10-19', '', 0, '2017-02-27 18:05:05', '0000-00-00 00:00:00'),
(159, 18, 'test', 1, 'test', 'hourly', 'PHP', 'more_than_6_months', 'Entry level', 0.00, '10-19', '', 0, '2017-02-27 18:07:18', '0000-00-00 00:00:00'),
(160, 18, 'test', 1, 'test', 'hourly', '', 'more_than_6_months', 'Entry level', 0.00, '10-19', '', 0, '2017-02-27 18:07:56', '2017-02-27 18:07:56'),
(161, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 18:57:48', '2017-02-27 18:57:48'),
(162, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:01:48', '2017-02-27 19:01:48'),
(163, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:20:46', '2017-02-27 19:20:46'),
(164, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:25:13', '2017-02-27 19:25:13'),
(165, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:31:15', '2017-02-27 19:31:15'),
(166, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:37:31', '2017-02-27 19:37:31'),
(167, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:44:23', '2017-02-27 19:44:23'),
(168, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:45:39', '2017-02-27 19:45:39'),
(169, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:46:39', '2017-02-27 19:46:39'),
(170, 18, 'test', 1, 'tess', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:50:19', '2017-02-27 19:50:19'),
(171, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:53:33', '2017-02-27 19:53:33'),
(172, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:54:36', '0000-00-00 00:00:00'),
(173, 18, 'test', 1, 'test', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:58:46', '0000-00-00 00:00:00'),
(174, 18, 't2', 1, 't2', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 19:59:26', '0000-00-00 00:00:00'),
(175, 18, 'te', 1, 'te', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-27 20:02:02', '2017-02-28 03:02:02'),
(176, 18, 't8', 1, 's', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-28 03:10:46', '2017-02-28 03:10:46'),
(157, 18, 'job testing', 1, 'job testing', 'fixed', '', '1_3_months', 'Entry level', 100.00, '1-9', '', 1, '2017-02-22 11:25:33', '2017-02-22 11:25:33'),
(156, 18, 'skills ', 1, 'wdefwf', 'hourly', '', '1_3_months', 'Entry level', 0.00, '10-19', '', 1, '2017-02-19 17:09:48', '2017-02-19 17:09:48'),
(155, 18, 'Hourly-Applied count and hire page interview count issue', 1, 'Hourly-Applied count and hire page interview count issue', 'hourly', '', '1_3_months', 'Experienced', 0.00, '10-19', '', 0, '2017-02-18 10:22:29', '2017-02-18 10:22:29'),
(154, 18, 'Fixed-Applied count and hire page interview count issue', 1, 'Fixed-Applied count and hire page interview count issue', 'fixed', '', '3_6_months', 'Entry level', 30.00, 'not_sure', '', 0, '2017-02-18 10:21:51', '2017-02-18 10:21:51'),
(153, 18, 'seo for 1 webiste', 1, 'seo for 1 webiste', 'fixed', '', 'more_than_6_months', 'Entry level', 500.00, 'not_sure', '', 0, '2017-02-17 10:34:36', '2017-02-17 10:34:36'),
(152, 18, 'Designer', 1, 'Designer', 'hourly', '', '1_3_months', 'Entry level', 0.00, '20-29', '', 0, '2017-02-15 08:21:01', '2017-02-15 08:21:01'),
(151, 29, 'php', 1, 'saf safsaf ', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-02-12 15:52:53', '2017-02-12 15:52:53'),
(150, 18, 'fixed rate', 1, 'fixed rate', 'fixed', '', '3_6_months', 'Entry level', 300.00, 'not_sure', '', 0, '2017-02-03 18:53:10', '2017-02-03 18:53:10'),
(102, 29, 'html', 4, 'We need few html expert', 'hourly', 'Java', 'less_than_1_week', 'Entry level', 0.00, '1-9', '', 0, '2016-12-09 17:52:31', '2016-12-09 17:52:31'),
(103, 29, 'html', 8, 'we are testing ', 'fixed', 'PHP', 'less_than_1_week', 'Entry level', 1000.00, 'not_sure', '', 0, '2016-12-09 17:53:34', '2016-12-09 17:53:34'),
(104, 29, 'html 2', 9, 'etfew', 'fixed', 'CSS', 'less_than_1_months', 'Entry level', 45.00, 'not_sure', '', 0, '2016-12-09 17:54:26', '2016-12-09 17:54:26'),
(149, 18, 'testing hourly payment', 1, 'testing hourly payment', 'hourly', '', '3_6_months', 'Entry level', 0.00, '1-9', '', 0, '2017-02-03 18:20:58', '2017-02-03 18:20:58'),
(106, 29, 'fixed job test', 4, 'sryer', 'fixed', 'PHP', '3_6_months', 'Entry level', 30.00, 'not_sure', '', 0, '2016-12-11 15:34:36', '2016-12-11 15:34:36'),
(148, 18, 'test fixed', 1, 'rtrtrt', 'fixed', '', '3_6_months', 'Entry level', 50.00, 'not_sure', '', 0, '2017-02-02 16:02:01', '2017-02-05 16:02:01'),
(147, 18, 'web design', 1, 'web design', 'hourly', '', '3_6_months', 'Entry level', 0.00, '10-19', '', 0, '2017-01-25 11:49:17', '2017-01-25 11:49:17'),
(146, 18, 'wordpress', 1, 'sdf', 'fixed', '', 'more_than_6_months', 'Entry level', 20.00, 'not_sure', '', 0, '2017-01-18 07:53:20', '2017-01-18 07:53:20'),
(145, 18, 'dddd', 1, 'dddd', 'hourly', '', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-01-17 10:48:14', '2017-01-17 10:48:14'),
(144, 18, 'New job 31', 8, 'Testing skills', 'hourly', '', '3_6_months', 'Entry level', 0.00, '40_plus', '/uploads/1484650767708318.jpg', 0, '2017-01-17 06:26:03', '2017-01-17 06:26:03'),
(143, 18, 'New job', 3, 'ssssss ssssss', 'hourly', '', 'less_than_1_months', 'Entry level', 0.00, '20-29', '', 0, '2017-01-16 12:07:11', '2017-01-16 12:07:11'),
(142, 18, 'Test job777', 12, 'aaaa aaaa', 'hourly', 'PHP Javascript', 'less_than_1_week', 'Entry level', 0.00, '20-29', '', 0, '2017-01-16 12:00:33', '2017-01-16 12:00:33'),
(141, 18, 'Test job1 9', 5, 'sss sssss', 'hourly', 'HTML CSS Javascript', '3_6_months', 'Entry level', 0.00, '20-29', '', 0, '2017-01-16 11:59:35', '2017-01-16 11:59:35'),
(140, 18, 'Job ', 1, 'aaa aaaa', 'hourly', 'Javascript Jquery', 'not_sure', 'Entry level', 0.00, 'not_sure', '', 0, '2017-01-16 11:16:10', '2017-01-16 11:16:10'),
(139, 18, 'Test job1', 8, 'aaaa aaaaa', 'hourly', 'PHP HTML CSS Javascript', '3_6_months', 'Entermediate', 0.00, '40_plus', '', 0, '2017-01-16 05:34:57', '2017-01-16 05:34:57'),
(138, 18, 'fixed description', 1, 'fixed description', 'fixed', 'PHP', 'more_than_6_months', 'Entry level', 999.00, 'not_sure', '', 0, '2017-01-15 18:34:07', '2017-01-15 18:34:07'),
(137, 18, 'skills', 1, 'skills', 'hourly', 'Java HTML CSS Javascript', '1_3_months', 'Entry level', 0.00, '20-29', '', 0, '2017-01-14 08:09:12', '2017-01-14 08:09:12'),
(136, 18, 'fixed job test', 1, 'test 4', 'fixed', 'PHP', '3_6_months', 'Entry level', 600.00, 'not_sure', '', 0, '2017-01-13 17:50:45', '2017-01-13 17:50:45'),
(135, 18, 'test 4', 1, 'test 4', 'hourly', 'HTML', 'less_than_1_months', 'Entry level', 0.00, '10-19', '', 0, '2017-01-13 17:49:50', '2017-01-13 17:49:50'),
(134, 18, 'test3', 1, 'test3', 'fixed', 'PHP', 'more_than_6_months', 'Entry level', 300.00, 'not_sure', '', 0, '2017-01-13 10:46:47', '2017-01-13 10:46:47'),
(133, 18, 'fixed 1', 1, 'fixed 1', 'fixed', 'PHP', '3_6_months', 'Entry level', 12.00, 'not_sure', '', 0, '2017-01-13 09:53:13', '2017-01-13 09:53:13'),
(131, 18, 'hourly', 1, 'html', 'hourly', 'HTML', '3_6_months', 'Entry level', 0.00, '20-29', '', 0, '2017-01-13 05:18:10', '2017-01-13 05:18:10'),
(132, 18, 'fixed', 1, 'fixed', 'fixed', 'PHP', 'more_than_6_months', 'Entry level', 4000.00, 'not_sure', '', 0, '2017-01-13 05:18:33', '2017-01-13 05:18:33');

-- --------------------------------------------------------

--
-- Structure de la table `job_accepted`
--

DROP TABLE IF EXISTS `job_accepted`;
CREATE TABLE `job_accepted` (
  `id` int(11) NOT NULL,
  `fuser_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `buser_id` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `contact_id` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_accepted`
--

INSERT INTO `job_accepted` (`id`, `fuser_id`, `job_id`, `buser_id`, `bid_id`, `comments`, `contact_id`, `created`) VALUES
(115, 13, 132, 18, 181, 'df', '13_5OS7HI6P95', '2017-01-13 06:55:31'),
(116, 9, 132, 18, 185, 'ok', '9_0NT7FC39XL', '2017-01-13 10:04:34'),
(134, 13, 178, 18, 235, 'ok', '13_YFAQFUN0YA', '2017-03-03 21:19:24'),
(95, 9, 65, 0, 83, 'hyuru', '9_WWOOUT9B5L', '2016-12-01 15:28:43'),
(85, 15, 75, 0, 86, 'dfhfghj', '15_03I82BY0GD', '2016-11-28 22:22:35'),
(133, 13, 153, 18, 221, 'sfg', '13_1X5O5V630B', '2017-02-17 11:39:00'),
(132, 13, 150, 18, 211, 'rrgt', '13_6VACM2N6VV', '2017-02-03 18:57:27'),
(131, 13, 149, 18, 210, 'fv', '13_NYVK5HQ3QP', '2017-02-03 18:25:09'),
(130, 9, 147, 18, 204, 'sdfgdsfgh', '9_13NJIATSZ0', '2017-02-02 16:08:25'),
(129, 9, 148, 18, 209, 'dfrgdfhd', '9_MBEP11MAJ8', '2017-02-02 16:08:18'),
(128, 13, 148, 18, 208, 'rg', '13_375DHRBC2N', '2017-02-02 16:06:56'),
(97, 9, 49, 0, 62, 'rtr', '9_ISOUWTHDXC', '2016-12-01 15:32:19'),
(127, 13, 147, 18, 207, 'gg', '13_3Q6QGBXY20', '2017-02-02 16:06:25'),
(126, 13, 138, 18, 194, ' zdsf gfg gfhfdhfsgh fgh hfg hg', '13_GQ3IHS2DAA', '2017-01-28 20:50:14'),
(125, 15, 147, 18, 202, 'fhyt', '15_K6ZUBBW98F', '2017-01-25 12:19:18'),
(124, 13, 146, 18, 197, 'ok', '13_P9UHHJUIYE', '2017-01-24 21:20:06'),
(123, 9, 144, 18, 200, 'ok', '9_8KWV2TM0MM', '2017-01-21 17:20:00'),
(122, 15, 144, 18, 199, 'ok', '15_PPLABLF5BP', '2017-01-21 17:15:42'),
(121, 13, 143, 18, 196, 'ok', '13_SKLXYCCNF7', '2017-01-16 17:36:14'),
(108, 15, 104, 0, 121, 'fdgdfg', '15_21N61P8TMV', '2016-12-11 15:33:09'),
(120, 15, 138, 18, 195, 'ok', '15_WPR0OF00WT', '2017-01-15 19:04:31'),
(119, 9, 134, 18, 191, 'ok', '9_6JJDVCZN36', '2017-01-15 17:46:29'),
(118, 13, 133, 18, 188, 'tt', '13_Z8HRW2SQWT', '2017-01-13 10:50:55'),
(117, 13, 134, 18, 189, 'reyt5re', '13_P6ZSH0RTC9', '2017-01-13 10:48:33'),
(114, 15, 132, 18, 183, 'ok', '15_FIXB6XV8ZH', '2017-01-13 05:43:02'),
(135, 13, 157, 18, 228, 'dffg', '13_MJZSJG1PXE', '2017-03-08 10:38:53');

-- --------------------------------------------------------

--
-- Structure de la table `job_bids`
--

DROP TABLE IF EXISTS `job_bids`;
CREATE TABLE `job_bids` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `bid_amount` float(10,2) DEFAULT NULL,
  `bid_fee` float(10,2) DEFAULT NULL,
  `bid_earning` float(10,2) DEFAULT NULL,
  `job_duration` varchar(100) DEFAULT NULL,
  `cover_latter` text,
  `status` tinyint(4) NOT NULL DEFAULT '0'COMMENT
) ;

--
-- Contenu de la table `job_bids`
--

INSERT INTO `job_bids` (`id`, `user_id`, `job_id`, `bid_amount`, `bid_fee`, `bid_earning`, `job_duration`, `cover_latter`, `status`, `hired`, `hire_title`, `hire_message`, `weekly_limit`, `offer_bid_amount`, `offer_bid_fee`, `offer_bid_earning`, `allow_freelancer`, `fixed_pay_status`, `weekly_amount`, `fixedpay_amount`, `start_date`, `created`, `jobstatus`, `end_date`, `bid_reject`, `hired_on`, `payment_status`, `withdrawn`, `withdrawn_by`, `job_progres_status`) VALUES
(1, 9, 27, 12.00, 1.20, 10.80, '10-19', 'fgdfhgfhgf', 1, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-25 20:15:06', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(2, 9, 27, 12.00, 1.20, 10.80, '10-19', 'hgfhjgj', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-25 20:17:17', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(3, 9, 26, 123.00, 12.30, 111.70, 'not_sure', 'vsfbgdfbhgf', 1, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-25 20:17:46', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(5, 9, 24, 12.00, 1.20, 10.80, '1-9', 'hello', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-26 17:10:01', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(10, 9, 23, 12.00, 1.20, 10.80, '10-19', 'dfgdfh', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-26 18:36:10', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(11, 9, 21, 0.00, 0.00, 0.00, '1-9', 'ghgfh', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-26 18:37:18', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(12, 9, 31, 22.00, 2.20, 19.80, '1-9', 'dfgdg', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-26 18:56:07', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(15, 9, 32, 5.00, 0.50, 4.50, '1-9', 'fgdfh', 0, '0', 'Testing', 'rujygfjh', 50, 10.00, 1.00, 9.00, '0', '0', 500.00, NULL, '2016/09/27 21:07', '2016-08-26 19:04:21', 0, '', 0, '0.00', 1, NULL, NULL, 0),
(16, 15, 33, 5.00, 0.50, 4.50, '30-39', 'dgfghfdh', 1, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-26 19:20:36', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(17, 25, 27, 11.00, 1.10, 9.90, '1-9', 'I want to do the job', 0, '0', 'Need Virtual Assistant with excellent English writing skills for email, blog, and social media upkee', 'vnjmgngfn', 10, 5.00, 0.50, 4.50, '1', '0', 0.00, NULL, '2016/09/15 00:25', '2016-08-30 05:24:23', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(18, 26, 33, 190.00, 19.00, 171.00, '40_plus', 'test bid', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-30 06:39:50', 0, '', 1, '0.00', 0, NULL, NULL, 0),
(19, 9, 33, 200.00, 20.00, 180.00, '1-9', 'Hi I am highly interested to work with you.I am professional and full time quality worker.\n\nRegards\n', 0, '0', 'Testing 2', 'af', 0, 0.00, 0.00, 0.00, '0', '2', 0.00, 10.00, '2016/09/14 00:22', '2016-08-30 11:42:07', 1, '', 0, '0.00', 0, NULL, NULL, 0),
(20, 26, 32, 15.00, 1.50, 13.50, '10-19', 'testing', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-30 11:56:20', 0, '', 1, '0.00', 0, NULL, NULL, 0),
(21, 15, 27, 6.00, 0.60, 5.40, '1-9', 'afef', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-30 15:47:04', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(22, 28, 33, 23.00, 2.30, 20.70, '1-9', 'hi this is tuhin', 0, '0', NULL, NULL, 0, 0.00, 0.00, 0.00, '0', '0', 0.00, NULL, '0', '2016-08-30 19:45:41', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(23, 25, 32, 40.00, 4.00, 36.00, 'not_sure', 'd rfgd gcd hdfhdf h dt hdf hdf hdf hdr hdfhd hd hd', 0, '0', 'Testing 1', 'jiojjj', 0, 45.00, 4.50, 40.50, '0', '', 0.00, 0.00, '2016/09/07 13:38', '2016-08-30 21:56:37', 0, '2016-09-26 08:09:19', 0, '0.00', 0, NULL, NULL, 0),
(43, 25, 33, 450.00, 45.00, 405.00, '20-29', 'i like to do it', 0, '0', 'tets test 2 hire', 'adadad', 0, NULL, NULL, NULL, '0', '2', 0.00, 152.00, '2016/09/29 16:21', '2016-09-29 05:37:45', 0, '', 0, '0.00', 1, NULL, NULL, 0),
(25, 9, 34, 5.00, 0.50, 4.50, '1-9', 'Testing hourly', 0, '0', 'Hourly testing', 'fgfdg', 23, 25.00, 2.50, 22.50, '0', '0', 0.00, NULL, '2016/09/07 20:21', '2016-09-02 11:11:10', 0, '', 0, '0.00', 0, NULL, NULL, 0),
(26, 15, 34, 5.00, 0.50, 4.50, '10-19', 'sfgdfhg', 0, '0', 'go', 'sfgetrgy', 0, 25.00, 2.50, 22.50, '0', '0', 0.00, NULL, '2016/09/07 05:34', '2016-09-02 17:31:09', 1, '2016-10-10 20:10:50', 0, '0.00', 0, NULL, NULL, 0),
(27, 25, 35, 500.00, 50.00, 450.00, '10-19', 'Test BID', 0, '0', 'Fixed test', 'rdt', 0, 0.00, 0.00, 0.00, '0', '2', 0.00, 122.00, '2016/09/30 21:08', '2016-09-06 18:24:35', 1, '2016-09-28 13:09:19', 0, '0.00', 0, NULL, NULL, 0),
(28, 15, 35, 400.00, 40.00, 360.00, '10-19', 'erghedrkjghjdsflhj;', 0, '0', 'Fixed test', 'test', 0, 0.00, 0.00, 0.00, '0', '2', 0.00, 100.00, '2016/10/28 21:25', '2016-09-06 20:10:50', 1, '2016-09-28 08:09:06', 0, '0.00', 1, NULL, NULL, 0),
(29, 9, 36, 30.00, 3.00, 27.00, '1-9', 'dxvfgsdgbfd', 0, '0', 'hourly rate testing', 'testing', 0, 20.00, 2.00, 18.00, '0', '0', 0.00, NULL, '2016/09/20 20:17', '2016-09-07 10:35:34', 1, '2016-09-20 14:09:35', 1, '0.00', 0, NULL, NULL, 0),
(30, 25, 36, 5.00, 0.50, 4.50, 'not_sure', 'test', 0, '0', 'tesrt', 'test', 20, 3.00, 0.30, 2.70, '1', '0', 60.00, NULL, '2016/09/26 20:30', '2016-09-07 10:35:37', 0, '2016-09-20 09:09:42', 0, '0.00', 1, NULL, NULL, 0),
(236, 13, 179, 5.00, 0.50, 4.50, NULL, 'wregtert', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-03-04 17:34:18', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(33, 15, 37, 5.00, 0.50, 4.50, '10-19', 'thythy', 0, '0', 'test', 'hi', 23, NULL, NULL, NULL, '0', '0', 0.00, NULL, '2016/09/09 21:51', '2016-09-07 21:02:45', 1, '2016-09-20 10:09:51', 1, '0.00', 0, NULL, NULL, 0),
(34, 9, 38, 500.00, 50.00, 450.00, '10-19', 'hghfgh', 0, '0', 'Fiixed 1000 job', 'adadad adada', 0, NULL, NULL, NULL, '0', '1', 0.00, 500.00, '2016/09/23 19:26', '2016-09-08 07:45:16', 1, '2016-09-25 16:09:55', 0, '0.00', 1, NULL, NULL, 0),
(35, 25, 38, 800.00, 80.00, 720.00, '40_plus', 'Cover Letter FIXED', 0, '1', ' Fiixed 1000 job', 'asdadadadada', 0, NULL, NULL, NULL, '0', '2', 0.00, 150.00, '2016/09/30 19:23', '2016-09-08 07:45:35', 0, '0000-00-00 00:00:00', 1, '0.00', 1, NULL, NULL, 0),
(36, 15, 36, 5.00, 0.50, 4.50, 'not_sure', 'dfdhdfh', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-09-16 09:44:18', 0, '0000-00-00 00:00:00', 1, '0.00', 0, NULL, NULL, 0),
(37, 15, 39, 23.00, 2.30, 20.70, '10-19', 'testing', 0, '0', 'Google top Ranker', 'cbfdgxb', 12, NULL, NULL, NULL, '0', NULL, 276.00, 0.00, '2016/09/19 13:23', '2016-09-16 09:53:31', 1, '0000-00-00 00:00:00', 0, '0.00', 0, NULL, NULL, 0),
(38, 25, 2, 10.00, 1.00, 9.00, '10-19', 'sassafsaf', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-09-21 08:06:18', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(39, 9, 40, 400.00, 40.00, 360.00, '20-29', 'testing', 0, '0', 'asdadadad', 'dadada', 0, NULL, NULL, NULL, '0', '2', 0.00, 400.00, '2016/09/17 16:46', '2016-09-21 19:22:05', 1, '2016-09-28 07:09:12', 1, '0.00', 0, NULL, NULL, 0),
(40, 9, 37, 5.00, 0.50, 4.50, 'not_sure', 'gdfg', 0, '0', 'seo', 'dwdfwf', 20, NULL, NULL, NULL, '0', NULL, 100.00, 0.00, '2016/09/22 14:42', '2016-09-22 16:24:48', 1, '2016-09-23 14:09:47', 1, '0.00', 0, NULL, NULL, 0),
(234, 13, 176, 5.00, 0.50, 4.50, NULL, 'tett', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-27 20:37:00', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(231, 9, 157, 34.00, 3.40, 30.60, 'Less than 1 month', 'dafdf', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-27 17:02:08', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(235, 13, 178, 45.00, 4.50, 40.50, 'Less than 1 month', 'df', 0, '0', 'Developer testing ', 'thfgj', 0, NULL, NULL, NULL, '0', '1', 0.00, 45.00, '03/03/2017', '2017-03-03 21:07:36', 0, NULL, 0, '45.00', 0, NULL, NULL, 3),
(45, 15, 40, 444.00, 44.40, 399.60, '1-9', 'fdgdfg', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-10-05 23:02:45', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(46, 15, 41, 5.00, 0.50, 4.50, NULL, 'rgtrgy', 0, '0', 'Web Developer -Professional', 'ryhtryh', 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '2016/10/11 23:55', '2016-10-05 23:03:12', 1, '2016-10-10 22:10:18', 0, '0.00', 0, NULL, NULL, 0),
(205, 13, 140, 5.00, 0.50, 4.50, NULL, 'My proven SEO is in reference to Search Engine Optimization (SEO) Services for proven Results, offering "1st page rank on Google, Yahoo and Bing (whatever is your preferable search engine) and targeted traffic" at a very competitive cost. We will do online promotional activities and work as an Online Marketing Team for your business.', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-02 06:54:33', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(206, 15, 140, 5.00, 0.50, 4.50, NULL, 'My proven SEO is in reference to Search Engine Optimization (SEO) Services for proven Results, offering "1st page rank on Google, Yahoo and Bing (whatever is your preferable search engine) and targeted traffic" at a very competitive cost. We will do online promotional activities and work as an Online Marketing Team for your business.', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-02 06:55:34', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(207, 13, 147, 5.00, 0.50, 4.50, NULL, 'fgfhdf', 0, '0', 'web design', 'kjghkjg', 43, NULL, NULL, NULL, '0', NULL, 215.00, 0.00, '2017/02/15 22:04', '2017-02-02 15:18:18', 0, NULL, 0, '0.00', 0, NULL, NULL, 3),
(208, 13, 148, 10.00, 1.00, 9.00, '3-6 months', 'ehsh', 0, '0', 'test fixed', 'dfgdfg', 0, NULL, NULL, NULL, '0', '1', 0.00, 110.00, '2017/01/31 22:06', '2017-02-02 16:02:50', 0, NULL, 0, '10.00', 0, NULL, NULL, 3),
(209, 9, 148, 77.00, 7.70, 69.30, 'Less than 1 month', 'wrtrere', 0, '0', 'test fixed', 'dtgdfg', 0, NULL, NULL, NULL, '0', '1', 0.00, 77.00, '2017/02/07 22:05', '2017-02-02 16:03:55', 1, '2017-02-03 19:02:14', 0, '77.00', 0, NULL, NULL, 3),
(210, 13, 149, 5.00, 0.50, 4.50, NULL, 'eryhrtjutyru', 0, '0', 'testing hourly payment', 'yjyuk', 60, NULL, NULL, NULL, '0', NULL, 300.00, 0.00, '2017/02/04 00:23', '2017-02-03 18:21:22', 0, NULL, 0, '0.00', 0, NULL, NULL, 3),
(211, 13, 150, 300.00, 30.00, 270.00, 'Less than 1 week', 'frgtdh', 0, '0', 'fixed rate', 'sfdgrhtr', 0, NULL, NULL, NULL, '0', '1', 0.00, 319.00, '2017/02/04 00:55', '2017-02-03 18:54:25', 0, NULL, 0, '300.00', 0, NULL, NULL, 3),
(212, 9, 150, 44.00, 4.40, 39.60, 'Less than 1 month', 'rgrgh', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-03 19:47:02', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(213, 9, 149, 4.00, 0.40, 3.60, NULL, 'djffshg', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-05 10:38:46', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(214, 15, 149, 7.00, 0.70, 6.30, NULL, 'fgdf', 0, '0', NULL, NULL, 0, 562.00, 56.20, 505.80, '0', NULL, 0.00, 0.00, '0', '2017-02-05 10:39:29', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(215, 15, 150, 1424.00, 142.40, 1281.60, 'not_sure', 'ghfghfg', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-05 10:50:32', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(216, 9, 151, 12.00, 1.20, 10.80, NULL, 'sfvgrger', 0, '0', 'php', 'tgt', 23, NULL, NULL, NULL, '0', NULL, 276.00, 0.00, '14/02/2017', '2017-02-14 16:03:01', 0, NULL, 0, '0.00', 0, NULL, NULL, 2),
(217, 13, 151, 454.00, 45.40, 408.60, NULL, 'gfhgh', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-14 16:40:52', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(218, 13, 152, 5.00, 0.50, 4.50, NULL, 'yrtuytru', 1, '0', NULL, NULL, 0, 5.00, 0.50, 4.50, '0', NULL, 0.00, 0.00, '0', '2017-02-15 08:21:32', 0, NULL, 0, '0.00', 0, 1, 1, 0),
(219, 9, 152, 5.00, 0.50, 4.50, NULL, 'tyur6tu', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-17 10:30:57', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(220, 15, 152, 5.00, 0.50, 4.50, NULL, 'fgdfhg', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-17 10:31:24', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(221, 13, 153, 600.00, 60.00, 540.00, 'Less than 1 month', 'fsgfdg', 0, '0', 'seo for 1 webiste', 'fdhfdh', 0, NULL, NULL, NULL, '0', '1', 0.00, 615.00, '17/02/2017', '2017-02-17 10:35:06', 0, NULL, 0, '600.00', 0, NULL, NULL, 3),
(222, 9, 153, 61.00, 6.10, 54.90, 'Less than 1 week', 'frgtdfy', 0, '1', 'seo for 1 webiste', 'hfdh', 0, NULL, NULL, NULL, '0', '1', 0.00, 61.00, '17/02/2017', '2017-02-17 10:35:34', 0, NULL, 0, '61.00', 0, NULL, NULL, 2),
(223, 15, 153, 45.00, 4.50, 40.50, 'Less than 1 month', 'dgfhftghj', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-18 09:57:40', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(224, 9, 154, 12.00, 1.20, 10.80, 'Less than 1 month', 'Hourly-Applied count and hire page interview count issue', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-18 10:23:10', 0, NULL, 1, '0.00', 0, 1, 2, 1),
(225, 13, 154, 4555.00, 455.50, 4099.50, 'Less than 1 week', 'gdfhytgh', 0, '1', 'Fixed-Applied count and hire page interview count issue', 'gh', 0, NULL, NULL, NULL, '0', '1', 0.00, 4555.00, '18/02/2017', '2017-02-18 10:29:21', 0, NULL, 1, '4555.00', 0, 1, 2, 2),
(226, 13, 156, 5.00, 0.50, 4.50, NULL, 'sfefef', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-21 06:48:56', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(227, 13, 155, 5.00, 0.50, 4.50, NULL, 'wdef', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-21 06:49:12', 0, NULL, 0, '0.00', 0, 1, 1, 0),
(228, 13, 157, 90.00, 9.00, 81.00, '3-6 months', 'Hi\nI have 4 + Years Exp. My Skill\'s are PHP, My Sql, \n\nRegards\n\nArun', 0, '0', 'job testing', '', 0, NULL, NULL, NULL, '0', '1', 0.00, 90.00, '02/03/2017', '2017-02-22 11:27:55', 0, NULL, 0, '90.00', 0, NULL, NULL, 3),
(229, 15, 156, 5.00, 0.50, 4.50, NULL, 'srgthtft', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-27 16:39:43', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(230, 15, 157, 12.00, 1.20, 10.80, 'Less than 1 week', 'dsd', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-02-27 17:01:26', 0, NULL, 1, '0.00', 0, 1, 2, 1),
(48, 9, 41, 5.00, 0.50, 4.50, NULL, 'We are a virtual digital marketing firm focused on provided digital marketing solutions to businesses and organisations in USA and around the world. Currently the firm has around 10 virtual staff around the world with most based in Australia. Stuart is currently looking to add an experienced Web Developer to our team. The commitment required for this role will be between 35 – 40 hours per week. Tasks • Manage and develop existing and new client websites. Experience/Skills • Experience in CSS, HTML, Java Script, Joomla and Google Analytics. • Experience with SSL wildcards. • Ecommerce set up and management. • SEO set up and running experience. • Prior experience or exposure to Healcode would be advantageous. • Well versed in several WP templates. • Regularly communicate with the rest of the team on project status. • Attention to detail. • Fast turnaround on tasks. • Fluent in English, both conversational and written. Both individuals and small development firms are encouraged to apply. Please do not call, email or Skype OUTSIDE of Upwork. Those who do so will be immediately eliminated from the process', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-10-09 18:22:50', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(49, 9, 42, 5.00, 0.50, 4.50, NULL, 'We are a virtual digital marketing firm focused on provided digital marketing solutions to businesses and organisations in USA and around the world. Currently the firm has around 10 virtual staff around the world with most based in Australia. Stuart is currently looking to add an experienced Web Developer to our team. The commitment required for this role will be between 35 – 40 hours per week. Tasks • Manage and develop existing and new client websites. Experience/Skills • Experience in CSS, HTML, Java Script, Joomla and Google Analytics. • Experience with SSL wildcards. • Ecommerce set up and management. • SEO set up and running experience. • Prior experience or exposure to Healcode would be advantageous. • Well versed in several WP templates. • Regularly communicate with the rest of the team on project status. • Attention to detail. • Fast turnaround on tasks. • Fluent in English, both conversational and written. Both individuals and small development firms are encouraged to apply. Please do not call, email or Skype OUTSIDE of Upwork. Those who do so will be immediately eliminated from the process', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-10-09 19:03:07', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(204, 9, 147, 5.00, 0.50, 4.50, NULL, 'dfrgtdfgfg', 0, '0', 'web design', 'oyiiuyi', 4, NULL, NULL, NULL, '0', NULL, 20.00, 0.00, '2017/02/09 22:05', '2017-01-30 06:43:08', 0, NULL, 0, '0.00', 0, NULL, NULL, 3),
(52, 15, 43, 200.00, 20.00, 180.00, '20-29', 'gdfghdfhg', 0, '0', 'Fixed price Payments', 'dgfsdg', 0, NULL, NULL, NULL, '0', '1', 0.00, 200.00, '2016/10/11 23:30', '2016-10-11 17:24:17', 1, '2016-10-11 17:10:29', 1, '0.00', 0, NULL, NULL, 0),
(203, 9, 131, 5.00, 0.50, 4.50, NULL, 'c', 0, '1', 'hourly', 'thytr', 13, NULL, NULL, NULL, '0', NULL, 65.00, 0.00, '2017/01/27 14:07', '2017-01-27 07:58:20', 0, NULL, 0, '0.00', 0, NULL, NULL, 2),
(202, 15, 147, 5.00, 0.50, 4.50, NULL, 'ertyhtruj', 0, '0', 'web design', 'fg', 15, NULL, NULL, NULL, '0', NULL, 75.00, 0.00, '2017/01/25 18:18', '2017-01-25 12:18:27', 1, '2017-01-27 20:01:20', 0, '0.00', 0, NULL, NULL, 3),
(55, 9, 44, 100.00, 10.00, 90.00, '10-19', 'dfghdfh', 0, '0', 'Fixed price Payments 1', 'dfhgdfh', 0, NULL, NULL, NULL, '0', '2', 0.00, 100.00, '2016/10/12 02:27', '2016-10-11 20:26:45', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(56, 15, 45, 5.00, 0.50, 4.50, NULL, 'rytrurty', 0, '0', 'seo', 'gfhfhgyj', 20, NULL, NULL, NULL, '0', NULL, 100.00, 0.00, '2016/10/12 04:00', '2016-10-11 22:19:10', 1, '2016-10-11 22:10:45', 0, '0.00', 0, NULL, NULL, 0),
(58, 15, 46, 200.00, 20.00, 180.00, '10-19', 'rtyh', 0, '0', 'fsedgfsrdg', 'fgfdg', 0, NULL, NULL, NULL, '0', '1', 0.00, 200.00, '2016/10/14 03:32', '2016-10-12 21:59:27', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(61, 15, 47, 5.00, 0.50, 4.50, NULL, 'fergteryg', 0, '0', 'Wordpress Web Development', 'dfdsgf', 50, 6.00, 0.60, 5.40, '0', NULL, 300.00, 0.00, '2016/10/14 01:14', '2016-10-13 19:13:41', 1, '2017-01-06 21:01:05', 0, '0.00', 0, NULL, NULL, 0),
(62, 9, 49, 1000.00, 100.00, 900.00, '20-29', 'Hi Adi\n Please try to understand I am we are testing website', 1, '0', 'SEO', 'hey', 0, NULL, NULL, NULL, '0', '1', 0.00, 1000.00, '2016/10/14 12:41', '2016-10-14 16:36:06', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(65, 9, 46, 1000.00, 100.00, 900.00, 'Less than 1 month', 'dgfsdg', 0, '0', 'aryan test 2', 'adadadad', 0, NULL, NULL, NULL, '0', '2', 0.00, 200.00, '2016/10/14 13:09', '2016-10-18 21:57:31', 1, '2016-10-18 22:10:27', 0, '0.00', 0, NULL, NULL, 0),
(66, 9, 50, 55.00, 5.50, 49.50, 'not_sure', 'hjfghgjfhgj', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-10-19 13:44:33', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(201, 9, 146, 50.00, 5.00, 45.00, 'Less than 1 month', 'I am interested your SEO project. I have +4 years experience about Search engine RANKING, On-page optimization, Off-page optimization, SEM, WordPress Etc. A superior ranking in the major search engines is the best way to bring Quality and Unique visitors to your website. I am using 100% white heat and manually technology in my work. Because Google doesn\'t accept Black-Hat and Spam techniques.\nI am using Recent Panda & Penguin 2.1, Algorithm\'s with Hummingbird update strategy.\nI provide you Guaranteed top ranking at search engine.\n\nPlease see my work Plan: \n\n**On-Page as Keywords Research and Selection, Competitor analysis, webmaster tools, Sitemap.xml, Google Analytic, Title Tags Optimization, Description Tags, ALT tag, Anchor text, H1 tags, Content Etc.\n\n**Off-Page namely: \nWeb 2.0 creation eg. wordpress.com, livejournal.com etc.\nRelevant Forum Back links\nRelevant Blog Commenting on different websites\nArticle Submission, Article Submission directories eg. Ezinearticles.com, Goarticles.com etc.\nPress Release submission in press release network sites eg. 24-7pressrelease.com, prweb.com etc.\nSubmission in Search Engine Friendly Directories eg. Dmoz.org, allwebsites.org etc.\nSubmission to Social Bookmarking websites eg. Del.icio.us, Digg, Stumbleupon etc.\nRSS Feed Submission in sites eg. Feedburner.com, rssfeeds.com etc.\nBlog Posting and Optimization e.g. blog-search.com, bloghub.com, blogspot.com, wordpress.com etc\nSocial Network Marketing eg. Facebook.com, myspace.com, linkedin.com, orkut.com, twitter.com et\nBlog Creation & Optimization e.g. blog-search.com, bloghub.com, blogspot.com, wordpress.com etc\nBlog Directory Submission\n\nCreation of Social Network Marketing Profiles eg. Pinterest.com, myspace.com, linkedin.com, orkut.com, Hi5.com, tumblr.com etc.\n\n\nSee my Attachment about the new strategy.\n\nI am waiting for you', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-24 08:56:45', 0, NULL, 0, '0.00', 0, 1, 1, 1),
(68, 15, 51, 500.00, 50.00, 450.00, '1-3 months', 'fdsghfdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 0, '0', 'Fixed job test', 'sdefed', 0, NULL, NULL, NULL, '0', '1', 0.00, 710.00, '2016/10/28 03:11', '2016-10-20 22:49:40', 1, '2016-11-27 20:11:03', 0, '0.00', 0, NULL, NULL, 0),
(200, 9, 144, 5.00, 0.50, 4.50, NULL, 'dfhkf', 0, '0', 'New job 31', 'ok', 40, NULL, NULL, NULL, '0', NULL, 200.00, 0.00, '2017/01/21 23:18', '2017-01-21 17:17:59', 1, '2017-01-25 15:01:47', 0, '0.00', 0, NULL, NULL, 3),
(70, 15, 52, 200.00, 20.00, 180.00, 'Less than 1 month', 'dgfgf', 0, '0', 'Testing', 'dfghfghj', 0, NULL, NULL, NULL, '0', '1', 0.00, 200.00, '2016/10/23 05:44', '2016-10-22 20:06:38', 1, '2016-10-22 23:10:46', 0, '0.00', 0, NULL, NULL, 0),
(198, 15, 146, 2.00, 0.20, 1.80, 'Less than 1 month', 'fgvhgfhj', 0, '1', 'wordpress', 'ryrte', 0, NULL, NULL, NULL, '0', '1', 0.00, 2.00, '2017/02/03 15:29', '2017-01-20 14:27:38', 0, NULL, 0, '2.00', 0, NULL, NULL, 2),
(199, 15, 144, 5.00, 0.50, 4.50, NULL, 'dkjfhf', 0, '0', 'New job 31', 'ok', 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '2017/01/21 23:14', '2017-01-21 17:14:02', 1, '2017-01-24 18:01:02', 0, '0.00', 0, NULL, NULL, 3),
(72, 15, 53, 300.00, 30.00, 270.00, 'Less than 1 month', 'sfdsf', 0, '0', 'testing 2', '', 0, NULL, NULL, NULL, '0', '2', 0.00, 682.00, '2016/10/26 03:37', '2016-10-25 21:36:29', 1, '2016-11-29 22:11:08', 0, '0.00', 0, NULL, NULL, 0),
(197, 13, 146, 1.00, 0.10, 0.90, 'Less than 1 week', 'rfgt', 0, '0', 'wordpress', 'ok', 0, NULL, NULL, NULL, '0', '1', 0.00, 1.00, '2017/01/18 13:54', '2017-01-18 07:54:02', 1, '2017-01-29 07:01:29', 0, '1.00', 0, NULL, NULL, 3),
(75, 15, 56, 12313.00, 1231.30, 11081.70, '3-6 months', 'fgfhgfdhdf', 1, '0', 'fdhggdfh', 'dsgsfd', 0, NULL, NULL, NULL, '0', '1', 0.00, 1115863.00, '2016/10/27 03:47', '2016-10-26 20:14:18', 1, '2016-11-30 13:11:28', 0, '0.00', 0, NULL, NULL, 0),
(76, 33, 57, 5.00, 0.50, 4.50, NULL, 'dfgsfdgfgh', 0, '1', 'date checking', 'rtyhtyh', 10, NULL, NULL, NULL, '0', NULL, 50.00, 0.00, '2016/10/28 03:49', '2016-10-26 21:43:26', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(77, 15, 57, 5.00, 0.50, 4.50, NULL, 'fsgfg', 0, '0', 'date checking', 'etgregy', 10, NULL, NULL, NULL, '0', NULL, 50.00, 0.00, '2016/09/27 03:44', '2016-10-26 21:43:41', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(196, 13, 143, 5.00, 0.50, 4.50, NULL, 'frdgh', 0, '0', 'New job', 'tyu', 50, NULL, NULL, NULL, '0', NULL, 250.00, 0.00, '2017/01/16 23:34', '2017-01-16 17:33:55', 1, '2017-02-28 17:02:23', 0, '0.00', 0, NULL, NULL, 3),
(80, 15, 60, 5.00, 0.50, 4.50, NULL, 'tgesrdtfhrgtjhty', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-11-21 18:33:05', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(81, 15, 64, 199.00, 19.90, 179.10, 'Less than 1 week', 'hyjhjttyukyutkiytlkuiylkyl', 0, '0', 'fixed job', 'tyuhrtu', 0, NULL, NULL, NULL, '0', '1', 0.00, 774.00, '2016/11/29 23:36', '2016-11-22 19:33:26', 1, '2016-11-29 22:11:49', 1, '0.00', 0, NULL, NULL, 0),
(82, 9, 64, 98.00, 40.00, 360.00, 'Less than 1 month', 'sdgdfhgfhj\r\nfghdfhfgyjhgjjjjjjjjjjjjjj\r\nfgdsssssssssssssss', 0, '0', 'fixed job', '', 0, NULL, NULL, NULL, '0', '2', 0.00, 98.00, '', '2016-11-22 19:45:25', 1, '2017-01-02 09:01:31', 1, '0.00', 0, NULL, NULL, 0),
(83, 9, 65, 5.00, 0.50, 4.50, NULL, 'dghtrhy', 0, '0', 'houry testing job', 'deteryt', 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '2016/12/01 16:35', '2016-11-22 20:01:16', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(195, 15, 138, 222.00, 22.20, 199.80, 'Less than 1 week', 'djfnjf', 0, '0', 'fixed description', 'rt', 0, NULL, NULL, NULL, '0', '1', 0.00, 222.00, '2017/01/16 01:03', '2017-01-15 18:35:24', 1, '2017-01-24 18:01:39', 0, '222.00', 0, NULL, NULL, 3),
(194, 13, 138, 111.00, 11.10, 99.90, 'Less than 1 week', 'jwdfnjk', 0, '0', 'sfsds', 'test', 0, NULL, NULL, NULL, '0', '2', 0.00, 16.00, '2017/01/16 01:00', '2017-01-15 18:34:46', 1, '2017-02-03 18:02:12', 0, '111.00', 0, NULL, NULL, 3),
(86, 15, 75, 20000.00, 40.00, 360.00, 'not_sure', 'hgdfhjfgjfhjghj', 1, '0', 'category 4', 'rftyery', 0, NULL, NULL, NULL, '0', '1', 0.00, 20000.00, '2016/12/01 16:27', '2016-11-27 20:14:14', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(88, 15, 76, 5.00, 0.50, 4.50, NULL, 'hytryurt6u', 0, '0', 'hourly testing', 'htuyt', 567, 6.00, 0.60, 5.40, '0', NULL, 2835.00, 0.00, '2016/11/29 02:18', '2016-11-28 20:16:26', 1, '2017-01-06 21:01:20', 1, '0.00', 0, NULL, NULL, 0),
(170, 15, 126, 12.00, 1.20, 10.80, 'Less than 1 month', 'ryeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-04 08:07:26', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(91, 15, 77, 100.00, 35.00, 315.00, '1-3 months', 'fdsghdfjkgdfjkg', 0, '0', 'Payment testing', '', 0, NULL, NULL, NULL, '0', '2', 0.00, 100.00, '', '2016-11-29 22:56:00', 1, '2016-11-30 15:11:28', 1, '0.00', 0, NULL, NULL, 0),
(193, 15, 136, 700.00, 70.00, 630.00, 'Less than 1 month', 'frg', 0, '1', 'fixed job test', 'ghgfh', 0, NULL, NULL, NULL, '0', '1', 0.00, 700.00, '2017/01/15 23:59', '2017-01-13 17:52:45', 0, NULL, 0, '700.00', 0, NULL, NULL, 2),
(192, 13, 136, 300.00, 30.00, 270.00, 'Less than 1 month', 'gfh', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-13 17:51:27', 0, NULL, 0, '0.00', 0, 1, 1, 1),
(94, 9, 79, 32434.00, 3243.40, 29190.60, 'Less than 1 month', 'fdghth', 0, '0', 'seo job testing', 'rytr', 0, NULL, NULL, NULL, '0', '1', 0.00, 32454.00, '2016/12/01 21:26', '2016-12-01 10:57:53', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(95, 15, 79, 23.00, 2.30, 20.70, 'Less than 1 month', 'fhtgfhj', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-01 10:59:10', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(191, 9, 134, 10000.00, 1000.00, 9000.00, 'Less than 1 month', 'ghgfj', 0, '0', 'test3', 'ok', 0, NULL, NULL, NULL, '0', '1', 0.00, 10014.00, '2017/01/15 23:44', '2017-01-13 17:45:26', 1, '2017-01-16 17:01:22', 0, '10000.00', 0, NULL, NULL, 3),
(98, 9, 80, 5.00, 0.50, 4.50, NULL, 'ryhrtuytru', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-02 20:42:11', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(99, 15, 80, 5.00, 0.50, 4.50, NULL, 'ertyuhrtj', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-02 20:42:28', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(101, 15, 81, 3.00, 0.30, 2.70, NULL, 'ethytrhy', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-02 20:48:21', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(102, 9, 82, 300.00, 30.00, 270.00, 'Less than 1 month', 'tyhtru', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-03 17:05:42', 0, NULL, 0, '0.00', 0, 1, 1, 0),
(190, 15, 134, 49.00, 4.90, 44.10, '1-3 months', 'gghf', 0, '1', 'test3', 'rt', 0, NULL, NULL, NULL, '0', '2', 0.00, 25000.00, '2017/01/13 21:17', '2017-01-13 15:16:18', 0, NULL, 0, '49.00', 0, NULL, NULL, 2),
(189, 13, 134, 150.00, 15.00, 135.00, '1-3 months', 'sgre', 0, '0', 'test3', 'eter', 0, NULL, NULL, NULL, '0', '1', 0.00, 150.00, '2017/01/13 16:47', '2017-01-13 10:47:09', 1, '2017-01-15 18:01:33', 0, '150.00', 0, NULL, NULL, 3),
(105, 15, 83, 150.00, 15.00, 50.00, '1-3 months', 'fgdtfh', 0, '0', 'testing9', 'gdhgfj', 0, NULL, NULL, NULL, '0', '2', 0.00, 50.00, '2016/12/04 01:36', '2016-12-03 19:36:06', 1, '2016-12-11 20:12:08', 0, '0.00', 0, NULL, NULL, 0),
(188, 13, 133, 11.00, 1.10, 9.90, 'Less than 1 month', 'reyter', 0, '0', 'fixed 1', '', 0, NULL, NULL, NULL, '0', '2', 0.00, 100024.00, '2017/01/13 16:33', '2017-01-13 10:12:39', 1, '2017-01-16 18:01:00', 0, '11.00', 0, NULL, NULL, 3),
(187, 9, 133, 5.00, 0.50, 4.50, 'Less than 1 month', 'sdfg', 0, '1', 'fixed 1', 'ery', 0, NULL, NULL, NULL, '0', '1', 0.00, 5.00, '2017/01/13 16:29', '2017-01-13 09:56:51', 0, NULL, 1, '5.00', 0, 1, 2, 2),
(108, 15, 85, 99.00, 9.90, 89.10, 'Less than 1 month', 'dghfj', 0, '1', 'a', 'fggjyt', 0, NULL, NULL, NULL, '0', '1', 0.00, 99.00, '2016/12/04 02:17', '2016-12-03 20:15:50', 0, NULL, 0, '99.00', 0, NULL, NULL, 0),
(110, 15, 86, 2.00, 0.20, 1.80, 'Less than 1 month', 'fsdrhtrh', 0, '1', 'b', 'teryr', 0, NULL, NULL, NULL, '0', '2', 0.00, 8.00, '2016/12/04 02:26', '2016-12-03 20:26:08', 0, NULL, 0, '8.00', 0, NULL, NULL, 0),
(186, 15, 133, 6.00, 0.60, 5.40, 'Less than 1 month', 'sdgrf', 0, '1', 'fixed 1', 'tguty', 0, NULL, NULL, NULL, '0', '1', 0.00, 6.00, '2017/01/13 15:55', '2017-01-13 09:54:55', 0, NULL, 0, '6.00', 0, NULL, NULL, 2),
(113, 15, 88, 22.00, 2.20, 19.80, 'Less than 1 week', 'asdasda', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-04 18:02:36', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(115, 15, 89, 5.00, 0.50, 4.50, NULL, 'ertyhtr', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-04 18:40:09', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(116, 15, 91, 500.00, 50.00, 450.00, 'Less than 1 month', 'You need to create eBay listings for my products. I provide images, the “sell for” price, and a link where you can get a general description of the product. the way it will work: I will share an excel file on google sheets and also a google drive. The excel file contains 2 columns, number + link. By the number you can know which images are for this product on the google drive. And the link helps you to get a general description for the product. After that you need to: 1. Generate an accurate, and high rating keywords title. (must be at least 75 to 80 chars, 80 is the ebay limit). The best way is to see the main keywords that describe the product, use them and add other keywords to it that you can see other eBay sellers uses, or on google search they come up, or using Terapeak.com which is a great tool to generate titles. Cannot use brand keywords that is not really the product. Each keyword must be 100% accurate for the product it self. Keywords such as:Fits a brand name, or some product. Is OK! 2. create a listing description, most of the links already have descriptions but you need to enhance it for better looking + English correction. (It must look different than the source, in a better way) 3. Settings the listing for Variations, in case a product has more than 1 variation such as size, or different color and so on. free shipping selling wordwide (exlude Israel) Product Live for duartion: “Good Till Canceled” 4. Update the unique Item number eBay provides to the excel file right after you publish the product live. You must use WhatsApp + have fluent English for a long term work. you`ll have about 20 links a day. We pay 0.5$ per listing.', 0, '1', 'PHP DEVELOPER - ONGOING WORK', 'fhgdtgf', 0, NULL, NULL, NULL, '0', '1', 0.00, 500.00, '2016/12/07 02:23', '2016-12-04 21:57:46', 0, NULL, 0, '500.00', 0, NULL, NULL, 0),
(117, 15, 92, 5.00, 0.50, 4.50, NULL, 'ryhtr', 0, '1', 'time and date testing', 'THRYTH', 45, NULL, NULL, NULL, '0', NULL, 225.00, 0.00, '2016/12/06 03:49', '2016-12-05 21:23:14', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(179, 9, 128, 3456.00, 345.60, 3110.40, 'Less than 1 week', 'rtery', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-06 14:07:48', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(119, 15, 100, 34.00, 3.40, 30.60, 'Less than 1 week', 'ret', 0, '1', 'hire testing', 'gtrtyr', 0, NULL, NULL, NULL, '0', '1', 0.00, 34.00, '2016/12/07 21:46', '2016-12-07 15:46:05', 0, NULL, 0, '34.00', 0, NULL, NULL, 0),
(178, 9, 129, 5.00, 0.50, 4.50, NULL, 'ryetry', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-06 14:07:20', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(121, 15, 104, 500.00, 50.00, 450.00, 'Less than 1 week', 'dfhtr', 0, '0', 'html 2', 'htg', 0, NULL, NULL, NULL, '0', '2', 0.00, 9.00, '2016/12/11 21:31', '2016-12-09 23:30:45', 0, NULL, 0, '500.00', 0, NULL, NULL, 0),
(185, 9, 132, 250.00, 25.00, 225.00, 'Less than 1 month', 'bjhkgh', 0, '0', 'fixed', 'rstr', 0, NULL, NULL, NULL, '0', '2', 0.00, 9.00, '2017/01/13 15:53', '2017-01-13 08:03:05', 1, '2017-01-16 17:01:23', 1, '250.00', 0, 1, 2, 3),
(177, 15, 128, 50.00, 5.00, 45.00, 'Less than 1 week', 'stre', 0, '1', 'test-5', 'fghfg', 0, NULL, NULL, NULL, '0', '1', 0.00, 50.00, '', '2017-01-05 22:29:17', 0, NULL, 0, '50.00', 0, NULL, NULL, 2),
(123, 15, 101, 400.00, 40.00, 360.00, 'not_sure', 'sghdfhtdh', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-10 21:10:38', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(124, 15, 105, 40.00, 4.00, 36.00, 'Less than 1 month', 'tretre', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-10 21:10:51', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(125, 15, 106, 111.00, 11.10, 99.90, 'Less than 1 week', 'fgdth', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-11 15:35:52', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(126, 9, 106, 999.00, 99.90, 899.10, 'Less than 1 week', 'htht', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-11 15:37:05', 0, NULL, 0, '0.00', 0, NULL, NULL, 1),
(127, 15, 107, 11.00, 1.10, 9.90, 'Less than 1 month', 'rgrg', 0, '0', 'payment testing', 'ttfuru', 0, NULL, NULL, NULL, '0', '1', 0.00, 6.00, '2016/12/11 21:47', '2016-12-11 15:41:37', 0, NULL, 0, '6.00', 0, NULL, NULL, 0),
(128, 9, 107, 99.00, 9.90, 89.10, '1-3 months', 'sdgdyd', 0, '1', 'payment testing', 'fhgfh', 0, NULL, NULL, NULL, '0', '2', 0.00, 1.00, '2016/12/11 21:45', '2016-12-11 15:42:41', 0, NULL, 1, '99.00', 0, NULL, NULL, 0),
(174, 15, 127, 150.00, 15.00, 135.00, 'Less than 1 month', 'sdgtre', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-04 09:39:45', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(130, 15, 108, 100.00, 10.00, 90.00, 'Less than 1 week', 'tewst', 0, '1', 'php', 'wggfhfg', 0, NULL, NULL, NULL, '0', '1', 0.00, 10100.00, '2016/12/13 00:56', '2016-12-11 16:21:42', 0, NULL, 0, '10100.00', 0, NULL, NULL, 0),
(184, 15, 131, 5.00, 0.50, 4.50, NULL, 'ok', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-13 05:53:29', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(132, 9, 108, 34.00, 3.40, 30.60, '1-3 months', 'rtey', 0, '1', 'php', 'sdgdthtr', 0, NULL, NULL, NULL, '0', '1', 0.00, 34.00, '2016/12/13 00:47', '2016-12-11 16:49:48', 0, NULL, 1, '34.00', 0, NULL, NULL, 0),
(172, 15, 124, 5.00, 0.50, 4.50, NULL, 'etyeryetryu', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2017-01-04 09:33:52', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(134, 15, 109, 300.00, 30.00, 270.00, '3-6 months', 'dyty', 0, '0', 'php payment ', 'edgr', 0, NULL, NULL, NULL, '0', '', 0.00, 50.00, '2016/12/16 15:14', '2016-12-11 17:59:08', 0, NULL, 0, '300.00', 0, NULL, NULL, 0),
(136, 15, 110, 23.00, 2.30, 20.70, 'Less than 1 month', 'rtry', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-12 18:11:31', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(137, 15, 111, 39.00, 3.90, 35.10, 'Less than 1 month', 'dfhgf', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-14 16:48:41', 0, NULL, 0, '0.00', 0, 1, 1, 0),
(183, 15, 132, 60.00, 6.00, 54.00, 'Less than 1 week', 'sftgr', 0, '0', 'fixed', 'hi', 0, NULL, NULL, NULL, '0', '1', 0.00, 85.00, '2017/01/13 11:42', '2017-01-13 05:21:50', 1, '2017-01-14 18:01:50', 0, '60.00', 0, NULL, NULL, 3),
(140, 15, 112, 1.00, 0.10, 0.90, 'Less than 1 month', 'frytru', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-16 05:12:21', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(141, 9, 112, 2.00, 0.20, 1.80, 'Less than 1 week', 'frytry', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-16 05:12:45', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(143, 15, 113, 5.00, 0.50, 4.50, NULL, 'erye5ye5', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-16 05:29:41', 0, NULL, 0, '0.00', 0, 1, 1, 0),
(144, 9, 113, 5.00, 0.50, 4.50, NULL, 'truyityik', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-19 10:50:57', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(168, 9, 123, 5.00, 0.50, 4.50, NULL, 'sgtery', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-28 18:11:25', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(148, 9, 115, 34.00, 3.40, 30.60, 'not_sure', 'wergtergyhert', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-22 09:02:37', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(149, 9, 116, 5.00, 0.50, 4.50, NULL, 'ergterhgy', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-22 09:04:50', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(167, 15, 123, 5.00, 0.50, 4.50, NULL, 'srgyetry', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-28 18:10:00', 0, NULL, 0, '0.00', 0, 1, 1, 1),
(151, 15, 117, 34354.00, 3435.40, 30918.60, 'Less than 1 month', 'sghthtr', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-23 17:24:56', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(152, 15, 118, 5.00, 0.50, 4.50, NULL, 'Hi we are testing job details', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-23 17:47:02', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(153, 9, 118, 5.00, 0.50, 4.50, NULL, 'ytkt', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-23 17:47:53', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(155, 15, 119, 5.00, 0.50, 4.50, NULL, 'egdfgh', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-23 20:48:03', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(156, 9, 119, 5.00, 0.50, 4.50, NULL, 'sdg', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-23 20:50:12', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(181, 13, 132, 100.00, 10.00, 90.00, 'Less than 1 month', 'we are testing fixed ', 0, '0', 'fixed', 'fgfg', 0, NULL, NULL, NULL, '0', '1', 0.00, 101.00, '2017/01/13 12:51', '2017-01-13 05:19:06', 1, '2017-01-16 18:01:29', 0, '100.00', 0, NULL, NULL, 3),
(158, 15, 120, 5.00, 0.50, 4.50, NULL, 'fdhdfh', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-24 04:58:08', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(160, 9, 120, 5.00, 0.50, 4.50, NULL, 'ryghtreuhru', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-24 05:07:14', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(161, 43, 120, 5.00, 0.50, 4.50, NULL, 'this is testing page', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-24 08:49:44', 0, NULL, 1, '0.00', 0, 1, 2, 0),
(162, 15, 120, 5.00, 0.50, 4.50, NULL, 'rtyurturu', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-24 15:30:08', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(182, 13, 131, 5.00, 0.50, 4.50, NULL, 'we are testing hourly', 0, '1', 'hourly', 'fgh', 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '2017/01/13 15:50', '2017-01-13 05:19:18', 0, NULL, 0, '0.00', 0, NULL, NULL, 2),
(164, 15, 121, 5.00, 0.50, 4.50, NULL, 'teyrt6', 1, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-25 16:02:35', 0, NULL, 0, '0.00', 0, NULL, NULL, 0),
(165, 15, 121, 5.00, 0.50, 4.50, NULL, 'a', 0, '0', NULL, NULL, 0, NULL, NULL, NULL, '0', NULL, 0.00, 0.00, '0', '2016-12-25 16:06:06', 0, NULL, 1, '0.00', 0, NULL, NULL, 0),
(237, 15, 179, 5.00, 0.50, 4.50, NULL, '11111111111 1111111111111111111111111 11111111111111111111111111111111 11111111111111111111111111111111111111111111111111111111111111111111111 111111111111111111111111111111111111111111111111111112333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333', 0, '1', 'edit job title then after hire show is and if do not use then show original(php hourly)', 'ftrrtr', 45, NULL, NULL, NULL, '0', NULL, 225.00, 0.00, '10/03/2017', '2017-03-10 15:15:18', 0, NULL, 0, '0.00', 0, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `job_bid_attachments`
--

DROP TABLE IF EXISTS `job_bid_attachments`;
CREATE TABLE `job_bid_attachments` (
  `id` int(11) NOT NULL,
  `job_bid_id` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_bid_attachments`
--

INSERT INTO `job_bid_attachments` (`id`, `job_bid_id`, `path`) VALUES
(1, 18, '/uploads/1472539190866726.jpg'),
(2, 82, '/uploads/147984392568749.png');

-- --------------------------------------------------------

--
-- Structure de la table `job_categories`
--

DROP TABLE IF EXISTS `job_categories`;
CREATE TABLE `job_categories` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_categories`
--

INSERT INTO `job_categories` (`cat_id`, `category_name`, `date_created`) VALUES
(1, 'Web, Mobile & Software Dev', '2016-08-16 20:07:11'),
(2, 'IT & Networking', '2016-08-16 20:07:11'),
(3, 'Data Science & Analytics', '2016-08-16 20:07:11'),
(4, 'Engineering & Architecture', '2016-08-16 20:07:11'),
(5, 'Design & Creative', '2016-08-16 20:07:11'),
(6, 'Writing', '2016-08-16 20:07:11'),
(7, 'Translation', '2016-08-16 20:07:11'),
(8, 'Legal', '2016-08-16 20:07:11'),
(9, 'Admin Support', '2016-08-16 20:07:11'),
(10, 'Customer Service', '2016-08-16 20:07:11'),
(11, 'Sales & Marketing', '2016-08-16 20:07:11'),
(12, 'Accounting & Consulting', '2016-08-16 20:07:11');

-- --------------------------------------------------------

--
-- Structure de la table `job_conversation`
--

DROP TABLE IF EXISTS `job_conversation`;
CREATE TABLE `job_conversation` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `message_conversation` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `have_seen` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= unseen,0=seen'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_conversation`
--

INSERT INTO `job_conversation` (`id`, `job_id`, `bid_id`, `message_conversation`, `sender_id`, `receiver_id`, `created`, `have_seen`) VALUES
(15, 32, 14, 'dfbdfbvdf bdf dfb', 25, 18, '2016-09-01 14:27:19', 0),
(16, 32, 14, 'dfbdfbdbd bdbdbbfdfbdf b', 25, 18, '2016-09-01 14:40:54', 0),
(17, 32, 14, 'fgnfnfnfgn bdfbgdf b', 25, 18, '2016-09-01 14:41:42', 0),
(18, 32, 14, 'sdvfgsdv sv sdv sd v', 25, 18, '2016-09-01 14:45:10', 0),
(19, 32, 14, 'sbvsfbsbsb', 25, 18, '2016-09-01 14:45:43', 0),
(20, 32, 14, 'test message', 25, 18, '2016-09-01 14:50:01', 0),
(21, 32, 14, 'test', 25, 18, '2016-09-01 14:51:34', 0),
(23, 32, 14, 'fgncgnbdf sdf vsdv', 25, 18, '2016-09-01 15:20:27', 0),
(24, 32, 14, 'ppp', 25, 18, '2016-09-01 15:20:42', 0),
(25, 32, 14, 'uu', 25, 18, '2016-09-01 15:21:03', 0),
(26, 32, 14, 'wer', 25, 18, '2016-09-01 18:58:40', 0),
(27, 32, 14, '', 25, 18, '2016-09-01 18:58:41', 0),
(28, 32, 14, '', 25, 18, '2016-09-01 18:58:41', 0),
(29, 32, 14, 'sad', 25, 18, '2016-09-01 18:58:49', 0),
(32, 32, 14, 'test', 25, 18, '2016-09-01 19:01:02', 0),
(35, 32, 14, 'test', 25, 18, '2016-09-01 19:01:40', 0),
(36, 32, 14, 'hi', 25, 18, '2016-09-01 19:01:54', 0),
(37, 33, 19, 'hi', 9, 18, '2016-09-01 19:03:56', 0),
(38, 32, 14, 'gh,fhfdfh hd hd', 25, 18, '2016-09-01 19:12:10', 0),
(338, 153, 221, 'j', 18, 18, '2017-03-04 18:50:42', 0),
(337, 179, 236, 'dd', 18, 13, '2017-03-04 17:51:44', 1),
(336, 153, 221, 'hi', 13, 18, '2017-03-01 17:02:36', 0),
(335, 157, 228, 'h', 13, 18, '2017-03-01 08:01:38', 0),
(334, 157, 228, 'hi', 13, 18, '2017-02-27 20:29:00', 0),
(128, 36, 30, 'yes m here', 25, 18, '2016-09-29 07:14:57', 0),
(333, 153, 221, 'ssssssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 13, 18, '2017-02-27 18:50:25', 0),
(84, 34, 26, 'hi', 9, 15, '2016-09-05 13:50:30', 0),
(332, 157, 228, 'Hi arun please chcek website www.winjiob.com I need high experience php expert', 18, 13, '2017-02-27 10:21:14', 0),
(86, 32, 23, 'SsS', 25, 18, '2016-09-05 14:13:22', 0),
(331, 153, 221, 'h', 18, 18, '2017-02-26 09:22:14', 0),
(88, 34, 25, 'hi', 9, 18, '2016-09-05 14:23:46', 0),
(330, 153, 221, 'h', 18, 13, '2017-02-26 09:21:02', 0),
(329, 153, 221, 'hh', 18, 13, '2017-02-26 09:20:24', 0),
(91, 32, 23, 'helli ji', 25, 18, '2016-09-07 11:55:09', 0),
(125, 32, 15, 'hi', 9, 18, '2016-09-28 11:34:40', 0),
(328, 153, 221, 'h', 18, 13, '2017-02-26 09:20:16', 0),
(94, 32, 23, 'test 1 confirme', 25, 18, '2016-09-07 12:38:46', 0),
(95, 35, 32, 'hi', 13, 18, '2016-09-07 16:57:01', 0),
(327, 156, 226, 'dfsd', 18, 13, '2017-02-21 15:18:57', 0),
(326, 154, 224, 'gh', 18, 9, '2017-02-18 11:03:22', 1),
(324, 153, 221, 'fghgh', 18, 13, '2017-02-17 11:58:00', 0),
(325, 153, 221, 'hi\r\n', 13, 18, '2017-02-18 07:00:47', 0),
(323, 153, 221, 'fghgfh', 18, 13, '2017-02-17 11:57:58', 0),
(322, 153, 221, 'fhh', 18, 13, '2017-02-17 11:57:56', 0),
(321, 153, 221, 'fdhfdh', 18, 13, '2017-02-17 11:57:54', 0),
(317, 133, 187, 'FGFGTH', 18, 9, '2017-02-17 10:00:14', 1),
(316, 150, 211, 'dfhgdfh', 18, 13, '2017-02-17 09:41:27', 0),
(315, 131, 182, 'afgfg', 18, 13, '2017-02-17 09:21:25', 0),
(314, 131, 182, 'asgg', 18, 13, '2017-02-17 09:21:24', 0),
(313, 131, 182, 'dfgdsg', 18, 13, '2017-02-17 09:21:22', 0),
(110, 32, 23, 'yes m here ', 25, 18, '2016-09-23 07:55:23', 0),
(320, 153, 222, 'fgjfgj', 18, 9, '2017-02-17 11:30:19', 1),
(112, 35, 27, 'i am here', 25, 18, '2016-09-23 07:59:09', 0),
(312, 150, 212, 'dfhdfh', 18, 9, '2017-02-17 05:17:10', 0),
(117, 40, 39, 'hi', 9, 18, '2016-09-23 14:09:20', 0),
(311, 150, 212, 'dfhdfh', 18, 9, '2017-02-17 05:17:08', 0),
(119, 40, 39, 'hi', 9, 18, '2016-09-25 15:53:09', 0),
(120, 38, 34, 'hi', 9, 18, '2016-09-25 15:53:28', 0),
(121, 38, 34, 'ok', 9, 18, '2016-09-25 15:53:49', 0),
(122, 32, 23, 'yes m here\r\n', 25, 18, '2016-09-26 12:16:16', 0),
(310, 150, 212, 'dfhdfh', 18, 9, '2017-02-17 05:17:07', 0),
(319, 153, 221, 'gfjfgjfgj', 18, 13, '2017-02-17 11:30:16', 0),
(129, 40, 39, 'Hi', 9, 18, '2016-10-01 18:49:35', 0),
(309, 150, 212, 'dfhdfh', 18, 9, '2017-02-17 05:17:06', 0),
(308, 150, 212, 'fyty', 18, 9, '2017-02-17 04:47:23', 0),
(304, 148, 208, 'dfgr', 18, 13, '2017-02-16 06:38:15', 0),
(303, 9, 204, 'dffg', 18, 18, '2017-02-16 06:38:08', 1),
(302, 13, 210, 'fgfrg', 18, 18, '2017-02-16 06:38:01', 1),
(301, 149, 213, 'thanks okay', 18, 9, '2017-02-16 06:14:15', 1),
(300, 149, 213, 'hello testing ', 18, 9, '2017-02-16 06:14:01', 1),
(299, 149, 214, 'hello', 18, 15, '2017-02-16 05:34:35', 1),
(298, 150, 212, 'vjkjk', 9, 18, '2017-02-15 15:35:53', 0),
(297, 150, 212, 'dfghfgh', 18, 9, '2017-02-15 15:29:42', 0),
(307, 150, 212, 'fjfgj', 18, 9, '2017-02-17 04:06:18', 0),
(296, 150, 212, 'fghfgh', 18, 9, '2017-02-15 15:29:39', 0),
(145, 48, 59, 'test message', 13, 18, '2016-10-13 17:44:18', 0),
(146, 48, 59, 'test message', 13, 18, '2016-10-13 17:44:18', 0),
(147, 49, 62, 'Hi', 35, 9, '2016-10-14 16:38:58', 0),
(148, 50, 64, 'dfgdg', 29, 13, '2016-10-14 18:55:03', 0),
(295, 150, 212, 'fghfghfgh', 18, 9, '2017-02-15 15:29:38', 0),
(294, 150, 212, 'gfhfgh', 18, 9, '2017-02-15 09:22:57', 0),
(318, 150, 212, 'frg', 18, 9, '2017-02-17 10:07:05', 0),
(293, 150, 212, 'gfhgfh', 18, 9, '2017-02-15 09:22:54', 0),
(153, 50, 64, 'ghgj', 13, 29, '2016-10-18 17:41:45', 0),
(154, 50, 64, 'etruuuuuuuuuuuuuuuuu', 13, 29, '2016-10-18 17:41:51', 0),
(292, 150, 212, 'dfgfdg', 18, 9, '2017-02-07 08:31:07', 0),
(306, 150, 212, 'ghjghj', 18, 9, '2017-02-17 04:06:16', 0),
(157, 46, 58, 'fgdfh', 15, 18, '2016-10-18 17:45:12', 0),
(158, 46, 58, 'thytrh', 15, 18, '2016-10-18 17:45:14', 0),
(291, 150, 212, 'dfgdfg', 18, 9, '2017-02-07 08:31:05', 0),
(290, 150, 212, 'sdfgsdg', 18, 9, '2017-02-07 08:30:57', 0),
(289, 150, 211, 'ghgh', 18, 13, '2017-02-07 08:03:26', 0),
(288, 150, 211, 'fgjhfghj', 18, 13, '2017-02-07 08:03:24', 0),
(164, 46, 57, 'dsdfsd', 13, 18, '2016-11-02 17:49:45', 0),
(165, 55, 73, 'sgetrfdhrteh', 13, 18, '2016-11-21 18:16:13', 0),
(166, 55, 73, 'sgetrfdhrteh', 13, 18, '2016-11-21 18:16:15', 0),
(167, 55, 73, 'rthyrthryt', 13, 18, '2016-11-21 18:16:19', 0),
(168, 55, 73, 'rthyrthr', 13, 18, '2016-11-21 18:16:24', 0),
(170, 65, 83, 'dgfhrfghjt', 29, 9, '2016-11-22 20:04:52', 0),
(287, 150, 211, 'ftdhfgh', 18, 13, '2017-02-07 08:03:22', 0),
(286, 150, 211, ';ojjhoiyhio', 18, 13, '2017-02-07 06:21:20', 0),
(175, 75, 86, 'dfyhtruy', 29, 15, '2016-12-01 10:29:00', 0),
(176, 75, 85, 'tryrtuyrtu', 29, 13, '2016-12-01 10:29:55', 0),
(285, 132, 181, 'gfjhfgjfg\r\n', 18, 18, '2017-02-06 16:03:05', 0),
(284, 149, 214, 'hgjghj', 18, 15, '2017-02-05 10:42:14', 1),
(305, 150, 212, 'ghjgj', 18, 9, '2017-02-17 04:06:15', 0),
(283, 150, 212, 'dfgdfsgfdg', 18, 9, '2017-02-05 10:35:50', 0),
(188, 88, 113, 'xx', 13, 15, '2016-12-04 19:11:26', 0),
(190, 89, 114, 'gg', 13, 18, '2016-12-04 21:08:51', 0),
(282, 147, 207, 'fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg fdg dfg dfsg dfgdfg dfgdfg ', 13, 18, '2017-02-04 16:44:21', 0),
(281, 147, 207, 'dgf', 13, 18, '2017-02-04 16:15:53', 0),
(193, 88, 113, 'ryty', 15, 18, '2016-12-05 21:28:41', 0),
(280, 147, 207, 'ghkghk', 13, 18, '2017-02-04 15:36:05', 0),
(279, 147, 207, 'fgjfgjfg fgj', 18, 18, '2017-02-04 15:35:34', 0),
(278, 147, 207, 'fghfgh', 13, 18, '2017-02-03 19:17:14', 0),
(277, 147, 207, 'hi', 18, 13, '2017-02-02 15:27:22', 0),
(276, 147, 204, 'dfgrg', 18, 9, '2017-01-30 06:43:35', 0),
(275, 146, 198, 'gkhfjkg', 15, 15, '2017-01-29 17:32:01', 1),
(274, 146, 198, 'ghkgkh', 15, 15, '2017-01-29 17:31:59', 1),
(273, 146, 198, 'khgjkk', 15, 15, '2017-01-29 17:31:57', 1),
(272, 146, 198, 'hi', 18, 15, '2017-01-29 15:59:55', 1),
(271, 146, 198, 'hi\ngfdsagafg', 18, 15, '2017-01-29 15:59:51', 1),
(207, 111, 137, 'ertyt', 15, 18, '2016-12-16 09:16:09', 0),
(270, 146, 201, 'fdjfgj', 18, 9, '2017-01-24 20:57:37', 1),
(210, 113, 142, 'hi', 13, 18, '2016-12-19 18:45:39', 0),
(269, 146, 201, 'fdjdfj', 18, 9, '2017-01-24 20:57:35', 1),
(268, 146, 201, 'hjfgjfg', 18, 9, '2017-01-24 20:57:34', 1),
(213, 116, 147, 'ok', 13, 18, '2016-12-22 14:25:32', 0),
(267, 146, 201, 'fgjfgj', 18, 9, '2017-01-24 20:57:32', 1),
(266, 146, 201, 'fgjnfgj', 18, 9, '2017-01-24 20:57:31', 1),
(265, 146, 201, 'df gdfg df', 13, 9, '2017-01-24 20:39:24', 1),
(218, 118, 0, 'fgf', 9, 18, '2016-12-23 18:42:39', 1),
(219, 118, 153, 'ryt', 9, 18, '2016-12-23 18:46:32', 1),
(264, 146, 201, 'fsdg dfg dfg ', 13, 9, '2017-01-24 20:39:22', 1),
(222, 117, 0, 'frgterh', 13, 18, '2016-12-25 13:59:22', 1),
(223, 117, 0, 'frghtrh', 13, 18, '2016-12-25 13:59:27', 1),
(263, 146, 201, 'sdfgdsfg df', 13, 9, '2017-01-24 20:39:19', 1),
(262, 146, 201, 'hi', 13, 9, '2017-01-24 20:39:17', 1),
(226, 121, 164, '1', 15, 18, '2016-12-25 16:05:17', 0),
(227, 120, 159, 'fdghtjhyfj', 13, 18, '2016-12-27 10:39:27', 0),
(261, 146, 201, 'hello\n', 13, 9, '2017-01-24 20:39:14', 1),
(260, 136, 192, 'gi', 18, 13, '2017-01-14 07:44:18', 0),
(259, 133, 188, 'test ', 13, 18, '2017-01-14 05:22:29', 0),
(258, 133, 188, 'sss', 13, 18, '2017-01-14 05:07:12', 0),
(257, 106, 126, 'ee', 29, 9, '2017-01-13 15:35:07', 1),
(256, 132, 181, 'aaa', 13, 18, '2017-01-13 15:05:42', 0),
(255, 132, 181, 'aaa', 13, 18, '2017-01-13 15:03:36', 0),
(248, 75, 85, 'test remove ', 13, 29, '2017-01-13 09:18:20', 0),
(249, 75, 85, 'test removed ', 13, 29, '2017-01-13 09:20:27', 0),
(250, 75, 85, 'aaa', 13, 29, '2017-01-13 09:21:12', 0),
(251, 132, 181, 'hi', 18, 13, '2017-01-13 09:24:28', 0),
(252, 132, 181, 'hello', 13, 18, '2017-01-13 09:26:04', 0),
(253, 133, 188, 'er', 18, 13, '2017-01-13 10:14:31', 0),
(254, 75, 85, 'aaa', 13, 29, '2017-01-13 15:02:19', 0),
(247, 75, 85, 'ssss', 13, 29, '2017-01-13 09:16:21', 0),
(238, 126, 170, 'ok', 15, 18, '2017-01-11 21:20:12', 0),
(239, 0, 0, '', 13, 0, '2017-01-12 07:07:54', 1),
(240, 0, 0, '', 13, 0, '2017-01-12 07:08:56', 1),
(241, 0, 0, 'sdsd', 13, 0, '2017-01-12 09:20:47', 1),
(242, 0, 0, 'aaa', 13, 0, '2017-01-12 09:21:00', 1),
(243, 0, 0, 'aaa', 13, 0, '2017-01-12 09:25:34', 1),
(244, 0, 0, 'sss', 13, 0, '2017-01-12 09:26:43', 1),
(246, 75, 85, 'ssssss', 13, 29, '2017-01-13 07:21:18', 0),
(339, 157, 230, 'some message ', 18, 15, '2017-03-08 10:42:12', 1),
(340, 157, 230, 'dfsfsgss', 18, 15, '2017-03-08 10:42:24', 1),
(341, 153, 221, 'hh', 18, 18, '2017-03-08 12:16:08', 0),
(342, 13, 235, 'fggh', 18, 18, '2017-03-09 20:28:56', 1),
(343, 179, 236, 'hi', 18, 0, '2017-03-09 20:29:37', 1),
(344, 178, 235, 'console', 18, 13, '2017-03-09 21:59:59', 1),
(345, 178, 235, 'je comprend bien', 18, 13, '2017-03-09 22:06:01', 1),
(346, 178, 235, 'je pense que le message est OK', 18, 13, '2017-03-09 22:14:13', 1);

-- --------------------------------------------------------

--
-- Structure de la table `job_conversation_files`
--

DROP TABLE IF EXISTS `job_conversation_files`;
CREATE TABLE `job_conversation_files` (
  `id` int(11) NOT NULL,
  `job_conversation_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_conversation_files`
--

INSERT INTO `job_conversation_files` (`id`, `job_conversation_id`, `name`, `original_name`) VALUES
(1, 242, 'image_58774a7c8ad8b.jpg', 'Hydrangeas.jpg'),
(2, 242, 'image_58774a7c8b31c.jpg', 'Jellyfish.jpg'),
(3, 243, 'image_58774b8ec7a9a.jpg', 'Hydrangeas.jpg'),
(4, 243, 'image_58774b8ec805f.jpg', 'Jellyfish.jpg'),
(5, 244, 'image_58774bd3b02b8.jpg', 'Hydrangeas.jpg'),
(6, 244, 'image_58774bd3b08e9.jpg', 'Jellyfish.jpg'),
(7, 246, 'image_58787fee57ce1.jpg', 'Hydrangeas.jpg'),
(8, 246, 'image_58787fee582c0.jpg', 'Jellyfish.jpg'),
(9, 247, 'image_58789ae5c5a11.', NULL),
(10, 247, 'image_58789ae5c5c77.', NULL),
(11, 248, 'image_58789b5c205ec.jpg', NULL),
(12, 248, 'image_58789b5c207e2.jpg', 'Hydrangeas.jpg'),
(13, 249, 'image_58789bdb86f48.jpg', 'Hydrangeas.jpg'),
(14, 249, 'image_58789bdb87575.jpg', NULL),
(15, 249, 'image_58789bdb8771e.jpg', NULL),
(16, 250, 'image_58789c0836a6c.jpg', 'Desert.jpg'),
(17, 254, 'image_5878ebfbebf50.jpg', 'Hydrangeas.jpg'),
(18, 254, 'image_5878ebfbec4f8.jpg', 'Jellyfish.jpg'),
(19, 255, 'image_5878ec48ee15f.jpg', 'Hydrangeas.jpg'),
(20, 255, 'image_5878ec48ee649.jpg', 'Jellyfish.jpg'),
(21, 256, 'image_5878ecc662bba.jpg', 'Hydrangeas.jpg'),
(22, 256, 'image_5878ecc66307a.jpg', 'Jellyfish.jpg'),
(23, 256, 'image_5878ecc663670.jpg', 'Koala.jpg'),
(24, 258, 'image_5879b20086412.jpg', 'Desert.jpg'),
(25, 258, 'image_5879b20086c15.jpg', 'Hydrangeas.jpg'),
(26, 258, 'image_5879b20087050.jpg', 'Jellyfish.jpg'),
(27, 259, 'image_5879b595068c8.jpg', 'Jellyfish.jpg'),
(28, 259, 'image_5879b59506fff.jpg', NULL),
(29, 281, 'image_5895fe3951b73.jpg', 'screenshot_61.png');

-- --------------------------------------------------------

--
-- Structure de la table `job_feedback`
--

DROP TABLE IF EXISTS `job_feedback`;
CREATE TABLE `job_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_job_id` int(11) NOT NULL,
  `feedback_userid` int(11) NOT NULL,
  `feedback_clientid` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `feedback_skill` float(10,2) DEFAULT NULL,
  `feedback_quality` float(10,2) DEFAULT NULL,
  `feedback_ability` float(10,2) DEFAULT NULL,
  `feedback_deadline` int(11) NOT NULL,
  `feedback_communication` float(10,2) DEFAULT NULL,
  `feedback_score` float(10,2) DEFAULT NULL,
  `feedback_comment` text NOT NULL,
  `feedback_creted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `haveseen` tinyint(1) NOT NULL DEFAULT '0'COMMENT
) ;

--
-- Contenu de la table `job_feedback`
--

INSERT INTO `job_feedback` (`feedback_id`, `feedback_job_id`, `feedback_userid`, `feedback_clientid`, `sender_id`, `feedback_skill`, `feedback_quality`, `feedback_ability`, `feedback_deadline`, `feedback_communication`, `feedback_score`, `feedback_comment`, `feedback_creted`, `haveseen`) VALUES
(94, 143, 13, 18, 13, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 'gfyfu', '2017-02-28 17:24:23', 0),
(92, 138, 13, 18, 13, 5.00, 5.00, 5.00, 5, 4.50, 4.90, 'dfgh', '2017-02-03 18:59:12', 0),
(93, 148, 9, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'fgt', '2017-02-03 19:12:14', 0),
(89, 132, 13, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'ok', '2017-01-27 17:18:43', 0),
(90, 147, 15, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'kjhg bkjh kj', '2017-01-27 20:56:20', 0),
(91, 146, 13, 18, 13, 4.50, 4.50, 3.50, 4, 3.50, 3.90, 'ergt dfg fdgfg fg', '2017-01-29 07:54:29', 0),
(88, 144, 9, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'satu did a great job.I will him in future.satu did a great job.I will him in future.satu did a great job.I will him in future.satu did a great job.I will him in future.satu did a great job.I will him in future', '2017-01-25 15:54:47', 0),
(87, 144, 9, 18, 9, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'satu did a great job.I will him in future.satu did a great job.I will him in future.satu did a great job.I will him in future.satu did a great job.I will him in future.satu did a great job.I will him in future\r\n', '2017-01-25 15:54:07', 0),
(84, 132, 13, 18, 13, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'ok', '2017-01-16 18:01:29', 0),
(85, 138, 15, 18, 15, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'ghjh', '2017-01-24 18:04:39', 0),
(86, 144, 15, 18, 15, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'fdyhg', '2017-01-24 18:07:02', 0),
(83, 133, 13, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'rtr', '2017-01-16 18:00:00', 0),
(82, 134, 9, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'rr', '2017-01-16 17:59:22', 0),
(81, 132, 9, 18, 18, 5.00, 5.00, 5.00, 5, 5.00, 5.00, 'g', '2017-01-16 17:56:23', 0),
(80, 134, 13, 18, 18, 4.50, 4.50, 4.50, 5, 5.00, 4.60, 'ok', '2017-01-15 18:09:33', 0),
(79, 132, 15, 18, 18, 4.50, 4.50, 4.50, 5, 4.50, 4.50, 'vcv', '2017-01-14 18:24:50', 0);

-- --------------------------------------------------------

--
-- Structure de la table `job_hire_end`
--

DROP TABLE IF EXISTS `job_hire_end`;
CREATE TABLE `job_hire_end` (
  `id` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `weekly_limit` int(10) NOT NULL DEFAULT '0',
  `offer_bid_amount` float(10,2) DEFAULT NULL,
  `offer_bid_fee` float(10,2) DEFAULT NULL,
  `offer_bid_earning` float(10,2) DEFAULT NULL,
  `fixed_pay_status` enum('0','1','2') DEFAULT NULL COMMENT AS `0 = paid nothing,1=padi partyl,2= paid all`,
  `weekly_amount` float(10,2) NOT NULL,
  `fixedpay_amount` float(10,2) DEFAULT '0.00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_hire_end`
--

INSERT INTO `job_hire_end` (`id`, `bid_id`, `weekly_limit`, `offer_bid_amount`, `offer_bid_fee`, `offer_bid_earning`, `fixed_pay_status`, `weekly_amount`, `fixedpay_amount`, `created`) VALUES
(11, 59, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-10-19 18:52:29'),
(10, 57, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-10-19 18:52:18'),
(9, 65, 0, NULL, NULL, NULL, '2', 0.00, 500.00, '2016-10-18 22:00:01'),
(12, 67, 0, NULL, NULL, NULL, '2', 0.00, 30.00, '2016-10-22 19:20:49'),
(13, 70, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-10-22 23:45:44'),
(14, 68, 0, NULL, NULL, NULL, '2', 0.00, 10.00, '2016-11-27 20:19:03'),
(15, 71, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-11-27 21:32:33'),
(16, 72, 0, NULL, NULL, NULL, '2', 0.00, 50.00, '2016-11-29 22:30:08'),
(17, 72, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-11-29 22:30:55'),
(18, 74, 0, NULL, NULL, NULL, '2', 0.00, 7.00, '2016-11-29 22:34:41'),
(19, 74, 0, NULL, NULL, NULL, '2', 0.00, 7.00, '2016-11-29 22:36:08'),
(20, 81, 0, NULL, NULL, NULL, '2', 0.00, 198.00, '2016-11-29 22:44:49'),
(21, 75, 0, NULL, NULL, NULL, '2', 0.00, 10.00, '2016-11-30 13:20:28'),
(22, 91, 0, NULL, NULL, NULL, '2', 0.00, 78.00, '2016-11-30 15:46:28'),
(23, 82, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-12-01 15:32:54'),
(24, 96, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-12-04 21:38:15'),
(25, 106, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2016-12-04 21:49:32'),
(26, 105, 0, NULL, NULL, NULL, '2', 0.00, 50.00, '2016-12-11 20:09:08'),
(27, 183, 0, NULL, NULL, NULL, '2', 0.00, 700.00, '2017-01-14 18:24:50'),
(28, 189, 0, NULL, NULL, NULL, '2', 0.00, 13.00, '2017-01-15 18:09:33'),
(29, 185, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2017-01-16 17:56:23'),
(30, 191, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2017-01-16 17:59:22'),
(31, 188, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2017-01-16 18:00:00'),
(32, 181, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2017-01-27 17:18:43'),
(33, 209, 0, NULL, NULL, NULL, '0', 0.00, 0.00, '2017-02-03 19:12:14');

-- --------------------------------------------------------

--
-- Structure de la table `job_skills`
--

DROP TABLE IF EXISTS `job_skills`;
CREATE TABLE `job_skills` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `skill_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_skills`
--

INSERT INTO `job_skills` (`id`, `job_id`, `skill_name`) VALUES
(1, 143, 'Java'),
(2, 143, 'HTML'),
(27, 144, 'mysql'),
(26, 144, 'PHP'),
(25, 144, 'Apache Jakarta POI'),
(31, 146, 'Product Sourcing'),
(32, 146, 'Adobe InDesign'),
(33, 146, 'PHP'),
(35, 147, 'PHP'),
(36, 148, 'PHP'),
(37, 149, 'phonegap'),
(38, 150, 'Photography'),
(39, 151, 'Product Sourcing'),
(40, 152, 'Adobe InDesign'),
(41, 152, 'Virtual Assistant'),
(42, 152, 'Website Design'),
(43, 153, 'PHP'),
(44, 154, 'phonegap'),
(45, 155, 'Photography'),
(47, 156, 'Java'),
(48, 156, 'Object Oriented PHP'),
(49, 157, 'PHP'),
(50, 160, 'PHP'),
(51, 161, 'PHP'),
(52, 162, 'PHP'),
(53, 164, 'PHP'),
(54, 165, 'PHP'),
(55, 166, 'Typography'),
(56, 167, 'Technical Writing'),
(57, 168, 'Twitter'),
(58, 169, 'Twitter'),
(59, 170, 'Telemarketing'),
(60, 171, 'Twitter'),
(61, 172, 'Technical Writing'),
(62, 173, 'Twitter'),
(63, 174, 'Telemarketing Exp'),
(64, 175, 'Translation'),
(65, 176, 'Brochure Design'),
(66, 177, 'Lead Generation'),
(67, 178, 'PHP'),
(68, 179, 'phonegap');

-- --------------------------------------------------------

--
-- Structure de la table `job_subcategories`
--

DROP TABLE IF EXISTS `job_subcategories`;
CREATE TABLE `job_subcategories` (
  `subcat_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `subcategory_name` varchar(100) DEFAULT NULL,
  `url_rewrite` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_subcategories`
--

INSERT INTO `job_subcategories` (`subcat_id`, `cat_id`, `subcategory_name`, `url_rewrite`, `date_created`) VALUES
(1, 1, 'Desktop Software Development', 'desktop-software-development', '2016-08-16 22:02:31'),
(2, 1, 'Ecommerce Development', 'ecommerce-development', '2016-08-16 22:02:31'),
(3, 1, 'Game Development', 'game-development', '2016-08-16 22:02:31'),
(4, 1, 'Mobile Development', 'mobile-development', '2016-08-16 22:02:31'),
(5, 1, 'Product Management', 'product-management', '2016-08-16 22:02:31'),
(6, 1, 'QA & Testing', 'qa-and-testing', '2016-08-16 22:02:31'),
(7, 1, 'Scripts & Utilities', 'scripts-and-utilities', '2016-08-16 22:02:31'),
(8, 1, 'Web Development', 'web-development', '2016-08-16 22:02:31'),
(9, 1, 'Web & Mobile Design', 'web-and-mobile-design', '2016-08-16 22:02:31'),
(10, 1, 'Other - Software Development', 'other-software-development', '2016-08-16 22:02:31'),
(11, 2, 'Database Administration', 'database-administration', '2016-08-16 22:02:31'),
(12, 2, 'ERP / CRM Software', 'erp/crm-software', '2016-08-16 22:02:31'),
(13, 2, 'Information Security', 'information-security', '2016-08-16 22:02:31'),
(14, 2, 'Network & System Administration', 'network-and-system-administration', '2016-08-16 22:02:31'),
(15, 2, 'Other - IT & Networking', 'other-it-and-networking', '2016-08-16 22:02:31'),
(16, 3, 'A/B Testing', 'a/b-testing', '2016-08-16 22:02:31'),
(17, 3, 'Data Visualization', 'data-visualization', '2016-08-16 22:02:31'),
(18, 3, 'Data Extraction / ETL', 'data-extraction/etl', '2016-08-16 22:02:31'),
(19, 3, 'Data Mining & Management', 'data-mining-and-management', '2016-08-16 22:02:31'),
(20, 3, 'Machine Learning', 'machine-learning', '2016-08-16 22:02:31'),
(21, 3, 'Quantitative Analysis', 'quantitative-analysis', '2016-08-16 22:02:31'),
(22, 3, 'Other - Data Science & Analytics', 'other-data-science-and-analytics', '2016-08-16 22:02:31'),
(23, 4, '3D Modeling & CAD', '3d-modeling-and-cad', '2016-08-16 22:02:31'),
(24, 4, 'Architecture', 'architecture', '2016-08-16 22:02:31'),
(25, 4, 'Chemical Engineering', 'chemical-engineering', '2016-08-16 22:02:31'),
(26, 4, 'Civil & Structural Engineering', 'civil-and-structural-engineering', '2016-08-16 22:02:31'),
(27, 4, 'Contract Manufacturing', 'contract-manufacturing', '2016-08-16 22:02:31'),
(28, 4, 'Electrical Engineering', 'electrical-engineering', '2016-08-16 22:02:31'),
(29, 4, 'Interior Design', 'interior-design', '2016-08-16 22:02:31'),
(30, 4, 'Mechanical Engineering', 'mechanical-engineering', '2016-08-16 22:02:31'),
(31, 4, 'Product Design', 'product-design', '2016-08-16 22:02:31'),
(32, 4, 'Other - Engineering & Architecture', 'other-engineering-and-architecture', '2016-08-16 22:02:31'),
(33, 5, 'Animation', 'animation', '2016-08-16 22:02:31'),
(34, 5, 'Audio Production', 'audio-production', '2016-08-16 22:02:31'),
(35, 5, 'Graphic Design', 'graphic-design', '2016-08-16 22:02:31'),
(36, 5, 'Illustration', 'illustration', '2016-08-16 22:02:31'),
(37, 5, 'Logo Design & Branding', 'logo-design-and-branding', '2016-08-16 22:02:31'),
(38, 5, 'Photography', 'photography', '2016-08-16 22:02:31'),
(39, 5, 'Presentations', 'presentations', '2016-08-16 22:02:31'),
(40, 5, 'Video Production', 'video-production', '2016-08-16 22:02:31'),
(41, 5, 'Voice Talent', 'voice-talent', '2016-08-16 22:02:31'),
(42, 5, 'Other - Design & Creative', 'other-design-and-creative', '2016-08-16 22:02:31'),
(43, 6, 'Academic Writing & Research', 'academic-writing-and-research', '2016-08-16 22:02:31'),
(44, 6, 'Article & Blog Writing', 'article-and-blog-writing', '2016-08-16 22:02:31'),
(45, 6, 'Copywriting', 'copywriting', '2016-08-16 22:02:31'),
(46, 6, 'Creative Writing', 'creative-writing', '2016-08-16 22:02:31'),
(47, 6, 'Editing & Proofreading', 'editing-and-proofreading', '2016-08-16 22:02:31'),
(48, 6, 'Grant Writing', 'grant-writing', '2016-08-16 22:02:31'),
(49, 6, 'Resumes & Cover Letters', 'resumes-and-cover-letters', '2016-08-16 22:02:31'),
(50, 6, 'Technical Writing', 'technical-writing', '2016-08-16 22:02:31'),
(51, 6, 'Web Content', 'web-content', '2016-08-16 22:02:31'),
(52, 6, 'Web Content', 'web-content', '2016-08-16 22:02:31'),
(53, 7, 'General Translation', 'general-translation', '2016-08-16 22:02:31'),
(54, 7, 'Legal Translation', 'legal-translation', '2016-08-16 22:02:31'),
(55, 7, 'Medical Translation', 'medical-translation', '2016-08-16 22:02:31'),
(56, 7, 'Technical Translation', 'technical-translation', '2016-08-16 22:02:31'),
(57, 8, 'Contract Law', 'contract-law', '2016-08-16 22:02:31'),
(58, 8, 'Corporate Law', 'corporate-law', '2016-08-16 22:02:31'),
(59, 8, 'Criminal Law', 'criminal-law', '2016-08-16 22:02:31'),
(60, 8, 'Family Law', 'family-law', '2016-08-16 22:02:31'),
(61, 8, 'Intellectual Property Law', 'intellectual-property-law', '2016-08-16 22:02:31'),
(62, 8, 'Paralegal Services', 'paralegal-services', '2016-08-16 22:02:31'),
(63, 8, 'Other - Legal', 'other-legal', '2016-08-16 22:02:31'),
(64, 9, 'Data Entry', 'data-entry', '2016-08-16 22:02:31'),
(65, 9, 'Personal / Virtual Assistant', 'personal/virtual-assistant', '2016-08-16 22:02:31'),
(66, 9, 'Project Management', 'project-management', '2016-08-16 22:02:31'),
(67, 9, 'Transcription', 'transcription', '2016-08-16 22:02:31'),
(68, 9, 'Web Research', 'web-research', '2016-08-16 22:02:31'),
(69, 9, 'Other - Admin Support', 'other-admin-support', '2016-08-16 22:02:31'),
(70, 10, 'Customer Service', 'customer-service', '2016-08-16 22:02:31'),
(71, 10, 'Technical Support', 'technical-support', '2016-08-16 22:02:31'),
(72, 10, 'Other - Customer Service', 'other-customer-service', '2016-08-16 22:02:31'),
(73, 11, 'Display Advertising', 'display-advertising', '2016-08-16 22:02:31'),
(74, 11, 'Email & Marketing Automation', 'email-and-marketing-automation', '2016-08-16 22:02:31'),
(75, 11, 'Lead Generation', 'lead-generation', '2016-08-16 22:02:31'),
(76, 11, 'Market & Customer Research', 'market-and-customer-research', '2016-08-16 22:02:31'),
(77, 11, 'Marketing Strategy', 'marketing-strategy', '2016-08-16 22:02:31'),
(78, 11, 'Public Relations', 'public-relations', '2016-08-16 22:02:31'),
(79, 11, 'SEM - Search Engine Marketing', 'sem-search-engine-marketing', '2016-08-16 22:02:31'),
(80, 11, 'SEO - Search Engine Optimization', 'seo-search-engine-optimization', '2016-08-16 22:02:31'),
(81, 11, 'SMM - Social Media Marketing', 'smm-social-media-marketing', '2016-08-16 22:02:31'),
(82, 11, 'Telemarketing & Telesales', 'telemarketing-and-telesales', '2016-08-16 22:02:31'),
(83, 11, 'Other - Sales & Marketing', 'other-sales-and-marketing', '2016-08-16 22:02:31'),
(84, 12, 'Accounting', 'accounting', '2016-08-16 22:02:31'),
(85, 12, 'Financial Planning', 'financial-planning', '2016-08-16 22:02:31'),
(86, 12, 'Human Resources', 'human-resources', '2016-08-16 22:02:31'),
(87, 12, 'Management Consulting', 'management-consulting', '2016-08-16 22:02:31'),
(88, 12, 'Other - Accounting & Consulting', 'other-accounting-and-consulting', '2016-08-16 22:02:31');

-- --------------------------------------------------------

--
-- Structure de la table `job_workdairy`
--

DROP TABLE IF EXISTS `job_workdairy`;
CREATE TABLE `job_workdairy` (
  `workdairy_id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `cuser_id` int(11) NOT NULL,
  `fuser_id` int(11) NOT NULL,
  `starting_hour` text NOT NULL,
  `ending_hour` text NOT NULL,
  `total_hour` text NOT NULL,
  `working_date` date DEFAULT NULL,
  `end_work` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `job_workdairy`
--

INSERT INTO `job_workdairy` (`workdairy_id`, `jobid`, `bid_id`, `cuser_id`, `fuser_id`, `starting_hour`, `ending_hour`, `total_hour`, `working_date`, `end_work`) VALUES
(62, 149, 210, 18, 13, '2017-02-05 17:00:12', '2017-02-05 18:00:15', '1', '2017-02-05', '2017-02-06 01:00:15'),
(63, 147, 207, 18, 13, '2017-02-06 13:00:03', '2017-02-06 18:00:10', '5', '2017-02-06', '2017-02-07 01:00:10'),
(64, 149, 210, 18, 13, '2017-02-21 18:00:20', '2017-02-21 23:00:23', '5', '2017-02-21', '2017-02-22 06:00:23'),
(65, 147, 207, 18, 13, '2017-03-01 18:00:08', '2017-03-01 19:00:10', '1', '2017-03-01', '2017-03-01 19:00:10');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL,
  `link` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `read_status` int(2) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `link`, `description`, `read_status`, `user_id`, `date`) VALUES
(1, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:55:57'),
(2, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:56:12'),
(3, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:56:02'),
(4, '#', '', 0, 0, '2016-11-30 20:34:14'),
(5, '#', '', 0, 0, '2016-11-30 20:36:02'),
(6, '#', '', 0, 0, '2016-11-30 20:36:20'),
(7, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:56:09'),
(8, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:55:45'),
(9, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:56:00'),
(10, '#', 'You have one job invitation', 1, 13, '2016-11-30 20:56:06'),
(11, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-11-30 21:04:27'),
(12, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-11-30 21:04:41'),
(13, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-11-30 23:00:26'),
(14, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-11-30 23:01:07'),
(15, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-11-30 23:00:30'),
(16, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-11-30 23:05:58'),
(17, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 15, '2016-12-28 15:16:39'),
(18, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 9, '2016-12-01 15:27:39'),
(19, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-06 19:26:32'),
(20, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:22:59'),
(21, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:22:45'),
(22, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:23:03'),
(23, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:22:52'),
(24, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:23:06'),
(25, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:22:56'),
(26, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-01 13:22:49'),
(27, 'http://www.winjob.com/active_interview', 'You have one job invitation', 1, 13, '2016-12-08 17:13:09');

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buser_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `hire_end_id` int(11) NOT NULL DEFAULT '0',
  `txn_id` varchar(255) NOT NULL,
  `payment_condition` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=payment,0=withdawl',
  `processfees` int(11) DEFAULT '0',
  `payment_gross` float(10,2) NOT NULL,
  `des` text NOT NULL,
  `currency_code` varchar(5) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `payment_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `buser_id`, `job_id`, `bid_id`, `hire_end_id`, `txn_id`, `payment_condition`, `processfees`, `payment_gross`, `des`, `currency_code`, `payer_email`, `payment_create`) VALUES
(235, 13, 18, 153, 0, 0, '', '1', 0, 600.00, 'Full Paid', '', '', '2017-02-17 11:34:51'),
(236, 13, 18, 153, 0, 0, '', '1', 0, 600.00, 'Full Paid', '', '', '2017-02-17 11:34:56'),
(237, 13, 18, 154, 0, 0, '', '1', 0, 4555.00, 'Full Paid', '', '', '2017-02-18 18:17:10'),
(238, 13, 18, 153, 0, 0, '', '1', 0, 10.00, 'Milestone', '', '', '2017-02-27 10:18:10'),
(239, 13, 18, 153, 0, 0, '', '1', 0, 5.00, 'Payment', '', '', '2017-03-01 14:39:24'),
(232, 13, 18, 153, 0, 0, '', '1', 0, 600.00, 'Full Paid', '', '', '2017-02-17 11:34:35'),
(233, 13, 18, 153, 0, 0, '', '1', 0, 600.00, 'Full Paid', '', '', '2017-02-17 11:34:41'),
(234, 9, 18, 153, 0, 0, '', '1', 0, 61.00, 'Full Paid', '', '', '2017-02-17 11:34:46'),
(231, 13, 18, 153, 0, 0, '', '1', 0, 600.00, 'Full Paid', '', '', '2017-02-17 11:34:29'),
(229, 13, 18, 150, 0, 0, '', '1', 0, 300.00, 'Full Paid', '', '', '2017-02-03 18:56:03'),
(230, 13, 18, 150, 0, 0, '', '1', 0, 19.00, 'Milestone', '', '', '2017-02-03 19:44:02'),
(228, 13, 18, 148, 0, 0, '', '1', 0, 100.00, 'Milestone', '', '', '2017-02-03 18:50:08');

-- --------------------------------------------------------

--
-- Structure de la table `paypal_object`
--

DROP TABLE IF EXISTS `paypal_object`;
CREATE TABLE `paypal_object` (
  `sr` double NOT NULL,
  `pp_fname` varchar(255) COLLATE utf8_bin NOT NULL,
  `pp_lname` varchar(255) COLLATE utf8_bin NOT NULL,
  `pp_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `agreement_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `agreement_state` varchar(255) COLLATE utf8_bin NOT NULL,
  `payer_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `belongsTo` double NOT NULL,
  `dateadded` double NOT NULL,
  `completeObject` longtext COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `paypal_object`
--

INSERT INTO `paypal_object` (`sr`, `pp_fname`, `pp_lname`, `pp_email`, `agreement_id`, `agreement_state`, `payer_id`, `belongsTo`, `dateadded`, `completeObject`) VALUES
(40, 'test', 'buyer', 'buyer.test@haseeburrehman.com', 'B-230623087V2154031', '1', 'B3LWEJAZ5TJ9N', 18, 1479148431, 'a:46:{s:5:"TOKEN";s:20:"EC-1FV573579P9576916";s:30:"BILLINGAGREEMENTACCEPTEDSTATUS";s:1:"1";s:14:"CHECKOUTSTATUS";s:25:"PaymentActionNotInitiated";s:9:"TIMESTAMP";s:20:"2016-11-14T18:33:51Z";s:13:"CORRELATIONID";s:13:"bea7fbd8de564";s:3:"ACK";s:7:"Success";s:7:"VERSION";s:2:"86";s:5:"BUILD";s:8:"26966875";s:5:"EMAIL";s:29:"buyer.test@haseeburrehman.com";s:7:"PAYERID";s:13:"B3LWEJAZ5TJ9N";s:11:"PAYERSTATUS";s:8:"verified";s:9:"FIRSTNAME";s:4:"test";s:8:"LASTNAME";s:5:"buyer";s:11:"COUNTRYCODE";s:2:"US";s:10:"SHIPTONAME";s:10:"test buyer";s:12:"SHIPTOSTREET";s:9:"1 Main St";s:10:"SHIPTOCITY";s:8:"San Jose";s:11:"SHIPTOSTATE";s:2:"CA";s:9:"SHIPTOZIP";s:5:"95131";s:17:"SHIPTOCOUNTRYCODE";s:2:"US";s:17:"SHIPTOCOUNTRYNAME";s:13:"United States";s:13:"ADDRESSSTATUS";s:9:"Confirmed";s:12:"CURRENCYCODE";s:3:"USD";s:3:"AMT";s:4:"0.00";s:11:"SHIPPINGAMT";s:4:"0.00";s:11:"HANDLINGAMT";s:4:"0.00";s:6:"TAXAMT";s:4:"0.00";s:12:"INSURANCEAMT";s:4:"0.00";s:11:"SHIPDISCAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_CURRENCYCODE";s:3:"USD";s:20:"PAYMENTREQUEST_0_AMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPPINGAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_HANDLINGAMT";s:4:"0.00";s:23:"PAYMENTREQUEST_0_TAXAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_INSURANCEAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPDISCAMT";s:4:"0.00";s:39:"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED";s:5:"false";s:27:"PAYMENTREQUEST_0_SHIPTONAME";s:10:"test buyer";s:29:"PAYMENTREQUEST_0_SHIPTOSTREET";s:9:"1 Main St";s:27:"PAYMENTREQUEST_0_SHIPTOCITY";s:8:"San Jose";s:28:"PAYMENTREQUEST_0_SHIPTOSTATE";s:2:"CA";s:26:"PAYMENTREQUEST_0_SHIPTOZIP";s:5:"95131";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE";s:2:"US";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME";s:13:"United States";s:30:"PAYMENTREQUEST_0_ADDRESSSTATUS";s:9:"Confirmed";s:30:"PAYMENTREQUESTINFO_0_ERRORCODE";s:1:"0";}'),
(41, 'test', 'buyer', 'buyer.test@haseeburrehman.com', 'B-5AS93360SE9333008', '1', 'B3LWEJAZ5TJ9N', 18, 1479148662, 'a:46:{s:5:"TOKEN";s:20:"EC-7S126490AJ764335P";s:30:"BILLINGAGREEMENTACCEPTEDSTATUS";s:1:"1";s:14:"CHECKOUTSTATUS";s:25:"PaymentActionNotInitiated";s:9:"TIMESTAMP";s:20:"2016-11-14T18:37:42Z";s:13:"CORRELATIONID";s:13:"3f89beac26e24";s:3:"ACK";s:7:"Success";s:7:"VERSION";s:2:"86";s:5:"BUILD";s:8:"26966875";s:5:"EMAIL";s:29:"buyer.test@haseeburrehman.com";s:7:"PAYERID";s:13:"B3LWEJAZ5TJ9N";s:11:"PAYERSTATUS";s:8:"verified";s:9:"FIRSTNAME";s:4:"test";s:8:"LASTNAME";s:5:"buyer";s:11:"COUNTRYCODE";s:2:"US";s:10:"SHIPTONAME";s:10:"test buyer";s:12:"SHIPTOSTREET";s:9:"1 Main St";s:10:"SHIPTOCITY";s:8:"San Jose";s:11:"SHIPTOSTATE";s:2:"CA";s:9:"SHIPTOZIP";s:5:"95131";s:17:"SHIPTOCOUNTRYCODE";s:2:"US";s:17:"SHIPTOCOUNTRYNAME";s:13:"United States";s:13:"ADDRESSSTATUS";s:9:"Confirmed";s:12:"CURRENCYCODE";s:3:"USD";s:3:"AMT";s:4:"0.00";s:11:"SHIPPINGAMT";s:4:"0.00";s:11:"HANDLINGAMT";s:4:"0.00";s:6:"TAXAMT";s:4:"0.00";s:12:"INSURANCEAMT";s:4:"0.00";s:11:"SHIPDISCAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_CURRENCYCODE";s:3:"USD";s:20:"PAYMENTREQUEST_0_AMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPPINGAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_HANDLINGAMT";s:4:"0.00";s:23:"PAYMENTREQUEST_0_TAXAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_INSURANCEAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPDISCAMT";s:4:"0.00";s:39:"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED";s:5:"false";s:27:"PAYMENTREQUEST_0_SHIPTONAME";s:10:"test buyer";s:29:"PAYMENTREQUEST_0_SHIPTOSTREET";s:9:"1 Main St";s:27:"PAYMENTREQUEST_0_SHIPTOCITY";s:8:"San Jose";s:28:"PAYMENTREQUEST_0_SHIPTOSTATE";s:2:"CA";s:26:"PAYMENTREQUEST_0_SHIPTOZIP";s:5:"95131";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE";s:2:"US";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME";s:13:"United States";s:30:"PAYMENTREQUEST_0_ADDRESSSTATUS";s:9:"Confirmed";s:30:"PAYMENTREQUESTINFO_0_ERRORCODE";s:1:"0";}'),
(39, 'test', 'buyer', 'buyer.test@haseeburrehman.com', 'B-81L42860JF6639148', '1', 'B3LWEJAZ5TJ9N', 29, 1479144568, 'a:46:{s:5:"TOKEN";s:20:"EC-6AS10564L10001258";s:30:"BILLINGAGREEMENTACCEPTEDSTATUS";s:1:"1";s:14:"CHECKOUTSTATUS";s:25:"PaymentActionNotInitiated";s:9:"TIMESTAMP";s:20:"2016-11-14T17:29:28Z";s:13:"CORRELATIONID";s:13:"381b94821af9a";s:3:"ACK";s:7:"Success";s:7:"VERSION";s:2:"86";s:5:"BUILD";s:8:"26966875";s:5:"EMAIL";s:29:"buyer.test@haseeburrehman.com";s:7:"PAYERID";s:13:"B3LWEJAZ5TJ9N";s:11:"PAYERSTATUS";s:8:"verified";s:9:"FIRSTNAME";s:4:"test";s:8:"LASTNAME";s:5:"buyer";s:11:"COUNTRYCODE";s:2:"US";s:10:"SHIPTONAME";s:10:"test buyer";s:12:"SHIPTOSTREET";s:9:"1 Main St";s:10:"SHIPTOCITY";s:8:"San Jose";s:11:"SHIPTOSTATE";s:2:"CA";s:9:"SHIPTOZIP";s:5:"95131";s:17:"SHIPTOCOUNTRYCODE";s:2:"US";s:17:"SHIPTOCOUNTRYNAME";s:13:"United States";s:13:"ADDRESSSTATUS";s:9:"Confirmed";s:12:"CURRENCYCODE";s:3:"USD";s:3:"AMT";s:4:"0.00";s:11:"SHIPPINGAMT";s:4:"0.00";s:11:"HANDLINGAMT";s:4:"0.00";s:6:"TAXAMT";s:4:"0.00";s:12:"INSURANCEAMT";s:4:"0.00";s:11:"SHIPDISCAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_CURRENCYCODE";s:3:"USD";s:20:"PAYMENTREQUEST_0_AMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPPINGAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_HANDLINGAMT";s:4:"0.00";s:23:"PAYMENTREQUEST_0_TAXAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_INSURANCEAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPDISCAMT";s:4:"0.00";s:39:"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED";s:5:"false";s:27:"PAYMENTREQUEST_0_SHIPTONAME";s:10:"test buyer";s:29:"PAYMENTREQUEST_0_SHIPTOSTREET";s:9:"1 Main St";s:27:"PAYMENTREQUEST_0_SHIPTOCITY";s:8:"San Jose";s:28:"PAYMENTREQUEST_0_SHIPTOSTATE";s:2:"CA";s:26:"PAYMENTREQUEST_0_SHIPTOZIP";s:5:"95131";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE";s:2:"US";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME";s:13:"United States";s:30:"PAYMENTREQUEST_0_ADDRESSSTATUS";s:9:"Confirmed";s:30:"PAYMENTREQUESTINFO_0_ERRORCODE";s:1:"0";}'),
(36, 'test', 'buyer', 'buyer.test@haseeburrehman.com', 'B-8C7392409X743173D', '1', 'B3LWEJAZ5TJ9N', 18, 1479138922, 'a:46:{s:5:"TOKEN";s:20:"EC-4F5015012D549994U";s:30:"BILLINGAGREEMENTACCEPTEDSTATUS";s:1:"1";s:14:"CHECKOUTSTATUS";s:25:"PaymentActionNotInitiated";s:9:"TIMESTAMP";s:20:"2016-11-14T15:55:22Z";s:13:"CORRELATIONID";s:13:"c396f1d7e4250";s:3:"ACK";s:7:"Success";s:7:"VERSION";s:2:"86";s:5:"BUILD";s:8:"26966875";s:5:"EMAIL";s:29:"buyer.test@haseeburrehman.com";s:7:"PAYERID";s:13:"B3LWEJAZ5TJ9N";s:11:"PAYERSTATUS";s:8:"verified";s:9:"FIRSTNAME";s:4:"test";s:8:"LASTNAME";s:5:"buyer";s:11:"COUNTRYCODE";s:2:"US";s:10:"SHIPTONAME";s:10:"test buyer";s:12:"SHIPTOSTREET";s:9:"1 Main St";s:10:"SHIPTOCITY";s:8:"San Jose";s:11:"SHIPTOSTATE";s:2:"CA";s:9:"SHIPTOZIP";s:5:"95131";s:17:"SHIPTOCOUNTRYCODE";s:2:"US";s:17:"SHIPTOCOUNTRYNAME";s:13:"United States";s:13:"ADDRESSSTATUS";s:9:"Confirmed";s:12:"CURRENCYCODE";s:3:"USD";s:3:"AMT";s:4:"0.00";s:11:"SHIPPINGAMT";s:4:"0.00";s:11:"HANDLINGAMT";s:4:"0.00";s:6:"TAXAMT";s:4:"0.00";s:12:"INSURANCEAMT";s:4:"0.00";s:11:"SHIPDISCAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_CURRENCYCODE";s:3:"USD";s:20:"PAYMENTREQUEST_0_AMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPPINGAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_HANDLINGAMT";s:4:"0.00";s:23:"PAYMENTREQUEST_0_TAXAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_INSURANCEAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPDISCAMT";s:4:"0.00";s:39:"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED";s:5:"false";s:27:"PAYMENTREQUEST_0_SHIPTONAME";s:10:"test buyer";s:29:"PAYMENTREQUEST_0_SHIPTOSTREET";s:9:"1 Main St";s:27:"PAYMENTREQUEST_0_SHIPTOCITY";s:8:"San Jose";s:28:"PAYMENTREQUEST_0_SHIPTOSTATE";s:2:"CA";s:26:"PAYMENTREQUEST_0_SHIPTOZIP";s:5:"95131";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE";s:2:"US";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME";s:13:"United States";s:30:"PAYMENTREQUEST_0_ADDRESSSTATUS";s:9:"Confirmed";s:30:"PAYMENTREQUESTINFO_0_ERRORCODE";s:1:"0";}'),
(37, 'test', 'buyer', 'buyer.test@haseeburrehman.com', 'B-5B993055KF4095402', '1', 'B3LWEJAZ5TJ9N', 18, 1479141536, 'a:46:{s:5:"TOKEN";s:20:"EC-44M35648ME3663207";s:30:"BILLINGAGREEMENTACCEPTEDSTATUS";s:1:"1";s:14:"CHECKOUTSTATUS";s:25:"PaymentActionNotInitiated";s:9:"TIMESTAMP";s:20:"2016-11-14T16:38:56Z";s:13:"CORRELATIONID";s:13:"8e92ab221cfac";s:3:"ACK";s:7:"Success";s:7:"VERSION";s:2:"86";s:5:"BUILD";s:8:"26966875";s:5:"EMAIL";s:29:"buyer.test@haseeburrehman.com";s:7:"PAYERID";s:13:"B3LWEJAZ5TJ9N";s:11:"PAYERSTATUS";s:8:"verified";s:9:"FIRSTNAME";s:4:"test";s:8:"LASTNAME";s:5:"buyer";s:11:"COUNTRYCODE";s:2:"US";s:10:"SHIPTONAME";s:10:"test buyer";s:12:"SHIPTOSTREET";s:9:"1 Main St";s:10:"SHIPTOCITY";s:8:"San Jose";s:11:"SHIPTOSTATE";s:2:"CA";s:9:"SHIPTOZIP";s:5:"95131";s:17:"SHIPTOCOUNTRYCODE";s:2:"US";s:17:"SHIPTOCOUNTRYNAME";s:13:"United States";s:13:"ADDRESSSTATUS";s:9:"Confirmed";s:12:"CURRENCYCODE";s:3:"USD";s:3:"AMT";s:4:"0.00";s:11:"SHIPPINGAMT";s:4:"0.00";s:11:"HANDLINGAMT";s:4:"0.00";s:6:"TAXAMT";s:4:"0.00";s:12:"INSURANCEAMT";s:4:"0.00";s:11:"SHIPDISCAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_CURRENCYCODE";s:3:"USD";s:20:"PAYMENTREQUEST_0_AMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPPINGAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_HANDLINGAMT";s:4:"0.00";s:23:"PAYMENTREQUEST_0_TAXAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_INSURANCEAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPDISCAMT";s:4:"0.00";s:39:"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED";s:5:"false";s:27:"PAYMENTREQUEST_0_SHIPTONAME";s:10:"test buyer";s:29:"PAYMENTREQUEST_0_SHIPTOSTREET";s:9:"1 Main St";s:27:"PAYMENTREQUEST_0_SHIPTOCITY";s:8:"San Jose";s:28:"PAYMENTREQUEST_0_SHIPTOSTATE";s:2:"CA";s:26:"PAYMENTREQUEST_0_SHIPTOZIP";s:5:"95131";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE";s:2:"US";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME";s:13:"United States";s:30:"PAYMENTREQUEST_0_ADDRESSSTATUS";s:9:"Confirmed";s:30:"PAYMENTREQUESTINFO_0_ERRORCODE";s:1:"0";}'),
(38, 'test', 'buyer', 'buyer.test@haseeburrehman.com', 'B-6J5657438N068633W', '1', 'B3LWEJAZ5TJ9N', 18, 1479141645, 'a:46:{s:5:"TOKEN";s:20:"EC-3PE843797K883811J";s:30:"BILLINGAGREEMENTACCEPTEDSTATUS";s:1:"1";s:14:"CHECKOUTSTATUS";s:25:"PaymentActionNotInitiated";s:9:"TIMESTAMP";s:20:"2016-11-14T16:40:45Z";s:13:"CORRELATIONID";s:13:"81ccadddeb789";s:3:"ACK";s:7:"Success";s:7:"VERSION";s:2:"86";s:5:"BUILD";s:8:"26966875";s:5:"EMAIL";s:29:"buyer.test@haseeburrehman.com";s:7:"PAYERID";s:13:"B3LWEJAZ5TJ9N";s:11:"PAYERSTATUS";s:8:"verified";s:9:"FIRSTNAME";s:4:"test";s:8:"LASTNAME";s:5:"buyer";s:11:"COUNTRYCODE";s:2:"US";s:10:"SHIPTONAME";s:10:"test buyer";s:12:"SHIPTOSTREET";s:9:"1 Main St";s:10:"SHIPTOCITY";s:8:"San Jose";s:11:"SHIPTOSTATE";s:2:"CA";s:9:"SHIPTOZIP";s:5:"95131";s:17:"SHIPTOCOUNTRYCODE";s:2:"US";s:17:"SHIPTOCOUNTRYNAME";s:13:"United States";s:13:"ADDRESSSTATUS";s:9:"Confirmed";s:12:"CURRENCYCODE";s:3:"USD";s:3:"AMT";s:4:"0.00";s:11:"SHIPPINGAMT";s:4:"0.00";s:11:"HANDLINGAMT";s:4:"0.00";s:6:"TAXAMT";s:4:"0.00";s:12:"INSURANCEAMT";s:4:"0.00";s:11:"SHIPDISCAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_CURRENCYCODE";s:3:"USD";s:20:"PAYMENTREQUEST_0_AMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPPINGAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_HANDLINGAMT";s:4:"0.00";s:23:"PAYMENTREQUEST_0_TAXAMT";s:4:"0.00";s:29:"PAYMENTREQUEST_0_INSURANCEAMT";s:4:"0.00";s:28:"PAYMENTREQUEST_0_SHIPDISCAMT";s:4:"0.00";s:39:"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED";s:5:"false";s:27:"PAYMENTREQUEST_0_SHIPTONAME";s:10:"test buyer";s:29:"PAYMENTREQUEST_0_SHIPTOSTREET";s:9:"1 Main St";s:27:"PAYMENTREQUEST_0_SHIPTOCITY";s:8:"San Jose";s:28:"PAYMENTREQUEST_0_SHIPTOSTATE";s:2:"CA";s:26:"PAYMENTREQUEST_0_SHIPTOZIP";s:5:"95131";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE";s:2:"US";s:34:"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME";s:13:"United States";s:30:"PAYMENTREQUEST_0_ADDRESSSTATUS";s:9:"Confirmed";s:30:"PAYMENTREQUESTINFO_0_ERRORCODE";s:1:"0";}');

-- --------------------------------------------------------

--
-- Structure de la table `paypal_pakey`
--

DROP TABLE IF EXISTS `paypal_pakey`;
CREATE TABLE `paypal_pakey` (
  `sr` double NOT NULL,
  `PA_key` varchar(255) NOT NULL,
  `belongsTo` double NOT NULL,
  `dateadded` double NOT NULL,
  `isActive` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `paypal_pakey`
--

INSERT INTO `paypal_pakey` (`sr`, `PA_key`, `belongsTo`, `dateadded`, `isActive`) VALUES
(1, 'PA-9AG24100N4705281W', 18, 0, 0),
(2, 'PA-7MH814029C4529254', 18, 1478956980, 1),
(3, 'PA-9BW363416M7605124', 18, 1478960520, 0),
(4, 'PA-9TP75252HR149563G', 18, 1478963231, 1),
(5, 'PA-7UE77539GP508924F', 18, 1478964479, 1),
(6, 'PA-15W045317E8400708', 18, 1478972380, 1),
(7, 'PA-74C305005N456842J', 18, 1478973381, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paypal_pa_object`
--

DROP TABLE IF EXISTS `paypal_pa_object`;
CREATE TABLE `paypal_pa_object` (
  `sr` double NOT NULL,
  `completeObject` longtext COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `paypal_accID` varchar(255) COLLATE utf8_bin NOT NULL,
  `dateadded` double NOT NULL,
  `belongsTo` double NOT NULL,
  `PA_key` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `paypal_pa_object`
--

INSERT INTO `paypal_pa_object` (`sr`, `completeObject`, `email`, `paypal_accID`, `dateadded`, `belongsTo`, `PA_key`) VALUES
(1, '', 'buyer.test@haseeburrehman.com', 'B3LWEJAZ5TJ9N', 1478963704, 18, ''),
(2, 'O:42:"PayPal\\Types\\AP\\PreapprovalDetailsResponse":29:{s:16:"responseEnvelope";O:36:"PayPal\\Types\\Common\\ResponseEnvelope":4:{s:9:"timestamp";s:29:"2016-11-12T07:18:57.701-08:00";s:3:"ack";s:7:"Success";s:13:"correlationId";s:13:"bf95e4dc8fa10";s:5:"build";s:8:"26820131";}s:8:"approved";s:4:"true";s:9:"cancelUrl";s:62:"http://www.winjob.com/pay/addPP/ExecuteAgreement?success=false";s:11:"curPayments";s:1:"0";s:17:"curPaymentsAmount";s:4:"0.00";s:17:"curPeriodAttempts";s:1:"0";s:19:"curPeriodEndingDate";N;s:12:"currencyCode";s:3:"USD";s:11:"dateOfMonth";s:1:"0";s:9:"dayOfWeek";s:16:"NO_DAY_SPECIFIED";s:10:"endingDate";N;s:19:"maxAmountPerPayment";N;s:19:"maxNumberOfPayments";N;s:28:"maxNumberOfPaymentsPerPeriod";N;s:27:"maxTotalAmountOfAllPayments";N;s:13:"paymentPeriod";s:19:"NO_PERIOD_SPECIFIED";s:7:"pinType";s:12:"NOT_REQUIRED";s:9:"returnUrl";s:61:"http://www.winjob.com/pay/addPP/ExecuteAgreement?success=true";s:11:"senderEmail";s:29:"buyer.test@haseeburrehman.com";s:4:"memo";N;s:12:"startingDate";s:24:"2016-11-12T13:22:59.000Z";s:6:"status";s:6:"ACTIVE";s:18:"ipnNotificationUrl";N;s:11:"addressList";N;s:9:"feesPayer";N;s:21:"displayMaxTotalAmount";s:5:"false";s:6:"sender";O:32:"PayPal\\Types\\AP\\SenderIdentifier":5:{s:14:"useCredentials";N;s:12:"taxIdDetails";N;s:5:"email";N;s:5:"phone";N;s:9:"accountId";s:13:"B3LWEJAZ5TJ9N";}s:13:"agreementType";N;s:5:"error";N;}', 'buyer.test@haseeburrehman.com', 'B3LWEJAZ5TJ9N', 1478963937, 18, ''),
(3, 'O:42:"PayPal\\Types\\AP\\PreapprovalDetailsResponse":29:{s:16:"responseEnvelope";O:36:"PayPal\\Types\\Common\\ResponseEnvelope":4:{s:9:"timestamp";s:29:"2016-11-12T07:28:19.752-08:00";s:3:"ack";s:7:"Success";s:13:"correlationId";s:13:"3d05b7859c7d9";s:5:"build";s:8:"26820131";}s:8:"approved";s:4:"true";s:9:"cancelUrl";s:62:"http://www.winjob.com/pay/addPP/ExecuteAgreement?success=false";s:11:"curPayments";s:1:"0";s:17:"curPaymentsAmount";s:4:"0.00";s:17:"curPeriodAttempts";s:1:"0";s:19:"curPeriodEndingDate";N;s:12:"currencyCode";s:3:"USD";s:11:"dateOfMonth";s:1:"0";s:9:"dayOfWeek";s:16:"NO_DAY_SPECIFIED";s:10:"endingDate";N;s:19:"maxAmountPerPayment";N;s:19:"maxNumberOfPayments";N;s:28:"maxNumberOfPaymentsPerPeriod";N;s:27:"maxTotalAmountOfAllPayments";N;s:13:"paymentPeriod";s:19:"NO_PERIOD_SPECIFIED";s:7:"pinType";s:12:"NOT_REQUIRED";s:9:"returnUrl";s:61:"http://www.winjob.com/pay/addPP/ExecuteAgreement?success=true";s:11:"senderEmail";s:29:"buyer.test@haseeburrehman.com";s:4:"memo";N;s:12:"startingDate";s:24:"2016-11-12T13:22:59.000Z";s:6:"status";s:6:"ACTIVE";s:18:"ipnNotificationUrl";N;s:11:"addressList";N;s:9:"feesPayer";N;s:21:"displayMaxTotalAmount";s:5:"false";s:6:"sender";O:32:"PayPal\\Types\\AP\\SenderIdentifier":5:{s:14:"useCredentials";N;s:12:"taxIdDetails";N;s:5:"email";N;s:5:"phone";N;s:9:"accountId";s:13:"B3LWEJAZ5TJ9N";}s:13:"agreementType";N;s:5:"error";N;}', 'buyer.test@haseeburrehman.com', 'B3LWEJAZ5TJ9N', 1478964500, 18, 'PA-7MH814029C4529254'),
(4, 'O:42:"PayPal\\Types\\AP\\PreapprovalDetailsResponse":29:{s:16:"responseEnvelope";O:36:"PayPal\\Types\\Common\\ResponseEnvelope":4:{s:9:"timestamp";s:29:"2016-11-12T09:41:37.507-08:00";s:3:"ack";s:7:"Success";s:13:"correlationId";s:13:"37eb824c5cc9e";s:5:"build";s:8:"26820131";}s:8:"approved";s:4:"true";s:9:"cancelUrl";s:62:"http://www.winjob.com/pay/addPP/ExecuteAgreement?success=false";s:11:"curPayments";s:1:"0";s:17:"curPaymentsAmount";s:4:"0.00";s:17:"curPeriodAttempts";s:1:"0";s:19:"curPeriodEndingDate";N;s:12:"currencyCode";s:3:"USD";s:11:"dateOfMonth";s:1:"0";s:9:"dayOfWeek";s:16:"NO_DAY_SPECIFIED";s:10:"endingDate";N;s:19:"maxAmountPerPayment";N;s:19:"maxNumberOfPayments";N;s:28:"maxNumberOfPaymentsPerPeriod";N;s:27:"maxTotalAmountOfAllPayments";N;s:13:"paymentPeriod";s:19:"NO_PERIOD_SPECIFIED";s:7:"pinType";s:12:"NOT_REQUIRED";s:9:"returnUrl";s:61:"http://www.winjob.com/pay/addPP/ExecuteAgreement?success=true";s:11:"senderEmail";s:29:"buyer.test@haseeburrehman.com";s:4:"memo";N;s:12:"startingDate";s:24:"2016-11-12T13:22:59.000Z";s:6:"status";s:6:"ACTIVE";s:18:"ipnNotificationUrl";N;s:11:"addressList";N;s:9:"feesPayer";N;s:21:"displayMaxTotalAmount";s:5:"false";s:6:"sender";O:32:"PayPal\\Types\\AP\\SenderIdentifier":5:{s:14:"useCredentials";N;s:12:"taxIdDetails";N;s:5:"email";N;s:5:"phone";N;s:9:"accountId";s:13:"B3LWEJAZ5TJ9N";}s:13:"agreementType";N;s:5:"error";N;}', 'buyer.test@haseeburrehman.com', 'B3LWEJAZ5TJ9N', 1478972497, 18, 'PA-7MH814029C4529254');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `name`, `value`) VALUES
(1, 'status', '1'),
(2, 'imagesize', '30'),
(9, 'smpthost', 'mail.gsdcard.com'),
(10, 'smptport', '587'),
(11, 'smptusername', 'mail@gsdcard.com'),
(12, 'smptpass', '#vQrq,!C{bUe'),
(13, 'smtpname', 'gsdcard mail'),
(14, 'replyto', 'mail@gsdcard.com'),
(15, 'replyname', 'gsdcard'),
(20, 'apiurl', 'http://www.gsdcard.com/api/'),
(30, 'upurl', 'http://localhost/admin/mobappapi/'),
(31, 'upuser', 'ghanamain'),
(32, 'uppass', 'ghanamain');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id_skills` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `skills`
--

INSERT INTO `skills` (`id_skills`, `skill_name`) VALUES
(1, 'Adobe InDesign'),
(2, 'Apache Solr'),
(3, 'YouTube'),
(4, 'ERP'),
(5, 'Virtual Assistant'),
(6, 'Supplier Sourcing'),
(7, 'Product Sourcing'),
(8, 'HTML'),
(9, 'HTML5'),
(10, 'Windows'),
(11, 'Web Scraping'),
(12, 'phonegap'),
(13, 'Google Adsense'),
(14, 'Adobe Flash'),
(15, 'Photography'),
(16, 'Paypal API'),
(17, 'Grant Writing'),
(18, 'Speech Writing'),
(19, 'Software Testing'),
(20, 'Business Cards'),
(21, 'Photoshop'),
(22, 'DNS'),
(23, 'Zen Cart'),
(24, 'Reviews'),
(25, 'Blog Design'),
(26, 'Editing'),
(27, 'Copywriting'),
(28, 'WIKI'),
(29, 'Academic Writing'),
(30, 'Brochure Design'),
(31, 'Branding'),
(32, 'Logo Design'),
(33, 'Banner Design'),
(34, 'Website Design'),
(35, 'Graphic Design'),
(36, 'PHP'),
(37, 'Laravel'),
(38, 'javascript'),
(39, 'AngularJS'),
(40, 'iOS'),
(41, 'Mobile App'),
(42, 'Wordpress'),
(43, 'Facebook'),
(44, 'Sales'),
(45, 'mysql'),
(46, 'jquery'),
(47, 'Backlink Building'),
(48, 'Java'),
(49, 'Telemarketing Exp'),
(50, 'Android'),
(51, 'CSS'),
(52, 'Lead Generation'),
(53, 'CMS'),
(54, 'PayU'),
(55, 'PayPal'),
(56, 'EBS'),
(57, 'Payment Gateway'),
(58, 'Blog Developer'),
(59, 'Joomla'),
(60, 'osCommerce'),
(61, 'PrestaShop'),
(62, 'Drupal'),
(63, 'CakePHP'),
(64, 'CodeIgniter'),
(65, 'Symfony'),
(66, 'Yii'),
(67, 'Zend'),
(68, 'ROR'),
(69, 'Go Lang'),
(70, 'Hadoop'),
(71, 'Stripe Payments'),
(72, 'Swift Language'),
(73, 'iPhone'),
(74, 'Python'),
(75, 'Perl'),
(76, 'ASP'),
(77, 'JSP'),
(78, 'XML'),
(79, 'Cold Fusion'),
(80, 'Typography'),
(81, 'Django'),
(82, 'PeopleSoft'),
(83, 'Cocoa'),
(84, 'Nginx'),
(85, 'Facebook Marketing'),
(86, 'Accounting'),
(87, 'Web Search'),
(88, 'Technical Writing'),
(89, '3D Modelling'),
(90, 'Engineering'),
(91, 'Rendering'),
(92, 'Illustrator'),
(93, 'Twitter'),
(94, 'Marketing'),
(95, 'AJAX'),
(96, 'Software Architecture'),
(97, 'Translation'),
(98, 'Content Writing'),
(99, 'Blog Writing'),
(100, 'software development'),
(101, 'Word'),
(102, 'Data Entry'),
(103, 'Articles'),
(104, 'Ghostwriting'),
(105, 'Article Rewriting'),
(106, 'C#'),
(107, 'C Programming'),
(108, 'C++ Programming'),
(109, 'Telemarketing'),
(110, 'iPad'),
(111, 'Magento'),
(112, 'Animation'),
(113, 'Linux'),
(114, 'sql'),
(115, 'Excel'),
(116, 'Link Building'),
(117, 'Advertising'),
(118, 'eCommerce'),
(119, 'Social Networking'),
(120, 'User Interface IA'),
(121, 'NET'),
(122, 'Research'),
(123, 'email marketing'),
(124, 'Internet Marketing'),
(125, 'SEO'),
(126, 'Salesmen'),
(127, 'Data Processing'),
(128, 'Leads'),
(129, 'Shopping Carts'),
(130, 'copy typing'),
(131, 'Bulk Marketing'),
(132, '3D Animation'),
(133, 'Video Services'),
(134, 'PSD to HTML'),
(135, 'Proofreading'),
(136, 'Web Security'),
(137, 'Computer Security'),
(138, 'Testing'),
(139, 'Apache Tomcat'),
(140, 'Redhat'),
(141, 'Nagios'),
(142, 'Icinga'),
(143, 'Puppet'),
(144, 'Chef'),
(145, 'Git'),
(146, 'SVN'),
(147, 'Cassandra'),
(148, 'Proxy'),
(149, 'LDAP'),
(150, 'Munin'),
(151, 'AWS'),
(152, 'MongoDB'),
(153, 'Memcached'),
(154, 'Apache'),
(155, 'Apache ActiveMQ'),
(156, 'SonarQube'),
(157, 'Elastic Search'),
(158, 'Scala'),
(159, 'Voiceover'),
(160, 'Audio Recording'),
(161, 'Narration'),
(162, 'Video Script'),
(163, 'Google Analytics'),
(164, 'Salesforce'),
(165, 'FileMaker'),
(166, 'Microsoft SQL Server'),
(167, 'VBNET'),
(168, 'Google Adword'),
(169, 'Business Development'),
(170, 'Business Strategy'),
(171, 'Server Administration'),
(172, 'Oracle Database'),
(173, 'Storage Administrator'),
(174, 'Matlab'),
(175, 'Mathematics'),
(176, 'Statistics'),
(177, 'Algorithm'),
(178, 'Social Marketing'),
(179, 'Digital Marketing'),
(180, 'Social Media'),
(181, 'Mobile Marketing'),
(182, 'GWT'),
(183, 'Cloud'),
(184, 'Google App Engine'),
(185, 'Ruby'),
(186, 'Ruby on Rails'),
(187, 'Sinatra'),
(188, 'BackboneJS'),
(189, 'NodeJS'),
(190, 'OpenStack'),
(191, 'VMware'),
(192, 'Datacenter Networking'),
(193, 'Network Design'),
(194, 'Cisco'),
(195, 'EmberJS'),
(196, 'Grails'),
(197, 'Teaching'),
(198, 'English Language'),
(199, 'Lesson Planning'),
(200, 'Ebay API'),
(201, 'Furniture Design'),
(202, 'Product Design'),
(203, 'Architectural Design'),
(204, 'CorelDraw'),
(205, 'UI Design'),
(206, 'UX Design'),
(207, 'Moodle'),
(208, 'Opencart'),
(209, 'Woocommerce'),
(210, 'polymer js'),
(211, 'Shopify'),
(212, 'Haskell'),
(213, 'SugarCRM'),
(214, 'Bootstrap'),
(215, 'CAD'),
(216, 'ExpressJS'),
(217, 'Qlikview'),
(218, 'Docker'),
(219, 'Apparel Design'),
(220, 'Jewellery Design'),
(221, 'Pinterest Marketing'),
(222, 'Meteor'),
(223, 'ReactJS'),
(224, 'Paytm Force Specialist'),
(225, 'Bamboo'),
(226, 'FishEye'),
(227, 'Atlassian Jira'),
(228, 'Ubuntu'),
(229, 'CentOS'),
(230, '.NET Compact Framework'),
(231, '.NET Framework'),
(232, '.NET Remoting'),
(233, '1ShoppingCart'),
(234, '2D Animation'),
(235, '2D Design'),
(236, '3D Design'),
(237, '3D Modeling'),
(238, '3D Printing'),
(239, '3D Rendering'),
(240, '3D Rigging'),
(241, '3D Scanning'),
(242, '3D Systems'),
(243, '3ds Max'),
(244, 'A2Billing'),
(245, 'Ab Initio'),
(246, 'AB Testing'),
(247, 'Abaqus'),
(248, 'AbleCommerce'),
(249, 'Ableton Live'),
(250, 'Absynth'),
(251, 'Account Management'),
(252, 'AccountMate'),
(253, 'Accounts Payable Management'),
(254, 'Accounts Receivable Management'),
(255, 'ACDSee'),
(256, 'ACPI'),
(257, 'Acquisitions'),
(258, 'Acronis'),
(259, 'Acrylic Painting'),
(260, 'ACT!'),
(261, 'Actian'),
(262, 'ActionScript'),
(263, 'ActionScript 3'),
(264, 'Active Directory'),
(265, 'Active Listening'),
(266, 'ActiveCollab'),
(267, 'ActiveX'),
(268, 'Ad Planning Buying'),
(269, '>Ad Posting'),
(270, 'Ad Servers'),
(271, 'Ada'),
(272, 'Adaco'),
(273, 'Adaptive Algorithms'),
(274, 'ADK'),
(275, 'Administrative Support'),
(276, 'ActiveX Data Objects ADO'),
(277, 'ADO.NET'),
(278, 'Adobe Acrobat'),
(279, 'Adobe After Effects'),
(280, 'Adobe AIR'),
(281, 'Adobe Analytics'),
(282, 'Adobe Audition'),
(283, 'Adobe Business Catalyst'),
(284, 'Adobe Captivate'),
(285, 'Adobe Content Server'),
(286, 'Adobe Contribute'),
(287, 'Adobe Creative Suite'),
(288, 'Adobe Digital Marketing Suite'),
(289, 'Adobe Director'),
(290, 'Adobe Dreamweaver'),
(291, 'Adobe eLearning Suite'),
(292, 'Adobe Encore'),
(293, 'Adobe Fireworks'),
(294, 'Adobe Flex'),
(295, 'Adobe Framemaker'),
(296, 'Adobe FreeHand'),
(297, 'Adobe GoLive'),
(298, 'AGA'),
(299, 'Adobe Illustrator'),
(300, 'Adobe Imageready'),
(301, 'Adobe InCopy'),
(302, 'Adobe Insight'),
(303, 'Adobe Photoshop Lightroom'),
(304, 'Adobe LiveCycle Designer'),
(305, 'Adobe Muse'),
(306, 'Adobe PageMaker'),
(307, 'Adobe PDF'),
(308, 'Adobe Photoshop'),
(309, 'Adobe Premiere'),
(310, 'Adobe Premiere Elements'),
(311, 'Adobe Premiere Pro'),
(312, 'Adobe RoboHelp'),
(313, 'Adobe Soundbooth'),
(314, 'Adobe Wallaby'),
(315, 'ADVA'),
(316, 'Advanced Business Application Programming ABAP'),
(317, 'Affiliate Marketing'),
(318, 'Afrikaans'),
(319, 'Agile software developmennt'),
(320, 'Agriculture'),
(321, 'Amharic Language'),
(322, 'AIX'),
(323, 'Akka'),
(324, 'Albanian'),
(325, 'Album Cover Design'),
(326, 'Alfresco development'),
(327, 'Alfresco user'),
(328, 'Algorithm Development'),
(329, 'Algorithms'),
(330, 'Alibre Design'),
(331, 'Alpha'),
(332, 'Alternative3D'),
(333, 'Alternative Dispute Resolution'),
(334, 'Altium Designer'),
(335, 'Amadeus'),
(336, 'Amanda Backup'),
(337, 'Amazon Appstore'),
(338, 'Amazon EC2'),
(339, 'Mechanical Turk API'),
(340, 'Amazon MWS'),
(341, 'Amazon Relational Database Service'),
(342, 'Amazon S3'),
(343, 'Amazon Web Services'),
(344, 'Amazon Webstore'),
(345, 'aMember'),
(346, 'American Sign Language'),
(347, 'Amplifiers and Filters'),
(348, 'AMQP'),
(349, 'Analog Electronics'),
(350, 'Analytics'),
(351, 'Android App Development'),
(352, 'Android SDK'),
(353, 'Anime Studio'),
(354, 'ANSI C'),
(355, 'ANSYS'),
(356, 'Antenna Design'),
(357, 'Antispam and Antivirus'),
(358, 'Antitrust'),
(359, 'AP Style Writing'),
(360, 'Apache administration'),
(361, 'Apache Ant'),
(362, 'Apache Avro'),
(363, 'Apache Camel'),
(364, 'Apache Click'),
(365, 'Apache CloudStack'),
(366, 'Apache Cocoon'),
(367, 'Apache Cordova'),
(368, 'Apache CXF'),
(369, 'Apache Flume'),
(370, 'Apache Hive'),
(371, 'Apache Kafka'),
(372, 'Apache Mahout'),
(373, 'Apache Maven'),
(374, 'Apache Nutch'),
(375, 'Apache OFBiz'),
(376, 'Apache Jakarta POI'),
(377, 'Apache Shirol'),
(378, 'Apache Spark'),
(379, 'Apache Struts'),
(380, 'Apache Thrift'),
(381, 'Apache Tiles'),
(382, 'API Development'),
(383, 'API Documentation'),
(384, 'Apollo'),
(385, 'App Store'),
(386, 'App Usability Analysis'),
(387, 'Appcelerator Titanium'),
(388, 'AppFuse'),
(389, 'Appian'),
(390, 'Appian BPM Suite'),
(391, 'Apple iBooks'),
(392, 'Apple iMovie'),
(393, 'iOS Jailbreaking'),
(394, 'Apple iWeb'),
(395, 'Apple iWork'),
(396, 'Apple Motion'),
(397, 'Apple UIKit Framework'),
(398, 'Apple WebObjects'),
(399, 'Apple Xcode'),
(400, 'AppleScript'),
(401, 'Applicant Tracking Systems'),
(402, 'Application Lifecycle Management'),
(403, 'Application Programming'),
(404, 'Application Server'),
(405, 'Appointment Setting'),
(406, 'Arabic'),
(407, 'Arbitration'),
(408, 'ArcGIS'),
(409, 'ArchiCAD'),
(410, 'Architecture'),
(411, 'Architectural Rendering'),
(412, 'ArcScene'),
(413, 'ARCserve'),
(414, 'Arduino'),
(415, 'ARM'),
(416, 'Art curation'),
(417, 'Art Direction'),
(418, 'Article curation'),
(419, 'Article Spinning'),
(420, 'Article Submission'),
(421, 'Article Writing'),
(422, 'Articulate'),
(423, 'Articulate Engage'),
(424, 'Articulate Presenter'),
(425, 'Articulate Storyline'),
(426, 'Articulate Studio'),
(427, 'Artificial Intelligence'),
(428, 'Artificial Neural Networks'),
(429, 'ArtiosCAD'),
(430, 'Artisteer'),
(431, 'Artlantis Render'),
(432, 'Artlantis Studio'),
(433, 'ArtRage'),
(434, 'Arts Crafts'),
(435, 'IBM AS400 Control Language'),
(436, 'ASIO'),
(437, 'ASP.NET'),
(438, 'ASP.NET MVC'),
(439, 'AspDotNetStorefront'),
(440, 'AspectJS'),
(441, 'Aspen HYSYS'),
(442, 'Assembla'),
(443, 'Assembly Language'),
(444, 'Asterisk'),
(445, 'Astrology'),
(446, 'Astrophysics'),
(447, 'Asynchronous IO'),
(448, 'ATL'),
(449, 'Atlas'),
(450, 'Atlassian Confluence'),
(451, 'Atlassian GreenHopper'),
(452, 'ATM Implementation'),
(453, 'Atmel AVR'),
(454, 'Atom'),
(455, 'Auctiva'),
(456, 'Audacity'),
(457, 'Audio Design'),
(458, 'Audio Editing'),
(459, 'Audio Engineering'),
(460, 'Audio Mastering'),
(461, 'Audio Mixing'),
(462, 'Audio Post Production'),
(463, 'Audio Postediting'),
(464, 'Audio Production'),
(465, 'Audio Restoration'),
(466, 'Auditing'),
(467, 'Autodesk Architecture'),
(468, 'Augmented Reality'),
(469, 'Author It'),
(470, 'Authorize.Net Development'),
(471, 'AutoCAD'),
(472, 'Autodesk'),
(473, 'Autodesk 3D Studio Max'),
(474, 'Autodesk Autocad Civil3D'),
(475, 'Autodesk Inventor'),
(476, 'Autodesk Maya'),
(477, 'Autodesk Mudbox'),
(478, 'Autodesk Navisworks'),
(479, 'Autodesk Revit'),
(480, 'Autodesk Sketchbook Pro'),
(481, 'Autodesk Softimage'),
(482, 'Autodys AcceliCAD'),
(483, 'AutoHotKey'),
(484, 'Autoit'),
(485, 'AutoLISP'),
(486, 'Automated Call Distribution'),
(487, 'Automated Testing'),
(488, 'Automation'),
(489, 'Automotive Engineering'),
(490, 'Avactis'),
(491, 'Avaya'),
(492, 'AVEVA PDMS'),
(493, 'Aviation'),
(494, 'Avid'),
(495, 'Avid Pro Tools'),
(496, 'Away3D'),
(497, 'aWeber'),
(498, 'Awk'),
(499, 'Abstract Window Toolkit AWT'),
(500, 'Axapta'),
(501, 'Axiis'),
(502, 'Axiom MicroStation Productivity Toolkit'),
(503, 'Axiom Productivity Tools'),
(504, 'Axure RP'),
(505, 'B2B Marketing'),
(506, 'Backbone.js'),
(507, 'Bacula'),
(508, 'Bada'),
(509, 'Baking'),
(510, 'Balsamiq'),
(511, 'Bank Reconciliation'),
(512, 'Bankruptcy'),
(513, 'Banner Ads'),
(514, 'Banner Ad Design'),
(515, 'Bartending'),
(516, 'Business Activity Monitoring'),
(517, 'Basecamp'),
(518, 'Bash'),
(519, 'Bash shell scripting'),
(520, 'Basic'),
(521, 'Basque'),
(522, 'Bassoon'),
(523, 'bbPress'),
(524, 'Behavior Driven Development BDD'),
(525, 'Behavioral Event Interviewing'),
(526, 'Belle Nuit Subtitler'),
(527, 'Benefits Law'),
(528, 'Bengali'),
(529, 'Bentley Microstation'),
(530, 'BeOS'),
(531, 'Betfair'),
(532, 'BGL Simple Fund'),
(533, 'Border Gateway Protocol'),
(534, 'Big Data'),
(535, 'BigCommerce'),
(536, 'Bing Ads'),
(537, 'Bioinformatics'),
(538, 'Biography Writing'),
(539, 'Biology'),
(540, 'Biostatistics'),
(541, 'Biotechnology'),
(542, 'BIRT'),
(543, 'Bitcoin'),
(544, 'Bitrix'),
(545, 'Bitrix Intranet'),
(546, 'BitRock Installbuilder'),
(547, 'BizTalk Server'),
(548, 'Black Box Testing'),
(549, 'Blackberry app development'),
(550, 'BlackBerry JDE'),
(551, 'Blackboard'),
(552, 'BlazeDS'),
(553, 'Blender3D'),
(554, 'Blitz BASIC'),
(555, 'Blog Commenting'),
(556, 'Blog Development'),
(557, 'blue.box'),
(558, 'Bluetooth'),
(559, 'BuildMyRank Writing'),
(560, 'Book Cover Design'),
(561, 'Book Writing'),
(562, 'Bookkeeping'),
(563, 'BoonEx Dolphin'),
(564, 'Boost'),
(565, 'Borland C++ Builder'),
(566, 'Borland SilkTest'),
(567, 'Bosnian'),
(568, 'Box.net Development'),
(569, 'Box2D'),
(570, 'BPCS'),
(571, 'Business Process Execution Language BPEL'),
(572, 'BPO Call Center'),
(573, 'BPO IT services'),
(574, 'Brand Consulting'),
(575, 'Brand Licensing'),
(576, 'Brand Management'),
(577, 'Brand Ambassador'),
(578, 'BREW'),
(579, 'Broadcast Advertising'),
(580, 'Broadcast Engineering'),
(581, 'BroadVision ClearVale'),
(582, 'BroadVision QuickSilver'),
(583, 'BuddyPress'),
(584, 'Budgeting Forecasting'),
(585, 'Bugzilla'),
(586, 'Building Estimation'),
(587, 'Building Regulations'),
(588, 'Buildium'),
(589, 'Bulgarian'),
(590, 'Business Analysis'),
(591, 'Business Card Design'),
(592, 'Business Coaching'),
(593, 'Business Continuity Planning'),
(594, 'Business intelligence'),
(595, 'Business IT Alignment'),
(596, 'Business Management'),
(597, 'Business Mathematics'),
(598, 'Business Modeling'),
(599, 'Business Planning'),
(600, 'Business Process Modeling'),
(601, 'Business Process Reengineering'),
(602, 'Business Proposal Writing'),
(603, 'Business Scenario Development'),
(604, 'Business valuation'),
(605, 'Business Writing'),
(606, 'C'),
(607, 'C++'),
(608, 'C Shell'),
(609, 'Cache Management'),
(610, 'Computer Aided Design'),
(611, 'Cadence Platform'),
(612, 'Cairngorm'),
(613, 'Cakewalk Sonar'),
(614, 'Calculus'),
(615, 'Calendar Management'),
(616, 'Call Center Management'),
(617, 'Call Handling'),
(618, 'Calligraphy'),
(619, 'Camtasia'),
(620, 'Cantonese'),
(621, 'Capistrano'),
(622, 'Capture NX2'),
(623, 'Carbide.c++'),
(624, 'Caricature Drawing'),
(625, 'Cartography Maps'),
(626, 'Cartooning'),
(627, 'Caspio Administration'),
(628, 'Caspio Programming'),
(629, 'Apache Cassandra'),
(630, 'Catalan'),
(631, 'Catch Phrases'),
(632, 'Catholic Theology'),
(633, 'CATIA'),
(634, 'Cavium Octeon Fusion'),
(635, 'Cavium OCTEON Plus MIPS64'),
(636, 'Cisco Certified Network Professional CCNP'),
(637, 'CDMA'),
(638, 'Celemony Melodyne'),
(639, 'Violoncello'),
(640, 'Central Desktop Development'),
(641, 'Central Reservation Systems'),
(642, 'Centreon'),
(643, 'Certified Information Systems Security Professiona'),
(644, 'Certified Public Accountant CPA'),
(645, 'CG Artwork'),
(646, 'CGI'),
(647, 'Change Management'),
(648, 'Chaos Group V Ray'),
(649, 'Character Design'),
(650, 'Chart.js'),
(651, 'chat support'),
(652, 'Check Point'),
(653, 'Chemical Engineering'),
(654, 'Chemistry'),
(655, 'Chicago Manual of Style'),
(656, 'Child Counseling'),
(657, 'Children&#039;s Writing'),
(658, 'Chinese'),
(659, 'Christian theology'),
(660, 'Chroma key'),
(661, 'Chrome Extension'),
(662, 'Chrome OS'),
(663, 'Customer Information Control System CICS'),
(664, 'Cinematography'),
(665, 'Circuit Design'),
(666, 'Cisco ASA'),
(667, 'Cisco Certified Design Associate CCDA'),
(668, 'Cisco Certified Design Expert CCDE'),
(669, 'Cisco Certified Design Professional CCDP'),
(670, 'Cisco Certified Entry Networking Technician CCENT'),
(671, 'Cisco Certified Internetwork Expert CCIE'),
(672, 'Cisco Certified Network Associate CCNA'),
(673, 'Cisco IOS'),
(674, 'Cisco PIX'),
(675, 'cisco routers'),
(676, 'Cisco CallManager'),
(677, 'Citrix NetScaler'),
(678, 'Citrix XenServer'),
(679, 'CiviCRM<'),
(680, 'Civil Engineering'),
(681, 'Civil Law'),
(682, 'ClamAV'),
(683, 'Classifieds Posting'),
(684, 'Clean Technology'),
(685, 'Clear Books'),
(686, 'ClearQuest'),
(687, 'clerical skills'),
(688, 'ClickBank'),
(689, 'Climate Sciences'),
(690, 'Clipping Path'),
(691, 'Clojure'),
(692, 'Cloud Security Framework'),
(693, 'Cloudera'),
(694, 'CloudForge'),
(695, 'Cluster Computing'),
(696, 'CMS Development'),
(697, 'CNC Programming'),
(698, 'COBOL'),
(699, 'Cocoa Touch'),
(700, 'Cocos2d'),
(701, 'Code Refactoring'),
(702, 'CoDeSys'),
(703, 'CodeWarrior'),
(704, 'CoffeeScript'),
(705, 'Cognos'),
(706, 'Cold calling'),
(707, 'ColdFusion'),
(708, 'CollabNet TeamForge'),
(709, 'Collaborative filtering'),
(710, 'Collection Agencies'),
(711, 'Component Object Model Microsoft COM'),
(712, 'Comedy Writing'),
(713, 'Comet'),
(714, 'Comic Art'),
(715, 'Comic Writing'),
(716, 'Commercial Lending'),
(717, 'Commercials'),
(718, 'Common Language Runtime'),
(719, 'Communications'),
(720, 'Compensation'),
(721, 'Compiler'),
(722, 'Complaint Management'),
(723, 'Compliance'),
(724, 'Compositing'),
(725, 'Computational Fluid Dynamics CFD'),
(726, 'Computational Linguistics'),
(727, 'Computer Aided Manufacturing CAM'),
(728, 'Computer Assembly'),
(729, 'Computer Engineering'),
(730, 'Computer Graphics'),
(731, 'Computer Hardware Design'),
(732, 'Computer Hardware Installation'),
(733, 'Comptuer Maintenance'),
(734, 'Computer Networking'),
(735, 'Computer Repair'),
(736, 'Computer Skills'),
(737, 'Computer vision'),
(738, 'comsat'),
(739, 'COMSOL Multiphysics'),
(740, 'Concept Artistry'),
(741, 'Concept Design'),
(742, 'Concept Software InPage'),
(743, 'ConceptShare Development'),
(744, 'Concrete5 CMS'),
(745, 'Conflict Resolution'),
(746, 'Constant Contact'),
(747, 'Construction'),
(748, 'Construction Monitoring'),
(749, 'Consumer Protection'),
(750, 'Contao CMS'),
(751, 'Content Management System'),
(752, 'Content Moderation'),
(753, 'Continuous Integration'),
(754, 'Contract Drafting'),
(755, 'Contract Law'),
(756, 'Contract Manufacturing'),
(757, 'Conversion Rate Optimization'),
(758, 'Cooking'),
(759, 'Copy editing'),
(760, 'Copyright'),
(761, 'CORBA'),
(762, 'Core Java'),
(763, 'Corel Paint Shop Pro'),
(764, 'Corel Painter'),
(765, 'Corel Ventura'),
(766, 'Corona'),
(767, 'Corporate Brand Identity'),
(768, 'Corporate Finance'),
(769, 'Corporate Law'),
(770, 'Corporate Strategy'),
(771, 'Corporate Taxes'),
(772, 'COSMO RS Chemical Engineering'),
(773, 'Cosmos OS'),
(774, 'Cost accounting'),
(775, 'CouchDB'),
(776, 'Counseling Psychology'),
(777, 'Cover Design'),
(778, 'Cover Letter Writing'),
(779, 'Covers Packaging'),
(780, 'CPanel'),
(781, 'CppUnit'),
(782, 'CPU Design'),
(783, 'Web Crawling'),
(784, 'Creative Talent'),
(785, 'Creative writing'),
(786, 'CRE Loaded'),
(787, 'Criminal Law'),
(788, 'CRM'),
(789, 'Croatian'),
(790, 'Crowdfunding'),
(791, 'Cryptography'),
(792, 'SAP Crystal Reports'),
(793, 'CS Cart'),
(794, 'CSS3'),
(795, 'CSUDSU'),
(796, 'Cubecart'),
(797, 'Cucumber'),
(798, 'CUDA'),
(799, 'CURL'),
(800, 'Curriculum Development'),
(801, 'Custom CMS'),
(802, 'Customer service'),
(803, 'Customer support'),
(804, 'CVS'),
(805, 'Czech'),
(806, 'D Programming Language'),
(807, 'd3.js'),
(808, 'DaVinci Resolve'),
(809, 'Dancing'),
(810, 'Danish'),
(811, 'DART'),
(812, 'Data Analytics'),
(813, 'Data Backup'),
(814, 'Data Center Operations'),
(815, 'Data Cleansing'),
(816, 'Data Encoding'),
(817, 'Data Engineering'),
(818, 'Data Ingestion'),
(819, 'Data Interpretation'),
(820, 'Data Logistics'),
(821, 'Data mining'),
(822, 'Data Modeling'),
(823, 'Data Protection'),
(824, 'Data Recovery'),
(825, 'Data Science'),
(826, 'Data scraping'),
(827, 'Data Sheet Writing'),
(828, 'Data Structures'),
(829, 'Data Sufficiency'),
(830, 'Data Visualization'),
(831, 'Data Warehousing'),
(832, 'Database Administration'),
(833, 'Database Caching'),
(834, 'Database Cataloguing'),
(835, 'Database design'),
(836, 'database management'),
(837, 'Database Modeling'),
(838, 'database programming'),
(839, 'Database testing'),
(840, 'DataLife Engine'),
(841, 'IBM InfoSphere DataStage'),
(842, 'dBase Administration'),
(843, 'dBase Programming'),
(844, 'DBMS'),
(845, 'DCOM'),
(846, 'Debian OS'),
(847, 'Defect Tracking'),
(848, 'Deja Vu'),
(849, 'DELFTship'),
(850, 'Delphi'),
(851, 'Demandware'),
(852, 'Dental Technology'),
(853, 'Derivatives'),
(854, 'Desk.com Administration'),
(855, 'Desk.com Development'),
(856, 'Desktop Applications'),
(857, 'Desktop Publishing'),
(858, 'Desktop Support'),
(859, 'DevExpress Reporting'),
(860, 'DevExpress'),
(861, 'DevOps'),
(862, 'DHCP'),
(863, 'DHTML'),
(864, 'Dialux'),
(865, 'Dietetics'),
(866, 'Diffbot'),
(867, 'Digital Access Pass'),
(868, 'Digital Electronics'),
(869, 'Digital Engineering'),
(870, 'Digital Mapping'),
(871, 'Digital Ocean'),
(872, 'Digital painting'),
(873, 'Digital Photography'),
(874, 'Digital scrapbooking'),
(875, 'Digital Sculpting'),
(876, 'Digital Signal Processing'),
(877, 'Dimdim Development'),
(878, 'Dinamica Ego'),
(879, 'Direct marketing'),
(880, 'Directory Submission'),
(881, 'DirectShow'),
(882, 'DirectX'),
(883, 'Disaster recovery'),
(884, 'Display Ads'),
(885, 'Distance Education'),
(886, 'Distributed computing'),
(887, 'DJing'),
(888, 'dmaic'),
(889, 'DNSsec'),
(890, 'DocBook'),
(891, 'Doctrine ORM'),
(892, 'Document Control'),
(893, 'Document Conversion'),
(894, 'Document Object Model'),
(895, 'Document review'),
(896, 'Dojo Toolkit'),
(897, 'Domain Migration'),
(898, 'DOS'),
(899, 'DotNetNuke'),
(900, 'Drafting'),
(901, 'Drawing'),
(902, 'Device Driver Development'),
(903, 'Driving'),
(904, 'Drones'),
(905, '>Drop Shipping'),
(906, 'Dropbox API'),
(907, 'Drums'),
(908, 'DSL Troubleshooting'),
(909, 'DTS'),
(910, 'Dundas Chart Controls'),
(911, 'Dutch'),
(912, 'dvd mastering'),
(913, 'DVD Studio Pro'),
(914, 'Dwolla API'),
(915, 'EHealth'),
(916, 'eLearning'),
(917, 'ePub'),
(918, 'E4X'),
(919, 'Eagle'),
(920, 'eBay ListingWriting'),
(921, 'eBay Marketing'),
(922, 'eBay Motors'),
(923, 'eBay Web Services'),
(924, 'eBook Design'),
(925, 'ebook Writing'),
(926, 'eBooks'),
(927, 'Eclipse'),
(928, 'ECMAScript'),
(929, 'Ecommerce Platform Development'),
(930, 'Econometrics'),
(931, 'Economic Analysis'),
(932, 'Economics'),
(933, 'EDGE'),
(934, 'Electronic data interchange EDI'),
(935, 'Editorial Writing'),
(936, 'Edius'),
(937, 'Education Technology'),
(938, 'Edufire'),
(939, 'Enterprise JavaBeans EJB'),
(940, 'Ekiga'),
(941, 'Ektron'),
(942, 'Elance'),
(943, 'Elasticsearch'),
(944, 'Elastix'),
(945, 'Electrical Drawing'),
(946, 'Electrical engineering'),
(947, 'Electronic Design'),
(948, 'Electronic funds transfer'),
(949, 'Electronic Workbench'),
(950, 'Electronics'),
(951, 'Elgg'),
(952, 'Elliptic Curve Cryptography ECC'),
(953, 'Eloqua'),
(954, 'Email Deliverability'),
(955, 'Email Etiquette'),
(956, 'Email Handling'),
(957, 'Email Technical Support'),
(958, 'Embedded C'),
(959, 'Embedded Linux'),
(960, 'Embedded Systems'),
(961, 'Ember.js'),
(962, 'Embroidery'),
(963, 'embroidery digitization'),
(964, 'EMC Symmetrix'),
(965, 'Employment Law'),
(966, 'Energy Engineering'),
(967, 'Engineering Design'),
(968, 'Engineering drawing'),
(969, 'English'),
(970, 'English Grammar'),
(971, 'English Proofreading'),
(972, 'English Punctuation'),
(973, 'English Spelling'),
(974, 'english tutoring'),
(975, 'ADO.NET Entity Framework'),
(976, 'Entity Framework'),
(977, 'Entrepreneurship'),
(978, 'Environmental Law'),
(979, 'Environmental science'),
(980, 'ERDAS IMAGINE'),
(981, 'Erlang'),
(982, 'Erotica Writing'),
(983, 'Enterprise Resource Planning ERP'),
(984, 'Erwin'),
(985, 'ESL Teaching'),
(986, 'Essay Writing'),
(987, 'Essbase'),
(988, 'ETABS'),
(989, 'Extract Transform and Load ETL'),
(990, 'Etsy Administration'),
(991, 'Eucalyptus Cloud'),
(992, 'Event Management'),
(993, 'Event planning'),
(994, 'EViews'),
(995, 'evolus pencil'),
(996, 'ExactTarget'),
(997, 'Excel VBA'),
(998, 'Exim'),
(999, 'Express Scribe<'),
(1000, 'Expression Engine'),
(1001, 'Ext JS'),
(1002, 'Eyeon Fusion'),
(1003, 'eZ Publish'),
(1004, 'F#'),
(1005, 'FAAC'),
(1006, 'Facebook Development'),
(1007, 'facebook games development'),
(1008, 'Facelets'),
(1009, 'Fact Checking'),
(1010, 'Family Law'),
(1011, 'Fashion design'),
(1012, 'Fashion Modeling'),
(1013, 'Fax'),
(1014, 'Facebook Javascript FBJS'),
(1015, 'FBML'),
(1016, 'Feature Writing'),
(1017, 'Federal Acquisition Regulations'),
(1018, 'Fedora'),
(1019, 'Fetchmail'),
(1020, 'FFmpeg'),
(1021, 'Fiber Optics'),
(1022, 'Fiction Writing'),
(1023, 'Field Map'),
(1024, 'Filing'),
(1025, 'Filipino'),
(1026, 'Film criticism'),
(1027, 'Film Direction'),
(1028, 'Film Dubbing'),
(1029, 'Film Production'),
(1030, 'Final Cut Pro'),
(1031, 'Final Cut Pro X'),
(1032, 'Final Draft'),
(1033, 'Finale'),
(1034, 'Financial Accounting'),
(1035, 'Financial analysis'),
(1036, 'Financial Forecasting'),
(1037, 'Financial Management'),
(1038, 'Financial modeling'),
(1039, 'Financial Prospectus Writing'),
(1040, 'Financial Reporting'),
(1041, 'Financial Writing'),
(1042, 'Finite Element Analysis'),
(1043, 'Finnish'),
(1044, 'ire OS Development'),
(1045, 'Fire Protection Engineering'),
(1046, 'Firebird'),
(1047, 'Firefox Plugin Development'),
(1048, 'Firewall'),
(1049, 'First aid'),
(1050, 'Five9'),
(1051, 'FL Studio'),
(1052, 'Flash 3D'),
(1053, 'Flask'),
(1054, 'Flowcharts'),
(1055, 'Flyer Design'),
(1056, 'Font Development'),
(1057, 'FontForge'),
(1058, 'Foreign Exchange Trading'),
(1059, 'Form Z'),
(1060, 'Format Layout'),
(1061, 'Fortran'),
(1062, 'Forum Development'),
(1063, 'Forum Moderation'),
(1064, 'Forum Posting'),
(1065, 'FourSquare Development'),
(1066, 'FoxPro Administration'),
(1067, 'FoxPro Programming'),
(1068, 'Field Programmable Gate Array FPGA'),
(1069, 'Franchise Consulting'),
(1070, 'Fraud Analysis'),
(1071, 'Fraud Mitigation'),
(1072, 'FreeBSD'),
(1073, 'Freelance Marketing'),
(1074, 'FreeMarker'),
(1075, 'FreePBX'),
(1076, 'Freeswitch'),
(1077, 'French'),
(1078, 'Friendster'),
(1079, 'Frontend Development'),
(1080, 'Microsoft FrontPage'),
(1081, 'FTP'),
(1082, 'fuel cms'),
(1083, 'Full text Search Engines'),
(1084, 'Functional testing'),
(1085, 'Fundraising'),
(1086, 'Fusebox'),
(1087, 'Fuzzing'),
(1088, 'GAAP'),
(1089, 'Gambling'),
(1090, 'Game Design'),
(1091, 'Game Development'),
(1092, 'Game Programming'),
(1093, 'Game Testing'),
(1094, 'GameSalad Creator'),
(1095, 'Gamification'),
(1096, 'GarageBand'),
(1097, 'Gearman'),
(1098, 'geartrax'),
(1099, 'Gemvision ClayTrix'),
(1100, 'gemvision matrix'),
(1101, 'General Office Skills'),
(1102, 'Genetic Algorithms'),
(1103, 'Genetic Engineering'),
(1104, 'Geolocation'),
(1105, 'Geology'),
(1106, 'Geomagic'),
(1107, 'Geomagic Design X'),
(1108, 'Geometry'),
(1109, 'Geospatial'),
(1110, 'German'),
(1111, 'getresponse'),
(1112, 'Ggplot2'),
(1113, 'GIMP'),
(1114, 'Geographic Information System GIS'),
(1115, 'GitHub'),
(1116, 'GlassFish'),
(1117, 'Glassware'),
(1118, 'GLSL'),
(1119, 'Go'),
(1120, 'Golang'),
(1121, 'GoldMine'),
(1122, 'GoodData'),
(1123, 'Google+ Marketing'),
(1124, 'Google AdSense API'),
(1125, 'Google AdWords'),
(1126, 'Google AdWords Development'),
(1127, 'Google Analytics API'),
(1128, 'Google App Engine API'),
(1129, 'Google Apps'),
(1130, 'Google Apps API'),
(1131, 'Google Calendar API'),
(1132, 'Google Calendar Development'),
(1133, 'Google Docs'),
(1134, 'Google Docs API'),
(1135, 'Google Gadgets'),
(1136, 'Google Gadgets API'),
(1137, 'Google Glass'),
(1138, 'Google Glass SDK'),
(1139, 'Google Go'),
(1140, 'Google Map Maker'),
(1141, 'Google Maps API'),
(1142, 'Google Places API'),
(1143, 'Google Play'),
(1144, 'Google+'),
(1145, 'Google+ Development'),
(1146, 'Google Reader'),
(1147, 'Google Reader API'),
(1148, 'Google Search API'),
(1149, 'Google search'),
(1150, 'Google Shopping'),
(1151, 'Google Sites Administration'),
(1152, 'Google Sites API'),
(1153, 'SketchUp'),
(1154, 'Google Spreadsheets'),
(1155, 'Google Spreadsheets API'),
(1156, 'Google Swiffy'),
(1157, 'Google Webmaster Central'),
(1158, 'Google Website Optimizer'),
(1159, 'GoToMyPC'),
(1160, 'GPRS'),
(1161, 'GPS Development'),
(1162, 'Gradle'),
(1163, 'Graph Databases'),
(1164, 'Graphics Programming'),
(1165, 'Grasshopper Virtual Phone'),
(1166, 'Gravity Forms'),
(1167, 'Greek'),
(1168, 'Greenline VeriFIX'),
(1169, 'Greenplum'),
(1170, 'Groovy'),
(1171, 'GruntJS'),
(1172, 'GTK+'),
(1173, 'GUI Design'),
(1174, 'Guitar Composition'),
(1175, 'Guitar Performance'),
(1176, 'Google Web Toolkit'),
(1177, 'HAML'),
(1178, 'haproxy'),
(1179, 'Hardware Troubleshooting'),
(1180, 'Haitian Creole'),
(1181, 'HaXe'),
(1182, 'HBase'),
(1183, 'headus UVLayout'),
(1184, 'Health Level 7'),
(1185, 'Hebrew'),
(1186, 'Helpdesk'),
(1187, 'Heroku'),
(1188, 'hi5'),
(1189, 'Hibernate'),
(1190, 'Highcharts'),
(1191, 'Hindi'),
(1192, 'History'),
(1193, 'Home Automation'),
(1194, 'Home Design'),
(1195, 'HootSuite'),
(1196, 'Hospitality'),
(1197, 'HotDog'),
(1198, 'Houdini'),
(1199, 'HP Cloud'),
(1200, 'HP Network Management Center HPNMC'),
(1201, 'HP QuickTest Professional HPQTP'),
(1202, 'HP Quality Center'),
(1203, 'HP UX'),
(1204, 'HP UX Administration'),
(1205, 'HR Benefits'),
(1206, 'Human Resource Information Systems'),
(1207, 'HRM'),
(1208, 'HubSpot'),
(1209, 'Human Resource Management'),
(1210, 'Human Sciences'),
(1211, 'Humor Writing'),
(1212, 'Hungarian'),
(1213, 'HVAC System Design'),
(1214, 'Hardware Prototyping'),
(1215, 'Hybris'),
(1216, 'Oracle Hyperion Planning'),
(1217, 'Hypnosis'),
(1218, 'IBATIS'),
(1219, 'IBM DB2 Administration'),
(1220, 'IBM DB2 Programming'),
(1221, 'IBM Lotus Notes Traveler'),
(1222, 'IBM Lotus Symphony'),
(1223, 'IBM PowerPC Programming'),
(1224, 'IBM System p'),
(1225, 'IBM Rational Rose'),
(1226, 'IBM SameTime'),
(1227, 'IBM SmartCloud'),
(1228, 'IBM SPSS'),
(1229, 'IBM System Storage'),
(1230, 'IBM Tivoli Framework'),
(1231, 'IBM Watson'),
(1232, 'IBM WebSphere'),
(1233, 'IBM System x'),
(1234, 'IBM zVM Administration'),
(1235, 'ICD Coding'),
(1236, 'Icefaces'),
(1237, 'IClone'),
(1238, 'Icon Design'),
(1239, 'IContact'),
(1240, 'IdeaBlade DevForce'),
(1241, 'IDRISI'),
(1242, 'ifbyphone Administration'),
(1243, 'ifbyphone API Development'),
(1244, 'Internet Information Services IIS'),
(1245, 'Illustration'),
(1246, 'IMacros'),
(1247, 'Image Editing'),
(1248, 'Image Processing'),
(1249, 'Imaging'),
(1250, 'Immigration Law'),
(1251, 'IMS'),
(1252, 'In Game Advertising'),
(1253, 'Inbound marketing'),
(1254, 'Indexing'),
(1255, 'Indonesian'),
(1256, 'Industrial design'),
(1257, 'Industrial Engineering'),
(1258, 'Infographics'),
(1259, 'Informatica'),
(1260, 'Information Architecture'),
(1261, 'Information Builders WebFOCUS'),
(1262, 'Information design'),
(1263, 'Information Management'),
(1264, 'Information Security'),
(1265, 'informatique'),
(1266, 'Informix Administration'),
(1267, 'Informix Programming'),
(1268, 'Infragistics'),
(1269, 'Infusionsoft Administration'),
(1270, 'Infusionsoft Development'),
(1271, 'InfusionSoft Marketing'),
(1272, 'Ingress'),
(1273, 'ingress filtering'),
(1274, 'Inkscape'),
(1275, 'Inno Setup'),
(1276, 'Instagram API'),
(1277, 'Instagram Marketing'),
(1278, 'Installer Development'),
(1279, 'InstallShield'),
(1280, 'Instructional design'),
(1281, 'Instrumentation'),
(1282, 'Insurance Consulting'),
(1283, 'Integrated Circuits'),
(1284, 'Intellectual Property Law'),
(1285, 'IntelliCred'),
(1286, 'IntelliJ IDEA'),
(1287, 'Interaction design'),
(1288, 'Interactive Voice Response'),
(1289, 'InterBase'),
(1290, 'Interior design'),
(1291, 'Internal Auditing'),
(1292, 'International Law'),
(1293, 'International taxation'),
(1294, 'Internet research'),
(1295, 'Internet Security'),
(1296, 'internet surveys'),
(1297, 'Interprise Suite ERP'),
(1298, 'interspire'),
(1299, 'Intersystems Cache'),
(1300, 'Interviewing'),
(1301, 'Intranet Architecture'),
(1302, 'Intranet Implementation'),
(1303, 'Intuit Lacerte Tax'),
(1304, 'Intuit QuickBooks'),
(1305, 'Intuit Quicken'),
(1306, 'Inventory Management'),
(1307, 'Investigative Reporting'),
(1308, 'Investment Research'),
(1309, 'Invitation Design'),
(1310, 'Invoicing'),
(1311, 'Ionic Framework'),
(1312, 'iOS Development'),
(1313, 'iPad App Development'),
(1314, 'iPad UI Design'),
(1315, 'iPhone App Development'),
(1316, 'iPhone UI Design'),
(1317, 'IronPython'),
(1318, 'IRM Income Tax Audits'),
(1319, 'ISA Server'),
(1320, 'ISEB'),
(1321, 'Islamic Banking'),
(1322, 'ISO 9000Islamic theology'),
(1323, '>ISO 9001'),
(1324, 'Issue Tracking Systems'),
(1325, 'IT Management'),
(1326, 'Italian'),
(1327, 'iTextSharp'),
(1328, 'ITIL'),
(1329, 'ITK'),
(1330, 'IT Service Management'),
(1331, 'J2EE'),
(1332, 'J2ME'),
(1333, 'J2SE'),
(1334, 'Japanese'),
(1335, 'JasperReports'),
(1336, 'Javanese'),
(1337, 'JAXB'),
(1338, 'JBoss'),
(1339, 'JBoss Seam'),
(1340, 'JBPM'),
(1341, 'JCL'),
(1342, 'Oracle JD Edwards EnterpriseOne'),
(1343, 'JDBC'),
(1344, 'JDeveloper'),
(1345, 'Jenkins'),
(1346, 'JetPack'),
(1347, 'Jewelry Design'),
(1348, 'Jewish Theology'),
(1349, 'JFC'),
(1350, 'Jig and Fixture Design'),
(1351, 'Jimdo'),
(1352, 'Jingle Program Production'),
(1353, 'Jinja2'),
(1354, 'JMeter'),
(1355, '>JMS'),
(1356, 'JNCIA Junos'),
(1357, 'JNDI'),
(1358, 'Job Costing'),
(1359, 'Job Definition Format JDF'),
(1360, 'Job Description Writing'),
(1361, 'JomSocial Development'),
(1362, 'JOnAS'),
(1363, 'Joomla!'),
(1364, 'Joomla Fabrik'),
(1365, 'Journalism WritingJoomla Migration'),
(1366, 'JPA'),
(1367, 'JQuery Mobile'),
(1368, 'JavaServer Faces JSF'),
(1369, 'Jsharp'),
(1370, 'json'),
(1371, 'JSTL'),
(1372, 'Juniper Routers'),
(1373, 'JUnit'),
(1374, 'Junos'),
(1375, 'Kaizen'),
(1376, 'Kajabi'),
(1377, 'Kaltura'),
(1378, 'Kannada'),
(1379, 'Kendo UI'),
(1380, 'Kentico CMS'),
(1381, 'Kerberos'),
(1382, 'Kerkythea'),
(1383, '>Kernel'),
(1384, 'KeyValue Stores'),
(1385, 'Keyboarding'),
(1386, 'Keynote'),
(1387, 'Kickstarter Marketing'),
(1388, 'Kindle App Development'),
(1389, 'Kindle Fire'),
(1390, 'Kindle Fire Apps'),
(1391, 'KISSMetrics'),
(1392, 'KitchenDraw'),
(1393, 'KiXtart'),
(1394, 'KnockoutJS'),
(1395, 'Kohana'),
(1396, 'Korean'),
(1397, 'Korn shell'),
(1398, 'KVM'),
(1399, 'KVM Switches'),
(1400, 'KVM Virtualization'),
(1401, 'Kyrgyz'),
(1402, 'Label and Package Design'),
(1403, 'LabVIEW'),
(1404, 'LabWindowsCVI'),
(1405, 'LAMP Administration'),
(1406, 'LAN Administration'),
(1407, 'LAN Implementation'),
(1408, 'LANDesk'),
(1409, 'Landing Pages'),
(1410, 'Landscape design'),
(1411, 'Filipino Visayan Dialect'),
(1412, 'Laravel Framework'),
(1413, 'laser engraving'),
(1414, 'Lasso'),
(1415, 'LaTeX'),
(1416, 'Latvian'),
(1417, 'Lean Consulting'),
(1418, 'Lectora'),
(1419, 'Legal Consulting'),
(1420, 'Legal research'),
(1421, 'Legal Transcription'),
(1422, 'Legal Translation'),
(1423, 'Legal writing'),
(1424, 'LemonStand'),
(1425, 'Leptonica'),
(1426, 'LESS'),
(1427, 'Lesson Plan Writing'),
(1428, 'Letter Writing'),
(1429, 'Lettering'),
(1430, 'Level Design'),
(1431, 'LexisNexis Accurint'),
(1432, 'LexisNexis Practice'),
(1433, 'libcurl'),
(1434, 'libGDX'),
(1435, 'LibreOffice'),
(1436, 'Lightwave 3d'),
(1437, 'Linear Programming'),
(1438, 'LimeSurvey'),
(1439, 'LimeJS'),
(1440, 'Lightworks'),
(1441, 'lingo'),
(1442, 'Linguistics'),
(1443, 'Link Wheel'),
(1444, 'LinkedIn Development'),
(1445, 'linq to entities'),
(1446, 'LINQ'),
(1447, 'Linkvana'),
(1448, 'LinkedIn Recruiting'),
(1449, 'linq to sql'),
(1450, 'Slackware Linux'),
(1451, 'Linux System Administration'),
(1452, 'LiquidPlanner'),
(1453, 'Lisp'),
(1454, 'Literature Review'),
(1455, 'Lithium Framework'),
(1456, 'Lithuanian'),
(1457, 'Litigation'),
(1458, 'Live Chat Operator'),
(1459, 'Live Chat Software'),
(1460, 'LivePerson'),
(1461, 'Learning Management System LMS'),
(1462, 'Load Balancing'),
(1463, 'Load testing'),
(1464, 'LoadRunner'),
(1465, 'IBM Lotus Domino'),
(1466, 'Lotus Notes'),
(1467, 'Loyalty Marketing'),
(1468, 'Lua'),
(1469, 'Lucene Search'),
(1470, 'Lyrics Writing'),
(1471, 'm0n0wall'),
(1472, 'Mac OS App Development'),
(1473, 'Mac OSX Administration'),
(1474, 'Macaw'),
(1475, 'Macedonian'),
(1476, 'Machine Design'),
(1477, 'Machine learning'),
(1478, 'MadCap Software'),
(1479, 'Maemo'),
(1480, 'Magazine Layout'),
(1481, 'Magic Bullet Colorista'),
(1482, 'Magic Bullet Looks'),
(1483, 'MailEnable'),
(1484, 'Make Build'),
(1485, 'Makerbot'),
(1486, 'Malay'),
(1487, 'Malayalam'),
(1488, 'Malware'),
(1489, 'ManageEngine'),
(1490, 'Management Consulting'),
(1491, 'Management Development'),
(1492, 'Mandarin'),
(1493, 'Manga'),
(1494, 'Mantis'),
(1495, 'Management Skills'),
(1496, 'Mandarin'),
(1497, 'Manga'),
(1498, 'Mantis'),
(1499, 'Manual Test Execution'),
(1500, 'Manufacturing'),
(1501, 'Manufacturing Design'),
(1502, 'MAPI'),
(1503, 'Mapinfo'),
(1504, 'Maple'),
(1505, 'Mapr'),
(1506, 'MapReduce'),
(1507, 'Marathi'),
(1508, 'Market research'),
(1509, 'Marketing Automation'),
(1510, 'Marketing Cloud Administration'),
(1511, 'Marketing Cloud Development'),
(1512, 'Marketing Cloud Marketing'),
(1513, 'Marketing strategy'),
(1514, 'Marketo'),
(1515, 'Marriage Counseling'),
(1516, 'Martial Arts'),
(1517, 'Master Production Schedule'),
(1518, 'Marketo'),
(1519, 'Marriage Counseling'),
(1520, 'Martial Arts'),
(1521, 'Master Production Schedule'),
(1522, 'Mastercam'),
(1523, 'Materials Engineering'),
(1524, 'MathCad'),
(1525, 'Mathematica'),
(1526, 'Max'),
(1527, 'Maxon BodyPaint 3D'),
(1528, 'Maxon Cinema 4D'),
(1529, 'McAfee ePolicy Orchestrator'),
(1530, 'MCP'),
(1531, 'McAfee SAA'),
(1532, 'McAfee VirusScan'),
(1533, 'Multi Criteria Decision Analysis'),
(1534, 'Mechanical Design'),
(1535, 'Mechanical Engineering'),
(1536, 'Mechatronics'),
(1537, 'Media buying'),
(1538, 'Media relations'),
(1539, 'MediaWiki'),
(1540, 'Medical Billing and Coding'),
(1541, 'Medical Illustration'),
(1542, 'Medical Imaging'),
(1543, 'Medical Informatics'),
(1544, 'Medical Law'),
(1545, 'Medical Records Research'),
(1546, 'Medical transcription'),
(1547, 'Medical Translation'),
(1548, 'Medical Writing'),
(1549, 'Meego Development'),
(1550, 'Menu Design'),
(1551, 'MerchantRun'),
(1552, 'MerchantRun GlobalLink'),
(1553, 'Mercurial'),
(1554, 'Merise'),
(1555, 'MetaTrader 4 MT4'),
(1556, 'Methods Engineering'),
(1557, 'Microsoft Foundation Classes MFC'),
(1558, 'Microcontroller Design'),
(1559, 'Microcontroller Programming'),
(1560, 'Microsoft Access Administration'),
(1561, 'Microsoft Access Programming'),
(1562, 'Microsoft Active Directory'),
(1563, 'Microsoft Business Intelligence Studio'),
(1564, 'Microsoft Certified Information Technology Profess'),
(1565, 'Microsoft Commerce Server'),
(1566, 'Windows Media Connect'),
(1567, 'Microsoft Dynamics Administration'),
(1568, 'Microsoft Dynamics CRM'),
(1569, 'Microsoft Dynamics Development'),
(1570, 'Microsoft Dynamics ERP'),
(1571, '>Microsoft Entity Framework'),
(1572, 'Microsoft Hyper V Server'),
(1573, 'Microsoft Lync Server'),
(1574, 'Microsoft PowerPoint'),
(1575, 'Microsoft Project'),
(1576, 'Microsoft Publisher'),
(1577, 'Microsoft SCVMM'),
(1578, 'Microsoft Server'),
(1579, 'Microsoft SharePoint Administration'),
(1580, 'Microsoft SharePoint Development'),
(1581, 'Microsoft Silverlight'),
(1582, 'Microsoft Small Business Server Administration'),
(1583, 'Microsoft SQL CE'),
(1584, 'Microsoft SQL Server Administration'),
(1585, 'Microsoft SQL Server Programming'),
(1586, 'Microsoft SQL Server Notification Services'),
(1587, 'Microsoft SQL Server Service Broker'),
(1588, 'Microsoft SQL SSAS'),
(1589, 'Microsoft SQL SSRS'),
(1590, 'Microsoft Transaction Server MTS'),
(1591, 'Microsoft Virtual Server'),
(1592, 'Microsoft Visio'),
(1593, 'Visual Basic'),
(1594, 'Microsoft Visual C++'),
(1595, 'Microsoft Visual Studio'),
(1596, 'Microsoft Windows Powershell'),
(1597, 'Microsoft Windows Server'),
(1598, 'Microsoft Word'),
(1599, 'Microstration v8'),
(1600, 'Microstock Photography'),
(1601, 'MicroStrategy'),
(1602, 'MIDI'),
(1603, 'Mikrotik RouterBOARD'),
(1604, 'Mikrotik RouterOS'),
(1605, 'Mind Mapping'),
(1606, 'MindTouch'),
(1607, 'Minecraft'),
(1608, 'Mining Engineering'),
(1609, 'Minitab'),
(1610, 'Miva Merchant'),
(1611, 'Mixpanel'),
(1612, 'MLS Consulting'),
(1613, 'mobi'),
(1614, 'Mobile Advertising'),
(1615, 'Mobile App Development'),
(1616, 'Mobile App Testing'),
(1617, 'Mobile Development Framework'),
(1618, 'Mobile Programming'),
(1619, 'Mobile UI Design'),
(1620, 'Modul8'),
(1621, 'MODx'),
(1622, 'Molecule Editors'),
(1623, 'Mongrel'),
(1624, 'Mono'),
(1625, 'Moonfruit SiteMaker'),
(1626, 'MoonScript'),
(1627, 'moraeMootools'),
(1628, 'Microsoft Office SharePoint Server'),
(1629, 'Motion graphics'),
(1630, 'MovableTypeMotivational Speaking'),
(1631, 'Mozenda Scraper'),
(1632, 'MPD'),
(1633, 'Multiprotocol Label Switching MPLS'),
(1634, 'MQL 4'),
(1635, 'Multi Router Traffic Grapher MRTG'),
(1636, 'MS DOS Administration'),
(1637, 'MS Office 365'),
(1638, 'Microsoft Visual Studio LightSwitch'),
(1639, 'Microsoft adCenter'),
(1640, 'mtek'),
(1641, 'Multi Level Marketing MLM'),
(1642, 'Multi touch Hardware Development'),
(1643, 'Multi touch Hardware Programming'),
(1644, 'Multithreaded Programming'),
(1645, 'Murals'),
(1646, 'Music'),
(1647, 'Music Arrangement'),
(1648, 'Musical composition'),
(1649, 'Music Dubbing'),
(1650, 'Music engraving'),
(1651, 'Music Producing'),
(1652, 'MVC Framework'),
(1653, 'Model View ViewModel MVVT'),
(1654, 'MXML'),
(1655, 'MYOB Administration'),
(1656, 'Myspace MarketingMyspace Marketing'),
(1657, 'Myspace Marketing'),
(1658, 'MySQL Administration'),
(1659, 'Nanotechnology'),
(1660, 'Natural language processing'),
(1661, 'Navigation System Design'),
(1662, 'Navigation System Implementation'),
(1663, 'Negotiation'),
(1664, 'Neo4j'),
(1665, 'NetBeans'),
(1666, 'NetBSD'),
(1667, 'Netezza'),
(1668, 'Netfabb'),
(1669, 'NetSuite'),
(1670, 'Network Engineering'),
(1671, 'Network Monitoring'),
(1672, 'Network Pentesting'),
(1673, 'Network Planning'),
(1674, 'Network Programming'),
(1675, 'Network Security'),
(1676, 'Neuro linguistic programming'),
(1677, 'News Writing Style'),
(1678, 'Newsletter Writing'),
(1679, 'Nexmo'),
(1680, 'Next Limit Maxwell Render'),
(1681, 'Next Limit RealFlow'),
(1682, 'Nextengine'),
(1683, 'NFS Administration'),
(1684, 'NFS Implementation'),
(1685, 'ngcore'),
(1686, 'NHibernate'),
(1687, 'NI Multisim'),
(1688, 'Ning Development'),
(1689, 'Ning Marketing'),
(1690, 'Non disclosure Agreements'),
(1691, 'Non Fiction Writing'),
(1692, 'Non linear editing system'),
(1693, 'NopCommerce'),
(1694, 'Norwegian'),
(1695, 'NoSQL'),
(1696, 'Notary public'),
(1697, 'nservicebusNovell NetWare'),
(1698, 'Nuendo'),
(1699, 'NUKE'),
(1700, 'Nursing'),
(1701, 'Nutrition'),
(1702, 'NVIDIA Mental Ray'),
(1703, 'OAuth'),
(1704, 'Object oriented design'),
(1705, 'Object Oriented PHP'),
(1706, 'Object Pascal'),
(1707, 'Objective C'),
(1708, 'Objective J'),
(1709, 'OCaml'),
(1710, 'Occupational Health'),
(1711, 'OCR algorithms'),
(1712, 'OCR Tesseract'),
(1713, 'GNU Octave'),
(1714, 'OCX'),
(1715, 'ODBC'),
(1716, 'odesk api'),
(1717, 'Odoo'),
(1718, 'Off page Optimization'),
(1719, 'Office Administration'),
(1720, 'OGRE'),
(1721, 'Oil painting'),
(1722, 'OLAP'),
(1723, 'OLE Automation'),
(1724, 'Online Transaction Processing OLTP'),
(1725, 'OmniGraffle'),
(1726, 'On Page Optimization'),
(1727, 'Online Community Management'),
(1728, 'Online Help'),
(1729, 'Online Writing'),
(1730, 'Object Oriented Programming OOP'),
(1731, 'OOPS'),
(1732, 'ooVoo Development'),
(1733, 'OpenOffice'),
(1734, 'OpenACS'),
(1735, 'OpenBravo PoS'),
(1736, 'OpenBSD'),
(1737, 'OpenCL'),
(1738, 'OpenCV'),
(1739, 'openemm'),
(1740, 'OpenERP Administration'),
(1741, 'OpenERP Development'),
(1742, 'Openflow'),
(1743, 'OpenGL'),
(1744, 'OpenGL ES'),
(1745, 'OpenLayers'),
(1746, 'OpenSIPS'),
(1747, 'OpenSocial'),
(1748, 'openSUSE'),
(1749, 'opentext'),
(1750, 'OpenTok Development'),
(1751, 'OpenType'),
(1752, 'OpenVBX'),
(1753, 'OpenVMS'),
(1754, 'OpenVPN'),
(1755, 'OpenVZ'),
(1756, 'OpenWrt'),
(1757, 'OpenX'),
(1758, 'Operating Systems Development'),
(1759, 'Operations Management'),
(1760, 'Operations Research'),
(1761, 'Optimizely'),
(1762, 'Optimizepress'),
(1763, 'Optimizepress'),
(1764, 'Oracle Agile'),
(1765, 'Oracle APEX'),
(1766, 'Oracle Application Framework'),
(1767, 'Oracle Application Server'),
(1768, 'Oracle ATG Web Commerce'),
(1769, 'Oracle BRM'),
(1770, 'Oracle Complex Events Processing'),
(1771, 'Oracle CRM On Demand'),
(1772, 'Oracle Data Guard'),
(1773, 'Oracle Database Administration<'),
(1774, 'Oracle Demantra'),
(1775, 'Oracle E Business Suite'),
(1776, 'Oracle Endeca'),
(1777, 'Oracle Enterprise Service Bus'),
(1778, 'Oracle Financials Applications'),
(1779, 'Oracle Forms'),
(1780, 'Oracle Fusion Applications'),
(1781, 'Oracle Fusion Middleware'),
(1782, 'Oracle Global Trade Management'),
(1783, 'Oracle Java EE'),
(1784, 'Orace OBIEE Plus'),
(1785, 'Oracle Patching'),
(1786, 'oracle performance tuning'),
(1787, 'Oracle PLSQL'),
(1788, 'Oracle Policy Automation'),
(1789, 'Oracle Primavera'),
(1790, 'Oracle Programming'),
(1791, 'Oracle Real Application Clusters RAC'),
(1792, 'Oracle Reports'),
(1793, 'Oracle RightNow'),
(1794, 'Oracle Siebel'),
(1795, 'Oracle SOA Suite'),
(1796, 'Oracle Sun Ray'),
(1797, 'Oracle Taleo'),
(1798, 'Oracle Team Productivity Center'),
(1799, 'Oracle Transportation Management'),
(1800, 'Oracle Universal Content Management'),
(1801, 'Oracle Unified Method'),
(1802, 'Oracle Upgrade'),
(1803, 'OrangeCRM'),
(1804, 'OrCAD'),
(1805, 'Orchard CMS'),
(1806, 'Order Entry'),
(1807, 'Order processing'),
(1808, 'Organizational Behavior'),
(1809, 'Organizational Development'),
(1810, 'ORM'),
(1811, 'ORMLite'),
(1812, 'OS2'),
(1813, 'osclass'),
(1814, 'OSGi'),
(1815, 'OSPF'),
(1816, 'Outbound Sales'),
(1817, 'P CAD'),
(1818, 'Packaging Design'),
(1819, 'Paint.NET'),
(1820, 'Palm'),
(1821, 'Palm App Development'),
(1822, 'Panoramic Stitching'),
(1823, 'Papercraft'),
(1824, 'Papervision3D'),
(1825, 'Paralegal'),
(1826, 'Parallels Virtual Desktop'),
(1827, 'Pardot Administration'),
(1828, 'Pardot Development'),
(1829, 'Pardot Marketing'),
(1830, 'Parse Mobile App Platform'),
(1831, 'ParticleIllusion'),
(1832, 'Pascal'),
(1833, 'Pashto'),
(1834, 'Patent Law'),
(1835, 'Pattern recognition'),
(1836, 'Pay per click'),
(1837, 'Payment Gateway Integration'),
(1838, 'Payment Processing'),
(1839, 'PayPal Development'),
(1840, 'Paypal Integration'),
(1841, 'Payroll Processing'),
(1842, 'PBwiki'),
(1843, 'PBworks Development'),
(1844, 'PCAP'),
(1845, 'PeopleCode'),
(1846, 'Oracle Peoplesoft Administration'),
(1847, 'Oracle Peoplesoft Development'),
(1848, 'Perforce'),
(1849, 'Performance testing'),
(1850, 'Performance Tuning'),
(1851, 'Performing arts'),
(1852, 'Perl Catalyst'),
(1853, 'Perl Mojolicious'),
(1854, 'PerlDancer'),
(1855, 'Persian'),
(1856, 'Personal Development'),
(1857, 'Pervasive Software'),
(1858, 'PESTEL'),
(1859, 'Petroleum Engineering'),
(1860, 'PfSense'),
(1861, 'Phing'),
(1862, 'Phone Support'),
(1863, 'Photo Editing'),
(1864, 'Photo Manipulation'),
(1865, 'Photo Retouching'),
(1866, 'Photograph Color Correction'),
(1867, 'PhotoScape'),
(1868, 'PhpBB'),
(1869, 'phpfox'),
(1870, 'phpMyAdmin'),
(1871, 'phpMyDirectory'),
(1872, 'PHP Nuke'),
(1873, 'Physical Fitness'),
(1874, 'Physics'),
(1875, 'Piano Composition'),
(1876, 'Piano Performance'),
(1877, 'Pig'),
(1878, 'Pinnacle Studio'),
(1879, 'Pixologic Zbrush'),
(1880, 'Platform Migration'),
(1881, 'Play Framework'),
(1882, 'PLC SCADA'),
(1883, 'PLC Programming'),
(1884, 'Plesk'),
(1885, 'Pligg'),
(1886, 'Plivo'),
(1887, 'Plone'),
(1888, 'Plumbing'),
(1889, 'PMDS'),
(1890, 'Pocket PC'),
(1891, 'Podio'),
(1892, 'Poetry'),
(1893, 'Policy Writing'),
(1894, 'Polish'),
(1895, 'Polymer Clay Sculpting'),
(1896, 'Pomodoro Technique'),
(1897, 'Portrait Painting'),
(1898, 'Portfolio Performance Modeling'),
(1899, 'Portlets'),
(1900, 'Portuguese'),
(1901, 'POS Terminal Development'),
(1902, 'Poser'),
(1903, 'Poster Design'),
(1904, 'Posterous'),
(1905, 'Postfix SMTP Server'),
(1906, 'PostgreSQL Administration'),
(1907, 'PostgreSQL Programming'),
(1908, 'PostScript'),
(1909, 'Power Builder'),
(1910, 'Windows PowerShell'),
(1911, 'Pay Per Click Advertising'),
(1912, 'PRADO PHP Framework'),
(1913, 'Prepress'),
(1914, 'Predictive Analytics'),
(1915, 'Presentation Design'),
(1916, 'Presentations'),
(1917, 'PreSonus Studio One'),
(1918, 'Press Advertising'),
(1919, 'Press Release Writing'),
(1920, 'Prezi'),
(1921, 'PrimeFaces'),
(1922, 'Print Advertising'),
(1923, 'Print design'),
(1924, 'Print Layout Design'),
(1925, 'Privacy'),
(1926, 'Private Clouds'),
(1927, 'Process architecture'),
(1928, 'Process improvement'),
(1929, 'Processing'),
(1930, 'Product Descriptions'),
(1931, 'Product Development'),
(1932, 'Product Liability'),
(1933, 'Product management'),
(1934, 'Pro E'),
(1935, 'Program Management'),
(1936, 'Project management'),
(1937, 'Project Management professional'),
(1938, 'Project Planning'),
(1939, 'Project Scheduling'),
(1940, 'Prolog'),
(1941, 'Propellerhead Reason'),
(1942, 'Property Development'),
(1943, 'Property Management'),
(1944, 'Property Tax'),
(1945, 'Proposal Writing'),
(1946, 'ProTools'),
(1947, 'Protoshare'),
(1948, 'Prototype Javascript Framework'),
(1949, 'PSD to MailChimp'),
(1950, 'PSD to Wordpress'),
(1951, 'PSD to XHTML'),
(1952, 'PSD2CMS'),
(1953, 'PSPICE'),
(1954, 'Psychometric Examination'),
(1955, 'PTC Creo ElementsPro'),
(1956, 'PTGui'),
(1957, 'PSPICE'),
(1958, 'Psychometric Examination'),
(1959, 'PTC Creo ElementsPro'),
(1960, 'PTGui'),
(1961, 'Public Relations'),
(1962, 'Public speaking'),
(1963, 'Publishing Fundamentals'),
(1964, 'Punch Home Design Studio Pro'),
(1965, 'punching'),
(1966, 'Punjabi'),
(1967, 'Puppet Administration'),
(1968, 'Purchasing Management'),
(1969, 'Pure Data'),
(1970, 'Pyjamas'),
(1971, 'Pylons'),
(1972, 'PyQt'),
(1973, 'pyro'),
(1974, 'Python Numpy'),
(1975, 'Python SciPy'),
(1976, 'Q'),
(1977, 'Quality of Service Q oS'),
(1978, 'QA Engineering'),
(1979, 'Qcodo'),
(1980, 'QGIS'),
(1981, 'qhse'),
(1982, 'QlikTech QlikView'),
(1983, 'Qmail'),
(1984, 'QNX'),
(1985, 'Qooxdoo'),
(1986, 'QS Cad'),
(1987, 'Qt'),
(1988, 'Qualitative Research'),
(1989, 'Quantitative Analysis'),
(1990, 'Quantity Surveying'),
(1991, 'Quark Xpress'),
(1992, 'quartz'),
(1993, 'Quartz Composer'),
(1994, 'quick sales system'),
(1995, 'QuickFIX'),
(1996, 'R'),
(1997, 'R Hadoop'),
(1998, 'RabbitMQ'),
(1999, 'Rackspace'),
(2000, 'Rackspace Cloud Servers'),
(2001, 'Radiant CMS'),
(2002, 'Radiant Zemax'),
(2003, 'Radio Broadcasting'),
(2004, 'Radio personality'),
(2005, 'RADIUS'),
(2006, 'RAID Administration'),
(2007, 'Raphael JS'),
(2008, 'Rapid Miner'),
(2009, 'Rapid Prototyping'),
(2010, 'RapidWorks'),
(2011, 'Raspberry Pi'),
(2012, 'Retail Sales Management'),
(2013, 'Razor Template Engine'),
(2014, 'Real Estate Appraisal'),
(2015, 'Real Estate IDX'),
(2016, 'Real Estate Law'),
(2017, 'Real Estate Management'),
(2018, 'Real time stream processing'),
(2019, 'Realbasic'),
(2020, 'Realist Painting'),
(2021, 'Receipt Parsing'),
(2022, 'Receptionist Skills'),
(2023, 'Recipe Writing'),
(2024, 'Recommender Systems'),
(2025, 'Records Management'),
(2026, 'Recruiting'),
(2027, 'Red5'),
(2028, 'Red Hat Administration'),
(2029, 'Redis'),
(2030, 'Redmine'),
(2031, 'Refinery CMS'),
(2032, 'Regression testing'),
(2033, 'Regular Expressions'),
(2034, 'Relational Databases'),
(2035, 'Relationship Management'),
(2036, 'Remote Sensing'),
(2037, 'Remoting'),
(2038, 'report writing'),
(2039, 'RepRap'),
(2040, 'Reputation Management'),
(2041, 'Requirement Management'),
(2042, 'Requirements analysis'),
(2043, 'Research Papers'),
(2044, 'Resin'),
(2045, 'Resource Description Framework RDF'),
(2046, 'Responsive Web Design'),
(2047, 'Responsys Administration'),
(2048, 'Responsys Development'),
(2049, 'Responsys Marketing'),
(2050, 'REST'),
(2051, 'Resume Writing'),
(2052, 'Retail Merchandising'),
(2053, 'Retail Ops Management'),
(2054, 'RETS'),
(2055, 'Reverse engineering'),
(2056, 'Autodesk Revit Architecture'),
(2057, 'RFID'),
(2058, 'Red Hat Certified Engineer RHCE'),
(2059, 'Red Hat Enterprise Linux RHEL'),
(2060, 'Rhinoceros 3D'),
(2061, 'RhinoScript'),
(2062, 'Rhino Service Bus'),
(2063, 'Rhodes Framework'),
(2064, 'Richfaces'),
(2065, 'RightScale'),
(2066, 'Risk management'),
(2067, 'Java Remote Method Invocation Java RMI'),
(2068, 'Robot Framework'),
(2069, 'Robotics'),
(2070, 'Romanian'),
(2071, 'Roomorama API'),
(2072, 'Root Cause Analysis'),
(2073, 'Robotscope'),
(2074, 'Rotoscoping'),
(2075, 'RPG Development'),
(2076, 'RPG OS400'),
(2077, 'RPG Writing'),
(2078, 'RSpec'),
(2079, 'RSS'),
(2080, 'RTL'),
(2081, 'RTLinux'),
(2082, 'RTML'),
(2083, 'RTOS'),
(2084, 'Rational Unified Process RUP'),
(2085, 'Russian Language'),
(2086, 'S'),
(2087, 'SaaS'),
(2088, 'Sassu'),
(2089, 'Sabre'),
(2090, 'Sage ERP Accpac'),
(2091, 'Sage Peachtree Complete Accounting'),
(2092, 'SAI'),
(2093, 'Salary Surveys'),
(2094, 'Sales Letters'),
(2095, 'Sales management'),
(2096, 'Sales Promotion'),
(2097, 'Sales Writing'),
(2098, 'Salesforce Apex'),
(2099, 'Salesforce App Development'),
(2100, 'Salesforce.com'),
(2101, 'Salesgenie.com'),
(2102, 'Samba'),
(2103, 'SAP'),
(2104, 'SAP2000'),
(2105, 'SAP ABAP'),
(2106, 'SAP Analysis'),
(2107, 'SAP BASIS'),
(2108, 'SAP BSP'),
(2109, 'SAP Business Objects'),
(2110, 'SAP BusinessOne'),
(2111, 'SAP CRM'),
(2112, 'SAP ERP'),
(2113, 'SAP ERP HCM'),
(2114, 'SAP AG'),
(2115, 'SAP Hana'),
(2116, 'SAP Logistics Execution'),
(2117, 'SAP Manufacturing Execution'),
(2118, 'SAP Materials '),
(2119, 'SAP NetWeaver'),
(2120, 'SAP Programming'),
(2121, 'SAP SD'),
(2122, 'SAP Solution Manager'),
(2123, 'SAP Sybase Adaptive Server Enterprise'),
(2124, 'SAP Web Dynpro'),
(2125, 'Scientific Research'),
(2126, 'Scientific Writing'),
(2127, 'SCORM'),
(2128, 'scrapebox'),
(2129, 'Scrapy'),
(2130, 'Screenwriting'),
(2131, 'Script.aculo.us'),
(2132, 'Scripting'),
(2133, 'Scripts Utilities'),
(2134, 'Scrum'),
(2135, 'ScrumWorks'),
(2136, 'Sculpting'),
(2137, 'Sculpture'),
(2138, 'SDL Passolo'),
(2139, 'SDL Trados'),
(2140, 'SDLX');
INSERT INTO `skills` (`id_skills`, `skill_name`) VALUES
(2141, 'Section 508 Compliance'),
(2142, 'Security Analysis'),
(2143, 'Security Engineering'),
(2144, 'Security Infrastructure'),
(2145, 'Selenium'),
(2146, 'Selenium WebDriver'),
(2147, 'Selling'),
(2148, 'Search engine marketing SEM'),
(2149, 'Semiconductor'),
(2150, 'Sencha Touch'),
(2151, 'Sencha GXT'),
(2152, 'Sendmail'),
(2153, 'sensable claytrix'),
(2154, 'Sentiment analysis'),
(2155, 'SENuke X'),
(2156, 'Search Engine Optimization SEO'),
(2157, 'SEO Audit'),
(2158, 'SEO Backlinking'),
(2159, 'SEO Keyword Research'),
(2160, 'SEO Writing'),
(2161, 'SEOMoz'),
(2162, 'Sequential Art'),
(2163, 'Serbian'),
(2164, 'Serenic Navigator'),
(2165, 'Serial Port Interfacing'),
(2166, 'Serialization'),
(2167, 'Sermon'),
(2168, 'Service Cloud Administration'),
(2169, 'Service Cloud Development'),
(2170, 'Service Level Management'),
(2171, 'Servlet'),
(2172, 'Servoy'),
(2173, 'Session Description Protocol'),
(2174, 'Microsoft SharePoint Designer<'),
(2175, 'ShiVa3D'),
(2176, 'Shopify Templates'),
(2177, 'Short Story Writing'),
(2178, 'SHOUTcast'),
(2179, 'Sibelius'),
(2180, 'Siemens NX'),
(2181, 'SigmaPlot'),
(2182, 'Silex Framework'),
(2183, 'Simple DirectMedia Layer'),
(2184, 'SimpleDB'),
(2185, 'Simplified Chinese'),
(2186, 'Simulink'),
(2187, 'Sinatra Framework'),
(2188, 'Singing'),
(2189, 'Sinhala'),
(2190, 'SIP'),
(2191, 'SiteBuildIt'),
(2192, 'Sitecore'),
(2193, 'Telerik Sitefinity CMS'),
(2194, 'SiteScope'),
(2195, 'Six Sigma'),
(2196, 'SkaDate'),
(2197, 'Skeleton'),
(2198, 'Sketch'),
(2199, 'Sketching'),
(2200, 'Skype'),
(2201, 'skype development'),
(2202, 'Slogans'),
(2203, 'Slovakian'),
(2204, 'Slovenian'),
(2205, 'Smalltalk'),
(2206, 'SmartFoxServer'),
(2207, 'Smarty'),
(2208, 'SMO'),
(2209, 'SMPP'),
(2210, 'SMS'),
(2211, 'SMS Gateway'),
(2212, 'SMTP'),
(2213, 'SnagIt'),
(2214, 'SNMP'),
(2215, 'Snort'),
(2216, 'SOAP'),
(2217, 'soapUI'),
(2218, 'Social bookmarking'),
(2219, 'Social Media Management'),
(2220, 'Social Media Marketing'),
(2221, 'Social Media Optimization SMO'),
(2222, 'Social Network Administration'),
(2223, 'Social Networking Development'),
(2224, 'SocialEngine'),
(2225, 'Socket Programming'),
(2226, 'Software Debugging'),
(2227, 'Software Defined Networking SDN'),
(2228, 'Software Documentation'),
(2229, 'Software QA Testing'),
(2230, 'Solaris Administration'),
(2231, 'Spring Framework'),
(2232, 'Spring Security'),
(2233, 'SQA'),
(2234, 'SQL Azure'),
(2235, 'SQL CLR'),
(2236, 'SQL Programming'),
(2237, 'SQLite Administration'),
(2238, 'SQLite Programming'),
(2239, 'Sqoop'),
(2240, 'SQR'),
(2241, 'SquareSpace'),
(2242, 'Squid'),
(2243, 'SSH'),
(2244, 'SSI'),
(2245, 'SQL Server Integration Services SSIS'),
(2246, 'SSL'),
(2247, 'STAAD'),
(2248, 'Stakeholder Management'),
(2249, 'Startup Consulting'),
(2250, 'Stata'),
(2251, 'Stationery Design'),
(2252, 'Statistical Computing'),
(2253, 'Statpoint Statgraphics'),
(2254, 'Steinberg Cubase'),
(2255, 'Steinberg WaveLab'),
(2256, 'stenography'),
(2257, 'Stereoscopy'),
(2258, 'Sticker Design'),
(2259, 'Still Life Painting'),
(2260, 'Standard Template Library STL'),
(2261, 'Stock Management'),
(2262, 'Stored Procedure Development'),
(2263, 'Storyboarding'),
(2264, 'Stratasys'),
(2265, 'Strategic planning'),
(2266, 'Stream Processing'),
(2267, 'Stress Management'),
(2268, 'Stripe'),
(2269, 'StrongMail'),
(2270, 'Structural Analysis'),
(2271, 'Structural Engineering'),
(2272, 'Structured Cabling'),
(2273, 'Style Guide Development'),
(2274, 'Subtitling'),
(2275, 'Subversion'),
(2276, 'ugarCRM Development'),
(2277, 'SunGard'),
(2278, 'Supervised learning'),
(2279, 'supervisory skills'),
(2280, 'Supply chain management'),
(2281, 'Survey Design'),
(2282, 'SurveyMonkey'),
(2283, 'Sustainable Energy'),
(2284, 'Apache Subversion SVN'),
(2285, 'Software Configuration Management'),
(2286, 'Swedish'),
(2287, 'Swift'),
(2288, 'Swing'),
(2289, 'SWiSH Max'),
(2290, 'SWT'),
(2291, 'Sybase Programming'),
(2292, 'Symbian Development'),
(2293, 'Syncsort'),
(2294, 'Synopsis Writing'),
(2295, 'Programming'),
(2296, 'Symbian Development'),
(2297, 'Syncsort'),
(2298, 'Synopsis Writing'),
(2299, 'Synthetic Aperture Color Finesse'),
(2300, 'System Administration'),
(2301, 'System Analysis'),
(2302, 'System Automation'),
(2303, 'System Programming'),
(2304, 'Systems Development'),
(2305, 'T Shirt Design'),
(2306, 'Transact SQL'),
(2307, 'Tableau Software'),
(2308, 'Tagalog'),
(2309, 'Talend Open Studio'),
(2310, 'Tally Shoper'),
(2311, 'Tally .ERP'),
(2312, 'Tamil'),
(2313, 'Tapestry'),
(2314, 'TAPI'),
(2315, 'Tastypie'),
(2316, 'Tax Law'),
(2317, 'Tax preparation'),
(2318, 'Taxonomy'),
(2319, 'TclTk'),
(2320, 'TCPIP'),
(2321, 'Teaching Algebra'),
(2322, 'Teaching English'),
(2323, 'Teaching Mathematics'),
(2324, 'Teaching Physics'),
(2325, 'Tealeaf cxImpact'),
(2326, 'TeamViewer'),
(2327, 'technical analysis'),
(2328, 'Technical Documentation'),
(2329, 'Technical Editing'),
(2330, 'Technical Recruiter'),
(2331, 'Technical Support'),
(2332, 'Technical Translation'),
(2333, 'Tekla Structures'),
(2334, 'Telecommunications Engineering'),
(2335, 'Telephone Handling'),
(2336, 'Telerik'),
(2337, 'Telugu'),
(2338, 'Templates'),
(2339, 'Teradata'),
(2340, 'Tesseract'),
(2341, 'Test Automation'),
(2342, 'Test Case Design'),
(2343, 'Test Driven Development'),
(2344, 'TestComplete'),
(2345, 'TestLink'),
(2346, 'TestLodge'),
(2347, 'Testing Framework'),
(2348, 'Testopia'),
(2349, 'Textile Engineering'),
(2350, 'Textpattern'),
(2351, 'Texture Artist'),
(2352, 'Team Foundation Server'),
(2353, 'Thai'),
(2354, 'The Foundry NUKE'),
(2355, 'The Pixel Farm PFTrack'),
(2356, 'Theology'),
(2357, 'TIBCO ActiveMatrix BusinessWorks'),
(2358, 'Trade Law'),
(2359, 'Trade marketing'),
(2360, 'Trade Show Exhibition Design'),
(2361, 'trade2bharat'),
(2362, 'Transaction '),
(2363, 'Translation Armenian English'),
(2364, 'Translation Belarusian English'),
(2365, 'Translation Bengali English'),
(2366, 'Translation Bulgarian English'),
(2367, 'Translation Catalan English'),
(2368, 'Translation Chinese English'),
(2369, 'Translation Croatian English'),
(2370, 'Translation Czech English'),
(2371, 'Translation Danish English'),
(2372, 'Translation Dutch English'),
(2373, 'Translation English Afrikaans'),
(2374, 'Translation English Albanian'),
(2375, 'Translation English Arabic'),
(2376, 'Translation English Armenian'),
(2377, 'Translation Persian English'),
(2378, 'Translation Portuguese English'),
(2379, 'Translation Romanian'),
(2380, 'Translation Polish English'),
(2381, 'Translation Mandarin English'),
(2382, 'Translation Macedonian English'),
(2383, 'Translation Turkish English'),
(2384, 'Translation Ukrainian English'),
(2385, 'Translation Yiddish English'),
(2386, 'Travel Agent<'),
(2387, 'Travel Planning'),
(2388, 'Trusts Estates and Wills'),
(2389, 'Translation Armenian English'),
(2390, 'Translation Belarusian English'),
(2391, 'Translation Bengali English'),
(2392, 'Translation Bulgarian English'),
(2393, 'Translation Catalan English'),
(2394, 'Translation Chinese English'),
(2395, 'Translation Croatian English'),
(2396, 'Translation Czech English'),
(2397, 'Translation Danish English'),
(2398, 'Translation Dutch English'),
(2399, 'Translation English Afrikaans'),
(2400, 'Translation English Albanian'),
(2401, 'Translation English Arabic'),
(2402, 'Translation English Armenian'),
(2403, 'Translation Persian English'),
(2404, 'Translation Portuguese English'),
(2405, 'Triakis VSI'),
(2406, 'Trixbox'),
(2407, 'Tropo'),
(2408, 'Trusts Estates and Wills'),
(2409, 'TSM Administration'),
(2410, 'TSR'),
(2411, 'Tumblr'),
(2412, 'Turbo '),
(2413, 'Turkish'),
(2414, 'TV Broadcasting'),
(2415, 'Twig'),
(2416, 'Twilio API'),
(2417, 'twitter api'),
(2418, 'twitter bootstrap'),
(2419, 'Twitter Marketing'),
(2420, 'TypePad'),
(2421, 'Typesetting'),
(2422, 'Typing'),
(2423, 'TYPO3'),
(2424, 'U.S. Culture'),
(2425, 'Ubercart'),
(2426, 'User interface design'),
(2427, 'Ukrainian'),
(2428, 'Ulead COOL 3D'),
(2429, 'Ubercart'),
(2430, 'User interface design'),
(2431, 'Umbraco'),
(2432, 'UML'),
(2433, 'unbounce'),
(2434, 'Underwriting'),
(2435, 'Unified Threat Management'),
(2436, 'Unify'),
(2437, 'Unify SQLBase'),
(2438, 'Unify Corporation'),
(2439, 'Unit Testing'),
(2440, 'Unity'),
(2441, 'Unix'),
(2442, 'Unix shell'),
(2443, 'Unix System Administration'),
(2444, 'Unreal Engine'),
(2445, 'UnrealScript'),
(2446, 'Urban Design'),
(2447, 'Urdu'),
(2448, 'Usability testing'),
(2449, 'USB Electronics'),
(2450, 'User acceptance testing'),
(2451, 'User Experience Design'),
(2452, 'User&#039;s Guide Writing'),
(2453, 'UV Mapping'),
(2454, 'Vaadin Framework'),
(2455, 'Vagrant'),
(2456, 'Valgrind'),
(2457, 'Varnish Cache'),
(2458, 'VB.NET'),
(2459, 'VBA'),
(2460, 'VBScript'),
(2461, 'vbseo'),
(2462, 'VBulletin'),
(2463, 'vCita'),
(2464, 'VectorWorks'),
(2465, 'Veeam'),
(2466, 'Velocity Template Engine'),
(2467, 'Vendor Management Systems'),
(2468, 'Venture Capital Consulting'),
(2469, 'Verilog  VHDL'),
(2470, 'Version Control'),
(2471, 'Vertica'),
(2472, 'VFX Animation'),
(2473, 'VFX Design'),
(2474, 'VHDL'),
(2475, 'vicidial'),
(2476, 'Video Conversion'),
(2477, 'Video editing'),
(2478, 'Video Post Editing'),
(2479, 'Video production'),
(2480, 'Video Publishing'),
(2481, 'Video Ripping'),
(2482, 'Video Sales Letter'),
(2483, 'Video Streaming'),
(2484, 'Video Upload'),
(2485, 'Videography'),
(2486, 'VIDVOX VDMX'),
(2487, 'Vietnamese'),
(2488, 'Vim'),
(2489, 'Violin Composition'),
(2490, 'Violin Performance'),
(2491, 'Viral marketing'),
(2492, 'Virtual Currency'),
(2493, 'Virtual Machine'),
(2494, 'Virtual Private Server VPS'),
(2495, 'Virtualization'),
(2496, 'VirtueMart'),
(2497, 'Virtuoso'),
(2498, 'virus removal'),
(2499, 'isual Arts'),
(2500, 'Visual Dataflex'),
(2501, 'Visual FoxPro'),
(2502, 'Vizrt'),
(2503, 'VKontakte API'),
(2504, 'VLookup Tables'),
(2505, 'VLSI'),
(2506, 'Voice Talent'),
(2507, 'VoiceXML'),
(2508, 'VOIP Administration'),
(2509, 'Voldemort'),
(2510, 'Volleyball'),
(2511, 'volusion'),
(2512, 'VPN'),
(2513, 'V Ray'),
(2514, 'Virtual storage access method VSAM'),
(2515, 'VSS'),
(2516, 'vtiger Adminstration'),
(2517, 'vtiger Development'),
(2518, 'VTK'),
(2519, 'Vugen Scripting'),
(2520, 'Vulnerability assessment'),
(2521, 'VxWorks'),
(2522, 'W3C Widget API'),
(2523, 'WAMP'),
(2524, 'WAN'),
(2525, 'WAN Optimization'),
(2526, 'Wardrobe Styling'),
(2527, 'Watercolor Painting'),
(2528, 'Wave Accounting'),
(2529, 'Windows Communication Foundation WCF'),
(2530, 'Web Analytics'),
(2531, 'Web Host Manager'),
(2532, 'Web Hosting'),
(2533, 'Palm webOS Application Development'),
(2534, 'Web Programming'),
(2535, 'Web Services'),
(2536, 'Web Services Development'),
(2537, 'Web Testing'),
(2538, 'WebApp Pentesting'),
(2539, 'webeeh'),
(2540, 'webERP'),
(2541, 'Webflow'),
(2542, 'WebGL'),
(2543, 'Webisode Presentation'),
(2544, 'Webisode Production'),
(2545, 'Oracle WebLogic'),
(2546, 'WebRTC'),
(2547, 'Website Analytics'),
(2548, 'Website Baker'),
(2549, 'Website Development'),
(2550, 'Website Prototyping'),
(2551, 'Website Wireframing'),
(2552, 'Weebly'),
(2553, 'Weka'),
(2554, 'Welding'),
(2555, 'Welsh'),
(2556, 'Westlaw'),
(2557, 'White Paper Writing'),
(2558, 'Whiteboard Animation'),
(2559, 'WebHost Manager WHM'),
(2560, 'WHMCS Development'),
(2561, 'Wi Fi'),
(2562, 'Wi Fi'),
(2563, 'Wikipedia'),
(2564, 'Wilcom Embroidery Digitization'),
(2565, 'Wilcom Embroidery Digitization'),
(2566, 'WiMAX'),
(2567, 'Win32 App Development'),
(2568, 'WinAutomation'),
(2569, 'Wind Power Consulting'),
(2570, 'WinDev'),
(2571, 'WinDev Mobile'),
(2572, 'Windows 7 Administration'),
(2573, 'Windows 8 Administration'),
(2574, 'Windows 8 App Development'),
(2575, 'Windows Administration'),
(2576, 'Windows App Development'),
(2577, 'Microsoft Windows Azure'),
(2578, 'Windows Forms Development'),
(2579, 'microsoft windows media connect'),
(2580, 'Windows Mobile'),
(2581, 'Microsoft Windows Movie Maker'),
(2582, 'Windows NT Administration'),
(2583, 'Windows Phone'),
(2584, 'Microsoft Windows Phone 7 App Development'),
(2585, 'Windows Vista'),
(2586, 'Microsoft Windows Workflow Foundation'),
(2587, 'Windows XP Administration'),
(2588, 'WinRunner'),
(2589, 'Winsock'),
(2590, 'Wireframing'),
(2591, 'Wireless Network Implementation'),
(2592, 'Wireless Security'),
(2593, 'WiX'),
(2594, 'WML Script'),
(2595, 'Word of Mouth'),
(2596, 'Word processing'),
(2597, 'Wordfast'),
(2598, 'Wordperfect'),
(2599, 'Wordpress Plugi'),
(2600, 'Worketc'),
(2601, 'Workforce Management'),
(2602, 'Workshop Facilities'),
(2603, 'Worldbuilding'),
(2604, 'Worldspan'),
(2605, 'Wowza Media Server'),
(2606, 'WordPress e Commerce'),
(2607, 'Windows Presentation Foundation WPF'),
(2608, 'Wrap Advertising'),
(2609, 'Writing'),
(2610, 'Slang style Writing'),
(2611, 'Wu'),
(2612, 'Xactimate'),
(2613, 'Xamarin'),
(2614, 'WxWidgets'),
(2615, 'X Cart'),
(2616, 'X86 assembly language'),
(2617, 'XAML'),
(2618, 'XAMPP'),
(2619, 'Xara Xtreme'),
(2620, 'Xbox'),
(2621, 'SAP Xcelsius'),
(2622, 'Xen Cloud Platform'),
(2623, 'Xen Hypervisor'),
(2624, 'XenForo'),
(2625, 'Xero'),
(2626, 'XHTML'),
(2627, 'Xilinx'),
(2628, 'Xlinesoft PHPRunner'),
(2629, 'XML RPC'),
(2630, 'xml web services'),
(2631, 'XMPP'),
(2632, 'XOOPS'),
(2633, 'XPath'),
(2634, 'XQuery'),
(2635, 'XRumer'),
(2636, 'XSD'),
(2637, 'XSL'),
(2638, 'XSLT'),
(2639, 'XUL'),
(2640, 'Yahoo! Advertising Solutions'),
(2641, 'Yahoo Developer Skills'),
(2642, 'Yahoo! Merchant Solutions'),
(2643, 'Yahoo! Messenger'),
(2644, 'Yahoo! Query Language'),
(2645, 'Yahoo! Search Marketing'),
(2646, 'Yahoo! Store'),
(2647, 'YAML'),
(2648, 'Yandex API'),
(2649, 'Yandex MatrixNet'),
(2650, 'Yoga'),
(2651, 'Yola'),
(2652, 'YouTube Development'),
(2653, 'YouTube Marketing'),
(2654, 'YUI Library'),
(2655, 'Zabbix'),
(2656, 'zapier'),
(2657, 'Zaxwerks'),
(2658, 'Zend Framework'),
(2659, 'Zend Studio'),
(2660, 'Zendesk'),
(2661, 'Zendesk API Development'),
(2662, 'Zennolab ZennoPoster'),
(2663, 'Zillow Marketing'),
(2664, 'Zimbra Administration'),
(2665, 'Zimbra Development'),
(2666, 'ZK'),
(2667, 'Zoho Creator'),
(2668, 'Zoho CRM'),
(2669, 'zoomla'),
(2670, 'Zope'),
(2671, 'Zurb Foundation'),
(2672, 'Google Sketchup'),
(2673, 'MEAN'),
(2674, 'Craigslist Adposting'),
(2675, 'Rust'),
(2676, 'threejs'),
(2677, 'Amazon Lightsail');

-- --------------------------------------------------------

--
-- Structure de la table `stripe_customerdetail`
--

DROP TABLE IF EXISTS `stripe_customerdetail`;
CREATE TABLE `stripe_customerdetail` (
  `sr` int(255) NOT NULL,
  `belongsTo` int(11) NOT NULL,
  `stripeObject` longtext COLLATE utf8_bin NOT NULL,
  `stripeCustomerID` varchar(255) COLLATE utf8_bin NOT NULL,
  `attachedTo` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `stripe_customerdetail`
--

INSERT INTO `stripe_customerdetail` (`sr`, `belongsTo`, `stripeObject`, `stripeCustomerID`, `attachedTo`) VALUES
(20, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9SbCzK3u1Z7ZuL",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1477682792,\n    "currency": null,\n    "default_source": "card_199fz5C3aXjEIlyVDXRGTqpt",\n    "delinquent": false,\n    "description": "asda asdasd - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_199fz5C3aXjEIlyVDXRGTqpt",\n                "object": "card",\n                "address_city": "asdsa",\n                "address_country": null,\n                "address_line1": "asd32",\n                "address_line1_check": "pass",\n                "address_line2": "asdsad",\n                "address_state": null,\n                "address_zip": "12456",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9SbCzK3u1Z7ZuL",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 2,\n                "exp_year": 2017,\n                "fingerprint": "JwrXRbpQcf45MXIv",\n                "funding": "credit",\n                "last4": "4242",\n                "metadata": [],\n                "name": "asda asdasd",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9SbCzK3u1Z7ZuL\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9SbCzK3u1Z7ZuL\\/subscriptions"\n    }\n}', 'cus_9SbCzK3u1Z7ZuL', 40),
(21, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9Sc1YquOlmEAKD",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1477685899,\n    "currency": null,\n    "default_source": "card_199gnsC3aXjEIlyVSGAGjyka",\n    "delinquent": false,\n    "description": "asdsa sdfds - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_199gnsC3aXjEIlyVSGAGjyka",\n                "object": "card",\n                "address_city": "dsfsd",\n                "address_country": null,\n                "address_line1": "adsfdsf",\n                "address_line1_check": "pass",\n                "address_line2": "sdfds",\n                "address_state": null,\n                "address_zip": "dsf",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9Sc1YquOlmEAKD",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 2,\n                "exp_year": 2020,\n                "fingerprint": "JwrXRbpQcf45MXIv",\n                "funding": "credit",\n                "last4": "4242",\n                "metadata": [],\n                "name": "asdsa sdfds",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9Sc1YquOlmEAKD\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9Sc1YquOlmEAKD\\/subscriptions"\n    }\n}', 'cus_9Sc1YquOlmEAKD', 41),
(22, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9b9RM7dAILU1Ca",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1479655321,\n    "currency": null,\n    "default_source": "card_19Hx5hC3aXjEIlyVVby50dNx",\n    "delinquent": false,\n    "description": "Haseeb Test - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_19Hx5hC3aXjEIlyVVby50dNx",\n                "object": "card",\n                "address_city": "rawalpindi",\n                "address_country": null,\n                "address_line1": "test address",\n                "address_line1_check": "pass",\n                "address_line2": "te",\n                "address_state": null,\n                "address_zip": "46000",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9b9RM7dAILU1Ca",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 2,\n                "exp_year": 2018,\n                "fingerprint": "JwrXRbpQcf45MXIv",\n                "funding": "credit",\n                "last4": "4242",\n                "metadata": [],\n                "name": "Haseeb Test",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9b9RM7dAILU1Ca\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9b9RM7dAILU1Ca\\/subscriptions"\n    }\n}', 'cus_9b9RM7dAILU1Ca', 47),
(23, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9b9V3guZOqQr2J",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1479655525,\n    "currency": null,\n    "default_source": "card_19HxC3C3aXjEIlyVzveKqqV0",\n    "delinquent": false,\n    "description": "Haseeb Ur Rehma - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_19HxC3C3aXjEIlyVzveKqqV0",\n                "object": "card",\n                "address_city": "rawalpindi",\n                "address_country": null,\n                "address_line1": "test address",\n                "address_line1_check": "pass",\n                "address_line2": "test",\n                "address_state": null,\n                "address_zip": "46000",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9b9V3guZOqQr2J",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 5,\n                "exp_year": 2019,\n                "fingerprint": "JwrXRbpQcf45MXIv",\n                "funding": "credit",\n                "last4": "4242",\n                "metadata": [],\n                "name": "Haseeb Ur Rehma",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9b9V3guZOqQr2J\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9b9V3guZOqQr2J\\/subscriptions"\n    }\n}', 'cus_9b9V3guZOqQr2J', 48),
(24, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9ec4YsOLxCTTN3",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1480453745,\n    "currency": null,\n    "default_source": "card_19LIj6C3aXjEIlyVBfjF0rny",\n    "delinquent": false,\n    "description": "Haseeb Haseeb - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_19LIj6C3aXjEIlyVBfjF0rny",\n                "object": "card",\n                "address_city": "Islamabad",\n                "address_country": null,\n                "address_line1": "tesssssst adddddreess",\n                "address_line1_check": "pass",\n                "address_line2": "Haseeb",\n                "address_state": null,\n                "address_zip": "44000",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9ec4YsOLxCTTN3",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 2,\n                "exp_year": 2017,\n                "fingerprint": "JwrXRbpQcf45MXIv",\n                "funding": "credit",\n                "last4": "4242",\n                "metadata": [],\n                "name": "Haseeb Haseeb",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9ec4YsOLxCTTN3\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9ec4YsOLxCTTN3\\/subscriptions"\n    }\n}', 'cus_9ec4YsOLxCTTN3', 52),
(25, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9esuJVS0Y6wDHN",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1480516351,\n    "currency": null,\n    "default_source": null,\n    "delinquent": false,\n    "description": "  - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esuJVS0Y6wDHN\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esuJVS0Y6wDHN\\/subscriptions"\n    }\n}', 'cus_9esuJVS0Y6wDHN', 57),
(26, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9esugBuHcRBnVT",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1480516359,\n    "currency": null,\n    "default_source": null,\n    "delinquent": false,\n    "description": "  - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esugBuHcRBnVT\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esugBuHcRBnVT\\/subscriptions"\n    }\n}', 'cus_9esugBuHcRBnVT', 58),
(27, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9esuzjLasKYjey",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1480516397,\n    "currency": null,\n    "default_source": null,\n    "delinquent": false,\n    "description": "Haseeb Ur Rehma - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esuzjLasKYjey\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esuzjLasKYjey\\/subscriptions"\n    }\n}', 'cus_9esuzjLasKYjey', 59),
(28, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9esz6WKY0zuG3e",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1480516656,\n    "currency": null,\n    "default_source": "card_19LZDGC3aXjEIlyVa44pNS03",\n    "delinquent": false,\n    "description": "Haseeb Ur Rehma - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_19LZDGC3aXjEIlyVa44pNS03",\n                "object": "card",\n                "address_city": "Islamabad",\n                "address_country": null,\n                "address_line1": "test",\n                "address_line1_check": "pass",\n                "address_line2": "dfg",\n                "address_state": null,\n                "address_zip": "44000",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9esz6WKY0zuG3e",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 2,\n                "exp_year": 2017,\n                "fingerprint": "P1jySqVjoseAwIfT",\n                "funding": "debit",\n                "last4": "5564",\n                "metadata": [],\n                "name": "Haseeb Ur Rehma",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9esz6WKY0zuG3e\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9esz6WKY0zuG3e\\/subscriptions"\n    }\n}', 'cus_9esz6WKY0zuG3e', 60),
(29, 18, 'Stripe\\Customer JSON: {\n    "id": "cus_9et3b0FnBdFngB",\n    "object": "customer",\n    "account_balance": 0,\n    "created": 1480516905,\n    "currency": null,\n    "default_source": "card_19LZHHC3aXjEIlyVTlH5Q5Rd",\n    "delinquent": false,\n    "description": "Haseeb deb - 18",\n    "discount": null,\n    "email": null,\n    "livemode": false,\n    "metadata": [],\n    "shipping": null,\n    "sources": {\n        "object": "list",\n        "data": [\n            {\n                "id": "card_19LZHHC3aXjEIlyVTlH5Q5Rd",\n                "object": "card",\n                "address_city": "Islamabad",\n                "address_country": null,\n                "address_line1": "teras",\n                "address_line1_check": "pass",\n                "address_line2": "asdsa",\n                "address_state": null,\n                "address_zip": "44000",\n                "address_zip_check": "pass",\n                "brand": "Visa",\n                "country": "US",\n                "customer": "cus_9et3b0FnBdFngB",\n                "cvc_check": "pass",\n                "dynamic_last4": null,\n                "exp_month": 2,\n                "exp_year": 2018,\n                "fingerprint": "NLQ6H0jolwCCwWBu",\n                "funding": "debit",\n                "last4": "5556",\n                "metadata": [],\n                "name": "Haseeb deb",\n                "tokenization_method": null\n            }\n        ],\n        "has_more": false,\n        "total_count": 1,\n        "url": "\\/v1\\/customers\\/cus_9et3b0FnBdFngB\\/sources"\n    },\n    "subscriptions": {\n        "object": "list",\n        "data": [],\n        "has_more": false,\n        "total_count": 0,\n        "url": "\\/v1\\/customers\\/cus_9et3b0FnBdFngB\\/subscriptions"\n    }\n}', 'cus_9et3b0FnBdFngB', 61);

-- --------------------------------------------------------

--
-- Structure de la table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
CREATE TABLE `timezones` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gmt` varchar(255) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `timezones`
--

INSERT INTO `timezones` (`id`, `name`, `gmt`, `value`) VALUES
(1, 'International Date Line West', 'GMT-12:00', '-12'),
(2, 'Midway Island, Samoa', 'GMT-11:00', '-11'),
(3, 'Hawaii', 'GMT-10:00', '-10'),
(4, 'Alaska', 'GMT-09:00', '-9'),
(5, 'Pacific Time (US & Canada)', 'GMT-08:00', '-8'),
(6, 'Tijuana, Baja California', 'GMT-08:00', '-8'),
(7, 'Arizona', 'GMT-07:00', '-7'),
(8, 'Chihuahua, La Paz, Mazatlan', 'GMT-07:00', '-7'),
(9, 'Mountain Time (US & Canada)', 'GMT-07:00', '-7'),
(10, 'Central America', 'GMT-06:00', '-6'),
(11, 'Central Time (US & Canada)', 'GMT-06:00', '-6'),
(12, 'Guadalajara, Mexico City, Monterrey', 'GMT-06:00', '-6'),
(13, 'Saskatchewan', 'GMT-06:00', '-6'),
(14, 'Bogota, Lima, Quito, Rio Branco', 'GMT-05:00', '-5'),
(15, 'Eastern Time (US & Canada)', 'GMT-05:00', '-5'),
(16, 'Indiana (East)', 'GMT-05:00', '-5'),
(17, 'Atlantic Time (Canada)', 'GMT-04:00', '-4'),
(18, 'Caracas, La Paz', 'GMT-04:00', '-4'),
(19, 'Manaus', 'GMT-04:00', '-4'),
(20, 'Santiago', 'GMT-04:00', '-4'),
(21, 'Newfoundland', 'GMT-03:30', '-3.5'),
(22, 'Brasilia', 'GMT-03:00', '-3'),
(23, 'Buenos Aires, Georgetown', 'GMT-03:00', '-3'),
(24, 'Greenland', 'GMT-03:00', '-3'),
(25, 'Montevideo', 'GMT-03:00', '-3'),
(26, 'Mid-Atlantic', 'GMT-02:00', '-2'),
(27, 'Cape Verde Is.', 'GMT-01:00', '-1'),
(28, 'Azores', 'GMT-01:00', '-1'),
(29, 'Casablanca, Monrovia, Reykjavik', 'GMT+00:00', '0'),
(30, 'Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London', 'GMT+00:00', '0'),
(31, 'Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna', 'GMT+01:00', '1'),
(32, 'Belgrade, Bratislava, Budapest, Ljubljana, Prague', 'GMT+01:00', '1'),
(33, 'Brussels, Copenhagen, Madrid, Paris', 'GMT+01:00', '1'),
(34, 'Sarajevo, Skopje, Warsaw, Zagreb', 'GMT+01:00', '1'),
(35, 'West Central Africa', 'GMT+01:00', '1'),
(36, 'Amman', 'GMT+02:00', '2'),
(37, 'Athens, Bucharest, Istanbul', 'GMT+02:00', '2'),
(38, 'Beirut', 'GMT+02:00', '2'),
(39, 'Cairo', 'GMT+02:00', '2'),
(40, 'Harare, Pretoria', 'GMT+02:00', '2'),
(41, 'Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius', 'GMT+02:00', '2'),
(42, 'Jerusalem', 'GMT+02:00', '2'),
(43, 'Minsk', 'GMT+02:00', '2'),
(44, 'Windhoek', 'GMT+02:00', '2'),
(45, 'Kuwait, Riyadh, Baghdad', 'GMT+03:00', '3'),
(46, 'Moscow, St. Petersburg, Volgograd', 'GMT+03:00', '3'),
(47, 'Nairobi', 'GMT+03:00', '3'),
(48, 'Tbilisi', 'GMT+03:00', '3'),
(49, 'Tehran', 'GMT+03:30', '3.5'),
(50, 'Abu Dhabi, Muscat', 'GMT+04:00', '4'),
(51, 'Baku', 'GMT+04:00', '4'),
(52, 'Yerevan', 'GMT+04:00', '4'),
(53, 'Kabul', 'GMT+04:30', '4.5'),
(54, 'Yekaterinburg', 'GMT+05:00', '5'),
(55, 'Islamabad, Karachi, Tashkent', 'GMT+05:00', '5'),
(56, 'Sri Jayawardenapura', 'GMT+05:30', '5.5'),
(57, 'Chennai, Kolkata, Mumbai, New Delhi', 'GMT+05:30', '5.5'),
(58, 'Kathmandu', 'GMT+05:45', '5.75'),
(59, 'Almaty, Novosibirsk', 'GMT+06:00', '6'),
(60, 'Astana, Dhaka', 'GMT+06:00', '6'),
(61, 'Yangon (Rangoon)', 'GMT+06:30', '6.5'),
(62, 'Bangkok, Hanoi, Jakarta', 'GMT+07:00', '7'),
(63, 'Krasnoyarsk', 'GMT+07:00', '7'),
(64, 'Beijing, Chongqing, Hong Kong, Urumqi', 'GMT+08:00', '8'),
(65, 'Kuala Lumpur, Singapore', 'GMT+08:00', '8'),
(66, 'Irkutsk, Ulaan Bataar', 'GMT+08:00', '8'),
(67, 'Perth', 'GMT+08:00', '8'),
(68, 'Taipei', 'GMT+08:00', '8'),
(69, 'Osaka, Sapporo, Tokyo', 'GMT+09:00', '9'),
(70, 'Seoul', 'GMT+09:00', '9'),
(71, 'Yakutsk', 'GMT+09:00', '9'),
(72, 'Adelaide', 'GMT+09:30', '9.5'),
(73, 'Darwin', 'GMT+09:30', '9.5'),
(74, 'Brisbane', 'GMT+10:00', '10'),
(75, 'Canberra, Melbourne, Sydney', 'GMT+10:00', '10'),
(76, 'Hobart', 'GMT+10:00', '10'),
(77, 'Guam, Port Moresby', 'GMT+10:00', '10'),
(78, 'Vladivostok', 'GMT+10:00', '10'),
(79, 'Magadan, Solomon Is., New Caledonia', 'GMT+11:00', '11'),
(80, 'Auckland, Wellington', 'GMT+12:00', '12'),
(81, 'Fiji, Kamchatka, Marshall Is.', 'GMT+12:00', '12'),
(82, 'Nuku\'alofa', 'GMT+13:00', '13');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` varchar(2) NOT NULL,
  `ctime` int(30) NOT NULL,
  `etime` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `token`
--

INSERT INTO `token` (`id`, `token`, `user`, `status`, `ctime`, `etime`) VALUES
(1, '1577b5235835c05265bc3533402e0927', '3', '1', 1443808645, 1646400645),
(23, '3142f4eedf9b28378b3b6427a509ac2e', '3', '1', 1443824757, 1446416757),
(24, '299d6abe21a795d5f8f50a7bf0991318', '3', '1', 1443824832, 1446416832),
(25, 'ee1e5df0fbc1dad693bbe1849cf5d4ba', '6', '1', 1444150297, 1446742297),
(26, '81f3dc8e29643f3d1a6110b2f7ef00d2', '6', '1', 1444150313, 1446742313),
(27, '9fbe3feb2967ca522b702203ef3c7f0f', '6', '1', 1444150444, 1446742444),
(28, '8b809a1d816f956e396ac5d60589011a', '3', '1', 1444150668, 1446742668),
(29, 'b4cd1a229de8c60d6a8d60015e35e6a0', '3', '1', 1444152452, 1446744452),
(30, '26590fb4a1fecb7ccd069f3474c77009', '6', '1', 1444154236, 1446746236),
(31, 'eba986bfc0a5dba8c0103661cc7132cf', '6', '1', 1444154549, 1446746549),
(32, '2de4eee1f77cc26cf07987e7ca278ee2', '1', '1', 1458918125, 1458928925),
(33, '62ff46102532a8571e2c046a089f5ff5', '1', '1', 1458918156, 1458928956),
(34, 'aaaaad57a2ed51d4ce5afd4817a73fff', '1', '1', 1458919071, 1458929871),
(35, '541d2feea0f14af2eddcf0d7a7656516', '1', '1', 1458919173, 1458929973),
(36, '0564dc4f018046607530cd8fa3f287e7', '1', '1', 1458919208, 1458930008),
(37, 'e1077bd457ff5642acefd4b07de23b36', '1', '1', 1458919263, 1458930063),
(38, '63a54b49a4e5cb6326c893798c29a6d8', '1', '1', 1458919272, 1458930072),
(39, '80cef1ebd7e34be8a71eda845e4d0177', '1', '1', 1458919302, 1458930102),
(40, 'f389b88ff177bb8f8834695e292e0863', '1', '1', 1458919346, 1458930146),
(41, '626cbd58de4f6a1a4e96dced0eb47f18', '1', '1', 1458919400, 1458930200),
(42, '8fe071f57440514ec08a80e7838be104', '1', '1', 1458919913, 1458930713);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(2) NOT NULL,
  `status` varchar(2) NOT NULL,
  `lastlogin` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `type`, `status`, `lastlogin`, `position`, `country`, `phone`) VALUES
(1, 'Administrator', 'admin', 'getupwork@gmail.com', 'bac1a377c236d995f382e338fd56a349', '1', '1', '1489147709.64', '', '', ''),
(8, 'sagar', 'sagar', 'sagar@sagar.me', '41ed44e3038dbeee7d2ffaa7f51d8a4b', '1', '1', '', '', 'all', ''),
(9, 'Arif Hossain', 'arif', 'arif@arif.com', '0ff6c3ace16359e41e37d40b8301d67f', '2', '2', '1459555964.1421', '', '4', ''),
(10, 'jahangir alam', 'jahangir', 'canvasdevelopers@gmail.com', '5fce16e0de0d807a14654c67a7b90405', '2', '2', '', '', 'all', ''),
(11, 'Saikot Hasan', 'saikot', 'saikot@saikot.com', '0f778ebbde65527d348e8193f6129c0f', '1', '1', '', '', 'all', ''),
(12, 'hasan Rahman', 'hasan', 'deshilancer@gmail.com', '258b0812e0ac4d011cb9d9b7072b6c1c', '1', '1', '1470862908.95', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `userpage`
--

DROP TABLE IF EXISTS `userpage`;
CREATE TABLE `userpage` (
  `id` int(5) NOT NULL,
  `section` varchar(20) NOT NULL,
  `page` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ind` int(4) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userpage`
--

INSERT INTO `userpage` (`id`, `section`, `page`, `name`, `ind`, `icon`) VALUES
(26, '18', 'country', 'Country', 1, 'fa-list'),
(27, '16', 'listapi', 'List Api', 1, 'fa-list'),
(28, '19', 'webuser', 'User', 1, 'fa-user'),
(29, '19', 'instagram', 'Social IDs', 2, 'fa-facebook'),
(30, '19', 'fundmangement', 'Fund Management ', 2, 'fa-usd'),
(31, '19', 'contactmanagement', 'Contact Management', 3, '');

-- --------------------------------------------------------

--
-- Structure de la table `userpageaccess`
--

DROP TABLE IF EXISTS `userpageaccess`;
CREATE TABLE `userpageaccess` (
  `id` int(11) NOT NULL,
  `section` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `page` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userpageaccess`
--

INSERT INTO `userpageaccess` (`id`, `section`, `user`, `page`) VALUES
(10, '18', '9', '26'),
(11, '18', '9', '32'),
(12, '16', '9', '27');

-- --------------------------------------------------------

--
-- Structure de la table `usersection`
--

DROP TABLE IF EXISTS `usersection`;
CREATE TABLE `usersection` (
  `id` int(5) NOT NULL,
  `page` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ind` int(4) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usersection`
--

INSERT INTO `usersection` (`id`, `page`, `name`, `ind`, `icon`) VALUES
(16, '', 'Api Developer', 600, ''),
(17, '', 'System Data', 700, ''),
(18, '', 'Common Data', 500, ''),
(19, '', 'User/ID', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `usersectionaccess`
--

DROP TABLE IF EXISTS `usersectionaccess`;
CREATE TABLE `usersectionaccess` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usersectionaccess`
--

INSERT INTO `usersectionaccess` (`id`, `user`, `section`) VALUES
(7, '9', 18);

-- --------------------------------------------------------

--
-- Structure de la table `usersubpage`
--

DROP TABLE IF EXISTS `usersubpage`;
CREATE TABLE `usersubpage` (
  `id` int(5) NOT NULL,
  `page` int(5) NOT NULL,
  `subpage` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `menu` int(1) NOT NULL,
  `ind` int(4) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usersubpage`
--

INSERT INTO `usersubpage` (`id`, `page`, `subpage`, `name`, `menu`, `ind`, `icon`) VALUES
(1, 26, 'lists', 'Country List', 1, 1, 'fa-list'),
(2, 26, 'add', 'Add Country', 1, 2, 'fa-plus'),
(3, 26, 'edit', 'Edit Country', 2, 3, 'fa-edit'),
(4, 26, 'inactive', 'Inactive Country', 1, 4, 'fa-trash'),
(17, 27, 'countrylist', 'country list', 1, 1, 'fa-list'),
(18, 28, 'verified', 'Verified Email', 1, 1, 'fa-user'),
(19, 28, 'notverified', 'Non Verified Email', 1, 2, 'fa-user'),
(20, 29, 'token', 'Active Tokens', 1, 1, 'fa-instagram'),
(21, 29, 'expired', 'Expired Tokens', 1, 2, 'fa-instagram'),
(22, 28, 'activeclient', 'Active Client', 1, 3, 'fa-user'),
(23, 28, 'suspendclient', 'Suspend Client', 1, 4, 'fa-user'),
(24, 28, 'activefreelancer', 'Active Freelancer', 1, 5, 'fa-user'),
(25, 28, 'suspendfreelancer', 'Suspend Freelancer', 1, 6, 'fa-user'),
(26, 30, 'withdawlrequest', 'withdraw request ', 1, 1, 'fa-usd'),
(27, 30, 'billingrequest', 'Billing Request ', 1, 2, 'fa-usd'),
(28, 30, 'transuctionhistory', 'Transaction History ', 1, 3, 'fa-usd'),
(29, 30, 'invoicehourly', 'Failed Transaction Invoices', 1, 4, 'fa-usd'),
(30, 31, 'contactsupport', 'Contact Support', 1, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `usersubpageaccess`
--

DROP TABLE IF EXISTS `usersubpageaccess`;
CREATE TABLE `usersubpageaccess` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `page` varchar(20) NOT NULL,
  `subpage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `usersubpageaccess`
--

INSERT INTO `usersubpageaccess` (`id`, `user`, `page`, `subpage`) VALUES
(20, '9', '26', '1'),
(21, '9', '26', '2'),
(22, '9', '26', '3'),
(23, '9', '26', '4'),
(24, '9', '26', '18'),
(25, '9', '26', '47'),
(26, '9', '32', '33'),
(27, '9', '32', '34'),
(28, '9', '32', '35'),
(29, '9', '32', '36'),
(30, '9', '27', '17');

-- --------------------------------------------------------

--
-- Structure de la table `user_categories`
--

DROP TABLE IF EXISTS `user_categories`;
CREATE TABLE `user_categories` (
  `user_cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `subcat_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user_categories`
--

INSERT INTO `user_categories` (`user_cat_id`, `user_id`, `subcat_id`) VALUES
(17, 18, 2),
(18, 18, 6),
(19, 18, 10),
(20, 18, 12),
(21, 18, 17),
(22, 18, 21),
(23, 18, 24),
(24, 18, 28),
(25, 18, 32),
(26, 18, 34),
(27, 18, 38),
(28, 18, 42),
(29, 18, 44),
(30, 18, 71),
(31, 18, 88),
(35, 22, 1),
(36, 22, 8),
(37, 22, 10),
(38, 22, 11),
(39, 22, 12),
(86, 25, 2),
(109, 26, 2),
(110, 26, 4),
(111, 26, 8),
(112, 26, 9),
(113, 26, 10),
(114, 33, 1),
(115, 33, 2),
(116, 33, 5),
(117, 33, 6),
(118, 33, 9),
(146, 15, 1),
(147, 15, 4),
(148, 15, 9),
(149, 15, 80),
(150, 15, 84),
(156, 13, 1),
(157, 13, 8),
(158, 13, 9),
(159, 13, 11),
(160, 13, 80),
(161, 43, 1),
(162, 43, 3),
(163, 43, 4),
(164, 43, 8),
(165, 43, 9),
(166, 9, 1),
(167, 9, 4),
(168, 9, 9),
(169, 9, 80),
(170, 9, 84);

-- --------------------------------------------------------

--
-- Structure de la table `user_experience`
--

DROP TABLE IF EXISTS `user_experience`;
CREATE TABLE `user_experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `month1` int(5) NOT NULL,
  `year1` int(10) NOT NULL,
  `month2` int(5) NOT NULL,
  `year2` int(10) NOT NULL,
  `curr_working_place` tinyint(2) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user_experience`
--

INSERT INTO `user_experience` (`id`, `user_id`, `company`, `title`, `location`, `month1`, `year1`, `month2`, `year2`, `curr_working_place`, `description`, `status`) VALUES
(9, 13, 'ff', 'Web Design', 'usa', 1, 127, 0, 0, 1, '                                                                                                                                                                                                                                                                                                           Web Design                                                                                                                                                                                                                                                ', 1),
(10, 13, 'Company', 'Title', 'Title', 3, 2016, 10, 2016, 0, '                    Description                ', 1),
(11, 9, 'fgfgf', 'fgfg', 'fgfgf', 2, 2010, 0, 2014, 0, 'ghgthth', 1),
(12, 9, 'Web Design', 'Web Design au', 'usa', 1, 2016, 1, 0, 0, 'Web Design fgfdgh', 1),
(14, 13, 'sdfasdf', 'asdf', 'asdf', 3, 2323, 0, 0, 1, '                    asdfasdf                ', 1),
(16, 33, 'fsdg', 'fgfdg', 'dfhdfg', 1, 2014, 1, 2016, 0, 'sgfdfdgh', 1);

-- --------------------------------------------------------

--
-- Structure de la table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE `webuser` (
  `webuser_id` int(11) NOT NULL,
  `webuser_company` varchar(50) NOT NULL,
  `webuser_fname` varchar(100) NOT NULL,
  `webuser_lname` varchar(100) NOT NULL,
  `webuser_username` varchar(50) NOT NULL,
  `webuser_picture` varchar(200) NOT NULL,
  `cropped_image` longtext,
  `webuser_token` varchar(50) NOT NULL,
  `webuser_email` varchar(100) NOT NULL,
  `webuser_password` varchar(50) NOT NULL,
  `webuser_orpass` varchar(50) NOT NULL,
  `webuser_type` varchar(2) NOT NULL,
  `webuser_status` varchar(2) NOT NULL,
  `webuser_lastlogin` varchar(50) NOT NULL,
  `webuser_position` varchar(50) NOT NULL,
  `webuser_country` varchar(50) NOT NULL,
  `webuser_phone` varchar(30) NOT NULL,
  `webuser_resettoken` varchar(40) NOT NULL,
  `webuser_resetexpire` varchar(30) NOT NULL,
  `webuser_title` varchar(50) NOT NULL,
  `webuser_site` varchar(200) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= active,0=suspend',
  `suspend_reason` int(1) NOT NULL DEFAULT '0'COMMENT
) ;

--
-- Contenu de la table `webuser`
--

INSERT INTO `webuser` (`webuser_id`, `webuser_company`, `webuser_fname`, `webuser_lname`, `webuser_username`, `webuser_picture`, `cropped_image`, `webuser_token`, `webuser_email`, `webuser_password`, `webuser_orpass`, `webuser_type`, `webuser_status`, `webuser_lastlogin`, `webuser_position`, `webuser_country`, `webuser_phone`, `webuser_resettoken`, `webuser_resetexpire`, `webuser_title`, `webuser_site`, `isactive`, `suspend_reason`, `isdelete`, `created`) VALUES
(6, '', 'sabbir', 'sagar', 'sagar', '', NULL, '446519526103930073851339798653', 'sabbir@sagar.me', '845fe25803ec3078dc795ec7187e3fd2', 'sagara1A', '2', '2', '', '', '5', '', '', '1469972500', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(7, '', 'saif', 'uddin', 'saifuddin', '', NULL, 'AwEE1QN4S9Xwlbq4pjsCy1iW2RylNR', 'mail@sagar.me', 'd6a6250c95b4bac0bf7d59a9bd39d473', 'saifuddin1A', '1', '2', '', '', '5', '', '', '1470767890', '', '', 1, 0, 0, '2016-10-18 10:00:00'),
(8, '', 'dasdas', 'dasads', 'sadas', '', NULL, 'aLzJsbmCyr7zCdHEPknfstjZXfr57o', 'asdas@dfssdf.fdsdfs', '091affd8d74560a357a79eaca064bb93', 'sagara1A', '2', '1', '', '', '5', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(9, '', 'Hasan', 'Rahman', 'hasan', 'temp/userimg_157100542218168084502024692625.jpeg', NULL, 'TYtW0TvXMGJB9K978oC6ph2j1L6RhX', 'hafijarrahman@gmail.com', '258b0812e0ac4d011cb9d9b7072b6c1c', 'Mykey2016', '2', '2', '', '', '9', '116576543564675', 'p3YEKaDeicgZ7ggKhyYZetnJW4Hc0B', '1471000246', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(11, '', 'Didar', 'Singh', 'didar084', '', NULL, 'rgA93XrEg9Y3NfyLi9mpe3T6Vqzs9R', 'didar084@gmail.com', '404a85dcecb080f5799dc3da3a812135', 'Shanna@5', '2', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(12, '', 'Arun', 'Nagyaan', 'arunk2711', '', NULL, '9WZRB8TIZC0e9HNARN2qUOomQ7F54C', 'arunk2711@gmail.com', '1359e1b2829b6ab3552f38d64da879f6', 'Arunk2711', '2', '1', '', '', '9', '', 'gYqKys5MiiUIi0L9ZxXmm0ZqC6hZHx', '1471001466', '', '', 1, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `webuser` (`webuser_id`, `webuser_company`, `webuser_fname`, `webuser_lname`, `webuser_username`, `webuser_picture`, `cropped_image`, `webuser_token`, `webuser_email`, `webuser_password`, `webuser_orpass`, `webuser_type`, `webuser_status`, `webuser_lastlogin`, `webuser_position`, `webuser_country`, `webuser_phone`, `webuser_resettoken`, `webuser_resetexpire`, `webuser_title`, `webuser_site`, `isactive`, `suspend_reason`, `isdelete`, `created`) VALUES
(13, '', 'Arun', 'Kumar', 'arun', 'profil.jpg', 'data:image/png;base64,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', 'QnM7yAptNNSiW1Yh0xUOa7EznHvLg3', 'getupwork@gmail.com', '5455c33e251ab225e5c61c67e1902769', 'Arun', '2', '2', '', '', '46', '99999999999', 'p93BCI65rhfmT6M2XEpf3Rd8S6JYIO', '1485869660', '', '', 1, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `webuser` (`webuser_id`, `webuser_company`, `webuser_fname`, `webuser_lname`, `webuser_username`, `webuser_picture`, `cropped_image`, `webuser_token`, `webuser_email`, `webuser_password`, `webuser_orpass`, `webuser_type`, `webuser_status`, `webuser_lastlogin`, `webuser_position`, `webuser_country`, `webuser_phone`, `webuser_resettoken`, `webuser_resetexpire`, `webuser_title`, `webuser_site`, `isactive`, `suspend_reason`, `isdelete`, `created`) VALUES
(14, '', 'Michael Jay', 'Catubay', 'cmichaeljay89', '', NULL, 'O2M5lh1u6sslFTDtvUnBpvf9OjwshO', 'catubaymichaeljay@yahoo.com', '4cfe81cbdfcbc660837525796de7483a', 'nv01vostro', '2', '2', '', '', '9', '', 'ZFPmruLee6wgAZDrD2CYWJbOqcoJhx', '1472482086', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(15, '', 'Sheraz', ' salem', 'msherax', 'temp/userimg_10551427119675669211090345819.jpeg', NULL, 'RU2zapVPfrYnJb92lEvMLcjy4Nkn3D', 'm.sherax@gmail.com', 'befbc55882a5a60e8260b78de5a0911e', 'msherax', '2', '2', '', '', '9', '1111154888', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(16, '', 'alexei', 'andropov', 'alexei.andropov', '', NULL, 'v7GgXa1V2T9jBopuYgFjtzJwm3DHaH', 'alexei.andropov210@gmail.com', 'b21d455dc9a79b5a082ab9b38b985ae8', 'kaifaquA3212', '2', '2', '', '', '9', '', '', 'undefined', 'undefined', 'undefined', 1, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `webuser` (`webuser_id`, `webuser_company`, `webuser_fname`, `webuser_lname`, `webuser_username`, `webuser_picture`, `cropped_image`, `webuser_token`, `webuser_email`, `webuser_password`, `webuser_orpass`, `webuser_type`, `webuser_status`, `webuser_lastlogin`, `webuser_position`, `webuser_country`, `webuser_phone`, `webuser_resettoken`, `webuser_resetexpire`, `webuser_title`, `webuser_site`, `isactive`, `suspend_reason`, `isdelete`, `created`) VALUES
(18, 'JOHN INDUSTRIES LLC', 'John', 'john', 'john', 'profile.png', 'data:image/png;base64,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', 'ZoyjUHzbyEQLnMhIf2dx3mVobyOq9I', 'deshilancerbd3@gmail.com', '527bd5b5d689e2c32ae974c6229ff785', 'john', '1', '2', '', '', '11', '1234567890', '', '5465', 'john and carlos industries llc', 'www.example.com', 1, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `webuser` (`webuser_id`, `webuser_company`, `webuser_fname`, `webuser_lname`, `webuser_username`, `webuser_picture`, `cropped_image`, `webuser_token`, `webuser_email`, `webuser_password`, `webuser_orpass`, `webuser_type`, `webuser_status`, `webuser_lastlogin`, `webuser_position`, `webuser_country`, `webuser_phone`, `webuser_resettoken`, `webuser_resetexpire`, `webuser_title`, `webuser_site`, `isactive`, `suspend_reason`, `isdelete`, `created`) VALUES
(20, '', 'alexei', 'andropov', 'alexei.andropov_client', '', NULL, 'amJrPFxy12tygPzLMHuYCgkyl8Xd7O', 'alexei.andropov@gmail.com', 'b21d455dc9a79b5a082ab9b38b985ae8', 'kaifaquA3212', '1', '1', '', '', '9', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(21, '', 'Palash', 'Nath', 'palashit08', '', NULL, '4SR9QMIVLa3N6jIIBQf77x1fyFpiVr', 'palash.ict08@yahoo.com', '1f355696da5da5b7aebc67c0c58910f5', 'Palashict08', '2', '2', '', '', '5', '8801717457174', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(22, '', 'Palash', 'Nath', 'palash-worker', 'temp/userimg_7474835078450335551579775945.jpeg', NULL, 'gvV2RpnMpkskOYdzG2QVxenwGoIflP', 'palash.debnath5@gmail.com', '2b25da5627d6a47192f852d6f324b04d', 'Palash08', '2', '2', '', '', '5', '8801717457174', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(23, '', 'Palash', 'Nath', 'palash-worker2', '', NULL, 'Bn6MMAo59NtRaM2wK3Hj2VMQI6L0Je', 'group.work14@yahoo.com', '2b25da5627d6a47192f852d6f324b04d', 'Palash08', '2', '1', '', '', '5', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(25, '', 'andy', 'park', 'andy', 'temp/userimg_133192004510062161121794971327.jpeg', NULL, 'g6Vy9v7lGikg4pC8yFyoOqpfGv4CIB', 'aritra.infotechsolz@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '2', '2', '', '', '10', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(26, '', 'Aryan', ' tester', 'aryan', 'temp/userimg_5632180411535544915111403476.jpeg', NULL, 'LHJOXW1DpZExFqGbCbiVzDuFL1YWO2', 'arif.infotechsolz@gmail.com', '42351f64ee17f62f8729d3d527c35dca', 'Arif@123', '2', '2', '', '', '10', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(27, '', 'test', 'uuser', 'testuser123', '', NULL, 'm0N1aQAkkGWuZAOMKQVWJRun9WiEGm', 'hr007123@mailinator.com', '2419d2f1b53654ea0496ef1a5bc01a2c', '2X+P~k^&}fa=NJ:_', '1', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(28, '', 'tuhin', 'ahmed', 'tuhinspro', '', NULL, 'oPflkNat7oMtTgA4RUpXAEmhuGHWQO', 'tuhinspro@gmail.com', '8b596e5d99fa847e309936aad520e517', 'Loveu333Tuhin!!!', '2', '2', '', '', '5', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(29, 'rtgeryg', 'Carlos', 'Espada', 'carlos', '', NULL, 'hFiS8buMjwjuH3PNSVhtBEtxNVm4GJ', 'bdatozads@gmail.com', 'dc599a9972fde3045dab59dbd1ae170b', 'Mykey2018', '1', '2', '', '', '14', '122323322', 'AFtG3j5mA0cppKooJ17AcLhXjpUDgv', '1476135887', 'etyhtryh', 'tryhrthuj', 1, 0, 0, '0000-00-00 00:00:00'),
(31, '', 'Sabbir Hossain', 'Sagar', 'sagarb', '', NULL, 'clSsXkLucF2Mb3nmw6q2dMN5mowLNr', 'sagarme@live.com', '50baff07a833c928a65a3af00a04fbc5', 'sagara1a', '2', '1', '', '', '5', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(32, '', 'dasasd', 'asdads', 'adsdas', '', NULL, 'f7uwxNVKm0wGOX2LlJky7P3r5IbraK', 'sagar@sagar.me', '50baff07a833c928a65a3af00a04fbc5', 'sagara1a', '2', '1', '', '', '11', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(33, '', 'Terry', 'Rooney', 'terry', 'temp/userimg_10522959312136479091264380536.jpeg', NULL, 'Lk0uGsKowgEQkYIgRsIyRSeQweTIip', 'developer.musa@gmail.com', 'dd5585a92b04d4420477ee6082770fd1', 'terry', '2', '1', '', '', '13', '', '5Gric6qIAgGG3Xx5TVJC90iLvocd0d', '1479761792', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(34, '', 'selim', 'reja', 'sreja712', '', NULL, 'x9c0qREpZUeqrpiqYRA1X3SY0PSE9A', 'sreja712@gmail.com', '3a3b4005e8ed96b85f43ea7b801615a6', 'mykey2016', '2', '2', '', '', '5', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(35, '', 'aviram', 'adi', 'aviramadi', '', NULL, 'MRTzgg7cYyJKc01jk47ZclfXpHXtXB', 'aviramadi84@gmail.com', 'ecfe12b7732fbd24c570f7bdaca25b2e', 'avi180384', '1', '2', '', '', '13', '', '', '', '', '', 1, 0, 0, '0000-00-00 00:00:00'),
(36, '', 'Robert', 'Freeman', 'Celebeatz', '', NULL, '8r3PYJhoWWvFVRVFPsLfKeZIHSTGRx', 'Celebeatz@gmail.com', 'cff8865f66f3e4ce6ba511858a071bb3', 'datboi25', '2', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '2016-10-26 15:44:48'),
(37, '', 'Karen', 'Knight', 'Karenknight196052', '', NULL, '92JrxyKSM8YuwwG75hmxNRENGmouZQ', 'karenknight196052@yahoo.com', '7a76e9c9678dc82a61d564b158bc765a', 'Conner20093b', '1', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '2016-10-30 02:22:18'),
(38, '', 'Muhaiminul', 'Islam', 'mmislamimon', '', NULL, 'HnxjDGInMiTCSTmyhRmutANuz2fKJe', 'mmislamimon@gmail.com', '84e5c0d7e46392b1c51b5173356afab5', 'Win153246!', '1', '2', '', '', '5', '', '', '', '', '', 1, 0, 0, '2016-11-05 13:49:57'),
(39, '', 'kaitlin', 'fowler', 'kaitlinjane16', '', NULL, '8YfCAn6Z7lfYdsxZboVpHwMjw1FcGI', 'kaitlinjane16@aol.com', '37f04f3356f02fe42cd570f435bc80ec', 'emma1987', '2', '1', '', '', '9', '', '', '', '', '', 1, 0, 0, '2016-11-21 17:18:24'),
(40, '', 'sdfgfdgh', 'dgfhgfh', 'aaaaa', '', NULL, 'FWm9eNWWm3LxEjJtHbSMfhIBYErdcZ', 'aaaaa@gmail.com', '594f803b380a41396ed63dca39503542', 'aaaaa', '2', '1', '', '', '29', '', '', '', '', '', 1, 0, 0, '2016-11-21 17:46:03'),
(41, '', 'aviram', 'adi', 'organicleads', '', NULL, '3HTIQ18n6e0iDIvY4h3SLA35Bnz8BV', 'organicleadsllc@gmail.com', 'd79ff9023292795de2e37f2c24a660f8', 'Avi180384', '1', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '2016-12-04 19:50:06'),
(42, '', 'Willie', 'Craft', 'WillieCraft', '', NULL, 'qIWXBwogaGPit9jUleuLO20qeG5nvI', 'Worldwide601@gmail.com', '3325696835193a03e39f34f59036180b', 'Fordrasta601', '1', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '2016-12-16 17:36:17'),
(43, '', 'jahid', 'hasan', 'jahid', '', NULL, 'B3hwxu7sBjmlLzvXIUZORIJRZbigez', 'jahid0604015@gmail.com', '5aa5aa07e7699ba95b69bd72960abf5f', 'jahid', '2', '2', '', '', '5', '', '', '', '', '', 1, 0, 0, '2016-12-24 08:45:18'),
(44, '', 'Kenneth', 'Mix', 'Mix', '', NULL, 'doQYD1r4u8t7j4o2fNI1aT7aZvB1n4', 'mixken9@gmail.com', '77755e605e7fdf0ca539bab5aa1c245c', '06070607', '2', '2', '', '', '9', '', '', '', '', '', 1, 0, 0, '2017-01-19 21:48:45'),
(45, '', 'chamo', 'gezahegn', 'chamogezahegn', '', NULL, '9XXQ1E1XG4XRZRKLUFBzeeXCF1t3Fx', 'chamogezahegn@yahoo.com', 'bb292225abcd9a6e58f04bc2482702b1', 'CHAMO@ABAY@2015', '2', '1', '', '', '78', '', '', '', '', '', 1, 0, 0, '2017-01-30 08:02:12'),
(46, '', 'MD', 'Satu', 'md_satu', '', NULL, 'VHVDdKqKzdQ9vD0zPsfuxGUCUXBU78', 'mdsatu.pro@gmail.com', '27946274a201346f0322e3861909b5ff', 'satusatu', '2', '2', '', '', '5', '', '', '1487357809', '', '', 1, 0, 0, '2017-01-31 10:39:36'),
(47, '', 'Ashish', 'Patil', 'Ashishi', '', NULL, 'Wk6mq1BHJtmE3KjVUdv8rs0sAv6V3o', 'iamashish_patil@Rediffmail.com', '7c8dd773ee4835d67029e21b64fb02fb', 'sbimanish', '2', '1', '', '', '10', '', '', '', '', '', 1, 0, 0, '2017-02-07 06:18:58'),
(48, '', 'Zar', 'Htet', 'Zar Htet', '', NULL, 'EQ9rqxjOKPJsHgaggLhfP38Z0MEiH1', 'zarhtetoo@gmail.com', '0d261f802de0a78479d857697ccc33fc', 'zarhtetoo11', '2', '2', '', '', '44', '', '', '', '', '', 1, 0, 0, '2017-02-20 10:18:34'),
(49, '', 'shivani', 'patidar', 'shivani', '', NULL, 'aS3h3sEkWpgWLGj3Kk7KYFENSCEwrk', 'shivanidesignersveltosest005@gmail.com', '20f6ebca209ba3b5c07622689c97ef3c', '@Sh1van1', '1', '2', '', '', '10', '', '', '', '', '', 1, 0, 0, '2017-02-24 10:32:47'),
(50, '', 'ankit ', 'jain', 'sveltose', '', NULL, 'S9ykOJgP6QmIf8UbahuK7WBVghscnS', 'ankit.jain.mit@gmail.com', '6d142d761fa3dcaa81dbe3f2f8337d0b', 'Hanumanji2017', '2', '2', '', '', '87', '', '', '', '', '', 1, 0, 0, '2017-02-27 11:45:01');

-- --------------------------------------------------------

--
-- Structure de la table `webuseraddresses`
--

DROP TABLE IF EXISTS `webuseraddresses`;
CREATE TABLE `webuseraddresses` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `address1` text NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(40) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `timezone` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `webuseraddresses`
--

INSERT INTO `webuseraddresses` (`id`, `webuser_id`, `address`, `address1`, `city`, `state`, `zipcode`, `country`, `phone_number`, `timezone`) VALUES
(19, 15, 'thrtyuyrt', 'ryjtyjtr', 'yjtyjty', 'rjtryj', '5400', '9', '1111154888', ''),
(15, 18, 'sgfg', 'fdgdfg', 'dfgdfg', 'dfgdfg', '5455', '11', '1234567890', '52'),
(18, 21, 'Shewrapara', 'Dhaka', 'Dhaka', 'Dhaka', '1212', '5', '8801717457174', 'UTC 06.00 Almaty, Dhaka'),
(17, 22, 'Shewrapara', 'Dhaka', 'Dhaka', 'Dhaka', '1212', '5', '8801717457174', 'UTC 06.00 Almaty, Dhaka'),
(16, 9, 'brisbane', 'brisbane', 'brisbane', 'brisbane', '3422', '9', '116576543564675', ''),
(11, 16, 'ertert', 'dfgdfgd', 'Bogra', 'Bogra', '5881', 'Bangladesh', '  880 01711473899', 'UTC   06.00 Almaty, Dhaka'),
(20, 13, 'street address 1', 'street address 2', 'City', 'State', '4500', '46', '99999999999', '5'),
(21, 29, 'fgdthted', 'rgetyh', 'etrhytrjr', 'rtjuhrtu', '1243', '14', '122323322', '15');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_basic_profile`
--

DROP TABLE IF EXISTS `webuser_basic_profile`;
CREATE TABLE `webuser_basic_profile` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `hourly_rate` float NOT NULL,
  `work_experience_year` tinyint(2) NOT NULL,
  `work_experience_month` tinyint(2) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `overview` text NOT NULL,
  `last_updated_time` decimal(18,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `webuser_basic_profile`
--

INSERT INTO `webuser_basic_profile` (`id`, `webuser_id`, `tagline`, `hourly_rate`, `work_experience_year`, `work_experience_month`, `skills`, `overview`, `last_updated_time`) VALUES
(2, 22, 'Web developer', 15, 4, 6, 'Java, PHP, HTML, CSS', 'Testing overview', '1472202235770'),
(3, 9, 'Graphics designer,HTML,SEO', 4, 3, 1, '', 'We are looking a developer for our project', '1488215050077'),
(4, 13, 'Web Designer,PHP,WORDPRESS- try fix it herm', 11, 1, 1, '', 'I am working as a web developer for PHP/Mysql,Magento, Wordpress,html5  since last 5 years. Testa', '1489160619221'),
(5, 21, 'Web developer', 10, 5, 1, 'HTML', 'tst', '1472746678600'),
(6, 25, 'Tagline (mandatory)', 12, 18, 1, 'PHP, HTML, AJAX', 'O', '1472765256950'),
(8, 15, 'I have 5 years xperience in wordpress', 7, 1, 1, '', 'Article Submission, Article Submission directories eg.', '1488395878395'),
(7, 18, 'dsgfsg', 5, 1, 1, 'php', 'dsfsdgf', '1472805191580'),
(9, 33, 'sdfsfdg', 1, 2, 2, 'php', 'dfsdgfgd', '1476476070240');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_payment_methods`
--

DROP TABLE IF EXISTS `webuser_payment_methods`;
CREATE TABLE `webuser_payment_methods` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) NOT NULL,
  `payment_method_name` enum('paypal','skrill','payoneer','none') NOT NULL DEFAULT 'none',
  `account_id` varchar(196) NOT NULL,
  `creation_time` bigint(20) NOT NULL,
  `last_update_time` bigint(20) NOT NULL,
  `current_status` enum('active','deactive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `webuser_payment_methods`
--

INSERT INTO `webuser_payment_methods` (`id`, `webuser_id`, `payment_method_name`, `account_id`, `creation_time`, `last_update_time`, `current_status`) VALUES
(1, 22, 'paypal', 'palash.debnath5@gmail.com', 1474473312710, 0, 'active'),
(2, 22, 'skrill', 'palash.debnath5@gmail.com', 1474473318850, 1474473561030, 'deactive'),
(3, 9, 'paypal', 'hafijarrahman@gmail.com', 1474473605930, 1474473671700, 'deactive'),
(4, 9, 'skrill', 'hafijarrahman@gmail.com', 1474473630230, 1474473648300, 'deactive'),
(5, 9, 'payoneer', 'hafijarrahman@gmail.com', 1474473635140, 1474473665810, 'deactive'),
(6, 15, 'skrill', 'm.sherax@gmail.com', 1474473709940, 1474473770750, 'deactive'),
(7, 15, 'paypal', 'm.sherax@gmail.com', 1474473733290, 1474473767100, 'deactive'),
(8, 9, 'paypal', 'hafijarrahman@gmail.com', 1474875542210, 1475710999690, 'deactive'),
(9, 9, 'skrill', 'hafijarrahman@gmail.com', 1475710994380, 1475711002680, 'deactive'),
(10, 13, 'paypal', 'getupwork@gmail.com', 1476942749840, 1476942885480, 'deactive'),
(11, 13, 'skrill', 'getupwork@gmail.com', 1476942779630, 1476942890510, 'deactive'),
(12, 13, 'paypal', 'getupwork@gmail.com', 1477083901080, 1485795762065, 'deactive'),
(13, 13, 'skrill', 'getupwork@gmail.com', 1477083909300, 1477946072420, 'deactive'),
(14, 13, 'payoneer', 'getupwork@gmail.com', 1477083913830, 1477597544930, 'deactive'),
(15, 13, 'skrill', 'getupwork@gmail.com', 1479664723130, 1479665757000, 'deactive'),
(16, 13, 'payoneer', 'getupwork@gmail.com', 1479664793580, 1479664879270, 'deactive'),
(17, 13, 'payoneer', 'getupwork@gmail.com', 1479668101780, 1479678014000, 'deactive'),
(18, 13, 'skrill', 'getupwork@gmail.com', 1479678005580, 1479749322290, 'deactive'),
(19, 13, 'payoneer', 'getupwork@gmail.com', 1479760289030, 1485776287033, 'deactive'),
(20, 13, 'skrill', 'getupwork@gmail.com', 1485794728299, 1485794771385, 'deactive'),
(21, 13, 'payoneer', 'getupwork@gmail.com', 1485794747131, 1485795277484, 'deactive'),
(22, 13, 'paypal', 'getupwork@gmail.com', 1486115569447, 1486115602626, 'deactive'),
(23, 13, 'paypal', 'getupwork@gmail.com', 1486115662824, 1487739737223, 'deactive'),
(24, 13, 'skrill', 'getupwork@gmail.com', 1486115668064, 1486874599859, 'deactive'),
(25, 13, 'payoneer', 'getupwork@gmail.com', 1486115672554, 1486460938305, 'deactive'),
(26, 13, 'skrill', 'getupwork@gmail.com', 1486874617389, 1487605436587, 'deactive'),
(27, 9, 'paypal', 'hafijarrahman@gmail.com', 1487606375967, 0, 'active'),
(28, 9, 'skrill', 'hafijarrahman@gmail.com', 1487608731972, 0, 'active'),
(29, 9, 'payoneer', 'hafijarrahman@gmail.com', 1487608764433, 0, 'active'),
(30, 13, 'skrill', 'getupwork@gmail.com', 1487611089851, 1487611179752, 'deactive'),
(31, 13, 'skrill', 'getupwork@gmail.com', 1487611230719, 1487611299679, 'deactive'),
(32, 13, 'skrill', 'getupwork@gmail.com', 1487623614839, 1487723707242, 'deactive'),
(33, 13, 'skrill', 'getupwork@gmail.com', 1487739528731, 1487739544417, 'deactive'),
(34, 13, 'skrill', 'getupwork@gmail.com', 1487739553381, 1487739718613, 'deactive'),
(35, 13, 'payoneer', 'getupwork@gmail.com', 1487739561338, 1487739724767, 'deactive'),
(36, 13, 'skrill', 'getupwork@gmail.com', 1487739752915, 1487867463269, 'deactive'),
(37, 13, 'payoneer', 'getupwork@gmail.com', 1487739769342, 0, 'active');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_portfolio`
--

DROP TABLE IF EXISTS `webuser_portfolio`;
CREATE TABLE `webuser_portfolio` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `project_overview` text NOT NULL,
  `project_category` int(6) NOT NULL,
  `project_subcategory` int(6) NOT NULL,
  `project_url` varchar(255) NOT NULL,
  `thumnail_image` mediumtext NOT NULL,
  `completion_date` date NOT NULL,
  `skills` varchar(255) NOT NULL,
  `creation_time` date NOT NULL,
  `visibility_status` enum('yes','no') NOT NULL DEFAULT 'yes',
  `last_updated_time` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `webuser_portfolio`
--

INSERT INTO `webuser_portfolio` (`id`, `webuser_id`, `project_title`, `project_overview`, `project_category`, `project_subcategory`, `project_url`, `thumnail_image`, `completion_date`, `skills`, `creation_time`, `visibility_status`, `last_updated_time`) VALUES
(1, 22, 'Task Management System - update', 'testing application', 1, 0, 'http://www.tms.pksoftsolution.com', '1472930562.jpg', '2016-08-02', 'PHP, HTML, CSS', '2016-09-03', 'yes', '2016-09-03'),
(16, 9, 'web', 'web', 2, 0, 'http://www.go.com', '1474050815.jpg', '0000-00-00', 'php', '2016-09-16', 'yes', '0000-00-00'),
(13, 15, 'redyghrtyh', 'rthyurju', 8, 0, 'http://www.go.com', '1473192743.jpg', '0000-00-00', 'php', '2016-09-06', 'yes', '0000-00-00'),
(14, 22, 'Task Management System - update', 'asd', 2, 0, 'http://www.pksoftsoltion.com', '1473306338.jpg', '0000-00-00', 'JAVA', '2016-09-08', 'yes', '0000-00-00'),
(11, 22, 'jkjk', 'asd', 10, 0, 'http://www.pksoftsoltion.com', '1472930791.jpg', '2016-12-01', 'java', '2016-09-03', 'yes', '0000-00-00'),
(19, 9, 'Testing', 'we are testing', 12, 0, 'http://www.winjob.com', '1480092307.jpg', '0000-00-00', 'php', '2016-11-25', 'yes', '0000-00-00'),
(18, 26, 'test project', 'aadd', 1, 0, 'http://www.winjob.com', '1476692359.jpg', '0000-00-00', 'web delloping', '2016-10-17', 'yes', '0000-00-00'),
(31, 13, 'aaaa', 'aaaa aaa', 2, 0, 'http://', '1484751067.jpg', '2017-02-15', '', '2017-02-25', 'yes', '2017-02-25'),
(32, 13, 'testing', 'safaf', 9, 0, 'http://www.winjob.com', '1487966753.jpg', '0000-00-00', '', '2017-02-24', 'yes', '2017-02-24');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_portfolio_skills`
--

DROP TABLE IF EXISTS `webuser_portfolio_skills`;
CREATE TABLE `webuser_portfolio_skills` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `skill_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `webuser_portfolio_skills`
--

INSERT INTO `webuser_portfolio_skills` (`id`, `portfolio_id`, `skill_name`) VALUES
(73, 32, 'Product Sourcing'),
(84, 31, 'PHP'),
(83, 31, 'Product Sourcing'),
(81, 31, 'Apache Solr'),
(82, 31, 'Object Oriented PHP'),
(74, 32, 'javascript'),
(80, 31, 'HTML');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_skills`
--

DROP TABLE IF EXISTS `webuser_skills`;
CREATE TABLE `webuser_skills` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) NOT NULL,
  `skill_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `webuser_skills`
--

INSERT INTO `webuser_skills` (`id`, `webuser_id`, `skill_name`) VALUES
(129, 15, 'TypePad'),
(127, 15, 'javascript'),
(138, 13, 'HTML'),
(137, 13, 'mysql'),
(128, 15, 'Chroma key'),
(111, 9, 'Adobe Flash'),
(112, 9, 'Paypal API'),
(113, 9, 'Facebook'),
(114, 9, 'jquery'),
(136, 13, 'Adobe Flash'),
(126, 15, 'PHP'),
(135, 13, 'HTML5'),
(139, 13, 'javascript');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_tax_information`
--

DROP TABLE IF EXISTS `webuser_tax_information`;
CREATE TABLE `webuser_tax_information` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) NOT NULL,
  `legal_name` varchar(165) NOT NULL,
  `tax_no` varchar(64) NOT NULL,
  `country` varchar(132) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `city` varchar(96) NOT NULL,
  `state` varchar(96) NOT NULL,
  `zip` int(6) NOT NULL,
  `created_time` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `webuser_tax_information`
--

INSERT INTO `webuser_tax_information` (`id`, `webuser_id`, `legal_name`, `tax_no`, `country`, `address`, `address_line1`, `city`, `state`, `zip`, `created_time`) VALUES
(1, 9, 'Hafizar', '12345', '9', 'dhaka', 'dhaka', 'dhaka', 'dhaka', 2562, 1474568150790),
(2, 15, 'fgdfg', '122', '10', 'ertrr', 'rgey', 'rgeh', 'sfgdfg', 1222, 1477000971020),
(3, 22, 'Palash', '1312324', '5', 'Dhaka', 'Mirpur', 'Dhaka', 'Dhaka', 12012, 1474565660130),
(6, 13, 'Arun', '111111', '160', 'Arunfg', 'Arungg', 'Arungg', 'Arungg', 122, 1488139670523);

-- --------------------------------------------------------

--
-- Structure de la table `webuser_tickets`
--

DROP TABLE IF EXISTS `webuser_tickets`;
CREATE TABLE `webuser_tickets` (
  `id` int(11) NOT NULL,
  `webuser_id` int(11) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `webuser_tickets`
--

INSERT INTO `webuser_tickets` (`id`, `webuser_id`, `fname`, `lname`, `email`, `subject`) VALUES
(2, NULL, 'dgr', 'fgfd', 'a@gmail.com', 'General'),
(3, NULL, 'carlos', 'espada', 'b@gmail.com', 'General'),
(9, 13, 'Arun', 'Kumar', 'getupwork@gmail.com', 'Freelancer');

-- --------------------------------------------------------

--
-- Structure de la table `webuser_ticket_messages`
--

DROP TABLE IF EXISTS `webuser_ticket_messages`;
CREATE TABLE `webuser_ticket_messages` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text,
  `status` set('green','red') DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `have_seen` tinyint(1) NOT NULL DEFAULT '1',
  `sender` set('user','support') NOT NULL DEFAULT 'user',
  `receiver` set('user','support') DEFAULT 'support',
  `imap_message_id` varchar(255) DEFAULT NULL,
  `have_support_seen` tinyint(1) DEFAULT '1' COMMENT '1= unseen,0=seen'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `webuser_ticket_messages`
--

INSERT INTO `webuser_ticket_messages` (`id`, `ticket_id`, `sender_id`, `receiver_id`, `message`, `status`, `created`, `have_seen`, `sender`, `receiver`, `imap_message_id`, `have_support_seen`) VALUES
(109, 9, 13, 0, 'pppppppppppppppppp', 'green', '2017-01-13 19:01:19', 0, 'user', 'support', NULL, 1),
(2, 2, NULL, NULL, 'sdgfdsg', 'red', '2017-01-05 17:01:34', 0, 'user', 'support', NULL, 0),
(3, 3, NULL, NULL, 'westret', 'red', '2017-01-06 14:01:56', 0, 'user', 'support', NULL, 1),
(4, 1, 1, 1, 'fgrfg', 'green', '2017-01-06 14:01:22', 0, 'support', 'user', NULL, 1),
(91, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:43', 1, 'support', 'user', NULL, 1),
(90, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:54', 1, 'support', 'user', NULL, 1),
(87, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:29', 1, 'support', 'user', NULL, 1),
(88, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:38', 1, 'support', 'user', NULL, 1),
(89, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:17', 1, 'support', 'user', NULL, 1),
(86, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:10', 1, 'support', 'user', NULL, 1),
(74, 2, 1, 0, 'qqqqq', 'red', '2017-01-13 15:01:46', 1, 'support', 'user', NULL, 1),
(75, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:51', 1, 'support', 'user', NULL, 1),
(76, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:23', 1, 'support', 'user', NULL, 1),
(77, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:19', 1, 'support', 'user', NULL, 1),
(78, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:23', 1, 'support', 'user', NULL, 1),
(79, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:42', 1, 'support', 'user', NULL, 1),
(80, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:03', 1, 'support', 'user', NULL, 1),
(81, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:10', 1, 'support', 'user', NULL, 1),
(82, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:14', 1, 'support', 'user', NULL, 1),
(83, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:34', 1, 'support', 'user', NULL, 1),
(84, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:50', 1, 'support', 'user', NULL, 1),
(85, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:56', 1, 'support', 'user', NULL, 1),
(73, 2, 1, 0, 'aaa', 'red', '2017-01-13 15:01:38', 1, 'support', 'user', NULL, 1),
(71, 2, 1, 0, 'aaaa', 'red', '2017-01-13 15:01:50', 1, 'support', 'user', NULL, 1),
(72, 2, 1, 0, 'test aaa', 'red', '2017-01-13 15:01:44', 1, 'support', 'user', NULL, 1),
(108, 9, 1, 13, 'gggg', 'red', '2017-01-13 19:01:44', 0, 'support', 'user', NULL, 1),
(107, 9, 13, 0, 'aaaaa', 'green', '2017-01-13 19:01:27', 0, 'user', 'support', NULL, 1),
(106, 9, 1, 13, 'aaaa', 'red', '2017-01-13 19:01:28', 0, 'support', 'user', NULL, 1),
(105, 9, 13, 0, 'hiiiiii', 'green', '2017-01-13 19:01:25', 0, 'user', 'support', NULL, 1),
(104, 9, 1, 13, 'aaa', 'red', '2017-01-13 19:01:18', 0, 'support', 'user', NULL, 1),
(103, 9, 13, 0, 'bvvv', 'green', '2017-01-13 17:01:13', 0, 'user', 'support', NULL, 1),
(102, 9, 13, 0, 'asasa', 'green', '2017-01-13 17:01:25', 0, 'user', 'support', NULL, 1),
(101, 9, 13, 0, 'test ', 'green', '2017-01-13 16:01:20', 0, 'user', 'support', NULL, 1),
(100, 9, 1, 13, 'hi', 'red', '2017-01-13 16:01:45', 0, 'support', 'user', NULL, 1),
(99, 9, 13, NULL, 'We are testing', 'red', '2017-01-13 16:01:56', 0, 'user', 'support', NULL, 1),
(98, 2, 1, 0, 'test removed', 'red', '2017-01-13 16:01:49', 1, 'support', 'user', NULL, 1),
(97, 2, 1, 0, 'test ', 'red', '2017-01-13 16:01:21', 1, 'support', 'user', NULL, 1),
(96, 2, 1, 0, 'test remove', 'red', '2017-01-13 16:01:49', 1, 'support', 'user', NULL, 1),
(95, 2, 1, 0, 'aaaaaa', 'red', '2017-01-13 16:01:24', 1, 'support', 'user', NULL, 1),
(94, 2, 1, 0, 'aaaaaa', 'red', '2017-01-13 16:01:12', 1, 'support', 'user', NULL, 1),
(93, 2, 1, 0, 'aaaaaa', 'red', '2017-01-13 16:01:24', 1, 'support', 'user', NULL, 1),
(92, 2, 1, 0, 'ddddd', 'red', '2017-01-13 15:01:32', 1, 'support', 'user', NULL, 1),
(70, 2, 1, 0, 'aaa', 'red', '2017-01-13 15:01:23', 1, 'support', 'user', NULL, 1),
(69, 2, 1, 0, 'wwwww', 'red', '2017-01-13 15:01:15', 1, 'support', 'user', NULL, 1),
(68, 2, 1, 0, 'aaaaa', 'red', '2017-01-13 15:01:12', 1, 'support', 'user', NULL, 1),
(67, 2, 1, 0, 'test remove', 'red', '2017-01-13 15:01:28', 1, 'support', 'user', NULL, 1),
(66, 2, 1, 0, 'sss', 'red', '2017-01-13 15:01:46', 1, 'support', 'user', NULL, 1),
(65, 2, 1, 0, 'ssss', 'red', '2017-01-13 15:01:20', 1, 'support', 'user', NULL, 1),
(64, 2, 1, 0, 'ff', 'red', '2017-01-13 12:01:40', 1, 'support', 'user', NULL, 1),
(63, 2, 1, 0, 'sss', 'red', '2017-01-13 12:01:24', 1, 'support', 'user', NULL, 1),
(62, 2, 1, 0, 'testing', 'red', '2017-01-13 12:01:55', 1, 'support', 'user', NULL, 1),
(61, 2, 1, 0, 'test', 'red', '2017-01-13 12:01:36', 1, 'support', 'user', NULL, 1),
(110, 9, 13, 0, 'uuuuuuuuuuuuu', 'green', '2017-01-13 19:01:35', 0, 'user', 'support', NULL, 1),
(111, 9, 13, 0, 'wwwwwwww', 'green', '2017-01-13 19:01:47', 0, 'user', 'support', NULL, 1),
(112, 9, 1, 13, 'qqqqqqqqqqqq', 'red', '2017-01-13 20:01:02', 0, 'support', 'user', NULL, 1),
(113, 9, 13, 0, 'ttttttttt', 'green', '2017-01-13 20:01:45', 0, 'user', 'support', NULL, 1),
(114, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:10', 0, 'support', 'user', NULL, 1),
(115, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:39', 0, 'support', 'user', NULL, 1),
(116, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:39', 0, 'support', 'user', NULL, 1),
(117, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:39', 0, 'support', 'user', NULL, 1),
(118, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:00', 0, 'support', 'user', NULL, 1),
(119, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:00', 0, 'support', 'user', NULL, 1),
(120, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:00', 0, 'support', 'user', NULL, 1),
(121, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:01', 0, 'support', 'user', NULL, 1),
(122, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:07', 0, 'support', 'user', NULL, 1),
(123, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:12', 0, 'support', 'user', NULL, 1),
(124, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:17', 0, 'support', 'user', NULL, 1),
(125, 9, 1, 13, 'uuuu', 'red', '2017-01-13 20:01:22', 0, 'support', 'user', NULL, 1),
(126, 9, 1, 13, 'ooooooooooooo', 'red', '2017-01-13 20:01:42', 0, 'support', 'user', NULL, 1),
(127, 9, 1, 13, 'llllllllllll', 'red', '2017-01-13 20:01:25', 0, 'support', 'user', NULL, 1),
(128, 9, 1, 13, 'ppp', 'red', '2017-01-13 20:01:34', 0, 'support', 'user', NULL, 1),
(129, 9, 1, 13, 'ppp', 'red', '2017-01-13 20:01:52', 0, 'support', 'user', NULL, 1),
(130, 9, 1, 13, 'lllllllll', 'red', '2017-01-13 20:01:00', 0, 'support', 'user', NULL, 1),
(131, 9, 1, 13, 'uuyyyyyyytrrrg', 'red', '2017-01-13 20:01:42', 0, 'support', 'user', NULL, 1),
(132, 9, 13, 0, 'nnnnnnnnnnn', 'green', '2017-01-13 20:01:53', 0, 'user', 'support', NULL, 1),
(133, 9, 1, 13, 'ppppppppppppp', 'red', '2017-01-13 20:01:51', 0, 'support', 'user', NULL, 1),
(134, 9, 1, 13, 'ppppppppppppp', 'red', '2017-01-13 21:01:15', 0, 'support', 'user', NULL, 1),
(135, 9, 1, 13, 'ppppppppppppp', 'red', '2017-01-13 21:01:17', 0, 'support', 'user', NULL, 1),
(136, 9, 1, 13, 'ppppppppppppp', 'red', '2017-01-13 21:01:17', 0, 'support', 'user', NULL, 1),
(137, 9, 1, 13, 'ppppppppppppp', 'red', '2017-01-13 21:01:18', 0, 'support', 'user', NULL, 1),
(138, 9, 1, 13, '[[[[[', 'red', '2017-01-13 21:01:31', 0, 'support', 'user', NULL, 1),
(139, 9, 1, 13, 'tttt', 'red', '2017-01-13 21:01:04', 0, 'support', 'user', NULL, 1),
(140, 9, 1, 13, 'kkk', 'red', '2017-01-13 21:01:50', 0, 'support', 'user', NULL, 1),
(141, 9, 1, 13, 'mmmmmmm', 'red', '2017-01-13 21:01:02', 0, 'support', 'user', NULL, 1),
(142, 9, 1, 13, 'mmmmmmm', 'red', '2017-01-13 21:01:11', 0, 'support', 'user', NULL, 1),
(143, 9, 1, 13, 'mmmm', 'red', '2017-01-13 21:01:24', 0, 'support', 'user', NULL, 1),
(144, 9, 1, 13, 'nnnnnnnnnn', 'red', '2017-01-13 21:01:30', 0, 'support', 'user', NULL, 1),
(145, 9, 13, 0, 'ttttttttt', 'green', '2017-01-13 21:01:00', 0, 'user', 'support', NULL, 1),
(146, 9, 13, 0, 'rrrrrrr', 'green', '2017-01-13 21:01:16', 0, 'user', 'support', NULL, 1),
(147, 9, 1, 13, 'aaaaa', 'red', '2017-01-13 21:01:31', 0, 'support', 'user', NULL, 1),
(148, 9, 13, 0, 'rrrr', 'green', '2017-01-13 21:01:32', 0, 'user', 'support', NULL, 1),
(149, 9, 13, 0, 'qqq', 'green', '2017-01-13 21:01:46', 0, 'user', 'support', NULL, 1),
(150, 9, 1, 13, 'qqqq', 'red', '2017-01-13 21:01:57', 0, 'support', 'user', NULL, 1),
(151, 9, 13, 0, 'aaaa', 'green', '2017-01-13 22:01:51', 0, 'user', 'support', NULL, 1),
(152, 9, 13, 0, 'qqqq', 'green', '2017-01-13 22:01:40', 0, 'user', 'support', NULL, 1),
(153, 9, 13, 0, 'hi', 'green', '2017-01-13 22:01:51', 0, 'user', 'support', NULL, 1),
(154, 9, 13, 0, 'test remove', 'green', '2017-01-14 13:01:25', 0, 'user', 'support', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `webuser_ticket_message_files`
--

DROP TABLE IF EXISTS `webuser_ticket_message_files`;
CREATE TABLE `webuser_ticket_message_files` (
  `id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `webuser_ticket_message_files`
--

INSERT INTO `webuser_ticket_message_files` (`id`, `message_id`, `name`, `original_name`) VALUES
(1, 18, 'a39c87a12a25a82a24852da7566f1494.jpg', '1474050815.jpg'),
(2, 19, '436a325b0e1643fbeea97155ac6a2dca.jpg', 'wallpaper_240x320_?2_003.jpg'),
(56, 96, 'image_5878986d43e80.jpg', 'Jellyfish.jpg'),
(55, 95, 'image_5878981803924.', NULL),
(54, 95, 'image_5878981803752.', NULL),
(52, 94, 'image_5878980ccb079.', NULL),
(53, 94, 'image_5878980ccb4c3.', NULL),
(51, 70, 'image_58788c9b9a472.jpg', 'Jellyfish.jpg'),
(50, 70, 'image_58788c9b167cb.jpg', 'Hydrangeas.jpg'),
(49, 70, 'image_58788c9b1605c.jpg', 'Desert.jpg'),
(47, 68, 'image_587889c025648.jpg', 'Lighthouse.jpg'),
(48, 68, 'image_587889c025b98.jpg', 'Penguins.jpg'),
(46, 68, 'image_587889c024e2c.jpg', 'Koala.jpg'),
(45, 67, 'image_58788994ccc46.jpg', 'Jellyfish.jpg'),
(44, 67, 'image_58788994cc616.jpg', 'Hydrangeas.jpg'),
(43, 64, 'image_58786ab053975.jpg', 'Koala.jpg'),
(42, 63, 'image_58786a285a9a9.jpg', 'Jellyfish.jpg'),
(41, 63, 'image_58786a285a3ea.jpg', 'Hydrangeas.jpg'),
(40, 62, 'image_5878637b713c7.jpg', 'Jellyfish.jpg'),
(39, 62, 'image_5878637b70e9d.jpg', 'Hydrangeas.jpg'),
(37, 61, 'image_58786200e981e.jpg', 'Hydrangeas.jpg'),
(38, 61, 'image_58786200ebc73.jpg', 'Jellyfish.jpg'),
(57, 96, 'image_5878986d4473b.', NULL),
(58, 97, 'image_587898c9bbb13.jpg', 'Hydrangeas.jpg'),
(59, 97, 'image_587898c9bc23b.jpg', NULL),
(60, 98, 'image_5878995daefc4.jpg', 'Jellyfish.jpg'),
(61, 98, 'image_5878995dafc50.jpg', NULL),
(62, 101, 'image_58789c4c94406.jpg', 'Chrysanthemum.jpg'),
(63, 151, 'image_5878ec1ba926a.jpg', 'Hydrangeas.jpg'),
(64, 151, 'image_5878ec1c120ba.jpg', 'Jellyfish.jpg'),
(65, 152, 'image_5878ed00c9808.jpg', 'Desert.jpg'),
(66, 152, 'image_5878ed00ca1dd.jpg', 'Hydrangeas.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `withdraw`
--

DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `payment_type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1=paypal,2=skrill,3=payneer',
  `processingfees` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','processed','cancelled','') NOT NULL DEFAULT 'pending',
  `operation_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `withdraw`
--

INSERT INTO `withdraw` (`id`, `userid`, `amount`, `payment_type`, `processingfees`, `date`, `status`, `operation_date`) VALUES
(1, 13, 1, '', '', '2017-03-02 22:59:44', 'processed', '2017-03-02 11:10:34'),
(2, 13, 333, '3', '2', '2017-03-02 23:00:15', 'pending', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `workdairy_tracker`
--

DROP TABLE IF EXISTS `workdairy_tracker`;
CREATE TABLE `workdairy_tracker` (
  `worktracker_id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `cuser_id` int(11) NOT NULL,
  `fuser_id` int(11) NOT NULL,
  `cpture_image` text,
  `capture_time` text NOT NULL,
  `working_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `workdairy_tracker`
--

INSERT INTO `workdairy_tracker` (`worktracker_id`, `jobid`, `bid_id`, `cuser_id`, `fuser_id`, `cpture_image`, `capture_time`, `working_date`) VALUES
(2420, 147, 207, 18, 13, NULL, '2017-03-01 19:00:08', '2017-03-01'),
(2419, 147, 207, 18, 13, NULL, '2017-03-01 18:54:08', '2017-03-01'),
(2418, 147, 207, 18, 13, NULL, '2017-03-01 18:48:08', '2017-03-01'),
(2417, 147, 207, 18, 13, NULL, '2017-03-01 18:42:08', '2017-03-01'),
(2416, 147, 207, 18, 13, NULL, '2017-03-01 18:36:08', '2017-03-01'),
(2415, 147, 207, 18, 13, NULL, '2017-03-01 18:30:08', '2017-03-01'),
(2414, 147, 207, 18, 13, NULL, '2017-03-01 18:24:08', '2017-03-01'),
(2413, 147, 207, 18, 13, NULL, '2017-03-01 18:18:08', '2017-03-01'),
(2412, 147, 207, 18, 13, NULL, '2017-03-01 18:12:08', '2017-03-01'),
(2411, 147, 207, 18, 13, NULL, '2017-03-01 18:06:08', '2017-03-01'),
(2410, 149, 210, 18, 13, NULL, '2017-02-21 23:00:20', '2017-02-21'),
(2409, 149, 210, 18, 13, NULL, '2017-02-21 22:54:20', '2017-02-21'),
(2408, 149, 210, 18, 13, NULL, '2017-02-21 22:48:20', '2017-02-21'),
(2407, 149, 210, 18, 13, NULL, '2017-02-21 22:42:20', '2017-02-21'),
(2406, 149, 210, 18, 13, NULL, '2017-02-21 22:36:20', '2017-02-21'),
(2405, 149, 210, 18, 13, NULL, '2017-02-21 22:30:20', '2017-02-21'),
(2404, 149, 210, 18, 13, NULL, '2017-02-21 22:24:20', '2017-02-21'),
(2403, 149, 210, 18, 13, NULL, '2017-02-21 22:18:20', '2017-02-21'),
(2402, 149, 210, 18, 13, NULL, '2017-02-21 22:12:20', '2017-02-21'),
(2401, 149, 210, 18, 13, NULL, '2017-02-21 22:06:20', '2017-02-21'),
(2400, 149, 210, 18, 13, NULL, '2017-02-21 22:00:20', '2017-02-21'),
(2399, 149, 210, 18, 13, NULL, '2017-02-21 21:54:20', '2017-02-21'),
(2398, 149, 210, 18, 13, NULL, '2017-02-21 21:48:20', '2017-02-21'),
(2397, 149, 210, 18, 13, NULL, '2017-02-21 21:42:20', '2017-02-21'),
(2396, 149, 210, 18, 13, NULL, '2017-02-21 21:36:20', '2017-02-21'),
(2395, 149, 210, 18, 13, NULL, '2017-02-21 21:30:20', '2017-02-21'),
(2394, 149, 210, 18, 13, NULL, '2017-02-21 21:24:20', '2017-02-21'),
(2393, 149, 210, 18, 13, NULL, '2017-02-21 21:18:20', '2017-02-21'),
(2392, 149, 210, 18, 13, NULL, '2017-02-21 21:12:20', '2017-02-21'),
(2391, 149, 210, 18, 13, NULL, '2017-02-21 21:06:20', '2017-02-21'),
(2390, 149, 210, 18, 13, NULL, '2017-02-21 21:00:20', '2017-02-21'),
(2389, 149, 210, 18, 13, NULL, '2017-02-21 20:54:20', '2017-02-21'),
(2388, 149, 210, 18, 13, NULL, '2017-02-21 20:48:20', '2017-02-21'),
(2387, 149, 210, 18, 13, NULL, '2017-02-21 20:42:20', '2017-02-21'),
(2386, 149, 210, 18, 13, NULL, '2017-02-21 20:36:20', '2017-02-21'),
(2385, 149, 210, 18, 13, NULL, '2017-02-21 20:30:20', '2017-02-21'),
(2384, 149, 210, 18, 13, NULL, '2017-02-21 20:24:20', '2017-02-21'),
(2383, 149, 210, 18, 13, NULL, '2017-02-21 20:18:20', '2017-02-21'),
(2382, 149, 210, 18, 13, NULL, '2017-02-21 20:12:20', '2017-02-21'),
(2381, 149, 210, 18, 13, NULL, '2017-02-21 20:06:20', '2017-02-21'),
(2380, 149, 210, 18, 13, NULL, '2017-02-21 20:00:20', '2017-02-21'),
(2379, 149, 210, 18, 13, NULL, '2017-02-21 19:54:20', '2017-02-21'),
(2378, 149, 210, 18, 13, NULL, '2017-02-21 19:48:20', '2017-02-21'),
(2377, 149, 210, 18, 13, NULL, '2017-02-21 19:42:20', '2017-02-21'),
(2376, 149, 210, 18, 13, NULL, '2017-02-21 19:36:20', '2017-02-21'),
(2375, 149, 210, 18, 13, NULL, '2017-02-21 19:30:20', '2017-02-21'),
(2374, 149, 210, 18, 13, NULL, '2017-02-21 19:24:20', '2017-02-21'),
(2373, 149, 210, 18, 13, NULL, '2017-02-21 19:18:20', '2017-02-21'),
(2372, 149, 210, 18, 13, NULL, '2017-02-21 19:12:20', '2017-02-21'),
(2371, 149, 210, 18, 13, NULL, '2017-02-21 19:06:20', '2017-02-21'),
(2370, 149, 210, 18, 13, NULL, '2017-02-21 19:00:20', '2017-02-21'),
(2369, 149, 210, 18, 13, NULL, '2017-02-21 18:54:20', '2017-02-21'),
(2368, 149, 210, 18, 13, NULL, '2017-02-21 18:48:20', '2017-02-21'),
(2367, 149, 210, 18, 13, NULL, '2017-02-21 18:42:20', '2017-02-21'),
(2366, 149, 210, 18, 13, NULL, '2017-02-21 18:36:20', '2017-02-21'),
(2365, 149, 210, 18, 13, NULL, '2017-02-21 18:30:20', '2017-02-21'),
(2364, 149, 210, 18, 13, NULL, '2017-02-21 18:24:20', '2017-02-21'),
(2363, 149, 210, 18, 13, NULL, '2017-02-21 18:18:20', '2017-02-21'),
(2362, 149, 210, 18, 13, NULL, '2017-02-21 18:12:20', '2017-02-21'),
(2361, 149, 210, 18, 13, NULL, '2017-02-21 18:06:20', '2017-02-21'),
(2360, 147, 207, 18, 13, NULL, '2017-02-06 18:00:03', '2017-02-06'),
(2359, 147, 207, 18, 13, NULL, '2017-02-06 17:54:03', '2017-02-06'),
(2358, 147, 207, 18, 13, NULL, '2017-02-06 17:48:03', '2017-02-06'),
(2357, 147, 207, 18, 13, NULL, '2017-02-06 17:42:03', '2017-02-06'),
(2356, 147, 207, 18, 13, NULL, '2017-02-06 17:36:03', '2017-02-06'),
(2355, 147, 207, 18, 13, NULL, '2017-02-06 17:30:03', '2017-02-06'),
(2354, 147, 207, 18, 13, NULL, '2017-02-06 17:24:03', '2017-02-06'),
(2353, 147, 207, 18, 13, NULL, '2017-02-06 17:18:03', '2017-02-06'),
(2352, 147, 207, 18, 13, NULL, '2017-02-06 17:12:03', '2017-02-06'),
(2351, 147, 207, 18, 13, NULL, '2017-02-06 17:06:03', '2017-02-06'),
(2350, 147, 207, 18, 13, NULL, '2017-02-06 17:00:03', '2017-02-06'),
(2349, 147, 207, 18, 13, NULL, '2017-02-06 16:54:03', '2017-02-06'),
(2348, 147, 207, 18, 13, NULL, '2017-02-06 16:48:03', '2017-02-06'),
(2347, 147, 207, 18, 13, NULL, '2017-02-06 16:42:03', '2017-02-06'),
(2346, 147, 207, 18, 13, NULL, '2017-02-06 16:36:03', '2017-02-06'),
(2345, 147, 207, 18, 13, NULL, '2017-02-06 16:30:03', '2017-02-06'),
(2344, 147, 207, 18, 13, NULL, '2017-02-06 16:24:03', '2017-02-06'),
(2343, 147, 207, 18, 13, NULL, '2017-02-06 16:18:03', '2017-02-06'),
(2342, 147, 207, 18, 13, NULL, '2017-02-06 16:12:03', '2017-02-06'),
(2341, 147, 207, 18, 13, NULL, '2017-02-06 16:06:03', '2017-02-06'),
(2340, 147, 207, 18, 13, NULL, '2017-02-06 16:00:03', '2017-02-06'),
(2339, 147, 207, 18, 13, NULL, '2017-02-06 15:54:03', '2017-02-06'),
(2338, 147, 207, 18, 13, NULL, '2017-02-06 15:48:03', '2017-02-06'),
(2337, 147, 207, 18, 13, NULL, '2017-02-06 15:42:03', '2017-02-06'),
(2336, 147, 207, 18, 13, NULL, '2017-02-06 15:36:03', '2017-02-06'),
(2335, 147, 207, 18, 13, NULL, '2017-02-06 15:30:03', '2017-02-06'),
(2334, 147, 207, 18, 13, NULL, '2017-02-06 15:24:03', '2017-02-06'),
(2333, 147, 207, 18, 13, NULL, '2017-02-06 15:18:03', '2017-02-06'),
(2332, 147, 207, 18, 13, NULL, '2017-02-06 15:12:03', '2017-02-06'),
(2331, 147, 207, 18, 13, NULL, '2017-02-06 15:06:03', '2017-02-06'),
(2330, 147, 207, 18, 13, NULL, '2017-02-06 15:00:03', '2017-02-06'),
(2329, 147, 207, 18, 13, NULL, '2017-02-06 14:54:03', '2017-02-06'),
(2328, 147, 207, 18, 13, NULL, '2017-02-06 14:48:03', '2017-02-06'),
(2327, 147, 207, 18, 13, NULL, '2017-02-06 14:42:03', '2017-02-06'),
(2326, 147, 207, 18, 13, NULL, '2017-02-06 14:36:03', '2017-02-06'),
(2325, 147, 207, 18, 13, NULL, '2017-02-06 14:30:03', '2017-02-06'),
(2324, 147, 207, 18, 13, NULL, '2017-02-06 14:24:03', '2017-02-06'),
(2323, 147, 207, 18, 13, NULL, '2017-02-06 14:18:03', '2017-02-06'),
(2322, 147, 207, 18, 13, NULL, '2017-02-06 14:12:03', '2017-02-06'),
(2321, 147, 207, 18, 13, NULL, '2017-02-06 14:06:03', '2017-02-06'),
(2320, 147, 207, 18, 13, NULL, '2017-02-06 14:00:03', '2017-02-06'),
(2319, 147, 207, 18, 13, NULL, '2017-02-06 13:54:03', '2017-02-06'),
(2318, 147, 207, 18, 13, NULL, '2017-02-06 13:48:03', '2017-02-06'),
(2317, 147, 207, 18, 13, NULL, '2017-02-06 13:42:03', '2017-02-06'),
(2316, 147, 207, 18, 13, NULL, '2017-02-06 13:36:03', '2017-02-06'),
(2315, 147, 207, 18, 13, NULL, '2017-02-06 13:30:03', '2017-02-06'),
(2314, 147, 207, 18, 13, NULL, '2017-02-06 13:24:03', '2017-02-06'),
(2313, 147, 207, 18, 13, NULL, '2017-02-06 13:18:03', '2017-02-06'),
(2312, 147, 207, 18, 13, NULL, '2017-02-06 13:12:03', '2017-02-06'),
(2311, 147, 207, 18, 13, NULL, '2017-02-06 13:06:03', '2017-02-06'),
(2310, 149, 210, 18, 13, NULL, '2017-02-05 18:00:12', '2017-02-05'),
(2309, 149, 210, 18, 13, NULL, '2017-02-05 17:54:12', '2017-02-05'),
(2308, 149, 210, 18, 13, NULL, '2017-02-05 17:48:12', '2017-02-05'),
(2307, 149, 210, 18, 13, NULL, '2017-02-05 17:42:12', '2017-02-05'),
(2306, 149, 210, 18, 13, NULL, '2017-02-05 17:36:12', '2017-02-05'),
(2305, 149, 210, 18, 13, NULL, '2017-02-05 17:30:12', '2017-02-05'),
(2304, 149, 210, 18, 13, NULL, '2017-02-05 17:24:12', '2017-02-05'),
(2303, 149, 210, 18, 13, NULL, '2017-02-05 17:18:12', '2017-02-05'),
(2302, 149, 210, 18, 13, NULL, '2017-02-05 17:12:12', '2017-02-05'),
(2301, 149, 210, 18, 13, NULL, '2017-02-05 17:06:12', '2017-02-05'),
(2300, 149, 210, 18, 13, NULL, '2017-02-03 04:00:17', '2017-02-03'),
(2299, 149, 210, 18, 13, NULL, '2017-02-03 03:54:17', '2017-02-03'),
(2298, 149, 210, 18, 13, NULL, '2017-02-03 03:48:17', '2017-02-03'),
(2297, 149, 210, 18, 13, NULL, '2017-02-03 03:42:17', '2017-02-03'),
(2296, 149, 210, 18, 13, NULL, '2017-02-03 03:36:17', '2017-02-03'),
(2295, 149, 210, 18, 13, NULL, '2017-02-03 03:30:17', '2017-02-03'),
(2294, 149, 210, 18, 13, NULL, '2017-02-03 03:24:17', '2017-02-03'),
(2293, 149, 210, 18, 13, NULL, '2017-02-03 03:18:17', '2017-02-03'),
(2292, 149, 210, 18, 13, NULL, '2017-02-03 03:12:17', '2017-02-03'),
(2291, 149, 210, 18, 13, NULL, '2017-02-03 03:06:17', '2017-02-03'),
(2290, 149, 210, 18, 13, NULL, '2017-02-03 03:00:17', '2017-02-03'),
(2289, 149, 210, 18, 13, NULL, '2017-02-03 02:54:17', '2017-02-03'),
(2288, 149, 210, 18, 13, NULL, '2017-02-03 02:48:17', '2017-02-03'),
(2287, 149, 210, 18, 13, NULL, '2017-02-03 02:42:17', '2017-02-03'),
(2286, 149, 210, 18, 13, NULL, '2017-02-03 02:36:17', '2017-02-03'),
(2285, 149, 210, 18, 13, NULL, '2017-02-03 02:30:17', '2017-02-03'),
(2284, 149, 210, 18, 13, NULL, '2017-02-03 02:24:17', '2017-02-03'),
(2283, 149, 210, 18, 13, NULL, '2017-02-03 02:18:17', '2017-02-03'),
(2282, 149, 210, 18, 13, NULL, '2017-02-03 02:12:17', '2017-02-03'),
(2281, 149, 210, 18, 13, NULL, '2017-02-03 02:06:17', '2017-02-03'),
(2280, 149, 210, 18, 13, NULL, '2017-02-03 02:00:17', '2017-02-03'),
(2279, 149, 210, 18, 13, NULL, '2017-02-03 01:54:17', '2017-02-03'),
(2278, 149, 210, 18, 13, NULL, '2017-02-03 01:48:17', '2017-02-03'),
(2277, 149, 210, 18, 13, NULL, '2017-02-03 01:42:17', '2017-02-03'),
(2276, 149, 210, 18, 13, NULL, '2017-02-03 01:36:17', '2017-02-03'),
(2275, 149, 210, 18, 13, NULL, '2017-02-03 01:30:17', '2017-02-03'),
(2274, 149, 210, 18, 13, NULL, '2017-02-03 01:24:17', '2017-02-03'),
(2273, 149, 210, 18, 13, NULL, '2017-02-03 01:18:17', '2017-02-03'),
(2272, 149, 210, 18, 13, NULL, '2017-02-03 01:12:17', '2017-02-03'),
(2271, 149, 210, 18, 13, NULL, '2017-02-03 01:06:17', '2017-02-03'),
(2270, 149, 210, 18, 13, NULL, '2017-02-03 01:00:17', '2017-02-03'),
(2269, 149, 210, 18, 13, NULL, '2017-02-03 00:54:17', '2017-02-03'),
(2268, 149, 210, 18, 13, NULL, '2017-02-03 00:48:17', '2017-02-03'),
(2267, 149, 210, 18, 13, NULL, '2017-02-03 00:42:17', '2017-02-03'),
(2266, 149, 210, 18, 13, NULL, '2017-02-03 00:36:17', '2017-02-03'),
(2265, 149, 210, 18, 13, NULL, '2017-02-03 00:30:17', '2017-02-03'),
(2264, 149, 210, 18, 13, NULL, '2017-02-03 00:24:17', '2017-02-03'),
(2263, 149, 210, 18, 13, NULL, '2017-02-03 00:18:17', '2017-02-03'),
(2262, 149, 210, 18, 13, NULL, '2017-02-03 00:12:17', '2017-02-03'),
(2261, 149, 210, 18, 13, NULL, '2017-02-03 00:06:17', '2017-02-03'),
(2260, 143, 196, 18, 13, NULL, '2017-02-03 23:00:28', '2017-02-03'),
(2259, 143, 196, 18, 13, NULL, '2017-02-03 22:54:28', '2017-02-03'),
(2258, 143, 196, 18, 13, NULL, '2017-02-03 22:48:28', '2017-02-03'),
(2257, 143, 196, 18, 13, NULL, '2017-02-03 22:42:28', '2017-02-03'),
(2256, 143, 196, 18, 13, NULL, '2017-02-03 22:36:28', '2017-02-03'),
(2255, 143, 196, 18, 13, NULL, '2017-02-03 22:30:28', '2017-02-03'),
(2254, 143, 196, 18, 13, NULL, '2017-02-03 22:24:28', '2017-02-03'),
(2253, 143, 196, 18, 13, NULL, '2017-02-03 22:18:28', '2017-02-03'),
(2252, 143, 196, 18, 13, NULL, '2017-02-03 22:12:28', '2017-02-03'),
(2251, 143, 196, 18, 13, NULL, '2017-02-03 22:06:28', '2017-02-03'),
(2250, 143, 196, 18, 13, NULL, '2017-02-03 22:00:28', '2017-02-03'),
(2249, 143, 196, 18, 13, NULL, '2017-02-03 21:54:28', '2017-02-03'),
(2248, 143, 196, 18, 13, NULL, '2017-02-03 21:48:28', '2017-02-03'),
(2247, 143, 196, 18, 13, NULL, '2017-02-03 21:42:28', '2017-02-03'),
(2246, 143, 196, 18, 13, NULL, '2017-02-03 21:36:28', '2017-02-03'),
(2245, 143, 196, 18, 13, NULL, '2017-02-03 21:30:28', '2017-02-03'),
(2244, 143, 196, 18, 13, NULL, '2017-02-03 21:24:28', '2017-02-03'),
(2243, 143, 196, 18, 13, NULL, '2017-02-03 21:18:28', '2017-02-03'),
(2242, 143, 196, 18, 13, NULL, '2017-02-03 21:12:28', '2017-02-03'),
(2241, 143, 196, 18, 13, NULL, '2017-02-03 21:06:28', '2017-02-03'),
(2240, 143, 196, 18, 13, NULL, '2017-02-03 21:00:28', '2017-02-03'),
(2239, 143, 196, 18, 13, NULL, '2017-02-03 20:54:28', '2017-02-03'),
(2238, 143, 196, 18, 13, NULL, '2017-02-03 20:48:28', '2017-02-03'),
(2237, 143, 196, 18, 13, NULL, '2017-02-03 20:42:28', '2017-02-03'),
(2236, 143, 196, 18, 13, NULL, '2017-02-03 20:36:28', '2017-02-03'),
(2235, 143, 196, 18, 13, NULL, '2017-02-03 20:30:28', '2017-02-03'),
(2234, 143, 196, 18, 13, NULL, '2017-02-03 20:24:28', '2017-02-03'),
(2233, 143, 196, 18, 13, NULL, '2017-02-03 20:18:28', '2017-02-03'),
(2232, 143, 196, 18, 13, NULL, '2017-02-03 20:12:28', '2017-02-03'),
(2231, 143, 196, 18, 13, NULL, '2017-02-03 20:06:28', '2017-02-03'),
(2230, 144, 200, 18, 9, NULL, '2017-01-21 05:00:15', '2017-01-21'),
(2229, 144, 200, 18, 9, NULL, '2017-01-21 04:54:15', '2017-01-21'),
(2228, 144, 200, 18, 9, NULL, '2017-01-21 04:48:15', '2017-01-21'),
(2227, 144, 200, 18, 9, NULL, '2017-01-21 04:42:15', '2017-01-21'),
(2226, 144, 200, 18, 9, NULL, '2017-01-21 04:36:15', '2017-01-21'),
(2225, 144, 200, 18, 9, NULL, '2017-01-21 04:30:15', '2017-01-21'),
(2224, 144, 200, 18, 9, NULL, '2017-01-21 04:24:15', '2017-01-21'),
(2223, 144, 200, 18, 9, NULL, '2017-01-21 04:18:15', '2017-01-21'),
(2222, 144, 200, 18, 9, NULL, '2017-01-21 04:12:15', '2017-01-21'),
(2221, 144, 200, 18, 9, NULL, '2017-01-21 04:06:15', '2017-01-21'),
(2220, 144, 200, 18, 9, NULL, '2017-01-21 04:00:15', '2017-01-21'),
(2219, 144, 200, 18, 9, NULL, '2017-01-21 03:54:15', '2017-01-21'),
(2218, 144, 200, 18, 9, NULL, '2017-01-21 03:48:15', '2017-01-21'),
(2217, 144, 200, 18, 9, NULL, '2017-01-21 03:42:15', '2017-01-21'),
(2216, 144, 200, 18, 9, NULL, '2017-01-21 03:36:15', '2017-01-21'),
(2215, 144, 200, 18, 9, NULL, '2017-01-21 03:30:15', '2017-01-21'),
(2214, 144, 200, 18, 9, NULL, '2017-01-21 03:24:15', '2017-01-21'),
(2213, 144, 200, 18, 9, NULL, '2017-01-21 03:18:15', '2017-01-21'),
(2212, 144, 200, 18, 9, NULL, '2017-01-21 03:12:15', '2017-01-21'),
(2211, 144, 200, 18, 9, NULL, '2017-01-21 03:06:15', '2017-01-21'),
(2210, 144, 200, 18, 9, NULL, '2017-01-21 03:00:15', '2017-01-21'),
(2209, 144, 200, 18, 9, NULL, '2017-01-21 02:54:15', '2017-01-21'),
(2208, 144, 200, 18, 9, NULL, '2017-01-21 02:48:15', '2017-01-21'),
(2207, 144, 200, 18, 9, NULL, '2017-01-21 02:42:15', '2017-01-21'),
(2206, 144, 200, 18, 9, NULL, '2017-01-21 02:36:15', '2017-01-21'),
(2205, 144, 200, 18, 9, NULL, '2017-01-21 02:30:15', '2017-01-21'),
(2204, 144, 200, 18, 9, NULL, '2017-01-21 02:24:15', '2017-01-21'),
(2203, 144, 200, 18, 9, NULL, '2017-01-21 02:18:15', '2017-01-21'),
(2202, 144, 200, 18, 9, NULL, '2017-01-21 02:12:15', '2017-01-21'),
(2201, 144, 200, 18, 9, NULL, '2017-01-21 02:06:15', '2017-01-21'),
(2200, 144, 200, 18, 9, NULL, '2017-01-21 02:00:15', '2017-01-21'),
(2199, 144, 200, 18, 9, NULL, '2017-01-21 01:54:15', '2017-01-21'),
(2198, 144, 200, 18, 9, NULL, '2017-01-21 01:48:15', '2017-01-21'),
(2197, 144, 200, 18, 9, NULL, '2017-01-21 01:42:15', '2017-01-21'),
(2196, 144, 200, 18, 9, NULL, '2017-01-21 01:36:15', '2017-01-21'),
(2195, 144, 200, 18, 9, NULL, '2017-01-21 01:30:15', '2017-01-21'),
(2194, 144, 200, 18, 9, NULL, '2017-01-21 01:24:15', '2017-01-21'),
(2193, 144, 200, 18, 9, NULL, '2017-01-21 01:18:15', '2017-01-21'),
(2192, 144, 200, 18, 9, NULL, '2017-01-21 01:12:15', '2017-01-21'),
(2191, 144, 200, 18, 9, NULL, '2017-01-21 01:06:15', '2017-01-21'),
(2190, 144, 200, 18, 9, NULL, '2017-01-21 01:00:15', '2017-01-21'),
(2189, 144, 200, 18, 9, NULL, '2017-01-21 00:54:15', '2017-01-21'),
(2188, 144, 200, 18, 9, NULL, '2017-01-21 00:48:15', '2017-01-21'),
(2187, 144, 200, 18, 9, NULL, '2017-01-21 00:42:15', '2017-01-21'),
(2186, 144, 200, 18, 9, NULL, '2017-01-21 00:36:15', '2017-01-21'),
(2185, 144, 200, 18, 9, NULL, '2017-01-21 00:30:15', '2017-01-21'),
(2184, 144, 200, 18, 9, NULL, '2017-01-21 00:24:15', '2017-01-21'),
(2183, 144, 200, 18, 9, NULL, '2017-01-21 00:18:15', '2017-01-21'),
(2182, 144, 200, 18, 9, NULL, '2017-01-21 00:12:15', '2017-01-21'),
(2181, 144, 200, 18, 9, NULL, '2017-01-21 00:06:15', '2017-01-21'),
(2180, 143, 196, 18, 13, NULL, '2017-01-19 06:00:03', '2017-01-19'),
(2179, 143, 196, 18, 13, NULL, '2017-01-19 05:54:03', '2017-01-19'),
(2178, 143, 196, 18, 13, NULL, '2017-01-19 05:48:03', '2017-01-19'),
(2177, 143, 196, 18, 13, NULL, '2017-01-19 05:42:03', '2017-01-19'),
(2176, 143, 196, 18, 13, NULL, '2017-01-19 05:36:03', '2017-01-19'),
(2175, 143, 196, 18, 13, NULL, '2017-01-19 05:30:03', '2017-01-19'),
(2174, 143, 196, 18, 13, NULL, '2017-01-19 05:24:03', '2017-01-19'),
(2173, 143, 196, 18, 13, NULL, '2017-01-19 05:18:03', '2017-01-19'),
(2172, 143, 196, 18, 13, NULL, '2017-01-19 05:12:03', '2017-01-19'),
(2171, 143, 196, 18, 13, NULL, '2017-01-19 05:06:03', '2017-01-19'),
(2170, 143, 196, 18, 13, NULL, '2017-01-19 05:00:03', '2017-01-19'),
(2169, 143, 196, 18, 13, NULL, '2017-01-19 04:54:03', '2017-01-19'),
(2168, 143, 196, 18, 13, NULL, '2017-01-19 04:48:03', '2017-01-19'),
(2167, 143, 196, 18, 13, NULL, '2017-01-19 04:42:03', '2017-01-19'),
(2166, 143, 196, 18, 13, NULL, '2017-01-19 04:36:03', '2017-01-19'),
(2165, 143, 196, 18, 13, NULL, '2017-01-19 04:30:03', '2017-01-19'),
(2164, 143, 196, 18, 13, NULL, '2017-01-19 04:24:03', '2017-01-19'),
(2163, 143, 196, 18, 13, NULL, '2017-01-19 04:18:03', '2017-01-19'),
(2162, 143, 196, 18, 13, NULL, '2017-01-19 04:12:03', '2017-01-19'),
(2161, 143, 196, 18, 13, NULL, '2017-01-19 04:06:03', '2017-01-19'),
(2160, 143, 196, 18, 13, NULL, '2017-01-19 04:00:03', '2017-01-19'),
(2159, 143, 196, 18, 13, NULL, '2017-01-19 03:54:03', '2017-01-19'),
(2158, 143, 196, 18, 13, NULL, '2017-01-19 03:48:03', '2017-01-19'),
(2157, 143, 196, 18, 13, NULL, '2017-01-19 03:42:03', '2017-01-19'),
(2156, 143, 196, 18, 13, NULL, '2017-01-19 03:36:03', '2017-01-19'),
(2155, 143, 196, 18, 13, NULL, '2017-01-19 03:30:03', '2017-01-19'),
(2154, 143, 196, 18, 13, NULL, '2017-01-19 03:24:03', '2017-01-19'),
(2153, 143, 196, 18, 13, NULL, '2017-01-19 03:18:03', '2017-01-19'),
(2152, 143, 196, 18, 13, NULL, '2017-01-19 03:12:03', '2017-01-19'),
(2151, 143, 196, 18, 13, NULL, '2017-01-19 03:06:03', '2017-01-19'),
(2150, 143, 196, 18, 13, NULL, '2017-01-19 03:00:03', '2017-01-19'),
(2149, 143, 196, 18, 13, NULL, '2017-01-19 02:54:03', '2017-01-19'),
(2148, 143, 196, 18, 13, NULL, '2017-01-19 02:48:03', '2017-01-19'),
(2147, 143, 196, 18, 13, NULL, '2017-01-19 02:42:03', '2017-01-19'),
(2146, 143, 196, 18, 13, NULL, '2017-01-19 02:36:03', '2017-01-19'),
(2145, 143, 196, 18, 13, NULL, '2017-01-19 02:30:03', '2017-01-19'),
(2144, 143, 196, 18, 13, NULL, '2017-01-19 02:24:03', '2017-01-19'),
(2143, 143, 196, 18, 13, NULL, '2017-01-19 02:18:03', '2017-01-19'),
(2142, 143, 196, 18, 13, NULL, '2017-01-19 02:12:03', '2017-01-19'),
(2141, 143, 196, 18, 13, NULL, '2017-01-19 02:06:03', '2017-01-19'),
(2140, 143, 196, 18, 13, NULL, '2017-01-19 02:00:03', '2017-01-19'),
(2139, 143, 196, 18, 13, NULL, '2017-01-19 01:54:03', '2017-01-19'),
(2138, 143, 196, 18, 13, NULL, '2017-01-19 01:48:03', '2017-01-19'),
(2137, 143, 196, 18, 13, NULL, '2017-01-19 01:42:03', '2017-01-19'),
(2136, 143, 196, 18, 13, NULL, '2017-01-19 01:36:03', '2017-01-19'),
(2135, 143, 196, 18, 13, NULL, '2017-01-19 01:30:03', '2017-01-19'),
(2134, 143, 196, 18, 13, NULL, '2017-01-19 01:24:03', '2017-01-19'),
(2133, 143, 196, 18, 13, NULL, '2017-01-19 01:18:03', '2017-01-19'),
(2132, 143, 196, 18, 13, NULL, '2017-01-19 01:12:03', '2017-01-19'),
(2131, 143, 196, 18, 13, NULL, '2017-01-19 01:06:03', '2017-01-19'),
(2130, 143, 196, 18, 13, NULL, '2017-01-17 21:00:49', '2017-01-17'),
(2129, 143, 196, 18, 13, NULL, '2017-01-17 20:54:49', '2017-01-17'),
(2128, 143, 196, 18, 13, NULL, '2017-01-17 20:48:49', '2017-01-17'),
(2127, 143, 196, 18, 13, NULL, '2017-01-17 20:42:49', '2017-01-17'),
(2126, 143, 196, 18, 13, NULL, '2017-01-17 20:36:49', '2017-01-17'),
(2125, 143, 196, 18, 13, NULL, '2017-01-17 20:30:49', '2017-01-17'),
(2124, 143, 196, 18, 13, NULL, '2017-01-17 20:24:49', '2017-01-17'),
(2123, 143, 196, 18, 13, NULL, '2017-01-17 20:18:49', '2017-01-17'),
(2122, 143, 196, 18, 13, NULL, '2017-01-17 20:12:49', '2017-01-17'),
(2121, 143, 196, 18, 13, NULL, '2017-01-17 20:06:49', '2017-01-17'),
(2120, 143, 196, 18, 13, NULL, '2017-01-17 20:00:49', '2017-01-17'),
(2119, 143, 196, 18, 13, NULL, '2017-01-17 19:54:49', '2017-01-17'),
(2118, 143, 196, 18, 13, NULL, '2017-01-17 19:48:49', '2017-01-17'),
(2117, 143, 196, 18, 13, NULL, '2017-01-17 19:42:49', '2017-01-17'),
(2116, 143, 196, 18, 13, NULL, '2017-01-17 19:36:49', '2017-01-17'),
(2115, 143, 196, 18, 13, NULL, '2017-01-17 19:30:49', '2017-01-17'),
(2114, 143, 196, 18, 13, NULL, '2017-01-17 19:24:49', '2017-01-17'),
(2113, 143, 196, 18, 13, NULL, '2017-01-17 19:18:49', '2017-01-17'),
(2112, 143, 196, 18, 13, NULL, '2017-01-17 19:12:49', '2017-01-17'),
(2111, 143, 196, 18, 13, NULL, '2017-01-17 19:06:49', '2017-01-17'),
(2110, 143, 196, 18, 13, NULL, '2017-01-17 19:00:49', '2017-01-17'),
(2109, 143, 196, 18, 13, NULL, '2017-01-17 18:54:49', '2017-01-17'),
(2108, 143, 196, 18, 13, NULL, '2017-01-17 18:48:49', '2017-01-17'),
(2107, 143, 196, 18, 13, NULL, '2017-01-17 18:42:49', '2017-01-17'),
(2106, 143, 196, 18, 13, NULL, '2017-01-17 18:36:49', '2017-01-17'),
(2105, 143, 196, 18, 13, NULL, '2017-01-17 18:30:49', '2017-01-17'),
(2104, 143, 196, 18, 13, NULL, '2017-01-17 18:24:49', '2017-01-17'),
(2103, 143, 196, 18, 13, NULL, '2017-01-17 18:18:49', '2017-01-17'),
(2102, 143, 196, 18, 13, NULL, '2017-01-17 18:12:49', '2017-01-17'),
(2101, 143, 196, 18, 13, NULL, '2017-01-17 18:06:49', '2017-01-17'),
(2100, 143, 196, 18, 13, NULL, '2017-01-16 05:00:38', '2017-01-16'),
(2099, 143, 196, 18, 13, NULL, '2017-01-16 04:54:38', '2017-01-16'),
(2098, 143, 196, 18, 13, NULL, '2017-01-16 04:48:38', '2017-01-16'),
(2097, 143, 196, 18, 13, NULL, '2017-01-16 04:42:38', '2017-01-16'),
(2096, 143, 196, 18, 13, NULL, '2017-01-16 04:36:38', '2017-01-16'),
(2095, 143, 196, 18, 13, NULL, '2017-01-16 04:30:38', '2017-01-16'),
(2094, 143, 196, 18, 13, NULL, '2017-01-16 04:24:38', '2017-01-16'),
(2093, 143, 196, 18, 13, NULL, '2017-01-16 04:18:38', '2017-01-16'),
(2092, 143, 196, 18, 13, NULL, '2017-01-16 04:12:38', '2017-01-16'),
(2091, 143, 196, 18, 13, NULL, '2017-01-16 04:06:38', '2017-01-16'),
(2090, 143, 196, 18, 13, NULL, '2017-01-16 04:00:38', '2017-01-16'),
(2089, 143, 196, 18, 13, NULL, '2017-01-16 03:54:38', '2017-01-16'),
(2088, 143, 196, 18, 13, NULL, '2017-01-16 03:48:38', '2017-01-16'),
(2087, 143, 196, 18, 13, NULL, '2017-01-16 03:42:38', '2017-01-16'),
(2086, 143, 196, 18, 13, NULL, '2017-01-16 03:36:38', '2017-01-16'),
(2085, 143, 196, 18, 13, NULL, '2017-01-16 03:30:38', '2017-01-16'),
(2084, 143, 196, 18, 13, NULL, '2017-01-16 03:24:38', '2017-01-16'),
(2083, 143, 196, 18, 13, NULL, '2017-01-16 03:18:38', '2017-01-16'),
(2082, 143, 196, 18, 13, NULL, '2017-01-16 03:12:38', '2017-01-16'),
(2081, 143, 196, 18, 13, NULL, '2017-01-16 03:06:38', '2017-01-16'),
(2080, 143, 196, 18, 13, NULL, '2017-01-16 03:00:38', '2017-01-16'),
(2079, 143, 196, 18, 13, NULL, '2017-01-16 02:54:38', '2017-01-16'),
(2078, 143, 196, 18, 13, NULL, '2017-01-16 02:48:38', '2017-01-16'),
(2077, 143, 196, 18, 13, NULL, '2017-01-16 02:42:38', '2017-01-16'),
(2076, 143, 196, 18, 13, NULL, '2017-01-16 02:36:38', '2017-01-16'),
(2075, 143, 196, 18, 13, NULL, '2017-01-16 02:30:38', '2017-01-16'),
(2074, 143, 196, 18, 13, NULL, '2017-01-16 02:24:38', '2017-01-16'),
(2073, 143, 196, 18, 13, NULL, '2017-01-16 02:18:38', '2017-01-16'),
(2072, 143, 196, 18, 13, NULL, '2017-01-16 02:12:38', '2017-01-16'),
(2071, 143, 196, 18, 13, NULL, '2017-01-16 02:06:38', '2017-01-16'),
(2070, 143, 196, 18, 13, NULL, '2017-01-16 02:00:38', '2017-01-16'),
(2069, 143, 196, 18, 13, NULL, '2017-01-16 01:54:38', '2017-01-16'),
(2068, 143, 196, 18, 13, NULL, '2017-01-16 01:48:38', '2017-01-16'),
(2067, 143, 196, 18, 13, NULL, '2017-01-16 01:42:38', '2017-01-16'),
(2066, 143, 196, 18, 13, NULL, '2017-01-16 01:36:38', '2017-01-16'),
(2065, 143, 196, 18, 13, NULL, '2017-01-16 01:30:38', '2017-01-16'),
(2064, 143, 196, 18, 13, NULL, '2017-01-16 01:24:38', '2017-01-16'),
(2063, 143, 196, 18, 13, NULL, '2017-01-16 01:18:38', '2017-01-16'),
(2062, 143, 196, 18, 13, NULL, '2017-01-16 01:12:38', '2017-01-16'),
(2061, 143, 196, 18, 13, NULL, '2017-01-16 01:06:38', '2017-01-16'),
(2060, 143, 196, 18, 13, NULL, '2017-01-16 01:00:38', '2017-01-16'),
(2059, 143, 196, 18, 13, NULL, '2017-01-16 00:54:38', '2017-01-16'),
(2058, 143, 196, 18, 13, NULL, '2017-01-16 00:48:38', '2017-01-16'),
(2057, 143, 196, 18, 13, NULL, '2017-01-16 00:42:38', '2017-01-16'),
(2056, 143, 196, 18, 13, NULL, '2017-01-16 00:36:38', '2017-01-16'),
(2055, 143, 196, 18, 13, NULL, '2017-01-16 00:30:38', '2017-01-16'),
(2054, 143, 196, 18, 13, NULL, '2017-01-16 00:24:38', '2017-01-16'),
(2053, 143, 196, 18, 13, NULL, '2017-01-16 00:18:38', '2017-01-16'),
(2052, 143, 196, 18, 13, NULL, '2017-01-16 00:12:38', '2017-01-16'),
(2051, 143, 196, 18, 13, NULL, '2017-01-16 00:06:38', '2017-01-16');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adminresettoken`
--
ALTER TABLE `adminresettoken`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `billingmethodlist`
--
ALTER TABLE `billingmethodlist`
  ADD PRIMARY KEY (`sr`),
  ADD KEY `sr` (`sr`),
  ADD KEY `attachedTo` (`attachedTo`);

--
-- Index pour la table `ccdetails`
--
ALTER TABLE `ccdetails`
  ADD PRIMARY KEY (`sr`),
  ADD KEY `sr` (`sr`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Index pour la table `daily_hourly_invoice`
--
ALTER TABLE `daily_hourly_invoice`
  ADD PRIMARY KEY (`id_daily_hourly_invoice`);

--
-- Index pour la table `daily_hourly_transaction`
--
ALTER TABLE `daily_hourly_transaction`
  ADD PRIMARY KEY (`id_daily_hourly_transaction`);

--
-- Index pour la table `freelancer_education`
--
ALTER TABLE `freelancer_education`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `instagramtoken`
--
ALTER TABLE `instagramtoken`
  ADD PRIMARY KEY (`instagramtoken_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `job_accepted`
--
ALTER TABLE `job_accepted`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_bid_attachments`
--
ALTER TABLE `job_bid_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `job_conversation`
--
ALTER TABLE `job_conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_conversation_files`
--
ALTER TABLE `job_conversation_files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_hire_end`
--
ALTER TABLE `job_hire_end`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_skills`
--
ALTER TABLE `job_skills`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `job_subcategories`
--
ALTER TABLE `job_subcategories`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Index pour la table `job_workdairy`
--
ALTER TABLE `job_workdairy`
  ADD PRIMARY KEY (`workdairy_id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Index pour la table `paypal_object`
--
ALTER TABLE `paypal_object`
  ADD PRIMARY KEY (`sr`);

--
-- Index pour la table `paypal_pakey`
--
ALTER TABLE `paypal_pakey`
  ADD PRIMARY KEY (`sr`);

--
-- Index pour la table `paypal_pa_object`
--
ALTER TABLE `paypal_pa_object`
  ADD PRIMARY KEY (`sr`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id_skills`);

--
-- Index pour la table `stripe_customerdetail`
--
ALTER TABLE `stripe_customerdetail`
  ADD PRIMARY KEY (`sr`),
  ADD KEY `sr` (`sr`);

--
-- Index pour la table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userpage`
--
ALTER TABLE `userpage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userpageaccess`
--
ALTER TABLE `userpageaccess`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usersection`
--
ALTER TABLE `usersection`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usersectionaccess`
--
ALTER TABLE `usersectionaccess`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usersubpage`
--
ALTER TABLE `usersubpage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usersubpageaccess`
--
ALTER TABLE `usersubpageaccess`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`user_cat_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subcat_id` (`subcat_id`);

--
-- Index pour la table `user_experience`
--
ALTER TABLE `user_experience`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuseraddresses`
--
ALTER TABLE `webuseraddresses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_basic_profile`
--
ALTER TABLE `webuser_basic_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagline` (`tagline`),
  ADD KEY `skills` (`skills`);

--
-- Index pour la table `webuser_payment_methods`
--
ALTER TABLE `webuser_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_portfolio`
--
ALTER TABLE `webuser_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_portfolio_skills`
--
ALTER TABLE `webuser_portfolio_skills`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_skills`
--
ALTER TABLE `webuser_skills`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_tax_information`
--
ALTER TABLE `webuser_tax_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_no` (`tax_no`);

--
-- Index pour la table `webuser_tickets`
--
ALTER TABLE `webuser_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_ticket_messages`
--
ALTER TABLE `webuser_ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webuser_ticket_message_files`
--
ALTER TABLE `webuser_ticket_message_files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `workdairy_tracker`
--
ALTER TABLE `workdairy_tracker`
  ADD PRIMARY KEY (`worktracker_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adminresettoken`
--
ALTER TABLE `adminresettoken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pour la table `billingmethodlist`
--
ALTER TABLE `billingmethodlist`
  MODIFY `sr` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT pour la table `ccdetails`
--
ALTER TABLE `ccdetails`
  MODIFY `sr` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;
--
-- AUTO_INCREMENT pour la table `daily_hourly_invoice`
--
ALTER TABLE `daily_hourly_invoice`
  MODIFY `id_daily_hourly_invoice` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `daily_hourly_transaction`
--
ALTER TABLE `daily_hourly_transaction`
  MODIFY `id_daily_hourly_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `freelancer_education`
--
ALTER TABLE `freelancer_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `instagramtoken`
--
ALTER TABLE `instagramtoken`
  MODIFY `instagramtoken_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT pour la table `job_accepted`
--
ALTER TABLE `job_accepted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT pour la table `job_bids`
--
ALTER TABLE `job_bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `job_bid_attachments`
--
ALTER TABLE `job_bid_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `job_conversation`
--
ALTER TABLE `job_conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT pour la table `job_conversation_files`
--
ALTER TABLE `job_conversation_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `job_feedback`
--
ALTER TABLE `job_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `job_hire_end`
--
ALTER TABLE `job_hire_end`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `job_skills`
--
ALTER TABLE `job_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `job_subcategories`
--
ALTER TABLE `job_subcategories`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT pour la table `job_workdairy`
--
ALTER TABLE `job_workdairy`
  MODIFY `workdairy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT pour la table `paypal_object`
--
ALTER TABLE `paypal_object`
  MODIFY `sr` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `paypal_pakey`
--
ALTER TABLE `paypal_pakey`
  MODIFY `sr` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `paypal_pa_object`
--
ALTER TABLE `paypal_pa_object`
  MODIFY `sr` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `id_skills` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2678;
--
-- AUTO_INCREMENT pour la table `stripe_customerdetail`
--
ALTER TABLE `stripe_customerdetail`
  MODIFY `sr` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT pour la table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `userpage`
--
ALTER TABLE `userpage`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `userpageaccess`
--
ALTER TABLE `userpageaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `usersection`
--
ALTER TABLE `usersection`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `usersectionaccess`
--
ALTER TABLE `usersectionaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `usersubpage`
--
ALTER TABLE `usersubpage`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `usersubpageaccess`
--
ALTER TABLE `usersubpageaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `user_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT pour la table `user_experience`
--
ALTER TABLE `user_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `webuser`
--
ALTER TABLE `webuser`
  MODIFY `webuser_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `webuseraddresses`
--
ALTER TABLE `webuseraddresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `webuser_basic_profile`
--
ALTER TABLE `webuser_basic_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `webuser_payment_methods`
--
ALTER TABLE `webuser_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `webuser_portfolio`
--
ALTER TABLE `webuser_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `webuser_portfolio_skills`
--
ALTER TABLE `webuser_portfolio_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT pour la table `webuser_skills`
--
ALTER TABLE `webuser_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT pour la table `webuser_tax_information`
--
ALTER TABLE `webuser_tax_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `webuser_tickets`
--
ALTER TABLE `webuser_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `webuser_ticket_messages`
--
ALTER TABLE `webuser_ticket_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT pour la table `webuser_ticket_message_files`
--
ALTER TABLE `webuser_ticket_message_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT pour la table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `workdairy_tracker`
--
ALTER TABLE `workdairy_tracker`
  MODIFY `worktracker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2421;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
