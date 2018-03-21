/* 
 * TiJester
 * UA Odessa  * 
 */
/**
 * Author:  admin
 * Created: 19.03.2018
 * v 0.1 
 */

CREATE TABLE users (
id_user INT(10) NOT NULL AUTO_INCREMENT,
name TINYTEXT NOT NULL,
pass TINYTEXT NOT NULL,
add_date DATETIME NOT NULL,
PRIMARY KEY (id_user)
)