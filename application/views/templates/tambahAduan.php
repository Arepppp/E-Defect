<!DOCTYPE html>
<html>

<head>
    <title>Aduan Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: "Lato", sans-serif;
            background-color: #f8f9fa;
            /* Light background color */
            margin: 0;
            padding: 0;
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
            width: 100%;
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

        .back-button {
            background-color: white;
            color: black;
            padding: 10px 15px;
            border: 1px solid black;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }

        .back-button:hover {
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#jenisKerosakan').change(function () {
                var kodkerosakan = $(this).val();
                if (kodkerosakan != '') {
                    $.ajax({
                        url: "<?= base_url(); ?>aduan/get_details",
                        method: "POST",
                        data: { kodkerosakan: kodkerosakan },
                        dataType: "json",
                        success: function (data) {
                            $('#detailAduan').html('<option value="">Pilih Maklumat Kerosakan</option>');
                            $.each(data, function (key, value) {
                                $('#detailAduan').append('<option value="' + value.KODDETAIL + '">' + value.KETERANGANDETAIL + '</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log('AJAX Error:', error);
                        }
                    });
                } else {
                    $('#detailAduan').html('<option value="">Pilih Maklumat Kerosakan</option>');
                }
            });
        });
    </script>
</head>

<body>
    <button class="back-button" onclick="window.location.href='<?= base_url('adminptj/index') ?>'">Back</button>
    <form action="<?= base_url('aduan/tambah_aksi') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Jenis Kerosakan:</label><br>
            <select name="jenisKerosakan" id="jenisKerosakan" class="form-control">
                <option value="">Pilih Jenis Kerosakan</option>
                <?php foreach ($kerosakan_list as $kerosakan): ?>
                    <option value="<?= $kerosakan['KODKEROSKAN']; ?>"><?= $kerosakan['JENISKEROSAKAN']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('jenisKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Maklumat Kerosakan:</label><br>
            <select name="detailAduan" id="detailAduan" class="form-control">
                <option value="">Pilih Maklumat Kerosakan</option>
            </select>
            <?= form_error('detailAduan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Tajuk Aduan:</label><br>
            <input type="text" name="tajukAduan" class="form-control">
            <?= form_error('tajukAduan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Gambar Aduan:</label><br>
            <div class="drag-drop" id="drag-drop-1" ondragover="dragOverHandler(event)"
                ondragleave="dragLeaveHandler(event)" ondrop="dropHandler(event, 'gambarAduan')">
                Drag and drop a file here or click to select a file
            </div>
            <input type="file" name="gambarAduan" id="gambarAduan" accept="image/gif, image/jpeg, image/png">
            <?= form_error('gambarAduan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>Keterangan:</label><br>
            <input type="text" name="keterangan" class="form-control">
            <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <input type="hidden" name="statusAduan" value="Sedang Disemak">
            <?= form_error('statusAduan', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
        <div class="form-group">
            <label>No Projek:</label><br>
            <input type="text" name="NoProjek" value="<?= $this->input->get('NoProjek') ?>" readonly>
        </div>
        <button type="submit">HANTAR</button>
        <button type="reset">RESET</button>
    </form>
</body>