/* 
 * TiJester
 * UA Odessa  * 
 */
/**
 * Author:  admin
 * Created: 29.03.2018
 * users
 * v 0.2 
 */

CREATE TABLE users (
id_user INT(10) NOT NULL AUTO_INCREMENT,
name TINYTEXT NOT NULL,
pass TINYTEXT NOT NULL,
email TINYTEXT NOT NULL,    # v 0.2
description TEXT NOT NULL,  # v 0.2
add_date DATETIME NOT NULL,
PRIMARY KEY (id_user)
)