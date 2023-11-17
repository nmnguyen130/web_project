-- Create the 'biomap' database if it doesn't exist
CREATE DATABASE IF NOT EXISTS biomap;

-- Use the 'biomap' database
USE biomap;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user',
    password VARCHAR(255),
    date_created DATETIME
);

CREATE TABLE form (
	id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('animal', 'plant') NOT NULL,
    scientific_name VARCHAR(255),
    name NVARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    characteristic TEXT,
    behavior TEXT,
    habitat TEXT,
    submission_date DATETIME,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE region (
    region_id INT AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE province (
    province_id INT AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR(255) NOT NULL,
    region_id INT,
    description TEXT,
    animal_list JSON,
    plant_list JSON,
    FOREIGN KEY (region_id) REFERENCES region(region_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE animal (
	scientific_name VARCHAR(255) PRIMARY KEY,
    name NVARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    red_list BOOLEAN DEFAULT FALSE,
    characteristic TEXT,
    behavior TEXT,
    habitat TEXT
);

CREATE TABLE plant (
	scientific_name VARCHAR(255) PRIMARY KEY,
    name NVARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    red_list BOOLEAN DEFAULT FALSE,
    characteristic TEXT,
    habitat TEXT
);

CREATE TABLE red_list_animal (
    red_list_id INT AUTO_INCREMENT PRIMARY KEY,
    scientific_name VARCHAR(255) NOT NULL,
    conservation_status NVARCHAR(100),
    threat_level VARCHAR(255),
    protection_measures TEXT,
    FOREIGN KEY (scientific_name) REFERENCES animal(scientific_name) ON DELETE CASCADE
);

CREATE TABLE red_list_plant (
    red_list_id INT AUTO_INCREMENT PRIMARY KEY,
    scientific_name VARCHAR(255) NOT NULL,
    conservation_status NVARCHAR(100),
    threat_level VARCHAR(255),
    protection_measures TEXT,
    FOREIGN KEY (scientific_name) REFERENCES plant(scientific_name) ON DELETE CASCADE
);

-- Trigger to insert data into 'red_list_animal' when 'red_list' is TRUE in 'animal'
DELIMITER //
CREATE TRIGGER animal_red_list_trigger
AFTER INSERT ON animal
FOR EACH ROW
BEGIN
    IF NEW.red_list = TRUE THEN
        INSERT INTO red_list_animal (scientific_name, conservation_status, threat_level, protection_measures)
        VALUES (NEW.scientific_name, 'Conservation Status for Animal', 'Threat Level for Animal', 'Protection Measures for Animal');
    END IF;
END;
//
DELIMITER ;

-- Trigger to insert data into 'red_list_plant' when 'red_list' is TRUE in 'plant'
DELIMITER //
CREATE TRIGGER plant_red_list_trigger
AFTER INSERT ON plant
FOR EACH ROW
BEGIN
    IF NEW.red_list = TRUE THEN
        INSERT INTO red_list_plant (scientific_name, conservation_status, threat_level, protection_measures)
        VALUES (NEW.scientific_name, 'Conservation Status for Plant', 'Threat Level for Plant', 'Protection Measures for Plant');
    END IF;
END;
//
DELIMITER ;

INSERT INTO region (name)
VALUES
    ('Tây Bắc Bộ'),
    ('Đông Bắc Bộ'),
    ('Đồng Bằng Sông Hồng'),
    ('Bắc Trung Bộ'),
    ('Duyên Hải Nam Trung Bộ'),
    ('Tây Nguyên'),
    ('Đông Nam Bộ'),
    ('Đồng Bằng Sông Cửu Long');

-- Insert data into the 'province' table
LOAD DATA INFILE 'D:/biomap_provinces.csv' INTO TABLE province
FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n'
IGNORE 1 LINES
(name, region_id, description, @animal_list, @plant_list)
SET animal_list = JSON_UNQUOTE(REPLACE(@animal_list, "'", '"')),
    plant_list = JSON_UNQUOTE(REPLACE(@plant_list, "'", '"'));

LOAD DATA INFILE 'D:/biomap_animals.csv' INTO TABLE animal
FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n'
IGNORE 1 LINES
(scientific_name, name, image_url, red_list, characteristic, behavior, habitat);

LOAD DATA INFILE 'D:/biomap_plants.csv' INTO TABLE plant
FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n'
IGNORE 1 LINES
(scientific_name, name, image_url, red_list, characteristic, habitat);

-- SELECT * FROM user;
-- SELECT * FROM form;
-- SELECT * FROM region;
-- SELECT * FROM province;
-- SELECT * FROM animal;
-- SELECT * FROM plant;
-- SELECT * FROM red_list_animal;
-- SELECT * FROM red_list_plant;