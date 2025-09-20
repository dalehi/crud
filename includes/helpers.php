<?php


define('DEFAULT_AVATAR', 'avatar.png');
define('BASE_URL','http://localhost/crud/');
define('ABOUT', BASE_URL.'about.php');
define('ADD_ITEM', BASE_URL.'addItem.php');

function getItemImage($foto) {
    $default = DEFAULT_AVATAR;
    $imagePath = "uploads/" . ($foto ?: $default);
    return file_exists($imagePath) ? ($foto ?: $default) : $default;
}


