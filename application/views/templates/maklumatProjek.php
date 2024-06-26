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

        .count-label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
            flex: 1;
        }

        .mySlides {
            display: none;
        }

        img {
            vertical-align: middle;
            height: 400px;
            width: auto;
            object-fit: contain;
            border: 2px solid #007bff;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: #007bff;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 123, 255, 0.8);
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        .stats {
            width: 100%;
        }

        .project-info {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .project-info-left {
            flex: 0.6;
        }

        .project-info-right {
            flex: 0.4;
        }

        .project-info-right label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        .project-info-right p {
            padding: 12px;
            border: 1px solid #dddddd;
            margin: 10px 0;
        }

        .contact-info {
            margin-top: 20px;
        }

        .contact-info label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        .contact-info p {
            padding: 12px;
            border: 1px solid #dddddd;
            margin: 10px 0;
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

        let slideIndex = 0;

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 10000);
        }

        function plusSlides(n) {
            slideIndex += n - 1;
            showSlides();
        }

        function currentSlide(n) {
            slideIndex = n - 1;
            showSlides();
        }

        window.onload = showSlides;
    </script>
</head>

<body>
    <button class="back-button" onclick="window.location.href='index'">Back</button>
    <div class="details-container">
        <h2>Details for Projek No <?= $details['projek']->NoProjek ?></h2>

        <div class="project-info">
            <div class="project-info-left">
                <div class="slideshow-container">
                    <div class="mySlides fade">
                        <?php
                        if (!empty($details['projek']->GambarProjek1)) {
                            $imageData = base64_encode($details['projek']->GambarProjek1);
                            $imageFormat = 'jpeg';
                            if (strpos($details['projek']->GambarProjek1, '/9j/') === 0) {
                                $imageFormat = 'jpeg';
                            } elseif (strpos($details['projek']->GambarProjek1, 'iVBORw0KGgoAAAANSUhEUg') === 0) {
                                $imageFormat = 'png';
                            }
                            $src = 'data:image/' . $imageFormat . ';base64,' . $imageData;
                            echo '<img src="' . $src . '" alt="Gambar Projek 1" style="width:100%">';
                        } else {
                            echo 'No Image';
                        }
                        ?>
                    </div>

                    <div class="mySlides fade">
                        <?php
                        if (!empty($details['projek']->GambarProjek2)) {
                            $imageData = base64_encode($details['projek']->GambarProjek2);
                            $imageFormat = 'jpeg';
                            if (strpos($details['projek']->GambarProjek2, '/9j/') === 0) {
                                $imageFormat = 'jpeg';
                            } elseif (strpos($details['projek']->GambarProjek2, 'iVBORw0KGgoAAAANSUhEUg') === 0) {
                                $imageFormat = 'png';
                            }
                            $src = 'data:image/' . $imageFormat . ';base64,' . $imageData;
                            echo '<img src="' . $src . '" alt="Gambar Projek 2" style="width:100%">';
                        } else {
                            echo 'No Image';
                        }
                        ?>
                    </div>

                    <div class="mySlides fade">
                        <?php
                        if (!empty($details['projek']->GambarProjek3)) {
                            $imageData = base64_encode($details['projek']->GambarProjek3);
                            $imageFormat = 'jpeg';
                            if (strpos($details['projek']->GambarProjek3, '/9j/') === 0) {
                                $imageFormat = 'jpeg';
                            } elseif (strpos($details['projek']->GambarProjek3, 'iVBORw0KGgoAAAANSUhEUg') === 0) {
                                $imageFormat = 'png';
                            }
                            $src = 'data:image/' . $imageFormat . ';base64,' . $imageData;
                            echo '<img src="' . $src . '" alt="Gambar Projek 3" style="width:100%">';
                        } else {
                            echo 'No Image';
                        }
                        ?>
                    </div>

                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
            </div>

            <div class="project-info-right">

                <div class="stats">
                    <label class="count-label">Total Reports: <?= $count_total ?></label>
                    <label class="count-label">Reports Today: <?= $count_today ?></label>
                </div>

                <label>Nama Projek:</label>
                <p><?= $details['projek']->NamaProjek ?></p>

                <label>Status Projek:</label>
                <p><?= $details['projek']->StatusProjek ?></p>

                <label>Tarikh Mula:</label>
                <p><?= $details['projek']->TarikhMulaWaranti ?></p>

                <label>Tarikh Tamat:</label>
                <p><?= $details['projek']->TarikhTamatWaranti ?></p>
            </div>
        </div>

        <div class="contact-info">
            <label>Nama Penuh Juruteknik:</label>
            <p><?= $details['juruteknik']->NamaPenuhJT ?></p>

            <label>Nombor Telefon Juruteknik:</label>
            <p><?= $details['juruteknik']->NoTelJT ?></p>

            <label>Emel Juruteknik:</label>
            <p><?= $details['juruteknik']->EmelJT ?></p>

            <hr>

            <label>Nama Penuh Admin Pusat Tanggungjawab:</label>
            <p><?= $details['adminptj']->NamaPenuhAPTJ ?></p>

            <label>Nombor Telefon Admin Pusat Tanggungjawab:</label>
            <p><?= $details['adminptj']->NoTelAPTJ ?></p>

            <label>Emel Admin Pusat Tanggungjawab:</label>
            <p><?= $details['adminptj']->EmelAPTJ ?></p>

            <hr>

            <label>Nama Syarikat Kontraktor:</label>
            <p><?= $details['kontraktor']->NAMASYARIKAT ?></p>

            <label>Nombor Telefon Kontraktor:</label>
            <p><?= $details['kontraktor']->NOTELKONTRAKTOR ?></p>

            <label>Emel Kontraktor:</label>
            <p><?= $details['kontraktor']->EMELKONTRAKTOR ?></p>

            <label>Alamat Kontraktor:</label>
            <p><?= $details['kontraktor']->ALAMAT ?></p>

            <hr>

            <label>Nama Syarikat Perunding 1:</label>
            <p><?= $details['perunding1']->NAMASYARIKAT ?></p>

            <label>Nombor Telefon Perunding 1:</label>
            <p><?= $details['perunding1']->NOTELPERUNDING ?></p>

            <label>Emel Perunding 1:</label>
            <p><?= $details['perunding1']->EMELPERUNDING ?></p>

            <label>Alamat Perunding 1:</label>
            <p><?= $details['perunding1']->ALAMAT ?></p>

            <hr>

            <label>Nama Syarikat Perunding 2:</label>
            <p><?= $details['perunding2']->NAMASYARIKAT ?></p>

            <label>Nombor Telefon Perunding 2:</label>
            <p><?= $details['perunding2']->NOTELPERUNDING ?></p>

            <label>Emel Perunding 2:</label>
            <p><?= $details['perunding2']->EMELPERUNDING ?></p>

            <label>Alamat Perunding 2:</label>
            <p><?= $details['perunding2']->ALAMAT ?></p>

            <hr>

            <label>Nama Syarikat Perunding 3:</label>
            <p><?= $details['perunding3']->NAMASYARIKAT ?></p>

            <label>Nombor Telefon Perunding 3:</label>
            <p><?= $details['perunding3']->NOTELPERUNDING ?></p>

            <label>Emel Perunding 3:</label>
            <p><?= $details['perunding3']->EMELPERUNDING ?></p>

            <label>Alamat Perunding 3:</label>
            <p><?= $details['perunding3']->ALAMAT ?></p>


        </div>

        <button onclick="printReport()">Print Report</button>
    </div>
</body>

</html>