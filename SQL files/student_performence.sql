-- Create Database
CREATE DATABASE IF NOT EXISTS student_performance;
USE student_performance;

-- User Management Module: Users Table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) DEFAULT 'student'
);

-- Data Collection Module: Student Data Table
CREATE TABLE IF NOT EXISTS student_data (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  score INT NOT NULL,
  attendance INT NOT NULL,
  submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Performance Analysis Module: Automatically handled in backend PHP

-- Report Generation Module: No extra table needed as reports are generated dynamically from student_data

-- Feedback and Recommendation Module: Can be integrated dynamically during report generation

-- Insert sample user for testing
INSERT INTO users (username, password, role) VALUES ('admin', 'admin123', 'admin')
  ON DUPLICATE KEY UPDATE username = username;

-- Insert sample student data for testing
INSERT INTO student_data (name, score, attendance) VALUES
('John Doe', 85, 90),
('Jane Smith', 72, 80),
('Alice Johnson', 95, 98),
('Bob Brown', 45, 60);

