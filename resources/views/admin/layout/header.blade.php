     <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="/" class="logo">
                <img
                  src="{{asset('templete')}}/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
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
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
             
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="notifDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                

                  <ul
                    class="dropdown-menu notif-box animated fadeIn"
                    aria-labelledby="notifDropdown"
                  >
                    <li>
                      <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-icon notif-primary">
                              <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> New user registered </span>
                              <span class="time">5 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-success">
                              <i class="fa fa-comment"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Rahmad commented on Admin
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="{{asset('templete')}}/assets/img/profile2.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Reza send messages to you
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-danger">
                              <i class="fa fa-heart"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> Farrah liked Admin </span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);"
                        >See all notifications<i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                   <div class="avatar-sm d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle">
                    <i class="fas fa-user fa-sm"></i>
                  </div>
                    <span class="profile-username">
                      <span class="fw-bold">Admin</span>
                    </span>
                  </a>
                 <ul class="dropdown-menu dropdown-user animated fadeIn p-3" style="min-width: 220px;">
                    <li class="d-flex align-items-center mb-3">
                      <div class="avatar-lg d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-user fa-2x"></i>
                      </div>
                      <div class="u-text">
                        <h5 class="mb-0">Admin</h5>
                        <small class="text-muted">Administrator</small>
                      </div>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>

                    <li>
  <a class="dropdown-item d-flex align-items-center" href="{{ route('account.setting') }}">
    <i class="fas fa-cog me-2"></i> Account Setting
  </a>
</li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                      <form action="{{ route('logout') }}" method="POST" class="px-2">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                          <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                        </button>
                      </form>
                    </li>
                  </ul>

                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>