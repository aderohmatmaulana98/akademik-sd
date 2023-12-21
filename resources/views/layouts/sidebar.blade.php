<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">            
            <ul class="sidebar-vertical">
                <li class="menu-title"> 
                    <span>Main</span>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard </span></a>
                </li>
                <li>
                    <a href="{{ route('admin.penilaian') }}"><i class="la la-graduation-cap"></i> <span> Penilaian </span></a>
                </li>
                <li >
                    <a href="{{ route('admin.jadwal') }}"><i class="la la-clock-o"></i> <span> Jadwal Pelajaran </span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span>Kelola Akun</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.siswa') }}">Siswa</a></li>
                        <li><a href="{{ route('admin.wali_kelas') }}">Wali Kelas</a></li>
                    </ul>
                </li>
                <li class="menu-title"> 
                    <span>Master Data</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-gear"></i> <span> Setting </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.kelas') }}">Kelas</a></li>
                        <li><a href="{{ route('admin.mapel') }}">Mata Pelajaran</a></li>
                        <li><a href="{{ route('admin.semester') }}">Semester</a></li>
                        <li><a href="{{ route('admin.tahunajaran') }}">Tahun Ajaran</a></li>
                    </ul>
                </li>
                <li class="menu-title"> 
                    <span>Authentication</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-user-secret"></i> <span> Profil</span></span></a>
                    <a href="#"><i class="la la-sign-out"></i> <span> Logout</span></span></a>
                </li>
                
            </ul>
            
        </div>
    </div>
</div>

<!-- /Sidebar -->


<!-- /Two Col Sidebar -->