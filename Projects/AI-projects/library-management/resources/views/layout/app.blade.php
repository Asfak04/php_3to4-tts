<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Library Management System</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6; 
            color: #333;
        }
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .sidebar { 
            min-height: calc(100vh - 56px); 
            background-color: #ffffff; 
            box-shadow: 2px 0 12px rgba(0,0,0,0.05);
            z-index: 100;
        }
        .sidebar .nav-link { 
            color: #555; 
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 15px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover { 
            color: #1e3c72; 
            background-color: #f0f4f8; 
            transform: translateX(4px);
        }
        .sidebar .nav-link.active { 
            color: #ffffff; 
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 10px rgba(42, 82, 152, 0.3);
        }
        .sidebar .nav-link i { margin-right: 10px; font-size: 1.1em; }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #edf2f9;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            padding: 15px 25px;
            font-weight: 600;
        }
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.3s;
        }
        .btn-primary { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #152e5b 0%, #1e3c72 100%); transform: translateY(-1px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dce1e7;
            padding: 10px 15px;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(42, 82, 152, 0.15);
            border-color: #2a5298;
        }
        .table-custom {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0,0,0,0.04);
        }
        .table-custom thead { background-color: #f8f9fa; color: #495057; }
        .table-custom th { font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border-bottom: none; }
        .table-custom td { vertical-align: middle; border-bottom: 1px solid #edf2f9; }
        .page-title {
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 0;
        }
        .custom-badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="bi bi-book-half fs-4 me-2"></i>
                LibraryMS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5 me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                            <li><span class="dropdown-item-text text-muted small pb-2">{{ ucfirst(Auth::user()->role) }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-grid-1x2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                                <i class="bi bi-people"></i> Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                <i class="bi bi-journal-text"></i> Books Inventory
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <i class="bi bi-tags"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}" href="{{ route('authors.index') }}">
                                <i class="bi bi-person-badge"></i> Authors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('issues.*') ? 'active' : '' }}" href="{{ route('issues.index') }}">
                                <i class="bi bi-bookmark-check"></i> Manage Issues
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('issues.*') ? 'active' : '' }}" href="{{ route('issues.index') }}">
                                <i class="bi bi-book"></i> My Borrowed Books
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('fines.index') || request()->routeIs('fines.my-fines') ? 'active' : '' }}" href="{{ auth()->user()->role === 'admin' ? route('fines.index') : route('fines.my-fines') }}">
                                <i class="bi bi-cash-stack"></i> {{ auth()->user()->role === 'admin' ? 'Manage Fines' : 'My Fines' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}" href="{{ route('reservations.index') }}">
                                <i class="bi bi-person-plus"></i> {{ auth()->user()->role === 'admin' ? 'Reservations' : 'My Waitlist' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-5 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 border-start border-5 border-success" role="alert">
                        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 border-start border-5 border-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
