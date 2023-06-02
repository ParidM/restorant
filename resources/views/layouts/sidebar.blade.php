<div class="app-sidebar sidebar-shadow bg-asteroid sidebar-text-light">
    <div class="app-header__logo">
        <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
    <div class="scrollbar-sidebar" style="overflow-y:scroll;">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu Utama</li>
                <li>
                    <a href="{{route('home')}}" class="{{(request()->is('home')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-home"></i>
                            Beranda
                    </a>
                </li>
                <li>
                    <a href="{{route('pelanggan.index')}}" class="{{(request()->is('pelanggan*')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-users"></i>
                            Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{route('supplier.index')}}" class="{{(request()->is('supplier*')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-plugin"></i>
                            Supplier
                    </a>
                </li>
                <li>
                    <a href="{{route('barang.index')}}" class="{{(request()->is('barang')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-safe"></i>
                            Barang
                    </a>
                </li>
                <li>
                    <a href="{{route('barang-masuk.index')}}" class="{{(request()->is('barang-masuk*')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-download"></i>
                            Barang Masuk
                    </a>
                </li>
                <li>
                    <a href="{{route('transaksi.index')}}" class="{{(request()->is('transaksi*')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-upload"></i>
                            Transaksi
                    </a>
                </li>
                <li>
                    <a href="#" class="{{(request()->is('penerima','penerima-thr*')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-cash"></i>
                           Laporan
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="{{(request()->is('penerima','penerima-thr*')) ? 'mm-show' : ''}}">
                        <li>
                            <a href="#" class="{{(request()->is('penerima')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon pe-7s-mail-open-file"></i>
                                    Stok Barang
                            </a>
                        </li>
                        <li>
                            <a href="#" class="{{(request()->is('penerima-thr*')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon pe-7s-mail-open-file"></i>
                                    Keuangan
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="metismenu-icon pe-7s-power"></i>Keluar</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>                 
            </ul>
        </div>
    </div>
</div> 