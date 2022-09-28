CREATE TABLE IF NOT EXISTS manage_front_phase (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
phases ENUM("","1","2","3","4","5","6","7","8","9","10","11") NOT NULL,
phase_description VARCHAR(255) NOT NULL,
category VARCHAR(255) NOT NULL,
title VARCHAR(500) NOT NULL,
content TEXT NOT NULL,
content_link VARCHAR(500) NOT NULL,
content_image VARCHAR(500) NOT NULL,
status ENUM("0","1") NOT NULL
)