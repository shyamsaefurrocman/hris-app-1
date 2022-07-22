<nav id="sidebar" class="sidebar-wrapper sidebar-primary">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a href="index.html">
                <h3 class="logo" style="color: #3933FF"><b>HRiS System</b></h3>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard.index') }}"><i class="ti ti-dashboard me-2"></i>Dashboard</a></li>
            @if ( Auth::user()->role == 'admin' )
            <li><a href="{{ route('pegawai.index') }}"><i class="ti ti-user me-2"></i>Pegawai</a></li>
            <li><a href="{{ route('absensi.index') }}"><i class="ti ti-list me-2"></i>List Absensi</a></li>
            @endif
            <!-- sidebar-menu  -->
    </div>
    <!-- Sidebar Footer -->
    <!-- Sidebar Footer -->
</nav>