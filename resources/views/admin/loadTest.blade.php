<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipenting - Load Test</title>
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-tr from-slate-950 via-slate-900 to-indigo-950 min-h-screen flex items-center justify-center p-4 font-sans text-slate-100 antialiased overflow-hidden">

    <!-- Ambient glow elements -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl -z-10 animate-pulse"></div>

    <!-- Main Container -->
    <div class="w-full max-w-lg">
        <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 shadow-2xl space-y-8 relative overflow-hidden">
            <!-- Glass header card decoration -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-sky-500 via-indigo-500 to-purple-500"></div>

            <!-- Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center p-3.5 bg-indigo-500/10 text-indigo-400 rounded-2xl border border-indigo-500/20 mb-3">
                    <i class="fas fa-gauge-high text-3xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight text-white">Database Load Test</h1>
                <p class="text-sm text-slate-400">Uji performa query database Sipenting secara real-time</p>
            </div>

            <!-- Stats & Info -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-slate-950/40 border border-slate-800/60 rounded-2xl p-4 text-center">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Total Data</span>
                    <span class="text-xl font-bold text-slate-200" id="stat-total">{{ $totalUsers }}</span>
                </div>
                <div class="bg-slate-950/40 border border-slate-800/60 rounded-2xl p-4 text-center">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Ukuran Batch</span>
                    <span class="text-xl font-bold text-slate-200">10 / request</span>
                </div>
            </div>

            <!-- Progress & Controls Section -->
            <div class="space-y-6">
                <!-- Progress bar (hidden initially) -->
                <div id="progress-container" class="space-y-3 hidden">
                    <div class="flex justify-between items-center text-sm font-semibold">
                        <span class="text-indigo-400 flex items-center gap-2">
                            <i class="fas fa-spinner animate-spin"></i>
                            <span id="progress-status">Memuat data...</span>
                        </span>
                        <span class="text-slate-300" id="progress-text">0 / {{ $totalUsers }}</span>
                    </div>
                    <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden p-0.5 border border-slate-700/50">
                        <div id="progress-bar" class="w-0 h-full bg-gradient-to-r from-sky-500 to-indigo-500 rounded-full transition-all duration-300 shadow-lg shadow-indigo-500/20"></div>
                    </div>
                </div>

                <!-- Result panel -->
                <div id="result-panel" class="bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-5 space-y-3 hidden">
                    <div class="flex items-center gap-3 text-emerald-400">
                        <div class="p-1.5 bg-emerald-500/20 rounded-lg">
                            <i class="fas fa-check-circle text-lg"></i>
                        </div>
                        <span class="font-bold text-base">Test Passed!</span>
                    </div>
                    <div class="text-sm text-slate-300 leading-relaxed">
                        Proses pemuatan selesai dengan sukses. 
                        <span class="block mt-2 font-semibold text-white">Durasi total: <span id="result-duration" class="text-emerald-400 font-bold">0</span> ms</span>
                    </div>
                </div>

                <!-- Start Button -->
                <button id="btn-start" class="w-full py-4 px-6 bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-500 hover:to-indigo-500 text-white font-bold rounded-2xl shadow-lg shadow-indigo-600/20 hover:shadow-indigo-500/30 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-3">
                    <i class="fas fa-play text-sm"></i>
                    <span>Mulai Load Test</span>
                </button>
            </div>

            <!-- Footer info -->
            <div class="text-center text-xs text-slate-500">
                Sipenting Admin &bull; Public Benchmark Page
            </div>
        </div>
    </div>

    <!-- jQuery for AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const totalUsers = parseInt("{{ $totalUsers }}");
            const batchSize = 10;
            let offset = 0;
            let totalDuration = 0;
            let isRunning = false;

            $('#btn-start').click(function() {
                if (isRunning) return;

                // Reset UI
                isRunning = true;
                offset = 0;
                totalDuration = 0;
                $('#btn-start').addClass('opacity-50 cursor-not-allowed').find('span').text('Menjalankan Uji Coba...');
                $('#btn-start').find('i').attr('class', 'fas fa-spinner animate-spin');
                $('#progress-container').removeClass('hidden');
                $('#result-panel').addClass('hidden');
                updateProgress(0);

                // Start batch query loop
                runNextBatch();
            });

            function runNextBatch() {
                if (offset >= totalUsers) {
                    finishTest();
                    return;
                }

                $.ajax({
                    url: "{{ route('load-test.run', [], false) }}",
                    type: "GET",
                    data: {
                        limit: batchSize,
                        offset: offset
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            totalDuration += response.duration;
                            offset += response.count;
                            
                            // Prevent infinite loops if count is somehow 0
                            if (response.count === 0) {
                                offset = totalUsers;
                            }

                            updateProgress(offset);
                            
                            // Run next chunk
                            setTimeout(runNextBatch, 50); // small delay to visualize progress smoothly
                        } else {
                            handleError();
                        }
                    },
                    error: function() {
                        handleError();
                    }
                });
            }

            function updateProgress(current) {
                const percent = Math.min(100, Math.round((current / totalUsers) * 100));
                $('#progress-bar').css('w', percent + '%'); // Fallback style
                $('#progress-bar').width(percent + '%');
                $('#progress-text').text(current + ' / ' + totalUsers);
            }

            function finishTest() {
                isRunning = false;
                $('#btn-start').removeClass('opacity-50 cursor-not-allowed').find('span').text('Mulai Load Test');
                $('#btn-start').find('i').attr('class', 'fas fa-play');
                $('#progress-container').addClass('hidden');
                
                // Show result
                $('#result-panel').removeClass('hidden');
                $('#result-duration').text(totalDuration.toFixed(2));
            }

            function handleError() {
                isRunning = false;
                $('#btn-start').removeClass('opacity-50 cursor-not-allowed').find('span').text('Mulai Load Test');
                $('#btn-start').find('i').attr('class', 'fas fa-play');
                alert('Terjadi kesalahan saat menjalankan load test.');
            }
        });
    </script>
</body>
</html>
