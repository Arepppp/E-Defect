<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload Image</h2>
    <?php if (!empty($error)) : ?>
        <div style="color: red;">
            <p><?= $error ?></p>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('aduan/upload_image') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Select Image:</label><br>
            <input type="file" name="gambarAduan" accept="image/*">
        </div>
        <button type="submit">Upload</button>
    </form>
</body>
</html>