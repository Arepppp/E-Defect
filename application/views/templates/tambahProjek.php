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
            padding-top: 40px;
            /* Ensure space for the button at the top */
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
            width: calc(100% - 22px);
            /* Adjusted to account for padding and borders */
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
            z-index: 1000;
            /* Ensure it's above other content */
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
        <button class="back-button btn btn-primary" onclick="window.location.href='index'">Back to Main Page</button>
    </div>
    <form action="<?= base_url('projek/tambah_aksi') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Projek:</label><br>
            <input type="text" name="namaProjek">
            <?= form_error('namaProjek', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <input type="hidden" name="statusProjek" value="Aktif">
            <?= form_error('statusProjek', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Gambar Projek (Sila Masukkan Gambar Projek Jika Ada):</label><br>
            <div class="drag-drop" id="drag-drop-1" ondragover="dragOverHandler(event)"
                ondragleave="dragLeaveHandler(event)" ondrop="dropHandler(event, 'gambarProjek1')">
                Drag and drop a file here or click to select a file
            </div>
            <input type="file" name="gambarProjek1" id="gambarProjek1" accept="image/gif, image/jpeg, image/png"
                class="form-control">
            <?= form_error('gambarProjek1', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Gambar Projek (Sila Masukkan Gambar Projek Jika Ada):</label><br>
            <div class="drag-drop" id="drag-drop-2" ondragover="dragOverHandler(event)"
                ondragleave="dragLeaveHandler(event)" ondrop="dropHandler(event, 'gambarProjek2')">
                Drag and drop a file here or click to select a file
            </div>
            <input type="file" name="gambarProjek2" id="gambarProjek2" accept="image/gif, image/jpeg, image/png"
                class="form-control">
            <?= form_error('gambarProjek2', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Gambar Projek (Sila Masukkan Gambar Projek Jika Ada):</label><br>
            <div class="drag-drop" id="drag-drop-3" ondragover="dragOverHandler(event)"
                ondragleave="dragLeaveHandler(event)" ondrop="dropHandler(event, 'gambarProjek3')">
                Drag and drop a file here or click to select a file
            </div>
            <input type="file" name="gambarProjek3" id="gambarProjek3" accept="image/gif, image/jpeg, image/png"
                class="form-control">
            <?= form_error('gambarProjek3', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Tarikh Mula Waranti:</label><br>
            <input type="date" name="tarikhMulaWaranti">
            <?= form_error('tarikhMulaWaranti', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Tarikh Tamat Waranti:</label><br>
            <input type="date" name="tarikhTamatWaranti">
            <?= form_error('tarikhTamatWaranti', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Juruteknik Projek:</label><br>
            <select name="IdJT" id="IdJT" class="form-control">
                <option value="">Pilih Juruteknik Projek</option>
                <?php foreach ($jt_list as $jt): ?>
                    <option value="<?= $jt['IdJT']; ?>"><?= $jt['NamaPenuhJT']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('IdJT', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Admin Pusat Tanggungjawab Projek:</label><br>
            <select name="IdAPTJ" id="IdAPTJ" class="form-control">
                <option value="">Pilih Admin Pusat Tanggungjawab Projek</option>
                <?php foreach ($aptj_list as $aptj): ?>
                    <option value="<?= $aptj['IdAPTJ']; ?>"><?= $aptj['NamaPenuhAPTJ']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('IdAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Kontraktor Projek:</label><br>
            <select name="IdKontraktor" id="IdKontraktor" class="form-control">
                <option value="">Pilih Kontraktor Projek</option>
                <?php
                // Filter the kontraktor list to include only those with STATUSKONTRAKTOR == 'aktif'
                $filtered_kontraktor_list = array_filter($kontraktor_list, function ($kontraktor) {
                    return $kontraktor['STATUSKONTRAKTOR'] !== 'Tidak Aktif';
                });

                // Iterate over the filtered kontraktor list
                foreach ($filtered_kontraktor_list as $kontraktor):
                    ?>
                    <option value="<?= $kontraktor['IDKONTRAKTOR']; ?>"><?= $kontraktor['NAMASYARIKAT']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('IdKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Perunding Projek 1:</label><br>
            <select name="IdPerunding1" id="IdPerunding1" class="form-control">
                <option value="">Pilih Perunding Projek</option>
                <?php
                // Filter the perunding list to exclude those with STATUSPERUNDING == 'Tidak Aktif'
                $filtered_perunding_list = array_filter($perunding_list, function ($perunding) {
                    return $perunding['STATUSPERUNDING'] !== 'Tidak Aktif';
                });

                // Iterate over the filtered perunding list
                foreach ($filtered_perunding_list as $perunding):
                    ?>
                    <option value="<?= $perunding['IDPERUNDING']; ?>"><?= $perunding['NAMASYARIKAT']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('IdPerunding1', '<div class="text-small text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
            <label>Perunding Projek 2:</label><br>
            <select name="IdPerunding2" id="IdPerunding2" class="form-control">
                <option value="">Pilih Perunding Projek</option>
                <?php
                // Use the same filtered perunding list for consistency
                foreach ($filtered_perunding_list as $perunding):
                    ?>
                    <option value="<?= $perunding['IDPERUNDING']; ?>"><?= $perunding['NAMASYARIKAT']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('IdPerunding2', '<div class="text-small text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
            <label>Perunding Projek 3:</label><br>
            <select name="IdPerunding3" id="IdPerunding3" class="form-control">
                <option value="">Pilih Perunding Projek</option>
                <?php
                // Use the same filtered perunding list for consistency
                foreach ($filtered_perunding_list as $perunding):
                    ?>
                    <option value="<?= $perunding['IDPERUNDING']; ?>"><?= $perunding['NAMASYARIKAT']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('IdPerunding3', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <button type="submit">HANTAR</button>
        <button type="reset">RESET</button>
    </form>
</body>

</html>