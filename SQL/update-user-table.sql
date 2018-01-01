/* 
 * TiJester
 * UA Odessa  * 
 */
/**
 * Author:  Grib
 * Created: 01.01.2018
 */

ALTER TABLE `user` 
    ADD `address_country` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'адрес (страна)' AFTER `password`, ADD UNIQUE (`address_country`),
    ADD `address_city` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'адрес (город)' AFTER `address_country`, ADD UNIQUE (`address_city`),
    ADD `address_street` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'адрес (улица)' AFTER `address_city`, ADD UNIQUE (`address_street`),
    ADD `address_street_num` CHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'адрес (номер по улице)' AFTER `address_street`, ADD UNIQUE (`address_street_num`),
    ADD `address_apartment` CHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'адрес (номер квартиры)' AFTER `address_street_num`, ADD UNIQUE (`address_apartment`);


