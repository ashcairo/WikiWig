# phpMyAdmin SQL Dump
# version 2.5.3
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Jul 20, 2004 at 02:04 PM
# Server version: 4.0.15
# PHP Version: 4.3.3
# 
# Database : `wiki`
# 

# --------------------------------------------------------

#
# Table structure for table `wk_pages`
#

CREATE TABLE `wk_pages` (
  `pages_id` int(11) NOT NULL auto_increment,
  `pages_nom` text NOT NULL,
  `pages_temps` int(15) NOT NULL default '0',
  `pages_utilisateur` varchar(10) NOT NULL default '0',
  UNIQUE KEY `pages_id` (`pages_id`)
) TYPE=MyISAM AUTO_INCREMENT=0 ;

# map page id to an even in history

CREATE TABLE `wk_history` (
  `history_id` int(11) NOT NULL auto_increment,
  `sequence` int(11) NOT NULL,
  `action` varchar(255) NOT NULL default '0',
  `user` varchar(255) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  `comment` varchar(255) NOT NULL default '0',
  UNIQUE KEY `history_id` (`history_id`)
) TYPE=MyISAM AUTO_INCREMENT=0 ;

#  Map pages to a unique id
CREATE TABLE `wk_directory` (
  `sequence` int(11) NOT NULL auto_increment,
  `path` text NOT NULL,
  `active`  char(1) NOT NULL default 'F',
  `last_backup`  int(11) NOT NULL default '0',
  PRIMARY KEY `sequence` (`sequence`)
) TYPE=MyISAM AUTO_INCREMENT=0 ;


# --------------------------------------------------------

#
# Table structure for table `wk_utilisateurs`
#

CREATE TABLE `wk_users` (
  `id` int(5) NOT NULL auto_increment,
  `login` varchar(255) NOT NULL default '',
  `mdp` varchar(255) NOT NULL default '',
  `magic` varchar(32) NOT NULL default '',
  `token` varchar(32) NOT NULL default '',
  `timeout` int(10) unsigned default '0',
  `email` varchar(255) NOT NULL default '',
  `privilege` char(1) NOT NULL default 'F',
  `editFiles` char(1) NOT NULL default 'F',
  `renameFolders` char(1) NOT NULL default 'F',
  `renameFiles` char(1) NOT NULL default 'F',
  `moveFolders` char(1) NOT NULL default 'F',
  `moveFiles` char(1) NOT NULL default 'F',
  `deleteFolders` char(1) NOT NULL default 'F',
  `deleteFiles` char(1) NOT NULL default 'F',
  `createFiles` char(1) NOT NULL default 'F',
  `createFolders` char(1) NOT NULL default 'F',
  `restoreFiles` char(1) NOT NULL default 'F',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=0 ;

