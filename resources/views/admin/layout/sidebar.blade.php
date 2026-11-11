<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
                  <a href="/" class="logo">
          <h6 style="color: white;">CV.NTRI BERKAH JAYA</h6>
        </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
             <li class="nav-item {{ request()->is('databarang') ? 'active' : '' }}">
                <a href="/databarang">
                  <i class="fas fa-layer-group"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <li class="nav-item {{ request()->is('suratjalan') ? 'active' : '' }}">
              <a href="/suratjalan">
                <i class="fas fa-file"></i>
                <p>Surat Pengantar Barang</p>
              </a>
            </li>
            <li class="nav-item {{ request()->is('laporan/suratjalan') ? 'active' : '' }}">
              <a href="/laporan/suratjalan">
                <i class="fas fa-clipboard-list"></i>
                <p>Laporan</p>
              </a>
            </li>
            </ul>
          </div>
        </div>
      </div>