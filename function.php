<?php

function connectDb() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=urls', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function createShortUrl($long_url) {
    $pdo = connectDb();

    // Check if the long URL already exists
    $query = "SELECT short_code FROM urls WHERE long_url = :long_url";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['long_url' => $long_url]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If it exists, return the existing short code
    if ($existing) {
        return $existing['short_code'];
    }

    // Create a new short code if it doesn't exist
    $short_code = substr(md5($long_url . time()), 0, 6); // Create a short code
    $query = "INSERT INTO urls (long_url, short_code) VALUES (:long_url, :short_code)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['long_url' => $long_url, 'short_code' => $short_code]);
    return $short_code;
}

function getLongUrl($short_code) {
    $pdo = connectDb();
    $query = "SELECT long_url, click_count FROM urls WHERE short_code = :short_code";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['short_code' => $short_code]);
    $url_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($url_data) {
        updateClickCount($short_code, $url_data['click_count']);
        return $url_data['long_url'];
    }
    return null;
}

function updateClickCount($short_code, $current_count) {
    $pdo = connectDb();
    $new_count = $current_count + 1;
    $query = "UPDATE urls SET click_count = :click_count WHERE short_code = :short_code";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['click_count' => $new_count, 'short_code' => $short_code]);
}
