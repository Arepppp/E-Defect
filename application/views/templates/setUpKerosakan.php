<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Up Kerosakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
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
    <h1>SETUP KEROSAKAN</h1>
    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Kod Kerosakan</th>
                <th>Jenis Kerosakan</th>
                <th>Kemaskini</th>
                <th>Padam</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($kerosakan_list as $kerosakan): ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $kerosakan['KODKEROSKAN'] ?></td>
                    <td><?= $kerosakan['JENISKEROSAKAN'] ?></td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#edit<?= $kerosakan['KODKEROSKAN'] ?>"
                            class="btn btn-primary">
                            Kemaskini
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/deleteKerosakan/' . $kerosakan['KODKEROSKAN']) ?>" method="post"
                            onsubmit="return confirm('Adakah anda ingin membuang data ini?')">
                            <button type="submit" class="btn btn-danger">Padam</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="tambah-projek-button" onclick="window.location.href='setupDetailKerosakan'">
        Setup Detail Kerosakan
    </button>

    <br>

    <!-- Add New Damage Modal Button -->
    <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary">
        Tambah Kerosakan
    </button>

    <!-- Modal for Adding New Damage -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahLabel">Tambah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('projek/tambahKerosakan') ?>" method="POST">
                        <div class="form-group">
                            <label>Jenis Kerosakan:</label><br>
                            <input type="text" name="jenisKerosakan" class="form-control">
                            <?= form_error('jenisKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <!-- Add other form fields as needed -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">HANTAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for Editing Damage -->
    <?php foreach ($kerosakan_list as $kerosakan): ?>
        <div class="modal fade" id="edit<?= $kerosakan['KODKEROSKAN'] ?>" tabindex="-1"
            aria-labelledby="editLabel<?= $kerosakan['KODKEROSKAN'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel<?= $kerosakan['KODKEROSKAN'] ?>">Kemaskini data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/editKerosakan/' . $kerosakan['KODKEROSKAN']) ?>" method="POST">
                            <div class="form-group">
                                <label>Jenis Kerosakan:</label><br>
                                <input type="text" name="jenisKerosakan" class="form-control"
                                    value="<?= $kerosakan['JENISKEROSAKAN'] ?>">
                                <?= form_error('jenisKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <!-- Add other form fields as needed -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">HANTAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</body>

</html>