@extends('admin.app')
@section('title', 'Akun Puskesmas')
@section('sub-title', 'Dashboard / Akun Puskesmas')

@push('css')
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('src/compiled/css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('src/compiled/css/app-dark.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('src/compiled/css/iconly.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('src/compiled/css/table-datatable.css') }}">
    <style>
        .scrollable-description {
            max-height: 100px !important; /* Batas tinggi cell deskripsi */
            /* max-width: 300px !important; */
            overflow-y: auto !important; /* Menampilkan scrollbar vertikal jika teks terlalu panjang */
            overflow-x: hidden !important; /* Menyembunyikan scrollbar horizontal */
            word-wrap: break-word !important; /* Memastikan teks terbungkus di dalam cell */
            display: block;
        }
        
        /* Loading button animation */
        #btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        
        .btn-loading {
            display: inline-flex;
            align-items: center;
        }
        
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }
    </style>
     
@endpush

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable
            </div>
            <div class="card-body">
                <table class="table" id="table-akun-puskesmas">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Nomor</th>
                            <th>Daerah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal add and ganti Password -->
<div class="modal fade" id="modal-akun" tabindex="-1" role="dialog" aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atur Akun</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
              <i data-feather="x"></i>
          </button>
        </div>
        <form id="form-akun">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                  <label for="nama">Nama Puskesmas <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nama" id="nama" autofocus autocomplete="off">
                  <div class="invalid-feedback nama_error"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                  <label for="nomor">Nomor Kontak <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nomor" id="nomor" autofocus autocomplete="off">
                  <div class="invalid-feedback nomor_error"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                  <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                  <select class="form-select" name="kabupaten" id="kabupaten">
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($dataKabupaten as $kab)
                        <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback kabupaten_error"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                  <label for="kec">Kecamatan <span class="text-danger">*</span></label>
                  <select class="form-select" name="kec" id="kec">
                    <option value="">-- Pilih Kecamatan --</option>
                  </select>
                  <div class="invalid-feedback kec_error"></div>
                </div>
              </div>
            </div>

            <div class="row" id="desa-container" style="display: none;">
                <div class="col-12">
                    <div class="form-group">
                        <label for="desa">Desa <span class="text-danger">*</span></label>
                        <select class="form-select" name="desa[]" id="desa" multiple></select>
                        <div class="invalid-feedback desa_error"></div>
                    </div>
                </div>
            </div>


            <div class="row">
              <div class="col-12">
                <label for="password">Password <span class="text-danger">*</span></label>
                <div class="form-group input-group">
                  <input type="text" class="form-control" name="password" id="password" autofocus autocomplete="off">
                  <div class="invalid-feedback password_error"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                  <label for="confirm_password">Konfirmasi Password <span class="text-danger">*</span></label>
                <div class="form-group input-group">
                  <input type="text" class="form-control" name="confirm_password" id="confirm_password" autofocus autocomplete="off">
                  <div class="invalid-feedback confirm_password_error"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn" data-bs-dismiss="modal">
                  <i class="bx bx-x d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Batal</span>
              </button>
              <button type="submit" class="btn btn-primary ms-1" id="btn-submit">
                  <i class="bx bx-check d-block d-sm-none"></i>
                  <span class="d-none d-sm-block btn-text">Simpan</span>
                  <span class="d-none btn-loading">
                      <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                      Menyimpan...
                  </span>
              </button>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection

@push('scripts')

<!-- CSS Choices -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- JS Choices -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


{{-- <script src="{{ asset('src/compiled/js/app.js') }}"></script> --}}
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>

<script src="{{ asset('src/admin/js/datatables-simple-demo.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.modal').on('hidden.bs.modal', function(e) {
            $('form').trigger('reset');
            $('*').removeClass('is-invalid');
            $('.custom-file-label').html('Pilih file...');
            idAkunPuskesmas = undefined;

            const desaContainer = document.getElementById('desa-container');
            const desaSelect = document.getElementById('desa');

            // Sembunyikan container
            desaContainer.style.display = 'none';

            // Kosongkan isi select desa
            desaSelect.innerHTML = '';

            // Hapus instance Choices jika ada
            if (desaChoices) {
                desaChoices.destroy();
                desaChoices = null;
            }
        });

        let desaChoices = null;

        // Ketika kabupaten berubah, fetch kecamatan
        document.getElementById('kabupaten').addEventListener('change', function () {
            const kabupatenId = this.value;
            const kecSelect = document.getElementById('kec');
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            // reset desa
            initDesaChoices(null);

            if (!kabupatenId) return;

            $.ajax({
                type: 'GET',
                url: '{{ route('api.kecamatan') }}',
                data: { id_kabupaten: kabupatenId },
                success: function(response) {
                    if (response.data) {
                        response.data.forEach(function(kec) {
                            kecSelect.append(new Option(kec.name, kec.id));
                        });
                    }
                }
            });
        });

        // Ketika kecamatan berubah, fetch desa
        document.getElementById('kec').addEventListener('change', function () {
            const selectedKec = this.value;
            initDesaChoices(selectedKec);
        });

        var idAkunPuskesmas;
        let url;
        let urlView = '{{ route('bapeda.viewAkunPuskesmas') }}';

        let tableAkunPuskesmas = $('#table-akun-puskesmas').DataTable({
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
            ajax: {
                url: urlView,
                type: "GET"
            },
            layout: {
                topStart: {
                    buttons: [
                        {
                            text: '<i class="fas fa-plus mr-2"></i> Tambah Data',
                            className: 'btn btn-primary mb-2 mt-2',
                            action: function(e, dt, node, config) {
                                $('#modal-akun').modal('show');
                            }
                        }
                    ]
                },
            },
            columnDefs: [
                {
                    targets: 0,
                    data: null,
                    className: 'text-center align-middle',
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    targets: 1,
                    data: 'name',
                    className: 'text-center align-middle',
                    render: function(data, type, row, meta) {
                        return data;
                    }
                },
                {
                    targets: 2,
                    data: 'nomor',
                    className: 'text-center align-middle',
                    render: function(data, type, row, meta) {
                        return data;
                    }
                },
                {
                    targets: 3,
                    data: 'districts.name',
                    className: 'text-center align-middle',
                    render: function(data, type, row, meta) {
                        return data;
                    }
                },
                {
                    targets: 4,
                    data: null,
                    className: 'text-center align-middle',
                    render: function(data, type, row, meta) {
                        $button = `<button class="btn btn-warning btn-pw" title="Ubah">Ubah</button>
                        <button class="btn btn-danger btn-hapus" title="Hapus">Hapus</button>`;
                        return $button;
                    }
                },
            ],
        });

        // open modal
        $('#table-akun-puskesmas tbody').on('click', '.btn-pw', function() {
            var data = tableAkunPuskesmas.row($(this).parents('tr')).data();
            idAkunPuskesmas = data.id;

            // set nilai form
            $('input[name="nama"]').val(data.name);
            $('input[name="nomor"]').val(data.nomor);

            // Ambil ID kecamatan dan desa terpilih
            const districtId = data.districts.id;
            const regencyId = data.districts.regency_id;
            const desaTerpilih = data.villages.map(v => v.id.toString());

            // Set kabupaten, lalu fetch kecamatan, lalu set kecamatan dan desa
            $('#kabupaten').val(regencyId);
            const kecSelect = document.getElementById('kec');
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            $.ajax({
                type: 'GET',
                url: '{{ route('api.kecamatan') }}',
                data: { id_kabupaten: regencyId },
                success: function(response) {
                    if (response.data) {
                        response.data.forEach(function(kec) {
                            kecSelect.append(new Option(kec.name, kec.id));
                        });
                    }
                    $('#kec').val(districtId);
                    // Inisialisasi desa berdasarkan kecamatan yang dimiliki data
                    initDesaChoices(districtId, desaTerpilih);
                    // show modal
                    $('#modal-akun').modal('show');
                }
            });
        });

        // Submit Form Create/edit akun
        $('#form-akun').submit(function(e) {
            e.preventDefault();

            // Cegah double submit
            const submitBtn = $('#btn-submit');
            if (submitBtn.prop('disabled')) {
                return false;
            }

            if(idAkunPuskesmas !== undefined){
                url = "{{ route('bapeda.changePassword', ['id' => ':id']) }}";
                url = url.replace(':id', idAkunPuskesmas)
            }else{
                url = "{{ route('bapeda.addPuskesmas') }}";
            }

            var formData = new FormData($("#form-akun")[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // Remove previous validation errors
                    $('*').removeClass('is-invalid');
                    
                    // Disable submit button dan tampilkan loading
                    submitBtn.prop('disabled', true);
                    submitBtn.find('.btn-text').addClass('d-none');
                    submitBtn.find('.btn-loading').removeClass('d-none').addClass('d-sm-block');
                },
                success: function(response) {
                    $('#modal-akun').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Tersimpan!',
                        text: response.meta.message,
                    });
                    tableAkunPuskesmas.ajax.reload();
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
                        })
                        break;
                        default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan!',
                        })
                        break;
                    }
                },
                complete: function() {
                    // Enable button kembali dan sembunyikan loading
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.btn-text').removeClass('d-none');
                    submitBtn.find('.btn-loading').addClass('d-none').removeClass('d-sm-block');
                }
            });
        });

        // Hapus Data
        $('#table-akun-puskesmas tbody').on('click', '.btn-hapus', function() {
            var data = tableAkunPuskesmas.row($(this).parents('tr')).data();
            let urlDestroy = "{{ route('bapeda.hapus-akun-puskesmas', ['id' => ':id']) }}"
            urlDestroy = urlDestroy.replace(':id', data.id);

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: urlDestroy,
                    beforeSend: function() {
                    },
                    success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil dihapus!',
                    })
                    tableAkunPuskesmas.ajax.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                    switch (xhr.status) {
                        case 500:
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Server Error!',
                        })
                        break;
                        default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan!',
                        })
                        break;
                    }
                    }
                });
                }
            });
        });

        function initDesaChoices(kecamatanId, desaTerpilih = []) {
            const desaContainer = document.getElementById('desa-container');
            const desaElement = document.getElementById('desa');

            // Hapus instance Choices lama jika ada
            if (desaChoices) {
                desaChoices.destroy();
                desaChoices = null;
            }
            desaElement.innerHTML = '';

            if (!kecamatanId) {
                desaContainer.style.display = 'none';
                return;
            }

            desaContainer.style.display = 'block';

            // Fetch desa berdasarkan kecamatan via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('api.desa') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_kecamatan: kecamatanId
                },
                success: function(response) {
                    if (response.data) {
                        response.data.forEach(function(desa) {
                            const opt = document.createElement('option');
                            opt.value = desa.id;
                            opt.text = desa.name;
                            if (desaTerpilih.includes(desa.id.toString())) {
                                opt.selected = true;
                            }
                            desaElement.appendChild(opt);
                        });
                    }

                    desaChoices = new Choices(desaElement, {
                        removeItemButton: true,
                        placeholder: true,
                        placeholderValue: 'Pilih desa',
                        noResultsText: 'Tidak ada desa',
                        itemSelectText: 'Klik untuk pilih',
                        shouldSort: false
                    });

                    desaChoices.setChoices(
                        Array.from(desaElement.options).map(opt => ({
                            value: opt.value,
                            label: opt.text,
                            selected: opt.selected
                        })),
                        'value',
                        'label',
                        true
                    );
                }
            });
        }
    })
</script>
@endpush