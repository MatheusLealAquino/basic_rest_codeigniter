CREATE TABLE `logs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `uri` VARCHAR(255) NOT NULL,
    `method` VARCHAR(6) NOT NULL,
    `params` TEXT DEFAULT NULL,
    `api_key` VARCHAR(40) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `time` INT(11) NOT NULL,
    `rtime` FLOAT DEFAULT NULL,
    `authorized` VARCHAR(1) NOT NULL,
    `response_code` smallint(3) DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
