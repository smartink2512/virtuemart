<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
@ini_set( "max_execution_time", "120" );

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_auth_user_vendor` (
	  `user_id` varchar(32) default NULL,
	  `vendor_id` int(11) default NULL,
	  KEY `idx_auth_user_vendor_user_id` (`user_id`),
	  KEY `idx_auth_user_vendor_vendor_id` (`vendor_id`)
		) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `user_info_id` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `address_type` char(2) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `address_type_name` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `company` varchar(64) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `title` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `last_name` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `first_name` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `middle_name` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `phone_1` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `phone_2` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `fax` varchar(32) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `address_1` varchar(64) NOT NULL default '';" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `address_2` varchar(64) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `city` varchar(32) NOT NULL default '';" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `state` varchar(32) NOT NULL default '';" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `country` varchar(32) NOT NULL default 'US';" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `zip` varchar(32) NOT NULL default '';" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `extra_field_1` varchar(255) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `extra_field_2` varchar(255) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `extra_field_3` varchar(255) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `extra_field_4` char(1) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `extra_field_5` char(1) default NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `perms` VARCHAR( 40 ) DEFAULT 'shopper' NOT NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `bank_account_nr` varchar(32) NOT NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `bank_name` varchar(32) NOT NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `bank_sort_code` varchar(16) NOT NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `bank_iban` varchar(64) NOT NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `bank_account_holder` varchar(48) NOT NULL;" ); $database->query();
$database->setQuery( "ALTER TABLE #__users ADD  `bank_account_type` ENUM( 'Checking', 'Business Checking', 'Savings' ) DEFAULT 'Checking' NOT NULL;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_category` (
  `category_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL default '0',
  `category_name` varchar(128) NOT NULL default '',
  `category_description` text,
  `category_thumb_image` varchar(255) default NULL,
  `category_full_image` varchar(255) default NULL,
  `category_publish` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `category_browsepage` VARCHAR( 255 ) DEFAULT 'browse_1' NOT NULL,
  `products_per_row` TINYINT( 2 ) DEFAULT '1' NOT NULL,
  `category_flypage` varchar(255) default NULL,
  `list_order`int(11) default NULL,
  PRIMARY KEY  (`category_id`),
  KEY `idx_category_vendor_id` (`vendor_id`),
  KEY `idx_category_name` (`category_name`)
) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_category_xref` (
  `category_parent_id` INT( 11 ) NOT NULL,
  `category_child_id` INT( 11 ) NOT NULL,
  `category_list` int(11) default NULL,
  KEY `category_xref_category_parent_id` (`category_parent_id`),
  KEY `category_xref_category_child_id` (`category_child_id`),
  KEY `idx_category_xref_category_list` (`category_list`)
) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_country` (
  `country_id` int(11) NOT NULL auto_increment,
  `zone_id` int(11) NOT NULL default '1',
  `country_name` varchar(64) default NULL,
  `country_3_code` char(3) default NULL,
  `country_2_code` char(2) default NULL,
  PRIMARY KEY  (`country_id`),
  KEY `idx_country_name` (`country_name`)
) TYPE=MyISAM AUTO_INCREMENT=240 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_country` VALUES (1, 1, 'Afghanistan', 'AFG', 'AF'),
  (2, 1, 'Albania', 'ALB', 'AL'),	(3, 1, 'Algeria', 'DZA', 'DZ'),	(4, 1, 'American Samoa', 'ASM', 'AS'),
  (5, 1, 'Andorra', 'AND', 'AD'),	(6, 1, 'Angola', 'AGO', 'AO'),	(7, 1, 'Anguilla', 'AIA', 'AI'),
  (8, 1, 'Antarctica', 'ATA', 'AQ'),	(9, 1, 'Antigua and Barbuda', 'ATG', 'AG'),	(10, 1, 'Argentina', 'ARG', 'AR'),
  (11, 1, 'Armenia', 'ARM', 'AM'),	(12, 1, 'Aruba', 'ABW', 'AW'),	(13, 1, 'Australia', 'AUS', 'AU'),
  (14, 1, 'Austria', 'AUT', 'AT'),	(15, 1, 'Azerbaijan', 'AZE', 'AZ'),	(16, 1, 'Bahamas', 'BHS', 'BS'),
  (17, 1, 'Bahrain', 'BHR', 'BH'),	(18, 1, 'Bangladesh', 'BGD', 'BD'),	(19, 1, 'Barbados', 'BRB', 'BB'),
  (20, 1, 'Belarus', 'BLR', 'BY'),	(21, 1, 'Belgium', 'BEL', 'BE'),	(22, 1, 'Belize', 'BLZ', 'BZ'),
  (23, 1, 'Benin', 'BEN', 'BJ'),	(24, 1, 'Bermuda', 'BMU', 'BM'),	(25, 1, 'Bhutan', 'BTN', 'BT'),
  (26, 1, 'Bolivia', 'BOL', 'BO'),	(27, 1, 'Bosnia and Herzegowina', 'BIH', 'BA'),	(28, 1, 'Botswana', 'BWA', 'BW'),
  (29, 1, 'Bouvet Island', 'BVT', 'BV'),	(30, 1, 'Brazil', 'BRA', 'BR'),	(31, 1, 'British Indian Ocean Territory', 'IOT', 'IO'),
  (32, 1, 'Brunei Darussalam', 'BRN', 'BN'),	(33, 1, 'Bulgaria', 'BGR', 'BG'),	(34, 1, 'Burkina Faso', 'BFA', 'BF'),
  (35, 1, 'Burundi', 'BDI', 'BI'),	(36, 1, 'Cambodia', 'KHM', 'KH'),	(37, 1, 'Cameroon', 'CMR', 'CM'),
  (38, 1, 'Canada', 'CAN', 'CA'),	(39, 1, 'Cape Verde', 'CPV', 'CV'),	(40, 1, 'Cayman Islands', 'CYM', 'KY'),
  (41, 1, 'Central African Republic', 'CAF', 'CF'),	(42, 1, 'Chad', 'TCD', 'TD'),	(43, 1, 'Chile', 'CHL', 'CL'),
  (44, 1, 'China', 'CHN', 'CN'),	(45, 1, 'Christmas Island', 'CXR', 'CX'),	(46, 1, 'Cocos (Keeling) Islands', 'CCK', 'CC'),
  (47, 1, 'Colombia', 'COL', 'CO'),	(48, 1, 'Comoros', 'COM', 'KM'),	(49, 1, 'Congo', 'COG', 'CG'),
  (50, 1, 'Cook Islands', 'COK', 'CK'),	(51, 1, 'Costa Rica', 'CRI', 'CR'),	(52, 1, 'Cote D\'Ivoire', 'CIV', 'CI'),
  (53, 1, 'Croatia', 'HRV', 'HR'),	(54, 1, 'Cuba', 'CUB', 'CU'),	(55, 1, 'Cyprus', 'CYP', 'CY'),
  (56, 1, 'Czech Republic', 'CZE', 'CZ'),	(57, 1, 'Denmark', 'DNK', 'DK'),	(58, 1, 'Djibouti', 'DJI', 'DJ'),
  (59, 1, 'Dominica', 'DMA', 'DM'),	(60, 1, 'Dominican Republic', 'DOM', 'DO'),	(61, 1, 'East Timor', 'TMP', 'TP'),
  (62, 1, 'Ecuador', 'ECU', 'EC'),	(63, 1, 'Egypt', 'EGY', 'EG'),	(64, 1, 'El Salvador', 'SLV', 'SV'),
  (65, 1, 'Equatorial Guinea', 'GNQ', 'GQ'),	(66, 1, 'Eritrea', 'ERI', 'ER'),	(67, 1, 'Estonia', 'EST', 'EE'),
  (68, 1, 'Ethiopia', 'ETH', 'ET'),	(69, 1, 'Falkland Islands (Malvinas)', 'FLK', 'FK'),	(70, 1, 'Faroe Islands', 'FRO', 'FO'),
  (71, 1, 'Fiji', 'FJI', 'FJ'),	(72, 1, 'Finland', 'FIN', 'FI'),	(73, 1, 'France', 'FRA', 'FR'),
  (74, 1, 'France, Metropolitan', 'FXX', 'FX'),	(75, 1, 'French Guiana', 'GUF', 'GF'),	(76, 1, 'French Polynesia', 'PYF', 'PF'),
  (77, 1, 'French Southern Territories', 'ATF', 'TF'),	(78, 1, 'Gabon', 'GAB', 'GA'),	(79, 1, 'Gambia', 'GMB', 'GM'),
  (80, 1, 'Georgia', 'GEO', 'GE'),	(81, 1, 'Germany', 'DEU', 'DE'),	(82, 1, 'Ghana', 'GHA', 'GH'),
  (83, 1, 'Gibraltar', 'GIB', 'GI'),	(84, 1, 'Greece', 'GRC', 'GR'),	(85, 1, 'Greenland', 'GRL', 'GL'),
  (86, 1, 'Grenada', 'GRD', 'GD'),	(87, 1, 'Guadeloupe', 'GLP', 'GP'),	(88, 1, 'Guam', 'GUM', 'GU'),
  (89, 1, 'Guatemala', 'GTM', 'GT'),	(90, 1, 'Guinea', 'GIN', 'GN'),	(91, 1, 'Guinea-bissau', 'GNB', 'GW'),
  (92, 1, 'Guyana', 'GUY', 'GY'),	(93, 1, 'Haiti', 'HTI', 'HT'),	(94, 1, 'Heard and Mc Donald Islands', 'HMD', 'HM'),
  (95, 1, 'Honduras', 'HND', 'HN'),	(96, 1, 'Hong Kong', 'HKG', 'HK'),	(97, 1, 'Hungary', 'HUN', 'HU'),
  (98, 1, 'Iceland', 'ISL', 'IS'),	(99, 1, 'India', 'IND', 'IN'),	(100, 1, 'Indonesia', 'IDN', 'ID'),
  (101, 1, 'Iran (Islamic Republic of)', 'IRN', 'IR'),	(102, 1, 'Iraq', 'IRQ', 'IQ'),	(103, 1, 'Ireland', 'IRL', 'IE'),
  (104, 1, 'Israel', 'ISR', 'IL'),	(105, 1, 'Italy', 'ITA', 'IT'),	(106, 1, 'Jamaica', 'JAM', 'JM'),
  (107, 1, 'Japan', 'JPN', 'JP'),	(108, 1, 'Jordan', 'JOR', 'JO'),	(109, 1, 'Kazakhstan', 'KAZ', 'KZ'),
  (110, 1, 'Kenya', 'KEN', 'KE'),	(111, 1, 'Kiribati', 'KIR', 'KI'),	(112, 1, 'Korea, Democratic People\'s Republic of', 'PRK', 'KP'),
  (113, 1, 'Korea, Republic of', 'KOR', 'KR'),	(114, 1, 'Kuwait', 'KWT', 'KW'),	(115, 1, 'Kyrgyzstan', 'KGZ', 'KG'),
  (116, 1, 'Lao People\'s Democratic Republic', 'LAO', 'LA'),	(117, 1, 'Latvia', 'LVA', 'LV'),	(118, 1, 'Lebanon', 'LBN', 'LB'),
  (119, 1, 'Lesotho', 'LSO', 'LS'),	(120, 1, 'Liberia', 'LBR', 'LR'),	(121, 1, 'Libyan Arab Jamahiriya', 'LBY', 'LY'),
  (122, 1, 'Liechtenstein', 'LIE', 'LI'),	(123, 1, 'Lithuania', 'LTU', 'LT'),	(124, 1, 'Luxembourg', 'LUX', 'LU'),
  (125, 1, 'Macau', 'MAC', 'MO'),	(126, 1, 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK'),	(127, 1, 'Madagascar', 'MDG', 'MG'),
  (128, 1, 'Malawi', 'MWI', 'MW'),	(129, 1, 'Malaysia', 'MYS', 'MY'),	(130, 1, 'Maldives', 'MDV', 'MV'),
  (131, 1, 'Mali', 'MLI', 'ML'),	(132, 1, 'Malta', 'MLT', 'MT'),	(133, 1, 'Marshall Islands', 'MHL', 'MH'),
  (134, 1, 'Martinique', 'MTQ', 'MQ'),	(135, 1, 'Mauritania', 'MRT', 'MR'),	(136, 1, 'Mauritius', 'MUS', 'MU'),
  (137, 1, 'Mayotte', 'MYT', 'YT'),	(138, 1, 'Mexico', 'MEX', 'MX'),	(139, 1, 'Micronesia, Federated States of', 'FSM', 'FM'),
  (140, 1, 'Moldova, Republic of', 'MDA', 'MD'),	(141, 1, 'Monaco', 'MCO', 'MC'),	(142, 1, 'Mongolia', 'MNG', 'MN'),
  (143, 1, 'Montserrat', 'MSR', 'MS'),	(144, 1, 'Morocco', 'MAR', 'MA'),	(145, 1, 'Mozambique', 'MOZ', 'MZ'),
  (146, 1, 'Myanmar', 'MMR', 'MM'),	(147, 1, 'Namibia', 'NAM', 'NA'),	(148, 1, 'Nauru', 'NRU', 'NR'),
  (149, 1, 'Nepal', 'NPL', 'NP'),	(150, 1, 'Netherlands', 'NLD', 'NL'),	(151, 1, 'Netherlands Antilles', 'ANT', 'AN'),
  (152, 1, 'New Caledonia', 'NCL', 'NC'),	(153, 1, 'New Zealand', 'NZL', 'NZ'),	(154, 1, 'Nicaragua', 'NIC', 'NI'),
  (155, 1, 'Niger', 'NER', 'NE'),	(156, 1, 'Nigeria', 'NGA', 'NG'),	(157, 1, 'Niue', 'NIU', 'NU'),
  (158, 1, 'Norfolk Island', 'NFK', 'NF'),	(159, 1, 'Northern Mariana Islands', 'MNP', 'MP'),	(160, 1, 'Norway', 'NOR', 'NO'),
  (161, 1, 'Oman', 'OMN', 'OM'),	(162, 1, 'Pakistan', 'PAK', 'PK'),	(163, 1, 'Palau', 'PLW', 'PW'),
  (164, 1, 'Panama', 'PAN', 'PA'),	(165, 1, 'Papua New Guinea', 'PNG', 'PG'),	(166, 1, 'Paraguay', 'PRY', 'PY'),
  (167, 1, 'Peru', 'PER', 'PE'),	(168, 1, 'Philippines', 'PHL', 'PH'),	(169, 1, 'Pitcairn', 'PCN', 'PN'),
  (170, 1, 'Poland', 'POL', 'PL'),	(171, 1, 'Portugal', 'PRT', 'PT'),	(172, 1, 'Puerto Rico', 'PRI', 'PR'),
  (173, 1, 'Qatar', 'QAT', 'QA'),	(174, 1, 'Reunion', 'REU', 'RE'),	(175, 1, 'Romania', 'ROM', 'RO'),
  (176, 1, 'Russian Federation', 'RUS', 'RU'),	(177, 1, 'Rwanda', 'RWA', 'RW'),	(178, 1, 'Saint Kitts and Nevis', 'KNA', 'KN'),
  (179, 1, 'Saint Lucia', 'LCA', 'LC'),	(180, 1, 'Saint Vincent and the Grenadines', 'VCT', 'VC'),	(181, 1, 'Samoa', 'WSM', 'WS'),
  (182, 1, 'San Marino', 'SMR', 'SM'),	(183, 1, 'Sao Tome and Principe', 'STP', 'ST'),	(184, 1, 'Saudi Arabia', 'SAU', 'SA'),
  (185, 1, 'Senegal', 'SEN', 'SN'),	(186, 1, 'Seychelles', 'SYC', 'SC'),	(187, 1, 'Sierra Leone', 'SLE', 'SL'),
  (188, 1, 'Singapore', 'SGP', 'SG'),	(189, 1, 'Slovakia (Slovak Republic)', 'SVK', 'SK'),	(190, 1, 'Slovenia', 'SVN', 'SI'),
  (191, 1, 'Solomon Islands', 'SLB', 'SB'),	(192, 1, 'Somalia', 'SOM', 'SO'),	(193, 1, 'South Africa', 'ZAF', 'ZA'),
  (194, 1, 'South Georgia and the South Sandwich Islands', 'SGS', 'GS'),	(195, 1, 'Spain', 'ESP', 'ES'),	(196, 1, 'Sri Lanka', 'LKA', 'LK'),
  (197, 1, 'St. Helena', 'SHN', 'SH'),	(198, 1, 'St. Pierre and Miquelon', 'SPM', 'PM'),	(199, 1, 'Sudan', 'SDN', 'SD'),
  (200, 1, 'Suriname', 'SUR', 'SR'),	(201, 1, 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ'),	(202, 1, 'Swaziland', 'SWZ', 'SZ'),
  (203, 1, 'Sweden', 'SWE', 'SE'),	(204, 1, 'Switzerland', 'CHE', 'CH'),	(205, 1, 'Syrian Arab Republic', 'SYR', 'SY'),
  (206, 1, 'Taiwan', 'TWN', 'TW'),	(207, 1, 'Tajikistan', 'TJK', 'TJ'),	(208, 1, 'Tanzania, United Republic of', 'TZA', 'TZ'),
  (209, 1, 'Thailand', 'THA', 'TH'),	(210, 1, 'Togo', 'TGO', 'TG'),	(211, 1, 'Tokelau', 'TKL', 'TK'),
  (212, 1, 'Tonga', 'TON', 'TO'),	(213, 1, 'Trinidad and Tobago', 'TTO', 'TT'),	(214, 1, 'Tunisia', 'TUN', 'TN'),
  (215, 1, 'Turkey', 'TUR', 'TR'),	(216, 1, 'Turkmenistan', 'TKM', 'TM'),	(217, 1, 'Turks and Caicos Islands', 'TCA', 'TC'),
  (218, 1, 'Tuvalu', 'TUV', 'TV'),	(219, 1, 'Uganda', 'UGA', 'UG'),	(220, 1, 'Ukraine', 'UKR', 'UA'),
  (221, 1, 'United Arab Emirates', 'ARE', 'AE'),	(222, 1, 'United Kingdom', 'GBR', 'GB'),	(223, 1, 'United States', 'USA', 'US'),
  (224, 1, 'United States Minor Outlying Islands', 'UMI', 'UM'),	(225, 1, 'Uruguay', 'URY', 'UY'),	(226, 1, 'Uzbekistan', 'UZB', 'UZ'),
  (227, 1, 'Vanuatu', 'VUT', 'VU'),	(228, 1, 'Vatican City State (Holy See)', 'VAT', 'VA'),	(229, 1, 'Venezuela', 'VEN', 'VE'),
  (230, 1, 'Viet Nam', 'VNM', 'VN'),	(231, 1, 'Virgin Islands (British)', 'VGB', 'VG'),	(232, 1, 'Virgin Islands (U.S.)', 'VIR', 'VI'),
  (233, 1, 'Wallis and Futuna Islands', 'WLF', 'WF'),	(234, 1, 'Western Sahara', 'ESH', 'EH'),	(235, 1, 'Yemen', 'YEM', 'YE'),
  (236, 1, 'Yugoslavia', 'YUG', 'YU'),	(237, 1, 'Zaire', 'ZAR', 'ZR'),	(238, 1, 'Zambia', 'ZMB', 'ZM'),	(239, 1, 'Zimbabwe', 'ZWE', 'ZW');"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_coupons` (
  `coupon_id` int(16) NOT NULL auto_increment,
  `coupon_code` varchar(32) NOT NULL default '',
  `percent_or_total` enum('percent','total') NOT NULL default 'percent',
  `coupon_type` ENUM( 'gift', 'permanent' ) DEFAULT 'gift' NOT NULL,
  `coupon_value` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`coupon_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_csv` (
  `field_id` int(11) NOT NULL auto_increment,
  `field_name` VARCHAR(128) NOT NULL,
  `field_default_value` text,
  `field_ordering` int(3) NOT NULL,
  `field_required` char(1) default 'N',
  PRIMARY KEY  (`field_id`)
) TYPE=MyISAM;"); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_csv` VALUES
  ('', 'product_sku', '', 1, 'Y' ),  ('', 'product_s_desc', '', 2, 'N' ),  ('', 'product_desc', '', 3, 'N' ),
  ('', 'product_thumb_image', '', 4, 'N' ),  ('', 'product_full_image', '', 5, 'N' ),  ('', 'product_weight', '', 6, 'N' ),
  ('', 'product_weight_uom', 'KG', 7, 'N' ),  ('', 'product_length', '', 8, 'N' ),  ('', 'product_width', '', 9, 'N' ),
  ('', 'product_height', '', 10, 'N' ),  ('', 'product_lwh_uom', '', 11, 'N' ),  ('', 'product_in_stock', '0', 12, 'N' ),
  ('', 'product_available_date', '', 13, 'N' ),  ('', 'product_discount_id', '', 14, 'N' ),  ('', 'product_name', '', 15, 'Y' ),
  ('', 'product_price', '', 16, 'N' ),  ('', 'category_path', '', 17, 'Y' ),  ('', 'manufacturer_id', '', 18, 'N' ),
  ('', 'product_tax_id', '', 19, 'N' ),  ('', 'product_sales', '', 20, 'N' ),  ('', 'product_parent_id', '0', 21, 'N' ),
  ('', 'attribute', '', 22, 'N' ),  ('', 'custom_attribute', '', 23, 'N' ), ('', 'attributes', '', 24, 'N' ),  ('', 'attribute_values', '', 25, 'N' );"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_currency` (
  `currency_id` int(11) NOT NULL auto_increment,
  `currency_name` varchar(64) default NULL,
  `currency_code` char(3) default NULL,
  PRIMARY KEY  (`currency_id`),
  KEY `idx_currency_name` (`currency_name`)
) TYPE=MyISAM AUTO_INCREMENT=157 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_currency` VALUES (1,'Andorran Peseta','ADP'),
  (2,'United Arab Emirates Dirham','AED'),	(3,'Afghanistan Afghani','AFA'),	(4,'Albanian Lek','ALL'),
  (5,'Netherlands Antillian Guilder','ANG'),	(6,'Angolan Kwanza','AOK'),	(7,'Argentinian Austral','ARA'),
  (9,'Australian Dollar','AUD'),	(10,'Aruban Florin','AWG'),	(11,'Barbados Dollar','BBD'),
  (12,'Bangladeshi Taka','BDT'),	(14,'Bulgarian Lev','BGL'),	(15,'Bahraini Dinar','BHD'),
  (16,'Burundi Franc','BIF'),	(17,'Bermudian Dollar','BMD'),	(18,'Brunei Dollar','BND'),
  (19,'Bolivian Boliviano','BOB'),	(20,'Brazilian Real','BRL'),	(21,'Bahamian Dollar','BSD'),
  (22,'Bhutan Ngultrum','BTN'),	(23,'Burma Kyat','BUK'),	(24,'Botswanian Pula','BWP'),
  (25,'Belize Dollar','BZD'),	(26,'Canadian Dollar','CAD'),	(27,'Swiss Franc','CHF'),
  (28,'Chilean Unidades de Fomento','CLF'),	(29,'Chilean Peso','CLP'),	(30,'Yuan (Chinese) Renminbi','CNY'),
  (31,'Colombian Peso','COP'),	(32,'Costa Rican Colon','CRC'),	(33,'Czech Koruna','CZK'),
  (34,'Cuban Peso','CUP'),	(35,'Cape Verde Escudo','CVE'),	(36,'Cyprus Pound','CYP'),
  (40,'Danish Krone','DKK'),	(41,'Dominican Peso','DOP'),	(42,'Algerian Dinar','DZD'),
  (43,'Ecuador Sucre','ECS'),	(44,'Egyptian Pound','EGP'),	(46,'Ethiopian Birr','ETB'),
  (47,'Euro','EUR'),	(49,'Fiji Dollar','FJD'),	(50,'Falkland Islands Pound','FKP'),
  (52,'British Pound','GBP'),	(53,'Ghanaian Cedi','GHC'),	(54,'Gibraltar Pound','GIP'),
  (55,'Gambian Dalasi','GMD'),	(56,'Guinea Franc','GNF'),	(58,'Guatemalan Quetzal','GTQ'),
  (59,'Guinea-Bissau Peso','GWP'),	(60,'Guyanan Dollar','GYD'),	(61,'Hong Kong Dollar','HKD'),
  (62,'Honduran Lempira','HNL'),	(63,'Haitian Gourde','HTG'),	(64,'Hungarian Forint','HUF'),
  (65,'Indonesian Rupiah','IDR'),	(66,'Irish Punt','IEP'),	(67,'Israeli Shekel','ILS'),
  (68,'Indian Rupee','INR'),	(69,'Iraqi Dinar','IQD'),	(70,'Iranian Rial','IRR'),
  (73,'Jamaican Dollar','JMD'),	(74,'Jordanian Dinar','JOD'),	(75,'Japanese Yen','JPY'),
  (76,'Kenyan Schilling','KES'),	(77,'Kampuchean (Cambodian) Riel','KHR'),	(78,'Comoros Franc','KMF'),
  (79,'North Korean Won','KPW'),	(80,'(South) Korean Won','KRW'),	(81,'Kuwaiti Dinar','KWD'),
  (82,'Cayman Islands Dollar','KYD'),	(83,'Lao Kip','LAK'),	(84,'Lebanese Pound','LBP'),
  (85,'Sri Lanka Rupee','LKR'),	(86,'Liberian Dollar','LRD'),	(87,'Lesotho Loti','LSL'),
  (89,'Libyan Dinar','LYD'),	(90,'Moroccan Dirham','MAD'),	(91,'Malagasy Franc','MGF'),
  (92,'Mongolian Tugrik','MNT'),	(93,'Macau Pataca','MOP'),	(94,'Mauritanian Ouguiya','MRO'),
  (95,'Maltese Lira','MTL'),	(96,'Mauritius Rupee','MUR'),	(97,'Maldive Rufiyaa','MVR'),
  (98,'Malawi Kwacha','MWK'),	(99,'Mexican Peso','MXP'),	(100,'Malaysian Ringgit','MYR'),
  (101,'Mozambique Metical','MZM'),	(102,'Nigerian Naira','NGN'),	(103,'Nicaraguan Cordoba','NIC'),
  (105,'Norwegian Kroner','NOK'),	(106,'Nepalese Rupee','NPR'),	(107,'New Zealand Dollar','NZD'),
  (108,'Omani Rial','OMR'),	(109,'Panamanian Balboa','PAB'),	(110,'Peruvian Inti','PEI'),
  (111,'Papua New Guinea Kina','PGK'),	(112,'Philippine Peso','PHP'),	(113,'Pakistan Rupee','PKR'),
  (114,'Polish Zloty','PLZ'),	(116,'Paraguay Guarani','PYG'),	(117,'Qatari Rial','QAR'),
  (118,'Romanian Leu','ROL'),	(119,'Rwanda Franc','RWF'),	(120,'Saudi Arabian Riyal','SAR'),
  (121,'Solomon Islands Dollar','SBD'),	(122,'Seychelles Rupee','SCR'),	(123,'Sudanese Pound','SDP'),
  (124,'Swedish Krona','SEK'),	(125,'Singapore Dollar','SGD'),	(126,'St. Helena Pound','SHP'),
  (127,'Sierra Leone Leone','SLL'),	(128,'Somali Schilling','SOS'),	(129,'Suriname Guilder','SRG'),
  (130,'Sao Tome and Principe Dobra','STD'),	(131,'Russian Ruble','SUR'),	(132,'El Salvador Colon','SVC'),
  (133,'Syrian Potmd','SYP'),	(134,'Swaziland Lilangeni','SZL'),	(135,'Thai Bath','THB'),
  (136,'Tunisian Dinar','TND'),	(137,'Tongan Pa\'anga','TOP'),	(138,'East Timor Escudo','TPE'),
  (139,'Turkish Lira','TRL'),	(140,'Trinidad and Tobago Dollar','TTD'),	(141,'Taiwan Dollar','TWD'),
  (142,'Tanzanian Schilling','TZS'),	(143,'Uganda Shilling','UGS'),	(144,'US Dollar','USD'),
  (145,'Uruguayan Peso','UYP'),	(146,'Venezualan Bolivar','VEB'),	(147,'Vietnamese Dong','VND'),
  (148,'Vanuatu Vatu','VUV'),	(149,'Samoan Tala','WST'),	(150,'Democratic Yemeni Dinar','YDD'),
  (151,'Yemeni Rial','YER'),	(152,'New Yugoslavia Dinar','YUD'),	(153,'South African Rand','ZAR'),
  (154,'Zambian Kwacha','ZMK'),	(155,'Zaire Zaire','ZRZ'),	(156,'Zimbabwe Dollar','ZWD'),	(157,'Slovak Koruna','SKK');"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_function` (
  `function_id` int(11) NOT NULL auto_increment,
  `module_id` int(11) default NULL,
  `function_name` varchar(32) default NULL,
  `function_class` varchar(32) default NULL,
  `function_method` varchar(32) default NULL,
  `function_description` text,
  `function_perms` varchar(255) default NULL,
  PRIMARY KEY  (`function_id`),
  KEY `idx_function_module_id` (`module_id`),
  KEY `idx_function_name` (`function_name`)
) TYPE=MyISAM AUTO_INCREMENT=110 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_function` VALUES (1, 1, 'userAdd', 'ps_user', 'add', '', 'admin,storeadmin'),
  (2, 1, 'userDelete', 'ps_user', 'delete', '', 'admin,storeadmin'),
  (3, 1, 'userUpdate', 'ps_user', 'update', '', 'admin,storeadmin'),
  (4, 1, 'adminPasswdUpdate', 'ps_user', 'update_admin_passwd', 'Updates Site Administrator Password', 'admin'),
  (31, 2, 'productAdd', 'ps_product', 'add', '', 'admin,storeadmin'),
  (6, 1, 'functionAdd', 'ps_function', 'add', '', 'admin'),
  (7, 1, 'functionUpdate', 'ps_function', 'update', '', 'admin'),
  (8, 1, 'functionDelete', 'ps_function', 'delete', '', 'admin'),
  (9, 1, 'userLogout', 'ps_user', 'logout', '', 'none'),
  (10, 1, 'userAddressAdd', 'ps_user_address', 'add', '', 'admin,storeadmin,shopper,demo'),
  (11, 1, 'userAddressUpdate', 'ps_user_address', 'update', '', 'admin,storeadmin,shopper'),
  (12, 1, 'userAddressDelete', 'ps_user_address', 'delete', '', 'admin,storeadmin,shopper'),
  (13, 1, 'moduleAdd', 'ps_module', 'add', '', 'admin'),
  (14, 1, 'moduleUpdate', 'ps_module', 'update', '', 'admin'),
  (15, 1, 'moduleDelete', 'ps_module', 'delete', '', 'admin'),
  (16, 1, 'userLogin', 'ps_user', 'login', '', 'none'),
  (17, 3, 'vendorAdd', 'ps_vendor', 'add', '', 'admin'),
  (18, 3, 'vendorUpdate', 'ps_vendor', 'update', '', 'admin,storeadmin'),
  (19, 3, 'vendorDelete', 'ps_vendor', 'delete', '', 'admin'),
  (20, 3, 'vendorCategoryAdd', 'ps_vendor_category', 'add', '', 'admin'),
  (21, 3, 'vendorCategoryUpdate', 'ps_vendor_category', 'update', '', 'admin'),
  (22, 3, 'vendorCategoryDelete', 'ps_vendor_category', 'delete', '', 'admin'),
  (23, 4, 'shopperAdd', 'ps_shopper', 'add', '', 'none'),
  (24, 4, 'shopperDelete', 'ps_shopper', 'delete', '', 'admin,storeadmin'),
  (25, 4, 'shopperUpdate', 'ps_shopper', 'update', '', 'admin,storeadmin,shopper'),
  (26, 4, 'shopperGroupAdd', 'ps_shopper_group', 'add', '', 'admin,storeadmin'),
  (27, 4, 'shopperGroupUpdate', 'ps_shopper_group', 'update', '', 'admin,storeadmin'),
  (28, 4, 'shopperGroupDelete', 'ps_shopper_group', 'delete', '', 'admin,storeadmin'),
  (29, 5, 'orderSearch', 'ps_order', 'find', '', 'admin,storeadmin,demo'),
  (30, 5, 'orderStatusSet', 'ps_order', 'order_status_update', '', 'admin,storeadmin'),
  (32, 2, 'productDelete', 'ps_product', 'delete', '', 'admin,storeadmin'),
  (33, 2, 'productUpdate', 'ps_product', 'update', '', 'admin,storeadmin'),
  (34, 2, 'productCategoryAdd', 'ps_product_category', 'add', '', 'admin,storeadmin'),
  (35, 2, 'productCategoryUpdate', 'ps_product_category', 'update', '', 'admin,storeadmin'),
  (36, 2, 'productCategoryDelete', 'ps_product_category', 'delete', '', 'admin,storeadmin'),
  (37, 2, 'productPriceAdd', 'ps_product_price', 'add', '', 'admin,storeadmin'),
  (38, 2, 'productPriceUpdate', 'ps_product_price', 'update', '', 'admin,storeadmin'),
  (39, 2, 'productPriceDelete', 'ps_product_price', 'delete', '', 'admin,storeadmin'),
  (40, 2, 'productAttributeAdd', 'ps_product_attribute', 'add', '', 'admin,storeadmin'),
  (41, 2, 'productAttributeUpdate', 'ps_product_attribute', 'update', '', 'admin,storeadmin'),
  (42, 2, 'productAttributeDelete', 'ps_product_attribute', 'delete', '', 'admin,storeadmin'),
  (43, 7, 'cartAdd', 'ps_cart', 'add', '', 'none'),
  (44, 7, 'cartUpdate', 'ps_cart', 'update', '', 'none'),
  (45, 7, 'cartDelete', 'ps_cart', 'delete', '', 'none'),
  (46, 10, 'checkoutComplete', 'ps_checkout', 'add', '', 'shopper,storeadmin,admin'),
  (47, 1, 'setLanguage', 'ps_module', 'set_language', '', 'none'),
  (48, 8, 'paymentMethodUpdate', 'ps_payment_method', 'update', '', 'admin,storeadmin'),
  (49, 8, 'paymentMethodAdd', 'ps_payment_method', 'add', '', 'admin,storeadmin'),
  (50, 8, 'paymentMethodDelete', 'ps_payment_method', 'delete', '', 'admin,storeadmin'),
  (51, 5, 'orderDelete', 'ps_order', 'delete', '', 'admin,storeadmin'),
  (52, 11, 'addTaxRate', 'ps_tax', 'add', '', 'admin,storeadmin'),
  (53, 11, 'updateTaxRate', 'ps_tax', 'update', '', 'admin,storeadmin'),
  (54, 11, 'deleteTaxRate', 'ps_tax', 'delete', '', 'admin,storeadmin'),
  (55, 10, 'checkoutValidateST', 'ps_checkout', 'validate_shipto', '', 'none'),
  (59, 5, 'orderStatusUpdate', 'ps_order_status', 'update', '', 'admin,storeadmin'),
  (60, 5, 'orderStatusAdd', 'ps_order_status', 'add', '', 'storeadmin,admin'),
  (61, 5, 'orderStatusDelete', 'ps_order_status', 'delete', '', 'admin,storeadmin'),
  (62, 1, 'currencyAdd', 'ps_currency', 'add', 'add a currency', 'storeadmin,admin'),
  (63, 1, 'currencyUpdate', 'ps_currency', 'update', '        update a currency', 'storeadmin,admin'),
  (64, 1, 'currencyDelete', 'ps_currency', 'delete', 'delete a currency', 'storeadmin,admin'),
  (65, 1, 'countryAdd', 'ps_country', 'add', 'Add a country ', 'storeadmin,admin'),
  (66, 1, 'countryUpdate', 'ps_country', 'update', 'Update a country record', 'storeadmin,admin'),
  (67, 1, 'countryDelete', 'ps_country', 'delete', 'Delete a country record', 'storeadmin,admin'),
  (68, 2, 'product_csv', 'ps_csv', 'upload_csv', '', 'admin'),
  ('', 7, 'waitingListAdd', 'zw_waiting_list', 'add', '', 'none'),
  ('', 13, 'addzone', 'ps_zone', 'add', 'This will add a zone', 'admin,storeadmin'),
  ('', 13, 'updatezone', 'ps_zone', 'update', 'This will update a zone', 'admin,storeadmin'),
  ('', 13, 'deletezone', 'ps_zone', 'delete', 'This will delete a zone', 'admin,storeadmin'),
  ('', 13, 'zoneassign', 'ps_zone', 'assign', 'This will assign a country to a zone', 'admin,storeadmin'),
  ('', 1, 'writeConfig', 'ps_config', 'writeconfig', 'This will write the configuration details to phpshop.cfg.php', 'admin'),
  ('', '12839', 'carrierAdd', 'ps_shipping', 'add', '', 'admin,storeadmin'),
  ('', '12839', 'carrierDelete', 'ps_shipping', 'delete', '', 'admin,storeadmin'),
  ('', '12839', 'carrierUpdate', 'ps_shipping', 'update', '', 'admin,storeadmin'),
  ('', '12839', 'rateAdd', 'ps_shipping', 'rate_add', '', 'admin,storeadmin'),
  ('', '12839', 'rateUpdate', 'ps_shipping', 'rate_update', '', 'admin,shopadmin'),
  ('', '12839', 'rateDelete', 'ps_shipping', 'rate_delete', '', 'admin,storeadmin'),
  ('', '10', 'checkoutProcess', 'ps_checkout', 'process', '', 'shopper,storeadmin,admin,demo'),
  ('', '5', 'downloadRequest', 'ps_order', 'download_request', 'This checks if the download request is valid and sends the file to the browser as file download if the request was successful, otherwise echoes an error', 'admin,storeadmin,shopper'),
  ('', '98', 'affiliateAdd', 'ps_affiliate', 'add', '', 'admin,storeadmin'),
  ('', '98', 'affiliateUpdate', 'ps_affiliate', 'update', '', 'admin,storeadmin'),
  ('', '98', 'affiliateDelete', 'ps_affiliate', 'delete', '', 'admin,storeadmin'),
  ('', '98', 'affiliateEmail', 'ps_affiliate', 'email', '', 'admin,storeadmin'),
  ('', '99', 'manufacturerAdd', 'ps_manufacturer', 'add', '', 'admin,storeadmin'),
  ('', '99', 'manufacturerUpdate', 'ps_manufacturer', 'update', '', 'admin,storeadmin'),
  ('', '99', 'manufacturerDelete', 'ps_manufacturer', 'delete', '', 'admin,storeadmin'),
  ('', '99', 'manufacturercategoryAdd', 'ps_manufacturer_category', 'add', '', 'admin,storeadmin'),
  ('', '99', 'manufacturercategoryUpdate', 'ps_manufacturer_category', 'update', '', 'admin,storeadmin'),
  ('', '99', 'manufacturercategoryDelete', 'ps_manufacturer_category', 'delete', '', 'admin,storeadmin'),
  ('', '7', 'addReview', 'ps_reviews', 'process_review', 'This lets the user add a review and rating to a product.', 'admin,storeadmin,shopper,demo'),
  ('', '7', 'productReviewDelete', 'ps_reviews', 'delete_review', 'This deletes a review and from a product.', 'admin,storeadmin'),
  ('', '8', 'creditcardAdd', 'ps_creditcard', 'add', 'Adds a Credit Card entry.', 'admin,storeadmin'),
  ('', '8', 'creditcardUpdate', 'ps_creditcard', 'update', 'Updates a Credit Card entry.', 'admin,storeadmin'),
  ('', '8', 'creditcardDelete', 'ps_creditcard', 'delete', 'Deletes a Credit Card entry.', 'admin,storeadmin'),
  ('', '2', 'publishProduct', 'ps_product', 'product_publish', 'Changes the product_publish field, so that a product can be published or unpublished easily.', 'admin,storeadmin'),
  ('', '2', 'export_csv', 'ps_csv', 'export_csv', 'This function exports all relevant product data to CSV.', 'admin,storeadmin'),
  ('', 2, 'reorder', 'ps_product_category', 'reorder', 'Changes the list order of a category.', 'admin,storeadmin'),
  ('', 2, 'discountAdd', 'ps_product_discount', 'add', 'Adds a discount.', 'admin,storeadmin'),
  ('', 2, 'discountUpdate', 'ps_product_discount', 'update', 'Updates a discount.', 'admin,storeadmin'),
  ('', 2, 'discountDelete', 'ps_product_discount', 'delete', 'Deletes a discount.', 'admin,storeadmin'),
  ('', 8, 'shippingmethodSave', 'ps_shipping_method', 'save', '', 'admin,storeadmin'),
  ('', 2, 'uploadProductFile', 'ps_product_files', 'add', 'Uploads and Adds a Product Image/File.', 'admin,storeadmin'),
  ('', 2, 'updateProductFile', 'ps_product_files', 'update', 'Updates a Product Image/File.', 'admin,storeadmin'),
  ('', 2, 'deleteProductFile', 'ps_product_files', 'delete', 'Deletes a Product Image/File.', 'admin,storeadmin'),
  ('', 12843, 'couponAdd', 'ps_coupon', 'add_coupon_code', 'Adds a Coupon.', 'admin,storeadmin'),
  ('', 12843, 'couponUpdate', 'ps_coupon', 'update_coupon', 'Updates a Coupon.', 'admin,storeadmin'),
  ('', 12843, 'couponDelete', 'ps_coupon', 'remove_coupon_code', 'Deletes a Coupon.', 'admin,storeadmin'),
  ('', 12843, 'couponProcess', 'ps_coupon', 'process_coupon_code', 'Processes a Coupon.', 'admin,storeadmin,shopper,demo'),
  ('', 2, 'ProductTypeAdd', 'ps_product_type', 'add', 'Function add a Product Type and create new table product_type_<id>.', 'admin'),
  ('', 2, 'ProductTypeUpdate', 'ps_product_type', 'update', 'Update a Product Type.', 'admin'),
  ('', 2, 'ProductTypeDelete', 'ps_product_type', 'delete', 'Delete a Product Type and drop table product_type_<id>.', 'admin'),
  ('', 2, 'ProductTypeReorder', 'ps_product_type', 'reorder', 'Changes the list order of a Product Type.', 'admin'),
  ('', 2, 'ProductTypeAddParam', 'ps_product_type_parameter', 'add_parameter', 'Function add a Parameter into a Product Type and create new column in table product_type_<id>.', 'admin'),
  ('', 2, 'ProductTypeUpdateParam', 'ps_product_type_parameter', 'update_parameter', 'Function update a Parameter in a Product Type and a column in table product_type_<id>.', 'admin'),
  ('', 2, 'ProductTypeDeleteParam', 'ps_product_type_parameter', 'delete_parameter', 'Function delete a Parameter from a Product Type and drop a column in table product_type_<id>.', 'admin'),
  ('', 2, 'ProductTypeReorderParam', 'ps_product_type_parameter', 'reorder_parameter', 'Changes the list order of a Parameter.', 'admin'),
  ('', 2, 'productProductTypeAdd', 'ps_product_product_type', 'add', 'Add a Product into a Product Type.', 'admin,storeadmin'),
  ('', 2, 'productProductTypeDelete', 'ps_product_product_type', 'delete', 'Delete a Product from a Product Type.', 'admin,storeadmin'),
  ('', 1, 'stateAdd', 'ps_country', 'addState', 'Add a State ', 'storeadmin,admin'),
  ('', 1, 'stateUpdate', 'ps_country', 'updateState', 'Update a state record', 'storeadmin,admin'),
  ('', 1, 'stateDelete', 'ps_country', 'deleteState', 'Delete a state record', 'storeadmin,admin'),
  ('', 2, 'csvFieldAdd', 'ps_csv', 'add', 'Add a CSV Field ', 'storeadmin,admin'),
  ('', 2, 'csvFieldUpdate', 'ps_csv', 'update', 'Update a CSV Field', 'storeadmin,admin'),
  ('', 2, 'csvFieldDelete', 'ps_csv', 'delete', 'Delete a CSV Field', 'storeadmin,admin');"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_manufacturer` (
	`manufacturer_id` int(11) NOT NULL auto_increment,
	`mf_name` varchar(64) default NULL,
	`mf_email` varchar(255) default NULL,
	`mf_desc` text,
	`mf_category_id` int(11) default NULL,
	`mf_url` VARCHAR( 255 ) NOT NULL,
	PRIMARY KEY  (`manufacturer_id`)
  ) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_manufacturer` VALUES ('1', 'Manufacturer', 'info@manufacturer.com', 'An example for a manufacturer', '1', 'http://www.a-url.com');" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_manufacturer_category` (
			  `mf_category_id` int(11) NOT NULL auto_increment,
			  `mf_category_name` varchar(64) default NULL,
			  `mf_category_desc` text,
			  PRIMARY KEY  (`mf_category_id`),
			  KEY `idx_manufacturer_category_category_name` (`mf_category_name`)
			) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_manufacturer_category` VALUES ('1', '-default-', 'This is the default manufacturer category');" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_mf_xref` (
			  `product_id` varchar(32) default NULL,
			  `manufacturer_id` int(11) default NULL,
			  KEY `idx_product_mf_xref_product_id` (`product_id`),
			  KEY `idx_product_mf_xref_manufacturer_id` (`manufacturer_id`)
			) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_module` (
  `module_id` int(11) NOT NULL auto_increment,
  `module_name` varchar(255) default NULL,
  `module_description` text,
  `module_perms` varchar(255) default NULL,
  `module_header` varchar(255) default NULL,
  `module_footer` varchar(255) default NULL,
  `module_publish` char(1) default NULL,
  `list_order` int(11) default NULL,
  `language_code_1` varchar(4) default NULL,
  `language_code_2` varchar(4) default NULL,
  `language_code_3` varchar(4) default NULL,
  `language_code_4` varchar(4) default NULL,
  `language_code_5` varchar(4) default NULL,
  `language_file_1` varchar(255) default NULL,
  `language_file_2` varchar(255) default NULL,
  `language_file_3` varchar(255) default NULL,
  `language_file_4` varchar(255) default NULL,
  `language_file_5` varchar(255) default NULL,
  `module_label_1` varchar(255) default NULL,
  `module_label_2` varchar(255) default NULL,
  `module_label_3` varchar(255) default NULL,
  `module_label_4` varchar(255) default NULL,
  `module_label_5` varchar(255) default NULL,
  PRIMARY KEY  (`module_id`),
  KEY `idx_module_name` (`module_name`),
  KEY `idx_module_list_order` (`list_order`)
) TYPE=MyISAM AUTO_INCREMENT=12838 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (1, 'admin', '<h4>ADMINISTRATIVE USERS ONLY</h4>\r\n\r\n<p>Only used for the following:</p>\r\n<OL>\r\n\r\n<LI>User Maintenance</LI>\r\n<LI>Module Maintenance</LI>\r\n<LI>Function Maintenance</LI>\r\n</OL>\r\n', 'admin', 'header.ihtml', 'footer.ihtml', 'Y', 1, 'eng', 'esl', '', '', '', 'lang_eng.inc', 'lang_esl.inc', '', '', '', 'Admin', 'Admin', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (2, 'product', '<p>Here you can adminster your online catalog of products.  The Product Administrator allows you to create product categories, create new products, edit product attributes, and add product items for each attribute value.</p>', 'storeadmin,admin', 'header.ihtml', 'footer.ihtml', 'Y', 4, 'eng', 'esl', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'Products', 'Mis<br />Productos', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (3, 'vendor', '<h4>ADMINISTRATIVE USERS ONLY</h4>\r\n<p>Here you can manage the vendors on the phpShop system.</p>', 'admin', 'header.ihtml', 'footer.ihtml', 'Y', 6, 'eng', 'esl', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'Vendors', 'Los<br />Distribuidores', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (4, 'shopper', '<p>Manage shoppers in your store.  Allows you to create shopper groups.  Shopper groups can be used when setting the price for a product.  This allows you to create different prices for different types of users.  An example of this would be to have a \'wholesale\' group and a \'retail\' group. </p>', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', 4, 'eng', 'esl', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'Shoppers', 'Mis<br />Clientes', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (5, 'order', '<p>View Order and Update Order Status.</p>', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', 5, 'eng', 'esl', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'Orders', 'Mis<br />Ordenes', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (6, 'msgs', 'This module is unprotected an used for displaying system messages to users.  We need to have an area that does not require authorization when things go wrong.', 'none', 'header.ihtml', 'footer.ihtml', 'N', 99, 'eng', 'esl', '', '', '', 'lang_en.inc', '', '', '', '', 'Admin', '', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (7, 'shop', 'This is the Washupito store module.  This is the demo store included with the phpShop distribution.', 'none', 's_header.ihtml', 's_footer.ihtml', 'Y', 99, 'eng', 'esl', '', '', '', '', '', '', '', '', 'Shop', 'Visita<br />la Tienda', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (8, 'store', '', 'storeadmin,admin', 'header.ihtml', 'footer.ihtml', 'Y', 2, 'eng', 'esl', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'Store', 'Mi<br />Tienda', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (9, 'account', 'This module allows shoppers to update their account information and view previously placed orders.', 'shopper,storeadmin,admin,demo', 's_header.ihtml', 's_footer.ihtml', 'N', 99, 'eng', 'esl', '', '', '', '', '', '', '', '', 'Account', 'Account', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (10, 'checkout', '', 'none', 's_header.ihtml', 's_footer.ihtml', 'N', 99, 'eng', 'esl', '', '', '', '', '', '', '', '', 'Checkout', 'Checkout', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (11, 'tax', 'The tax module allows you to set tax rates for states or regions within a country.  The rate is set as a decimal figure.  For example, 2 percent tax would be 0.02.', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', 8, 'eng', 'esl', '', '', '', '', '', '', '', '', 'Taxes', 'Impuestos', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (12, 'reportbasic', 'The report basic module allows you to do queries on all orders.', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', 7, 'eng', 'esl', '', '', '', '', '', '', '', '', 'Report Basic', 'Report Basic', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (13, 'zone', 'This is the zone-shipping module. Here you can manage your shipping costs according to Zones.', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'N', 9, 'eng', 'esl', '', '', '', '', '', '', '', '', 'Zone Shipping', 'Zone Shipping', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES ( '12839', 'shipping', '<h4>Shipping</h4><p>Let this module calculate the shipping fees for your customers.<br>Create carriers for shipping areas and weight groups.</p>', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', '10', 'eng', 'ger', '', '', '', '', '', '', '', '', 'Shipping', 'Versand', '', '', '');;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES( '98', 'affiliate', 'administrate the affiliates on your store.', 'storeadmin,admin', 'header.ihtml', 'footer.ihtml', 'N', '99', 'EN', 'ES', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'affiliates', '', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES( '99', 'manufacturer', 'Manage the manufacturers of products in your store.', 'storeadmin,admin', 'header.ihtml', 'footer.ihtml', 'Y', '12', 'EN', 'ES', '', '', '', 'lang_en.inc', 'lang_es.inc', '', '', '', 'manufacturer', '', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (12842, 'help', 'Help for mambo-phpshop', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', '13', 'eng', '', '', '', '', '', '', '', '', '', 'Help', '', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_module` VALUES (12843, 'coupon', 'Coupon Management', 'admin,storeadmin', 'header.ihtml', 'footer.ihtml', 'Y', '11', 'eng', '', '', '', '', '', '', '', '', '', 'Coupon', '', '', '', '');"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_history` (
`order_status_history_id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`order_id` int( 11 ) NOT NULL default '0',
`order_status_code` CHAR( 1 ) NOT NULL DEFAULT '0',
`date_added` datetime NOT NULL default '0000-00-00 00:00:00',
`customer_notified` int( 1 ) default '0',
`comments` text,
PRIMARY KEY ( `order_status_history_id` )
) TYPE = MYISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_item` (
  `order_item_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) default NULL,
  `user_info_id` varchar(32) default NULL default NULL,
  `vendor_id` int(11) default NULL,
  `product_id` int(11) default NULL,
  `order_item_sku` VARCHAR( 64 ) NOT NULL,
  `order_item_name` VARCHAR( 64 ) NOT NULL,
  `product_quantity` int(11) default NULL,
  `product_item_price` decimal(10,2) default NULL,
  `product_final_price` DECIMAL( 10, 2 ) NOT NULL,
  `order_item_currency` varchar(16) default NULL,
  `order_status` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `product_attribute` text default NULL,
  PRIMARY KEY  (`order_item_id`),
  KEY `idx_order_item_order_id` (`order_id`),
  KEY `idx_order_item_user_info_id` (`user_info_id`),
  KEY `idx_order_item_vendor_id` (`vendor_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_payment` (
  `order_id` int(11) NOT NULL default '0',
  `payment_method_id` int(11) default NULL,
  `order_payment_code` VARCHAR( 30 ) NOT NULL,
  `order_payment_number` blob,
  `order_payment_expire` int(11) default NULL,
  `order_payment_name` varchar(255) default NULL,
  `order_payment_log` text,
  `order_payment_trans_id` TEXT NOT NULL,
  KEY `idx_order_payment_order_id` (`order_id`),
  KEY `idx_order_payment_method_id` (`payment_method_id`)
) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_status` (
  `order_status_id` int(11) NOT NULL auto_increment,
  `order_status_code` char(1) NOT NULL default '',
  `order_status_name` varchar(64) default NULL,
  `list_order` int(11) default NULL,
  `vendor_id` int(11) default NULL,
  PRIMARY KEY  (`order_status_id`),
  KEY `idx_order_status_list_order` (`list_order`),
  KEY `idx_order_status_vendor_id` (`vendor_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_order_status` VALUES (1, 'P', 'Pending', 1, 1);" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_order_status` VALUES (2, 'C', 'Confirmed', 2, 1);" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_order_status` VALUES (3, 'X', 'Cancelled', 3, 1);" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_order_status` VALUES (4, 'R', 'Refunded', 4, 1);" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_order_status` VALUES (5, 'S', 'Shipped', 5, 1);" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_order_user_info` (
	`order_info_id` int(11) NOT NULL auto_increment,
	`order_id` int(11) NOT NULL,
	`user_id` varchar(32) NOT NULL default '',
	`address_type` char(2) default NULL,
	`address_type_name` varchar(32) default NULL,
	`company` varchar(64) default NULL,
	`title` varchar(32) default NULL,
	`last_name` varchar(32) default NULL,
	`first_name` varchar(32) default NULL,
	`middle_name` varchar(32) default NULL,
	`phone_1` varchar(32) default NULL,
	`phone_2` varchar(32) default NULL,
	`fax` varchar(32) default NULL,
	`address_1` varchar(64) NOT NULL default '',
	`address_2` varchar(64) default NULL,
	`city` varchar(32) NOT NULL default '',
	`state` varchar(32) NOT NULL default '',
	`country` varchar(32) NOT NULL default 'US',
	`zip` varchar(32) NOT NULL default '',
	`user_email` varchar(255) default NULL,
	`extra_field_1` varchar(255) default NULL,
	`extra_field_2` varchar(255) default NULL,
	`extra_field_3` varchar(255) default NULL,
	`extra_field_4` char(1) default NULL,
	`extra_field_5` char(1) default NULL,
	PRIMARY KEY  (`order_info_id`),
	KEY `idx_order_info_order_id` (`order_id`)
  ) TYPE=MyISAM;" ); $database->query();
  
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_orders` (
  `order_id` int(11) NOT NULL auto_increment,
  `user_id` varchar(32) NOT NULL default '',
  `vendor_id` int(11) NOT NULL default '0',
  `order_number` varchar(32) default NULL,
  `user_info_id` varchar(32) default NULL,
  `order_total` DECIMAL( 10, 2 ) DEFAULT '0.00' NOT NULL,
  `order_subtotal` decimal(10,2) default NULL,
  `order_tax` decimal(10,2) default NULL,
  `order_shipping` decimal(10,2) default NULL,
  `order_shipping_tax` decimal(10,2) default NULL,
  `coupon_discount` DECIMAL( 10, 2 ) NOT NULL,
  `order_discount` DECIMAL( 10, 2 ) NOT NULL,
  `order_currency` varchar(16) default NULL,
  `order_status` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `ship_method_id` VARCHAR( 255 ) DEFAULT NULL,
  `customer_note` text NOT NULL,
  `ip_address` VARCHAR(15) NOT NULL,
  PRIMARY KEY  (`order_id`),
  KEY `idx_orders_user_id` (`user_id`),
  KEY `idx_orders_vendor_id` (`vendor_id`),
  KEY `idx_orders_order_number` (`order_number`),
  KEY `idx_orders_user_info_id` (`user_info_id`),
  KEY `idx_orders_ship_method_id` (`ship_method_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_payment_method` (
  `payment_method_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `payment_method_name` varchar(255) default NULL,
  `payment_class` VARCHAR( 50 ) NOT NULL,
  `shopper_group_id` int(11) default NULL,
  `payment_method_discount` decimal(10,2) default NULL,
  `list_order` int(11) default NULL,
  `payment_method_code` varchar(8) default NULL,
  `enable_processor` char(1) default NULL,
  `is_creditcard` TINYINT( 1 ) NOT NULL,
  `payment_enabled` CHAR( 1 ) DEFAULT 'N' NOT NULL,
  `accepted_creditcards` VARCHAR( 128 ) NOT NULL,
  `payment_extrainfo` TEXT NOT NULL,
  `payment_passkey` BLOB NOT NULL,
  PRIMARY KEY  (`payment_method_id`),
  KEY `idx_payment_method_vendor_id` (`vendor_id`),
  KEY `idx_payment_method_name` (`payment_method_name`),
  KEY `idx_payment_method_list_order` (`list_order`),
  KEY `idx_payment_method_shopper_group_id` (`shopper_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (1, 1, 'Purchase Order', '', 6, '0.00', 4, 'PO', 'N', 0, 'Y', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (2, 1, 'Cash On Delivery', '', 5, '-2.00', 5, 'COD', 'N', 0, 'Y', '', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (3, 1, 'Credit Card', 'ps_authorize', 5, '0.00', 0, 'AN', 'Y', 0, 'Y', '1,2,6,7,', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (4, 1, 'PayPal', 'ps_paypal', 5, '0.00', 0, 'PP', 'P', 0, 'Y', '', '<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">\r\n<input type=\"image\" name=\"submit\" src=\"http://images.paypal.com/images/x-click-but6.gif\" border=\"0\" alt=\"Make payments with PayPal, it\'s fast, free, and secure!\">\r\n<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />\r\n<input type=\"hidden\" name=\"business\" value=\"<?php echo PAYPAL_EMAIL ?>\" />\r\n<input type=\"hidden\" name=\"receiver_email\" value=\"<?php echo PAYPAL_EMAIL ?>\" />\r\n<input type=\"hidden\" name=\"item_name\" value=\"Order Nr. <?php \$db->p(\"order_id\") ?>\" />\r\n<input type=\"hidden\" name=\"order_id\" value=\"<?php \$db->p(\"order_id\") ?>\" />\r\n<input type=\"hidden\" name=\"invoice\" value=\"<?php \$db->p(\"order_number\") ?>\" />\r\n<input type=\"hidden\" name=\"amount\" value=\"<?php printf(\"%.2f\", \$db->f(\"order_total\"))?>\" />\r\n<input type=\"hidden\" name=\"currency_code\" value=\"<?php echo \$_SESSION[\'vendor_currency\'] ?>\" />\r\n<input type=\"hidden\" name=\"image_url\" value=\"<?php echo \$vendor_image_url ?>\" />\r\n<input type=\"hidden\" name=\"return\" value=\"<?php echo SECUREURL .\"index.php?option=com_phpshop&amp;page=checkout.result&amp;order_id=\".\$db->f(\"order_id\") ?>\" />\r\n<input type=\"hidden\" name=\"notify_url\" value=\"<?php echo SECUREURL .\"administrator/components/com_phpshop/notify.php\" ?>\" />\r\n<input type=\"hidden\" name=\"cancel_return\" value=\"<?php echo SECUREURL .\"index.php\" ?>\" />\r\n<input type=\"hidden\" name=\"undefined_quantity\" value=\"0\" />\r\n<input type=\"hidden\" name=\"pal\" value=\"NRUBJXESJTY24\" />\r\n<input type=\"hidden\" name=\"no_shipping\" value=\"1\" />\r\n<input type=\"hidden\" name=\"no_note\" value=\"1\" />\r\n</form>', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (5, 1, 'PayMate', 'ps_paymate', 5, '0.00', 0, 'PM', 'P', 0, 'N', '', '<script type=\"text/javascript\" language=\"javascript\">
  function openExpress(){
	var url = \'https://www.paymate.com.au/PayMate/ExpressPayment?mid=<?php echo PAYMATE_USERNAME.
	  \"&amt=\".\$db->f(\"order_total\").
	  \"&currency=\".\$_SESSION[\'vendor_currency\'].
	  \"&ref=\".\$db->f(\"order_id\").
	  \"&pmt_sender_email=\".\$user->email.
	  \"&pmt_contact_firstname=\".\$user->first_name.
	  \"&pmt_contact_surname=\".\$user->last_name.
	  \"&regindi_address1=\".\$user->address_1.
	  \"&regindi_address2=\".\$user->address_2.
	  \"&regindi_sub=\".\$user->city.
	  \"&regindi_pcode=\".\$user->zip;?>\'
	var newWin = window.open(url, \'wizard\', \'height=640,width=500,scrollbars=0,toolbar=no\');
	self.name = \'parent\';
	newWin.focus();
  }
  </script>
  <div align=\"center\">
  <p>
  <a href=\"javascript:openExpress();\">
  <img src=\"https://www.paymate.com.au/homepage/images/butt_PayNow.gif\" border=\"0\" alt=\"Pay with Paymate Express\">
  <br />click here to pay your account</a>
  </p>
  </div>', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (6, 1, 'WorldPay', 'ps_worldpay', 5, '0.00', 0, 'WP', 'P', 0, 'N', '', '<form action=\"https://select.worldpay.com/wcc/purchase\" method=\"post\">
						  <input type=hidden name=\"testMode\" value=\"100\"> 
						  <input type=\"hidden\" name=\"instId\" value=\"<?php echo WORLDPAY_INST_ID ?>\" />
						  <input type=\"hidden\" name=\"cartId\" value=\"<?php echo \$db->f(\"order_id\") ?>\" />
						  <input type=\"hidden\" name=\"amount\" value=\"<?php echo \$db->f(\"order_total\") ?>\" />
						  <input type=\"hidden\" name=\"currency\" value=\"<?php echo \$_SESSION[\'vendor_currency\'] ?>\" />
						  <input type=\"hidden\" name=\"desc\" value=\"Products\" />
						  <input type=\"hidden\" name=\"email\" value=\"<?php echo \$user->email?>\" />
						  <input type=\"hidden\" name=\"address\" value=\"<?php echo \$user->address_1?>&#10<?php echo \$user->address_2?>&#10<?php echo
						  \$user->city?>&#10<?php echo \$user->state?>\" />
						  <input type=\"hidden\" name=\"name\" value=\"<?php echo \$user->title?><?php echo \$user->first_name?>. <?php echo \$user->middle_name?><?php echo \$user->last_name?>\" />
						  <input type=\"hidden\" name=\"country\" value=\"<?php echo \$user->country?>\"/>
						  <input type=\"hidden\" name=\"postcode\" value=\"<?php echo \$user->zip?>\" />
						  <input type=\"hidden\" name=\"tel\"  value=\"<?php echo \$user->phone_1?>\">
						  <input type=\"hidden\" name=\"withDelivery\"  value=\"true\">
						  <br />
						  <input type=\"submit\" value =\"PROCEED TO PAYMENT PAGE\" />
						  </form>', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (7, 1, '2Checkout', 'ps_twocheckout', 5, '0.00', 0, '2CO', 'P', 0, 'N', '', '<?php
	\$q  = \"SELECT * FROM #__users WHERE user_info_id=\'\".\$db->f(\"user_info_id\").\"\'\"; 
	\$dbbt = new ps_DB;
	\$dbbt->setQuery(\$q);
	\$dbbt->query();
	\$dbbt->next_record(); 
	// Get ship_to information
	if( \$db->f(\"user_info_id\") != \$dbbt->f(\"user_info_id\")) {
	  \$q2  = \"SELECT * FROM #__pshop_user_info WHERE user_info_id=\'\".\$db->f(\"user_info_id\").\"\'\"; 
	  \$dbst = new ps_DB;
	  \$dbst->setQuery(\$q2);
	  \$dbst->query();
	  \$dbst->next_record();
	}
	else  {
	  \$dbst = \$dbbt;
	}
			
	//Authnet vars to send
	\$formdata = array (
	 \'x_login\' => TWOCO_LOGIN,
	 \'x_email_merchant\' => ((TWOCO_MERCHANT_EMAIL == \'True\') ? \'TRUE\' : \'FALSE\'),
			 
	 // Customer Name and Billing Address
	 \'x_first_name\' => \$dbbt->f(\"first_name\"),
	 \'x_last_name\' => \$dbbt->f(\"last_name\"),
	 \'x_company\' => \$dbbt->f(\"company\"),
	 \'x_address\' => \$dbbt->f(\"address_1\"),
	 \'x_city\' => \$dbbt->f(\"city\"),
	 \'x_state\' => \$dbbt->f(\"state\"),
	 \'x_zip\' => \$dbbt->f(\"zip\"),
	 \'x_country\' => \$dbbt->f(\"country\"),
	 \'x_phone\' => \$dbbt->f(\"phone_1\"),
	 \'x_fax\' => \$dbbt->f(\"fax\"),
	 \'x_email\' => \$dbbt->f(\"email\"),
	
	 // Customer Shipping Address
	 \'x_ship_to_first_name\' => \$dbst->f(\"first_name\"),
	 \'x_ship_to_last_name\' => \$dbst->f(\"last_name\"),
	 \'x_ship_to_company\' => \$dbst->f(\"company\"),
	 \'x_ship_to_address\' => \$dbst->f(\"address_1\"),
	 \'x_ship_to_city\' => \$dbst->f(\"city\"),
	 \'x_ship_to_state\' => \$dbst->f(\"state\"),
	 \'x_ship_to_zip\' => \$dbst->f(\"zip\"),
	 \'x_ship_to_country\' => \$dbst->f(\"country\"),
	
	 \'x_invoice_num\' => \$db->f(\"order_number\"),
	 \'x_receipt_link_url\' => SECUREURL.\"2checkout_notify.php\"
	 );
	 
	if( TWOCO_TESTMODE == \"Y\" )
	  \$formdata[\'demo\'] = \"Y\";
	
	 \$version = \"2\";
	 \$url = \"https://www2.2checkout.com/2co/buyer/purchase\";
	 \$formdata[\'x_amount\'] = \$db->f(\"order_total\");
	
	 //build the post string
	 \$poststring = \'\';
	 foreach(\$formdata AS \$key => \$val){
	   \$poststring .= \"<input type=\'hidden\' name=\'\$key\' value=\'\$val\' />
	\";
	 }
	
	?>
	<form action=\"<?php echo \$url ?>\" method=\"post\" target=\"_blank\">
	<?php echo \$poststring ?>
	<p>Click on the Image below to pay...</p>
	<input type=\"image\" name=\"submit\" src=\"https://www.2checkout.com/images/buy_logo.gif\" border=\"0\" alt=\"Make payments with 2Checkout, it\'s fast and secure!\" title=\"Pay your Order with 2Checkout, it\'s fast and secure!\" />
	</form>', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (8, 1, 'NoChex', 'ps_nochex', 5, '0.00', 0, 'NOCHEX', 'P', 0, 'N', '', '<form action=\"https://www.nochex.com/nochex.dll/checkout\" method=post target=\"_blank\"> 
											<input type=\"hidden\" name=\"email\" value=\"<?php echo NOCHEX_EMAIL ?>\" />
											<input type=\"hidden\" name=\"amount\" value=\"<?php printf(\"%.2f\", \$db->f(\"order_total\"))?>\" />
											<input type=\"hidden\" name=\"ordernumber\" value=\"<?php \$db->p(\"order_id\") ?>\" />
											<input type=\"hidden\" name=\"logo\" value=\"<?php echo \$vendor_image_url ?>\" />
											<input type=\"hidden\" name=\"returnurl\" value=\"<?php echo SECUREURL .\"index.php?option=com_phpshop&amp;page=checkout.result&amp;order_id=\".\$db->f(\"order_id\") ?>\" />
											<input type=\"image\" name=\"submit\" src=\"http://www.nochex.com/web/images/paymeanimated.gif\"> 
											</form>', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (9, 1, 'Credit Card (PayMeNow)', 'ps_paymenow', 5, '0.00', 0, 'PN', 'Y', 0, 'N', '1,2,3,', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (10, 1, 'eWay', 'ps_eway', 5, '0.00', 0, 'EW', 'Y', 0, 'N', '', '', '');"); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (11, 1, 'eCheck.net', 'ps_echeck', 5, '0.00', 0, 'ECK', 'B', 0, 'N', '', '', '');"); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (12, 1, 'Credit Card (eProcessingNetwork)', 'ps_epn', 5, '0.00', 0, 'EPN', 'Y', 0, 'N', '1,2,3,', '', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (13, 1, 'iKobo', '', 5, '0.00', 0, 'IK', 'P', 0, 'N', '', '<form action=\"https://www.iKobo.com/store/index.php\" method=\"post\"> 
  <input type=\"hidden\" name=\"cmd\" value=\"cart\" />Click on the image below to Pay with iKobo
  <input type=\"image\" src=\"https://www.ikobo.com/merchant/buttons/ikobo_pay1.gif\" name=\"submit\" alt=\"Pay with iKobo\" /> 
  <input type=\"hidden\" name=\"poid\" value=\"USER_ID\" /> 
  <input type=\"hidden\" name=\"item\" value=\"Order: <?php \$db->p(\"order_id\") ?>\" /> 
  <input type=\"hidden\" name=\"price\" value=\"<?php printf(\"%.2f\", \$db->f(\"order_total\"))?>\" /> 
  <input type=\"hidden\" name=\"firstname\" value=\"<?php echo \$user->first_name?>\" /> 
  <input type=\"hidden\" name=\"lastname\" value=\"<?php echo \$user->last_name?>\" /> 
  <input type=\"hidden\" name=\"address\" value=\"<?php echo \$user->address_1?>&#10<?php echo \$user->address_2?>\" /> 
  <input type=\"hidden\" name=\"city\" value=\"<?php echo \$user->city?>\" /> 
  <input type=\"hidden\" name=\"state\" value=\"<?php echo \$user->state?>\" /> 
  <input type=\"hidden\" name=\"zip\" value=\"<?php echo \$user->zip?>\" /> 
  <input type=\"hidden\" name=\"phone\" value=\"<?php echo \$user->phone_1?>\" /> 
  <input type=\"hidden\" name=\"email\" value=\"<?php echo \$user->email?>\" /> 
  </form> >', '');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES (14, 1, 'iTransact', '', 5, '0.00', 0, 'ITR', 'P', 0, 'N', '', '<?php
  //your iTransact account details
  \$vendorID = \"XXXXX\";
  global \$vendor_name;
  \$mername = \$vendor_name;
  
  //order details
  \$total = \$db->f(\"order_total\");\$first_name = \$user->first_name;\$last_name = \$user->last_name;\$address = \$user->address_1;\$city = \$user->city;\$state = \$user->state;\$zip = \$user->zip;\$country = \$user->country;\$email = \$user->email;\$phone = \$user->phone_1;\$home_page = \$mosConfig_live_site.\"/index.php\";\$ret_addr = \$mosConfig_live_site.\"/index.php\";\$cc_payment_image = \$mosConfig_live_site.\"/components/com_phpshop/shop_image/ps_image/cc_payment.jpg\";
  ?>
  <form action=\"https://secure.paymentclearing.com/cgi-bin/mas/split.cgi\" method=\"POST\"> 
		<input type=\"hidden\" name=\"vendor_id\" value=\"<?php echo \$vendorID; ?>\" />
		<input type=\"hidden\" name=\"home_page\" value=\"<?php echo \$home_page; ?>\" />
		<input type=\"hidden\" name=\"ret_addr\" value=\"<?php echo \$ret_addr; ?>\" />
		<input type=\"hidden\" name=\"mername\" value=\"<?php echo \$mername; ?>\" />
		<!--Enter text in the next value that should appear on the bottom of the order form.-->
		<INPUT type=\"hidden\" name=\"mertext\" value=\"\" />
		<!--If you are accepting checks, enter the number 1 in the next value.  Enter the number 0 if you are not accepting checks.-->
		<INPUT type=\"hidden\" name=\"acceptchecks\" value=\"0\" />
		<!--Enter the number 1 in the next value if you want to allow pre-registered customers to pay with a check.  Enter the number 0 if not.-->
		<INPUT type=\"hidden\" name=\"allowreg\" value=\"0\" />
		<!--If you are set up with Check Guarantee, enter the number 1 in the next value.  Enter the number 0 if not.-->
		<INPUT type=\"hidden\" name=\"checkguar\" value=\"0\" />
		<!--Enter the number 1 in the next value if you are accepting credit card payments.  Enter the number zero if not.-->
		<INPUT type=\"hidden\" name=\"acceptcards\" value=\"1\">
		<!--Enter the number 1 in the next value if you want to allow a separate mailing address for credit card orders.  Enter the number 0 if not.-->
		<INPUT type=\"hidden\" name=\"altaddr\" value=\"0\" />
		<!--Enter the number 1 in the next value if you want the customer to enter the CVV number for card orders.  Enter the number 0 if not.-->
		<INPUT type=\"hidden\" name=\"showcvv\" value=\"1\" />
		
		<input type=\"hidden\" name=\"1-desc\" value=\"Order Total\" />
		<input type=\"hidden\" name=\"1-cost\" value=\"<?php echo \$total; ?>\" />
		<input type=\"hidden\" name=\"1-qty\" value=\"1\" />
		<input type=\"hidden\" name=\"total\" value=\"<?php echo \$total; ?>\" />
		<input type=\"hidden\" name=\"first_name\" value=\"<?php echo \$first_name; ?>\" />
		<input type=\"hidden\" name=\"last_name\" value=\"<?php echo \$last_name; ?>\" />
		<input type=\"hidden\" name=\"address\" value=\"<?php echo \$address; ?>\" />
		<input type=\"hidden\" name=\"city\" value=\"<?php echo \$city; ?>\" />
		<input type=\"hidden\" name=\"state\" value=\"<?php echo \$state; ?>\" />
		<input type=\"hidden\" name=\"zip\" value=\"<?php echo \$zip; ?>\" />
		<input type=\"hidden\" name=\"country\" value=\"<?php echo \$country; ?>\" />
		<input type=\"hidden\" name=\"phone\" value=\"<?php echo \$phone; ?>\" />
		<input type=\"hidden\" name=\"email\" value=\"<?php echo \$email; ?>\" />
		<p><input type=\"image\" alt=\"Process Secure Credit Card Transaction using iTransact\" border=\"0\" height=\"60\" width=\"210\" src=\"<?php echo \$cc_payment_image; ?>\" /> </p>
		</form>', '');" ); $database->query();	
$database->setQuery( "INSERT INTO `#__pshop_payment_method` VALUES ('', 1, 'Dankort / PBS', 'ps_pbs', 5, '0.00', 0, 'PBS', 'P', 0, 'N', '', '', '');"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product` (
  `product_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) NOT NULL default '0',
  `product_parent_id` int(11) default '0' NOT NULL,
  `product_sku` varchar(64) NOT NULL default '',
  `product_s_desc` varchar(255) default NULL,
  `product_desc` text,
  `product_thumb_image` varchar(255) default NULL,
  `product_full_image` varchar(255) default NULL,
  `product_publish` char(1) default NULL,
  `product_weight` decimal(10,4) default NULL,
  `product_weight_uom` varchar(32) default 'pounds.',
  `product_length` decimal(10,4) default NULL,
  `product_width` decimal(10,4) default NULL,
  `product_height` decimal(10,4) default NULL,
  `product_lwh_uom` varchar(32) default 'inches',
  `product_url` varchar(255) default NULL,
  `product_in_stock` int(11) UNSIGNED DEFAULT NULL,
  `product_available_date` int(11) default NULL,
  `product_availability` VARCHAR( 56 ) NOT NULL,
  `product_special` char(1) default NULL,
  `product_discount_id` int(11) default NULL,
  `ship_code_id` int(11) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `product_name` varchar(64) default NULL,
  `product_sales` int(11) NOT NULL default 0,
  `attribute` text default NULL,
  `custom_attribute` TEXT NOT NULL,
  `product_tax_id` TINYINT( 2 ) NOT NULL,
  `product_unit` varchar(32) default NULL,
  `product_packaging` int(11) default NULL,
  PRIMARY KEY  (`product_id`),
  KEY `idx_product_vendor_id` (`vendor_id`),
  KEY `idx_product_product_parent_id` (`product_parent_id`),
  KEY `idx_product_sku` (`product_sku`),
  KEY `idx_product_ship_code_id` (`ship_code_id`),
  KEY `idx_product_name` (`product_name`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_attribute` (
	`product_id` int(11) NOT NULL default '0',
	`attribute_name` char(255) NOT NULL default '',
	`attribute_value` char(255) NOT NULL default '',
	KEY `idx_product_attribute_product_id` (`product_id`),
	KEY `idx_product_attribute_name` (`attribute_name`)
  ) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_attribute_sku` (
	`product_id` int(11) NOT NULL default '0',
	`attribute_name` char(255) NOT NULL default '',
	`attribute_list` int(11) NOT NULL default '0',
	KEY `idx_product_attribute_sku_product_id` (`product_id`),
	KEY `idx_product_attribute_sku_attribute_name` (`attribute_name`),
	KEY `idx_product_attribute_list` (`attribute_list`)
  ) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_category_xref` (
  `category_id` INT( 11 ) NOT NULL,
  `product_id` int(11) NOT NULL default '0',
  `product_list` int(11) default NULL,
  KEY `idx_product_category_xref_category_id` (`category_id`),
  KEY `idx_product_category_xref_product_id` (`product_id`),
  KEY `idx_product_category_xref_product_list` (`product_list`)
) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_discount` (
  `discount_id` int(11) NOT NULL auto_increment,
  `amount` decimal(5,2) NOT NULL default '0.00',
  `is_percent` tinyint(1) NOT NULL default '0',
  `start_date` int(11) NOT NULL default '0',
  `end_date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`discount_id`)
) TYPE=MyISAM;"); $database->query();
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_download` (
  `product_id` int( 11 ) DEFAULT '0' NOT NULL ,
  `user_id` varchar( 255 ) DEFAULT '' NOT NULL ,
  `order_id` varchar( 255 ) DEFAULT '' NOT NULL ,
  `end_date` varchar( 255 ) DEFAULT '' NOT NULL ,
  `download_max` varchar( 255 ) DEFAULT '' NOT NULL ,
  `download_id` varchar( 255 ) DEFAULT '' NOT NULL ,
  `file_name` varchar( 255 ) DEFAULT '' NOT NULL ,
  PRIMARY KEY ( `download_id` ) 
  );" ); $database->query();
  
  $database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_files` (
  `file_id` int(19) NOT NULL auto_increment,
  `file_product_id` int(11) NOT NULL default '0',
  `file_name` varchar(128) NOT NULL default '',
  `file_title` varchar(128) NOT NULL default '',
  `file_description` mediumtext NOT NULL,
  `file_extension` varchar(128) NOT NULL default '',
  `file_mimetype` varchar(64) NOT NULL default '',
  `file_url` varchar(254) NOT NULL default '',
  `file_published` tinyint(1) NOT NULL default '0',
  `file_is_image` tinyint(1) NOT NULL default '0',
  `file_image_height` int NOT NULL default '0',
  `file_image_width` int NOT NULL default '0',
  `file_image_thumb_height` int NOT NULL default '50',
  `file_image_thumb_width` int NOT NULL default '0',
  PRIMARY KEY  (`file_id`)
) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_price` (
  `product_price_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0',
  `product_price` decimal(10,5) default NULL,
  `product_currency` char(16) default NULL,
  `product_price_vdate` int(11) default NULL,
  `product_price_edate` int(11) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `shopper_group_id` int(11) default NULL,
  `price_quantity_start` INT( 11 ) UNSIGNED DEFAULT '0' NOT NULL ,
  `price_quantity_end` INT( 11 ) UNSIGNED NOT NULL,
  PRIMARY KEY  (`product_price_id`),
  KEY `idx_product_price_product_id` (`product_id`),
  KEY `idx_product_price_shopper_group_id` (`shopper_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_relations` (
  `product_id` int(11) NOT NULL default '0',
  `related_products` text,
  PRIMARY KEY  (`product_id`)
) TYPE=MyISAM;"); $database->query();
	
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_reviews` (
	  `product_id` varchar(255) NOT NULL default '',
	  `comment` text NOT NULL,
	  `userid` int(11) NOT NULL default '0',
	  `time` int(11) NOT NULL default '0',
	  `user_rating` tinyint(1) NOT NULL default '0',
	  `review_ok` int(11) NOT NULL default '0',
	  `review_votes` int(11) NOT NULL default '0'
	) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_type` (
	  `product_type_id` int(11) NOT NULL auto_increment,
	  `product_type_name` varchar(255) NOT NULL default '',
	  `product_type_description` text default NULL,
	  `product_type_publish` char(1) default NULL,
	  `product_type_browsepage` varchar(255) default NULL,
	  `product_type_flypage` varchar(255) default NULL,
	  `product_type_list_order` int(11) default NULL,
	  PRIMARY KEY (`product_type_id`)
  ) TYPE=MyISAM;" ); $database->query();
  
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_product_type_xref` (
	  `product_id` int(11) NOT NULL,
	  `product_type_id` int(11) NOT NULL,
	  KEY `idx_product_product_type_xref_product_id` (`product_id`),
	  KEY `idx_product_product_type_xref_product_type_id` (`product_type_id`)
  ) TYPE=MyISAM;" ); $database->query();
  
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_type_parameter` (
	  `product_type_id` int(11) NOT NULL,
	  `parameter_name` varchar(255) NOT NULL,
	  `parameter_label` varchar(255) NOT NULL default '',
	  `parameter_description` text,
	  `parameter_list_order` int(11) NOT NULL,
	  `parameter_type` char(1) NOT NULL default 'T',
	  `parameter_values` varchar(255) default NULL,
	  `parameter_multiselect` char(1) default NULL,
	  `parameter_default` varchar(255) default NULL,
	  `parameter_unit` varchar(32) default NULL,
	  PRIMARY KEY (`product_type_id`,`parameter_name`),
	  KEY `idx_product_type_parameter_product_type_id` (`product_type_id`),
	  KEY `idx_product_type_parameter_parameter_order` (`parameter_list_order`)
  ) TYPE=MyISAM;" ); $database->query();
  
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_product_votes` (
  `product_id` int(255) NOT NULL default '0',
  `votes` text NOT NULL,
  `allvotes` int(11) NOT NULL default '0',
  `rating` tinyint(1) NOT NULL default '0',
  `lastip` varchar(50) NOT NULL default '0'
) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_shipping_carrier` (
				`shipping_carrier_id` int(11) not null auto_increment, 
				`shipping_carrier_name` char(80) default '' not null, 
				`shipping_carrier_list_order` int(11) not null default 0, 
				PRIMARY KEY (`shipping_carrier_id`)) ;" ); $database->query();
  $database->setQuery( " INSERT INTO `#__pshop_shipping_carrier` VALUES (1, 'DHL', 0);" ); $database->query();
  $database->setQuery( " INSERT INTO `#__pshop_shipping_carrier` VALUES (2, 'UPS', 1);" ); $database->query();
  
  $database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_shipping_rate` (
				`shipping_rate_id` int(11) not null auto_increment, 
				`shipping_rate_name` varchar(255) default '' not null, 
				`shipping_rate_carrier_id` int(11) default '0' not null, 
				`shipping_rate_country` text default '' not null, 
				`shipping_rate_zip_start` varchar(32) default '' not null, 
				`shipping_rate_zip_end` varchar(32) default '' not null, 
				`shipping_rate_weight_start` decimal(10,3) default '0' not null, 
				`shipping_rate_weight_end` decimal(10,3) default '0' not null, 
				`shipping_rate_value` decimal(10,2) default '0' not null, 
				`shipping_rate_package_fee` decimal(10,2) default '0' not null, 
				`shipping_rate_currency_id` int(11) default '0' not null, 
				`shipping_rate_vat_id` int(11) default '0' not null,
				`shipping_rate_list_order` int(11) default '0' not null, 
				PRIMARY KEY (`shipping_rate_id`)) ;" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (1,'Inland &gt; 4kg','1','DEU','00000','99999','0.0','4.0','5.62','2','47','0','1');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (2,'Inland &gt; 8kg','1','DEU','00000','99999','4.0','8.0','6.39','2','47','0','2');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (3,'Inland &gt; 12kg','1','DEU','00000','99999','8.0','12.0','7.16','2','47','0','3');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (4,'Inland &gt; 20kg','1','DEU','00000','99999','12.0','20.0','8.69','2','47','0','4');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (5,'EU+ &gt;  4kg','1','AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE','00000','99999','0.0','4.0','14,57','2','47','0','5');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (6,'EU+ &gt;  8kg','1','AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE','00000','99999','4.0','8.0','18,66','2','47','0','6');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (7,'EU+ &gt; 12kg','1','AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE','00000','99999','8.0','12.0','22,57','2','47','0','7');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (8,'EU+ &gt; 20kg','1','AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE','00000','99999','12.0','20.0','30,93','2','47','0','8');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (9,'Europe &gt; 4kg','1','ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP','00000','99999','0.0','4.0','23,78','2','47','0','9');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (10,'Europe &gt;  8kg','1','ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP','00000','99999','4.0','8.0','29,91','2','47','0','10');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (11,'Europe &gt; 12kg','1','ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP','00000','99999','8.0','12.0','36,05','2','47','0','11');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (12,'Europe &gt; 20kg','1','ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP','00000','99999','12.0','20.0','48,32','2','47','0','12');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (13,'World_1 &gt;  4kg','1','EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA','00000','99999','0.0','4.0','26,84','2','47','0','13');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (14,'World_1 &gt; 8kg','1','EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA','00000','99999','4.0','8.0','35,02','2','47','0','14');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (15,'World_1 &gt;12kg','1','EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA','00000','99999','8.0','12.0','43,20','2','47','0','15');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (16,'World_1 &gt;20kg','1','EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA','00000','99999','12.0','20.0','59,57','2','47','0','16');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (17,'World_2 &gt; 4kg','1','','00000','99999','0.0','4.0','32,98','2','47','0','17');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (18,'World_2 &gt; 8kg','1','','00000','99999','4.0','8.0','47,29','2','47','0','18');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (19,'World_2 &gt; 12kg','1','','00000','99999','8.0','12.0','61,61','2','47','0','19');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (20,'World_2 &gt; 20kg','1','','00000','99999','12.0','20.0','90,24','2','47','0','20');" ); $database->query();
   $database->setQuery( " INSERT INTO `#__pshop_shipping_rate` VALUES (21,'UPS Express','2','AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE','00000','99999','0.0','20.0','5,24','2','47','0','21');" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_shopper_group` (
  `shopper_group_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `shopper_group_name` varchar(32) default NULL,
  `shopper_group_desc` text,
  `shopper_group_discount` DECIMAL( 3,2 ) DEFAULT '0.00' NOT NULL,
  `show_price_including_tax` TINYINT( 1 ) DEFAULT '1' NOT NULL,
  `default`tinyint(1) default '0' NOT NULL,
  PRIMARY KEY  (`shopper_group_id`),
  KEY `idx_shopper_group_vendor_id` (`vendor_id`),
  KEY `idx_shopper_group_name` (`shopper_group_name`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_shopper_group` VALUES (5, 1, '-default-', 'This is the default shopper group.','0.00', '1', '1')" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_shopper_group` VALUES (6, 1, 'Gold Level', 'Gold Level phpShoppers.','0.00', '1', '0')" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_shopper_group` VALUES (7, 1, 'Wholesale', 'Shoppers that can buy at wholesale.','0.00', '0', '0')" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_shopper_vendor_xref` (
  `user_id` varchar(32) default NULL,
  `vendor_id` int(11) default NULL,
  `shopper_group_id` int(11) default NULL,
  `customer_number` varchar(32) default NULL,
  KEY `idx_shopper_vendor_xref_user_id` (`user_id`),
  KEY `idx_shopper_vendor_xref_vendor_id` (`vendor_id`),
  KEY `idx_shopper_vendor_xref_shopper_group_id` (`shopper_group_id`)
) TYPE=MyISAM;" ); $database->query();

$database->setQuery( "SELECT id FROM #__users"); 
$row = $database->loadObjectList();
foreach( $row as $user) {
  $database->setQuery( "INSERT INTO `#__pshop_shopper_vendor_xref` VALUES ('".$user->id."', '1', '5', '');" );
  $database->query();
  $database->setQuery( "INSERT INTO `#__pshop_auth_user_vendor` VALUES ('".$user->id."', '1');" );
  $database->query();
}

# States Management; 05.05.2005
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_state` (
	`state_id` int(11) NOT NULL auto_increment,
	`country_id` int(11) NOT NULL default '1',
	`state_name` varchar(64) default NULL,
	`state_3_code` char(3) default NULL,
	`state_2_code` char(2) default NULL,
	PRIMARY KEY  (`state_id`),
	UNIQUE KEY `state_3_code` (`state_3_code`,`state_2_code`),
	KEY `idx_country_id` (`country_id`)
  ) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_state` VALUES
('', 223, 'Alabama', 'ALA', 'AL'),  ('', 223, 'Alaska', 'ALK', 'AK'),  ('', 223, 'Arizona', 'ARZ', 'AZ'),
('', 223, 'Arkansas', 'ARK', 'AR'),  ('', 223, 'California', 'CAL', 'CA'),  ('', 223, 'Colorado', 'COL', 'CO'),
('', 223, 'Connecticut', 'CCT', 'CT'),  ('', 223, 'Delaware', 'DEL', 'DE'),  ('', 223, 'District Of Columbia', 'DOC', 'DC'),
('', 223, 'Florida', 'FLO', 'FL'),  ('', 223, 'Georgia', 'GEA', 'GA'),  ('', 223, 'Hawaii', 'HWI', 'HI'),
('', 223, 'Idaho', 'IDA', 'ID'),  ('', 223, 'Illinois', 'ILL', 'IL'),  ('', 223, 'Indiana', 'IND', 'IN'),
('', 223, 'Iowa', 'IOA', 'IA'),  ('', 223, 'Kansas', 'KAS', 'KS'),  ('', 223, 'Kentucky', 'KTY', 'KY'),
('', 223, 'Louisiana', 'LOA', 'LA'),  ('', 223, 'Maine', 'MAI', 'ME'),  ('', 223, 'Maryland', 'MLD', 'MD'),
('', 223, 'Massachusetts', 'MSA', 'MA'),  ('', 223, 'Michigan', 'MIC', 'MI'),  ('', 223, 'Minnesota', 'MIN', 'MN'),
('', 223, 'Mississippi', 'MIS', 'MS'),  ('', 223, 'Missouri', 'MIO', 'MO'),  ('', 223, 'Montana', 'MOT', 'MT'),
('', 223, 'Nebraska', 'NEB', 'NE'),  ('', 223, 'Nevada', 'NEV', 'NV'),  ('', 223, 'New Hampshire', 'NEH', 'NH'),
('', 223, 'New Jersey', 'NEJ', 'NJ'),  ('', 223, 'New Mexico', 'NEM', 'NM'),  ('', 223, 'New York', 'NEY', 'NY'),
('', 223, 'North Carolina', 'NOC', 'NC'),  ('', 223, 'North Dakota', 'NOD', 'ND'),  ('', 223, 'Ohio', 'OHI', 'OH'),
('', 223, 'Oklahoma', 'OKL', 'OK'),  ('', 223, 'Oregon', 'ORN', 'OR'),  ('', 223, 'Pennsylvania', 'PEA', 'PA'),
('', 223, 'Rhode Island', 'RHI', 'RI'),  ('', 223, 'South Carolina', 'SOC', 'SC'),  ('', 223, 'South Dakota', 'SOD', 'SD'),
('', 223, 'Tennessee', 'TEN', 'TN'),  ('', 223, 'Texas', 'TXS', 'TX'), ('', 223, 'Utah', 'UTA', 'UT'),  
('', 223, 'Vermont', 'VMT', 'VT'),  ('', 223, 'Virginia', 'VIA', 'VA'),  ('', 223, 'Washington', 'WAS', 'WA'),  
('', 223, 'West Virginia', 'WEV', 'WV'),  ('', 223, 'Wisconsin', 'WIS', 'WI'), ('', 223, 'Wyoming', 'WYO', 'WY'),

('', 38, 'Alberta', 'ALB', 'AB'),  ('', 38, 'British Columbia', 'BRC', 'BC'),  ('', 38, 'Manitoba', 'MAB', 'MB'),
('', 38, 'New Brunswick', 'NEB', 'NB'),  ('', 38, 'Newfoundland and Labrador', 'NFL', 'NL'),  ('', 38, 'Northwest Territories', 'NWT', 'NT'),
('', 38, 'Nova Scotia', 'NOS', 'NS'),  ('', 38, 'Nunavut', 'NUT', 'NU'),  ('', 38, 'Ontario', 'ONT', 'ON'),
('', 38, 'Prince Edward Island', 'PEI', 'PE'),  ('', 38, 'Quebec', 'QEC', 'QC'),  ('', 38, 'Saskatchewan', 'SAK', 'SK'),
('', 38, 'Yukon', 'YUT', 'YT'),  ('', 222, 'England', 'ENG', 'EN'),  ('', 222, 'Northern Ireland', 'NOI', 'NI'),
('', 222, 'Scotland', 'SCO', 'SD'),  ('', 222, 'Wales', 'WLS', 'WS'),  ('', 13, 'Australian Capital Territory', 'ACT', 'AT'),
('', 13, 'New South Wales', 'NSW', 'NW'),  ('', 13, 'Northern Territory', 'NOT', 'NT'),  ('', 13, 'Queensland', 'QLD', 'QL'),
('', 13, 'South Australia', 'SOA', 'SA'),  ('', 13, 'Tasmania', 'TAS', 'TA'),  ('', 13, 'Victoria', 'VIC', 'VI'),  ('', 13, 'Western Australia', 'WEA', 'WA'),

('', 138, 'Aguascalientes', 'AGS', 'AG'),  ('', 138, 'Baja California Norte', 'BCN', 'BN'),  ('', 138, 'Baja California Sur', 'BCS', 'BS'),
('', 138, 'Campeche', 'CAM', 'CA'),  ('', 138, 'Chiapas', 'CHI', 'CS'),  ('', 138, 'Chihuahua', 'CHA', 'CH'),
('', 138, 'Coahuila', 'COA', 'CO'),  ('', 138, 'Colima', 'COL', 'CM'),  ('', 138, 'Distrito Federal', 'DFM', 'DF'),
('', 138, 'Durango', 'DGO', 'DO'),  ('', 138, 'Guanajuato', 'GTO', 'GO'),  ('', 138, 'Guerrero', 'GRO', 'GU'),
('', 138, 'Hidalgo', 'HGO', 'HI'),  ('', 138, 'Jalisco', 'JAL', 'JA'),  ('', 138, 'México (Estado de)', 'EDM', 'EM'),
('', 138, 'Michoacán', 'MCN', 'MI'),  ('', 138, 'Morelos', 'MOR', 'MO'),  ('', 138, 'Nayarit', 'NAY', 'NY'),
('', 138, 'Nuevo León', 'NUL', 'NL'),  ('', 138, 'Oaxaca', 'OAX', 'OA'),  ('', 138, 'Puebla', 'PUE', 'PU'),
('', 138, 'Querétaro', 'QRO', 'QU'),  ('', 138, 'Quintana Roo', 'QUR', 'QR'),  ('', 138, 'San Luis Potosí', 'SLP', 'SP'),
('', 138, 'Sinaloa', 'SIN', 'SI'),  ('', 138, 'Sonora', 'SON', 'SO'),  ('', 138, 'Tabasco', 'TAB', 'TA'),
('', 138, 'Tamaulipas', 'TAM', 'TM'),  ('', 138, 'Tlaxcala', 'TLX', 'TX'),  ('', 138, 'Veracruz', 'VER', 'VZ'),
('', 138, 'Yucatán', 'YUC', 'YU'),  ('', 138, 'Zacatecas', 'ZAC', 'ZA'),

('', 30, 'Acre', 'ACR', 'AC'),  ('', 30, 'Alagoas', 'ALG', 'AL'),  ('', 30, 'Amapá', 'AMP', 'AP'),
('', 30, 'Amazonas', 'AMZ', 'AM'),  ('', 30, 'Bahía', 'BAH', 'BA'),  ('', 30, 'Ceará', 'CEA', 'CE'),
('', 30, 'Distrito Federal', 'DFB', 'DF'),  ('', 30, 'Espirito Santo', 'ESS', 'ES'),  ('', 30, 'Goiás', 'GOI', 'GO'),
('', 30, 'Maranhão', 'MAR', 'MA'),  ('', 30, 'Mato Grosso', 'MAT', 'MT'),
('', 30, 'Mato Grosso do Sul', 'MGS', 'MS'),  ('', 30, 'Minas Geraís', 'MIG', 'MG'),  ('', 30, 'Paraná', 'PAR', 'PR'),
('', 30, 'Paraíba', 'PRB', 'PB'),  ('', 30, 'Pará', 'PAB', 'PA'),  ('', 30, 'Pernambuco', 'PER', 'PR'),
('', 30, 'Piauí', 'PIA', 'PI'),  ('', 30, 'Rio Grande do Norte', 'RGN', 'RN'),  ('', 30, 'Rio Grande do Sul', 'RGS', 'RS'),
('', 30, 'Rio de Janeiro', 'RDJ', 'RJ'),  ('', 30, 'Rondônia', 'RON', 'RO'),
('', 30, 'Roraima', 'ROR', 'RR'),  ('', 30, 'Santa Catarina', 'SAC', 'SC'),  ('', 30, 'Sergipe', 'SER', 'SE'),
('', 30, 'São Paulo', 'SAP', 'SP'),  ('', 30, 'Tocantins', 'TOC', 'TO'),  

('', 44, 'Anhui', 'ANH', 'AN'),  ('', 44, 'Beijing', 'BEI', 'BE'),  ('', 44, 'Fujian', 'FUJ', 'FJ'),
('', 44, 'Gansu', 'GAN', 'GU'),  ('', 44, 'Guangdong', 'GUA', 'GU'),  ('', 44, 'Guangxi Zhuang', 'GUZ', 'GZ'),
('', 44, 'Guizhou', 'GUI', 'GI'),  ('', 44, 'Hainan', 'HAI', 'HA'),  ('', 44, 'Hebei', 'HEB', 'HE'),
('', 44, 'Heilongjiang', 'HEI', 'HG'),  ('', 44, 'Henan', 'HEN', 'HN'), 
('', 44, 'Hubei', 'HUB', 'HI'),  ('', 44, 'Hunan', 'HUN', 'HU'),  ('', 44, 'Jiangsu', 'JIA', 'JI'),
('', 44, 'Jiangxi', 'JIX', 'JX'),  ('', 44, 'Jilin', 'JIL', 'JN'),  ('', 44, 'Liaoning', 'LIA', 'LI'),
('', 44, 'Nei Mongol', 'NML', 'NM'),  ('', 44, 'Ningxia Hui', 'NIH', 'NH'),  ('', 44, 'Qinghai', 'QIN', 'QI'),
('', 44, 'Shaanxi', 'SHA', 'SH'),  ('', 44, 'Shandong', 'SNG', 'SG'),  ('', 44, 'Shanghai', 'SHH', 'SI'),
('', 44, 'Shanxi', 'SHX', 'SX'),  ('', 44, 'Sichuan', 'SIC', 'SN'),  ('', 44, 'Tianjin', 'TIA', 'TI'),
('', 44, 'Xinjiang Uygur', 'XIU', 'XU'),  ('', 44, 'Xizang', 'XIZ', 'XI'),  ('', 44, 'Yunnan', 'YUN', 'YU'),  ('', 44, 'Zhejiang', 'ZHE', 'ZH');"); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_tax_rate` (
  `tax_rate_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `tax_state` varchar(64) default NULL,
  `tax_country` varchar(64) default NULL,
  `mdate` int(11) default NULL,
  `tax_rate` decimal(10,4) default NULL,
  PRIMARY KEY  (`tax_rate_id`),
  KEY `idx_tax_rate_vendor_id` (`vendor_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_tax_rate` VALUES (2, 1, 'CA', 'USA', 964565926, '0.0825');" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_user_info` (
  `user_info_id` int(11) NOT NULL auto_increment,
  `user_id` varchar(32) NOT NULL default '',
  `address_type` char(2) default NULL,
  `address_type_name` varchar(32) default NULL,
  `company` varchar(64) default NULL,
  `title` varchar(32) default NULL,
  `last_name` varchar(32) default NULL,
  `first_name` varchar(32) default NULL,
  `middle_name` varchar(32) default NULL,
  `phone_1` varchar(32) default NULL,
  `phone_2` varchar(32) default NULL,
  `fax` varchar(32) default NULL,
  `address_1` varchar(64) NOT NULL default '',
  `address_2` varchar(64) default NULL,
  `city` varchar(32) NOT NULL default '',
  `state` varchar(32) NOT NULL default '',
  `country` varchar(32) NOT NULL default 'US',
  `zip` varchar(32) NOT NULL default '',
  `user_email` varchar(255) default NULL,
  `extra_field_1` varchar(255) default NULL,
  `extra_field_2` varchar(255) default NULL,
  `extra_field_3` varchar(255) default NULL,
  `extra_field_4` char(1) default NULL,
  `extra_field_5` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `perms` VARCHAR( 40 ) DEFAULT 'shopper' NOT NULL,
  PRIMARY KEY  (`user_info_id`),
  KEY `idx_user_info_user_id` (`user_id`)
) TYPE=MyISAM AUTO_INCREMENT=20 ;" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_vendor` (
  `vendor_id` int(11) NOT NULL auto_increment,
  `vendor_name` varchar(64) default NULL,
  `contact_last_name` varchar(32) NOT NULL default '',
  `contact_first_name` varchar(32) NOT NULL default '',
  `contact_middle_name` varchar(32) default NULL,
  `contact_title` varchar(32) default NULL,
  `contact_phone_1` varchar(32) NOT NULL default '',
  `contact_phone_2` varchar(32) default NULL,
  `contact_fax` varchar(32) default NULL,
  `contact_email` varchar(255) default NULL,
  `vendor_phone` varchar(32) default NULL,
  `vendor_address_1` varchar(64) NOT NULL default '',
  `vendor_address_2` varchar(64) default NULL,
  `vendor_city` varchar(32) NOT NULL default '',
  `vendor_state` varchar(32) NOT NULL default '',
  `vendor_country` varchar(32) NOT NULL default 'US',
  `vendor_zip` varchar(32) NOT NULL default '',
  `vendor_store_name` varchar(128) NOT NULL default '',
  `vendor_store_desc` text,
  `vendor_category_id` int(11) default NULL,
  `vendor_thumb_image` varchar(255) default NULL,
  `vendor_full_image` varchar(255) default NULL,
  `vendor_currency` varchar(16) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `vendor_image_path` varchar(255) default NULL,
  `vendor_terms_of_service` TEXT NOT NULL,
  `vendor_url` VARCHAR( 255 ) NOT NULL,
  `vendor_min_pov` DECIMAL( 10, 2 ),
  `vendor_freeshipping` DECIMAL( 10, 2 ) NOT NULL,
  `vendor_currency_display_style` VARCHAR( 64 ) NOT NULL,
  PRIMARY KEY  (`vendor_id`),
  KEY `idx_vendor_name` (`vendor_name`),
  KEY `idx_vendor_category_id` (`vendor_category_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_vendor` VALUES (1, 'Washupito\'s Tiendita', 'Owner', 'Demo', 'Store', 'Mr.', 
	  '555-555-1212', '555-555-1212', '555-555-1212', '$mosConfig_mailfrom', '555-555-1212', '100 Washupito Avenue, N.W.', 
	  '', 'Lake Forest', 'CA', 'USA', '92630', 'Washupito\'s Tiendita', 
	  '<p>We have the best tools for do-it-yourselfers.  Check us out! </p>
	<p>We were established in 1969 in a time when getting good tools was expensive, but the quality was good.  Now that only a select few of those authentic tools survive, we have dedicated this store to bringing the experience alive for collectors and master mechanics everywhere.</p>
	<p>You can easily find products selecting the category you would like to browse above.</p>', 0, '', 'c19970d6f2970cb0d1b13bea3af3144a.gif', 'USD', 950302468, 968309845, 'shop_image/', 
	  '<h5>You haven\'t configured any terms of service yet. Click <a href=administrator/index2.php?page=store.store_form&option=com_phpshop>here</a> to change this text.</h5>',
	  'http://www.mambo-phpshop.net','0.00', '0.00', '1|$|2|.| |2|1');" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_vendor_category` (
  `vendor_category_id` int(11) NOT NULL auto_increment,
  `vendor_category_name` varchar(64) default NULL,
  `vendor_category_desc` text,
  PRIMARY KEY  (`vendor_category_id`),
  KEY `idx_vendor_category_category_name` (`vendor_category_name`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_vendor_category` VALUES (6, '-default-', 'Default');" ); $database->query();
$database->setQuery( "CREATE TABLE `#__pshop_waiting_list` (
	  waiting_list_id int(11) NOT NULL auto_increment,
	  product_id int(11) NOT NULL default '0',
	  user_id varchar(32) NOT NULL default '',
	  notify_email varchar(150) NOT NULL default '',
	  notified enum('0','1') default '0',
	  notify_date timestamp(14) NOT NULL,
	  PRIMARY KEY  (waiting_list_id),
	  KEY product_id (product_id),
	  KEY notify_email (notify_email)
	) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_zone_shipping` (
  `zone_id` int(11) NOT NULL auto_increment,
  `zone_name` varchar(255) default NULL,
  `zone_cost` decimal(10,2) default NULL,
  `zone_limit` decimal(10,2) default NULL,
  `zone_description` text NOT NULL,
  `zone_tax_rate` INT( 11 ) NOT NULL,
  PRIMARY KEY  (`zone_id`),
  KEY zone_id (`zone_id`)
) TYPE=MyISAM;" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_zone_shipping` VALUES (1, 'Default', '6.00', '35.00', 'This is the default Shipping Zone. This is the zone information that all countries will use until you assign each individual country to a Zone.', '2');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_zone_shipping` VALUES (2, 'Zone 1', '1000.00', '10000.00', 'This is a zone example', '2');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_zone_shipping` VALUES (3, 'Zone 2', '2.00', '22.00', 'This is the second zone. You can use this for notes about this zone', '2');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_zone_shipping` VALUES (4, 'Zone 3', '11.00', '64.00', 'Another usefull thing might be details about this zone or special instructions.', '2');" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_affiliate_sale` (
			   `order_id` int(11) NOT NULL,
			   `visit_id` varchar(32) NOT NULL,
			   `affiliate_id` int(11) NOT NULL,
			   `rate` int(2) NOT NULL,
			   PRIMARY KEY (`order_id`));" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_affiliate` (
	   `affiliate_id` int(11) NOT NULL auto_increment,
	   `user_id` VARCHAR(32) NOT NULL,
	   `active` char(1) DEFAULT 'N' NOT NULL,
	   `rate` int(11) NOT NULL,
	   PRIMARY KEY (`affiliate_id`));" ); $database->query();

$database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_visit` (
			 `visit_id` varchar(255) NOT NULL,
			 `affiliate_id` int(11) NOT NULL,
			 `pages` int(11) NOT NULL,
			 `entry_page` varchar(255) NOT NULL,
			 `exit_page` varchar(255) NOT NULL,
			 `sdate` int(11) NOT NULL,
			 `edate` int(11) NOT NULL,
			 PRIMARY KEY (`visit_id`));" ); $database->query();
 $database->setQuery( "CREATE TABLE IF NOT EXISTS `#__pshop_creditcard` (
				`creditcard_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
				`vendor_id` INT( 11 ) NOT NULL,
				`creditcard_name` VARCHAR( 70 ) NOT NULL ,
				`creditcard_code` VARCHAR( 30 ) NOT NULL ,
				PRIMARY KEY ( `creditcard_id` )
				);" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (1, 1, 'Visa', 'VISA');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (2, 1, 'MasterCard', 'MC');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (3, 1, 'American Express', 'amex');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (4, 1, 'Discover Card', 'discover');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (5, 1, 'Diners Club', 'diners');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (6, 1, 'JCB', 'jcb');" ); $database->query();
$database->setQuery( "INSERT INTO `#__pshop_creditcard` VALUES (7, 1, 'Australian Bankcard', 'australian_bc');" ); $database->query();

?>