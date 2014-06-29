DROP TABLE IF EXISTS `#__chatwing_config`;

CREATE TABLE `#__chatwing_config` (
`name`  varchar(64) NOT NULL ,
`value`  longtext NULL ,
PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#__chatwing_config` VALUES('api_key', ''),('settings', '');