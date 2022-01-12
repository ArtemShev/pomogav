DROP DATABASE IF EXISTS pomogavDB;
CREATE DATABASE pomogavDB
    DEFAULT CHARACTER SET = 'utf8mb4';
use pomogavDB;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` Serial PRIMARY KEY ,
  `email` varchar(60) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `city` varchar(60) NOT NULL,
  `role` varchar(60) NOT NULL,
  `is_verified` int(11) DEFAULT 0
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET utf8 ;

Drop Table if exists shelters;
CREATE TABLE shelters (
  id Serial PRIMARY KEY,
  `user_id` bigint unsigned NOT NULL,
  shelter_name VARCHAR(60),
  `description` varchar(2000),
  phone_number VARCHAR(200),
  address VARCHAR(200),
  imagepath VARCHAR(200),
  imagename VARCHAR(200)
  -- img_name BLOB DEFAULT null,
  -- img_tmp LONGBLOB DEFAULT null
) DEFAULT CHARSET utf8 ;

Drop Table if exists inquiries;
CREATE TABLE inquiries (
  id Serial PRIMARY KEY,
  shelter_id bigint unsigned NOT NULL,
  `description` varchar(2000),
  FOREIGN KEY (shelter_id) REFERENCES shelters (id) ON UPDATE CASCADE ON DELETE CASCADE
) DEFAULT CHARSET utf8 ;




-- Drop Table if exists image_table;
-- CREATE TABLE image_table (
--   id Serial PRIMARY KEY,
--   imagepath VARCHAR(200),
--   imagename VARCHAR(200)
-- ) DEFAULT CHARSET utf8 ;

-- INSERT INTO image_table VALUES('$folder','$upload_image')
INSERT INTO shelters VALUES (id,1,'test','"test','test','test','../images/','$image_name')