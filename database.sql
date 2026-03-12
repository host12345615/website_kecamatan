CREATE DATABASE arsip_kabaena;
USE arsip_kabaena;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50),
password VARCHAR(255)
);

INSERT INTO users(username,password)
VALUES ('admin', MD5('admin123'));

CREATE TABLE data_arsip (
id INT AUTO_INCREMENT PRIMARY KEY,
nama_pengirim VARCHAR(100),
alamat TEXT,
keterangan TEXT,
file_upload VARCHAR(255),
tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE galeri (
id INT AUTO_INCREMENT PRIMARY KEY,
gambar VARCHAR(255),
tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE counter (
id INT PRIMARY KEY,
jumlah INT
);

INSERT INTO counter VALUES (1,0);
