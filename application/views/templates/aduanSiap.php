<!DOCTYPE html>
<html>

<head>
    <title>Project Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
        body {
            font-family: "Lato", sans-serif;
            background-color: #f8f9fa;
            /* Light background color */
            margin: 0;
            padding: 0;
            position: relative;
            padding-top: 40px; /* Ensure space for the button at the top */
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #007bff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 15px 15px 15px 32px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
            transition: 0.3s;
            border-bottom: 1px solid #444;
        }

        .sidenav a:last-child {
            border-bottom: none;
        }

        .sidenav a:hover {
            background-color: #0056b3;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 30px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        form {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="date"],
        select,
        input[type="file"] {
            width: calc(100% - 22px); /* Adjusted to account for padding and borders */
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="file"] {
            cursor: pointer;
        }

        button[type="submit"],
        button[type="reset"] {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="submit"]:hover,
        button[type="reset"]:hover {
            background-color: #0056b3;
        }

        .drag-drop {
            border: 2px dashed #007bff;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            color: #007bff;
            margin-bottom: 15px;
        }

        .drag-drop.dragover {
            background-color: #e9f7ff;
        }

        button.back-button {
            background-color: white;
            color: black;
            padding: 10px 15px;
            border: 1px solid black;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000; /* Ensure it's above other content */
        }

        button.back-button:hover {
            background-color: #000000;
            color: white;
            border-color: #000000;
        }
    </style>
    <script>
        function dragOverHandler(ev) {
            ev.preventDefault();
            ev.stopPropagation();
            ev.currentTarget.classList.add('dragover');
        }

        function dragLeaveHandler(ev) {
            ev.preventDefault();
            ev.stopPropagation();
            ev.currentTarget.classList.remove('dragover');
        }

        function dropHandler(ev, inputId) {
            ev.preventDefault();
            ev.stopPropagation();
            ev.currentTarget.classList.remove('dragover');

            var files = ev.dataTransfer.files;
            document.getElementById(inputId).files = files;
        }
    </script>
</head>

<body>
    <div class="back-button-container">
        <button class="back-button btn btn-primary" onclick="window.location.href='http://localhost:8080/e-DefectTest/juruteknik/index'">Back to Main Page</button>
    </div>
    <form action="<?= base_url('aduan/aduanSiap_aksi') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nombor Aduan:</label><br>
            <input type="text" name="noAduan" value="<?= $this->input->get('NoAduan') ?>" readonly>
            <?= form_error('noAduan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Gambar Aduan yang Siap Dibaiki:</label><br>
            <div class="drag-drop" id="drag-drop-1" ondragover="dragOverHandler(event)"
                ondragleave="dragLeaveHandler(event)" ondrop="dropHandler(event, 'gambarProjek1')">
                Drag and drop a file here or click to select a file
            </div>
            <input type="file" name="GAMBAR_ADUAN_SIAP" id="GAMBAR_ADUAN_SIAP" accept="image/gif, image/jpeg, image/png"
                class="form-control">
            <?= form_error('GAMBAR_ADUAN_SIAP', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Tarikh Panggil Kontraktor:</label><br>
            <input type="date" name="TARIKH_PANGGIL_KONTRAKTOR">
            <?= form_error('TARIKH_PANGGIL_KONTRAKTOR', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Tarikh Siap Baiki:</label><br>
            <input type="date" name="TARIKH_SIAP_BAIKI">
            <?= form_error('TARIKH_SIAP_BAIKI', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Komen Juruteknik:</label><br>
            <input type="text" name="KOMEN_JT">
            <?= form_error('KOMEN_JT', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Komen Kontraktor:</label><br>
            <input type="text" name="KOMEN_KONTRAKTOR">
            <?= form_error('KOMEN_KONTRAKTOR', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <button type="submit">HANTAR</button>
        <button type="reset">RESET</button>
    </form>
</body>

</html>