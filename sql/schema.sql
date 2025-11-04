CREATE DATABASE qsatopt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE qsatopt;

CREATE TABLE satellites (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  tle_line1 TEXT,
  tle_line2 TEXT,
  last_updated DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE passes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sat_id INT,
  start_time DATETIME,
  end_time DATETIME,
  elevation FLOAT,
  duration FLOAT,
  FOREIGN KEY (sat_id) REFERENCES satellites(id)
);

CREATE TABLE optimized_windows (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sat_id INT,
  start_time DATETIME,
  end_time DATETIME,
  priority_score FLOAT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sat_id) REFERENCES satellites(id)
);

