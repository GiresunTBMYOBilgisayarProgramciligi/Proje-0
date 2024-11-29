USE tmyo_db;
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) UNIQUE ,
                       password VARCHAR(255) NOT NULL,
                       name VARCHAR(30),
                       lastname VARCHAR(30),
                       email VARCHAR(100) UNIQUE NOT NULL,
                       role VARCHAR(30) DEFAULT 'user',
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE posts (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       type VARCHAR(30) NOT NULL DEFAULT 'page',
                       title VARCHAR(255) NOT NULL,
                       content LONGTEXT NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                       status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
                       author_id INT,
                       FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);
CREATE TABLE user_meta (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           user_id INT NOT NULL,
                           meta_key VARCHAR(100) NOT NULL,
                           meta_value TEXT,
                           FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE post_meta (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           post_id INT NOT NULL,
                           meta_key VARCHAR(100) NOT NULL,
                           meta_value TEXT,
                           FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

insert into
    users(username,password,email,role)
values
    ("sametatabasch",
     "$2y$10$e5p.RhhIP1UgggIeE9jdc./haJfJcxhsqOD1hTC7FT2/aWMBVGezW",
     "sametatabasch@gmail.com",
     "admin");