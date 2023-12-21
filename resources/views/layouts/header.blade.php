<div class="header">
			
    <!-- Logo -->
    <div class="header-left">
         <a href="{{ route('admin.dashboard') }}" class="logo">
            <img src="{{ asset('assets/img/tutwuri.png') }}" width="40" height="40" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="logo2">
            <img src="{{ asset('assets/img/tutwuri.png') }}" width="40" height="40" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->
    
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    
    <!-- Header Title -->
    <div class="page-title-box">
        <h3>SDN 115 BANGKO</h3>
        <span class="text-white">Semester Aktif : 1 </span>
    </div>
    <!-- /Header Title -->
    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>
    
    <!-- Header Menu -->
    <ul class="nav user-menu">           
            
        <li class="nav-item dropdown has-arrow main-drop">
            
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('assets/img/user.jpg') }}" alt="User Image">
                    <span class="status online"></span></span>
                    <span>Admin</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <a class="dropdown-item" href="index.html">Logout</a>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="settings.html">Settings</a>
            <a class="dropdown-item" href="index.html">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
    
</div>
<!-- /Header -->