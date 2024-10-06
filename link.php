<?php
require 'function.php';

if (isset($_GET['code'])) {
    $short_code = $_GET['code'];
    $long_url = getLongUrl($short_code);
    if ($long_url) {
        header("Location: $long_url");
        exit();
    } else {
        echo "URL not found!";
    }
} else {
    echo "No code provided!";
}
