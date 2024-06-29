<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muka Aduan</title>
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
        }

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

        .modal-content {
            background-color: #ffffff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .print-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .print-button:hover {
            background-color: #218838;
        }

        .logout-button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: fixed;
            bottom: 10px;
            right: 10px;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .highlight {
            background-color: #ffcccc;
            /* Light red background color */
        }

        .bg-blue {
            background-color: #007bff !important;
            color: black !important;
        }

        .bg-yellow {
            background-color: #ffc107 !important;
            color: black !important;
        }

        .bg-red {
            background-color: #dc3545 !important;
            color: black !important;
        }

        .bg-green {
            background-color: #28a745 !important;
            color: black !important;
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
        function printReport() {
            window.print();
        }
    </script>
</head>

<body>
    <button class="back-button" onclick="window.location.href='index'">Back</button>
    <h1>LAMAN ADUAN SUPERADMIN</h1>
    <!-- Display all reports in a single line with specified colors -->
    <div class="container-fluid mt-4 d-flex justify-content-center">
        <div class="row w-100 justify-content-center">
            <!-- Total Reports -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index7') ?>">
                    <div class="small-box bg-blue text-center">
                        <div class="inner">
                            <p>Jumlah Aduan Keseluruhan: <?= $this->session->userdata('count_total') ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Reports Today -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index4') ?>">
                    <div class="small-box bg-yellow text-center">
                        <div class="inner">
                            <p>Jumlah Aduan Keseluruhan Hari Ini: <?= $this->session->userdata('count_today') ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Aduan yang belum siap dikemaskini -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index5') ?>">
                    <div class="small-box bg-red text-center">
                        <div class="inner">
                            <p>Jumlah Aduan Belum Siap: <?= $this->session->userdata('count_belum_siap') ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Aduan yang telah siap dikemaskini -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index6') ?>">
                    <div class="small-box bg-green text-center">
                        <div class="inner">
                            <p>Jumlah Aduan Siap: <?= $this->session->userdata('count_siap') ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>No Aduan</th>
                <th>Jenis Aduan</th>
                <th>Tajuk Aduan</th>
                <th>Gambar Aduan</th>
                <th>Keterangan</th>
                <th>Status Aduan</th>
                <th>Tarikh Aduan</th>
                <th>Tarikh Status Dikemaskini</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($aduan as $aduanItem): ?>
            <tbody>
                <tr class="text-center <?= $aduanItem->StatusAduan == 'Sedang Disemak' ? 'highlight' : '' ?>">
                    <td><?= $no++ ?></td>
                    <td><?= $aduanItem->NoAduan ?></td>
                    <td><?= $aduanItem->JenisAduan ?></td>
                    <td><?= $aduanItem->TajukAduan ?></td>
                    <td>
                        <?php
                        if (!empty($aduanItem->GambarAduan)) {
                            $imageData = base64_encode($aduanItem->GambarAduan);
                            $imageFormat = 'jpeg';
                            if (strpos($aduanItem->GambarAduan, '/9j/') === 0) {
                                $imageFormat = 'jpeg';
                            } elseif (strpos($aduanItem->GambarAduan, '/9v/') === 0) {
                                $imageFormat = 'png';
                            }
                            $src = 'data:image/' . $imageFormat . ';base64,' . $imageData;
                            $width = '100px';
                            $height = 'auto';
                            echo '<img src="' . $src . '" alt="Gambar Aduan" width="' . $width . '" height="' . $height . '" />';
                        } else {
                            echo 'No Image';
                        }
                        ?>
                    </td>
                    <td><?= $aduanItem->Keterangan ?></td>
                    <td><?= $aduanItem->StatusAduan ?></td>
                    <td><?= $aduanItem->TarikhAduan ?></td>
                    <td><?= $aduanItem->TarikhStatusDikemaskini ?></td>
                </tr>
            </tbody>
        <?php endforeach ?>
    </table>

    <button class="print-button" onclick="printReport()">Print</button>
    <button class="logout-button" onclick="window.location.href='logout'">Logout</button>
</body>

</html>