<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('lang.menu_title') - @yield('title', 'Dashboard')</title>

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
            
            <!-- Section Accueil (visible pour tous) -->
            <div class="nav-section">
                <div class="nav-section-title text-white-50 px-3">@lang('lang.menu_main_nav')</div>
                <a href="{{ route('articles.index') }}" class="nav-link text-white {{ request()->routeIs('article.index') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    @lang('lang.home')
                </a>
            </div>

            @guest
                <!-- MENU POUR UTILISATEURS NON CONNECTÉS -->
                <div class="nav-section">
                    <div class="nav-section-title text-white-50 px-3">@lang('lang.menu_account')</div>
                    <a href="{{ route('login') }}" class="nav-link text-white {{ request()->routeIs('login') ? 'active' : '' }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        @lang('lang.login')
                    </a>
                    <a href="{{ route('user.create') }}" class="nav-link text-white {{ request()->routeIs('user.create') ? 'active' : '' }}">
                        <i class="bi bi-person-plus-fill"></i>
                        @lang('lang.new_user')
                    </a>
                </div>
            @else

            <!-- MENU POUR UTILISATEURS CONNECTÉS -->
                
                <!-- Section Étudiants -->
                <div class="nav-section">
                    <div class="nav-section-title text-white-50 px-3">@lang('lang.menu_manage_students')</div>
                    <a href="{{ route('etudiant.index') }}" class="nav-link text-white {{ request()->routeIs('etudiant.index') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        @lang('lang.students_list')
                    </a>
                    <a href="{{ route('etudiant.create') }}" class="nav-link text-white {{ request()->routeIs('etudiant.create') ? 'active' : '' }}">
                        <i class="bi bi-person-plus-fill"></i>
                        @lang('lang.new_student')
                    </a>
                </div>
                
                <!-- Section Forum -->
                <div class="nav-section">
                    <div class="nav-section-title text-white-50 px-3">@lang('lang.menu_forum')</div>
                    <a href="{{ route('articles.index') }}" class="nav-link text-white {{ request()->routeIs('article.index') ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i>
                        @lang('lang.all_articles')
                    </a>
                    <a href="{{ route('article.create') }}" class="nav-link text-white {{ request()->routeIs('article.create') ? 'active' : '' }}">
                        <i class="bi bi-journal-plus"></i>
                        @lang('lang.new_article')
                    </a>
                </div>
                
                <!-- Section Documents-->
                <div class="nav-section">
                    <div class="nav-section-title text-white-50 px-3">@lang('lang.documents_directory')</div>
                    <a href="{{ route('document.index') }}" class="nav-link text-white {{ request()->routeIs('article.index') ? 'active' : '' }}">
                        <i class="bi bi-folder-fill"></i>
                        @lang('lang.list_documents')
                    </a>
                    <a href="{{ route('document.create') }}" class="nav-link text-white {{ request()->routeIs('article.index') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-arrow-up"></i>
                        @lang('lang.share_document')
                    </a>
                </div>
                
                <!-- Section Compte -->
                <div class="nav-section">
                    <div class="nav-section-title text-white-50 px-3">@lang('lang.menu_account')</div>
                    <div class="nav-link text-white disabled" style="opacity: 0.8;">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name }}
                    </div>
                    <a href="{{ route('logout') }}" class="nav-link text-white">
                        <i class="bi bi-box-arrow-right"></i>
                        @lang('lang.logout')
                    </a>
                </div>
            @endguest

            <!-- Sélecteur de langue (visible pour tous) -->
            <div class="language-selector">
                <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe me-2"></i> @lang('lang.language')
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('lang', 'fr') }}">
                                <i class="bi bi-flag-fill me-2"></i>
                                @lang('lang.french')
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('lang', 'en') }}">
                                <i class="bi bi-flag me-2"></i>
                                @lang('lang.english')
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="main-header d-flex flex-row justify-content-between">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none me-1" type="button" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h1 class="page-title">
                    <div class="school-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div> 
                    <div>@lang('lang.menu_title')</div>  
                </h1>
            </div>

            <div class="header-subtitle ml-3">
                    @auth
                        @lang('lang.welcome') {{ Auth::user() ? Auth::user()->name : '' }}
                    @endauth
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

            <!-- Content -->
            @yield('content')
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay d-md-none" onclick="toggleSidebar()"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   <script src="{{ asset('assets/js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>