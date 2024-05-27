<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>Pangkat</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')

                  <!-- START DATA -->
                  <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <!-- FORM PENCARIAN -->
                    <div class="pb-3">
                      <form class="d-flex" action="{{ url('pangkat') }}" method="get">
                          <input class="form-control me-1" type="search" name="katakunci" 
                          value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" 
                          aria-label="Search">
                          <button type="submit" style="border: none; background: grey; display: flex; align-items: center; border-radius:5px; ">
                            <i class="fa-solid fa-magnifying-glass" style="font-size: 18px;"></i>
                            <span style="margin-left: 5px;">Search</span>
                          </button>
                      </form>
                    </div>
                    
                    <!-- TOMBOL TAMBAH DATA -->
                    <div class="pb-3">
                      <a href='{{ url('pangkat/create')}}' class="btn btn-primary">+ Tambah Data Pangkat</a>
                    </div>
              
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1">NO</th>
                                <th class="col-md-3">NAMA PANGKAT</th>
                                <th class="col-md-4">KETERANGAN PANGKAT</th>
                                <th class="col-md-2">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                          <!-- Pembuatan nomor otomatis -->
                          <?php $i = $data->firstItem() ?>
                          <!-- data itu dari contoh controller yang with tanpa $ -->
                          @foreach ($data as $item)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->nama_pangkat }}</td>
                                <td>{{ $item->keterangan_pangkat }}</td>
                                <td>
                                    <a href='{{ url('pangkat/'.$item->id_pangkat.'/edit') }}' title="Edit Data"><i class="fa-regular fa-pen-to-square" style="font-size: 18px;"></i></a>
                                    <form  onsubmit="return confirm('Apakah Anda yakin menghapus data?')" class='d-inline' action="{{ url('pangkat/'.$item->id_pangkat)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" name="submit" style="border: none; background: none;" title="Hapus Data">
                                            <i class="fa-regular fa-trash-can" style="font-size: 18px; color: red;"></i>
                                          </button>
                                    </form>
                                </td>
                            </tr>
                          <?php $i++ ?>
                          @endforeach
                            
                        </tbody>
                    </table>  
                    {{ $data->withQueryString()->links()}}        
                  </div>
                  <!-- AKHIR DATA -->
                
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
          </body>        
                   
        </div>
    </div>
@endsection