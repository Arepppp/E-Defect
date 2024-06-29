<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Up Kontraktor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        h1 {
            text-align: center;
        }

        body {
            font-family: "Lato", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Table Styles */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Button Styles */
        .tambah-projek-button-container {
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .tambah-projek-button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            background-color: #007bff;
            color: #ffffff;
            display: flex;
            text-align: center;
            align-items: center;
        }

        .tambah-projek-button:hover {
            background-color: #0056b3;
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
</head>

<body>
    <button class="back-button" onclick="window.location.href='index'">Back</button>
    <h1>SETUP KONTRAKTOR</h1>
    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>ID Kontraktor</th>
                <th>Nama Syarikat</th>
                <th>Alamat</th>
                <th>No Telefon Kontraktor</th>
                <th>No Faks Kontraktor</th>
                <th>Emel Kontraktor</th>
                <th>Status Kontraktor</th>
                <th>Kemaskini</th>
                <th>Padam</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($kontraktor_list as $kontraktor): ?>
            <tbody>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $kontraktor['IDKONTRAKTOR'] ?></td>
                    <td><?= $kontraktor['NAMASYARIKAT'] ?></td>
                    <td><?= $kontraktor['ALAMAT'] ?></td>
                    <td><?= $kontraktor['NOTELKONTRAKTOR'] ?></td>
                    <td><?= $kontraktor['NOFAKSKONTRAKTOR'] ?></td>
                    <td><?= $kontraktor['EMELKONTRAKTOR'] ?></td>
                    <td><?= $kontraktor['STATUSKONTRAKTOR'] ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#edit<?= $kontraktor['IDKONTRAKTOR'] ?>"
                            class="btn btn-primary">
                            Kemaskini
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/deleteKontraktor/' . $kontraktor['IDKONTRAKTOR']) ?>"
                            method="post" onsubmit="return confirm('Adakah anda ingin membuang data ini?')">
                            <button type="submit" class="btn btn-danger">Padam</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

    <button data-toggle="modal" data-target="#tambah<?= $kontraktor['IDKONTRAKTOR'] ?>" class="btn btn-primary">
        Tambah Kontraktor
    </button>

    <!-- Modal -->
    <?php foreach ($kontraktor_list as $kontraktor): ?>
        <div class="modal fade" id="edit<?= $kontraktor['IDKONTRAKTOR'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/editKontraktor/' . $kontraktor['IDKONTRAKTOR']) ?>"
                            method="POST">
                            <div class="form-group">
                                <label>Nama Syarikat:</label><br>
                                <input type="text" name="namaSyarikat" class="form-control"
                                    value="<?= $kontraktor['NAMASYARIKAT'] ?>">
                                <?= form_error('namaSyarikat', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Alamat:</label><br>
                                <input type="text" name="alamat" class="form-control" value="<?= $kontraktor['ALAMAT'] ?>">
                                <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Telefon Kontraktor:</label><br>
                                <input type="text" name="noTelKontraktor" class="form-control"
                                    value="<?= $kontraktor['NOTELKONTRAKTOR'] ?>">
                                <?= form_error('noTelKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Faks Kontraktor:</label><br>
                                <input type="text" name="noFaksKontraktor" class="form-control"
                                    value="<?= $kontraktor['NOFAKSKONTRAKTOR'] ?>">
                                <?= form_error('noFaksKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Emel Kontraktor:</label><br>
                                <input type="text" name="emelKontraktor" class="form-control"
                                    value="<?= $kontraktor['EMELKONTRAKTOR'] ?>">
                                <?= form_error('emelKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Status Kontraktor:</label><br>
                                <select name="statusKontraktor" class="form-control">
                                    <option value="Aktif" <?= trim(strtolower($kontraktor['STATUSKONTRAKTOR'])) == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?= trim(strtolower($kontraktor['STATUSKONTRAKTOR'])) == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                </select>
                                <?= form_error('statusKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>

                            <!-- Add other form fields as needed -->
                            <div class="modal-footer">
                                <button type="submit">HANTAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <?php foreach ($kontraktor_list as $kontraktor): ?>
        <div class="modal fade" id="tambah<?= $kontraktor['IDKONTRAKTOR'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/tambahKontraktor/' . $kontraktor['IDKONTRAKTOR']) ?>"
                            method="POST">
                            <div class="form-group">
                                <label>Nama Syarikat:</label><br>
                                <input type="text" name="namaSyarikat" class="form-control">
                                <?= form_error('namaSyarikat', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Alamat:</label><br>
                                <input type="text" name="alamat" class="form-control">
                                <?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Telefon Kontraktor:</label><br>
                                <input type="text" name="noTelKontraktor" class="form-control">
                                <?= form_error('noTelKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Faks Kontraktor:</label><br>
                                <input type="text" name="noFaksKontraktor" class="form-control">
                                <?= form_error('noFaksKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Emel Kontraktor:</label><br>
                                <input type="text" name="emelKontraktor" class="form-control">
                                <?= form_error('emelKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Status Kontraktor:</label><br>
                                <select name="statusKontraktor" class="form-control">
                                    <option value="Aktif" <?= trim(strtolower($kontraktor['STATUSKONTRAKTOR'])) == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?= trim(strtolower($kontraktor['STATUSKONTRAKTOR'])) == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                </select>
                                <?= form_error('statusKontraktor', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>

                            <!-- Add other form fields as needed -->
                            <div class="modal-footer">
                                <button type="submit">HANTAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</body>

</html>