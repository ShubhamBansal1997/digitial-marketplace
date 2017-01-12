--
-- Table structure for table `ts_categories`
--

CREATE TABLE IF NOT EXISTS `ts_categories` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cate_urlname` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cate_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_country`
--

CREATE TABLE IF NOT EXISTS `ts_country` (
  `countryId` int(11) NOT NULL,
  `countryName` varchar(32) DEFAULT NULL,
  `countryCode` varchar(4) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ts_country`
--

INSERT INTO `ts_country` (`countryId`, `countryName`, `countryCode`) VALUES
(2, 'Afghanistan', 'AF'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bosnia and Herzegovina', 'BA'),
(29, 'Botswana', 'BW'),
(30, 'Brazil', 'BR'),
(31, 'British Indian Ocean Territory', 'IO'),
(32, 'British Virgin Islands', 'VG'),
(33, 'Brunei', 'BN'),
(34, 'Bulgaria', 'BG'),
(35, 'Burkina Faso', 'BF'),
(36, 'Burundi', 'BI'),
(37, 'Cambodia', 'KH'),
(38, 'Cameroon', 'CM'),
(39, 'Canada', 'CA'),
(40, 'Cape Verde', 'CV'),
(41, 'Cayman Islands', 'KY'),
(42, 'Central African Republic', 'CF'),
(43, 'Chad', 'TD'),
(44, 'Chile', 'CL'),
(45, 'China', 'CN'),
(46, 'Christmas Island', 'CX'),
(47, 'Cocos Islands', 'CC'),
(48, 'Colombia', 'CO'),
(49, 'Comoros', 'KM'),
(50, 'Cook Islands', 'CK'),
(51, 'Costa Rica', 'CR'),
(52, 'Croatia', 'HR'),
(53, 'Cuba', 'CU'),
(54, 'Curacao', 'CW'),
(55, 'Cyprus', 'CY'),
(56, 'Czech Republic', 'CZ'),
(57, 'Democratic Republic of the Congo', 'CD'),
(58, 'Denmark', 'DK'),
(59, 'Djibouti', 'DJ'),
(60, 'Dominica', 'DM'),
(61, 'Dominican Republic', 'DO'),
(62, 'East Timor', 'TL'),
(63, 'Ecuador', 'EC'),
(64, 'Egypt', 'EG'),
(65, 'El Salvador', 'SV'),
(66, 'Equatorial Guinea', 'GQ'),
(67, 'Eritrea', 'ER'),
(68, 'Estonia', 'EE'),
(69, 'Ethiopia', 'ET'),
(70, 'Falkland Islands', 'FK'),
(71, 'Faroe Islands', 'FO'),
(72, 'Fiji', 'FJ'),
(73, 'Finland', 'FI'),
(74, 'France', 'FR'),
(75, 'French Polynesia', 'PF'),
(76, 'Gabon', 'GA'),
(77, 'Gambia', 'GM'),
(78, 'Georgia', 'GE'),
(79, 'Germany', 'DE'),
(80, 'Ghana', 'GH'),
(81, 'Gibraltar', 'GI'),
(82, 'Greece', 'GR'),
(83, 'Greenland', 'GL'),
(84, 'Grenada', 'GD'),
(85, 'Guam', 'GU'),
(86, 'Guatemala', 'GT'),
(87, 'Guernsey', 'GG'),
(88, 'Guinea', 'GN'),
(89, 'Guinea-Bissau', 'GW'),
(90, 'Guyana', 'GY'),
(91, 'Haiti', 'HT'),
(92, 'Honduras', 'HN'),
(93, 'Hong Kong', 'HK'),
(94, 'Hungary', 'HU'),
(95, 'Iceland', 'IS'),
(96, 'India', 'IN'),
(97, 'Indonesia', 'ID'),
(98, 'Iran', 'IR'),
(99, 'Iraq', 'IQ'),
(100, 'Ireland', 'IE'),
(101, 'Isle of Man', 'IM'),
(102, 'Israel', 'IL'),
(103, 'Italy', 'IT'),
(104, 'Ivory Coast', 'CI'),
(105, 'Jamaica', 'JM'),
(106, 'Japan', 'JP'),
(107, 'Jersey', 'JE'),
(108, 'Jordan', 'JO'),
(109, 'Kazakhstan', 'KZ'),
(110, 'Kenya', 'KE'),
(111, 'Kiribati', 'KI'),
(112, 'Kosovo', 'XK'),
(113, 'Kuwait', 'KW'),
(114, 'Kyrgyzstan', 'KG'),
(115, 'Laos', 'LA'),
(116, 'Latvia', 'LV'),
(117, 'Lebanon', 'LB'),
(118, 'Lesotho', 'LS'),
(119, 'Liberia', 'LR'),
(120, 'Libya', 'LY'),
(121, 'Liechtenstein', 'LI'),
(122, 'Lithuania', 'LT'),
(123, 'Luxembourg', 'LU'),
(124, 'Macao', 'MO'),
(125, 'Macedonia', 'MK'),
(126, 'Madagascar', 'MG'),
(127, 'Malawi', 'MW'),
(128, 'Malaysia', 'MY'),
(129, 'Maldives', 'MV'),
(130, 'Mali', 'ML'),
(131, 'Malta', 'MT'),
(132, 'Marshall Islands', 'MH'),
(133, 'Mauritania', 'MR'),
(134, 'Mauritius', 'MU'),
(135, 'Mayotte', 'YT'),
(136, 'Mexico', 'MX'),
(137, 'Micronesia', 'FM'),
(138, 'Moldova', 'MD'),
(139, 'Monaco', 'MC'),
(140, 'Mongolia', 'MN'),
(141, 'Montenegro', 'ME'),
(142, 'Montserrat', 'MS'),
(143, 'Morocco', 'MA'),
(144, 'Mozambique', 'MZ'),
(145, 'Myanmar', 'MM'),
(146, 'Namibia', 'NA'),
(147, 'Nauru', 'NR'),
(148, 'Nepal', 'NP'),
(149, 'Netherlands', 'NL'),
(150, 'Netherlands Antilles', 'AN'),
(151, 'New Caledonia', 'NC'),
(152, 'New Zealand', 'NZ'),
(153, 'Nicaragua', 'NI'),
(154, 'Niger', 'NE'),
(155, 'Nigeria', 'NG'),
(156, 'Niue', 'NU'),
(157, 'North Korea', 'KP'),
(158, 'Northern Mariana Islands', 'MP'),
(159, 'Norway', 'NO'),
(160, 'Oman', 'OM'),
(161, 'Pakistan', 'PK'),
(162, 'Palau', 'PW'),
(163, 'Palestine', 'PS'),
(164, 'Panama', 'PA'),
(165, 'Papua New Guinea', 'PG'),
(166, 'Paraguay', 'PY'),
(167, 'Peru', 'PE'),
(168, 'Philippines', 'PH'),
(169, 'Pitcairn', 'PN'),
(170, 'Poland', 'PL'),
(171, 'Portugal', 'PT'),
(172, 'Puerto Rico', 'PR'),
(173, 'Qatar', 'QA'),
(174, 'Republic of the Congo', 'CG'),
(175, 'Reunion', 'RE'),
(176, 'Romania', 'RO'),
(177, 'Russia', 'RU'),
(178, 'Rwanda', 'RW'),
(179, 'Saint Barthelemy', 'BL'),
(180, 'Saint Helena', 'SH'),
(181, 'Saint Kitts and Nevis', 'KN'),
(182, 'Saint Lucia', 'LC'),
(183, 'Saint Martin', 'MF'),
(184, 'Saint Pierre and Miquelon', 'PM'),
(185, 'Saint Vincent and the Grenadines', 'VC'),
(186, 'Samoa', 'WS'),
(187, 'San Marino', 'SM'),
(188, 'Sao Tome and Principe', 'ST'),
(189, 'Saudi Arabia', 'SA'),
(190, 'Senegal', 'SN'),
(191, 'Serbia', 'RS'),
(192, 'Seychelles', 'SC'),
(193, 'Sierra Leone', 'SL'),
(194, 'Singapore', 'SG'),
(195, 'Sint Maarten', 'SX'),
(196, 'Slovakia', 'SK'),
(197, 'Slovenia', 'SI'),
(198, 'Solomon Islands', 'SB'),
(199, 'Somalia', 'SO'),
(200, 'South Africa', 'ZA'),
(201, 'South Korea', 'KR'),
(202, 'South Sudan', 'SS'),
(203, 'Spain', 'ES'),
(204, 'Sri Lanka', 'LK'),
(205, 'Sudan', 'SD'),
(206, 'Suriname', 'SR'),
(207, 'Svalbard and Jan Mayen', 'SJ'),
(208, 'Swaziland', 'SZ'),
(209, 'Sweden', 'SE'),
(210, 'Switzerland', 'CH'),
(211, 'Syria', 'SY'),
(212, 'Taiwan', 'TW'),
(213, 'Tajikistan', 'TJ'),
(214, 'Tanzania', 'TZ'),
(215, 'Thailand', 'TH'),
(216, 'Togo', 'TG'),
(217, 'Tokelau', 'TK'),
(218, 'Tonga', 'TO'),
(219, 'Trinidad and Tobago', 'TT'),
(220, 'Tunisia', 'TN'),
(221, 'Turkey', 'TR'),
(222, 'Turkmenistan', 'TM'),
(223, 'Turks and Caicos Islands', 'TC'),
(224, 'Tuvalu', 'TV'),
(225, 'U.S. Virgin Islands', 'VI'),
(226, 'Uganda', 'UG'),
(227, 'Ukraine', 'UA'),
(228, 'United Arab Emirates', 'AE'),
(229, 'United Kingdom', 'GB'),
(230, 'United States', 'US'),
(231, 'Uruguay', 'UY'),
(232, 'Uzbekistan', 'UZ'),
(233, 'Vanuatu', 'VU'),
(234, 'Vatican', 'VA'),
(235, 'Venezuela', 'VE'),
(236, 'Vietnam', 'VN'),
(237, 'Wallis and Futuna', 'WF'),
(238, 'Western Sahara', 'EH'),
(239, 'Yemen', 'YE'),
(240, 'Zambia', 'ZM'),
(241, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `ts_coupons`
--

CREATE TABLE IF NOT EXISTS `ts_coupons` (
  `coup_id` int(11) NOT NULL,
  `coup_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `coup_code` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `coup_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `coup_amount` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `coup_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `coup_duration` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `coup_status` tinyint(4) NOT NULL DEFAULT '1',
  `coup_createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_downloadtbl`
--

CREATE TABLE IF NOT EXISTS `ts_downloadtbl` (
  `download_id` int(11) NOT NULL,
  `download_uid` int(11) NOT NULL,
  `download_pid` int(11) NOT NULL,
  `download_planid` int(11) NOT NULL,
  `download_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_emaillist`
--

CREATE TABLE IF NOT EXISTS `ts_emaillist` (
  `e_id` int(11) NOT NULL,
  `e_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `e_list` text COLLATE utf8_unicode_ci NOT NULL,
  `e_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `e_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_emailproviders`
--

CREATE TABLE IF NOT EXISTS `ts_emailproviders` (
  `ep_id` int(11) NOT NULL,
  `ep_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ep_credentials` text COLLATE utf8_unicode_ci NOT NULL,
  `ep_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_eplist`
--

CREATE TABLE IF NOT EXISTS `ts_eplist` (
  `eplist_id` int(11) NOT NULL,
  `eplist_parentid` int(11) NOT NULL,
  `eplist_uniqid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `eplist_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `eplist_use` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_lancate`
--

CREATE TABLE IF NOT EXISTS `ts_lancate` (
  `lancate_id` int(11) NOT NULL,
  `lancate_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lancate_symbol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lancate_status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_language`
--

CREATE TABLE IF NOT EXISTS `ts_language` (
  `language_id` int(11) NOT NULL,
  `language_key` text COLLATE utf8_unicode_ci NOT NULL,
  `language_type` text COLLATE utf8_unicode_ci NOT NULL,
  `language_english` text COLLATE utf8_unicode_ci NOT NULL,
  `language_french` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=320 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_language`
--

INSERT INTO `ts_language` (`language_id`, `language_key`, `language_type`, `language_english`, `language_french`) VALUES
(1, 'login', 'title', 'Themeportal - Login Page', 'Themeportal - Page de connexion'),
(2, 'register', 'title', 'Themeportal - Register Page', 'Themeportal - Inscrire page'),
(3, 'forgotpwd', 'title', 'Themeportal - Forgot Password Page', 'Themeportal - Mot de passe oubliÃƒÆ’Ã‚Â© page'),
(4, 'resetpwd', 'title', 'Themeportal - Reset Password Page', 'Themeportal - RÃƒÆ’Ã‚Â©initialiser page Mot de passe'),
(5, 'email', 'message', 'Email should be correct.', 'Email devrait ÃƒÆ’Ã‚Âªtre correcte.'),
(6, 'empty', 'message', 'All fields are Required', 'Tous les champs sont requis'),
(7, 'password', 'message', 'Password should contain minimum 7 characters.', 'Mot de passe doit contenir un minimum de 7 caractÃƒÆ’Ã‚Â¨res.'),
(8, 'repassword', 'message', 'Both passwords should be same.', 'Les deux mots de passe doivent ÃƒÆ’Ã‚Âªtre identiques.'),
(9, 'loginsuc', 'message', 'Successfully logged in.', 'RÃƒÆ’Ã‚Â©ussir connectÃƒÆ’Ã‚Â©.'),
(10, 'forgotpassword', 'message', 'Please, check your email for the forgot password link.', 'S''il vous plaÃƒÆ’Ã‚Â®t , vÃƒÆ’Ã‚Â©rifiez votre email pour le lien Mot de passe oubliÃƒÆ’Ã‚Â© .'),
(11, 'activateerror', 'message', 'Please, activate your account.', 'S''il vous plaÃƒÆ’Ã‚Â®t , activer votre compte.'),
(12, 'blockederror', 'message', 'Contact support, your account is blocked.', 'Contactez le support , votre compte est bloquÃƒÆ’Ã‚Â©.'),
(13, 'loginerror', 'message', 'Login details are incorrect.', 'Les informations de connexion sont incorrectes .'),
(14, 'forgotpwderror', 'message', 'This detail is not with us.', 'Ce dÃƒÆ’Ã‚Â©tail est pas avec nous .'),
(15, 'resetpwdsuc', 'message', 'Password changed successfully.', 'Le mot de passe a ÃƒÆ’Ã‚Â©tÃƒÆ’Ã‚Â© changÃƒÆ’Ã‚Â© avec succÃƒÆ’Ã‚Â¨s.'),
(17, 'bannerheading', 'homepage', 'YOU ARE THEME CREATOR', 'VOUS ÃƒÆ’Ã…Â TES THEME CREATOR'),
(16, 'registersuc', 'message', 'Please, check your email for activation link.', 'S''il vous plaÃƒÆ’Ã‚Â®t , vÃƒÆ’Ã‚Â©rifiez votre email pour le lien d''activation '),
(18, 'bannersubheading', 'homepage', 'Brought to you by the largest global community of creatives.', 'Offert ÃƒÆ’Ã‚Â  vous par la plus grande communautÃƒÆ’Ã‚Â© mondiale de crÃƒÆ’Ã‚Â©atifs '),
(19, 'searchplaceholder', 'homepage', 'Type here to search a theme', 'Tapez ici pour rechercher un thÃƒÆ’Ã‚Â¨me'),
(20, 'searchtext', 'homepage', 'Search', 'Chercher'),
(21, 'topbutton', 'homepage', 'browse newest theme', 'parcourir le plus rÃƒÆ’Ã‚Â©cent thÃƒÆ’Ã‚Â¨me'),
(22, 'featuredbox', 'homepage', 'FEATURED', 'VEDETTE\r\n'),
(23, 'buynowtab', 'homepage', 'buy now', 'Acheter maintenant'),
(24, 'livedemotab', 'homepage', 'live demo', '\r\ndÃƒÆ’Ã‚Â©monstration en direct'),
(25, 'ourlatestthemetext', 'homepage', 'OUR LATEST THEME', '\r\nNOS DERNIERES THÃƒÆ’Ã‹â€ ME'),
(26, 'latestsubheading', 'homepage', 'Get the best themes in the market', 'Trouvez les meilleurs thÃƒÆ’Ã‚Â¨mes du marchÃƒÆ’Ã‚Â©'),
(28, 'ourclientsaystext', 'homepage', 'OUR CLIENTS SAYS', '\r\nNOS CLIENTS DIT'),
(29, 'ourclientssubtext', 'homepage', 'What satisfied customer says', 'Qu''est-ce que dit client satisfait'),
(30, 'newsletterheading', 'homepage', 'SUBSCRIBE TO OUR NEWSLETTER', 'ABONNEZ-VOUS ÃƒÆ’Ã¢â€šÂ¬ NOTRE NEWSLETTER'),
(31, 'newslettersubheading', 'homepage', 'Subscribe to our newsletter for Latest News, Updates, Template directly in your inbox', 'Abonnez-vous ÃƒÆ’Ã‚Â  notre newsletter pour DerniÃƒÆ’Ã‚Â¨res Nouvelles , mises ÃƒÆ’Ã‚Â  jour , modÃƒÆ’Ã‚Â¨le directement dans votre boÃƒÆ’Ã‚Â®te de rÃƒÆ’Ã‚Â©ception'),
(32, 'newsletterplaceholder', 'homepage', 'Enter your mail address', 'Entrez votre adresse e-mail\r\n'),
(33, 'newsletterbutton', 'homepage', 'subscribe today', 'abonnez-vous dÃƒÆ’Ã‚Â¨s aujourd''hui'),
(34, 'newsletterinfo', 'homepage', 'We don''t share any of your information to others', 'Nous ne partageons pas vos informations ÃƒÆ’Ã‚Â  d''autres\r\n'),
(35, 'pricetext', 'singleproductpage', 'PRICE', 'PRIX'),
(36, 'ratingstext', 'singleproductpage', 'RATINGS', 'COTES'),
(37, 'likestext', 'singleproductpage', 'LIKES', 'AIME'),
(38, 'formate', 'singleproductpage', 'FORMATE', 'FORMAT'),
(39, 'licenseheading', 'singleproductpage', 'LICENSE OF USE', 'LICENCE D''UTILISATION'),
(40, 'licensesubheading', 'singleproductpage', 'You can use it for personal or commercial projects. You can''t resell it partially or in this form.', 'Vous pouvez l''utiliser pour des projets personnels ou commerciaux . Vous ne pouvez pas revendre partiellement ou sous cette forme.'),
(41, 'buynowbutton', 'singleproductpage', 'Buy Now', 'Acheter maintenant'),
(42, 'livedemobutton', 'singleproductpage', 'Live Demo', 'dÃƒÆ’Ã‚Â©monstration en direct'),
(43, 'productheading', 'singleproductpage', 'PRODUCT INFO', 'INFORMATION SUR LE PRODUIT'),
(44, 'createsubheading', 'singleproductpage', 'Create Date', 'crÃƒÆ’Ã‚Â©er un rendez-vous'),
(45, 'downloadssubheading', 'singleproductpage', 'Downloads', 'TÃƒÆ’Ã‚Â©lÃƒÆ’Ã‚Â©chargements'),
(46, 'updateddatetext', 'singleproductpage', 'Updated Date', ' date de mise ÃƒÆ’Ã‚Â  jour'),
(47, 'ratingssubheading', 'singleproductpage', 'Ratings', 'ÃƒÆ’Ã‚Â©valuations'),
(48, 'responsivesubheading', 'singleproductpage', 'Responsive', 'Sensible'),
(49, 'formatsubheading', 'singleproductpage', 'Format', 'Format'),
(50, 'documentssubheading', 'singleproductpage', 'Documents', 'Documents'),
(51, 'relatedheading', 'singleproductpage', 'RELATED PRODUCTS', 'PRODUITS CONNEXES'),
(52, 'username', 'message', 'Username should not contain any special characters and should be not more that 10 characters.', 'Nom d''utilisateur ne doit pas contenir de caractÃƒÆ’Ã‚Â¨res spÃƒÆ’Ã‚Â©ciaux et ne devrait pas ÃƒÆ’Ã‚Âªtre plus que 10 caractÃƒÆ’Ã‚Â¨res .'),
(53, 'usernameexists', 'message', 'Username is already taken. Please, try again.', 'Nom d''utilisateur dÃƒÆ’Ã‚Â©jÃƒÆ’Ã‚Â  pris. Veuillez rÃƒÆ’Ã‚Â©essayer.'),
(54, 'alltext', 'homepage', 'All', 'Tout'),
(55, 'newslettersuc', 'message', 'Thank you for subscribing.', 'Merci de vous ÃƒÆ’Ã‚Âªtre abonnÃƒÆ’Ã‚Â©.'),
(56, 'newslettererr', 'message', 'Oops : Something went wrong. Please, try again.', 'Oops : Quelque chose a mal tournÃƒÆ’Ã‚Â©. Veuillez rÃƒÆ’Ã‚Â©essayer.'),
(57, 'selectproduct', 'homepage', 'Select product', 'Choisir le produit'),
(58, 'pricetblbutton', 'commontext', 'Take this plan', 'Prenez ce plan'),
(99, 'sendtext', 'commontext', 'Send', 'Envoyer'),
(60, 'removeframe', 'commontext', 'Remove iframe', ' Retirer iframe'),
(61, 'signuptext', 'commontext', 'SignUp', 'S''inscrire'),
(62, 'logintext', 'commontext', 'Login', 'S''identifier'),
(63, 'logouttext', 'commontext', 'Logout', 'Se dÃƒÆ’Ã‚Â©connecter'),
(64, 'relatedprodtext', 'commontext', 'Related Products', 'Produits connexes'),
(65, 'searchrestext', 'commontext', 'Search result', 'RÃƒÆ’Ã‚Â©sultat de la recherche'),
(66, 'checkoutheading', 'commontext', 'Checkout Page', ' Commander page'),
(67, 'continueshopbtn', 'commontext', 'Continue Shopping', 'Continuer vos achats'),
(68, 'checkoutbtn', 'commontext', 'Checkout', 'Check-out'),
(69, 'plannametext', 'commontext', 'Product', 'Produit'),
(70, 'amounttext', 'commontext', 'Amount', 'Montant'),
(71, 'canceltext', 'commontext', 'Cancel', 'Annuler'),
(72, 'paymentboxheading', 'commontext', 'Click proceed to initiate payment', 'Cliquez sur Continuer pour lancer le paiement'),
(73, 'paymentboxbtn', 'commontext', 'Proceed', 'ProcÃƒÆ’Ã‚Â©der'),
(74, 'emptycart', 'message', 'Cart is empty, please choose products.', 'Le panier est vide , s''il vous plaÃƒÆ’Ã‚Â®t choisir les produits .'),
(75, 'payCanceledHeading', 'commontext', 'Transaction Cancelled', 'Transaction AnnulÃƒÆ’Ã‚Â©'),
(76, 'payCancelh3', 'commontext', 'Oops , you canceled payment.', 'Oops , vous avez annulÃƒÆ’Ã‚Â© le paiement .'),
(77, 'payCanceltext', 'commontext', 'You have canceled the payment, but don''''t worry the products are still in your cart. You can purchase them any time you want.', 'Vous avez annulÃƒÂ© le paiement , mais don''''t inquiÃƒÂ¨tent les produits sont toujours dans votre panier . Vous pouvez les acheter ÃƒÂ  tout moment.'),
(80, 'freetext', 'commontext', 'Free', 'Gratuit'),
(81, 'upgradebtn', 'commontext', 'Upgrade', 'Surclassement'),
(82, 'contactsuc', 'message', 'Thank you. We will get back to you in 24 hours.', '\r\nJe vous remercie. Nous reviendrons vers vous dans les 24 heures .'),
(83, 'hometext', 'menus', 'Home', 'Accueil'),
(84, 'abouttext', 'menus', 'About Us', 'ÃƒÆ’Ã¢â€šÂ¬ propos de nous'),
(85, 'producttext', 'menus', 'Products', 'Produits'),
(86, 'freetext', 'menus', 'Free', 'Gratuit'),
(87, 'paidtext', 'menus', 'Paid', 'PayÃƒÆ’Ã‚Â©'),
(88, 'plantext', 'menus', 'Plans', ' Des plans'),
(89, 'contacttext', 'menus', 'Contact', 'Contact'),
(90, 'dashboardtext', 'menus', 'Dashboard', 'Tableau de bord'),
(91, 'supporttext', 'menus', 'Support', 'Soutien'),
(92, 'privacytext', 'menus', 'Privacy policy', 'Politique de confidentialitÃƒÆ’Ã‚Â©'),
(93, 'tnctext', 'menus', 'Terms and Conditions', 'Termes et conditions'),
(94, 'paiddowntext', 'menus', 'Paid Downloads', 'TÃƒÆ’Ã‚Â©lÃƒÆ’Ã‚Â©chargements payÃƒÆ’Ã‚Â©s'),
(95, 'freedowntext', 'menus', 'Free Downloads ', 'TÃƒÆ’Ã‚Â©lÃƒÆ’Ã‚Â©chargements gratuits'),
(96, 'substext', 'menus', 'Add / Renew Subscription', 'Ajouter / Renouveler Abonnement'),
(97, 'profiletext', 'menus', 'Profile', 'Profil'),
(98, 'salestext', 'commontext', 'Sales', 'Ventes'),
(100, 'headingsupporttext', 'commontext', 'We are here to help you.', 'Nous sommes lÃƒÆ’Ã‚Â  pour vous aider.'),
(101, 'waittext', 'commontext', 'Wait', 'Attendez'),
(102, 'logusernametext', 'authentication', 'Username or Email', 'Nom d''utilisateur ou email'),
(103, 'logpwdtext', 'authentication', 'Password', 'Mot de passe'),
(104, 'logremembertext', 'authentication', 'Remember me', 'Souviens-toi de moi'),
(105, 'logforgotpwdtext', 'authentication', 'Forgot password ?', 'Mot de passe oubliÃƒÆ’Ã‚Â© ?'),
(106, 'logbottomtext', 'authentication', 'Don''t have account with Us,', 'Ne pas avoir un compte avec nous ,'),
(107, 'logbottomhreftext', 'authentication', 'Get one now.', 'Obtenez un maintenant.'),
(108, 'backtohometext', 'authentication', 'Back to home', 'De retour ÃƒÆ’Ã‚Â  la maison'),
(109, 'regusernametext', 'authentication', 'Username', 'Nom d''utilisateur'),
(110, 'regemailtext', 'authentication', 'Email', 'Email'),
(111, 'regbottomtext', 'authentication', 'Already have an account,', 'Vous avez dÃƒÆ’Ã‚Â©jÃƒÆ’Ã‚Â  un compte,'),
(112, 'regbottomhreftext', 'authentication', 'Get in now.', 'Entrez maintenant.'),
(113, 'fgpwdinputtext', 'authentication', 'Just enter username or email', 'Il suffit d''entrer le nom d''utilisateur ou e-mail'),
(114, 'submittext', 'authentication', 'Submit', 'Soumettre'),
(115, 'logconfirmpwdtext', 'authentication', 'Confirm Password', 'Confirmez le mot de passe'),
(116, 'producttext', 'userdashboard', 'Product', 'Produit'),
(117, 'datetext', 'userdashboard', 'Date', 'Date'),
(118, 'purchasecodetext', 'userdashboard', 'Purchase Code', 'code d''Achat'),
(119, 'downloadtext', 'userdashboard', 'Download', 'TÃƒÆ’Ã‚Â©lÃƒÆ’Ã‚Â©charger'),
(120, 'emptyproducttext', 'userdashboard', 'You have not purchased any product yet.', 'Vous ne l''avez pas encore achetÃƒÆ’Ã‚Â© un produit quelconque.'),
(121, 'freeprodtext', 'userdashboard', 'Free Products', 'Produits gratuits'),
(122, 'previewtext', 'userdashboard', 'Preview', 'AperÃƒÆ’Ã‚Â§u'),
(123, 'emptyfreetext', 'userdashboard', 'There are no freebies.', 'Il n''y a pas freebies .'),
(124, 'profilesucc', 'userdashboard', 'Details updated successfully.', 'DÃƒÆ’Ã‚Â©tails mis ÃƒÆ’Ã‚Â  jour avec succÃƒÆ’Ã‚Â¨s .'),
(125, 'profilepwdsucc', 'userdashboard', 'Password updated successfully.', 'Mot de passe mis ÃƒÆ’Ã‚Â  jour avec succÃƒÆ’Ã‚Â¨s .'),
(126, 'profilepwderr', 'userdashboard', 'Password should contain minimum 7 characters.', 'Mot de passe doit contenir un minimum de 7 caractÃƒÆ’Ã‚Â¨res.'),
(127, 'profilepwdmatcherr', 'userdashboard', 'Password doesn''t match.', 'Mot de passe ne correspond pas.'),
(128, 'usernametext', 'userdashboard', 'User Name', 'Nom d''utilisateur'),
(129, 'emailtext', 'userdashboard', 'Email', 'Email'),
(130, 'fnametext', 'userdashboard', 'First Name', 'PrÃƒÆ’Ã‚Â©nom'),
(131, 'lnametext', 'userdashboard', 'Last Name', 'Nom de famille'),
(132, 'updatebtntext', 'userdashboard', 'Update', 'Mettre ÃƒÆ’Ã‚Â  jour'),
(133, 'basicheadingtext', 'userdashboard', 'basic information', 'information basique'),
(134, 'billingheadingtext', 'userdashboard', 'billing information', 'dÃƒÆ’Ã‚Â©tails de facturation'),
(135, 'pwdheadingtext', 'userdashboard', 'change password', 'changer le mot de passe'),
(136, 'passwordtext', 'userdashboard', 'Password', 'Mot de passe'),
(137, 'resetpwdtext', 'userdashboard', 'reset password', 'rÃƒÆ’Ã‚Â©initialiser le mot de passe'),
(138, 'mobiletext', 'userdashboard', 'Mobile', 'Mobile'),
(139, 'addtext', 'userdashboard', 'Address', 'Adresse'),
(140, 'countrytext', 'userdashboard', 'Country', 'Pays'),
(141, 'statetext', 'userdashboard', 'State', 'Etat'),
(142, 'citytext', 'userdashboard', 'City', 'Ville'),
(143, 'zipcodetext', 'userdashboard', 'Zip Code', 'Code postal'),
(144, 'paySuccessHeading', 'commontext', 'Success', 'le succÃƒÆ’Ã‚Â¨s'),
(145, 'paySuccessh3', 'commontext', 'Your payment is successful.', 'Votre paiement est rÃƒÆ’Ã‚Â©ussie.'),
(146, 'paySuccesstext', 'commontext', 'Your payment is successfully done, you can access the product from your dashboard.', 'Votre paiement est effectuÃƒÆ’Ã‚Â© avec succÃƒÆ’Ã‚Â¨s , vous pouvez accÃƒÆ’Ã‚Â©der au produit de votre tableau de bord .'),
(147, 'viewmoretext', 'commontext', 'View More', 'Voir plus'),
(148, 'addtocart', 'homepage', 'Add to cart', 'Ajouter au panier'),
(149, 'gallerybtn', 'homepage', 'Preview', 'AperÃ§u'),
(150, 'banktransfernote', 'homepage', 'Copy these details and transfer the amount.', 'Copiez ces dÃ©tails et transfÃ©rer le montant .'),
(151, 'banktransfersecond', 'homepage', 'I have already made the Transactions.', 'Je l''ai dÃ©jÃ  fait les Transactions .'),
(152, 'banktransferthird', 'homepage', 'Please, fill in the details of the transaction you have made : ', 'S''il vous plaÃ®t , remplissez les dÃ©tails de la transaction que vous avez fait :'),
(154, 'payWaittext', 'commontext', 'Your transaction details have been sent to the Admin for approval. Once, details are approved you will get the product in your download section.', 'Vos dÃ©tails de la transaction ont Ã©tÃ© envoyÃ©s Ã  l'' administration pour approbation. Une fois , les dÃ©tails sont approuvÃ©s , vous obtiendrez le produit dans la section de tÃ©lÃ©chargement.'),
(155, 'payWaith3', 'commontext', 'Thanks, waiting for approval.', 'Merci , en attente d''approbation .'),
(156, 'payWaitHeading', 'commontext', 'Waiting for approval', 'En attente d''approbation'),
(157, 'becvendortext', 'menus', 'Become a Vendor', 'Devenez un fournisseur'),
(158, 'boardtext', 'menus', 'User Board', 'User Board'),
(159, 'vendorboardtext', 'menus', 'Vendor Board', 'Conseil du vendeur'),
(160, 'vendorpopupcheck', 'userdashboard', 'I agree to all the Terms and Conditions to become a vendor', 'Je suis d''accord à tous les termes et conditions pour devenir un fournisseur'),
(161, 'vendorpopupcheckerror', 'userdashboard', 'Need to agree the Terms and Conditions', 'Need to agree the Terms and Conditions'),
(162, 'emailexists', 'message', 'Email is already taken. Please, try again.', 'Cet email est déjà pris. Veuillez réessayer.'),
(163, 'vendornametext', 'singleproductpage', 'Vendor Name', 'Vendor Name'),
(164, 'vendorinfotext', 'homepage', 'Vendor''s Info', 'Vendor''s Info'),
(165, 'membersincetext', 'homepage', 'Member Since', 'Member Since'),
(166, 'productsnumtext', 'homepage', 'Number of Products', 'Number of Products'),
(167, 'contactvendortext', 'homepage', 'Get in touch with Vendor', ''),
(168, 'logintocontacttext', 'homepage', 'Please Sign In to message Vendor', 'Please Sign In to message Vendor'),
(169, 'yourname', 'commontext', 'Your Name', 'votre nom'),
(170, 'youremail', 'commontext', 'Your Email', ''),
(171, 'yourmsgtext', 'commontext', 'Your Message', ''),
(172, 'listenbtn', 'homepage', 'Listen', 'Listen'),
(173, 'videobtn', 'homepage', 'Play', 'Play'),
(174, 'viewbtn', 'homepage', 'View', 'View'),
(175, 'hi', 'vendorboard', 'Hi', 'Salut'),
(176, 'wallettop', 'vendorboard', 'You wallet amount', 'Vous montant de portefeuille'),
(177, 'vendorboardmenu', 'vendorboard', 'Vendor Board', 'Conseil du vendeur'),
(178, 'walletmenu', 'vendorboard', 'Wallet Statement', 'Déclaration de portefeuille'),
(179, 'paymentreceivedmenu', 'vendorboard', 'Payment Received', 'Paiement reçu'),
(180, 'saleshistorymenu', 'vendorboard', 'Sales History', 'Historique des ventes'),
(181, 'manageproductsmenu', 'vendorboard', 'Manage Products', 'Gérer les produits'),
(182, 'addproductsmenu', 'vendorboard', 'Add Products', 'Ajouter les produits'),
(183, 'prodmenu', 'vendorboard', 'Products', 'Produits'),
(184, 'welcometext', 'vendorboard', 'Welcome Vendor , It''s All What We Have !!', 'Bienvenue vendeur, il est tout ce que nous avons !!'),
(185, 'filtertext', 'vendorboard', 'Filter the results using these options', 'Filtrer les résultats en utilisant ces options'),
(186, 'todaytext', 'vendorboard', 'Today', 'Aujourd''hui'),
(187, 'yesterdaytext', 'vendorboard', 'Yesterday', 'Hier'),
(188, 'customtext', 'vendorboard', 'Custom', 'Coutume'),
(189, 'totext', 'vendorboard', 'to', 'à'),
(190, 'filterw', 'vendorboard', 'Filter', 'Filtre'),
(191, 'activeprodtext', 'vendorboard', 'Active Products', 'Produits actifs'),
(192, 'freeprodtext', 'vendorboard', 'Free Products', 'Produits gratuits'),
(193, 'totprodviewstext', 'vendorboard', 'Total Product Views', 'Nombre de vues Produit'),
(194, 'totprodsalestext', 'vendorboard', 'Total Product Sales', 'Total des ventes de produits'),
(195, 'prodviewdevicetext', 'vendorboard', 'Product Views on Devices', 'Vues du produit sur les dispositifs'),
(196, 'prodviewbrowsertext', 'vendorboard', 'Product Views from Browsers', 'Vues du produit de Browsers'),
(197, 'addprodstep1text', 'vendorboard', 'Add Products ( Step 1 )', 'Ajouter les produits (étape 1)'),
(198, 'updateprodstep1text', 'vendorboard', 'Update Products ( Step 1 )', 'Mettez à jour les produits (étape 1)'),
(199, 'addprodnoticetext', 'vendorboard', 'User will not see any of the empty details. Fields are mandatory marked with', 'L''utilisateur ne verra pas les détails vides. Les champs sont obligatoires marqués avec'),
(200, 'aptypetext', 'vendorboard', 'Type', 'Type'),
(201, 'apaudiotext', 'vendorboard', 'Audio', 'Audio'),
(202, 'apvideotext', 'vendorboard', 'Video', 'Vidéo'),
(203, 'aptexttext', 'vendorboard', 'Text', 'Texte'),
(204, 'apothertext', 'vendorboard', 'Other', 'Autre'),
(205, 'apnametext', 'vendorboard', 'Product Name', 'Nom du produit'),
(206, 'apnamehelptext', 'vendorboard', 'Name , will be displayed to customers.', 'Nom, sera affiché aux clients.'),
(207, 'apurlnametext', 'vendorboard', 'URL Name', 'Nom URL'),
(208, 'apurlhelp1text', 'vendorboard', 'URL Name can have hyphen(-), space( ), numbers(0-9) but not other special characters.', 'URL Nom peut avoir trait d''union (-), l''espace (), des chiffres (0-9), mais pas d''autres caractères spéciaux.'),
(209, 'apurlhelp2text', 'vendorboard', ' This will be used for links and URLs.', 'Il sera utilisé pour les liens et les URL.'),
(210, 'prodcatetext', 'vendorboard', 'Product Category', 'Catégorie de produit'),
(211, 'choosetext', 'vendorboard', 'Choose one', 'Choisissez-en un'),
(212, 'prodsubcatetext', 'vendorboard', 'Product Sub Category', 'Sous-catégorie de Produit\r\n'),
(213, 'prevlinktext', 'vendorboard', 'Live preview link', 'lien Live preview'),
(214, 'tagstext', 'vendorboard', 'Tags', 'Mots clés'),
(216, 'taghelptext', 'vendorboard', 'Separate each tag by comma (,)', 'Séparez chaque tag par une virgule (,)'),
(217, 'desctext', 'vendorboard', 'Description', 'La description'),
(218, 'deschelptext', 'vendorboard', 'Paste HTML content here', 'Coller le contenu HTML ici'),
(219, 'proddownlinktext', 'vendorboard', 'Product download link', 'télécharger Lien'),
(220, 'proddownhelptext', 'vendorboard', 'Any server URL which customer will get redirected when tries to download the product', 'Toute URL du serveur quel client va se redirigée quand essaie de télécharger le produit'),
(221, 'pricetext', 'vendorboard', 'Price', 'Prix'),
(222, 'pricehelptext', 'vendorboard', 'Just the number', 'Juste le nombre'),
(223, 'planstext', 'vendorboard', 'Plans', 'Des plans'),
(224, 'planhelptext', 'vendorboard', 'This product will come under selected plan ', 'Ce produit sera sous régime choisi'),
(225, 'apfreetext', 'vendorboard', 'Make product FREE for all', 'Faire produit gratuit pour tous'),
(226, 'apfreehelp1text', 'vendorboard', 'It will overwrite all other Price or plan settings.', 'Il écrasera tous les autres prix ou plan paramètres.'),
(227, 'apfreehelp2text', 'vendorboard', 'User can access this product after registration only.', 'L''utilisateur peut accéder à ce produit après l''inscription seulement.'),
(228, 'apbtn1text', 'vendorboard', 'UPDATE  ( Step 1 )', 'MISE À JOUR (étape 1)'),
(229, 'apbtn2text', 'vendorboard', 'ADD  ( Step 1 )', 'ADD (étape 1)'),
(230, 'payreceitext', 'vendorboard', 'Payment Received Details', 'Paiement reçu Détails'),
(231, 'fbtext', 'authentication', 'Login with Facebook', 'Se connecter avec Facebook'),
(232, 'googletext', 'authentication', 'Login with Google+', 'Se connecter avec Google+'),
(233, 'aphead2text', 'vendorboard', 'Add Products ( Step 2 )', 'Ajouter les produits (étape 2)'),
(234, 'uploadtext', 'vendorboard', 'Upload Section', 'Upload Section'),
(235, 'selectfiletext', 'vendorboard', 'Select file to upload', 'Sélectionnez le fichier à télécharger'),
(236, 'previewimghelptext', 'vendorboard', 'Thumbnail Preview Image, extension .jpg / .jpeg', 'Thumbnail Image de prévisualisation, l''extension .jpg / .jpeg'),
(237, 'videodemohelptext', 'vendorboard', 'Demo MP4 file, extension .mp4', 'fichier MP4 Demo, l''extension .mp4'),
(238, 'audiodemohelptext', 'vendorboard', 'Demo MP3 file, extension .mp3', 'fichier MP3 Demo, l''extension .mp3'),
(239, 'textdemohelptext', 'vendorboard', 'Demo text file, extension .zip', 'fichier texte Demo, extension .zip'),
(240, 'otherdemohelptext', 'vendorboard', 'Gallery Images Zip, extension .zip', 'Galerie Images Zip, extension .zip'),
(241, 'finalprodhelptext', 'vendorboard', 'Final Product Zip, extension .zip', 'Finale Zip de produit, extension .zip'),
(296, 'upgrademessage', 'userdashboard', 'Upgrade your plan to access this product.', 'Améliorez votre plan pour accéder à ce produit.'),
(242, 'dropzonetext', 'vendorboard', 'Drop file here or Click to browse', 'Déposez le fichier ici Cliquez pour voir'),
(243, 'completebtn', 'vendorboard', 'Complete', 'Achevée'),
(244, 'cancelbtntext', 'vendorboard', 'Cancel', 'Annuler'),
(245, 'uploadcanceltext', 'vendorboard', 'Do you want to cancel this upload?', 'Voulez-vous annuler cette téléchargement?'),
(246, 'extensionerror', 'vendorboard', 'Please, check the file extension, it should match the above field.', 'S''il vous plaît, vérifiez l''extension de fichier, il doit correspondre au champ ci-dessus.'),
(247, 'uploadsuctext', 'vendorboard', 'File uploaded successfully.', 'Fichier envoyé avec succès'),
(248, 'uploaderrortext', 'vendorboard', 'Error in uploading file.', 'Erreur dans le fichier de téléchargement.'),
(301, 'coupemptyerr', 'message', 'Please enter valid coupon code', 'S''il vous plaît entrez le code de coupon valide'),
(298, 'coupontext', 'commontext', 'Coupon', 'Coupon'),
(299, 'applytext', 'commontext', 'Apply', 'Appliquer'),
(300, 'entercouptext', 'commontext', 'Enter Coupon Code', 'Entrez Code Promo'),
(252, 'uploadbytext', 'vendorboard', 'Uploaded By', 'Telechargé par'),
(253, 'downcounttext', 'vendorboard', 'Download Count', 'Télécharger Count'),
(254, 'ststext', 'vendorboard', 'Status', 'Statut'),
(255, 'creatdatetext', 'vendorboard', 'Created Date', 'date de création'),
(256, 'lastupdatetext', 'vendorboard', 'Last Update', 'Dernière mise à jour'),
(257, 'upcomptext', 'vendorboard', 'Complete', 'Achevée'),
(258, 'actiontext', 'vendorboard', 'Action', 'Action'),
(259, 'yestext', 'vendorboard', 'Yes', 'Oui'),
(260, 'notext', 'vendorboard', 'No', 'Non'),
(261, 'activetext', 'vendorboard', 'Active', 'Actif'),
(262, 'inactivetext', 'vendorboard', 'In Active', 'Inactif'),
(263, 'allpagetext', 'vendorboard', 'All Pages', 'Toutes les pages'),
(264, 'livedemotext', 'vendorboard', 'Live Demo', 'Live Demo'),
(265, 'uniqdevitext', 'vendorboard', 'Unique Devices', 'Dispositifs uniques'),
(266, 'uniqbrowtext', 'vendorboard', 'Unique Browsers', 'Unique Browsers'),
(267, 'uniqiptext', 'vendorboard', 'Unique IPs', 'IP uniques'),
(268, 'totviewstext', 'vendorboard', 'Total Views', 'Vues totales'),
(269, 'indepenfiltertext', 'vendorboard', 'Independent from filter', 'Indépendamment du filtre'),
(270, 'gotext', 'vendorboard', 'go', 'aller'),
(271, 'statementtext', 'vendorboard', 'Statements', 'Déclarations'),
(272, 'totearningtext', 'vendorboard', 'Total Earnings ', 'Total des gains'),
(273, 'purchasedatetext', 'userdashboard', 'Purchase Date', 'date d''achat'),
(274, 'salecosttext', 'vendorboard', 'Sale Cost', 'Vente Coût'),
(275, 'vendorcommistext', 'vendorboard', 'Vendor Commission', 'Commission du vendeur'),
(276, 'amntreceivtext', 'vendorboard', 'Amount Received', 'Montant reçu'),
(277, 'amntpendingtext', 'vendorboard', 'Amount Pending', 'Montant en attente'),
(278, 'notestext', 'vendorboard', 'Notes', 'Remarques'),
(279, 'withdrawalinfotext', 'vendorboard', 'To get your share of sales, please enter the details', 'Pour obtenir votre part des ventes, s''il vous plaît entrer les détails'),
(280, 'blncamnttext', 'vendorboard', 'Balance amount', 'Montant du solde'),
(281, 'costtext', 'vendorboard', 'Cost', 'Coût'),
(282, 'urlnameerror', 'vendorboard', 'URL Name should not contain special characters.', 'URL Nom ne doit pas contenir de caractères spéciaux.'),
(283, 'starfielderror', 'vendorboard', 'Star (*) mark fields are mandatory.', 'Star (*) champs de marque sont obligatoires.'),
(284, 'prodnameerror', 'vendorboard', 'Name should not be more than 80 characters.', 'Nom ne devrait pas être plus de 80 caractères.'),
(285, 'urllengtherror', 'vendorboard', 'URL Name should not be more than 80 characters.', 'URL Nom ne devrait pas être plus de 80 caractères.'),
(286, 'freetexterror', 'vendorboard', 'Please mention the price or check it as FREE', 'S''il vous plaît mentionner le prix ou vérifier que GRATUIT'),
(287, 'freetext2error', 'vendorboard', 'Please select a plan or check it as FREE.', 'S''il vous plaît sélectionner un plan ou vérifier que FREE.'),
(288, 'inputvalueserror', 'vendorboard', 'Input values are not valid.', 'Les valeurs d''entrée ne sont pas valides.'),
(289, 'validlinkerror', 'vendorboard', 'Please, use valid links.', 'S''il vous plaît, utilisez des liens valides.'),
(290, 'pricenumberrror', 'vendorboard', 'Price should be numeric only.', 'Prix ​​devrait être numérique seulement.'),
(291, 'checksubcatetext', 'vendorboard', 'Check sub category now.', 'Vérifiez la sous catégorie maintenant.'),
(292, 'checksubcateerror', 'vendorboard', 'Something went wrong.', 'Quelque-chose s''est mal passé.'),
(293, 'checkcateerror', 'vendorboard', 'Please, select a Category first.', 'S''il vous plaît, sélectionner une catégorie en premier.'),
(297, 'missingzipmessage', 'userdashboard', 'Sorry, we can not find this product.', 'Désolé, nous ne pouvons pas trouver ce produit.'),
(302, 'coupincorrecterr', 'message', 'Coupon Code is wrong.', 'Code promo est erroné.'),
(303, 'coupexpirederr', 'message', 'Coupon Code expired.', 'Code Promo expiré.'),
(304, 'coupsuccess', 'message', 'Coupon code applied successfully.', 'Code promo appliqué avec succès.'),
(305, 'carttotaltext', 'commontext', 'Cart Total', 'Panier total'),
(306, 'coupdiscounttext', 'commontext', 'coupon discounts', 'remises de coupons'),
(308, 'finalamounttext', 'commontext', 'Final Amount', 'Montant final'),
(309, 'appliedtext', 'commontext', 'Applied', 'Appliqué'),
(310, 'coupremoved', 'message', 'Coupon code removed.', 'Code promo enlevé.'),
(311, 'proddownpasswordtext', 'vendorboard', 'Password to access products via External Link', 'Mot de passe pour accéder aux produits via External Link'),
(312, 'proddownpasswordhelptext', 'vendorboard', 'This password will be shown only after the purchase of product, in download area', 'Ce mot de passe ne sera affiché qu''après l''achat du produit, dans la zone de téléchargement'),
(313, 'preverrortext', 'vendorboard', 'It only works for Thumbnail Preview Image.', 'Il ne fonctionne que pour Thumbnail Preview Image.'),
(314, 'importsuctext', 'vendorboard', 'Image imported successfully.', 'Image importée avec succès.'),
(315, 'importfailedtext', 'vendorboard', 'We are unable to import the image.', 'Impossible d''importer l''image.'),
(316, 'imgtypeerrortext', 'vendorboard', 'This is not a valid image type.', 'Ce type d''image n''est pas valide.'),
(317, 'ortext', 'vendorboard', 'OR', 'OU'),
(318, 'pasteimgtext', 'vendorboard', 'Paste URL of Thumbnail Preview Image', 'Coller l''URL de l''aperçu'),
(319, 'useimgtext', 'vendorboard', 'Use This', 'Utilisez ceci');

-- --------------------------------------------------------

--
-- Table structure for table `ts_levels`
--

CREATE TABLE IF NOT EXISTS `ts_levels` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_levels`
--

INSERT INTO `ts_levels` (`level_id`, `level_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `ts_pages`
--

CREATE TABLE IF NOT EXISTS `ts_pages` (
  `page_id` int(11) NOT NULL,
  `page_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `page_heading` text COLLATE utf8_unicode_ci NOT NULL,
  `page_content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_pages`
--

INSERT INTO `ts_pages` (`page_id`, `page_type`, `page_heading`, `page_content`) VALUES
(1, 'aboutus', 'About ThemePortal !!', '<p><img alt="About Us" src="http://images.freeimages.com/images/previews/e11/the-fisherman-1393907.jpg" style="height:440px; width:586px" /></p>\n\n<p>&nbsp;</p>\n\n<p>About ThemePortal is something which I can tell is the best marketplace framework online.</p>\n\n<p>gdfgsdfgdfgafdsgasdfgafdsg</p>\n'),
(2, 'privacypolicy', 'Privacy Policies', '<ul>\n	<li>This is first privacy policy</li>\n	<li>This is second privacy policy</li>\n	<li>This is third privacy policy</li>\n	<li>This is fourth privacy policy</li>\n	<li>This is fifth privacy policy</li>\n	<li>youy yyty</li>\n</ul>\n'),
(3, 'termsconditions', 'Terms and Conditions', '<ul>\n	<li>This is first Terms and Conditions</li>\n	<li>This is second Terms and Conditions</li>\n	<li>This is third Terms and Conditions</li>\n	<li>This is fourth Terms and Conditions</li>\n	<li>This is fifth Terms and Conditions</li>\n	<li>yyerher kjerhkwer dfsdf</li>\n</ul>\n');

-- --------------------------------------------------------

--
-- Table structure for table `ts_paymentdetails`
--

CREATE TABLE IF NOT EXISTS `ts_paymentdetails` (
  `payment_id` int(11) NOT NULL,
  `payment_uid` int(11) NOT NULL,
  `payment_pid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_uniqid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `payment_mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_amount` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_note` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_admin_commission` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_vendor_commission` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_discount` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_total` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_plans`
--

CREATE TABLE IF NOT EXISTS `ts_plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `plan_amount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plan_product` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `plan_features` text COLLATE utf8_unicode_ci NOT NULL,
  `plan_status` int(11) NOT NULL DEFAULT '1',
  `plan_duration` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `plan_coupon` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_plans`
--

INSERT INTO `ts_plans` (`plan_id`, `plan_name`, `plan_amount`, `plan_product`, `plan_features`, `plan_status`, `plan_duration`, `plan_coupon`) VALUES
(1, 'Basic', '70', '1', '3 theme access\nfull support 24 X 7\nfree customisation\none time fees', 1, '1 Weeks', 'MON15'),
(2, 'Popular', '150', '10', '3 theme access\nfull support 24 X 7\nfree customisation\none time fees', 1, '3 Years', 'DIYA30'),
(3, 'Premium', '300', 'All', '3 theme access\nfull support 24 X 7\nfree customisation\none time fees', 1, 'Life Time ', ''),
(8, 'pop', '89', '', 'uoyuio\nrudbd', 1, 'Life Time ', 'MON15');

-- --------------------------------------------------------

--
-- Table structure for table `ts_prodgallery`
--

CREATE TABLE IF NOT EXISTS `ts_prodgallery` (
  `prodgallery_id` int(11) NOT NULL,
  `prodgallery_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prodgallery_pid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_products`
--

CREATE TABLE IF NOT EXISTS `ts_products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_urlname` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_tags` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `prod_demourl` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_demoshow` tinyint(4) NOT NULL DEFAULT '1',
  `prod_cateid` int(11) NOT NULL,
  `prod_subcateid` int(11) NOT NULL,
  `prod_filename` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prod_downloadpassword` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `prod_price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_plan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_free` tinyint(4) NOT NULL,
  `prod_featured` tinyint(4) NOT NULL,
  `prod_status` tinyint(4) DEFAULT '1',
  `prod_uniqid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_date` timestamp NULL DEFAULT NULL,
  `prod_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prod_download_count` bigint(20) NOT NULL DEFAULT '0',
  `prod_gallery` tinyint(4) NOT NULL,
  `prod_uid` int(11) NOT NULL,
  `prod_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_coupon` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_product_analysis`
--

CREATE TABLE IF NOT EXISTS `ts_product_analysis` (
  `prod_analysis_id` int(11) NOT NULL,
  `prod_analysis_prodid` int(11) NOT NULL,
  `prod_analysis_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_browser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_device` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_ipaddr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_views` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_pagetype` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_purchaserecord`
--

CREATE TABLE IF NOT EXISTS `ts_purchaserecord` (
  `purrec_id` int(11) NOT NULL,
  `purrec_prodid` int(11) NOT NULL,
  `purrec_uid` int(11) NOT NULL,
  `purrec_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `purrec_purcode` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_settings`
--

CREATE TABLE IF NOT EXISTS `ts_settings` (
  `uniq_id` int(11) NOT NULL,
  `key_text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `value_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_settings`
--

INSERT INTO `ts_settings` (`uniq_id`, `key_text`, `value_text`) VALUES
(1, 'languageoption_text', 'english,french'),
(2, 'weblanguage_text', 'english'),
(3, 'languagesection_text', 'title,message,homepage,singleproductpage,commontext,menus,authentication,userdashboard,vendorboard'),
(4, 'metatags_text', 'themeportal , shop'),
(5, 'sitetitle_text', 'ThemePortal - Single Product Marketplace'),
(6, 'sitename_text', 'ThemePortal - Kamleshyadav''s Product'),
(7, 'seodescr_text', 'Themeportal is the single product marketplace, where user can find all products.'),
(8, 'siteauthor_text', 'Kamleshyadav'),
(9, 'logo_url', 'http://kamleshyadav.com/scripts/themeportal/webimage/logo.png'),
(10, 'favicon_url', 'http://kamleshyadav.com/scripts/themeportal/webimage/favicon.ico'),
(11, 'preloader_url', 'http://kamleshyadav.com/scripts/themeportal/webimage/preloader.gif'),
(12, 'siteemail_text', 'info@themeportal.com'),
(13, 'sitephone_text', '+00000000'),
(14, 'siteaddress_text', 'Virtual Office'),
(15, 'siteemail_checkbox', '1'),
(16, 'sitephone_checkbox', '1'),
(17, 'siteaddress_checkbox', '1'),
(18, 'googlelink_url', 'https://google.com'),
(19, 'googlelink_checkbox', '1'),
(20, 'twitterlink_url', 'https://twitter.com'),
(21, 'twitterlink_checkbox', '1'),
(22, 'fblink_url', 'https://facebook.com'),
(23, 'fblink_checkbox', '1'),
(24, 'copyright_text', 'All rights reserved'),
(25, 'copyright_checkbox', '1'),
(26, 'portal_curreny', 'USD'),
(27, 'portalcurreny_symbol', '$'),
(28, 'portal_revenuemodel', 'singlecost'),
(50, 'shownewsletter_checkbox', '1'),
(30, 'newsletter_subs', '0'),
(31, 'registeredemails_subs', '0'),
(32, 'contactemails_subs', '1'),
(39, 'forgotpwdemail_linktext', 'Reset Password'),
(34, 'registrationemail_text', 'Hi [username],[break][break]\nPlease, click on the link below to activate your account. [break]\n[linktext] \n[break]\n[break]\nThanks,[break][break]\nTeam ThemePortal.'),
(35, 'email_logoshow', '1'),
(36, 'email_fromname', 'help'),
(37, 'email_fromemail', 'help@themeportal.com'),
(38, 'forgotpwdemail_text', 'Hi [username],[break][break]\nPlease, click on the link below to reset your password. [break]\n[linktext] \n[break]\n[break]\nThanks,[break][break]\nTeam ThemePortal.'),
(40, 'registrationemail_linktext', 'Click here'),
(41, 'paypal_status', '1'),
(42, 'paypal_email', 'reply@himanshusofttech.com'),
(43, 'payu_status', '1'),
(44, 'payu_merchantKey', '86Dss3U0'),
(45, 'payu_merchantSalt', 'f7R9DdadZU'),
(46, 'dontshow_emptycate', '1'),
(47, 'email_contactemail', 'support@himanshusofttech.com'),
(48, 'email_replyemail', 'reply@themeportal.com'),
(49, 'email_replytoshow', '1'),
(51, 'sitecolor_code', 'FBC02D'),
(52, 'menuHome_checkbox', '1'),
(53, 'menuAboutUs_checkbox', '1'),
(54, 'menuProducts_checkbox', '1'),
(55, 'menuContactUs_checkbox', '1'),
(56, 'menuSupport_checkbox', '1'),
(57, 'menuTnC_checkbox', '1'),
(58, 'menuPrivacy_checkbox', '1'),
(59, 'sitehighcolor_code', 'DCAD39'),
(60, 'menuPricingtbl_checkbox', '1'),
(65, 'showfeaturedsales_checkbox', '1'),
(66, 'stripe_status', '1'),
(67, 'stripe_secretKey', 'sk_test_3Y0wT5FRpR9UoOmCx9i9RrfO'),
(68, 'stripe_publishableKey', 'pk_test_7GPMYgsWynTIXpdOA84YiMXN'),
(69, '2checkout_status', '1'),
(70, '2checkout_acntnumber', '12345612'),
(71, 'banktransfer_status', '1'),
(72, 'banktransfer_details', 'Bank Name : Dummy Bank\nAccount Number : 1234567890'),
(73, 'marketplace_typevendor', 'multi'),
(74, 'vendor_revenuemodel', 'commission'),
(76, 'vendor_tncstatus', '1'),
(75, 'vendor_commission', '50'),
(77, 'vendor_tnctext', 'Terms and Conditions to be a Vendor\n\n1. You have to sell the product only on ThemePortal.\n2. You have to sell the product only on ThemePortal.\n3. You have to sell the product only on ThemePortal.\n4. You have to sell the product only on ThemePortal'),
(78, 'bitcoin_status', '1'),
(79, 'bitcoin_publickey', '6024AAy7RWDBitcoin77BTCPUBK2xlaGwA1Km61dIPOOI8a3nM'),
(80, 'bitcoin_privatekey', '6024AAy7RWDBitcoin77BTCPRV6i8F2x9lB0h0t5UUQvSOLj3W'),
(81, 'webmoney_purse', 'a'),
(82, 'webmoney_status', '1'),
(83, 'yandex_wallet', '410014575949416'),
(84, 'yandex_status', '1'),
(85, 'headers_all', 'Classic,Retro,Modern'),
(86, 'headers_active', 'Retro'),
(87, 'tpay_status', '1'),
(88, 'tpay_merchantid', '4341'),
(92, 'facebook_appid', '615526785293430'),
(93, 'facebook_appsecret', '0b055fc8c39fa30ca3aa37fc87bc6a42'),
(94, 'google_status', '1'),
(95, 'google_clientid', '946984907653-l63fqmtefm2vp7pigghno9067m0ka2hi.apps.googleusercontent.com'),
(96, 'google_clientsecret', 'kYNPjrJ9BiJhY2AjjpFzDJRW'),
(91, 'facebook_status', '1'),
(97, 'pagseguro_status', '1'),
(98, 'pagseguro_email', 'dga.teles@uol.com.br'),
(99, 'pagseguro_token', 'E16D1D0F0A294643A11A906EFA8556B5'),
(161, '2016-09-22 06:20:31', '[]'),
(162, 'permoney_status', '1'),
(163, 'permoney_account', 'U8916440'),
(164, 'fail 2016-09-23 18:28:44', '{"PAYEE_ACCOUNT":"U8916440","PAYMENT_AMOUNT":"1","PAYMENT_UNITS":"USD","PAYMENT_ID":"lY152zTp","SUGGESTED_MEMO":"","PAYMENT_BATCH_NUM":"0"}'),
(165, 'paypal_adaptive', '1'),
(166, 'languageswitch_checkbox', '1'),
(173, 'featuredcolor_code', 'F41414'),
(168, 'addnewuseremail_text', 'Hi [username],[break][break]\nCongratulation. We have your account. [break]\nHere are your login details [break]\nUsername : [username] [break]\nPassword : [password] [break]\nWebsite link : [website_link] [break]\n[break]\n[break]\nThanks,[break][break]\nTeam ThemePortal.'),
(169, 'loginhome_checkbox', '1'),
(170, 'registerhome_checkbox', '1'),
(171, 'fbcartlogin_checkbox', '1'),
(172, 'googlecartlogin_checkbox', '1'),
(174, 'backgroundimg_url', 'http://kamleshyadav.com/scripts/themeportal/themes/default/images/backgroundimg.jpg'),
(175, 'accountaccessimg_url', 'http://kamleshyadav.com/scripts/themeportal/themes/default/images/web/accountaccessimg.jpg'),
(176, 'notfoundimg_url', 'http://kamleshyadav.com/scripts/themeportal/themes/default/images/web/notfoundimg.png'),
(177, 'successimg_url', 'http://kamleshyadav.com/scripts/themeportal/themes/default/images/web/successimg.jpg'),
(178, 'oopsimg_url', 'http://kamleshyadav.com/scripts/themeportal/themes/default/images/web/oopsimg.jpg'),
(179, 'homepageoverlayshow_checkbox', '0'),
(180, 'homepageoverlay_color', '000000'),
(181, 'homepageoverlay_opacity', '0.8');

-- --------------------------------------------------------

--
-- Table structure for table `ts_status`
--

CREATE TABLE IF NOT EXISTS `ts_status` (
  `status_id` int(11) NOT NULL,
  `status_text` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_status`
--

INSERT INTO `ts_status` (`status_id`, `status_text`) VALUES
(1, 'Active'),
(2, 'In Active'),
(3, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `ts_subcategories`
--

CREATE TABLE IF NOT EXISTS `ts_subcategories` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `sub_urlname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `sub_parent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_testimonial`
--

CREATE TABLE IF NOT EXISTS `ts_testimonial` (
  `testi_id` int(11) NOT NULL,
  `testi_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `testi_desig` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `testi_msg` text COLLATE utf8_unicode_ci NOT NULL,
  `testi_showdesig` tinyint(4) NOT NULL,
  `testi_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `testi_status` tinyint(4) NOT NULL DEFAULT '1',
  `testi_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_themes`
--

CREATE TABLE IF NOT EXISTS `ts_themes` (
  `theme_id` int(11) NOT NULL,
  `theme_displayname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `theme_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `theme_status` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_themes`
--

INSERT INTO `ts_themes` (`theme_id`, `theme_displayname`, `theme_name`, `theme_status`) VALUES
(1, 'Default', 'default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ts_user`
--

CREATE TABLE IF NOT EXISTS `ts_user` (
  `user_id` int(11) NOT NULL,
  `user_uname` varchar(250) NOT NULL,
  `user_fname` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_lname` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_pwd` text NOT NULL,
  `user_mobile` varchar(250) NOT NULL,
  `user_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_country` int(11) NOT NULL,
  `user_state` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_city` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_zip` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` int(11) NOT NULL,
  `user_key` varchar(250) NOT NULL,
  `user_accesslevel` int(11) NOT NULL,
  `user_plans` int(11) NOT NULL,
  `user_plansdate` varchar(250) NOT NULL,
  `user_paypalemail` varchar(500) NOT NULL,
  `user_vplans` int(11) NOT NULL,
  `user_vplansdate` varchar(250) NOT NULL,
  `user_social` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ts_vendorplans`
--

CREATE TABLE IF NOT EXISTS `ts_vendorplans` (
  `vplan_id` int(11) NOT NULL,
  `vplan_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vplan_amount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vplan_features` text COLLATE utf8_unicode_ci NOT NULL,
  `vplan_status` int(11) NOT NULL DEFAULT '1',
  `vplan_duration` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vplan_coupon` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_vendorplans`
--

INSERT INTO `ts_vendorplans` (`vplan_id`, `vplan_name`, `vplan_amount`, `vplan_features`, `vplan_status`, `vplan_duration`, `vplan_coupon`) VALUES
(1, 'Bronze', '50', '70% Commision\nTech Support', 1, '1 Days', 'MON15'),
(2, 'Silver', '150', '70% Commision\nTech Support\nQuick Fund Transfer', 1, '3 Years', 'DIYA30'),
(3, 'Gold', '500', '70% Commision\nTech Support\nQuick Fund Transfer\nDedicated Server', 1, 'Life Time ', 'DIYA30'),
(4, 'VVVE', '1212', 'fl;kgjkjk  jkwhgwergwertg\ndfjkdgydghdklgjdfg', 1, 'Life Time ', 'DIYA30');

-- --------------------------------------------------------

--
-- Table structure for table `ts_vendorwithdrawal`
--

CREATE TABLE IF NOT EXISTS `ts_vendorwithdrawal` (
  `venwith_id` int(11) NOT NULL,
  `venwith_uid` int(11) NOT NULL,
  `venwith_type` text COLLATE utf8_unicode_ci NOT NULL,
  `venwith_text` text COLLATE utf8_unicode_ci NOT NULL,
  `venwith_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `venwith_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_wallet`
--

CREATE TABLE IF NOT EXISTS `ts_wallet` (
  `wallet_id` int(11) NOT NULL,
  `wallet_uid` int(11) NOT NULL,
  `wallet_amount` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_categories`
--
ALTER TABLE `ts_categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `ts_country`
--
ALTER TABLE `ts_country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `ts_coupons`
--
ALTER TABLE `ts_coupons`
  ADD PRIMARY KEY (`coup_id`);

--
-- Indexes for table `ts_downloadtbl`
--
ALTER TABLE `ts_downloadtbl`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `ts_emaillist`
--
ALTER TABLE `ts_emaillist`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `ts_emailproviders`
--
ALTER TABLE `ts_emailproviders`
  ADD PRIMARY KEY (`ep_id`);

--
-- Indexes for table `ts_eplist`
--
ALTER TABLE `ts_eplist`
  ADD PRIMARY KEY (`eplist_id`);

--
-- Indexes for table `ts_lancate`
--
ALTER TABLE `ts_lancate`
  ADD PRIMARY KEY (`lancate_id`);

--
-- Indexes for table `ts_language`
--
ALTER TABLE `ts_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `ts_levels`
--
ALTER TABLE `ts_levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `ts_pages`
--
ALTER TABLE `ts_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `ts_paymentdetails`
--
ALTER TABLE `ts_paymentdetails`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `ts_plans`
--
ALTER TABLE `ts_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `ts_prodgallery`
--
ALTER TABLE `ts_prodgallery`
  ADD PRIMARY KEY (`prodgallery_id`);

--
-- Indexes for table `ts_products`
--
ALTER TABLE `ts_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `ts_product_analysis`
--
ALTER TABLE `ts_product_analysis`
  ADD PRIMARY KEY (`prod_analysis_id`);

--
-- Indexes for table `ts_purchaserecord`
--
ALTER TABLE `ts_purchaserecord`
  ADD PRIMARY KEY (`purrec_id`);

--
-- Indexes for table `ts_settings`
--
ALTER TABLE `ts_settings`
  ADD PRIMARY KEY (`uniq_id`), ADD UNIQUE KEY `key_text` (`key_text`);

--
-- Indexes for table `ts_status`
--
ALTER TABLE `ts_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ts_subcategories`
--
ALTER TABLE `ts_subcategories`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `ts_testimonial`
--
ALTER TABLE `ts_testimonial`
  ADD PRIMARY KEY (`testi_id`);

--
-- Indexes for table `ts_themes`
--
ALTER TABLE `ts_themes`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `ts_user`
--
ALTER TABLE `ts_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ts_vendorplans`
--
ALTER TABLE `ts_vendorplans`
  ADD PRIMARY KEY (`vplan_id`);

--
-- Indexes for table `ts_vendorwithdrawal`
--
ALTER TABLE `ts_vendorwithdrawal`
  ADD PRIMARY KEY (`venwith_id`);

--
-- Indexes for table `ts_wallet`
--
ALTER TABLE `ts_wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_categories`
--
ALTER TABLE `ts_categories`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_country`
--
ALTER TABLE `ts_country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `ts_coupons`
--
ALTER TABLE `ts_coupons`
  MODIFY `coup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_downloadtbl`
--
ALTER TABLE `ts_downloadtbl`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_emaillist`
--
ALTER TABLE `ts_emaillist`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_emailproviders`
--
ALTER TABLE `ts_emailproviders`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_eplist`
--
ALTER TABLE `ts_eplist`
  MODIFY `eplist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_lancate`
--
ALTER TABLE `ts_lancate`
  MODIFY `lancate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_language`
--
ALTER TABLE `ts_language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=320;
--
-- AUTO_INCREMENT for table `ts_levels`
--
ALTER TABLE `ts_levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ts_pages`
--
ALTER TABLE `ts_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ts_paymentdetails`
--
ALTER TABLE `ts_paymentdetails`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_plans`
--
ALTER TABLE `ts_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ts_prodgallery`
--
ALTER TABLE `ts_prodgallery`
  MODIFY `prodgallery_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_products`
--
ALTER TABLE `ts_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_product_analysis`
--
ALTER TABLE `ts_product_analysis`
  MODIFY `prod_analysis_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_purchaserecord`
--
ALTER TABLE `ts_purchaserecord`
  MODIFY `purrec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_settings`
--
ALTER TABLE `ts_settings`
  MODIFY `uniq_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `ts_status`
--
ALTER TABLE `ts_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ts_subcategories`
--
ALTER TABLE `ts_subcategories`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_testimonial`
--
ALTER TABLE `ts_testimonial`
  MODIFY `testi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_themes`
--
ALTER TABLE `ts_themes`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ts_user`
--
ALTER TABLE `ts_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_vendorplans`
--
ALTER TABLE `ts_vendorplans`
  MODIFY `vplan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_vendorwithdrawal`
--
ALTER TABLE `ts_vendorwithdrawal`
  MODIFY `venwith_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_wallet`
--
ALTER TABLE `ts_wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT;