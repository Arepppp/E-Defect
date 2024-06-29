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
            /* Set a light background color */
            margin: 0;
            /* Remove default margin */
            padding: 0;
        }

        /* Table Styles */
        table {
            width: 80%;
            margin: 20px auto;
            /* Center the table on the page */
            border-collapse: collapse;
            background-color: #ffffff;
            /* White background for the table */
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #dddddd;
            /* Light gray border */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            /* Light gray background for table header */
        }

        /* Modal Styles */
        .modal-content {
            background-color: #ffffff;
            /* White background for the modal content */
        }

        /* Form Styles */
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

        /* Button Styles */
        button {
            background-color: #007bff;
            /* Bootstrap primary color */
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
        }

        .tambah-aduan-button-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .tambah-aduan-button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
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
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Update detailAduan when jenisKerosakan changes
            $(document).on('change', '[id^=jenisKerosakan]', function () {
                var kodkerosakan = $(this).val();
                var modalId = $(this).attr('id');
                var detailAduanId = modalId.replace('jenisKerosakan', 'detailAduan');

                if (kodkerosakan != '') {
                    $.ajax({
                        url: "<?= base_url(); ?>aduan/get_details",
                        method: "POST",
                        data: { kodkerosakan: kodkerosakan },
                        dataType: "json",
                        success: function (data) {
                            $('#' + detailAduanId).html('<option value="">Pilih Maklumat Kerosakan</option>');
                            $.each(data, function (key, value) {
                                $('#' + detailAduanId).append('<option value="' + value.KODDETAIL + '">' + value.KETERANGANDETAIL + '</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log('AJAX Error:', error);
                        }
                    });
                } else {
                    $('#' + detailAduanId).html('<option value="">Pilih Maklumat Kerosakan</option>');
                }
            });
        });
    </script>

</head>

<body>
    <h1>LAMAN ADUAN ADMIN PUSAT TANGGUNGJAWAB</h1>
    <!-- Total Reports -->
    <div class="container-fluid mt-4 d-flex justify-content-center">
        <div class="row w-100 justify-content-center">
            <!-- Total Reports -->
            <div class="col-lg-3 col-6">
                <a href="<?= base_url('adminptj/index') ?>">
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
                <a href="<?= base_url('adminptj/index2') ?>">
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
                <a href="<?= base_url('adminptj/index3') ?>">
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
                <a href="<?= base_url('adminptj/index4') ?>">
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

    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>No Projek</th>
                <th>Nama Projek</th>
                <th>Status Projek</th>
                <th>TarikhMulaWaranti</th>
                <th>TarikhTamatWaranti</th>
                <th>Tambah Aduan</th>
                <th>Maklumat Lanjut</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($projek as $projekItem): ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $projekItem->NoProjek ?></td>
                    <td><?= $projekItem->NamaProjek ?></td>
                    <td><?= $projekItem->StatusProjek ?></td>
                    <td><?= $projekItem->TarikhMulaWaranti ?></td>
                    <td><?= $projekItem->TarikhTamatWaranti ?></td>
                    <td>
                        <button class="tambah-aduan-button btn btn-primary"
                            onclick="window.location.href='http://localhost:8080/e-DefectTest/aduan/tambah?NoProjek=<?= $projekItem->NoProjek ?>'"
                            <?php if ($projekItem->StatusProjek == 'Tamat Tempoh Waranti' || $projekItem->StatusProjek == 'Projek Batal')
                                echo 'disabled'; ?>>
                            Tambah Aduan
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/lihat_projek3') ?>" method="get">
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
            <?php endforeach ?>
        </tbody>
    </table>



    <h2 class="text-center mt-4">Aduan Baru</h2>
    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Projek</th>
                <th>No Aduan</th>
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
                <th>Padam</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($aduan as $aduanItem):
                if ($aduanItem->StatusAduan == 'Sedang Disemak'):
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
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $namaProjek ?></td>
                        <td><?= $aduanItem->NoAduan ?></td>
                        <td><?= $jenisKerosakan ?></td>
                        <td><?= $keteranganDetail ?></td>
                        <td><?= $aduanItem->TajukAduan ?></td>
                        <td>
                            <?php
                            if (!empty($aduanItem->GambarAduan)) {
                                $imageData = base64_encode($aduanItem->GambarAduan);
                                $imageFormat = 'jpeg'; // default to JPEG
                                if (strpos($aduanItem->GambarAduan, '/9j/') === 0) {
                                    $imageFormat = 'jpeg'; // JPEG format marker
                                } elseif (strpos($aduanItem->GambarAduan, '/9v/') === 0) {
                                    $imageFormat = 'png'; // PNG format marker
                                }
                                $src = 'data:image/' . $imageFormat . ';base64,' . $imageData;
                                $width = '100px';
                                $height = 'auto'; // Maintain aspect ratio
                    
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
                            <form action="<?= base_url('aduan/lihat_aduan2') ?>" method="get">
                                <input type="hidden" name="NoAduan" value="<?= $aduanItem->NoAduan ?>">
                                <button type="submit">Laporan Aduan</button>
                            </form>
                        </td>
                        <td><button data-toggle="modal" data-target="#edit<?= $aduanItem->NoAduan ?>">Kemaskini</button></td>
                        <td>
                            <form action="<?= base_url('aduan/delete2/' . $aduanItem->NoAduan) ?>" method="post"
                                onsubmit="return confirm('Adakah anda ingin membuang data ini?')">
                                <button type="submit">Padam</button>
                            </form>
                        </td>
                    </tr>
                <?php endif;
            endforeach; ?>
        </tbody>
    </table>


    <h2 class="text-center mt-4">Aduan Telah Disahkan</h2>
    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Projek</th>
                <th>No Aduan</th>
                <th>Jenis Aduan</th>
                <th>Jenis Kerosakan</th>
                <th>Tajuk Aduan</th>
                <th>Gambar Aduan</th>
                <th>Keterangan</th>
                <th>Status Aduan</th>
                <th>Tarikh Aduan</th>
                <th>Tarikh Status Dikemaskini</th>
                <th>Maklumat Aduan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($aduan as $aduanItem):
                if ($aduanItem->StatusAduan != 'Sedang Disemak'):
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
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $namaProjek ?></td>
                        <td><?= $aduanItem->NoAduan ?></td>
                        <td><?= $jenisKerosakan ?></td>
                        <td><?= $keteranganDetail ?></td>
                        <td><?= $aduanItem->TajukAduan ?></td>
                        <td>
                            <?php
                            if (!empty($aduanItem->GambarAduan)) {
                                $imageData = base64_encode($aduanItem->GambarAduan);
                                $imageFormat = 'jpeg'; // default to JPEG
                                if (strpos($aduanItem->GambarAduan, '/9j/') === 0) {
                                    $imageFormat = 'jpeg'; // JPEG format marker
                                } elseif (strpos($aduanItem->GambarAduan, '/9v/') === 0) {
                                    $imageFormat = 'png'; // PNG format marker
                                }
                                $src = 'data:image/' . $imageFormat . ';base64,' . $imageData;
                                $width = '100px';
                                $height = 'auto'; // Maintain aspect ratio
                    
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
                            <form action="<?= base_url('aduan/lihat_aduan2') ?>" method="get">
                                <input type="hidden" name="NoAduan" value="<?= $aduanItem->NoAduan ?>">
                                <button type="submit">Laporan Aduan</button>
                            </form>
                        </td>
                    </tr>
                <?php endif;
            endforeach; ?>
        </tbody>
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
                        <form action="<?= base_url('aduan/edit2/' . $aduanItem->NoAduan) ?>" method="POST">
                            <div class="form-group">
                                <label>No Aduan:</label><br>
                                <input type="text" name="noAduan" class="form-control" value="<?= $aduanItem->NoAduan ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Tajuk Aduan:</label><br>
                                <input type="text" name="tajukAduan" class="form-control"
                                    value="<?= $aduanItem->TajukAduan ?>">
                                <?= form_error('tajukAduan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Keterangan:</label><br>
                                <input type="text" name="keterangan" class="form-control"
                                    value="<?= $aduanItem->Keterangan ?>">
                                <?= form_error('keterangan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="statusAduan" class="form-control"
                                    value="<?= $aduanItem->StatusAduan ?>">
                                <?= form_error('statusAduan', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit">HANTAR</button>
                                <button type="reset">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <button class="logout-button" onclick="window.location.href='http://localhost:8080/e-DefectTest/'">Logout</button>
    <button class="print-button" onclick="printReport()">Print Page</button>
</body>

</html>