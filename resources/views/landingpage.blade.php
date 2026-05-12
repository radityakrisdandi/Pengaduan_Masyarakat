<!--home page-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link
            href="css/bootstrap.min.css"
            rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
            rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
            rel="stylesheet" />
        <!--Aos -->
        <link rel="stylesheet"
            href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

        <link rel="shortcut icon" href="img/download (35).png"
            type="image/x-icon">
        <title>Landing Page</title>
    </head>
    <body>
        <!--header section -->
        <header>
            <!-- Navbar (اختياري) -->
            <nav class="navbar main-nav fixed-top py-3 navbar-expand-lg">
                <div
                    class="container d-flex justify-content-between align-items-center">

                    <!-- Logo -->
                    <div class="d-flex align-items-center gap-2 brand-logo">
                    </div>


                    <a href="../Auth/login"
                        class="btn px-4 d-none d-lg-block">Login</a>

                    <!-- Burger Button (Mobile Only) -->

                </div>
            </nav>

            <!-- Offcanvas Mobile Menu -->
            <div class="offcanvas offcanvas-end" id="mobileMenu"
                style="background-color: #323b3e;">

                <div class="offcanvas-header">
                    <div class="d-flex align-items-center gap-2 brand-logo">
                        <i class="fa-solid fa-tooth"></i>
                        <h4 class="fw-bold m-0">Prime Dental</h4>
                    </div>

                    <button class="btn-close"
                        data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body"
                    <a class="btn w-100 mt-3">Book Now</a>
                </div>

            </div>
        </header>
        <!-- Hero Section -->
        <section class="hero-modern">
            <div class="container">
                <div class="row align-items-center">

                    <!-- LEFT TEXT -->
                    <div class="col-md-6">

                        <h1 class="hero-title">
                            SISTEM PENGADUAN MASYARAKAT
                        </h1>

                        <p class="hero-desc">
                            Website untuk menyampaikan pengaduan dan aspirasi masyarakat secara online.
                        </p>

                        <!-- Rating Box -->
                        <div class="hero-rating mt-4">
                            <span class="rating-value">5.0★</span>
                            <span class="rating-text">Rating Dari Masyarakat</span>
                        </div>

                    </div>

                    <!-- RIGHT IMAGE -->
                    <div class="col-md-6 position-relative">

                    </div>

                </div>
            </div>
        </section>

        </footer>

        <!-- Bootstrap JS && custom js-->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script
            src="js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>