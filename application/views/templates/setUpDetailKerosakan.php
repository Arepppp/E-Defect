<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Up Detail Kerosakan</title>
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
    <h1>SETUP DETAIL KEROSAKAN</h1>
    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Jenis Kerosakan</th>
                <th>Detail Kerosakan</th>
                <th>Kod Kerosakan</th>
                <th>Kemaskini</th>
                <th>Padam</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($detail_list as $list_kerosakan):
            foreach ($kerosakan_list as $kerosakan):
                if ($list_kerosakan['KODKEROSAKAN'] == $kerosakan['KODKEROSKAN']):
                    $jeniskerosakan = $kerosakan['JENISKEROSAKAN'];
                    break; // Exit the loop once a match is found
                endif;
            endforeach; ?>
            <tbody>
                <tr class="text-center">
                    <td><?= $no++ ?></td>

                    <td><?= $jeniskerosakan ?></td>
                    <td><?= $list_kerosakan['KODDETAIL'] ?></td>
                    <td><?= $list_kerosakan['KETERANGANDETAIL'] ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#edit<?= $list_kerosakan['KODDETAIL'] ?>"
                            class="btn btn-primary">
                            Kemaskini
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/deleteDetail/' . $list_kerosakan['KODDETAIL']) ?>" method="post"
                            onsubmit="return confirm('Adakah anda ingin membuang data ini?')">
                            <button type="submit" class="btn btn-danger">Padam</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

    <button data-toggle="modal" data-target="#tambah<?= $list_kerosakan['KODDETAIL'] ?>" class="btn btn-primary">
        Tambah Detail Kerosakan
    </button>

    <!-- Modal -->
    <?php foreach ($detail_list as $list_kerosakan):
        // Find the corresponding 'JENISKEROSAKAN' for the current 'list_kerosakan'
        $jeniskerosakan = '';
        foreach ($kerosakan_list as $kerosakan):
            if ($list_kerosakan['KODKEROSAKAN'] == $kerosakan['KODKEROSKAN']):
                $jeniskerosakan = $kerosakan['JENISKEROSAKAN'];
                break; // Exit the loop once a match is found
            endif;
        endforeach; ?>
        <div class="modal fade" id="edit<?= $list_kerosakan['KODDETAIL'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/editDetail/' . $list_kerosakan['KODDETAIL']) ?>" method="POST">
                            <div class="form-group">
                                <label>Detail Kerosakan:</label><br>
                                <input type="text" name="detailKerosakan" class="form-control"
                                    value="<?= $list_kerosakan['KETERANGANDETAIL'] ?>">
                                <?= form_error('detailKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kerosakan:</label><br>
                                <select name="kodKerosakan" class="form-control">
                                    <?php foreach ($kerosakan_list as $kerosakan): ?>
                                        <option value="<?= $kerosakan['KODKEROSKAN'] ?>"
                                            <?= $list_kerosakan['KODKEROSAKAN'] == $kerosakan['KODKEROSKAN'] ? 'selected' : '' ?>>
                                            <?= $kerosakan['JENISKEROSAKAN'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kodKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
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

    <?php foreach ($detail_list as $list_kerosakan):
        // Find the corresponding 'JENISKEROSAKAN' for the current 'list_kerosakan'
        $jeniskerosakan = '';
        foreach ($kerosakan_list as $kerosakan):
            if ($list_kerosakan['KODKEROSAKAN'] == $kerosakan['KODKEROSKAN']):
                $jeniskerosakan = $kerosakan['JENISKEROSAKAN'];
                break; // Exit the loop once a match is found
            endif;
        endforeach; ?>
        <div class="modal fade" id="tambah<?= $list_kerosakan['KODDETAIL'] ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/tambahDetail/' . $list_kerosakan['KODDETAIL']) ?>" method="POST">
                            <div class="form-group">
                                <label>Detail Kerosakan:</label><br>
                                <input type="text" name="detailKerosakan" class="form-control">
                                <?= form_error('detailKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kerosakan:</label><br>
                                <select name="kodKerosakan" class="form-control">
                                    <?php foreach ($kerosakan_list as $kerosakan): ?>
                                        <option value="<?= $kerosakan['KODKEROSKAN'] ?>"
                                            <?= $list_kerosakan['KODKEROSAKAN'] == $kerosakan['KODKEROSKAN'] ? 'selected' : '' ?>>
                                            <?= $kerosakan['JENISKEROSAKAN'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kodKerosakan', '<div class="text-small text-danger">', '</div>'); ?>
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