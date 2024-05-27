<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>Pegawai</title>

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
                      <form class="d-flex" action="{{ url('pegawai') }}" method="get">
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
                      <a href='{{ url('pegawai/create')}}' class="btn btn-primary">+ Tambah Data Pegawai</a>
                    </div>
                    
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1">NO</th>
                                <th class="col-md-2">NAMA PEGAWAI</th>
                                <th class="col-md-2">PANGKAT</th>
                                <th class="col-md-2">JABATAN</th>
                                <th class="col-md-3">NIP</th>
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
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->nama_pangkat }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->nip }}</td>
                                
                                <td>
                                  <div class="d-flex justify-content-start">
                                    <a href="#" onclick="showDetailModal('{{ $item->nama_pegawai }}', '{{ $item->nama_pangkat }}', '{{ $item->status }}', '{{ $item->jabatan }}', '{{ $item->nip }}', '{{ $item->nrp }}', '{{ $item->alamat }}', '{{ $item->no_telp }}', '{{ asset('foto_pegawai/' . $item->foto) }}')" title="Lihat Detail">
                                      <i class="fa-solid fa-eye" style="font-size: 18px; padding-right:5px; color: #6962AD;"></i>
                                    </a>
                                    {{-- <a href="{{ url('pegawai/'.$item->id).'/detail' }}" title="Lihat Detail"><i class="fa-solid fa-eye" style="font-size: 18px; padding-right:5px; color: #6962AD;"></i></a> --}}
                                    <a href='{{ url('pegawai/'.$item->id_pegawai.'/edit') }}' title="Edit Data"><i class="fa-regular fa-pen-to-square" style="font-size: 18px;"></i></a>
                                    <form  onsubmit="return confirm('Apakah Anda yakin menghapus data?')" class='d-inline' action="{{ url('pegawai/'.$item->id_pegawai)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" name="submit" style="border: none; background: none;" title="Hapus Data">
                                            <i class="fa-regular fa-trash-can" style="font-size: 18px; color: red;"></i>
                                          </button>
                                    </form>
                                  </div>
                                </td>
                            </tr>
                          <?php $i++ ?>
                          @endforeach
                            
                        </tbody>
                    </table>  
                    {{ $data->withQueryString()->links()}}        
                  </div>
                  <!-- AKHIR DATA -->
                  
                  <!-- Modal -->
                  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Pegawai</h5>
                                <a href="{{ url('pegawai') }}" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-4">
                                  <img id="foto_pegawai" src="{{ url('foto') }}" alt="Foto Pegawai" class="img-fluid" style="max-width:100px;">
                                </div>
                                <div class="col-md-8">
                                  {{-- <h5>Data Detail Pegawai</h5> --}}
                                    <ul class="list-unstyled">
                                      <li><strong>Nama Pegawai :</strong> <span id="nama_pegawai"></span></li>
                                      <li><strong>Pangkat :</strong> <span id="pangkat"></span></li>
                                      <li><strong>Status :</strong> <span id="status"></span></li>
                                      <li><strong>Jabatan :</strong> <span id="jabatan"></span></li>
                                      <li><strong>NIP :</strong> <span id="nip"></span></li>
                                      <li><strong>NRP :</strong> <span id="nrp"></span></li>
                                      <li><strong>Alamat :</strong> <span id="alamat"></span></li>
                                      <li><strong>No. Telp :</strong> <span id="no_telp"></span></li>  
                                    </ul>
                                </div>      
                            </div>
                            <div class="modal-footer">
                              <a href="{{ url('pegawai') }}" class="btn btn-primary">Tutup</a>
                                    
                            </div>
                        </div>
                    </div>
                  </div>
                  
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

            <script>
              function showDetailModal(namaPegawai, pangkat, status, jabatan, nip, nrp, alamat, no_telp, fotoPath ) {
                  document.getElementById('nama_pegawai').innerText =  namaPegawai;
                  document.getElementById('pangkat').innerText = pangkat;
                  document.getElementById('status').innerText = status;
                  document.getElementById('jabatan').innerText = jabatan;
                  document.getElementById('nip').innerText = nip;
                  document.getElementById('nrp').innerText = nrp;
                  document.getElementById('alamat').innerText = alamat;
                  document.getElementById('no_telp').innerText = no_telp;

                   // Set foto
                  var fotoElement = document.getElementById('foto_pegawai');
                  fotoElement.src = fotoPath;
          
                  // Show modal
                  var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                  detailModal.show();
              }
          </script>
          </body>        
                   
        </div>
    </div>

    
@endsection