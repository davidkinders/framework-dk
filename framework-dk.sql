-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2015 at 03:39 PM
-- Server version: 5.5.44
-- PHP Version: 5.6.10-1~dotdeb+7.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `framework-dk`
--

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

CREATE TABLE IF NOT EXISTS `icons` (
  `name` varchar(32) NOT NULL,
  `family` varchar(32) NOT NULL DEFAULT 'fa ',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `icons`
--

INSERT INTO `icons` (`name`, `family`) VALUES
('fa-adjust', 'fa '),
('fa-adn', 'fa '),
('fa-align-center', 'fa '),
('fa-align-justify', 'fa '),
('fa-align-left', 'fa '),
('fa-align-right', 'fa '),
('fa-ambulance', 'fa '),
('fa-anchor', 'fa '),
('fa-android', 'fa '),
('fa-angellist', 'fa '),
('fa-angle-double-down', 'fa '),
('fa-angle-double-left', 'fa '),
('fa-angle-double-right', 'fa '),
('fa-angle-double-up', 'fa '),
('fa-angle-down', 'fa '),
('fa-angle-left', 'fa '),
('fa-angle-right', 'fa '),
('fa-angle-up', 'fa '),
('fa-apple', 'fa '),
('fa-archive', 'fa '),
('fa-area-chart', 'fa '),
('fa-arrow-circle-down', 'fa '),
('fa-arrow-circle-left', 'fa '),
('fa-arrow-circle-o-down', 'fa '),
('fa-arrow-circle-o-left', 'fa '),
('fa-arrow-circle-o-right', 'fa '),
('fa-arrow-circle-o-up', 'fa '),
('fa-arrow-circle-right', 'fa '),
('fa-arrow-circle-up', 'fa '),
('fa-arrow-down', 'fa '),
('fa-arrow-left', 'fa '),
('fa-arrow-right', 'fa '),
('fa-arrow-up', 'fa '),
('fa-arrows', 'fa '),
('fa-arrows-alt', 'fa '),
('fa-arrows-h', 'fa '),
('fa-arrows-v', 'fa '),
('fa-asterisk', 'fa '),
('fa-at', 'fa '),
('fa-automobile', 'fa '),
('fa-backward', 'fa '),
('fa-ban', 'fa '),
('fa-bank', 'fa '),
('fa-bar-chart', 'fa '),
('fa-bar-chart-o', 'fa '),
('fa-barcode', 'fa '),
('fa-bars', 'fa '),
('fa-bed', 'fa '),
('fa-beer', 'fa '),
('fa-behance', 'fa '),
('fa-behance-square', 'fa '),
('fa-bell', 'fa '),
('fa-bell-o', 'fa '),
('fa-bell-slash', 'fa '),
('fa-bell-slash-o', 'fa '),
('fa-bicycle', 'fa '),
('fa-binoculars', 'fa '),
('fa-birthday-cake', 'fa '),
('fa-bitbucket', 'fa '),
('fa-bitbucket-square', 'fa '),
('fa-bitcoin', 'fa '),
('fa-bold', 'fa '),
('fa-bolt', 'fa '),
('fa-bomb', 'fa '),
('fa-book', 'fa '),
('fa-bookmark', 'fa '),
('fa-bookmark-o', 'fa '),
('fa-briefcase', 'fa '),
('fa-btc', 'fa '),
('fa-bug', 'fa '),
('fa-building', 'fa '),
('fa-building-o', 'fa '),
('fa-bullhorn', 'fa '),
('fa-bullseye', 'fa '),
('fa-bus', 'fa '),
('fa-buysellads', 'fa '),
('fa-cab', 'fa '),
('fa-calculator', 'fa '),
('fa-calendar', 'fa '),
('fa-calendar-o', 'fa '),
('fa-camera', 'fa '),
('fa-camera-retro', 'fa '),
('fa-car', 'fa '),
('fa-caret-down', 'fa '),
('fa-caret-left', 'fa '),
('fa-caret-right', 'fa '),
('fa-caret-square-o-down', 'fa '),
('fa-caret-square-o-left', 'fa '),
('fa-caret-square-o-right', 'fa '),
('fa-caret-square-o-up', 'fa '),
('fa-caret-up', 'fa '),
('fa-cart-arrow-down', 'fa '),
('fa-cart-plus', 'fa '),
('fa-cc', 'fa '),
('fa-cc-amex', 'fa '),
('fa-cc-discover', 'fa '),
('fa-cc-mastercard', 'fa '),
('fa-cc-paypal', 'fa '),
('fa-cc-stripe', 'fa '),
('fa-cc-visa', 'fa '),
('fa-certificate', 'fa '),
('fa-chain-broken', 'fa '),
('fa-check', 'fa '),
('fa-check-circle', 'fa '),
('fa-check-circle-o', 'fa '),
('fa-check-square', 'fa '),
('fa-check-square-o', 'fa '),
('fa-chevron-circle-down', 'fa '),
('fa-chevron-circle-left', 'fa '),
('fa-chevron-circle-right', 'fa '),
('fa-chevron-circle-up', 'fa '),
('fa-chevron-down', 'fa '),
('fa-chevron-left', 'fa '),
('fa-chevron-right', 'fa '),
('fa-chevron-up', 'fa '),
('fa-child', 'fa '),
('fa-circle', 'fa '),
('fa-circle-o', 'fa '),
('fa-circle-o-notch', 'fa '),
('fa-circle-thin', 'fa '),
('fa-clipboard', 'fa '),
('fa-clock-o', 'fa '),
('fa-close', 'fa '),
('fa-cloud', 'fa '),
('fa-cloud-download', 'fa '),
('fa-cloud-upload', 'fa '),
('fa-cny', 'fa '),
('fa-code', 'fa '),
('fa-code-fork', 'fa '),
('fa-codepen', 'fa '),
('fa-coffee', 'fa '),
('fa-cog', 'fa '),
('fa-cogs', 'fa '),
('fa-columns', 'fa '),
('fa-comment', 'fa '),
('fa-comment-o', 'fa '),
('fa-comments', 'fa '),
('fa-comments-o', 'fa '),
('fa-compass', 'fa '),
('fa-compress', 'fa '),
('fa-connectdevelop', 'fa '),
('fa-copyright', 'fa '),
('fa-credit-card', 'fa '),
('fa-crop', 'fa '),
('fa-crosshairs', 'fa '),
('fa-css3', 'fa '),
('fa-cube', 'fa '),
('fa-cubes', 'fa '),
('fa-cutlery', 'fa '),
('fa-dashboard', 'fa '),
('fa-dashcube', 'fa '),
('fa-database', 'fa '),
('fa-dedent', 'fa '),
('fa-delicious', 'fa '),
('fa-desktop', 'fa '),
('fa-deviantart', 'fa '),
('fa-diamond', 'fa '),
('fa-digg', 'fa '),
('fa-dollar', 'fa '),
('fa-dot-circle-o', 'fa '),
('fa-download', 'fa '),
('fa-dribbble', 'fa '),
('fa-dropbox', 'fa '),
('fa-drupal', 'fa '),
('fa-edit', 'fa '),
('fa-eject', 'fa '),
('fa-ellipsis-h', 'fa '),
('fa-ellipsis-v', 'fa '),
('fa-empire', 'fa '),
('fa-envelope', 'fa '),
('fa-envelope-o', 'fa '),
('fa-envelope-square', 'fa '),
('fa-eraser', 'fa '),
('fa-eur', 'fa '),
('fa-euro', 'fa '),
('fa-exchange', 'fa '),
('fa-exclamation', 'fa '),
('fa-exclamation-circle', 'fa '),
('fa-exclamation-triangle', 'fa '),
('fa-expand', 'fa '),
('fa-external-link', 'fa '),
('fa-external-link-square', 'fa '),
('fa-eye', 'fa '),
('fa-eye-slash', 'fa '),
('fa-eyedropper', 'fa '),
('fa-facebook', 'fa '),
('fa-facebook-f', 'fa '),
('fa-facebook-official', 'fa '),
('fa-facebook-square', 'fa '),
('fa-fast-backward', 'fa '),
('fa-fast-forward', 'fa '),
('fa-fax', 'fa '),
('fa-female', 'fa '),
('fa-fighter-jet', 'fa '),
('fa-file', 'fa '),
('fa-file-archive-o', 'fa '),
('fa-file-audio-o', 'fa '),
('fa-file-code-o', 'fa '),
('fa-file-excel-o', 'fa '),
('fa-file-image-o', 'fa '),
('fa-file-movie-o', 'fa '),
('fa-file-o', 'fa '),
('fa-file-pdf-o', 'fa '),
('fa-file-photo-o', 'fa '),
('fa-file-picture-o', 'fa '),
('fa-file-powerpoint-o', 'fa '),
('fa-file-sound-o', 'fa '),
('fa-file-text', 'fa '),
('fa-file-text-o', 'fa '),
('fa-file-video-o', 'fa '),
('fa-file-word-o', 'fa '),
('fa-file-zip-o', 'fa '),
('fa-files-o', 'fa '),
('fa-film', 'fa '),
('fa-filter', 'fa '),
('fa-fire', 'fa '),
('fa-fire-extinguisher', 'fa '),
('fa-flag', 'fa '),
('fa-flag-checkered', 'fa '),
('fa-flag-o', 'fa '),
('fa-flash', 'fa '),
('fa-flask', 'fa '),
('fa-flickr', 'fa '),
('fa-floppy-o', 'fa '),
('fa-folder', 'fa '),
('fa-folder-o', 'fa '),
('fa-folder-open', 'fa '),
('fa-folder-open-o', 'fa '),
('fa-font', 'fa '),
('fa-forumbee', 'fa '),
('fa-forward', 'fa '),
('fa-foursquare', 'fa '),
('fa-frown-o', 'fa '),
('fa-futbol-o', 'fa '),
('fa-gamepad', 'fa '),
('fa-gavel', 'fa '),
('fa-gbp', 'fa '),
('fa-ge', 'fa '),
('fa-gear', 'fa '),
('fa-gears', 'fa '),
('fa-genderless', 'fa '),
('fa-gift', 'fa '),
('fa-git', 'fa '),
('fa-git-square', 'fa '),
('fa-github', 'fa '),
('fa-github-alt', 'fa '),
('fa-github-square', 'fa '),
('fa-gittip', 'fa '),
('fa-glass', 'fa '),
('fa-globe', 'fa '),
('fa-google', 'fa '),
('fa-google-plus', 'fa '),
('fa-google-plus-square', 'fa '),
('fa-google-wallet', 'fa '),
('fa-graduation-cap', 'fa '),
('fa-gratipay', 'fa '),
('fa-group', 'fa '),
('fa-h-square', 'fa '),
('fa-hacker-news', 'fa '),
('fa-hand-o-down', 'fa '),
('fa-hand-o-left', 'fa '),
('fa-hand-o-right', 'fa '),
('fa-hand-o-up', 'fa '),
('fa-hdd-o', 'fa '),
('fa-header', 'fa '),
('fa-headphones', 'fa '),
('fa-heart', 'fa '),
('fa-heart-o', 'fa '),
('fa-heartbeat', 'fa '),
('fa-history', 'fa '),
('fa-home', 'fa '),
('fa-hospital-o', 'fa '),
('fa-hotel', 'fa '),
('fa-html5', 'fa '),
('fa-ils', 'fa '),
('fa-image', 'fa '),
('fa-inbox', 'fa '),
('fa-indent', 'fa '),
('fa-info', 'fa '),
('fa-info-circle', 'fa '),
('fa-inr', 'fa '),
('fa-instagram', 'fa '),
('fa-institution', 'fa '),
('fa-ioxhost', 'fa '),
('fa-italic', 'fa '),
('fa-joomla', 'fa '),
('fa-jpy', 'fa '),
('fa-jsfiddle', 'fa '),
('fa-key', 'fa '),
('fa-keyboard-o', 'fa '),
('fa-krw', 'fa '),
('fa-language', 'fa '),
('fa-laptop', 'fa '),
('fa-lastfm', 'fa '),
('fa-lastfm-square', 'fa '),
('fa-leaf', 'fa '),
('fa-leanpub', 'fa '),
('fa-legal', 'fa '),
('fa-lemon-o', 'fa '),
('fa-level-down', 'fa '),
('fa-level-up', 'fa '),
('fa-life-bouy', 'fa '),
('fa-life-buoy', 'fa '),
('fa-life-ring', 'fa '),
('fa-life-saver', 'fa '),
('fa-lightbulb-o', 'fa '),
('fa-line-chart', 'fa '),
('fa-link', 'fa '),
('fa-linkedin', 'fa '),
('fa-linkedin-square', 'fa '),
('fa-linux', 'fa '),
('fa-list', 'fa '),
('fa-list-alt', 'fa '),
('fa-list-ol', 'fa '),
('fa-list-ul', 'fa '),
('fa-location-arrow', 'fa '),
('fa-lock', 'fa '),
('fa-long-arrow-down', 'fa '),
('fa-long-arrow-left', 'fa '),
('fa-long-arrow-right', 'fa '),
('fa-long-arrow-up', 'fa '),
('fa-magic', 'fa '),
('fa-magnet', 'fa '),
('fa-mail-forward', 'fa '),
('fa-mail-reply', 'fa '),
('fa-mail-reply-all', 'fa '),
('fa-male', 'fa '),
('fa-map-marker', 'fa '),
('fa-mars', 'fa '),
('fa-mars-double', 'fa '),
('fa-mars-stroke', 'fa '),
('fa-mars-stroke-h', 'fa '),
('fa-mars-stroke-v', 'fa '),
('fa-maxcdn', 'fa '),
('fa-meanpath', 'fa '),
('fa-medium', 'fa '),
('fa-medkit', 'fa '),
('fa-meh-o', 'fa '),
('fa-mercury', 'fa '),
('fa-microphone', 'fa '),
('fa-microphone-slash', 'fa '),
('fa-minus', 'fa '),
('fa-minus-circle', 'fa '),
('fa-minus-square', 'fa '),
('fa-minus-square-o', 'fa '),
('fa-mobile', 'fa '),
('fa-mobile-phone', 'fa '),
('fa-money', 'fa '),
('fa-moon-o', 'fa '),
('fa-mortar-board', 'fa '),
('fa-motorcycle', 'fa '),
('fa-music', 'fa '),
('fa-navicon', 'fa '),
('fa-neuter', 'fa '),
('fa-newspaper-o', 'fa '),
('fa-openid', 'fa '),
('fa-outdent', 'fa '),
('fa-pagelines', 'fa '),
('fa-paint-brush', 'fa '),
('fa-paper-plane', 'fa '),
('fa-paper-plane-o', 'fa '),
('fa-paperclip', 'fa '),
('fa-paragraph', 'fa '),
('fa-paste', 'fa '),
('fa-pause', 'fa '),
('fa-paw', 'fa '),
('fa-paypal', 'fa '),
('fa-pencil', 'fa '),
('fa-pencil-square', 'fa '),
('fa-pencil-square-o', 'fa '),
('fa-phone', 'fa '),
('fa-phone-square', 'fa '),
('fa-photo', 'fa '),
('fa-picture-o', 'fa '),
('fa-pie-chart', 'fa '),
('fa-pied-piper', 'fa '),
('fa-pied-piper-alt', 'fa '),
('fa-pinterest', 'fa '),
('fa-pinterest-p', 'fa '),
('fa-pinterest-square', 'fa '),
('fa-plane', 'fa '),
('fa-play', 'fa '),
('fa-play-circle', 'fa '),
('fa-play-circle-o', 'fa '),
('fa-plug', 'fa '),
('fa-plus', 'fa '),
('fa-plus-circle', 'fa '),
('fa-plus-square', 'fa '),
('fa-plus-square-o', 'fa '),
('fa-power-off', 'fa '),
('fa-print', 'fa '),
('fa-puzzle-piece', 'fa '),
('fa-qq', 'fa '),
('fa-qrcode', 'fa '),
('fa-question', 'fa '),
('fa-question-circle', 'fa '),
('fa-quote-left', 'fa '),
('fa-quote-right', 'fa '),
('fa-ra', 'fa '),
('fa-random', 'fa '),
('fa-rebel', 'fa '),
('fa-recycle', 'fa '),
('fa-reddit', 'fa '),
('fa-reddit-square', 'fa '),
('fa-refresh', 'fa '),
('fa-remove', 'fa '),
('fa-renren', 'fa '),
('fa-reorder', 'fa '),
('fa-repeat', 'fa '),
('fa-reply', 'fa '),
('fa-reply-all', 'fa '),
('fa-retweet', 'fa '),
('fa-rmb', 'fa '),
('fa-road', 'fa '),
('fa-rocket', 'fa '),
('fa-rotate-left', 'fa '),
('fa-rotate-right', 'fa '),
('fa-rouble', 'fa '),
('fa-rss', 'fa '),
('fa-rss-square', 'fa '),
('fa-rub', 'fa '),
('fa-ruble', 'fa '),
('fa-rupee', 'fa '),
('fa-save', 'fa '),
('fa-scissors', 'fa '),
('fa-search', 'fa '),
('fa-search-minus', 'fa '),
('fa-search-plus', 'fa '),
('fa-sellsy', 'fa '),
('fa-send', 'fa '),
('fa-send-o', 'fa '),
('fa-server', 'fa '),
('fa-share', 'fa '),
('fa-share-alt', 'fa '),
('fa-share-alt-square', 'fa '),
('fa-share-square', 'fa '),
('fa-share-square-o', 'fa '),
('fa-shekel', 'fa '),
('fa-sheqel', 'fa '),
('fa-shield', 'fa '),
('fa-ship', 'fa '),
('fa-shirtsinbulk', 'fa '),
('fa-shopping-cart', 'fa '),
('fa-sign-in', 'fa '),
('fa-sign-out', 'fa '),
('fa-signal', 'fa '),
('fa-simplybuilt', 'fa '),
('fa-sitemap', 'fa '),
('fa-skyatlas', 'fa '),
('fa-skype', 'fa '),
('fa-slack', 'fa '),
('fa-sliders', 'fa '),
('fa-slideshare', 'fa '),
('fa-smile-o', 'fa '),
('fa-soccer-ball-o', 'fa '),
('fa-sort', 'fa '),
('fa-sort-alpha-asc', 'fa '),
('fa-sort-alpha-desc', 'fa '),
('fa-sort-amount-asc', 'fa '),
('fa-sort-amount-desc', 'fa '),
('fa-sort-asc', 'fa '),
('fa-sort-desc', 'fa '),
('fa-sort-down', 'fa '),
('fa-sort-numeric-asc', 'fa '),
('fa-sort-numeric-desc', 'fa '),
('fa-sort-up', 'fa '),
('fa-soundcloud', 'fa '),
('fa-space-shuttle', 'fa '),
('fa-spinner', 'fa '),
('fa-spoon', 'fa '),
('fa-spotify', 'fa '),
('fa-square', 'fa '),
('fa-square-o', 'fa '),
('fa-stack-exchange', 'fa '),
('fa-stack-overflow', 'fa '),
('fa-star', 'fa '),
('fa-star-half', 'fa '),
('fa-star-half-empty', 'fa '),
('fa-star-half-full', 'fa '),
('fa-star-half-o', 'fa '),
('fa-star-o', 'fa '),
('fa-steam', 'fa '),
('fa-steam-square', 'fa '),
('fa-step-backward', 'fa '),
('fa-step-forward', 'fa '),
('fa-stethoscope', 'fa '),
('fa-stop', 'fa '),
('fa-street-view', 'fa '),
('fa-strikethrough', 'fa '),
('fa-stumbleupon', 'fa '),
('fa-stumbleupon-circle', 'fa '),
('fa-subscript', 'fa '),
('fa-subway', 'fa '),
('fa-suitcase', 'fa '),
('fa-sun-o', 'fa '),
('fa-superscript', 'fa '),
('fa-support', 'fa '),
('fa-table', 'fa '),
('fa-tablet', 'fa '),
('fa-tachometer', 'fa '),
('fa-tag', 'fa '),
('fa-tags', 'fa '),
('fa-tasks', 'fa '),
('fa-taxi', 'fa '),
('fa-tencent-weibo', 'fa '),
('fa-terminal', 'fa '),
('fa-text-height', 'fa '),
('fa-text-width', 'fa '),
('fa-th', 'fa '),
('fa-th-large', 'fa '),
('fa-th-list', 'fa '),
('fa-thumb-tack', 'fa '),
('fa-thumbs-down', 'fa '),
('fa-thumbs-o-down', 'fa '),
('fa-thumbs-o-up', 'fa '),
('fa-thumbs-up', 'fa '),
('fa-ticket', 'fa '),
('fa-times', 'fa '),
('fa-times-circle', 'fa '),
('fa-times-circle-o', 'fa '),
('fa-tint', 'fa '),
('fa-toggle-down', 'fa '),
('fa-toggle-left', 'fa '),
('fa-toggle-off', 'fa '),
('fa-toggle-on', 'fa '),
('fa-toggle-right', 'fa '),
('fa-toggle-up', 'fa '),
('fa-train', 'fa '),
('fa-transgender', 'fa '),
('fa-transgender-alt', 'fa '),
('fa-trash', 'fa '),
('fa-trash-o', 'fa '),
('fa-tree', 'fa '),
('fa-trello', 'fa '),
('fa-trophy', 'fa '),
('fa-truck', 'fa '),
('fa-try', 'fa '),
('fa-tty', 'fa '),
('fa-tumblr', 'fa '),
('fa-tumblr-square', 'fa '),
('fa-turkish-lira', 'fa '),
('fa-twitch', 'fa '),
('fa-twitter', 'fa '),
('fa-twitter-square', 'fa '),
('fa-umbrella', 'fa '),
('fa-underline', 'fa '),
('fa-undo', 'fa '),
('fa-university', 'fa '),
('fa-unlink', 'fa '),
('fa-unlock', 'fa '),
('fa-unlock-alt', 'fa '),
('fa-unsorted', 'fa '),
('fa-upload', 'fa '),
('fa-usd', 'fa '),
('fa-user', 'fa '),
('fa-user-md', 'fa '),
('fa-user-plus', 'fa '),
('fa-user-secret', 'fa '),
('fa-user-times', 'fa '),
('fa-users', 'fa '),
('fa-venus', 'fa '),
('fa-venus-double', 'fa '),
('fa-venus-mars', 'fa '),
('fa-viacoin', 'fa '),
('fa-video-camera', 'fa '),
('fa-vimeo-square', 'fa '),
('fa-vine', 'fa '),
('fa-vk', 'fa '),
('fa-volume-down', 'fa '),
('fa-volume-off', 'fa '),
('fa-volume-up', 'fa '),
('fa-warning', 'fa '),
('fa-wechat', 'fa '),
('fa-weibo', 'fa '),
('fa-weixin', 'fa '),
('fa-whatsapp', 'fa '),
('fa-wheelchair', 'fa '),
('fa-wifi', 'fa '),
('fa-windows', 'fa '),
('fa-won', 'fa '),
('fa-wordpress', 'fa '),
('fa-xing', 'fa '),
('fa-xing-square', 'fa '),
('fa-yahoo', 'fa '),
('fa-yelp', 'fa '),
('fa-yen', 'fa '),
('fa-youtube', 'fa '),
('fa-youtube-play', 'fa '),
('fa-youtube-square', 'fa '),
('_none', 'fa ');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) NOT NULL,
  `caption` varchar(32) NOT NULL,
  `link` varchar(128) NOT NULL,
  `icon` varchar(32) DEFAULT NULL,
  `rbac` varchar(128) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  KEY `rbac` (`rbac`),
  KEY `icon` (`icon`),
  KEY `sub_id` (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `sub_id`, `caption`, `link`, `icon`, `rbac`, `weight`) VALUES
(0, 0, 'ROOT', 'ROOT', '_none', '(rol)everyone', 100),
(4, 0, 'Dashboard', '/', 'fa-dashboard', '(rol)everyone', 100),
(7, 0, 'Samples', '/samples', 'fa-circle-o', '(rol)everyone', 100),
(12, 0, 'Admin', '/admin', 'fa-dashboard', '(rol)admin', 100),
(13, 12, 'Users', '/admin/users', 'fa-users', '(rol)admin', 100),
(14, 12, 'Menu', '/admin/menu', 'fa-list', '(rol)admin', 100);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `title` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_from` (`user_from`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `user_from`, `time`, `title`, `message`, `status`) VALUES
(1, 1, 1, '2015-07-26 04:08:25', 'Test', 'Hello\r\n\r\nThis is a test from me.\r\n\r\nKind regards', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_assignment`
--

CREATE TABLE IF NOT EXISTS `rbac_assignment` (
  `username` varchar(64) NOT NULL,
  `rbac_items_keyname` varchar(128) NOT NULL,
  UNIQUE KEY `username` (`username`,`rbac_items_keyname`),
  KEY `item` (`rbac_items_keyname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_assignment`
--

INSERT INTO `rbac_assignment` (`username`, `rbac_items_keyname`) VALUES
('admin', '(rol)admin'),
('david', '(rol)admin');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_child_items`
--

CREATE TABLE IF NOT EXISTS `rbac_child_items` (
  `rbac_items_parent` varchar(128) NOT NULL,
  `rbac_items_child` varchar(128) NOT NULL,
  PRIMARY KEY (`rbac_items_parent`,`rbac_items_child`),
  KEY `rbac_items_sub` (`rbac_items_child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_child_items`
--

INSERT INTO `rbac_child_items` (`rbac_items_parent`, `rbac_items_child`) VALUES
('(rol)admin', '(per)edit-button'),
('(per)edit-button', '(per)subpage'),
('(rol)admin', '(per)subpage'),
('(rol)user', '(per)subpage'),
('(rol)admin', '(per)user-management');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_items`
--

CREATE TABLE IF NOT EXISTS `rbac_items` (
  `name` varchar(64) NOT NULL,
  `keyname` varchar(128) NOT NULL,
  `discription` tinytext,
  PRIMARY KEY (`keyname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_items`
--

INSERT INTO `rbac_items` (`name`, `keyname`, `discription`) VALUES
('edit button', '(per)edit-button', 'Can access the edit button'),
('subpage', '(per)subpage', 'Can access the subpage'),
('User management', '(per)user-management', 'Can edit users'),
('admin', '(rol)admin', 'The admin role (build in)'),
('everyone', '(rol)everyone', 'everyone (build in)'),
('user', '(rol)user', 'The user role');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_users`
--

CREATE TABLE IF NOT EXISTS `rbac_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `givenname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `title` varchar(32) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rbac_users`
--

INSERT INTO `rbac_users` (`id`, `username`, `surname`, `givenname`, `email`, `title`, `avatar`, `password`) VALUES
(1, 'admin', 'The Administrator', 'Admin', 'admin@mysite.com', 'Administrator', 'avatar5.png', '$2y$10$TjkVxtG6VWLFqKIa51cXze.uVfNzVGSt2wv3YxFdJLgJTVsCwWoNi'),
(2, 'david', 'Kinders', 'David', 'david@mysite.com', 'Developer', 'avatar5.png', '$2y$10$FfLrUplg1TAszI567nypTuFuuX5yqlvIGw2g858id4fn8MBtxfmQ.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`rbac`) REFERENCES `rbac_items` (`keyname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_ibfk_3` FOREIGN KEY (`icon`) REFERENCES `icons` (`name`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `menu_ibfk_4` FOREIGN KEY (`sub_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `rbac_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_from`) REFERENCES `rbac_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_assignment`
--
ALTER TABLE `rbac_assignment`
  ADD CONSTRAINT `rbac_assignment_ibfk_2` FOREIGN KEY (`username`) REFERENCES `rbac_users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_assignment_ibfk_3` FOREIGN KEY (`rbac_items_keyname`) REFERENCES `rbac_items` (`keyname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_child_items`
--
ALTER TABLE `rbac_child_items`
  ADD CONSTRAINT `rbac_child_items_ibfk_1` FOREIGN KEY (`rbac_items_parent`) REFERENCES `rbac_items` (`keyname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_child_items_ibfk_2` FOREIGN KEY (`rbac_items_child`) REFERENCES `rbac_items` (`keyname`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
