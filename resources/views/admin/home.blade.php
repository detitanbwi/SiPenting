@extends('admin.app')
@section('title', 'Dashboard')
@section('sub-title', 'Dashboard')

@section('content')
<!-- Hero Welcome Section -->
<div class="bg-gradient-to-r from-sky-500 to-indigo-600 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-sky-500/10 mb-8 relative overflow-hidden">
    <div class="relative z-10">
        <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang di Dashboard Sipenting! 👋</h2>
        <p class="text-sky-100 text-sm md:text-base max-w-xl">
            Pantau dan analisis status gizi dan stunting masyarakat secara mudah, cepat, dan real-time.
        </p>
    </div>
    <div class="absolute right-0 bottom-0 opacity-10 transform translate-y-6 translate-x-6 text-9xl">
        <i class="fas fa-chart-line"></i>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="h-12 w-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl font-bold">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Total Pengguna</div>
            <div class="text-2xl font-bold text-slate-900 mt-0.5">{{ $jumlahPengguna }}</div>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <div>
            <div class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Warga</div>
            <div class="text-2xl font-bold text-slate-900 mt-0.5">{{ $jumlahPenggunaNik3511 }}</div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
            <i class="fas fa-globe"></i>
        </div>
        <div>
            <div class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Non-Warga</div>
            <div class="text-2xl font-bold text-slate-900 mt-0.5">{{ $jumlahPenggunaNon3511 }}</div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Chart Card 1 -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center gap-3 bg-slate-50/50">
            <span class="text-sky-500"><i class="fas fa-chart-bar"></i></span>
            <h3 class="text-base font-bold text-slate-800">Total User Overview</h3>
        </div>
        <div class="p-6">
            <div class="relative h-64">
                <canvas id="myPenggunaChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart Card 2 -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center gap-3 bg-slate-50/50">
            <span class="text-emerald-500"><i class="fas fa-chart-pie"></i></span>
            <h3 class="text-base font-bold text-slate-800">Warga vs Non-Warga Distribution</h3>
        </div>
        <div class="p-6">
            <div class="relative h-64">
                <canvas id="myNikChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    Chart.defaults.global.defaultFontFamily = 'Outfit, Inter, sans-serif';
    Chart.defaults.global.defaultFontColor = '#64748b';

    var jumlahPengguna = {{ $jumlahPengguna }};

    // User Bar Chart
    var ctx = document.getElementById("myPenggunaChart");
    var myPenggunaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Total User"],
            datasets: [{
                label: "Jumlah User",
                backgroundColor: "#0ea5e9",
                hoverBackgroundColor: "#0284c7",
                barPercentage: 0.4,
                data: [jumlahPengguna],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    gridLines: { display: false }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        max: Math.ceil(jumlahPengguna * 1.2),
                        maxTicksLimit: 5
                    },
                    gridLines: { color: "#f1f5f9" }
                }],
            },
            legend: { display: false }
        }
    });

    // Doughnut Chart for NIK distribution
    var ctx2 = document.getElementById("myNikChart");
    var myNikChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ["Warga", "Non-Warga"],
            datasets: [{
                backgroundColor: ["#10b981", "#f59e0b"],
                hoverBackgroundColor: ["#059669", "#d97706"],
                borderWidth: 0,
                data: [{{ $jumlahPenggunaNik3511 }}, {{ $jumlahPenggunaNon3511 }}],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    padding: 20
                }
            },
            cutoutPercentage: 70
        }
    });
</script>
@endpush