<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<title>Edit Data Peminjaman BB</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')


    <!-- START FORM -->
    <form action='{{ url("peminjaman_bb/{$data->id_peminjaman}") }}' method='post'>
        @csrf 
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('peminjaman_bb') }}" class="btn btn-secondary">
                <i class="fa-solid fa-angles-left"></i> Kembali</a>

                <div class="mb-3 row">
                    <label for="tgl_peminjaman" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name='tgl_peminjaman' id="tgl_peminjaman" value="{{ $data->tgl_peminjaman }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="terdakwa" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                    <div class="col-sm-10">
                        <select name="terdakwa" id="terdakwa" class="form-select">
                            <option value="">--Pilih--</option>
                            @foreach ($dataterdakwa as $terdakwaItem)
                                <option value="{{ $terdakwaItem->id_terdakwa }}" {{ $data->terdakwa == $terdakwaItem->id_terdakwa ? 'selected' : '' }}>
                                    {{ $terdakwaItem->nama_terdakwa }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jaksa" class="col-sm-2 col-form-label">Jaksa </label>
                    <div class="col-sm-10">
                        <select name="jaksa" id="jaksa" class="form-select">
                            <option value="">--Pilih--</option>
                            @foreach ($datajaksa as $jaksaItem)
                                <option value="{{ $jaksaItem->id_pegawai }}" {{ $data->jaksa == $jaksaItem->id_pegawai ? 'selected' : '' }}>
                                    {{ $jaksaItem->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="petugas_bb" class="col-sm-2 col-form-label">Petugas BB</label>
                    <div class="col-sm-10">
                        <select name="petugas_bb" id="petugas_bb" class="form-select">
                            <option value="">--Pilih--</option>
                            @foreach ($datapetugasbb as $petugasbbItem)
                                <option value="{{ $petugasbbItem->id_pegawai }}" {{ $data->petugas_bb == $petugasbbItem->id_pegawai ? 'selected' : '' }}>
                                    {{ $petugasbbItem->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kasi_bb" class="col-sm-2 col-form-label">Kasi BB</label>
                    <div class="col-sm-10">
                        <select name="kasi_bb" id="kasi_bb" class="form-select">
                            <option value="">--Pilih--</option>
                            @foreach ($datakasibb as $kasibbItem)
                                <option value="{{ $kasibbItem->id_pegawai }}" {{ $data->kasi_bb == $kasibbItem->id_pegawai ? 'selected' : '' }}>
                                    {{ $kasibbItem->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jadwal_ambil" class="col-sm-2 col-form-label">Jadwal Ambil</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='jadwal_ambil' id="jadwal_ambil" value="{{ $data->jadwal_ambil }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jadwal_kembali" class="col-sm-2 col-form-label">Jadwal Kembali</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='jadwal_kembali' id="jadwal_kembali" value="{{ $data->jadwal_kembali }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="dokumentasi_bon" class="col-sm-2 col-form-label">Dokumentasi BON</label>
                    <div class="col-sm-10">
                        <input type="url" class="form-control" name="dokumentasi_bon" id="dokumentasi_bon" placeholder="Masukkan tautan Google Drive"  value="{{ $data->dokumentasi_bon}}">
                        <small class="text-muted">Contoh: https://drive.google.com/your-link-here</small>
                    </div>
                </div>

                
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <button type="submit" name="submit" style="border: none; background: #789461; display: flex; align-items: center; border-radius:5px; padding: 10px; width: 90px;">
                        <i class="fa-solid fa-bookmark" style="font-size: 18px; color:white;"></i>
                        <span style="margin-left: 5px; color:white;">Simpan</span>
                    </button>
                </div>
            </div>    
        </div>
    </form>
    <!-- AKHIR FORM --> 

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#terdakwa').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#jaksa').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#petugas_bb').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#kasi_bb').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });
        
    });
</script>

</body>        
       
</div>
</div>
@endsection
