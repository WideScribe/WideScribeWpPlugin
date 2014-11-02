-- Create syntax for TABLE 'partner'
ALTER TABLE `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerName` char(70) CHARACTER SET utf32 NOT NULL DEFAULT '',
  `anonCompensation` int(11) NOT NULL DEFAULT '0',
  `emailCompensation` int(11) NOT NULL DEFAULT '25',
  `cardCompensation` int(11) DEFAULT '25',
  `rootDomain` char(50) NOT NULL DEFAULT '',
  `languageId` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `domain` varchar(44) NOT NULL DEFAULT '',
  `cutOffDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logosrc` varchar(40) NOT NULL DEFAULT '',
  `defaultCost` int(11) DEFAULT '1',
  `secret` varchar(50) NOT NULL,
  `wordpressPage` int(1) DEFAULT '0',
  `defaultCurrencyCode` char(3) DEFAULT NULL,
  `wsOwnerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partnerID` (`id`),
  KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'portal'
CREATE TABLE `portal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `portalName` varchar(128) NOT NULL DEFAULT '',
  `domain` varchar(128) NOT NULL DEFAULT '',
  `initKey` varchar(256) DEFAULT NULL,
  `publicKey` varchar(256) DEFAULT NULL,
  `privateKey` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `portal` (`id`, `portalName`, `domain`, `initKey`, `publicKey`, `privateKey`)
VALUES
	(1, 'WideScribe Local', 'widescribe.local', '939f9ce8035606d88c18f5140c291042ff608a702879b958121173417c2426141323a9b7b8e16d60fda3fd07235461dc14885c6f040e434088d4a1c08fae11a821f5e7e446dc6ce0588407af4d7617a182bf063590551d796ce9e202896c4dbebcc1f4295fdfac55d12f4934d11e542126e77047d0833109a77af387b2a420ac', NULL, NULL);
