<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Up Superadmin</title>
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
    <h1>SETUP SUPERADMIN</h1>
    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>ID Superadmin</th>
                <th>Nama Penuh Superadmin</th>
                <th>No Kad Pengenalan Superadmin</th>
                <th>No Telefon Superadmin</th>
                <th>Emel Superadmin</th>
                <th>Kemaskini</th>
                <th>Padam</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($sa_list as $sa): ?>
            <tbody>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $sa['IdSA'] ?></td>
                    <td><?= $sa['NamaPenuhSA'] ?></td>
                    <td><?= $sa['NoKP_SA'] ?></td>
                    <td><?= $sa['NoTelSA'] ?></td>
                    <td><?= $sa['EmelSA'] ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#edit<?= $sa['IdSA']?>"
                            class="btn btn-primary">
                            Kemaskini
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/deleteSA/' . $sa['IdSA']) ?>" method="post"
                            onsubmit="return confirm('Adakah anda ingin membuang data ini?')">
                            <button type="submit">Padam</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

    <!-- Modal -->
    <?php foreach ($sa_list as $sa): ?>
        <div class="modal fade" id="edit<?= $sa['IdSA'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/editSA/' . $sa['IdSA']) ?>" method="POST">
                            <div class="form-group">
                                <label>Nama Penuh Superadmin:</label><br>
                                <input type="text" name="namaPenuhSA" class="form-control"
                                    value="<?= $sa['NamaPenuhSA'] ?>">
                                <?= form_error('namaPenuhSA', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Kad Pengenalan Superadmin:</label><br>
                                <input type="text" name="noKPSA" class="form-control"
                                    value="<?= $sa['NoKP_SA'] ?>">
                                <?= form_error('noKPSA', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>No Telefon Superadmin:</label><br>
                                <input type="text" name="noTelSA" class="form-control"
                                    value="<?= $sa['NoTelSA'] ?>">
                                <?= form_error('noTelSA', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Emel Superadmin:</label><br>
                                <input type="text" name="emelSA" class="form-control"
                                    value="<?= $sa['EmelSA'] ?>">
                                <?= form_error('emelSA', '<div class="text-small text-danger">', '</div>'); ?>
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