<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<title>BA 20</title>

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
                      <form class="d-flex" action="{{ url('beritaacara/ba20') }}" method="get">
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
                    <div class="pb-3" style="display: flex; justify-content: space-between; align-items: center;">
                      <div>
                        @if(auth()->check() && Auth::user()->role == 'stafbb')
                          <a href='{{ url('beritaacara/ba20/create')}}' class="btn btn-primary">+ Tambah Data Pengembalian</a>
                        @endif
                      </div>
                      {{-- <div>
                        @if(auth()->check() && Auth::user()->role == 'stafbb')
                          <a href='{{ url('beritaacara/ba20/view/pdf')}}' class="btn btn-outline-dark" target="_blank"><i class="fa-solid fa-file-pdf"></i> View PDF</a>
                          <a href='{{ url('beritaacara/ba20/download/pdf')}}' class="btn btn-secondary" target="_blank"><i class="fa-solid fa-download"></i> Download PDF</a>
                          <a href='{{ url('beritaacara/ba20/print')}}' class="btn btn-outline-primary"><i class="fa-solid fa-print"></i> Print</a>
                        @endif
                      </div> --}}
                  </div>
                  
                    
                    {{-- <a href="{{ route('ba20.cetak') }}" class="btn btn-primary" target="_blank">Print</a> --}}
                    <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th class="col-md-1">NO</th>
                                  <th class="col-md-3">NAMA TERDAKWA</th>
                                  <th class="col-md-2">TANGGAL</th>
                                  <th class="col-md-3">JAKSA</th>
                                  <th class="col-md-3">NAMA PENERIMA</th>
                                  <th class="col-md-3">KASI BB</th>
                                  <th class="col-md-3">SAKSI 1</th>
                                  <th class="col-md-3">SAKSI 2</th>
                                  <th class="col-md-2">STATUS</th>
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
                                  <td>{{ $item->terdakwa_nama }}</td>
                                  <td>{{ $item->tanggal }}</td>
                                  <td>{{ $item->jaksa_nama }}</td>
                                  <td>{{ $item->nama_penerima }}</td>
                                  <td>{{ $item->kasi_bb_nama }}</td>
                                  <td>{{ $item->saksi1_nama }}</td>
                                  <td>{{ $item->saksi2_nama }}</td>
                                  <td>{{ $item->status_ba20 }}</td>
                                  
                                  <td>
                                    <div class="d-flex justify-content-start">
                                      <a href="#" onclick="showDetailModal('{{ $item->terdakwa_nama }}', '{{ $item->hari }}', '{{ $item->tanggal }}', '{{ $item->jaksa_nama }}', '{{ $item->dikembalikan }}', 
                                                            '{{ $item->nama_penerima }}', '{{ $item->pekerjaan_ba20 }}', '{{ $item->alamat_ba20 }}', '{{ $item->kasi_bb_nama }}', '{{ $item->saksi1_nama }}', '{{ $item->saksi2_nama }}',
                                                            '{!! $item->barang_bukti_ba20 !!}', '{{ $item->dokumentasi }}', '{{ $item->arsip }}', '{{ $item->status_ba20 }}')" title="Lihat Detail">
                                        <i class="fa-solid fa-eye" style="font-size: 18px; padding-right:5px; color: #6962AD;"></i>
                                      </a>
                                      @if(auth()->check() && Auth::user()->role == 'stafbb')
                                      <a href='{{ url('beritaacara/ba20/'.$item->id_ba20.'/edit') }}' title="Edit Data"><i class="fa-regular fa-pen-to-square" style="font-size: 18px;"></i></a>
                                      <form  onsubmit="return confirm('Apakah Anda yakin menghapus data?')" class='d-inline' action="{{ url('beritaacara/ba20/'.$item->id_ba20)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" style="border: none; background: none;" title="Edit Data">
                                              <i class="fa-regular fa-trash-can" style="font-size: 18px; color: red; padding-right:40px;"></i>
                                            </button>
                                      </form>
                                      <a href='{{ url('beritaacara/ba20/'.$item->id_ba20.'/print') }}' title="Print Berita Acara Pengembalian (BA-20)" name="print_ba" class="btn btn-outline-primary"><i class="fa-solid fa-print"></i> Print</a>
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
                                <h5 class="modal-title" id="detailModalLabel">Detail BA 20</h5>
                                <a href="{{ url('beritaacara/ba20') }}" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table-responsive">
                                    <tbody  style="vertical-align: top">
                                        <tr>
                                            <th width=30%>Nama Terdakwa</th>
                                            <th width=5%>: </th>
                                            <td><span id="terdakwa"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Hari</th>
                                          <th width=5%>: </th>
                                          <td><span id="hari"></span></td>
                                        </tr>
                                          <th width=30%>Tanggal</th>
                                          <th width=5%>: </th>
                                          <td><span id="tanggal"></span></td>
                                        <tr>
                                          <th width=30%>Jaksa</th>
                                          <th width=5%>: </th>
                                          <td><span id="jaksa"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Dikembalikan</th>
                                          <th width=5%>: </th>
                                          <td><span id="dikembalikan"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Nama Penerima</th>
                                          <th width=5%>: </th>
                                          <td><span id="nama_penerima"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Pekerjaan</th>
                                          <th width=5%>: </th>
                                          <td><span id="pekerjaan_ba20"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Alamat</th>
                                          <th width=5%>: </th>
                                          <td><span id="alamat_ba20"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Kasi BB</th>
                                          <th width=5%>: </th>
                                          <td><span id="kasi_bb"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Saksi 1</th>
                                          <th width=5%>: </th>
                                          <td><span id="saksi1"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Saksi 2</th>
                                          <th width=5%>: </th>
                                          <td><span id="saksi2"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Barang Bukti</th>
                                          <th width=5%>: </th>
                                          <td><span id="barang_bukti_ba20"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Dokumentasi</th>
                                          <th width=5%>: </th>
                                          <td><a href="#" id="dokumentasi_link" target="_blank"><span id="dokumentasi"></span></a></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Arsip</th>
                                          <th width=5%>: </th>
                                          <td><a href="#" id="arsip_link" target="_blank"><span id="arsip"></span></a></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Status</th>
                                          <th width=5%>: </th>
                                          <td><span id="status_ba20"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                  </div>  
                              </div>      
                            </div>
                            <div class="modal-footer">
                              <a href="{{ url('beritaacara/ba20') }}" class="btn btn-primary">Tutup</a>
                                    
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

            <script>
              function showDetailModal(terdakwa, hari, tanggal, jaksa, dikembalikan, 
                                        nama_penerima, pekerjaan_ba20, alamat_ba20, kasi_bb, saksi1, saksi2, barang_bukti_ba20,
                                        dokumentasi, arsip, status_ba20) {
                  document.getElementById('terdakwa').innerText =  terdakwa;
                  document.getElementById('hari').innerText = hari;
                  document.getElementById('tanggal').innerText = tanggal;
                  document.getElementById('jaksa').innerText = jaksa;
                  document.getElementById('dikembalikan').innerText = dikembalikan;
                  document.getElementById('nama_penerima').innerText = nama_penerima;
                  document.getElementById('pekerjaan_ba20').innerText = pekerjaan_ba20;
                  document.getElementById('alamat_ba20').innerText = alamat_ba20;
                  document.getElementById('kasi_bb').innerText = kasi_bb;
                  document.getElementById('saksi1').innerText = saksi1;
                  document.getElementById('saksi2').innerText = saksi2;
                  document.getElementById('barang_bukti_ba20').innerHTML = barang_bukti_ba20;
                  
                  var dokumentasiLinkElement = document.getElementById('dokumentasi_link');
                  dokumentasiLinkElement.setAttribute('href', dokumentasi);
                  // Tambahkan teks tautan
                  dokumentasiLinkElement.innerText = 'Lihat Dokumentasi';

                  var arsipLinkElement = document.getElementById('arsip_link');
                  arsipLinkElement.setAttribute('href', arsip);
                  // Tambahkan teks tautan
                  arsipLinkElement.innerText = 'Lihat Arsip';

                  document.getElementById('status_ba20').innerText = status_ba20;

                  // Show modal
                  var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                  detailModal.show();
              }
          </script>
          

          </body>        
                   
        </div>
    </div>
@endsection