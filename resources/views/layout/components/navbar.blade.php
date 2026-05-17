<nav class="navbar p-0 fixed-top d-flex flex-row" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; height: 70px;">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center" style="background: #ffffff; border-bottom: 1px solid #e2e8f0;">
        <a class="navbar-brand brand-logo-mini" href="#">
            <i class="mdi mdi-bullhorn-variant text-primary" style="font-size: 24px;"></i>
        </a>
    </div>
    
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch" style="background: #ffffff; box-shadow: none;">
        <button class="navbar-toggler navbar-toggler align-self-center text-dark" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu" style="font-size: 20px;"></span>
        </button>
        
        <ul class="navbar-nav w-100">
            <li class="nav-item w-100 d-none d-md-flex align-items-center">
                <span class="text-muted small font-weight-medium">
                    <i class="mdi mdi-information-outline text-primary mr-1"></i> 
                    Layanan Pengaduan & Aspirasi Online Masyarakat
                </span>
            </li>
        </ul>
        
        <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false" style="color: #334155;">
                    <div class="navbar-profile d-flex align-items-center">
                        <div class="bg-primary text-white d-flex align-items-center justify-content-center font-weight-bold mr-2" 
                             style="width: 32px; height: 32px; border-radius: 50%; font-size: 0.85rem;">
                            {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}
                        </div>
                        <p class="mb-0 d-none d-sm-block navbar-profile-name font-weight-semibold text-dark" style="font-size: 0.9rem;">
                            {{ Auth::user()->name ?? 'Masyarakat' }}
                        </p>
                        <i class="mdi mdi-menu-down d-none d-sm-block text-muted ml-1"></i>
                    </div>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list border-0 shadow" 
                     aria-labelledby="profileDropdown" style="background: #ffffff; border-radius: 12px; margin-top: 10px; width: 220px;">
                    
                    <div class="p-3">
                        <h6 class="mb-1 text-dark font-weight-bold" style="font-size: 0.9rem;">{{ Auth::user()->name ?? 'User' }}</h6>
                        <p class="mb-0 text-muted small text-capitalize"><i class="mdi mdi-shield-account-outline mr-1"></i>{{ Auth::user()->role ?? 'Masyarakat' }}</p>
                    </div>
                    
                    <div class="dropdown-divider" style="border-color: #f1f5f9;"></div>
                    
                    <a href="#" class="dropdown-item preview-item py-2" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-light text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="mdi mdi-logout" style="font-size: 16px;"></i>
                            </div>
                        </div>
                        <div class="preview-item-content ml-2">
                            <p class="preview-subject mb-0 text-danger font-weight-medium" style="font-size: 0.875rem;">Keluar Aplikasi</p>
                        </div>
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center text-dark" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>