<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/media/logos/hjglogo-150x150.png" />
    <!-- Google Fonts (Optional, for similar font style) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            /* Fallback color */
        }

        .page-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 15px;
            position: relative;
            overflow: hidden;
        }

        .background-pattern {
            position: absolute;
            top: -5%;
            left: -5%;
            width: 110%;
            height: 110%;
            background-color: #f8f9fa;
            /* background-image: url('https://i.imgur.com/uGg4JQI.jpg'); */
            /* Replace with your background image */
            background-size: cover;
            background-position: center;
            filter: grayscale(100%);
            opacity: 0.5;
            z-index: 0;
        }

        .error-container {
            background-color: #ea565E;
            color: white;
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 1;
        }

        .hamburger-menu {
            position: absolute;
            top: 30px;
            left: 30px;
            cursor: pointer;
        }

        .hamburger-menu .line {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        .error-content {
            position: relative;
        }

        .error-code {
            font-size: 18vw;
            /* Responsive font size */
            font-weight: 700;
            color: white;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .error-code .digit {
            position: relative;
            z-index: 1;
        }

        .onion-large {
            width: 18vw;
            /* Responsive size */
            height: 18vw;
            /* Responsive size */
            margin: 0 -2vw;
            position: relative;
            z-index: 2;
            /* Ensures it's on top of the number if needed */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 50%;
        }

        .onion-small {
            position: absolute;
            top: -5%;
            right: 15%;
            width: 6vw;
            /* Responsive size */
            height: 6vw;
            /* Responsive size */
            z-index: 2;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            border-radius: 50%;
        }

        .whoops-text {
            font-size: 3rem;
            font-weight: 400;
            margin-top: 20px;
        }

        .error-message {
            font-size: 1rem;
            letter-spacing: 1px;
            margin-top: 10px;
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-home {
            background-color: white;
            color: #333;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1rem;
            margin-top: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: #f8f9fa;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .btn-home .arrow {
            background-color: #ea565E;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .btn-home:hover .arrow {
            transform: translateX(5px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .error-code {
                font-size: 25vw;
            }

            .onion-large {
                width: 25vw;
                height: 25vw;
            }

            .onion-small {
                width: 8vw;
                height: 8vw;
                right: 10%;
            }

            .whoops-text {
                font-size: 2.5rem;
            }

            .error-message {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .error-container {
                padding: 40px 20px;
            }

            .error-code {
                font-size: 30vw;
            }

            .onion-large {
                width: 30vw;
                height: 30vw;
                margin: 0 -3vw;
            }

            .onion-small {
                width: 10vw;
                height: 10vw;
                right: 5%;
            }

            .whoops-text {
                font-size: 2rem;
            }

            .btn-home {
                padding: 10px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="page-container">
        <div class="background-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="error-container">
                        <div class="hamburger-menu">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="error-content text-center">
                            <div class="error-code">
                                <span class="digit">4</span>
                                <span class="digit">0</span>
                                <!-- <img src="https://i.imgur.com/G3tA4xG.png" alt="Onion slice representing a zero" class="onion-large"> -->
                                <span class="digit">4</span>
                                <img src="<?= base_url() ?>assets/media/icons/code.png" alt="Small onion slice" class="onion-small">
                            </div>
                            <h1 class="whoops-text">Page Not Found!</h1>
                            <?php
                            $referensi = (isset($reff)) ? $reff : null;
                            $pesan = "MAAF TIDAK DAPAT MENEMUKAN HALAMAN YANG ANDA CARI";
                            $href = base_url();
                            $btntext = "Lanjutkan ke halaman beranda";
                            if ($referensi == "karyawan_detail") {
                                $pesan = "MAAF TIDAK DAPAT MENEMUKAN KARYAWAN DENGAN NUK: " . $nuk;
                            }
                            ?>
                            <p class="error-message"><?= $pesan ?></p>
                            <a href="<?= $href ?>" class="btn btn-home">
                                <?= $btntext ?><span class="arrow">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, for components like the hamburger menu if it were functional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>