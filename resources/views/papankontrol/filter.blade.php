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
                    {{-- <div class="col-sm-8">
                      <select class="form-select" id="status_barang_bukti">
                          <option value="">--Pilih Status Barang Bukti--</option>
                          <option value="Semua Perkara">Semua Perkara</option>
                          <option value="Sudah Inkrah">Sudah Inkrah</option>
                          <option value="Belum Inkrah">Belum Inkrah</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <a href="">Filter</a>
                    </div> --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                      <form action="/papan-kontrol/filter" method="GET"> 
                        <div class="pb-10" style="display: flex; align-items: center;">
                            <div class="col-pd-10">
                              <select class="form-select" id="status_bb">
                                <option value="">--Pilih Status Barang Bukti--</option>
                                <option value="Semua Perkara">Semua Perkara</option>
                                <option value="Sudah Inkrah">Sudah Inkrah</option>
                                <option value="Belum Inkrah">Belum Inkrah</option>
                              </select>
                            </div>
        
                            <a href="#" onclick="filterData();" class="btn btn-outline-primary" style="align-self: flex-end; margin-left: 10px;">
                                <i class="fa-solid fa-print"></i> Lihat
                            </a>
                        </div>
                      </form>
                    </div>


                    <div id="filteredData" class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th class="col-md-1">No</th>
                                  <th class="col-md-3">Nama Terdakwa</th>
                                  <th class="col-md-2">Tanggal</th>
                                  <th class="col-md-2">No. Reg Perkara</th>
                                  <th class="col-md-2">No. Reg Barang Bukti</th>
                                  <th class="col-md-3">Jaksa 1</th>
                                  <th class="col-md-3">Jaksa 2</th>
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
                                  <td>{{ $item->terdakwa_tgl_peminjaman }}</td>
                                  <td>{{ $item->reg_perkara }}</td>
                                  <td>{{ $item->reg_bukti }}</td>
                                  <td>{{ $item->jaksa1_nama }}</td>
                                  <td>{{ $item->jaksa2_nama }}</td>
                                  <td>{{ $item->status_barang_bukti }}</td>
                                  
                              </tr>
                            <?php $i++ ?>
                            @endforeach
                              
                          </tbody>
                      </table>
                    </div>  
                    {{ $data->withQueryString()->links()}}        
                  </div>
                  <!-- AKHIR DATA -->

            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

            {{-- <script>
              function generatePrintUrl() {
                  var startDateValue = document.getElementById('start_date').value;
                  var endDateValue = document.getElementById('end_date').value;
          
                  // Membuat URL sesuai dengan route yang Anda miliki
                  var printUrl = '{{ route("papan-kontrol-filter", ["start_date" => ":start_date", "end_date" => ":end_date"]) }}';
                  printUrl = printUrl.replace(':start_date', startDateValue).replace(':end_date', endDateValue);
          
                  // Mengarahkan ke URL yang telah dibuat
                  window.open(printUrl, '_blank');
              }
            </script> --}}

            <script>
              function filterData() {
                  var statusBBValue = document.getElementById('status_bb').value;
          
                  // Membuat URL sesuai dengan route yang Anda miliki
                  var filterUrl = '{{ route("papan-kontrol-filter", ["status_bb" => ":status_bb"]) }}';
                  filterUrl = filterUrl.replace(':status_bb', statusBBValue);
          
                  // Menggunakan AJAX untuk mengambil data dan memperbarui tabel
                  fetch(filterUrl)
                      .then(response => response.text())
                      .then(data => {
                          // Memperbarui isi tabel dengan data yang diterima dari server
                          document.getElementById('filteredData').innerHTML = data;
                      })
                      .catch(error => console.error('Error:', error));
              }
          </script>
          </body>        
                   
        </div>
    </div>
@endsection