<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<title>Papan Kontrol</title>

@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <body class="bg-light">
                <main class="container">
                    <h3>Papan Kontrol</h3>

                    <!-- START DATA -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <!-- FORM PENCARIAN -->
                        <div class="pb-3">
                            <form class="d-flex" action="{{ url('terdakwa') }}" method="get">
                                <input class="form-control me-1" type="search" name="katakunci" 
                                value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" 
                                aria-label="Search">
                                <button type="submit" style="border: none; background: grey; display: flex; align-items: center; border-radius:5px; ">
                                <i class="fa-solid fa-magnifying-glass" style="font-size: 18px;"></i>
                                <span style="margin-left: 5px;">Search</span>
                                </button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <!-- Data yang akan diperbarui akan ditampilkan di sini -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">No</th>
                                        <th class="col-md-3">Nama Terdakwa</th>
                                        <th class="col-md-2">Reg Bukti</th>
                                        <th class="col-md-2">Reg Perkara</th>
                                        <th class="col-md-3">Jaksa 1</th>
                                        <th class="col-md-3">Jaksa 2</th>
                                        <th class="col-md-3">Pasal</th>
                                        {{-- <th class="col-md-3">Barang Bukti</th> --}}
                                        <th class="col-md-3">Status Barang Bukti</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!-- Pembuatan nomor otomatis -->
                                    <?php $i = 1; ?>
                                    <!-- data itu dari contoh controller yang with tanpa $ -->
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->nama_terdakwa }}</td>
                                            <td>{{ $item->reg_bukti}}</td>
                                            <td>{{ $item->reg_perkara}}</td>
                                            <td>{{ $item->jaksa1_nama }}</td>
                                            <td>{{ $item->jaksa2_nama }}</td>
                                            <td>{{ $item->pasal }}</td>
                                            {{-- <td>{!! $item->barang_bukti !!}</td> --}}
                                            <td>{{ $item->status_barang_bukti }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                  {{-- {{-- <a href="#" onclick="showDetailModal('{{ $item->nama_terdakwa }}', '{{ $item->tempat_lahir }}', '{{ $item->tgl_lahir }}', '{{ $item->umur }}', '{{ $item->jenis_kelamin }}', 
                                                                        '{{ $item->kebangsaan }}', '{{ $item->agama }}', '{{ $item->alamat_terdakwa }}', '{{ $item->pekerjaan }}', '{{ $item->reg_perkara }}', '{{ $item->reg_bukti }}',
                                                                        '{{ $item->tgl_penyitaan }}', '{{ $item->tgl_penerimaan_bb }}', '{{ $item->pasal }}', '{{ $item->jaksa1_nama }}',  '{{ $item->jaksa2_nama }}',
                                                                        '{{ $item->nama_penyidik }}', '{{ $item->pangkat_nrp_penyidik }}', '{{ $item->print_p48 }}', '{{ $item->tgl_p48 }}', 
                                                                        '{{ $item->no_putusan }}', '{{ $item->tgl_putusan }}', '{{ $item->barang_bukti }}', '{{ $item->status_barang_bukti }}',
                                                                        '{{ $item->status_eksekusi }}', '{{ $item->keterangan_eksekusi }}', '{{ $item->keterangan_putusan }}', '{{ $item->petugas_bb_nama }}',
                                                                        '{{ $item->putusan_penahanan }}' )" title="Lihat Detail">
                                                    <i class="fa-solid fa-eye" style="font-size: 18px; padding-right:5px; color: #6962AD;"></i>
                                                  </a> --}}
                                                  @if(auth()->check() && Auth::user()->role == 'stafbb')
                                                    <a href='{{ url('terdakwa/'.$item->id_terdakwa.'/edit') }}' title="Edit Data"><i class="fa-regular fa-pen-to-square" style="font-size: 18px;"></i></a>
                                                    <form  onsubmit="return confirm('Apakah Anda yakin menghapus data?')" class='d-inline' action="{{ url('terdakwa/'.$item->id_terdakwa)}}" method="post">
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" name="submit" style="border: none; background: none;" title="Edit Data">
                                                            <i class="fa-regular fa-trash-can" style="font-size: 18px; color: red;"></i>
                                                          </button>
                                                    </form>
                                                  @endif
                                                </div>
                                              </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  
                        <!-- Pagination -->
                        {{ $data->withQueryString()->links()}}        
                    </div>
                    <!-- AKHIR DATA -->

                    <!-- Modal -->
                  {{-- <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Terdakwa</h5>
                                <a href="{{ url('terdakwa') }}" class="btn-close" aria-label="Close"></a>
                            </div>

                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                    <table class="table-responsive">
                                        <tbody>
                                            <tr>
                                                <th width=30%>Nama Terdakwa</th>
                                                <th width=5%>: </th>
                                                <td><span id="nama_terdakwa"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Tempat Lahir</th>
                                              <th width=5%>: </th>
                                              <td><span id="tempat_lahir"></span></td>
                                            </tr>
                                              <th width=30%>Tanggal Lahir</th>
                                              <th width=5%>: </th>
                                              <td><span id="tgl_lahir"></span></td>
                                            <tr>
                                              <th width=30%>Umur</th>
                                              <th width=5%>: </th>
                                              <td><span id="umur"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Jenis Kelamin</th>
                                              <th width=5%>: </th>
                                              <td><span id="jenis_kelamin"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Kebangsaan</th>
                                              <th width=5%>: </th>
                                              <td><span id="kebangsaan"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Agama</th>
                                              <th width=5%>: </th>
                                              <td><span id="agama"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Alamat</th>
                                              <th width=5%>: </th>
                                              <td><span id="alamat_terdakwa"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Pekerjaan</th>
                                              <th width=5%>: </th>
                                              <td><span id="pekerjaan"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Register Perkara</th>
                                              <th width=5%>: </th>
                                              <td><span id="reg_perkara"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Register Bukti</th>
                                              <th width=5%>: </th>
                                              <td><span id="reg_bukti"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Tanggal Penyitaan</th>
                                              <th width=5%>: </th>
                                              <td><span id="tgl_penyitaan"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Tanggal Penerimaan BB</th>
                                              <th width=5%>: </th>
                                              <td><span id="tgl_penerimaan_bb"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Pasal</th>
                                              <th width=5%>: </th>
                                              <td><span id="pasal"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Jaksa 1</th>
                                              <th width=5%>: </th>
                                              <td><span id="jaksa1"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Jaksa 2</th>
                                              <th width=5%>: </th>
                                              <td><span id="jaksa2"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Nama Penyidik</th>
                                              <th width=5%>: </th>
                                              <td><span id="nama_penyidik"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Pangkat NRP Penyidik</th>
                                              <th width=5%>: </th>
                                              <td><span id="pangkat_nrp_penyidik"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Print P48</th>
                                              <th width=5%>: </th>
                                              <td><span id="print_p48"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Tanggal P48</th>
                                              <th width=5%>: </th>
                                              <td><span id="tgl_p48"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Nomor Putusan</th>
                                              <th width=5%>: </th>
                                              <td><span id="no_putusan"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Tanggal Putusan</th>
                                              <th width=5%>: </th>
                                              <td><span id="tgl_putusan"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Barang Bukti</th>
                                              <th width=5%>: </th>
                                              <td><span id="barang_bukti"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Status Barang Bukti</th>
                                              <th width=5%>: </th>
                                              <td><span id="status_barang_bukti"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Status Eksekusi</th>
                                              <th width=5%>: </th>
                                              <td><span id="status_eksekusi"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Keterangan Eksekusi</th>
                                              <th width=5%>: </th>
                                              <td><span id="keterangan_eksekusi"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Keterangan Putusan</th>
                                              <th width=5%>: </th>
                                              <td><span id="keterangan_putusan"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Petugas Barang Bukti</th>
                                              <th width=5%>: </th>
                                              <td><span id="petugas_bb"></span></td>
                                            </tr>
                                            <tr>
                                              <th width=30%>Putusan Penahanan</th>
                                              <th width=5%>: </th>
                                              <td><span id="putusan_penahanan"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                            </div>

                            <div class="modal-footer">
                              <a href="{{ url('terdakwa') }}" class="btn btn-primary">Tutup</a>    
                            </div>

                        </div>
                    </div>
                  </div>
                </div> --}}

                </main>
                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

                
            </body>        
        </div>
    </div>
@endsection
