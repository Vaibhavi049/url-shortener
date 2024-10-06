<?php
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $long_url = $_POST['long_url'];
    $short_code = createShortUrl($long_url);
}

require 'first.view.php';
?>

