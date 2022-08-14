CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_content LONGTEXT NOT NULL,
    message_to VARCHAR(100) NOT NULL,
    message_type VARCHAR(100) NOT NULL,
    status VARCHAR(100) NOT NULL,
    message_response TEXT DEFAULT NULL,
    do_at DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);