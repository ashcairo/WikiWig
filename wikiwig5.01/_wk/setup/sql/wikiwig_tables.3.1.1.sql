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


# --------------------------------------------------------

#
# Table structure for table `wk_utilisateurs`
#

CREATE TABLE `wk_utilisateurs` (
  `utilisateurs_id` tinyint(4) NOT NULL auto_increment,
  `utilisateurs_nom` varchar(255) NOT NULL default '',
  `utilisateurs_mdp` varchar(255) NOT NULL default '',
  `utilisateurs_couleur` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`utilisateurs_id`)
) TYPE=MyISAM AUTO_INCREMENT=0 ;

