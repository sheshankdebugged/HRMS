-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2018 at 07:08 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `title` varchar(225) DEFAULT NULL,
  `send_by_email` varchar(225) DEFAULT NULL,
  `announcement_start_date` varchar(225) DEFAULT NULL,
  `announcement_end_date` varchar(225) DEFAULT NULL,
  `companies` varchar(225) DEFAULT NULL,
  `stations` varchar(225) DEFAULT NULL,
  `department` varchar(225) DEFAULT NULL,
  `employee_types` varchar(225) DEFAULT NULL,
  `employee_categories` varchar(225) DEFAULT NULL,
  `employee_designations` varchar(225) DEFAULT NULL,
  `employee_gender` varchar(225) DEFAULT NULL,
  `employee_project` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) DEFAULT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  `company_name` varchar(225) DEFAULT NULL,
  `legal_trading_name` varchar(225) DEFAULT NULL,
  `registration_number` varchar(225) DEFAULT NULL,
  `company_type` varchar(225) DEFAULT NULL,
  `contact_person` varchar(225) DEFAULT NULL,
  `contact_person_designation` varchar(225) DEFAULT NULL,
  `contact_number` varchar(225) DEFAULT NULL,
  `fax_number` varchar(225) DEFAULT NULL,
  `email_address` varchar(225) DEFAULT NULL,
  `website` varchar(225) DEFAULT NULL,
  `government_tax_number` varchar(225) DEFAULT NULL,
  `province_tax_number` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `state` varchar(225) DEFAULT NULL,
  `zip_code` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `bank_name` varchar(225) DEFAULT NULL,
  `account_title` varchar(225) DEFAULT NULL,
  `account_number` varchar(225) DEFAULT NULL,
  `routing_number` varchar(225) DEFAULT NULL,
  `account_type` varchar(225) DEFAULT NULL,
  `company_vision` text,
  `company_mission` text,
  `company_profile` text,
  `additonal_information` text,
  `status` varchar(225) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `company_name`, `legal_trading_name`, `registration_number`, `company_type`, `contact_person`, `contact_person_designation`, `contact_number`, `fax_number`, `email_address`, `website`, `government_tax_number`, `province_tax_number`, `address`, `city`, `state`, `zip_code`, `country`, `bank_name`, `account_title`, `account_number`, `routing_number`, `account_type`, `company_vision`, `company_mission`, `company_profile`, `additonal_information`, `status`, `created_at`, `updated_at`) VALUES
(1, '7', 'Testing', 'Joshimath', NULL, '8', 'Birendar singh kanwasi', NULL, '9760200546', '74774', 'bkanwasi21@mail.com', 'google.com', '778437875', 'Uttarakhand', 'New Ravogram joshimath chamolie uk', 'City', 'uttrkahnd', '245532', 'uur', 'Bnak name', 'account title', '96996', NULL, '2', 'dfdgfg', 'gfdg', 'fgdf', 'fdgdfg', '1', '2018-12-23 10:02:01', '2018-12-23 10:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `iso_code` varchar(20) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '"0"=>disable, "1"=>enable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `title`, `iso_code`, `country_code`, `status`) VALUES
(1, 'United States', 'US', '+1', 1),
(2, 'Australia', 'AU', '+61', 1),
(3, 'Austria', 'AT', '+43', 1),
(4, 'Belgium', 'BE', '+32', 1),
(5, 'Canada', 'CA', '+1', 1),
(6, 'Czech Republic', 'CZ', '+420', 1),
(7, 'Denmark', 'DK', '+45', 1),
(8, 'Finland', 'FI', '+358', 1),
(9, 'France', 'FR', '+33', 1),
(10, 'Greece', 'GR', '+30', 1),
(11, 'Hong Kong', 'HK', '+852', 1),
(12, 'Ireland', 'IE', '+353', 1),
(13, 'Israel', 'IL', '+972', 1),
(14, 'Italy', 'IT', '+39', 1),
(15, 'Japan', 'JP', '+81', 1),
(16, 'Netherlands', 'NL', '+31', 1),
(17, 'New Zealand', 'NZ', '+64', 1),
(18, 'Poland', 'PL', '+48', 1),
(19, 'Portugal', 'PT', '+351', 1),
(20, 'Romania', 'RO', '+40', 1),
(21, 'Spain', 'ES', '+34', 1),
(22, 'Sweden', 'SE', '+46', 1),
(23, 'Switzerland', 'CH', '+41', 1),
(24, 'United Kingdom', 'GB', '+44', 1),
(25, 'India', 'IN', '+91', 1),
(26, 'Algeria', 'DZ', '+213', 1),
(27, 'Angola', 'AO', '+244', 1),
(28, 'Benin', 'BJ', '+229', 1),
(29, 'Botswana', 'BW', '+267', 1),
(30, 'Burkina Faso', 'BF', '+226', 1),
(31, 'Burundi', 'BI', '+257', 1),
(32, 'Cameroon', 'CM', '+237', 1),
(33, 'Cape Verde', 'CV', '+238', 1),
(34, 'Central African Republic', 'CF', '+236', 1),
(35, 'Chad', 'TD', '+235', 1),
(36, 'Comoros', 'KM', '+269', 1),
(37, 'Congo', 'CG', '+242', 1),
(38, 'Congo, The Democratic Republic of the', 'CD', '+243', 1),
(39, 'Cote D\'Ivoire', 'CI', '+225', 1),
(40, 'Djibouti', 'DJ', '+253', 1),
(41, 'Egypt', 'EG', '+20', 1),
(42, 'Equatorial Guinea', 'GQ', '+240', 1),
(43, 'Eritrea', 'ER', '+291', 1),
(44, 'Ethiopia', 'ET', '+251', 1),
(45, 'Gabon', 'GA', '+241', 1),
(46, 'Gambia', 'GM', '+220', 1),
(47, 'Ghana', 'GH', '+233', 1),
(48, 'Guinea', 'GN', '+224', 1),
(49, 'Guinea-Bissau', 'GW', '+245', 1),
(50, 'Kenya', 'KE', '+254', 1),
(51, 'Lesotho', 'LS', '+266', 1),
(52, 'Liberia', 'LR', '+231', 1),
(53, 'Libya', 'LY', '+218', 1),
(54, 'Madagascar', 'MG', '+261', 1),
(55, 'Malawi', 'MW', '+265', 1),
(56, 'Mali', 'ML', '+223', 1),
(57, 'Mauritania', 'MR', '+222', 1),
(58, 'Mauritius', 'MU', '+230', 1),
(59, 'Mayotte', 'YT', '+269', 1),
(60, 'Morocco', 'MA', '+212', 1),
(61, 'Mozambique', 'MZ', '+258', 1),
(62, 'Namibia', 'NA', '+264', 1),
(63, 'Niger', 'NE', '+227', 1),
(64, 'Nigeria', 'NG', '+234', 1),
(65, 'Rwanda', 'RW', '+250', 1),
(66, 'Saint Helena', 'SH', '+290', 1),
(67, 'Sao Tome and Principe', 'ST', '+239', 1),
(68, 'Senegal', 'SN', '+221', 1),
(69, 'Seychelles', 'SC', '+248', 1),
(70, 'Sierra Leone', 'SL', '+232', 1),
(71, 'Somalia', 'SO', '+252', 1),
(72, 'South Africa', 'ZA', '+27', 1),
(73, 'Sudan', 'SD', '+249', 1),
(74, 'Swaziland', 'SZ', '+268', 1),
(75, 'Tanzania, United Republic of', 'TZ', '+255', 1),
(76, 'Togo', 'TG', '+228', 1),
(77, 'Tunisia', 'TN', '+216', 1),
(78, 'Uganda', 'UG', '+256', 1),
(79, 'Zambia', 'ZM', '+260', 1),
(80, 'Zimbabwe', 'ZW', '+263', 1),
(81, 'Antarctica', 'AQ', '+672', 1),
(82, 'Afghanistan', 'AF', '+93', 1),
(83, 'Bahrain', 'BH', '+973', 1),
(84, 'Bangladesh', 'BD', '+880', 1),
(85, 'Bhutan', 'BT', '+975', 1),
(86, 'Brunei Darussalam', 'BN', '+673', 1),
(87, 'Cambodia', 'KH', '+855', 1),
(88, 'China', 'CN', '+86', 1),
(89, 'India', 'IN', '+91', 1),
(90, 'Indonesia', 'ID', '+62', 1),
(91, 'Iran, Islamic Republic of', 'IR', '+98', 1),
(92, 'Iraq', 'IQ', '+964', 1),
(93, 'Jordan', 'JO', '+962', 1),
(94, 'Kazakhstan', 'KZ', '+7', 1),
(95, 'Korea, Democratic People\'s Republic of', 'KP', '+850', 1),
(96, 'Korea, Republic of', 'KR', '+82', 1),
(97, 'Kuwait', 'KW', '+965', 1),
(98, 'Kyrgyzstan', 'KG', '+996', 1),
(99, 'Lao People\'s Democratic Republic', 'LA', '+856', 1),
(100, 'Lebanon', 'LB', '+961', 1),
(101, 'Macau', 'MO', '+853', 1),
(102, 'Malaysia', 'MY', '+60', 1),
(103, 'Maldives', 'MV', '+960', 1),
(104, 'Mongolia', 'MN', '+976', 1),
(105, 'Myanmar', 'MM', '+95', 1),
(106, 'Nepal', 'NP', '+977', 1),
(107, 'Oman', 'OM', '+968', 1),
(108, 'Pakistan', 'PK', '+92', 1),
(109, 'Philippines', 'PH', '+63', 1),
(110, 'Qatar', 'QA', '+974', 1),
(111, 'Russian Federation', 'RU', '+7', 1),
(112, 'Saudi Arabia', 'SA', '+966', 1),
(113, 'Singapore', 'SG', '+65', 1),
(114, 'Sri Lanka', 'LK', '+94', 1),
(115, 'Syrian Arab Republic', 'SY', '+963', 1),
(116, 'Taiwan', 'TW', '+886', 1),
(117, 'Tajikistan', 'TJ', '+992', 1),
(118, 'Thailand', 'TH', '+66', 1),
(119, 'Turkey', 'TR', '+90', 1),
(120, 'Turkmenistan', 'TM', '+993', 1),
(121, 'United Arab Emirates', 'AE', '+971', 1),
(122, 'Uzbekistan', 'UZ', '+998', 1),
(123, 'Vietnam', 'VN', '+84', 1),
(124, 'Yemen', 'YE', '+967', 1),
(125, 'Cook Islands', 'CK', '+682', 1),
(126, 'Fiji', 'FJ', '+679', 1),
(127, 'Guam', 'GU', '+1 671', 1),
(128, 'Kiribati', 'KI', '+686', 1),
(129, 'Marshall Islands', 'MH', '+692', 1),
(130, 'Micronesia, Federated States of', 'FM', '+691', 1),
(131, 'Nauru', 'NR', '+674', 1),
(132, 'New Caledonia', 'NC', '+687', 1),
(133, 'Niue', 'NU', '+683', 1),
(134, 'Norfolk Island', 'NF', '+672', 1),
(135, 'Northern Mariana Islands', 'MP', '+670', 1),
(136, 'Palau', 'PW', '+680', 1),
(137, 'Papua New Guinea', 'PG', '+675', 1),
(138, 'Reunion', 'RE', '+262', 1),
(139, 'Samoa', 'WS', '+684', 1),
(140, 'Solomon Islands', 'SB', '+677', 1),
(141, 'Tokelau', 'TK', '+690', 1),
(142, 'Tonga', 'TO', '+676', 1),
(143, 'Tuvalu', 'TV', '+688', 1),
(144, 'Vanuatu', 'VU', '+678', 1),
(145, 'Wallis and Futuna', 'WF', '+681', 1),
(146, 'Albania', 'AL', '+355', 1),
(147, 'Andorra', 'AD', '+376', 1),
(148, 'Armenia', 'AM', '+374', 1),
(149, 'Azerbaijan', 'AZ', '+994', 1),
(150, 'Belarus', 'BY', '+375', 1),
(151, 'Bosnia and Herzegovina', 'BA', '+387', 1),
(152, 'Bulgaria', 'BG', '+359', 1),
(153, 'Croatia', 'HR', '+385', 1),
(154, 'Cyprus', 'CY', '+357', 1),
(155, 'Estonia', 'EE', '+372', 1),
(156, 'Faroe Islands', 'FO', '+298', 1),
(157, 'Georgia', 'GE', '+995', 1),
(158, 'Germany', 'DE', '+49', 1),
(159, 'Gibraltar', 'GI', '+350', 1),
(160, 'Hungary', 'HU', '+36', 1),
(161, 'Iceland', 'IS', '+354', 1),
(162, 'Latvia', 'LV', '+371', 1),
(163, 'Liechtenstein', 'LI', '+423', 1),
(164, 'Lithuania', 'LT', '+370', 1),
(165, 'Luxembourg', 'LU', '+352', 1),
(166, 'Macedonia', 'MK', '+389', 1),
(167, 'Malta', 'MT', '+356', 1),
(168, 'Moldova, Republic of', 'MD', '+373', 1),
(169, 'Monaco', 'MC', '+377', 1),
(170, 'Montenegro', 'ME', '+382', 1),
(171, 'Norway', 'NO', '+47', 1),
(172, 'San Marino', 'SM', '+378', 1),
(173, 'Serbia', 'RS', '+381', 1),
(174, 'Slovakia', 'SK', '+421', 1),
(175, 'Slovenia', 'SI', '+386', 1),
(176, 'Ukraine', 'UA', '+380', 1),
(177, 'Vatican City', 'VA', '+39', 1),
(178, 'Antigua and Barbuda', 'AG', '+1', 1),
(179, 'American Samoa', 'AS', '+684', 1),
(180, 'Anguilla', 'AI', '+1', 1),
(181, 'Aruba', 'AW', '+297', 1),
(182, 'Bahamas', 'BS', '+1', 1),
(183, 'Barbados', 'BB', '+1', 1),
(184, 'Belize', 'BZ', '+501', 1),
(185, 'Bermuda', 'BM', '+1', 1),
(186, 'Costa Rica', 'CR', '+506', 1),
(187, 'Cayman Islands', 'KY', '+1', 1),
(188, 'Cuba', 'CU', '+53', 1),
(189, 'Dominica', 'DM', '+1', 1),
(190, 'Dominican Republic', 'DO', '+809', 1),
(191, 'El Salvador', 'SV', '+503', 1),
(192, 'Greenland', 'GL', '+299', 1),
(193, 'Grenada', 'GD', '+1', 1),
(194, 'Guatemala', 'GT', '+502', 1),
(195, 'Guadeloupe', 'GP', '+590', 1),
(196, 'Haiti', 'HT', '+509', 1),
(197, 'Honduras', 'HN', '+504', 1),
(198, 'Jamaica', 'JM', '+1', 1),
(199, 'Martinique', 'MQ', '+596', 1),
(200, 'Mexico', 'MX', '+52', 1),
(201, 'Montserrat', 'MS', '+1', 1),
(202, 'Nicaragua', 'NI', '+505', 1),
(203, 'Panama', 'PA', '+507', 1),
(204, 'Puerto Rico', 'PR', '+1', 1),
(205, 'Saint Kitts and Nevis', 'KN', '+1', 1),
(206, 'Saint Lucia', 'LC', '+1', 1),
(207, 'Saint Pierre and Miquelon', 'PM', '508', 1),
(208, 'Saint Vincent and the Grenadines', 'VC', '+1', 1),
(209, 'Trinidad and Tobago', 'TT', '+1', 1),
(210, 'Turks and Caicos Islands', 'TC', '+1', 1),
(211, 'Virgin Islands, British', 'VG', '+1', 1),
(212, 'Virgin Islands, U.S.', 'VI', '+1', 1),
(213, 'Argentina', 'AR', '+54', 1),
(214, 'Bolivia', 'BO', '+591', 1),
(215, 'Brazil', 'BR', '+55', 1),
(216, 'Chile', 'CL', '+56', 1),
(217, 'Colombia', 'CO', '+57', 1),
(218, 'Ecuador', 'EC', '+593', 1),
(219, 'Falkland Islands (Malvinas)', 'FK', '+500', 1),
(220, 'French Guiana', 'GF', '+594', 1),
(221, 'Guyana', 'GY', '+592', 1),
(222, 'Paraguay', 'PY', '+595', 1),
(223, 'Peru', 'PE', '+51', 1),
(224, 'Suriname', 'SR', '+597', 1),
(225, 'Uruguay', 'UY', '+598', 1),
(226, 'Venezuela', 'VE', '+58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `station` varchar(225) DEFAULT NULL,
  `department_name` varchar(225) DEFAULT NULL,
  `parent_department` varchar(225) DEFAULT NULL,
  `department_head` varchar(225) DEFAULT NULL,
  `assistant_departmant_head` varchar(225) DEFAULT NULL,
  `department_sorting_order` varchar(225) DEFAULT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `record_added_by` varchar(225) DEFAULT NULL,
  `record_added_on` varchar(225) DEFAULT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `created_at` varchar(225) DEFAULT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_candidates`
--

CREATE TABLE `job_candidates` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `job_field` varchar(225) DEFAULT NULL,
  `first_name` varchar(225) DEFAULT NULL,
  `last_name` varchar(225) DEFAULT NULL,
  `date_of_birth` varchar(225) DEFAULT NULL,
  `gender` varchar(225) DEFAULT NULL,
  `nationality` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `state/province` varchar(225) DEFAULT NULL,
  `zip_code/postal_code` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `email_address` varchar(225) DEFAULT NULL,
  `phone_number` varchar(225) DEFAULT NULL,
  `mobile_number` varchar(225) DEFAULT NULL,
  `source` varchar(225) DEFAULT NULL,
  `source_details` varchar(225) DEFAULT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `record_added_by` varchar(225) DEFAULT NULL,
  `record_added_on` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) DEFAULT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_interviews`
--

CREATE TABLE `job_interviews` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `job_post` varchar(225) DEFAULT NULL,
  `interviews_date` varchar(225) DEFAULT NULL,
  `interviews_time` varchar(225) DEFAULT NULL,
  `interviewers(employees)` varchar(225) DEFAULT NULL,
  `place_of_interviews` varchar(225) NOT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `record_added_by` varchar(225) DEFAULT NULL,
  `record_added_on` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) NOT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `job_title` varchar(225) DEFAULT NULL,
  `job_type` varchar(225) DEFAULT NULL,
  `job_field` varchar(225) DEFAULT NULL,
  `job_post_opening_date` varchar(225) DEFAULT NULL,
  `job_post_closing_date` varchar(225) DEFAULT NULL,
  `number_of_positions` varchar(225) DEFAULT NULL,
  `publish_in_jobs_portal` varchar(225) DEFAULT NULL,
  `company` varchar(225) DEFAULT NULL,
  `station` varchar(225) DEFAULT NULL,
  `department` varchar(225) DEFAULT NULL,
  `employees_involved_in` varchar(225) DEFAULT NULL,
  `recruitment_process` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `state_province` varchar(225) DEFAULT NULL,
  `zip_code` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `state` varchar(225) DEFAULT NULL,
  `candidate_age_rang(start)` varchar(225) DEFAULT NULL,
  `candidate_age_rang(end)` varchar(225) DEFAULT NULL,
  `salary_start_range` varchar(225) DEFAULT NULL,
  `salary_end_range` varchar(225) DEFAULT NULL,
  `recruitment_parameters` varchar(225) DEFAULT NULL,
  `approval_levels` varchar(225) DEFAULT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `record_added_by` varchar(225) DEFAULT NULL,
  `record_added_on` varchar(225) DEFAULT NULL,
  `is_deleted` int(4) NOT NULL DEFAULT '0',
  `created_at` varchar(225) DEFAULT NULL,
  `updated_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `user_id`, `job_title`, `job_type`, `job_field`, `job_post_opening_date`, `job_post_closing_date`, `number_of_positions`, `publish_in_jobs_portal`, `company`, `station`, `department`, `employees_involved_in`, `recruitment_process`, `city`, `state_province`, `zip_code`, `country`, `state`, `candidate_age_rang(start)`, `candidate_age_rang(end)`, `salary_start_range`, `salary_end_range`, `recruitment_parameters`, `approval_levels`, `notes`, `status`, `record_added_by`, `record_added_on`, `is_deleted`, `created_at`, `updated_at`) VALUES
(NULL, '7', 'ggg', '2', '2', 'fff', 'gg', '1', '1', 'fff', 'ff', 'vvv', 'cc', NULL, 'hh', NULL, '246443', '3', 'fff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, '2018-12-24 04:33:49', '2018-12-24 04:33:49'),
(NULL, '7', 'ggg', '0', NULL, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, '2018-12-24 04:35:44', '2018-12-24 04:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `forward_application` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_test`
--

CREATE TABLE `job_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_post` int(11) NOT NULL,
  `test_title` int(11) NOT NULL,
  `notes` int(11) NOT NULL,
  `record` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization_news`
--

CREATE TABLE `organization_news` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `news_title` varchar(225) DEFAULT NULL,
  `news_details` varchar(225) DEFAULT NULL,
  `news_images` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) DEFAULT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company` varchar(225) DEFAULT NULL,
  `division` varchar(225) DEFAULT NULL,
  `parent_station` int(11) DEFAULT NULL,
  `station_type` varchar(225) DEFAULT NULL,
  `station_name` varchar(225) DEFAULT NULL,
  `time_zone` varchar(225) DEFAULT NULL,
  `currency` varchar(225) DEFAULT NULL,
  `currency_sign` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `state_province` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `phone_number` varchar(225) DEFAULT NULL,
  `fax_number` varchar(225) DEFAULT NULL,
  `zip_code` varchar(225) DEFAULT NULL,
  `email_address` varchar(225) DEFAULT NULL,
  `website` varchar(225) DEFAULT NULL,
  `latitude` varchar(225) DEFAULT NULL,
  `longitude` varchar(225) DEFAULT NULL,
  `geo_fence_radius` varchar(225) DEFAULT NULL,
  `additonal_information` text,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `user_id`, `company`, `division`, `parent_station`, `station_type`, `station_name`, `time_zone`, `currency`, `currency_sign`, `address`, `city`, `state_province`, `country`, `phone_number`, `fax_number`, `zip_code`, `email_address`, `website`, `latitude`, `longitude`, `geo_fence_radius`, `additonal_information`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'sddfjhg', 'Head Office', NULL, 'Head Office', 'Station nameeferer', 'Kwajalein', 'USD', '$', 'Adssfljk', 'cdsfsf', 'dfsdf', 'dsfsdf', 'dsfdsf', 'dsfsdf', 'dsfsdf', 'fdsf', 'dsfsdf', 'dfsf', 'dsfsdf', 'sdfsdf', 'dsfsdf', 1, '2018-12-23 11:11:59', '2018-12-23 11:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `employees_last_login` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) DEFAULT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` varchar(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `genreral_setting` varchar(225) DEFAULT NULL,
  `system_administrators` varchar(225) DEFAULT NULL,
  `interface_language` varchar(225) DEFAULT NULL,
  `constants` varchar(225) DEFAULT NULL,
  `i p_restrictions` varchar(225) DEFAULT NULL,
  `security` varchar(225) DEFAULT NULL,
  `data_backup` varchar(225) DEFAULT NULL,
  `organizations_code` varchar(225) DEFAULT NULL,
  `organizations_u r l` varchar(225) DEFAULT NULL,
  `organizations_name` varchar(225) DEFAULT NULL,
  `organizations_starting_year` varchar(225) DEFAULT NULL,
  `first_name` varchar(225) DEFAULT NULL,
  `last_name` varchar(225) DEFAULT NULL,
  `email_address` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `phone_number` varchar(225) DEFAULT NULL,
  `delete_logo` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) DEFAULT NULL,
  `update_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) DEFAULT NULL,
  `remember_token` varchar(225) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Birendar Kanwasi', 'admin@codeslab.in', '$2y$10$c.w6EM0aaPYPTxKWDHT9IesWP0Yh.NyGPySxRLmUjz5QB7zd6O/me', 'OVdNDpYJh32muc7CV2WvhAaoUTTuL2wM0UEfwnYnvGkXEEqfF2cz0NPfg8ei', '2018-08-26 10:51:31', '2018-08-26 10:51:31'),
(3, 'Birendar Kanwasi', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', NULL, '2018-09-09 07:18:21', '2018-09-09 07:18:21'),
(4, 'Birendar Kanwasi', 'biru@gmail.com', '$2y$10$/MPemtqRHPMWiFSZSafGPeewwkmCt6wmMqQiRs.hk1rBBEjq3Em7m', NULL, '2018-09-09 08:19:55', '2018-09-09 08:19:55'),
(5, 'Birendar singh', 'admin@uk.in', '$2y$10$RPu1A5J1ra/JJXGxekXjuuxy5aoiqREO9bj4L8nNUSLsTzpFCKX.6', 'SAQgZohHlLcKOGCaYyMO5PdMjpHbaNhD1ew2Pcp7gdHDeUi82wEo997ZDKwA', '2018-09-20 02:40:23', '2018-09-20 02:40:23'),
(6, 'Birendar Kanwasi', 'bnmklopty@gmail.com', '$2y$10$/RMCatWTtzs/o6P8RnGJYeAB4WHb6AmmV4ANBrtXjz9LV4Qrzq8Da', 'OXzJnJXuXWgbCsteuvPW5mymfzUoB7U7h7tiPqYFCQGpByEbb5gsez9pq67N', '2018-11-18 14:32:17', '2018-11-18 14:32:17'),
(7, 'Birendar', 'bkanwasi21@gmail.com', '$2y$10$2ExlSc4S.fGPAhV/E9qFieKZskTY4cvZmKgAasRsw9s6SnNcrY0m.', 'PX7R0v8D9nZBzo5f5Gi0Ie1HWe3P3VBsBAYUNwblKHN6djXcY8GJJx3jL3e6', '2018-12-22 07:18:37', '2018-12-22 07:18:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
