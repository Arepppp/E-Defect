<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uploaded Image</title>
</head>
<body>
    <h2>Uploaded Image</h2>
    <?php if (!empty($image_url)) : ?>
        <img src="<?= $image_url ?>" alt="Uploaded Image">
    <?php else : ?>
        <p>No image uploaded.</p>
    <?php endif; ?>
</body>
</html>
