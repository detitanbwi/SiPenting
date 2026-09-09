<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kebijakan Privasi (Privacy Policy) - SIPENTING</title>
    <link rel="icon" href="{{ asset('src/img/logo.png') }}" type="image/png">

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0284c7', // sky-600
                        primaryDark: '#0369a1',
                        accent: '#38bdf8',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        .prose h2 {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 antialiased min-h-screen flex flex-col">

    <!-- Navbar Header -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-3.5 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('src/img/logo.png') }}" alt="Logo SIPENTING" class="h-9 w-9 object-contain group-hover:scale-105 transition-transform">
                <div>
                    <span class="font-bold text-lg text-slate-800 tracking-tight">SIPENTING</span>
                    <p class="text-[11px] text-slate-500 font-medium hidden sm:block">Sistem Informasi Pencegahan &amp; Penanganan Stunting</p>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-sky-600 bg-slate-100 hover:bg-slate-200/80 px-3.5 py-2 rounded-lg transition-colors">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 py-10 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            
            <!-- Hero Card -->
            <div class="bg-gradient-to-br from-sky-600 via-sky-700 to-indigo-800 rounded-3xl p-6 sm:p-10 text-white shadow-xl shadow-sky-900/10 mb-8 relative overflow-hidden">
                <div class="absolute -right-8 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-sky-100 text-xs font-medium mb-4 backdrop-blur-sm">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Dokumen Resmi Kebijakan Privasi</span>
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-bold tracking-tight mb-3">Kebijakan Privasi (Privacy Policy)</h1>
                    <p class="text-sky-100 text-sm sm:text-base max-w-2xl leading-relaxed">
                        Kami menghargai dan berkomitmen menjaga privasi Anda. Dokumen ini menjelaskan bagaimana aplikasi <strong class="text-white">SIPENTING</strong> mengelola data pribadi pengguna sesuai ketentuan yang berlaku.
                    </p>
                    <div class="mt-5 pt-5 border-t border-white/15 flex flex-wrap items-center gap-4 text-xs text-sky-100">
                        <span><i class="fa-regular fa-calendar-check mr-1.5"></i> Terakhir diperbarui: <strong>September 2026</strong></span>
                        <span>&bull;</span>
                        <span><i class="fa-solid fa-mobile-screen-button mr-1.5"></i> Berlaku untuk: <strong>Aplikasi Mobile &amp; Portal Web SIPENTING</strong></span>
                    </div>
                </div>
            </div>

            <!-- Content Card -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-10 space-y-8 text-sm sm:text-base leading-relaxed text-slate-600">

                <!-- 1. Pendahuluan -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">1</span>
                        Pendahuluan
                    </h2>
                    <p>
                        Aplikasi <strong>SIPENTING</strong> (Sistem Informasi Pencegahan &amp; Penanganan Stunting) dikembangkan untuk membantu masyarakat, tenaga kesehatan (Bidan, Petugas Puskesmas), serta instansi terkait (Bappeda dan Dinas Kesehatan) dalam pemantauan status gizi anak, pencatatan tumbuh kembang balita, deteksi risiko stunting, serta koordinasi jadwal Posyandu.
                    </p>
                    <p class="mt-2">
                        Dengan menggunakan aplikasi ini, Anda menyatakan menyetujui pengumpulan dan penggunaan informasi sebagaimana dijelaskan dalam Kebijakan Privasi ini.
                    </p>
                </section>

                <hr class="border-slate-100">

                <!-- 2. Data yang Dikumpulkan -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">2</span>
                        Data yang Kami Kumpulkan
                    </h2>
                    <p class="mb-3">Untuk menyediakan layanan yang optimal, aplikasi mengumpulkan beberapa jenis informasi:</p>
                    <div class="grid sm:grid-cols-2 gap-4 mt-3">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <h3 class="font-semibold text-slate-800 text-sm mb-1.5 flex items-center gap-2">
                                <i class="fa-regular fa-user text-sky-600"></i> Data Identitas Akun
                            </h3>
                            <ul class="text-xs sm:text-sm space-y-1 text-slate-600 list-disc list-inside">
                                <li>Nama lengkap dan alamat email</li>
                                <li>Nomor telepon / WhatsApp aktif</li>
                                <li>Peran akun (Masyarakat, Bidan, Puskesmas, Bappeda)</li>
                                <li>Informasi wilayah (Desa, Kecamatan, Posyandu)</li>
                            </ul>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <h3 class="font-semibold text-slate-800 text-sm mb-1.5 flex items-center gap-2">
                                <i class="fa-solid fa-heart-pulse text-sky-600"></i> Data Tumbuh Kembang &amp; Kesehatan
                            </h3>
                            <ul class="text-xs sm:text-sm space-y-1 text-slate-600 list-disc list-inside">
                                <li>Data balita (nama, tanggal lahir, jenis kelamin)</li>
                                <li>Pengukuran berkala (berat badan, tinggi/panjang badan, lingkar kepala)</li>
                                <li>Data kehamilan ibu (usia kehamilan, lingkar lengan atas/LILA)</li>
                                <li>Hasil kalkulasi gizi dan status stunting</li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 mt-4">
                        <h3 class="font-semibold text-slate-800 text-sm mb-1.5 flex items-center gap-2">
                            <i class="fa-solid fa-bell text-sky-600"></i> Data Perangkat &amp; Notifikasi
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600">
                            Aplikasi menggunakan identifier perangkat (Player ID / Subscription ID dari OneSignal) semata-mata untuk mengirimkan pemberitahuan penting, seperti jadwal Posyandu dan edukasi kesehatan. Kami <strong>tidak</strong> melacak lokasi fisik GPS secara konstan ataupun mengakses file pribadi tanpa izin.
                        </p>
                    </div>
                </section>

                <hr class="border-slate-100">

                <!-- 3. Tujuan Penggunaan Data -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">3</span>
                        Tujuan Penggunaan Data
                    </h2>
                    <ul class="space-y-2 text-slate-600 list-disc list-inside">
                        <li><strong>Kalkulator Gizi &amp; Deteksi Stunting:</strong> Menghitung dan menyajikan grafik pertumbuhan anak berdasarkan standar antropometri kesehatan.</li>
                        <li><strong>Pelayanan Posyandu:</strong> Membantu Bidan dan kader Posyandu menyusun jadwal kunjungan, rekam gizi bulanan, dan intervensi dini.</li>
                        <li><strong>Konsultasi Puskesmas:</strong> Menghubungkan pengguna dengan kontak WhatsApp resmi Puskesmas terdekat sesuai wilayah tempat tinggal.</li>
                        <li><strong>Monitoring Kebijakan Publik:</strong> Memberikan data agregat statistik bagi Puskesmas, Dinas Kesehatan, dan Bappeda guna perencanaan intervensi penurunan stunting.</li>
                        <li><strong>Pengingat (Notifikasi):</strong> Mengingatkan orang tua mengenai jadwal posyandu dan artikel gizi terkini.</li>
                    </ul>
                </section>

                <hr class="border-slate-100">

                <!-- 4. Keamanan & Kerahasiaan Data -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">4</span>
                        Keamanan &amp; Kerahasiaan Data
                    </h2>
                    <p>
                        Keamanan data kesehatan dan informasi pribadi Anda adalah prioritas utama kami. Langkah-langkah perlindungan yang kami terapkan:
                    </p>
                    <ul class="mt-2 space-y-1.5 list-disc list-inside">
                        <li>Kata sandi akun disimpan dalam bentuk terenkripsi satu arah (hashing).</li>
                        <li>Komunikasi data antara aplikasi dan server menggunakan protokol aman (HTTPS/SSL).</li>
                        <li><strong>Hak Akses Berjenjang (Role-Based Access):</strong> Bidan hanya dapat mengakses data balita di wilayah kerjanya; Puskesmas dan Bappeda mengakses laporan rekapitulasi sesuai kewenangan wilayah.</li>
                        <li><strong>Tidak Ada Komersialisasi:</strong> Kami <strong>tidak pernah menjual, menyewakan, atau membagikan</strong> data pribadi kepada pengiklan atau pihak ketiga komersial manapun.</li>
                    </ul>
                </section>

                <hr class="border-slate-100">

                <!-- 5. Layanan Pihak Ketiga -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">5</span>
                        Layanan Pihak Ketiga (Third-Party Services)
                    </h2>
                    <p class="mb-2">Aplikasi mengintegrasikan beberapa layanan pihak ketiga terpercaya untuk menunjang fungsi teknis:</p>
                    <ul class="space-y-2 list-disc list-inside">
                        <li><strong>OneSignal Push Notification:</strong> Digunakan untuk pengiriman notifikasi pengingat jadwal posyandu ke ponsel pengguna.</li>
                        <li><strong>WhatsApp Link Integration:</strong> Membuka tautan obrolan langsung ke kontak resmi Puskesmas ketika pengguna memilih opsi konsultasi.</li>
                    </ul>
                </section>

                <hr class="border-slate-100">

                <!-- 6. Hak Pengguna & Penghapusan Data (Data Deletion) -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">6</span>
                        Hak Pengguna &amp; Penghapusan Data (Data Deletion)
                    </h2>
                    <p>Anda memiliki hak penuh atas data pribadi Anda, termasuk:</p>
                    <ul class="mt-2 space-y-1.5 list-disc list-inside">
                        <li>Melihat dan memperbarui profil pribadi Anda secara langsung melalui menu Profil di aplikasi.</li>
                        <li>Meminta koreksi riwayat pencatatan tumbuh kembang anak kepada Bidan/Kader Posyandu setempat.</li>
                        <li>
                            <strong>Permohonan Penghapusan Akun &amp; Data:</strong> Jika Anda ingin menghapus akun serta seluruh data terkait dari sistem kami, Anda dapat menghubungi tim pengembang melalui email atau tautan WhatsApp yang tercantum di bagian Kontak di bawah ini. Permohonan Anda akan diproses maksimal dalam 7 (tujuh) hari kerja.
                        </li>
                    </ul>
                </section>

                <hr class="border-slate-100">

                <!-- 7. Kebijakan Privasi Anak -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">7</span>
                        Kebijakan Privasi Khusus Data Balita &amp; Anak
                    </h2>
                    <p>
                        Aplikasi SIPENTING mencatat data antropometri anak (seperti nama, usia, berat badan, dan tinggi badan). Data ini <strong>wajib dimasukkan oleh orang tua yang sah atau tenaga kesehatan resmi (Bidan/Kader Posyandu)</strong> semata-mata untuk tujuan pemantauan status kesehatan dan tumbuh kembang anak. Kami tidak mengumpulkan data pribadi anak di luar keperluan kesehatan tersebut.
                    </p>
                </section>

                <hr class="border-slate-100">

                <!-- 8. Perubahan Kebijakan Privasi -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">8</span>
                        Perubahan atas Kebijakan Privasi
                    </h2>
                    <p>
                        Kami dapat memperbarui dokumen Kebijakan Privasi ini sewaktu-waktu guna menyesuaikan dengan perkembangan fitur aplikasi atau peraturan perundang-undangan. Setiap pembaruan akan dicantumkan pada halaman ini dengan tanggal pembaruan terbaru.
                    </p>
                </section>

                <hr class="border-slate-100">

                <!-- 9. Kontak & Pengembang -->
                <section>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-800 mb-3 flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-600 text-xs font-bold">9</span>
                        Kontak Kami
                    </h2>
                    <p class="mb-4">
                        Jika Anda memiliki pertanyaan, keluhan, atau permintaan terkait Kebijakan Privasi ini, silakan hubungi tim kami melalui:
                    </p>
                    <div class="p-5 rounded-2xl bg-sky-50/70 border border-sky-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <p class="font-bold text-slate-800 text-sm sm:text-base">Tim Pengembang &amp; Pengelola SIPENTING</p>
                            <p class="text-xs sm:text-sm text-slate-600 mt-0.5">Sistem Informasi Pencegahan &amp; Penanganan Stunting</p>
                            <p class="text-xs text-slate-500 mt-1"><i class="fa-solid fa-envelope mr-1 text-sky-600"></i> Email Dukungan: support@sipenting.id</p>
                        </div>
                        <a target="_blank" href="https://wa.me/6281216532315?text=Halo%20Admin%20Sipenting,%20saya%20ingin%20bertanya%20mengenai%20Kebijakan%20Privasi" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm transition-colors whitespace-nowrap">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    </div>
                </section>

            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
            <div>Copyright &copy; SIPENTING 2026. Seluruh hak cipta dilindungi.</div>
            <div class="flex items-center gap-3 font-medium">
                <a href="{{ route('privacy-policy') }}" class="text-sky-600 font-semibold">Privacy Policy</a>
                <span>&bull;</span>
                <a target="_blank" href="https://wa.me/6281216532315" class="hover:text-slate-800 transition-colors">Kontak Pengembang</a>
            </div>
        </div>
    </footer>

</body>
</html>
