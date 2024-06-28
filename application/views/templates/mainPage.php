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
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .navbar_top {
            display: flex;
            justify-content: center;
            background-color: #007bff;
            overflow: hidden;
        }

        .navbar_top a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar_top a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar {
            width: 40%;
            margin: 10px auto;
            padding: 0;
            list-style: none;
            background-color: #007bff;
            border: 2px solid;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            justify-content: space-around;
        }

        .navbar li {
            flex: 1;
            text-align: center;
        }

        .navbar li a {
            display: block;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
        }

        .navbar li a:hover {
            background-color: #0056b3;
            border: 2px solid white;
        }

        .navbar li a.active {
            background-color: #3399ff;
        }

        @media screen and (max-width: 600px) {
            .navbar {
                flex-direction: column;
            }

            .navbar li {
                width: 100%;
            }
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
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

        .text-center {
            text-align: center;
        }

        .text-danger {
            background-color: #f8d7da;
            /* Light red background color */
            color: #721c24;
            /* Dark red text color */
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
            display: flex;
            text-align: center;
            align-items: center;
        }

        button:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
        }

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
        }

        .print-button {
            background-color: #28a745;
            /* Green color */
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
            /* Darker green on hover */
        }

        .logout-button {
            background-color: #dc3545;
            /* Red color */
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
            /* Darker red on hover */
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
            if (confirm('Adakah anda ingin membatalkan projek ini?')) {
                window.location.href = url;
            }
        }

        function updateTableStyles() {
            let today = new Date();
            let rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                let tarikhTamatWaranti = new Date(row.cells[5].textContent.trim());
                let statusCell = row.cells[3];
                let originalStatus = statusCell.textContent.trim();
                let newStatus = originalStatus;

                // Calculate 30 days before expiry
                let expiryDate = new Date(tarikhTamatWaranti);
                expiryDate.setDate(expiryDate.getDate() - 30);

                // Determine the new status based on the warranty date
                if (tarikhTamatWaranti < today) {
                    newStatus = "Tamat Tempoh Waranti";
                    row.classList.add('bg-red');
                    row.classList.remove('text-danger', 'bg-yellow', 'bg-green');
                } else if (expiryDate < today) {
                    newStatus = "Aktif";
                    row.classList.add('text-danger');
                    row.classList.remove('bg-red', 'bg-yellow', 'bg-green');
                } else {
                    row.classList.remove('text-danger', 'bg-red', 'bg-yellow', 'bg-green');
                }

                // Update the background color based on the new status if it's not 'Tamat Tempoh Waranti'
                if (newStatus !== 'Tamat Tempoh Waranti') {
                    switch (newStatus) {
                        case 'Projek Batal':
                            row.classList.add('bg-yellow');
                            break;
                        default:
                            row.classList.remove('bg-yellow', 'bg-red');
                    }
                }

                // Update the status cell text if the status has changed
                if (newStatus !== originalStatus) {
                    statusCell.textContent = newStatus;
                    updateStatusInDatabase(row.cells[1].textContent.trim(), newStatus);
                }
            });
        }

        function updateStatusInDatabase(projectId, newStatus) {
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {
                    NoProjek: projectId,
                    StatusProjek: newStatus
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Call updateTableStyles on page load
        document.addEventListener('DOMContentLoaded', function () {
            updateTableStyles();
        });

    </script>
</head>

<body>
    <h1>MUKA SUPERADMIN</h1>
    <!-- Display all reports in a single line with specified colors -->
    <div class="container-fluid mt-4 d-flex justify-content-center">
        <div class="row w-100 justify-content-center">
            <!-- Total Reports -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index7') ?>">
                    <div class="small-box bg-blue text-center">
                        <div class="inner">
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                                Jumlah Aduan Keseluruhan:
                                <h3><?= $this->session->userdata('count_total') ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Reports Today -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index4') ?>">
                    <div class="small-box bg-yellow text-center">
                        <div class="inner">
                            <div class="icon">
                                <i class="fas fa-file"></i>
                                Jumlah Aduan Keseluruhan Hari Ini:
                            </div>
                            <h3><?= $this->session->userdata('count_today') ?> </h3>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Aduan yang belum siap dikemaskini -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index5') ?>">
                    <div class="small-box bg-red text-center">
                        <div class="inner">
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle"></i>
                                Jumlah Aduan Belum Siap:
                            </div>
                            <h3><?= $this->session->userdata('count_belum_siap') ?></h3>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Aduan yang telah siap dikemaskini -->
            <div class="col-lg-3 col-6">
                <a href="<?= site_url('projek/index6') ?>">
                    <div class="small-box bg-green text-center">
                        <div class="inner">
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                                Jumlah Aduan Siap:
                            </div>
                            <h3><?= $this->session->userdata('count_siap') ?></h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="navbar_top">
        <a href="tambah">Tambah Projek</a>
        <a href="setupSA">Setup Superadmin</a>
        <a href="setupJT">Setup Juruteknik</a>
        <a href="setupAPTJ">Setup Admin Pusat Tanggungjawab</a>
        <a href="setupKontraktor">Setup Kontraktor</a>
        <a href="setupPerunding">Setup Perunding</a>
        <a href="setupKerosakan">Setup Kerosakan</a>
    </div>
    <table border="1">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>No Projek</th>
                <th>Nama Projek</th>
                <th>Status Projek</th>
                <th>Tarikh Mula Waranti</th>
                <th>Tarikh Tamat Waranti</th>
                <th>Id Juruteknik</th>
                <th>Id Admin Pusat Tanggungjawab</th>
                <th>Kemaskini</th>
                <th>Maklumat Lanjut</th>
                <th>Batal Projek</th>
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
                    <td><?= $projekItem->IdJT ?></td>
                    <td><?= $projekItem->IdAPTJ ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#edit<?= $projekItem->NoProjek ?>" <?php if (in_array($projekItem->StatusProjek, ['Tamat Tempoh Waranti', 'Projek Batal']))
                              echo 'disabled'; ?>
                            class="btn btn-primary <?= in_array($projekItem->StatusProjek, ['Tamat Tempoh Waranti', 'Projek Batal']) ? 'disabled' : '' ?>">
                            Kemaskini
                        </button>
                    </td>
                    <td>
                        <form action="<?= base_url('projek/lihat_projek') ?>" method="get">
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
                    <td>
                        <button
                            onclick="confirmAndRedirect('<?= site_url('projek/batal?NoProjek=' . urlencode($projekItem->NoProjek)) ?>')"
                            class="btn btn-primary" <?php if (in_array($projekItem->StatusProjek, ['Tamat Tempoh Waranti', 'Projek Batal']))
                                echo 'disabled'; ?>>
                            BATAL PROJEK
                        </button>
                    </td>
                </tr>
            </tbody>
        <?php endforeach ?>
    </table>

    <ul class="navbar">
        <li><a href="index2">Projek Aktif</a></li>
        <li><a href="index" class="active">Semua Projek</a></li>
        <li><a href="index3">Projek Tamat Tempoh</a></li>
    </ul>

    <!-- Modal -->
    <?php foreach ($projek as $projekItem): ?>
        <div class="modal fade" id="edit<?= $projekItem->NoProjek ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kemaskini data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('projek/edit/' . $projekItem->NoProjek) ?>" method="POST">
                            <div class="form-group">
                                <label>Nama Projek:</label><br>
                                <input type="text" name="namaProjek" class="form-control"
                                    value="<?= $projekItem->NamaProjek ?>">
                                <?= form_error('namaProjek', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Status Projek:</label><br>
                                <select name="statusProjek" class="form-control">
                                    <option value="Aktif" <?= $projekItem->StatusProjek == 'Aktif' ? 'selected' : '' ?>>
                                        Aktif
                                    </option>
                                    <option value="Tamat Tempoh Waranti" <?= $projekItem->StatusProjek == 'Tamat Tempoh Waranti' ? 'selected' : '' ?>>Tamat Tempoh Waranti</option>
                                    <option value="Batal" <?= $projekItem->StatusProjek == 'Batal' ? 'selected' : '' ?>>
                                        Batal
                                    </option>
                                </select>
                                <?= form_error('statusProjek', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Tarikh Mula Waranti:</label><br>
                                <input type="date" name="tarikhMulaWaranti" class="form-control"
                                    value="<?= $projekItem->TarikhMulaWaranti ?>">
                                <?= form_error('tarikhMulaWaranti', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>Tarikh Tamat Waranti:</label><br>
                                <input type="date" name="tarikhTamatWaranti" class="form-control"
                                    value="<?= $projekItem->TarikhTamatWaranti ?>">
                                <?= form_error('tarikhTamatWaranti', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>ID Juruteknik:</label><br>
                                <input type="text" name="IdJT" class="form-control" value="<?= $projekItem->IdJT ?>">
                                <?= form_error('IdJT', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                                <label>ID Admin Pusat Tanggungjawab:</label><br>
                                <input type="text" name="IdAPTJ" class="form-control" value="<?= $projekItem->IdAPTJ ?>">
                                <?= form_error('IdAPTJ', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <!-- Add other form fields as needed -->
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