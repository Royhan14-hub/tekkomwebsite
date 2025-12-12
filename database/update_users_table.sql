USE inventory2;

-- Add new columns to users table
-- Run these one by one. If a column already exists, skip that line.

ALTER TABLE users ADD COLUMN username VARCHAR(100) UNIQUE AFTER id_user;
ALTER TABLE users ADD COLUMN password VARCHAR(255) AFTER username;
ALTER TABLE users ADD COLUMN level VARCHAR(50) DEFAULT 'user' AFTER password;
ALTER TABLE users ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER divisi;

-- Insert default admin user
-- Default: username='admin', password='admin123'
INSERT INTO users (username, password, level, divisi) 
VALUES ('admin', '$2y$10$e9LYH9blWF1lP./mNOnI1e/VqmYIX3zfSZ3KiChudLBlUWhzZtyO.', 'admin', 'Admin Gudang')
ON DUPLICATE KEY UPDATE 
    password = VALUES(password),
    level = VALUES(level);

