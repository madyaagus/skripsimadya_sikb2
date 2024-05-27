<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>Peminjaman Barang Bukti</title>

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
                      <form class="d-flex" action="{{ url('peminjaman_bb') }}" method="get">
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
                      @if(auth()->check() && in_array(Auth::user()->role, ['stafbb','jaksa']))
                        <a href='{{ url('peminjaman_bb/create')}}' class="btn btn-primary">+ Tambah Data</a>
                      @endif
                    </div>
                    
                    <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th class="col-md-1">NO</th>
                                  <th class="col-md-3">TANGGAL PEMINJAMAN</th>
                                  <th class="col-md-3">TERDAKWA</th>
                                  <th class="col-md-3">JADWAL AMBIL</th>
                                  <th class="col-md-3">JADWAL KEMBALI</th>
                                  <th class="col-md-3">STATUS</th>
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
                                  <td>{{ $item->tgl_peminjaman}}</td>
                                  <td>{{ $item->terdakwa_nama }}</td>
                                  <td>{{ $item->jadwal_ambil }}</td>
                                  <td>{{ $item->jadwal_kembali }}</td>
                                  <td>{{ $item->status_peminjaman }}</td>
                                  <td>
                                    <div class="d-flex justify-content-start">
                                      
                                      <a href="#" onclick="showDetailModal('{{ $item->tgl_peminjaman }}', '{{ $item->terdakwa_nama }}', '{{ $item->jaksa_nama }}',
                                                            '{{ $item->petugas_bb_nama }}', '{{ $item->kasi_bb_nama }}', '{{ $item->jadwal_ambil }}',
                                                            '{{ $item->jadwal_kembali }}', '{{ $item->dokumentasi_bon }}', '{{ $item->status_peminjaman}}')" title="Lihat Detail">
                                        <i class="fa-solid fa-eye" style="font-size: 18px; padding-right:5px; color: #6962AD;"></i>
                                      </a>
                                      
                                      @if(auth()->check() && in_array(Auth::user()->role, ['stafbb', 'kasibb']))
                                      <a href='{{ url('peminjaman_bb/'.$item->id_peminjaman.'/edit') }}' title="Edit Data"><i class="fa-regular fa-pen-to-square" style="font-size: 18px;"></i></a>
                                      @endif

                                      @if(auth()->check() && Auth::user()->role == 'stafbb')
                                      <form  onsubmit="return confirm('Apakah Anda yakin menghapus data?')" class='d-inline' action="{{ url('peminjaman_bb/'.$item->id_peminjaman)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" style="border: none; background: none;" title="Edit Data">
                                              <i class="fa-regular fa-trash-can" style="font-size: 18px; color: red;  padding-right:40px;"></i>
                                            </button>
                                      </form>
                                      @endif

                                      @if(auth()->check() && in_array(Auth::user()->role, ['stafbb','jaksa']))
                                      <a href='{{ url('peminjaman_bb/'.$item->id_peminjaman.'/print') }}' title="Print Nota" name="print_nota" class="btn btn-outline-primary"><i class="fa-solid fa-print"></i> Print</a>
                                      @endif

                                    </div>
                                  </td>
                              </tr>
                            <?php $i++ ?>
                            @endforeach
                              
                          </tbody>
                      </table>
                    </div>  
                    {{ $data->withQueryString()->links()}}        
                  </div>
                  <!-- AKHIR DATA -->

                  <!-- Modal -->
                  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Peminjaman BB</h5>
                                <a href="{{ url('peminjaman_bb') }}" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table-responsive">
                                    <tbody>
                                        <tr>
                                            <th width=30%>Tanggal Peminjaman</th>
                                            <th width=5%>: </th>
                                            <td><span id="tgl_peminjaman"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Nama Terdakwa</th>
                                          <th width=5%>: </th>
                                          <td><span id="terdakwa"></span></td>
                                        </tr>
                                          <th width=30%>Nama Jaksa</th>
                                          <th width=5%>: </th>
                                          <td><span id="jaksa"></span></td>
                                        <tr>
                                          <th width=30%>Nama Petugas BB</th>
                                          <th width=5%>: </th>
                                          <td><span id="petugas_bb"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Nama Kasi BB</th>
                                          <th width=5%>: </th>
                                          <td><span id="kasi_bb"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Jadwal Ambil</th>
                                          <th width=5%>: </th>
                                          <td><span id="jadwal_ambil"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Jadwal Kembali</th>
                                          <th width=5%>: </th>
                                          <td><span id="jadwal_kembali"></span></td>
                                        </tr>
                                        <tr>
                                          <th width="30%">Dokumentasi BON</th>
                                          <th width="5%">: </th>
                                          <td><a href="#" id="dokumentasi_bon_link" target="_blank"><span id="dokumentasi_bon"></span></a></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Status</th>
                                          <th width=5%>: </th>
                                          <td><span id="status_peminjaman"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>      
                            </div>
                            <div class="modal-footer">
                              <a href="{{ url('peminjaman_bb') }}" class="btn btn-primary">Tutup</a>
                                    
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

            <script>
              function showDetailModal(tgl_peminjaman, terdakwa, jaksa, petugas_bb, kasi_bb,
                                        jadwal_ambil, jadwal_kembali, dokumentasi_bon, status_peminjaman, dokumentasi_bon_link) {
                  document.getElementById('tgl_peminjaman').innerText = tgl_peminjaman;
                  document.getElementById('terdakwa').innerText = terdakwa;
                  document.getElementById('jaksa').innerText = jaksa;
                  document.getElementById('petugas_bb').innerText = petugas_bb;
                  document.getElementById('kasi_bb').innerText = kasi_bb;
                  document.getElementById('jadwal_ambil').innerText = jadwal_ambil;
                  document.getElementById('jadwal_kembali').innerText = jadwal_kembali;
            
                  var dokumentasiBonLinkElement = document.getElementById('dokumentasi_bon_link');
                  dokumentasiBonLinkElement.setAttribute('href', dokumentasi_bon);
                  // Tambahkan teks tautan
                  dokumentasiBonLinkElement.innerText = 'Lihat Dokumentasi BON';
            
                  document.getElementById('status_peminjaman').innerText = status_peminjaman;
            
                  // Show modal
                  var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                  detailModal.show();
              }
            </script>

          </body>        
                   
        </div>
    </div>
@endsection