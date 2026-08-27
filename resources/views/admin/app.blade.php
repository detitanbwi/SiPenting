<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sipenting Admin Dashboard" />
    <meta name="author" content="Antigravity" />

    <link rel="icon" href="{{ asset('src/img/logo.png') }}" type="image/png">
    <title>@yield('title') - Sipenting</title>

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#4f46e5',
                        darkbg: '#0b0f19',
                        sidebar: '#111827',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    @stack('css')

    <style>
        /* Smooth transitions for full-height sidebar toggle */
        #layoutSidenav_nav {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #layoutSidenav_content {
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @media (min-width: 1024px) {
            body.sb-sidenav-toggled #layoutSidenav_nav {
                width: 5rem;
            }
            body.sb-sidenav-toggled #layoutSidenav_content {
                padding-left: 5rem;
            }
            body.sb-sidenav-toggled .sidebar-text,
            body.sb-sidenav-toggled .sidebar-arrow,
            body.sb-sidenav-toggled .sidebar-header,
            body.sb-sidenav-toggled .sidebar-footer-text {
                display: none !important;
            }
            body.sb-sidenav-toggled .nav-link {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
            }
            body.sb-sidenav-toggled .sidebar-footer {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
                align-items: center;
            }
            body.sb-sidenav-toggled .sidebar-logout-btn {
                padding-left: 0 !important;
                padding-right: 0 !important;
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 9999px;
                margin-top: 0 !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
        @media (max-width: 1023.98px) {
            #layoutSidenav_nav {
                transform: translateX(-100%);
            }
            body.sb-sidenav-toggled #layoutSidenav_nav {
                transform: translateX(0);
            }
        }

        /* Fix Tailwind & Bootstrap collapse utility conflict */
        .collapse:not(.show) {
            display: none !important;
        }
        .collapse.show {
            visibility: visible !important;
            display: block !important;
        }

        /* Essential Bootstrap Modal CSS when using Tailwind without Bootstrap CSS */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1055;
            display: none;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
            background-color: rgba(15, 23, 42, 0.4); /* soft slate backdrop */
            backdrop-filter: blur(4px);
        }
        .modal-dialog {
            position: relative;
            width: auto;
            margin: 1.75rem auto;
            pointer-events: none;
            max-width: 500px;
        }
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 3.5rem);
        }
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }
        .modal.show .modal-dialog {
            transform: none;
        }
        .modal.show {
            display: block !important;
        }
        .modal-open {
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-[#f8fafc] font-sans text-slate-800 antialiased min-h-screen flex flex-col">
    @include('admin.navbar')
    
    <div id="layoutSidenav" class="flex flex-1 pt-16 relative overflow-hidden">
        @include('admin.sidebar')
        
        <div id="layoutSidenav_content" class="flex flex-col flex-1 w-full lg:pl-64 min-h-[calc(100vh-4rem)]">
            <main class="flex-grow p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Page Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">@yield('sub-title')</h1>
                        <nav class="flex mt-2 text-sm text-slate-400" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                                <li class="inline-flex items-center">
                                    <span class="text-slate-400 mr-2"><i class="fas fa-home"></i></span>
                                    <span class="font-medium">Admin</span>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <span class="text-slate-400 mx-2"><i class="fas fa-chevron-right text-xs"></i></span>
                                        <span class="font-semibold text-slate-600">@yield('sub-title')</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Page Content -->
                    <div class="grid grid-cols-1 gap-6">
                        @yield('content')
                    </div>
                </div>
            </main>
            
            @include('admin.footer')
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery MUST be loaded first, before any page-specific scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    @stack('scripts')
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('src/admin/js/scripts.js') }}"></script>
</body>
</html>