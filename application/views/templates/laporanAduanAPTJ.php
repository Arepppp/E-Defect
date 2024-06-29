<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <style>
        body {
            font-family: "Lato", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .details-container {
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        h2 {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            text-align: center;
            margin-top: 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        p {
            padding: 12px;
            border: 1px solid #dddddd;
            margin: 10px 0;
        }

        .images {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .image-container {
            width: 48%;
            text-align: center;
        }

        img {
            vertical-align: middle;
            max-height: 400px;
            width: auto;
            object-fit: contain;
            border: 2px solid #007bff;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
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
    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>

<body>
    <button class="back-button"
        onclick="window.location.href='http://localhost:8080/e-DefectTest/adminptj/index'">Kembali</button>
    <div class="details-container">
        <h2>Details for Aduan No <?= $details['aduan']->NoAduan ?></h2>

        <?php
        $jenisKerosakan = $this->aduan_model->getJenisKerosakanName($details['aduan']->KODKEROSKAN);
        $keteranganDetail = $this->aduan_model->getKeteranganDetailName($details['aduan']->KODDETAIL);
        ?>

        <div class="images">
            <div class="image-container">
                <label>Gambar Semasa Aduan Dilaporkan:</label>
                <?php if (!empty($details['aduan']->GambarAduan)): ?>
                    <?php $gambarAduanBase64 = base64_encode($details['aduan']->GambarAduan); ?>
                    <img src="data:image/jpeg;base64,<?= $gambarAduanBase64 ?>" alt="Gambar Aduan">
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
            </div>
            <div class="image-container">
                <label>Gambar Aduan Yang Siap Dibaiki:</label>
                <?php if (!empty($details['aduan']->GAMBAR_ADUAN_SIAP)): ?>
                    <?php $gambarAduanSiapBase64 = base64_encode($details['aduan']->GAMBAR_ADUAN_SIAP); ?>
                    <img src="data:image/jpeg;base64,<?= $gambarAduanSiapBase64 ?>" alt="Gambar Aduan Yang Siap">
                <?php else: ?>
                    <p>Aduan belum diselesaikan</p>
                <?php endif; ?>
            </div>
        </div>

        <label>Jenis Aduan:</label>
        <p><?= $jenisKerosakan ?></p>

        <label>Jenis Kerosakan:</label>
        <p><?= $keteranganDetail ?></p>

        <label>Tajuk Aduan:</label>
        <p><?= $details['aduan']->TajukAduan ?></p>

        <label>Keterangan:</label>
        <p><?= $details['aduan']->Keterangan ?></p>

        <label>Status Aduan:</label>
        <p><?= $details['aduan']->StatusAduan ?></p>

        <label>Tarikh Aduan:</label>
        <p><?= $details['aduan']->TarikhAduan ?></p>

        <label>Tarikh Status Dikemaskini:</label>
        <p><?= $details['aduan']->TarikhStatusDikemaskini ?></p>

        <label>Tarikh Panggil Kontraktor:</label>
        <p><?= $details['aduan']->TARIKH_PANGGIL_KONTRAKTOR ?></p>

        <label>Komen daripada Juruteknik:</label>
        <p><?= $details['aduan']->KOMEN_JT ?></p>

        <label>Komen Daripada Kontraktor:</label>
        <p><?= $details['aduan']->KOMEN_KONTRAKTOR ?></p>

        <label>NoProjek:</label>
        <p><?= $details['aduan']->NoProjek ?></p>

        <label>Status Aduan:</label>
        <p><?= $details['aduan']->StatusAduan ?></p>

        <button onclick="printReport()">Print Report</button>
    </div>
</body>

</html>