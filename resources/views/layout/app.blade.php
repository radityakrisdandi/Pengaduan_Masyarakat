<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Portal Pengaduan Masyarakat</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Layout Wrapper */
        .wrapper {
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        /* Sidebar Custom Light */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #ffffff;
            color: #475569;
            transition: all 0.3s;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.03);
            border-right: 1px solid #e2e8f0;
            min-height: 100vh;
            position: fixed;
            z-index: 999;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            background: #ffffff;
        }

        .sidebar-header .logo-text {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        /* Main Content Area */
        #content {
            width: calc(100% - 260px);
            padding: 0;
            min-height: 100vh;
            transition: all 0.3s;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }

        .main-panel {
            padding: 2rem 2.5rem;
            flex-grow: 1;
        }

        /* Footer */
        .footer-custom {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.25rem 2.5rem;
            color: #64748b;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="logo-text">
                    <i class="mdi mdi-bullhorn-variant text-primary mr-2"></i>E-Pengaduan
                </div>
            </div>
            @include('layout.components.sidebar')
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-between align-items-center">
                <span class="text-muted d-none d-md-inline">Halo, selamat bekerja melayani masyarakat.</span>
                
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-dark font-weight-medium" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-account-circle text-primary mr-1" style="font-size: 1.2rem; vertical-align: middle;"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="userDropdown">
                        <div class="dropdown-header text-muted">Role: {{ ucfirst(Auth::user()->role) }}</div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout mr-2"></i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

            <div class="main-panel">
                @yield('content')
            </div>

            @include('layout.components.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>