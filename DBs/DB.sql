
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DROP TABLE IF EXISTS `site_emails`;
CREATE TABLE IF NOT EXISTS `site_emails` (
  `id` varchar(255) NOT NULL,
  `correoBool` enum('true','false') NOT NULL DEFAULT 'true',
  `smtpServer` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `encryp` enum('ssl','tls') NOT NULL DEFAULT 'ssl',
  `port` varchar(255) NOT NULL,
  `corNot` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `site_emails` (`id`, `correoBool`, `smtpServer`, `user`, `pass`, `encryp`, `port`, `corNot`) VALUES
('mail', 'false', 'smtp.server.com', 'user@server.com', 'password', 'ssl', '465', '');

DROP TABLE IF EXISTS `site_data_emails`;
CREATE TABLE IF NOT EXISTS `site_data_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `keyPr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `site_permissions`;
CREATE TABLE IF NOT EXISTS `site_permissions` (
  `name` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `site_permissions` (`name`, `rank`) VALUES
('admin_home', 2),
('admin_config', 3),
('admin_permissions', 3),
('admin_users', 2),
('web_web', 0);

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `var` varchar(255) NOT NULL,
  `result` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `site_settings` (`var`, `result`) VALUES
('title', 'MLV Intranet'),
('slogan', 'INTRANET VERSION ALPHA'),
('keywords', 'keyword 1, keyword 2, keyword 3'),
('author', 'Carlos Zambrano'),
('url', 'http://amataenglish.com/'),
('favicon', 'favicon.ico'),
('logo', 'logo.png'),
('scriptHead', ''),
('twitterSeo', 'false'),
('twitterUser', 'twitter'),
('twitterImg', 'Twitter.jpg'),
('ogImg', 'ImgSeo.jpg');

DROP TABLE IF EXISTS `site_users`;
CREATE TABLE IF NOT EXISTS `site_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `lastaccess` varchar(255) NOT NULL,
  `dateAdmission` date NOT NULL DEFAULT '0000-00-00',
  `rank` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `bannish` enum('0','1') NOT NULL DEFAULT '0',
  `ReferredBy` varchar(255) NOT NULL,
  `howDidYouKnowUs` text NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Nombre',
  `lastname` varchar(255) NOT NULL DEFAULT 'Apellido',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL DEFAULT '0000-00-00',
  `curp` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.jpg',
  `cover` varchar(255) NOT NULL DEFAULT 'cover.jpg',
  `profession` text NOT NULL,
  `codephone` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `whatsapp` enum('0','1') NOT NULL DEFAULT '0',
  `telegram` enum('0','1') NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `ideology` enum('Liberal','Minarquista','Anarcocapitalista','Otro') NOT NULL DEFAULT 'Liberal',
  `socialTest` varchar(255) NOT NULL,
  `economicTest` varchar(255) NOT NULL,
  `anotherOrganization` text NOT NULL,
  `networkings` text NOT NULL,
  `sharingInNetworks` enum('0','1') NOT NULL DEFAULT '0',
  `voluntary` enum('0','1') NOT NULL DEFAULT '0',
  `participateInEvents` enum('0','1') NOT NULL DEFAULT '0',
  `fundsAndDonations` enum('0','1') NOT NULL DEFAULT '0',
  `anotherWayToCollaborate` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `site_forums_category`;
CREATE TABLE IF NOT EXISTS `site_forums_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `site_forums_category` (`id`, `title`, `description`, `url`) VALUES
('1', 'General', 'Foro general para todo lo relacionado al MLV. Por la libertad!', 'general'),
('2', 'Actividades de calle', 'Para discutir de las actividades emprendidas por el MLV.', 'activismo'),
('3', 'Libros y Libertarismo', 'Quieres aprender mas sobre el libertarismo? Es por aqui...', 'libertarismo'),
('4', 'Formacion', 'Cursos y talleres para todos los miembros.', 'formacion'),
('5', 'Proyectos', 'Tienes algun proyecto que quieras promover?', 'proyectos'),
('6', 'Voluntariado', 'Buscas voluntarios para tu proyecto, o quieres contribuir al MLV?', 'voluntariado'),
('7', 'Buzon de sugerencias - MLV', 'Sugerencias, criticas, quejas y todo lo que te venga en mente.', 'sugerencias'),
('8', 'Buzon de sugerencias - Intranet', 'Como podemos mejorar nuestro intranet?', 'intranet'),
('9', 'Offtopic', 'Aqui todo es permitido. Anarquia pura!', 'offtopic');

DROP TABLE IF EXISTS `site_forums_topics`;
CREATE TABLE IF NOT EXISTS `site_forums_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id_forums_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `site_forums_comments`;
CREATE TABLE IF NOT EXISTS `site_forums_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
