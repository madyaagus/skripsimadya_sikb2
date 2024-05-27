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


<title>Tambah Data Bensus</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')

                    <!-- START FORM -->
                    <form action='{{ url('beritaacara/bensus') }}' method='post'>
                        @csrf 
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <a href="{{ url('beritaacara/bensus') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-angles-left"></i> Kembali</a>
                            <div class="mb-3 row">
                                <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="hari" id="hari">
                                        <option value="">--Pilih--</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_bensus" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='tgl_bensus' id="tgl_bensus" value="{{ Session::get('tgl_bensus')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jaksa" class="col-sm-2 col-form-label">Jaksa</label>
                                <div class="col-sm-10">
                                    <select name="jaksa" id="jaksa" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($jaksa as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                    <label for="terdakwa" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                                    <div class="col-sm-10">
                                        <select name="terdakwa" id="terdakwa" class="form-select">
                                            <option value="">--Pilih--</option>
                                            @foreach ($terdakwa as $data)
                                                <option value="{{ $data->id_terdakwa }}">{{ $data->nama_terdakwa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumlah_uang" class="col-sm-2 col-form-label">Jumlah Uang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='jumlah_uang' id="jumlah_uang" value="{{ Session::get('jumlah_uang')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan_uang" class="col-sm-2 col-form-label">Keterangan Uang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='keterangan_uang' id="keterangan_uang" value="{{ Session::get('jumlah_uang')}}">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="bendahara" class="col-sm-2 col-form-label">Bendahara</label>
                                <div class="col-sm-10">
                                    <select name="bendahara" id="bendahara" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($bendahara as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tujuan_setoran" class="col-sm-2 col-form-label">Tujuan Setoran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='tujuan_setoran' id="tujuan_setoran" value="{{ Session::get('tujuan_setoran')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="bank_setoran" class="col-sm-2 col-form-label">Bank Setoran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='bank_setoran' id="bank_setoran" value="{{ Session::get('bank_setoran')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat_bank" class="col-sm-2 col-form-label">Alamat Bank</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='alamat_bank' id="alamat_bank" value="{{ Session::get('alamat_bank')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="saksi1" class="col-sm-2 col-form-label">Saksi 1</label>
                                <div class="col-sm-10">
                                    <select name="saksi1" id="saksi1" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($saksi1 as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="saksi2" class="col-sm-2 col-form-label">Saksi 2</label>
                                <div class="col-sm-10">
                                    <select name="saksi2" id="saksi2" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($saksi2 as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="arsip" class="col-sm-2 col-form-label">Arsip</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" name="arsip" id="arsip" placeholder="Masukkan tautan Google Drive" value="{{ Session::get('arsip') }}">
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

                    $('#hari').select2({
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

                    $('#bendahara').select2({
                        placeholder: '--Pilih--',
                        allowClear: true,
                        width: 'resolve',
                        tags: false, // Tidak memungkinkan input baru (tags)
                        minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
                    });

                    $('#saksi1').select2({
                        placeholder: '--Pilih--',
                        allowClear: true,
                        width: 'resolve',
                        tags: false, // Tidak memungkinkan input baru (tags)
                        minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
                    });

                    $('#saksi2').select2({
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
