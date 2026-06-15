<nav class="fixed top-0 left-0 right-0 h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-8 z-40 shadow-sm">
    <!-- Brand / Toggle -->
    <div class="flex items-center gap-4">
        <button class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 focus:outline-none transition-colors" id="sidebarToggle">
            <i class="fas fa-bars text-lg"></i>
        </button>
        <a class="flex items-center gap-2.5 font-extrabold text-xl text-slate-900 tracking-tight" href="#">
            <img src="{{ asset('src/img/logo.png') }}" class="h-8 w-8 object-contain" alt="Logo">
            <span>Sipenting Admin</span>
        </a>
    </div>



    <!-- User Profile Dropdown -->
    <div class="flex items-center gap-4">
        <div class="relative dropdown">
            <button class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none" id="navbarDropdown">
                <div class="h-8 w-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center font-semibold text-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? auth('puskesmas')->user()->name ?? auth('bapeda')->user()->name ?? 'A', 0, 1)) }}
                </div>
                <span class="hidden md:inline text-sm font-medium text-slate-700">
                    {{ auth()->user()->name ?? auth('puskesmas')->user()->name ?? auth('bapeda')->user()->name ?? 'Admin' }}
                </span>
                <i class="fas fa-chevron-down text-xs text-slate-400"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-lg shadow-lg py-1 z-50 list-none hidden" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium border-t border-slate-100" href="{{ route('logout-web') }}">
                        <i class="fas fa-sign-out-alt text-red-400"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Create Artikel (Bootstrap markup + Tailwind styling) -->
<div class="modal fade" id="modal-nomor" tabindex="-1" role="dialog" aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-2xl shadow-2xl overflow-hidden bg-white max-w-md w-full mx-auto">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h5 class="text-lg font-bold text-slate-800">Ganti Nomor Kontak</h5>
                <button type="button" class="text-slate-400 hover:text-slate-600" data-bs-dismiss="modal">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <form id="form-ganti-nomor">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="space-y-1.5">
                        <label for="nomor" class="text-sm font-semibold text-slate-700">Nomor Kontak <span class="text-red-500">*</span></label>
                        <input value="{{ Auth::user()->nomor ?? '' }}" type="text" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-colors" name="nomor" id="nomor" placeholder="Masukkan Nomor Baru" autofocus autocomplete="off">
                        <div class="invalid-feedback text-xs text-red-500 mt-1 nomor_error"></div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-150 rounded-xl transition-colors" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-sky-500/10 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Event delegation to handle clicks on dynamically generated buttons
        $(document).on('click', '.btn-nomor', function(event) {
            event.preventDefault(); // Prevent default link behavior
            $('#modal-nomor').modal('show'); // Show the modal
        });

        // Submit Form Create art
        $('#form-ganti-nomor').submit(function(e) {
            e.preventDefault();
            url = "{{ route('puskesmas.ganti-Nomor-Puskesmas') }}";

            var formData = new FormData($("#form-ganti-nomor")[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('*').removeClass('is-invalid');
                },
                success: function(response) {
                    $('#modal-nomor').modal('hide');
                    if (response.data && response.data.nomor) {
                        $('#nomor').val(response.data.nomor);
                        $('.btn-nomor').attr('data-nomor', response.data.nomor);
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Tersimpan!',
                        text: response.meta.message,
                        customClass: {
                            confirmButton: 'bg-sky-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md focus:outline-none'
                        },
                        buttonsStyling: false
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    switch (xhr.status) {
                        case 422:
                        var errors = xhr.responseJSON.meta.message;
                        var message = '';
                        $.each(errors, function(key, value) {
                            message = value;
                            $('*[name="' + key + '"]').addClass('is-invalid');
                            $('.invalid-feedback.' + key + '_error').html(value);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: message,
                            customClass: {
                                confirmButton: 'bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md focus:outline-none'
                            },
                            buttonsStyling: false
                        });
                        break;
                        default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan!',
                            customClass: {
                                confirmButton: 'bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md focus:outline-none'
                            },
                            buttonsStyling: false
                        });
                        break;
                    }
                }
            });
        })

        // Toggle Profile Dropdown manually
        $('#navbarDropdown').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).next('.dropdown-menu').toggleClass('hidden');
        });

        // Hide when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').addClass('hidden');
            }
        });
    })
</script>