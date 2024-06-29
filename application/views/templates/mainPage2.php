<?= $this->session?->flashdata('pesan'); ?>
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

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
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
    </style>
    <script>
        function printReport() {
            window.print();
        }

        function confirmAndRedirect(url) {
            if (confirm('Adakah aduan telah siap?')) {
                window.location.href = url;
            }
        }

        function confirmAndRedirect2(url) {
            if (confirm('Adakah anda ingin membatal aduan ini?')) {
                window.location.href = url;
            }
        }
    </script>
</head>

<body>
    <h1>LAMAN ADUAN JURUTEKNIK</h1>
    <div class="container-fluid mt-4 d-flex justify-content-center">
        <div class="row w-100 justify-content-center">
            <!-- Total Reports -->
            <div class="col-lg-3 col-6">
                <a href="<?= base_url('juruteknik/index') ?>">
                    <div class="small-box bg-blue text-center">
                        <div class="inner">
                            <p>Jumlah Aduan: <?= $this->session->userdata('count_total') ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Reports Today -->
            <div class="col-lg-3 col-6">
                <a href="<?= base_url('juruteknik/index2') ?>">
                    <div class="small-box bg-yellow text-center">
                        <div class="inner">
                            <p>Jumlah Aduan Hari Ini: <?= $this->session->userdata('count_today') ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Aduan yang belum siap dikemaskini -->
            <div class="col-lg-3 col-6">
                <a href="<?= base_url('juruteknik/index3') ?>">
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
                <a href="<?= base_url('juruteknik/index4') ?>">
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

    <!-- Table Section -->
    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>NoProjek</th>
                <th>NamaProjek</th>
                <th>StatusProjek</th>
                <th>TarikhMulaWaranti</th>
                <th>TarikhTamatWaranti</th>
                <th>Maklumat Lanjut</th>
            </tr>
        </thead>
        <?php $no = 1;
        foreach ($projek as $projekItem): ?>
            <tbody>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $projekItem->NoProjek ?></td>
                    <td><?= $projekItem->NamaProjek ?></td>
                    <td><?= $projekItem->StatusProjek ?></td>
                    <td><?= $projekItem->TarikhMulaWaranti ?></td>
                    <td><?= $projekItem->TarikhTamatWaranti ?></td>
                    <td>
                        <form action="<?= base_url('projek/lihat_projek2') ?>" method="get">
                            <input type="hidden" name="NoProjek" value="<?= $projekItem->NoProjek ?>">
                            <input type="hidden" name="IdJT" value="<?= $projekItem->IdJT ?>">
                            <input type="hidden" name="IdAPTJ" value="<?= $projekItem->IdAPTJ ?>">
                            <input type="hidden" name="IdKontraktor" value="<?= $projekItem->IDKONTRAKTOR ?>">
                            <input type="hidden" name="IdPerunding1" value="<?= $projekItem->IDPERUNDING1 ?>">
                            <input type="hidden" name="IdPerunding2" value="<?= $projekItem->IDPERUNDING2 ?>">
                            <input type="hidden" name="IdPerunding3" value="<?= $projekItem->IDPERUNDING3 ?>">
                            <button type="submit">Maklumat Lanjut</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach ?>
    </table>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Projek</th>
                <th>Jenis Aduan</th>
                <th>Jenis Kerosakan</th>
                <th>Tajuk Aduan</th>
                <th>Gambar Aduan</th>
                <th>Keterangan</th>
                <th>Status Aduan</th>
                <th>Tarikh Aduan</th>
                <th>Tarikh Status Dikemaskini</th>
                <th>Maklumat Aduan</th>
                <th>Kemaskini</th>
                <th>Batal Aduan</th>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($aduan as $aduanItem):
            $namaProjek = 'Unknown Project';
            foreach ($projek as $projekItem):
                if ($aduanItem->NoProjek == $projekItem->NoProjek):
                    $namaProjek = $projekItem->NamaProjek;
                    break; // Exit the loop once a match is found
                endif;
            endforeach;
            $jenisKerosakan = $this->aduan_model->getJenisKerosakanName($aduanItem->KODKEROSKAN);
            $keteranganDetail = $this->aduan_model->getKeteranganDetailName($aduanItem->KODDETAIL);
            ?>
            <tbody>
                <tr class="text-center <?= $aduanItem->StatusAduan == 'Sedang Disemak' ? 'highlight' : '' ?>">
                    <td><?= $no++ ?></td>
                    <td><?= $namaProjek ?></td>
                    <td><?= $jenisKerosakan ?></td>
                    <td><?= $keteranganDetail ?></td>
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
                    <td>
                        <form action="<?= base_url('aduan/lihat_aduan') ?>" method="get">
                            <input type="hidden" name="NoAduan" value="<?= $aduanItem->NoAduan ?>">
                            <button type="submit">Laporan Aduan</button>
                        </form>
                    </td>
                    <td><button data-toggle="modal" data-target="#edit<?= $aduanItem->NoAduan ?>">Kemaskini</button></td>
                    <td>
                        <button
                            onclick="confirmAndRedirect2('<?= site_url('aduan/batal_Aduan?NoAduan=' . urlencode($aduanItem->NoAduan)) ?>')"
                            class="btn btn-primary">
                            BATAL ADUAN
                        </button>
                    </td>
                </tr>
            </tbody>
            <?php
        endforeach ?>
    </table>

    <!-- Modal -->
    <?php foreach ($aduan as $aduanItem):
        $jenisKerosakan = $this->aduan_model->getJenisKerosakanName($aduanItem->KODKEROSKAN);
        $keteranganDetail = $this->aduan_model->getKeteranganDetailName($aduanItem->KODDETAIL); ?>
        <div class="modal fade" id="edit<?= $aduanItem->NoAduan ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('aduan/edit/' . $aduanItem->NoAduan) ?>" method="POST">
                            <div class="form-group">
                                <label>No Aduan:</label><br>
                                <input type="text" name="noAduan" class="form-control" value="<?= $aduanItem->NoAduan ?>">
                            </div>
                            <div class="form-group">
                                <label>Status Aduan:</label><br>
                                <select name="statusAduan" class="form-control">
                                    <option value="Sedang Disemak" <?= $aduanItem->StatusAduan == 'Sedang Disemak' ? 'selected' : '' ?>>Sedang Disemak</option>
                                    <option value="Aduan Disahkan" <?= $aduanItem->StatusAduan == 'Aduan Disahkan' ? 'selected' : '' ?>>Aduan Disahkan</option>
                                    <option value="Sedang Dibaiki" <?= $aduanItem->StatusAduan == 'Sedang Dibaiki' ? 'selected' : '' ?>>Sedang Dibaiki</option>
                                </select>
                                <?= form_error('statusAduan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>

                            <div class="modal-footer">
                                <button type="submit">HANTAR</button>
                            </div>
                        </form>
                        <button
                            onclick="confirmAndRedirect('<?= site_url('projek/aduanSiap?NoAduan=' . urlencode($aduanItem->NoAduan)) ?>')"
                            class="btn btn-primary">
                            ADUAN SIAP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <form action="<?= base_url('projek/logout'); ?>" method="post" style="display: inline;">
        <button type="submit" class="logout-button">Logout</button>
    </form>
    <button class="print-button" onclick="printReport()">Print Page</button>
</body>

</html>