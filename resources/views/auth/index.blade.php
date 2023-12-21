@extends('auth.auth_base')
@section('content')
@if(session('error'))
   <script>
       Swal.fire('{{ session('error') }}');
   </script>
@elseif(session('success'))
    <script>
        Swal.fire('{{ session('success') }}');
    </script>
@endif
<div class="main-wrapper">
    <div class="account-content">
        <div class="container">
        
            <!-- Account Logo -->
            <div class="account-logo">
                <a href="admin-dashboard.html"><img src="{{ asset('assets/img/tutwuri.png') }}" alt="Dreamguy's Technologies"></a>
            </div>
            <!-- /Account Logo -->
            @foreach ($errors->all() as $error)

            <div>{{ $error }}</div>

            @endforeach
            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Login</h3>
                    <p class="account-subtitle">Access to our dashboard</p>
                    
                    <!-- Account Form -->
                    <form action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div class="input-block mb-4">
                            <label class="col-form-label">Email Address</label>
                            <input class="form-control" type="email" id="email" name="email" required>
                        </div>
                        <div class="input-block mb-4">
                            <div class="row align-items-center">
                                <div class="col">
                                    <label class="col-form-label">Password</label>
                                </div>
                            </div>
                            <div class="position-relative">
                                <input class="form-control" name="password" type="password" id="password" required>
                                <span class="fa-solid fa-eye-slash" id="toggle-password"></span>
                            </div>
                        </div>
                        <div class="input-block mb-4 text-center">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                        {{-- <div class="account-footer">
                            <p>Don't have an account yet? <a href="register.html">Register</a></p>
                        </div> --}}
                    </form>
                    <!-- /Account Form -->
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection