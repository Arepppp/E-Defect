<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: "Lato", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        form {
            width: 30%;
            min-width: 300px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            background-color: #f44336;
            cursor: pointer;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        span.psw {
            float: right;
            padding-top: 16px;
            font-size: 14px;
        }

        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var togglePasswordBtn = document.getElementById('toggle-password-btn');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordBtn.classList.remove('fa-eye');
                togglePasswordBtn.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                togglePasswordBtn.classList.remove('fa-eye-slash');
                togglePasswordBtn.classList.add('fa-eye');
            }
        }
    </script>
</head>

<body>

    <h2 class="imgcontainer">Log Masuk</h2>

    <form action="<?= base_url('projek/login'); ?>" method="post">
        <div class="container">
            <label for="email"><b>Emel</b></label>
            <input type="text" placeholder="Sila Masukkan Emel" name="email">
            <?= form_error('email', '<div class="text-small text-danger">', '</div>'); ?>

            <label for="psw"><b>Kata Laluan</b></label>
            <div style="position: relative;">
                <input type="password" placeholder="Sila Masukkan Kata Laluan" name="psw" id="password">
                <i class="fa fa-eye" id="toggle-password-btn" onclick="togglePasswordVisibility()"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>
            <?= form_error('psw', '<div class="text-small text-danger">', '</div>'); ?>

            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>

            <button type="submit">Log Masuk</button>
            <button type="reset" class="cancelbtn">Padam</button>
        </div>
    </form>

</body>

</html>