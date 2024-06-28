<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Up Admin Pusat Tanggungjawab</title>
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
    </style>
</head>

<body>
    <h1>SETUP ADMIN PUSAT TANGGUNGJAWAB</h1>
    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>ID Admin PTJ</th>
                <th>Nama Penuh Admin PTJ</th>
                <th>No Kad Pengenalan Admin PTJ</th>
                <th>No Telefon Admin PTJ</th>
                <th>Emel Admin PTJ</th>
                <th>Kemaskini</th>
                <th>Padam</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($aptj_list as $aptj): ?>
            <tbody>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $aptj['IdAPTJ'] ?></td>
                    <td><?= $aptj['NamaPenuhAPTJ'] ?></td>
                    <td><?= $aptj['NoKP_APTJ'] ?></td>
                    <td><?= $aptj['NoTelAPTJ'] ?></td>
                    <td><?= $aptj['EmelAPTJ'] ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#edit<?= $aptj['IdAPTJ'] ?>" class="btn btn-primary">
                            Kemaskini
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/deleteAPTJ/' . $aptj['IdAPTJ']) ?>" method="post"
                            onsubmit="return confirm('Adakah anda ingin membuang data ini?')">
                            <button type="submit">Padam</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

    <button data-toggle="modal" data-target="#tambah<?= $aptj['IdAPTJ'] ?>" class="btn btn-primary">
        Tambah Admin Pusat Tanggungjawab
    </button>

    <!-- Modal -->
    <?php foreach ($aptj_list as $aptj): ?>
        <div class="modal fade" id="edit<?= $aptj['IdAPTJ'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/editAPTJ/' . $aptj['IdAPTJ']) ?>" method="POST">
                            <div class="form-group">
                                <label>Nama Penuh Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="namaPenuhAPTJ" class="form-control"
                                    value="<?= $aptj['NamaPenuhAPTJ'] ?>">
                                <?= form_error('namaPenuhAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Kad Pengenalan Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="noKPAPTJ" class="form-control" value="<?= $aptj['NoKP_APTJ'] ?>">
                                <?= form_error('noKPAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Telefon Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="noTelAPTJ" class="form-control" value="<?= $aptj['NoTelAPTJ'] ?>">
                                <?= form_error('noTelAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Emel Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="emelAPTJ" class="form-control" value="<?= $aptj['EmelAPTJ'] ?>">
                                <?= form_error('emelAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
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


    <?php foreach ($aptj_list as $aptj): ?>
        <div class="modal fade" id="tambah<?= $aptj['IdAPTJ'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/tambah_APTJ/' . $aptj['IdAPTJ']) ?>" method="POST">
                            <div class="form-group">
                                <label>Nama Penuh Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="namaPenuhAPTJ" class="form-control">
                                <?= form_error('namaPenuhAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Kad Pengenalan Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="noKPAPTJ" class="form-control">
                                <?= form_error('noKPAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Telefon Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="noTelAPTJ" class="form-control" >
                                <?= form_error('noTelAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Emel Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="emelAPTJ" class="form-control">
                                <?= form_error('emelAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
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