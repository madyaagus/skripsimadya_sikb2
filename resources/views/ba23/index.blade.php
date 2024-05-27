<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>BA 23</title>

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
                      <form class="d-flex" action="{{ url('beritaacara/ba23') }}" method="get">
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
                          <a href='{{ url('beritaacara/ba23/create')}}' class="btn btn-primary">+ Tambah Data</a>
                        @endif
                      </div>
                      {{-- <div>
                        @if(auth()->check() && Auth::user()->role == 'stafbb')
                          <a href='{{ url('beritaacara/ba23/view/pdf')}}' class="btn btn-outline-dark" target="_blank"><i class="fa-solid fa-file-pdf"></i> View PDF</a>
                          <a href='{{ url('beritaacara/ba23/download/pdf')}}' class="btn btn-secondary" target="_blank"><i class="fa-solid fa-download"></i> Download PDF</a>
                          <a href='{{ url('beritaacara/ba23/print')}}' class="btn btn-outline-primary"><i class="fa-solid fa-print"></i> Print</a>
                        @endif
                      </div> --}}
                    </div>
                    
                    <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th class="col-md-1">NO</th>
                                  <th class="col-md-3">NAMA TERDAKWA</th>
                                  <th class="col-md-2">TANGGAL</th>
                                  <th class="col-md-3">JAKSA</th>
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
                                  <td>{{ $item->tgl_ba23 }}</td>
                                  <td>{{ $item->jaksa_nama }}</td>
                                  <td>{{ $item->kasi_bb_nama }}</td>
                                  <td>{{ $item->saksi1_nama }}</td>
                                  <td>{{ $item->saksi2_nama }}</td>
                                  <td>{{ $item->status_ba23 }}</td>
                                  
                                  <td>
                                    <div class="d-flex justify-content-start">
                                      <a href="#" onclick="showDetailModal( '{{ $item->hari }}', '{{ $item->tgl_ba23 }}', '{{ $item->jaksa_nama }}', '{{ $item->terdakwa_nama }}',
                                                            '{{ $item->kasi_bb_nama }}', '{{ $item->saksi1_nama }}', '{{ $item->saksi2_nama }}',
                                                            '{!! $item->barang_bukti_ba23 !!}', '{{ $item->arsip }}', '{{ $item->status_ba23 }}')" title="Lihat Detail">
                                        <i class="fa-solid fa-eye" style="font-size: 18px; padding-right:5px; color: #6962AD;"></i>
                                      </a>

                                      @if(auth()->check() && Auth::user()->role == 'stafbb')
                                        <a href='{{ url('beritaacara/ba23/'.$item->id_ba23.'/edit') }}' title="Edit Data"><i class="fa-regular fa-pen-to-square" style="font-size: 18px;"></i></a>
                                        <form  onsubmit="return confirm('Apakah Anda yakin menghapus data?')" class='d-inline' action="{{ url('beritaacara/ba23/'.$item->id_ba23)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" name="submit" style="border: none; background: none;" title="Edit Data">
                                                <i class="fa-regular fa-trash-can" style="font-size: 18px; color: red; padding-right:40px;"></i>
                                              </button>
                                        </form>
                                        <a href='{{ url('beritaacara/ba23/'.$item->id_ba23.'/print') }}' title="Print Berita Acara Pemusnahan (BA-23)" name="print_ba" class="btn btn-outline-primary"><i class="fa-solid fa-print"></i> Print</a>
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
                                <h5 class="modal-title" id="detailModalLabel">Detail BA 23</h5>
                                <a href="{{ url('beritaacara/ba23') }}" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table-responsive">
                                    <tbody style="vertical-align: top">
                                        <tr>
                                          <th width=30%>Hari</th>
                                          <th width=5%>: </th>
                                          <td><span id="hari"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Tanggal</th>
                                          <th width=5%>: </th>
                                          <td><span id="tgl_ba23"></span></td>
                                        <tr>
                                        <tr>
                                          <th width=30%>Jaksa</th>
                                          <th width=5%>: </th>
                                          <td><span id="jaksa"></span></td>
                                        </tr>
                                        <tr>
                                            <th width=30%>Nama Terdakwa</th>
                                            <th width=5%>: </th>
                                            <td><span id="terdakwa"></span></td>
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
                                          <td><span id="barang_bukti_ba23"></span></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Arsip</th>
                                          <th width=5%>: </th>
                                          <td><a href="#" id="arsip_link" target="_blank"><span id="arsip"></span></a></td>
                                        </tr>
                                        <tr>
                                          <th width=30%>Status</th>
                                          <th width=5%>: </th>
                                          <td><span id="status_ba23"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                  </div>  
                              </div>      
                            </div>
                            <div class="modal-footer">
                              <a href="{{ url('beritaacara/ba23') }}" class="btn btn-primary">Tutup</a>
                                    
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

            <script>
              function showDetailModal(hari, tgl_ba23,jaksa,terdakwa,
                                        kasi_bb, saksi1, saksi2, barang_bukti_ba23,
                                        arsip, status_ba23) {
                  document.getElementById('hari').innerText = hari;
                  document.getElementById('tgl_ba23').innerText = tgl_ba23;                        
                  document.getElementById('jaksa').innerText = jaksa;
                  document.getElementById('terdakwa').innerText =  terdakwa;
                  document.getElementById('kasi_bb').innerText = kasi_bb;
                  document.getElementById('saksi1').innerText = saksi1;
                  document.getElementById('saksi2').innerText = saksi2;
                  document.getElementById('barang_bukti_ba23').innerHTML = barang_bukti_ba23;
                  
                  var arsipLinkElement = document.getElementById('arsip_link');
                  arsipLinkElement.setAttribute('href', arsip);
                  // Tambahkan teks tautan
                  arsipLinkElement.innerText = 'Lihat Arsip';
                  
                  document.getElementById('status_ba23').innerText = status_ba23;

                  // Show modal
                  var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                  detailModal.show();
              }
          </script>

          </body>        
                   
        </div>
    </div>
@endsection