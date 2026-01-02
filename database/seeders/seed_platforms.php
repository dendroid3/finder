<?php
// migrations/PlatformsSeeder.php

return <<<SQL
INSERT INTO platforms (title, url, icon_url) VALUES
('Facebook', 'https://www.facebook.com', 'https://www.facebook.com/favicon.ico'),
('Instagram', 'https://www.instagram.com', 'https://www.instagram.com/favicon.ico'),
('Twitter', 'https://www.twitter.com', 'https://www.twitter.com/favicon.ico'),
('TikTok', 'https://www.tiktok.com', 'https://www.tiktok.com/favicon.ico'),
('Snapchat', 'https://www.snapchat.com', 'https://www.snapchat.com/favicon.ico'),
('YouTube', 'https://www.youtube.com', 'https://www.youtube.com/favicon.ico'),
('LinkedIn', 'https://www.linkedin.com', 'https://www.linkedin.com/favicon.ico'),
('Pinterest', 'https://www.pinterest.com', 'https://www.pinterest.com/favicon.ico'),
('Reddit', 'https://www.reddit.com', 'https://www.reddit.com/favicon.ico'),
('OnlyFans', 'https://www.onlyfans.com', 'https://onlyfans.com/favicon.ico')
ON DUPLICATE KEY UPDATE title=VALUES(title), icon_url=VALUES(icon_url);
SQL;
