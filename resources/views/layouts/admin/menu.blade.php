<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-simplebar>
      <div class="d-flex mb-4 align-items-center justify-content-between">
          <a href="/" class="text-nowrap logo-img ms-0 ms-md-1">
            {{-- <img src="../assets/images/logos/dark-logo.svg" width="180" alt=""> --}}
            <strong  style="font-size:40px; color:#4492ff;"> MK <b style="color:#121111">LDA</b></strong>

          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav" class="mb-4 pb-2">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link sidebar-link primary-hover-bg"
              href="{{Route('dashboard')}}"
              aria-expanded="false"
            >
              <span class="aside-icon p-2 bg-light-primary rounded-3">
                <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
              </span>
              <span class="hide-menu ms-2 ps-1">Dashboard</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
            <span class="hide-menu">Gestão</span>
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link sidebar-link warning-hover-bg"
              href="{{route('admin.gestao.clientes')}}"
              aria-expanded="false"
            >
              <span class="aside-icon p-2 bg-light-warning rounded-3">
                <i class="ti ti-users fs-7 text-secondary"></i>
              </span>
              <span class="hide-menu ms-2 ps-1"> <b>Clientes</b></span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link sidebar-link danger-hover-bg"
                href="{{route('admin.gestao.produtos')}}"
              aria-expanded="false"
            >
              <span class="aside-icon p-2 bg-light-danger rounded-3">
                <i class="ti ti-package fs-7 text-danger"></i>
              </span>
              <span class="hide-menu ms-2 ps-1"><b>Produtos</b></span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              class="sidebar-link sidebar-link success-hover-bg"
               href="{{route('admin.gestao.fornecedores')}}"
              aria-expanded="false"
            >
              <span class="aside-icon p-2 bg-light-success rounded-3">
                <i class="ti ti-cards fs-7 text-success"></i>
              </span>
              <span class="hide-menu ms-2 ps-1"><b>Fornecedores</b></span>
            </a>
          </li>
         {{--  <li class="sidebar-item">
            <a
              class="sidebar-link sidebar-link success-hover-bg"
               href="{{route('admin.gestao.vendas')}}"
              aria-expanded="false"
            >
              <span class="aside-icon p-2 bg-light-info rounded-3">
                <i class="ti ti-shopping-cart fs-7 text-info"></i>
              </span>
              <span class="hide-menu ms-2 ps-1"><b>Vendas</b></span>
            </a>
          </li> --}}
          <li class="sidebar-item">
            <a
              class="sidebar-link sidebar-link primary-hover-bg"
               href="{{route('admin.gestao.atividades')}}"
              aria-expanded="false"
            >
              <span class="aside-icon p-2 bg-light-primary rounded-3">
                <i class="ti ti-file-description fs-7 text-primary"></i>
              </span>
              <span class="hide-menu ms-2 ps-1"><b>Atividades</b></span>
            </a>
          </li>
         

                <div class="mt-4">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button  type="submit" class="btn btn-danger">Terminar Sessão</button>
                    </form>
                </div>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!--  Sidebar End -->