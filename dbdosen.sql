CREATE TABLE dosen (
    id_dosen INT PRIMARY KEY AUTO_INCREMENT,
    nama_dosen VARCHAR(100) NOT NULL,
    nidn VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE
);

CREATE TABLE matakuliah (
    id_matakuliah INT PRIMARY KEY AUTO_INCREMENT,
    nama_matakuliah VARCHAR(100) NOT NULL,
    kode_matakuliah VARCHAR(20) UNIQUE NOT NULL,
    sks INT NOT NULL
);

CREATE TABLE mengajar (
    id_mengajar INT PRIMARY KEY AUTO_INCREMENT,
    id_dosen INT,
    id_matakuliah INT,
    semester VARCHAR(10),
    tahun_ajaran VARCHAR(10),
    FOREIGN KEY (id_dosen) REFERENCES dosen(id_dosen),
    FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id_matakuliah)
);

INSERT INTO dosen (nama_dosen, nidn, email) VALUES 
('Dr. Ahmad Fauzi', '123456789', 'ahmad.fauzi@univ.ac.id'),
('Prof. Siti Nurhaliza', '987654321', 'siti.nurhaliza@univ.ac.id'),
('Dr. Budi Santoso', '112233445', 'budi.santoso@univ.ac.id');

INSERT INTO matakuliah (nama_matakuliah, kode_matakuliah, sks) VALUES 
('Matematika Diskrit', 'MAT101', 3),
('Algoritma dan Pemrograman', 'CS102', 4),
('Struktur Data', 'CS103', 3),
('Basis Data', 'CS104', 4);

INSERT INTO mengajar (id_dosen, id_matakuliah, semester, tahun_ajaran) VALUES 
(1, 1, 'Ganjil', '2023/2024'),
(1, 2, 'Genap', '2023/2024'),
(2, 3, 'Ganjil', '2023/2024'),
(3, 4, 'Genap', '2023/2024');
