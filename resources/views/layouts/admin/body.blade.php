
<!doctype html>
<html lang="pt-pt">

@include('layouts.admin.head')

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('layouts.admin.menu')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('layouts.admin.header')
      <!--  Header End -->
      @yield('conteudo')
    </div>
  </div>
  @include('layouts.admin.scripts')
</body>

</html>





