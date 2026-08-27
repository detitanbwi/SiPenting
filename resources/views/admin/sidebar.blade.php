<style>
    #sidenavAccordion::-webkit-scrollbar {
        display: none;
    }
    #sidenavAccordion {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
<div id="layoutSidenav_nav" class="fixed top-16 bottom-0 left-0 w-64 bg-slate-900 border-r border-slate-800 text-slate-300 shadow-lg z-30 flex flex-col justify-between overflow-hidden">
    <nav class="flex-grow overflow-y-auto px-0 py-6" id="sidenavAccordion">
        <div class="space-y-6">
            <!-- Main Menu Category -->
            <div>
                <div class="sidebar-header text-[11px] font-bold uppercase tracking-wider text-slate-500 px-6 mb-3">Menu Utama</div>
                <div class="space-y-0.5">
                    <a class="nav-link flex items-center px-6 py-3 text-[15px] font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-150 gap-3.5 {{ request()->routeIs('home') ? 'bg-indigo-600 text-white' : '' }}" href="{{ route('home') }}">
                        <div class="text-base min-w-[20px] text-center text-slate-400 group-hover:text-white {{ request()->routeIs('home') ? 'text-white' : '' }}"><i class="fas fa-chart-pie"></i></div>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                    
                    <a class="nav-link flex items-center px-6 py-3 text-[15px] font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-150 gap-3.5 {{ request()->routeIs('artikel*') ? 'bg-indigo-600 text-white' : '' }}" href="{{ route('artikel.viewArtikel') }}">
                        <div class="text-base min-w-[20px] text-center text-slate-400 group-hover:text-white {{ request()->routeIs('artikel*') ? 'text-white' : '' }}"><i class="fas fa-file-alt"></i></div>
                        <span class="sidebar-text">Artikel</span>
                    </a>

                    @if (auth('puskesmas')->check())
                    <a class="nav-link btn-nomor flex items-center px-6 py-3 text-[15px] font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-150 gap-3.5" href="#">
                        <div class="text-base min-w-[20px] text-center text-slate-400"><i class="fas fa-phone-alt"></i></div>
                        <span class="sidebar-text">Nomor Kontak</span>
                    </a>
                    @endif
                    
                    @if (auth('bapeda')->check())
                    <a class="nav-link flex items-center px-6 py-3 text-[15px] font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-150 gap-3.5 {{ request()->routeIs('*puskesmas*') ? 'bg-indigo-600 text-white' : '' }}" href="{{ route('bapeda.viewAkunPuskesmas') }}">
                        <div class="text-base min-w-[20px] text-center text-slate-400 group-hover:text-white {{ request()->routeIs('*puskesmas*') ? 'text-white' : '' }}"><i class="fas fa-hospital"></i></div>
                        <span class="sidebar-text">Akun Puskesmas</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Graph Data Category -->
            <div>
                <div class="sidebar-header text-[11px] font-bold uppercase tracking-wider text-slate-500 px-6 mb-3">Grafik & Data</div>
                <div class="space-y-0.5">
                    <!-- Ibu Hamil Menu -->
                    <a class="nav-link flex items-center justify-between px-6 py-3 text-[15px] font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-150" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseIbu" aria-expanded="false" aria-controls="collapseIbu">
                        <div class="flex items-center gap-3.5">
                            <div class="text-base min-w-[20px] text-center text-slate-400"><i class="fas fa-female"></i></div>
                            <span class="sidebar-text">Data Ibu Hamil</span>
                        </div>
                        <div class="sidebar-arrow text-xs text-slate-400"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseIbu" data-bs-parent="#sidenavAccordion">
                        <div class="pl-14 py-1 space-y-0.5 bg-slate-950/20">
                            <a class="flex items-center py-2 text-[14px] text-slate-400 hover:text-white font-medium transition-colors" href="{{ route('ibu-hamil.ibu-hamil-daftar') }}">
                                <span class="sidebar-text">Daftar Ibu</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Anak Menu -->
                    <a class="nav-link flex items-center justify-between px-6 py-3 text-[15px] font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-150" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnak" aria-expanded="false" aria-controls="collapseAnak">
                        <div class="flex items-center gap-3.5">
                            <div class="text-base min-w-[20px] text-center text-slate-400"><i class="fas fa-baby"></i></div>
                            <span class="sidebar-text">Data Anak</span>
                        </div>
                        <div class="sidebar-arrow text-xs text-slate-400"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAnak" data-bs-parent="#sidenavAccordion">
                        <div class="pl-14 py-1 space-y-0.5 bg-slate-950/20">
                            <a class="flex items-center py-2 text-[14px] text-slate-400 hover:text-white font-medium transition-colors" href="{{ route('anak.daftar-anak') }}">
                                <span class="sidebar-text">Daftar Anak</span>
                            </a>
                            <a class="flex items-center py-2 text-[14px] text-slate-400 hover:text-white font-medium transition-colors" href="{{ route('anak.daftar-kecamatan-gizi') }}">
                                <span class="sidebar-text">Gizi Kecamatan</span>
                            </a>
                            <a class="flex items-center py-2 text-[14px] text-slate-400 hover:text-white font-medium transition-colors" href="{{ route('anak.daftar-kecamatan-stunting') }}">
                                <span class="sidebar-text">Stunting Kecamatan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Footer Section -->
    <div class="sidebar-footer py-3 px-6 border-t border-slate-800/80 bg-slate-950/40 flex flex-col gap-2">
        <div class="sidebar-footer-text text-[10px] text-slate-500 font-medium uppercase tracking-wider">Pengguna:</div>
        <div class="sidebar-footer-text text-xs text-slate-400 font-normal truncate flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
            {{ auth()->user()->name ?? auth('puskesmas')->user()->name ?? auth('bapeda')->user()->name ?? 'Tidak Dikenal' }}
        </div>
        <a href="{{ route('logout-web') }}" class="sidebar-logout-btn mt-2 flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
            <i class="fas fa-sign-out-alt"></i>
            <span class="sidebar-text">Keluar</span>
        </a>
    </div>
</div>