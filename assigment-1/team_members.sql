CREATE TABLE team_members (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    first_name  VARCHAR(50) NOT NULL,
    last_name   VARCHAR(50) NOT NULL,
    position    VARCHAR(50) DEFAULT NULL,
    phone       VARCHAR(30) DEFAULT NULL,
    email       VARCHAR(120) NOT NULL,
    team_name   VARCHAR(100) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);