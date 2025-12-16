 <?php

return "
DROP TABLE IF EXISTS link_user;

CREATE TABLE link_user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_id INT UNSIGNED NOT NULL,
    platform_id INT UNSIGNED NOT NULL,

    username VARCHAR(150) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_user_platform (user_id, platform_id)
);
";