<style>
    .nav-custom {
        display: flex;
        flex-direction: column;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    .nav-custom .nav-link-custom {
        display: flex;
        align-items: center;
        padding: 0.85rem 1.5rem;
        color: #475569;
        font-weight: 500;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 4px solid transparent;
    }
    .nav-custom .nav-link-custom:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .nav-custom .nav-item-custom.active .nav-link-custom {
        background: #e0e7ff;
        color: #4f46e5;
        border-left-color: #4f46e5;
        font-weight: 600;
    }
    .nav-custom .nav-link-custom i {
        font-size: 1.25rem;
        margin-right: 0.75rem;
        color: #94a3b8;
    }
    .nav-custom .nav-item-custom.active .nav-link-custom i {
        color: #4f46e5;
    }
    .nav-category-custom {
        padding: 1.5rem 1.5rem 0.5rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
    }
</style>

<div class="py-3">
    <div class="px-4 py-3 mb-3 d-flex align-items-center" style="background: #f8fafc; border-radius: 12px; margin: 0 1rem;">
        <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center font-weight-bold mr-3" style="width: 40px; height: 40px; border-radius: 50%;">
            {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}
        </div>
        <div style="overflow: hidden;">
            <h6 class="mb-0 text-dark font-weight-semibold text-truncate">{{ Auth::user()->name ?? 'Masyarakat' }}</h6>
            <small class="text-muted text-capitalize">{{ Auth::user()->role ?? 'User' }}</small>
        </div>
    </div>

    <div class="nav-category-custom">Navigation</div>
    <ul class="nav-custom">
        
        @if(Auth::user()->role === 'user')
            <li class="nav-item-custom {{ request()->is('masyarakat') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('masyarakat.dashboard') }}">
                    <i class="mdi mdi-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item-custom {{ request()->is('masyarakat/pengaduan/create') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('pengaduan.create') }}">
                    <i class="mdi mdi-playlist-play"></i>
                    <span>Buat Pengaduan</span>
                </a>
            </li>

            <li class="nav-item-custom {{ request()->is('masyarakat/pengaduan/riwayat*') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('pengaduan.riwayat') }}">
                    <i class="mdi mdi-table-large"></i>
                    <span>Riwayat Pengaduan</span>
                </a>
            </li>

            <li class="nav-item-custom {{ request()->is('masyarakat/berita*') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('masyarakat.berita') }}">
                    <i class="mdi mdi-contacts"></i>
                    <span>Berita</span>
                </a>
            </li>

        @elseif(Auth::user()->role === 'petugas')
            <li class="nav-item-custom {{ request()->is('petugas') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('petugas.dashboard') }}">
                    <i class="mdi mdi-speedometer"></i>
                    <span>Dashboard Staff</span>
                </a>
            </li>
            
            <li class="nav-item-custom {{ request()->is('petugas/pengaduan*') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('petugas.pengaduan.index') }}">
                    <i class="mdi mdi-playlist-play"></i>
                    <span>Pengaduan Masuk</span>
                </a>
            </li>

            <li class="nav-item-custom {{ request()->is('petugas/riwayat-feedback*') ? 'active' : '' }}">
                <a class="nav-link-custom" href="{{ route('petugas.riwayat.index') }}">
                    <i class="mdi mdi-table-large"></i>
                    <span>Riwayat Feedback</span>
                </a>
            </li>
        @endif

    </ul>
</div>