<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Ajouter la police Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
 
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <!-- Header -->
        <div class="sidebar-header">
            <div class="logo me-2">
                 <img src="{{ asset('assets/images/logo_college_maisonneuve.png') }}" alt="Logo">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav flex-grow-1">
            <div class="nav-section">
                <a href="{{ route('etudiant.index') }}" class="nav-link text-white {{ request()->routeIs('etudiant.index') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    Étudiants
                </a>
                <a href="{{ route('etudiant.create') }}" class="nav-link text-white {{ request()->routeIs('etudiant.create') ? 'active' : '' }}">
                    <i class="bi bi-person-plus-fill"></i>
                    Nouvel étudiant
                </a>
            </div>
        </nav>

    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none me-1" type="button" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h1 class="page-title">
                  <div class="school-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>   
                @yield('page-title', 'Tableau de bord du collège')</h1>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            
            <!-- Page Content -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                 {{ session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @yield('content')
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay d-md-none" onclick="toggleSidebar()"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>