<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <title>Landing Page</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #f5f7fb;
            overflow-x: hidden;
        }

        /* Navbar */
        .main-nav{
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo-text{
            font-size: 24px;
            font-weight: 700;
            color: #0d6efd;
        }

        .btn-login{
            background: #0d6efd;
            color: white;
            border-radius: 50px;
            padding: 10px 28px;
            transition: 0.3s;
            font-weight: 500;
        }

        .btn-login:hover{
            background: #0b5ed7;
            color: white;
            transform: translateY(-2px);
        }

        /* Hero */
        .hero-modern{
            min-height: 100vh;
            display: flex;
            align-items: center;
            background:
                linear-gradient(
                    135deg,
                    #eef4ff 0%,
                    #dfeeff 100%
                );
            position: relative;
            padding-top: 100px;
        }

        .hero-title{
            font-size: 56px;
            font-weight: 700;
            line-height: 1.2;
            color: #1f2937;
        }

        .hero-title span{
            color: #0d6efd;
        }

        .hero-desc{
            font-size: 18px;
            color: #6b7280;
            margin-top: 20px;
            line-height: 1.8;
        }

        .hero-btn{
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .btn-main{
            background: #0d6efd;
            color: white;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-main:hover{
            background: #0b5ed7;
            color: white;
            transform: translateY(-3px);
        }

        .btn-secondary-custom{
            background: white;
            color: #0d6efd;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            border: 1px solid #dbeafe;
            transition: 0.3s;
        }

        .btn-secondary-custom:hover{
            background: #f0f7ff;
            color: #0d6efd;
        }

        /* Rating Box */
        .hero-rating{
            background: white;
            padding: 18px 24px;
            border-radius: 20px;
            width: fit-content;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin-top: 35px;
        }

        .rating-value{
            font-size: 24px;
            font-weight: 700;
            color: #f59e0b;
        }

        .rating-text{
            display: block;
            color: #6b7280;
            margin-top: 5px;
        }

        /* Right Illustration */
        .hero-image{
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle-bg{
            width: 420px;
            height: 420px;
            background: rgba(13,110,253,0.15);
            border-radius: 50%;
            position: absolute;
        }

        .icon-box{
            width: 350px;
            height: 350px;
            background: white;
            border-radius: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            position: relative;
            z-index: 2;
        }

        .icon-box i{
            font-size: 120px;
            color: #0d6efd;
        }

        /* Floating Card */
        .floating-card{
            position: absolute;
            bottom: 20px;
            left: 0;
            background: white;
            padding: 15px 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            z-index: 3;
        }

        .floating-card h5{
            margin: 0;
            font-weight: 600;
        }

        .floating-card p{
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }

        /* Responsive */
        @media(max-width: 768px){

            .hero-title{
                font-size: 38px;
                text-align: center;
            }

            .hero-desc{
                text-align: center;
            }

            .hero-btn{
                justify-content: center;
                flex-wrap: wrap;
            }

            .hero-rating{
                margin: 30px auto 0;
            }

            .hero-image{
                margin-top: 50px;
            }

            .circle-bg{
                width: 300px;
                height: 300px;
            }

            .icon-box{
                width: 250px;
                height: 250px;
            }

            .icon-box i{
                font-size: 90px;
            }

        }

    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top main-nav py-3">
        <div class="container">

            <div class="logo-text">
                PENGADUAN MASYARAKAT
            </div>

            <a href="{{ route('login') }}" class="btn btn-login">
                Login
            </a>

        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-modern">

        <div class="container">

            <div class="row align-items-center">

                <!-- Left -->
                <div class="col-lg-6">

                    <h1 class="hero-title">
                        SISTEM <span>PENGADUAN</span> MASYARAKAT
                    </h1>

                    <p class="hero-desc">
                        Platform digital untuk membantu masyarakat menyampaikan
                        pengaduan, kritik, dan aspirasi secara cepat,
                        mudah, dan transparan.
                    </p>

                    <!-- Rating -->
                    <div class="hero-rating">

                        <span class="rating-value">
                            5.0 ★
                        </span>

                        <span class="rating-text">
                            Kepuasan masyarakat terhadap layanan
                        </span>

                    </div>

                </div>

                <!-- Right -->
                <div class="col-lg-6">

                    <div class="hero-image">

                        <div class="circle-bg"></div>

                        <div class="icon-box">
                            <i class="fa-solid fa-comments"></i>
                        </div>

                        <div class="floating-card">
                            <h5>+1000 Pengaduan</h5>
                            <p>Telah diproses dengan cepat</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>