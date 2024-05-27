<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<title>Rekapan Data yang Dikembalikan</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
              <h3>Rekapan Data yang Dikembalikan (BA-20)</h3>

                  <!-- START DATA -->
                  <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                      <form action="/rekapan-data-dikembalikan/filter" method="GET"> 
                        <div class="pb-3" style="display: flex; align-items: center;">
                            <div class="col-pd-3">
                                <label for="">Start Date: </label>
                                <input type="date" id="start_date" class="form-control">
                            </div>
                            <div class="col-pd-3" style="margin-left: 10px;">
                                <label for="">End Date: </label>
                                <input type="date" id="end_date" class="form-control" >
                            </div>
        
                            <a href="#" onclick="generatePrintUrl();" class="btn btn-outline-primary" style="align-self: flex-end; margin-left: 10px;" target="_blank">
                              <i class="fa-solid fa-print"></i> Print
                            </a>
                        </div>
                      </form>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th class="col-md-1">NO</th>
                                  <th class="col-md-3">NAMA TERDAKWA</th>
                                  <th class="col-md-2">TANGGAL</th>
                                  <th class="col-md-3">JAKSA</th>
                                  <th class="col-md-3">NAMA PENERIMA</th>
                                  <th class="col-md-3">ARSIP</th>
                                  <th class="col-md-2">STATUS</th>
                              </tr>
                          </thead>

                          <tbody>
                            <!-- Pembuatan nomor otomatis -->
                            <?php $i = 1; ?>
                            <!-- data itu dari contoh controller yang with tanpa $ -->
                            @foreach ($data as $item)
                                <tr>
                                  <td>{{ $i }}</td>
                                  <td>{{ $item->terdakwa_nama }}</td>
                                  <td>{{ $item->tanggal }}</td>
                                  <td>{{ $item->jaksa_nama }}</td>
                                  <td>{{ $item->nama_penerima }}</td>
                                  <td>{{ $item->arsip }}</td>
                                  <td>{{ $item->status_ba20 }}</td>
                                  
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

            <script>
              function generatePrintUrl() {
                  var startDateValue = document.getElementById('start_date').value;
                  var endDateValue = document.getElementById('end_date').value;
          
                  // Membuat URL sesuai dengan route yang Anda miliki
                  var printUrl = '{{ route("rekapan-data-dikembalikan-filter", ["start_date" => ":start_date", "end_date" => ":end_date"]) }}';
                  printUrl = printUrl.replace(':start_date', startDateValue).replace(':end_date', endDateValue);
          
                  // Mengarahkan ke URL yang telah dibuat
                  window.open(printUrl, '_blank');
              }
            </script>
          </body>        
                   
        </div>
    </div>
@endsection