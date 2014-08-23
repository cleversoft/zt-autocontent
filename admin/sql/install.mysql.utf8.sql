DROP TABLE IF EXISTS `#__autocontent_feed`;
CREATE TABLE IF NOT EXISTS `#__autocontent_feed` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `feed_name` varchar(255) NOT NULL,
  `feed_url` mediumtext NOT NULL,
  `feed_type` varchar(255) NOT NULL,
  `content_id` int(4) NOT NULL DEFAULT '0',
  `k2_id` int(4) NOT NULL DEFAULT '0',
  `author_id` int(4) NOT NULL,
  `update` varchar(255) NOT NULL,
  `get_articles` int(4) NOT NULL,
  `status` int(4) NOT NULL,
  `get_class` varchar(255) NOT NULL,
  `ignore_class` varchar(255) NOT NULL,
  `get_id` varchar(255) NOT NULL,
  `ignore_id` varchar(255) NOT NULL,
  `post_interval` int(4) NOT NULL DEFAULT '0',
  `image_path` varchar(255) DEFAULT NULL,
  `remove_tag` int(4) NOT NULL DEFAULT '0',
  `allow_tags` varchar(255) DEFAULT NULL,
  `replace_chars` mediumtext NOT NULL,
  `replace_texts` mediumtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `start_publishing` datetime NOT NULL,
  `published` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `#__autocontent_log`;
CREATE TABLE IF NOT EXISTS `#__autocontent_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
