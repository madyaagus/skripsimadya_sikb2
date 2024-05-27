<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>Tambah Data Pangkat</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')

                    <!-- START FORM -->
                    <form action='{{ url('pangkat') }}' method='post'>
                        @csrf 
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <h3 style="background-color:powderblue;">Tambah Data Pangkat</h3>
                            <a href="{{ url('pangkat') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-angles-left"></i> Kembali</a>
                            <div class="mb-3 row">
                                <label for="nama_pangkat" class="col-sm-2 col-form-label">Nama Pangkat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='nama_pangkat' id="nama_pangkat" value="{{ Session::get('nama_pangkat')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan_pangkat" class="col-sm-2 col-form-label">Keterangan Pangkat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='keterangan_pangkat' id="keterangan_pangkat" value="{{ Session::get('keterangan_pangkat')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan_pangkat" class="col-sm-2 col-form-label"></label>
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
         </body>        
        </div>
    </div>

@endsection
