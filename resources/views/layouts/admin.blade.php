<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Yunoa Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            padding: 1.5rem;
            background-color: #0F5A4A;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #4fcfb1;
            color: white;
        }
        .sidebar .nav-link .bi {
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        .sidebar-footer {
            position: absolute;
            bottom: 1.5rem;
            left: 1.5rem;
            right: 1.5rem;
        }
        .sidebar-footer .btn { width: 100%; }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none">
                 <img src="{{ asset('landing-page/logo.png') }}" alt="Yunoa Space" style="width: 150px; filter: brightness(0) invert(1);">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>User Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.doctors.verification') }}" class="nav-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                        <i class="bi bi-patch-check-fill"></i>Doctor Verification
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <hr>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-left me-2"></i>Logout
                </button>
            </form>
        </div>
    </div>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>