<!-- layout Sidebar -->
<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right bg-sidebar">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
              {!!html_entity_decode($main)!!}
            </div>
        </div>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                @if (Auth::guest())
                <div class="sidenav-footer-title">Panel</div>
                @else
                <div class="sidenav-footer-subtitle">Registrado como:</div>
                <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
                @endif
                <!-- Status -->
                <div class="user-panel">
                  <div style="align:center">
                    <a nohref class="text-white"><i class="fa fa-circle text-success"></i>Activo</a>
                  </div>
                </div>
            </div>
        </div>
    </nav>
</div>
