-- 数据库: `gallerycms`
--
CREATE DATABASE `gallerycms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gallerycms`;

-- --------------------------------------------------------

--
-- 表的结构 `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(45) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `album`
--

INSERT INTO `album` (`id`, `uuid`, `name`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'c97683e2-9931-11e2-9d23-2339b2d206a5', '2011年黄山二日游', 1, 1, 1, '2013-03-30 15:03:08', '2013-03-31 06:11:50'),
(2, '961abb2a-9941-11e2-9d23-2339b2d206a5', '2012山东四日游', 1, 1, 1, '2013-03-30 13:56:14', '2013-03-31 05:39:19');

-- --------------------------------------------------------

--
-- 表的结构 `album_config`
--

CREATE TABLE IF NOT EXISTS `album_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(10) unsigned DEFAULT NULL,
  `thumb_width` int(11) NOT NULL DEFAULT '100',
  `thumb_height` int(11) NOT NULL DEFAULT '100',
  `crop_thumbnails` tinyint(1) NOT NULL DEFAULT '0',
  `auto_publish` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `album_config`
--

INSERT INTO `album_config` (`id`, `album_id`, `thumb_width`, `thumb_height`, `crop_thumbnails`, `auto_publish`) VALUES
(1, 1, 100, 100, 0, 1),
(2, 2, 100, 100, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `feed`
--

CREATE TABLE IF NOT EXISTS `feed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `uuid` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `feed_album`
--

CREATE TABLE IF NOT EXISTS `feed_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feed_id` int(10) unsigned DEFAULT NULL,
  `album_id` int(10) unsigned DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(10) unsigned DEFAULT NULL,
  `uuid` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `caption` text,
  `raw_name` varchar(45) DEFAULT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  `file_ext` varchar(45) DEFAULT NULL,
  `file_size` varchar(45) DEFAULT NULL,
  `path` varchar(45) DEFAULT NULL,
  `full_path` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

-- --------------------------------------------------------

--
-- 表的结构 `image_comment`
--

CREATE TABLE IF NOT EXISTS `image_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `uuid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(45) NOT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_logged_in` datetime DEFAULT NULL,
  `last_ip` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

