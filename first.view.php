<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>URL Shortener</title>
    <link
        rel="stylesheet"
        href="/pico.min.css"
    />
</head>
<body>
    <h1>URL Shortener</h1>
    <form method="post">
        <label for="long_url">Enter Long URL:</label>
        <input type="text" name="long_url" required>
        <button type="submit">Shorten URL</button>
    </form>

    <?php if (isset($short_code)): ?>
        <p>Shortened URL: <a href="link.php?code=<?php echo $short_code; ?>">
            <?php echo "//http://mylink.com/link.php?code=$short_code"; ?></a></p>
    <?php endif; ?>
</body>

</html>
