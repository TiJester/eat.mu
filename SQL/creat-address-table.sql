/* 
 * TiJester
 * UA Odessa  * 
 */
/**
 * Author:  Grib
 * Created: 01.01.2018:20.49
 */
CREATE TABLE `address` 
( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `address_country` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Страна' , 
    `address_city` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Город' , 
    `address_street` CHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Улица' , 
    `address_street_num` INT(5) NOT NULL COMMENT 'Номер на улице' , 
    `address_apartment` INT(5) NOT NULL COMMENT 'Номер квартиры' , PRIMARY KEY (`id`)
)
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'address (таблийца адреса)';