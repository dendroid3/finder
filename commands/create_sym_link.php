<?php
echo __DIR__;
$target = __DIR__ . '/../storage/profile_pictures';
$link   = __DIR__ . '/../public/profile_pictures';

if (!file_exists($link)) {
    if (symlink($target, $link)) {
        echo "Symlink created successfully";
    } else {
        echo "Failed to create symlink";
    }
}
