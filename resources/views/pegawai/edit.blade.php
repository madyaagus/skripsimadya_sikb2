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

<title>Edit Data Pegawai</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')


    <!-- START FORM -->
    <form action='{{ url('pegawai/'.$data->id_pegawai) }}' method='post' enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h3 style="background-color:powderblue;">Edit Data {{ $data->nama_pegawai }}</h3>
            <a href="{{ url('pegawai') }}" class="btn btn-secondary">
                <i class="fa-solid fa-angles-left"></i> Kembali</a>
            <div class="mb-3 row">
                <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_pegawai' id="nama_pegawai" value="{{ $data->nama_pegawai }}">
                </div>
                {{-- <div class="col-sm-10">
                    {{ $data-> id }} <!-- data yang tidak boleh diganti -->
                </div> --}}
            </div>
            <div class="mb-3 row">
                <label for="id_pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                <div class="col-sm-10">
                    <select name="id_pangkat" id="id_pangkat" class="form-select">
                        <option value="">--Pilih--</option>
                        @foreach ($pangkat as $pangkatItem)
                            <option value="{{ $pangkatItem->id_pangkat }}" {{ $data->id_pangkat == $pangkatItem->id_pangkat ? 'selected' : '' }}>
                                {{ $pangkatItem->nama_pangkat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select" name='status' id="status">
                        <option value="">--Pilih--</option>
                        <option value="Tata Usaha" {{ old('status', $data->status) == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha</option>
                        <option value="Jaksa" {{ old('status', $data->status) == 'Jaksa' ? 'selected' : '' }}>Jaksa</option>
                    </select>
                </div>
            </div>            
            <div class="mb-3 row">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='jabatan' id="jabatan" value="{{ $data->jabatan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nip' id="nip" value="{{ $data->nip }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nrp' id="nrp" value="{{ $data->nrp }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat" id="alamat" class="form-control">{{ $data->alamat }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='no_telp' id="no_telp" value="{{ $data->no_telp }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name='foto' id="foto" value="{{ $data->foto }}">
                </div>
            </div>
            @if ($data->foto)
                <div class="mb-3">
                    <img style="max-width:150px;" src="{{ url('foto_pegawai').'/'.$data->foto }}">
                </div> 
            @endif
            <div class="mb-3 row">
                {{-- <label for="foto" class="col-sm-2 col-form-label"></label> --}}
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

        $('#id_pangkat').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#status').select2({
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
